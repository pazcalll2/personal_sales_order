<?php

namespace App\Http\Controllers;

use App\Tagihan;
use App\Order;
use App\Payment;
use App\PurchaseOrder;
use Dotenv\Validator;
use Illuminate\Http\Request;

class TagihanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.kirim-tagihan');
    }

    public function bayar()
    {
        return view('dashboard.bayar-tagihan');
    }

    // public function upload(array $data) {
    public function upload(Request $request) {
        // nilai-nilai untuk kolom 'valid' di tabel Payment sebagai berikut:
        // 0 = memiliki arti bukti transfer ditolak
        // 1 = memiliki arti bukti transfer diterima sebagian
        // 2 = memiliki arti bukti transfer diterima semua
        // 9 = memiliki arti bukti transfer belum diproses admin
        $validator = \Validator::make($request->all(), [
            'nominal_terkirim' => 'required',
            'inputBukti' => 'required|image'
        ],[
            'nominal_terkirim.required' => 'Jumlah yang dibayar tidak boleh kosong',
            'inputBukti.required' => 'image required',
            'inputBukti.image' => 'file must be an image'
        ]);
        if (!$validator->passes()) {
            return response(['message'=>$validator->errors()->toArray()], 400);
        }else{
            $filename =time().'_'.$request->file('inputBukti')->getClientOriginalName();
            $request->file('inputBukti')->storeAs('public/tagihan', $filename.'.'.$request->file('inputBukti')->getClientOriginalExtension());
            $po_id = $request['po_id'];
            $tagihan_id = $request['id'];
            $nominal_bayar = $request['nominal_total'];

            if($request['nominal_terkirim'] < $nominal_bayar) $nominal_bayar = $request['nominal_terkirim'];
            
            $data = [
                'po_id' => $po_id,
                'tagihan_id' => $tagihan_id,
                'valid' => 9,
                'nominal_bayar' => $nominal_bayar,
                'bukti_tf' => 'public/tagihan/'.$filename
            ];
           
            return response([
                'message' => 'Record created',
                'status' => 'success',
                'data' => Payment::create($data),
                'tagihan_awal' => Tagihan::where('id', $tagihan_id)->get()
            ], 200);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $order = Order::wherein('status', ['DISETUJUI SEBAGIAN', 'DISETUJUI SEMUA'])->where('po_id', $request->po_id);
        $order = Order::wherein('status', ['BELUM DISETUJUI'])->where('po_id', $request->po_id);
        $totalOrderApprove = $order->leftjoin('products as pr', 'pr.id', '=', 'orders.product_id')
            ->selectRaw('sum( pr.harga * qty) as total')
            ->first()->total;
        
        $data = [
                'po_id' => $request->po_id,
                'nominal_total' => $totalOrderApprove
            ];
            
        // dd($data);
        // $updateOrder = Order::wherein('status', ['BELUM DISETUJUI'])->where('po_id', $request->po_id)->update(['status' => 'DISETUJUI SEMUA']);
        // dd($updateOrder);
        // return response([
        //     'data' => $order->get()
        // ], 200);
        
        $data_tagihan = Tagihan::create($data);

        $order->update([
            'status' => 'DISETUJUI SEMUA',
            'tagihan_id' => $data_tagihan->id
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Tagihan  $tagihan
     * @return \Illuminate\Http\Response
     */
    public function show(Tagihan $tagihan)
    {
        return view('dashboard.lihat-tagihan');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Tagihan  $tagihan
     * @return \Illuminate\Http\Response
     */
    public function edit(Tagihan $tagihan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Tagihan  $tagihan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tagihan $tagihan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Tagihan  $tagihan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tagihan $tagihan)
    {
        //
    }

    public function cetak_tagihan(Request $request)
    {
        $no_nota = (isset($request->no_nota)) ? $request->no_nota : null;
        $id_tagihan = (isset($request->id_tagihan)) ? $request->id_tagihan : null;
        $send['PurchaseOrder'] = Tagihan::with(['po.user', 'orders.product'])
            ->whereHas('po', function ($db) use ($no_nota) {
                return $db->where('no_nota', $no_nota);
            })
            ->where('id', $id_tagihan)
            ->get()->first();
        // return $send;
        $mpdf = new \Mpdf\Mpdf([
            //'tempDir'             =>  __DIR__ . '/tmp',
            'format'              => 'A4-P',
            'mode'                => 'utf-8',
            'setAutoTopMargin'    => 'stretch',
            'defaultheaderline'   => 0,
            'defaultfooterline'   => 0
        ]);

        $mpdf->SetMargins(0, 0, 12);

        $html = view('dashboard.pdf_tagihan', $send);
        // return $html;
        $header = '
        <table width="100%">
        <tr>
        <td width="60%" style="color:#000D00;font-size: 20pt;font-weight: bold; ">TAGIHAN</td>
        <td width="40%" style="text-align: right;">
            <table width="100%">
                <tr>
                    <td width="40%" style="color:rgba(58,54,68,1);font-size: 8pt; text-align: left;">
                    No. Nota
                    <td width="60%" style="text-align: right;">
                    <span style="font-size: 8pt;">' . $send['PurchaseOrder']->po->no_nota . '</span>
                    </td>
                </tr>
                <tr>
                    <td width="40%" style="color:rgba(58,54,68,1);font-size: 8pt; text-align: left;">
                    Tanggal
                    <td width="60%" style="text-align: right;">
                    <span style="font-size: 8pt;">' . Helper::tgl_full(now(), 98) . '</span>
                    </td>
                </tr>
                <tr>
                    <td width="40%" style="color:rgba(58,54,68,1);font-size: 8pt; text-align: left;">
                    Jatuh Tempo
                    <td width="60%" style="text-align: right;">
                    <span style="font-size: 8pt;">' . Helper::tgl_full($send['PurchaseOrder']->po->jatuh_tempo, 98) . '</span>
                    </td>
                </tr>

            </table>
        </td>
        </tr>
        </table>
        ';


        $mpdf->SetHeader($header);
        $footer = '
        <div style="border-top: 1px solid #000000; font-size: 9pt; text-align: center; padding-top: 3mm; ">
        Page {PAGENO} of {nb}
        </div>        
        ';
        $mpdf->setFooter($footer);
        // $mpdf->SetDisplayMode('fullpage');
        // $mpdf->WriteHTML($html);

        // $mpdf->Output('Rekam Medis', 'I');

        //     $mpdf = new \Mpdf\Mpdf([
        //         'margin_left' => 20,
        //         'margin_right' => 15,
        //         'margin_top' => 48,
        //         'margin_bottom' => 25,
        //         'margin_header' => 10,
        //         'margin_footer' => 10
        //     ]);

        $mpdf->SetProtection(array('print'));
        $mpdf->SetTitle("Surat Tagihan" . $send['PurchaseOrder']->no_nota);
        $mpdf->SetAuthor("Acme Trading Co.");
        $mpdf->SetWatermarkText("Tagihan");
        $mpdf->showWatermarkText = true;
        $mpdf->watermark_font = 'DejaVuSansCondensed';
        $mpdf->watermarkTextAlpha = 0.1;
        $mpdf->SetDisplayMode('fullpage');

        $mpdf->WriteHTML($html);

        $mpdf->Output();
    }

    public function cetak_surat_jalan(Request $request)
    {
        $no_nota = (isset($request->no_nota)) ? $request->no_nota : null;
        $id_tagihan = (isset($request->id_tagihan)) ? $request->id_tagihan : null;
        $send['PurchaseOrder'] = Tagihan::with(['po.user', 'orders.product'])
            ->whereHas('po', function ($db) use ($no_nota) {
                return $db->where('no_nota', $no_nota);
            })
            ->where('id', $id_tagihan)
            ->get()->first();
        // $send['PurchaseOrder'] = PurchaseOrder::with(['user', 'orders.product', 'orders' => function($db) {
        //         return $db->whereIn('status', ['APPROVE','PREPARE','SENT','ARRIVED','DONE']);
        //         },'orders.tracking.drivers'])
        //     ->whereHas('orders', function ($query) {
        //         return $query->whereIn('status', ['APPROVE','PREPARE','SENT','ARRIVED','DONE']);
        //     })
        //     ->when($no_nota, function ($query) use ($no_nota){
        //         if ($no_nota == null) {
        //             return $query;
        //         } else {
        //             return $query->where('purchase_orders.no_nota',$no_nota);
        //         }  
        //     })
        // ->get()->first();

        // return $send;
        $mpdf = new \Mpdf\Mpdf([
            //'tempDir'             =>  __DIR__ . '/tmp',
            'format'              => 'A4-P',
            'mode'                => 'utf-8',
            'setAutoTopMargin'    => 'stretch',
            'defaultheaderline'   => 0,
            'defaultfooterline'   => 0
        ]);

        $mpdf->SetMargins(0, 0, 12);

        $html = view('dashboard.pdf_surat_jalan', $send);
        // return $html;
        $header = '
            <table width="100%" style="font-family: sans;" cellpadding="0">
            <tr>
                <td width="45%" style="font-size: 12pt">
                    <span style="font-weight: bold; font-size: 14pt;">Gudang 1</span>
                    <br />Jl. Mawar Melati Indah No. 234<br />Kota Layar<br />
                    <span style="font-family:dejavusanscondensed;">&#9742;</span> 08XX-XXXX-XXXX
                </td>

                <td width="10%">&nbsp;</td>

                <td width="45%" style="color: rgba(48,48,49,1);">
                    <span style="font-size: 10pt; font-family: sans;font-weight: bold;">
                        Kepada Yth.
                    </span>
                    <table style="font-size: 8pt;">
                        <tr>
                            <td>Nama</td>
                            <td>:</td>
                            <td>' . $send['PurchaseOrder']->po->user->name . '</td>
                        </tr>
                        <tr>
                            <td>Alamat</td>
                            <td>:</td>
                            <td>' . $send['PurchaseOrder']->po->user->address . '</td>
                        </tr>
                        <tr>
                            <td>No. Telp</td>
                            <td>:</td>
                            <td>' . $send['PurchaseOrder']->po->user->no_handphone . '</td>
                        </tr>
                    </table>
                </td>
            </tr>
            </table><br />
            <h2 style="font-size: 14pt;font-weight: bold;text-decoration: underline;font-style: normal;text-align: center">SURAT JALAN</h2>
        ';


        $mpdf->SetHeader($header);
        $footer = '
        <div style="border-top: 1px solid #000000; font-size: 9pt; text-align: center; padding-top: 3mm; ">
        Page {PAGENO} of {nb}
        </div>        
        ';
        $mpdf->setFooter($footer);
        // $mpdf->SetDisplayMode('fullpage');
        // $mpdf->WriteHTML($html);

        // $mpdf->Output('Rekam Medis', 'I');

        //     $mpdf = new \Mpdf\Mpdf([
        //         'margin_left' => 20,
        //         'margin_right' => 15,
        //         'margin_top' => 48,
        //         'margin_bottom' => 25,
        //         'margin_header' => 10,
        //         'margin_footer' => 10
        //     ]);

        $mpdf->SetProtection(array('print'));
        $mpdf->SetTitle("Surat Jalan" . $send['PurchaseOrder']->po->no_nota);
        $mpdf->SetAuthor("Acme Trading Co.");
        // $mpdf->SetWatermarkText("belum dibayar");
        $mpdf->showWatermarkText = true;
        $mpdf->watermark_font = 'DejaVuSansCondensed';
        $mpdf->watermarkTextAlpha = 0.1;
        $mpdf->SetDisplayMode('fullpage');

        $mpdf->WriteHTML($html);

        $mpdf->Output();
    }
}
