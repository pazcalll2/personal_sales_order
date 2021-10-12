@extends('template.pages.datatable', [
'page' => 'Pesanan dalam Proses',
'breadcumbs' => [
['nama' => 'Dashboard', 'link' => 'javascript:void(0)', 'active' => ''],
['nama' => 'Pesanan', 'link' => 'javascript:void(0)', 'active' => ''],
['nama' => 'Pesanan on Proses', 'link' => '', 'active' => 'active']
]
])

@section('table')
<table class="table table-bordered table-hover table-striped" id="tb_pesanan_proses">
    <thead id="thead">
        <tr>
            <th>
            </th>
            <th colspan="2">
                No. Nota
            </th>
            <th>
                Pembeli
            </th>
            <th>
                Tanggal Pesan
            </th>
            <th>
                Alamat
            </th>
        </tr>
    </thead>
</table>
@endsection

@section('script')
<script>
    $(document).ready(function() {
        $headTable = $('#thead')
        $table = $('#tb_pesanan_proses')
        var idx_array_tagihans = 0;
        var array_tagihans = []
        $.ajax({
            url: '{{ url("/data/purchase-order/proses") }}',
            type: 'GET',
            success: (response) => {

                // console.log(response);
                $table.empty();
                $table.append($headTable);
                let { data } = response
                
                data.forEach((po, index) => {
                    var driver = ''

                    // if (po.orders[0].tracking.length <= 0) {
                    //     driver = '-'
                    // } else {
                    //     driver = po.orders[0].tracking[0].drivers.name
                    // }

                    template = `
                        <tbody class="table-section" data-plugin="tableSection">
                            <tr style="cursor: pointer">
                                <td class="text-center">${index+1}</td>
                                <td class="font-weight-medium" colspan="2"> 
                                    ${ po.no_nota }
                                </td>
                                <td>
                                    <span class="font-weight-medium">${ po.user.name }</span>
                                </td>
                                <td>
                                    <span class="text-muted">${ moment(po.created_at).format('dddd, DD MMMM YYYY') }</span>
                                </td>
                                <td class="font-weight-medium">
                                    ${ po.user.address }
                                </td>`

                    template += `
                            </tr>
                        </tbody>
                        <tbody>
             

                    // // retrive detail
                    // template += `
                    //         <tr>
                    //             <th></th>
                    //             <th colspan="3" class="font-weight-bold">NAMA PRODUK</th>
                    //             <th colspan="1" class="font-weight-bold">QTY</th>
                    //             <th colspan="2" class="font-weight-bold">STATUS</th>
                    //         </tr>`
                    // po.orders.forEach((order, _index) => {
                    //     if (order.status != 'PENDING') {
                    //         template += `
                    //             <tr>
                    //                 <td></td>
                    //                 <td colspan="3" class="font-weight-medium text-success">
                    //                     ${ order.product.nama }
                    //                 </td>
                    //                 <td colspan="1">${ order.qty }</td>
                    //                 <td colspan="2" class="font-weight-medium blue-700">${ order.status }</td>
                    //             </tr>`
                    //     }
                    // }) // foreach


                        // retrive detail
                        var data_tagihan = []

                        po.tagihans.forEach((tagihan, _index) => {
                            var total = tagihan.nominal_total != null ? 'Rp. '+tagihan.nominal_total.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1.") : '-'  
                            var status = '';
                            if (tagihan.tracking_newest[0].status == 'WAITING TO PICKUP') {
                                status = `<span class="badge badge-secondary">${ tagihan.tracking_newest[0].status }</span>`;
                            } else if(tagihan.tracking_newest[0].status == `SENDING`){
                                status = `<span class="badge badge-primary">${ tagihan.tracking_newest[0].status }</span>`;
                            }else{
                                status = `<span class="badge badge-success">${ tagihan.tracking_newest[0].status }</span>`;
                            }
                            template += `
                                <tbody class="table-section" data-plugin="tableSection">
                                    <tr style="cursor: pointer">
                                        <td class="text-center"><i class="table-section-arrow"></i></td>                                            
                                        <td>
                                            Tagihan ${ _index+1 }
                                            <input type="hidden" id="id_tagihan" name="id_tagihan" value="${tagihan.id}">
                                        </td>
                                        <td class="font-weight-medium" >
                                            ${moment(tagihan.created_at).format('dddd, DD MMMM YYYY')}
                                        </td>
                                        <td class="font-weight-medium text-danger">
                                            ${ total }
                                        </td>
                                        <td class="font-weight-medium text-secondary">
                                            ${ tagihan.driver.name } <i class="icon md-truck" aria-hidden="true"></i> ${status} 
                                        </td>
                                        <td class="font-weight-medium text-primary">`
                            template += `<a href="{{route('cetak_surat_jalan')}}?no_nota=${ po.no_nota }&id_tagihan=${ tagihan.id }" target="_blank" type="button" name="" id="" class="btn btn-xs btn-success"><i class="icon md-truck" aria-hidden="true"></i> Surat Jalan</a>
                                        <a href="{{route('cetak_tagihan')}}?no_nota=${ po.no_nota }&id_tagihan=${ tagihan.id }" target="_blank" type="button" name="" id="" class="btn btn-xs btn-primary"><i class="icon md-money-box" aria-hidden="true"></i> Tagihan</a>`                                        
                                            // if (po.orders[0].status == 'APPROVE') {
                                            //     template += `<a href="{{route('cetak_tagihan')}}?no_nota=${ po.no_nota }" target="_blank" type="button" name="" id="" class="btn btn-xs btn-primary"><i class="icon md-money-box" aria-hidden="true"></i> Tagihan</a>`
                                            // } else {
                                            //     template += `<a href="{{route('cetak_surat_jalan')}}?no_nota=${ po.no_nota }" target="_blank" type="button" name="" id="" class="btn btn-xs btn-success"><i class="icon md-truck" aria-hidden="true"></i> Surat Jalan</a>
                                            //                 <a href="{{route('cetak_tagihan')}}?no_nota=${ po.no_nota }" target="_blank" type="button" name="" id="" class="btn btn-xs btn-primary"><i class="icon md-money-box" aria-hidden="true"></i> Tagihan</a>`
                                            // }
                            template += `</td>
                                    </tr>
                                </tbody>
                                <tbody>`
                            
                            array_tagihans.push({
                                    "Id": tagihan.id,
                                    "target": po.user,
                                    "po_id": po.id,
                                    "tagihan_id": tagihan.id,
                                    "orders": tagihan.orders,
                                })
                            idx_array_tagihans++
                                                            
                            template += `<tr>
                                            <td></td>
                                            <td class="font-weight-bold" colspan="3">NAMA PRODUK</td>
                                            <td class="font-weight-bold">QTY</td>
                                            <td class="font-weight-bold">RINCIAN HARGA</td>
                                        </tr>`

                            tagihan.orders.forEach((order, _index2) => {
                                template += `
                                    <tr>
                                        <td></td>
                                        <td class="font-weight-medium text-success" colspan="3">
                                            ${ order.product.nama }
                                        </td>
                                        <td>${ order.qty }</td>
                                        <td>${  'Rp '+(order.qty * order.product.harga).toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1.")  }</td>
                                    </tr>`
                            }) // foreach

                            template += `</tbody>`

                        }) // foreach

                    template += '</tbody>'
                    $table.append(template)
                    // $table.DataTable()
                }) // foreach
            } // on success
        }) // ajax
    })
</script>
@endsection
