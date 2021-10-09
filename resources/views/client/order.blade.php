@php
$id = Auth::id();
$showNavigation = false;
$bodyType = 'site-menubar-unfold site-menubar-show site-navbar-collapse-show';
@endphp

@extends('app')

@section('css')
<style>
    td.details-control {
        background: url('../resources/details_open.png') no-repeat center center;
        cursor: pointer;
    }

    tr.details td.details-control {
        background: url('../resources/details_close.png') no-repeat center center;
    }
</style>
@endsection

@section('page')
<div class="row">
    <div class="col-lg-12">
        <!-- Panel -->
        <div class="panel">
            <div class="panel-body nav-tabs-animate nav-tabs-horizontal" data-plugin="tabs">
                <ul class="nav nav-tabs nav-tabs-line" role="tablist">
                    @if (Auth::user()->group_id === 'DRIVER')
                    <li class="nav-item" role="presentation"><a class="active nav-link" data-toggle="tab" href="#proses" aria-controls="proses" role="tab">Pesanan Barang</a></li>
                    @elseif (Auth::user()->group_id === 'AGENT' || Auth::user()->group_id === 'CUSTOMER')
                    <li class="nav-item" role="presentation"><a class="active nav-link" data-toggle="tab" href="#proses" aria-controls="proses" role="tab">Pesanan Proses</a></li>
                    <li class="nav-item" role="presentation"><a class="nav-link" data-toggle="tab" href="#tertunda" aria-controls="tertunda" role="tab">Pesanan Tertunda</a></li>
                    <li class="nav-item" role="presentation"><a class="nav-link" data-toggle="tab" href="#return" aria-controls="return" role="tab">Return Pesanan</a></li>
                    <li class="nav-item" role="presentation"><a class="nav-link" data-toggle="tab" href="#pesanan" aria-controls="pesanan" role="tab">Riwayat Pesanan</a></li>
                    @endif
                </ul>

                <div class="tab-content">

                    <div class="tab-pane active animation-slide-left" id="proses" role="tabpanel">
                        <div class="example-wrap">
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover table-striped" id="table-prosses">
                                    <thead>
                                        <tr style="text-align: center">
                                            <th></th>
                                            <th>No.</th>
                                            <th>No. Nota</th>
                                            <th>Tanggal Pesan</th>
                                            <th>Total Pesanan</th>
                                            <th class="text-center">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div class="tab-pane animation-slide-left" id="tertunda" role="tabpanel">
                        <div class="example-wrap">
                            <br>
                            <h4 class="example-title">Daftar Pesanan Tertunda</h4>
                            <div class="example">
                                <div class="table-responsive">
                                    <table class="table w-full responsive display nowrap" id="tabel_pending" style="width: 100%;">
                                        <thead>
                                            <tr>
                                                <th>No.</th>
                                                <th>Nama</th>
                                                <th>No. Nota</th>
                                                <th>Tanggal Pesan</th>
                                                <th>Total Pesanan</th>
                                                <th>Qty</th>
                                            </tr>
                                        </thead>
                                        <tbody></tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="tab-pane animation-slide-left" id="return" role="tabpanel">
                        <div class="example-wrap">
                            <br>
                            <h4 class="example-title">Daftar Return Pesanan</h4>
                            <div class="example">
                                <div class="table-responsive">
                                    <table class="table w-full responsive display nowrap" id="tabel_return" style="width: 100%;">
                                        <thead>
                                            <tr>
                                                <th>No.</th>
                                                <th>Tgl Return</th>
                                                <th>Nama</th>
                                                <th>No. Nota</th>
                                                <th>Qty</th>
                                                <th>Alasan</th>
                                                <th>Status</th>
                                            </tr>
                                        </thead>
                                        <tbody></tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="tab-pane animation-slide-left" id="pesanan" role="tabpanel">
                        <div class="example-wrap">
                            <br>
                            <h4 class="example-title">Daftar Riwayat Pesanan</h4>
                            <div class="example">
                                <div class="table-responsive">
                                    <table class="table display w-full display nowrap" id="tabel_riwayat">
                                        <thead>
                                            <tr>
                                                <th>No.</th>
                                                <th>No. Nota</th>
                                                <th>Tanggal Pesan</th>
                                                <th></th>
                                                <th></th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        @php $no = 1; @endphp
                                        @foreach($riwayat as $i => $arr)
                                        <tbody class="table-section" data-plugin="tableSection">
                                            <tr>
                                                <td>{{$no++}}</td>
                                                <td>{{$arr->no_nota}}</td>
                                                <td colspan="4"><span class='text-muted'><i class='icon md-time'></i> {{$arr->created_at}}</span></td>
                                            </tr>
                                        </tbody>
                                        <tbody>
                                            <tr>
                                                <th></th>
                                                <th>Nama Produk</th>
                                                <th>Status</th>
                                                <th>Qty</th>
                                                <th>Harga</th>
                                                <th>Total Harga</th>
                                            </tr>
                                            @foreach($arr->orders as $j => $p)
                                            <tr>
                                                <td></td>
                                                <td>{{$p->product->nama}}</td>
                                                <td><span class="badge badge-secondary">{{$p->status}}</span></td>
                                                <td>{{$p->qty}}</td>
                                                <td>Rp. {{$p->product->harga}}</td>
                                                <td>Rp. {{$p->qty * $p->product->harga}}</td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                        @endforeach
                                    </table>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Panel -->
        </div>
    </div>
</div>
@endsection

@section('modal')
<div class="modal fade example-modal-lg modal-3d-sign" id="modalReturn" aria-hidden="true" aria-labelledby="modalReturn" role="dialog" tabindex="-1">
    <div class="modal-dialog modal-simple modal-center modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
                <h4 class="modal-title">Return Pesanan</h4>
            </div>
            <div class="modal-body">
                <div class="example-wrap">
                    <br>
                    <h4 class="example-title text-center">Daftar produk yang akan di return</h4>
                    <div class="example">
                        <div class="table-responsive">
                            <form id="form-list-return">
                                @csrf
                                <input type="hidden" name="id">

                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th></th>
                                            <th>Nama Produk</th>
                                            <th>Qty</th>
                                        </tr>
                                    </thead>
                                    <tbody class="tbody-return">
                                    </tbody>
                                </table>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group form-material col-xl-12">
                <button type="button" class="btn btn-default" id="resetBtn">Reset
                </button>
                <button type="submit" class="btn btn-primary btn-return" id="validateButton1">Return
                </button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade example-modal-lg modal-3d-sign" id="modalPickup" aria-hidden="true" aria-labelledby="modalPickup" role="dialog" tabindex="-1">
    <div class="modal-dialog modal-simple modal-center modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
                <h4 class="modal-title">Detail Pengiriman Barang</h4>
            </div>
            <div class="modal-body">
                <div class="example-wrap">
                    <br>
                    <h4 class="example-title text-center">Daftar barang yang akan dikirim</h4>
                    <div class="example">
                        <div class="table-responsive">
                            <form id="form-list-pickup">
                                @csrf
                                <input type="hidden" name="id">

                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>Nama Produk</th>
                                            <th>Qty</th>
                                        </tr>
                                    </thead>
                                    <tbody class="tbody-pickup">
                                    </tbody>
                                </table>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Back</button>
                <button type="submit" class="btn btn-primary btn-pickup" id="validateButton1">Pickup</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade example-modal-lg modal-3d-sign" id="modalArrive" aria-hidden="true" aria-labelledby="modalArrive" role="dialog" tabindex="-1">
    <div class="modal-dialog modal-simple modal-center modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
                <h4 class="modal-title">Detail Pengiriman Barang</h4>
            </div>
            <div class="modal-body">
                <div class="example-wrap">
                    <br>
                    <h4 class="example-title text-center">Daftar barang yang sampai</h4>
                    <div class="example">
                        <div class="table-responsive">
                            <form id="form-list-pickup">
                                @csrf
                                <input type="hidden" name="id">

                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>Nama Produk</th>
                                            <th>Qty</th>
                                        </tr>
                                    </thead>
                                    <tbody class="tbody-pickup">
                                    </tbody>
                                </table>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Back</button>
                <button type="submit" class="btn btn-primary btn-arrive" id="validateButton1">Selesai Pengiriman</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade example-modal-lg modal-3d-sign" id="modalConfirm" aria-hidden="true" aria-labelledby="modalConfirm" role="dialog" tabindex="-1">
    <div class="modal-dialog modal-simple modal-center modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
                <h4 class="modal-title">Detail Pengiriman Barang</h4>
            </div>
            <div class="modal-body">
                <div class="example-wrap">
                    <br>
                    <h4 class="example-title text-center">Daftar barang yang sampai</h4>
                    <div class="example">
                        <div class="table-responsive">
                            <form id="form-list-pickup">
                                @csrf
                                <input type="hidden" name="id">

                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>Nama Produk</th>
                                            <th>Qty</th>
                                        </tr>
                                    </thead>
                                    <tbody class="tbody-pickup">
                                    </tbody>
                                </table>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Back</button>
                <button type="submit" class="btn btn-primary btn-confirm" id="validateButton1">Konfirmasi</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade example-modal-lg modal-3d-sign" id="modalCek" aria-hidden="true" aria-labelledby="modalCek" role="dialog" tabindex="-1">
    <div class="modal-dialog modal-simple modal-center modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
                <h4 class="modal-title">Detail Pengiriman Barang</h4>
            </div>
            <div class="modal-body">
                <div class="example-wrap">
                    <br>
                    <h4 class="example-title text-center">Daftar barang yang sampai</h4>
                    <div class="example">
                        <div class="table-responsive">
                            <form id="form-list-pickup">
                                @csrf
                                <input type="hidden" name="id">

                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>Nama Produk</th>
                                            <th>Qty</th>
                                        </tr>
                                    </thead>
                                    <tbody class="tbody-pickup">
                                    </tbody>
                                </table>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Back</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade example-modal-lg modal-3d-sign" id="modalTagihan" aria-hidden="true" aria-labelledby="modalTagihan" role="dialog" tabindex="-1">
    <div class="modal-dialog modal-simple modal-center modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
                <h4 class="modal-title" id="titleMTagihan" style="color: blue;">Tagihan</h4>
            </div>
            <div class="modal-body">
                <div class="example-wrap">
                    <br>
                    <h4 class="example-title text-center">Daftar barang yang sampai</h4>
                    <div class="example">
                        <div class="table-responsive">
                            <form id="form-list-pickup">
                                @csrf
                                <input type="hidden" name="id">

                                <table class="table table-bordered table-hover table-striped" id="tb_tagihan">
                                    <thead id="thead">
                                        <tr style="text-align: center;">
                                            <th></th>
                                            <th>No.</th>
                                            <th width="10%">Tagihan</th>
                                            <th>Tanggal</th>
                                            <th>Driver</th>
                                            <th width="12%">Total</th>
                                            <th>Status Bayar</th>
                                            <th>Status Pengiriman</th>
                                            <th width="20%">Aksi</th>
                                        </tr>
                                    </thead>
                                </table>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Back</button>
            </div>
        </div>
    </div>
</div>
<div class="modal fade example-modal-lg modal-3d-sign" id="modalPembayaran" aria-hidden="true" aria-labelledby="modalPembayaran" role="dialog" tabindex="-1">
    <div class="modal-dialog modal-simple modal-center modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
                <h4 class="modal-title" id="titleMPembayaran">Pembayaran</h4>
            </div>
            <div class="modal-body">
                <div class="example-wrap">
                    <br>
                    <h4 class="example-title text-center">Daftar Pembayaran</h4>
                    <div class="example">
                        <div class="table-responsive">
                            <form id="form-list-pickup">
                                @csrf
                                <input type="hidden" name="id">

                                <table class="table table-bordered table-hover table-striped" id="tb_pembayaran">
                                    <thead id="thead">
                                        <tr>
                                            <th></th>
                                            <th>No.</th>
                                            <th>Nama</th>
                                            <th>Tanggal</th>
                                            <th>Bukti Transfer</th>
                                        </tr>
                                    </thead>
                                </table>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Back</button>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
<script>
    var table2;
    var user = `{{Auth::user()->group_id}}`;
    var table;

    $(document).ready(function() {
        // console.log(user);

        table = $('#table-prosses').DataTable({
            processing: true,
            serverSide: true,
            bInfo: false,
            ajax: `{{ url("data/order/$id/prosses") }}`,
            columns: [{
                    "class": "details-control",
                    "orderable": false,
                    "data": null,
                    "defaultContent": "",
                    render: (data, type, row, meta) => {
                        return '<i class="table-section-arrow">'
                    }
                },
                {
                    data: null,
                    render: (data, type, row, meta) => {
                        return meta.row + 1
                    }
                },
                {
                    data: 'no_nota'
                },
                {
                    data: 'created_at',
                    render: (data, type, row, meta) => moment(data).format('dddd, DD MMMM YYYY')
                },
                {
                    data: 'total_harga',
                    render: (data, type, row, meta) => {

                        var formatter = new Intl.NumberFormat('en-US', {
                            style: 'currency',
                            currency: 'IDR',
                        });

                        return formatter.format(data)
                    }
                },
                {
                    data: 'id',
                    render: (data, type, row, meta) => {
                        if (row.tagihans.length > 0) {
                            return `<button data-id="${ meta.row }" data-no_nota="${ row.no_nota }" class="btn btn-sm btn-primary go_tagihan" type="button"> TAGIHAN</button>`
                        } else {
                            return '-'
                        }
                    }
                }
            ]
        });

        function format(d) {
            var template = ''

            template += `
                <table class="table">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Produk</th>
                            <th>Jumlah pesan</th>
                            <th>Jumlah disetujui</th>
                            <th>status terkini</th>
                        </tr>
                    </thead>
                    <tbody>`
            $.each(d.order_awal, function(i, v) {
                template += `
                            <tr>
                                <td scope="row">${i+1}</td>
                                <td>${v.product.nama}</td>
                                <td>${v.qty}</td>`
                if (d.order_last_status[i].status == 'BELUM DISETUJUI') {
                    template += `<td>0</td>`
                } else {
                    template += `<td>${d.order_last_status[i].qty}</td>`
                }
                template += `<td>${d.order_last_status[i].status}</td>
                            </tr>`
            });
            template += `</tbody>
                </table>`

            return template
        }

        // Array to track the ids of the details displayed rows
        var detailRows = [];

        $('#table-prosses tbody').on('click', 'tr td.details-control', function() {
            var tr = $(this).closest('tr');
            var row = table.row(tr);
            var idx = $.inArray(tr.attr('id'), detailRows);

            if (row.child.isShown()) {
                tr.removeClass('details');
                tr.find(".table-section-arrow").attr('style', 'transform: rotate(0deg)')
                row.child.hide();

                // Remove from the 'open' array
                detailRows.splice(idx, 1);
            } else {
                tr.addClass('details');
                tr.find(".table-section-arrow").attr('style', 'transform: rotate(-180deg)')

                row.child(format(row.data())).show();

                // Add to the 'open' array
                if (idx === -1) {
                    detailRows.push(tr.attr('id'));
                }
            }
        });

        // On each draw, loop over the `detailRows` array and show any child rows
        table.on('draw', function() {
            $.each(detailRows, function(i, id) {
                $('#' + id + ' td.details-control').trigger('click');
            });
        });

        $('#table-prosses').on('click', 'td .go_tagihan', function() {

            $headTable = $('#thead')
            $table = $('#tb_tagihan')

            $table.empty();
            $table.append($headTable);

            const id = $(this).data('id')
            const no_nota = $(this).data('no_nota')
            const data = table.rows().data()[id]
            // console.log(id);
            // console.log(data);

            $('input[name=id]').val(data.id)
            var templateTghn = '';

            data.tagihans.forEach((tagihan, _index) => {
                //    <div class="checkbox-custom checkbox-warning">
                //         <input type="checkbox" id="inputUnchecked" name="id_order[]" value="${ element.id }">
                //         <label for="inputChecked"></label>
                //     </div>
                var total = tagihan.nominal_total != null ? 'Rp. ' + tagihan.nominal_total.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1.") : '-'
                var status = driver = '';

                if (tagihan.driver != null) {
                    driver = tagihan.driver.name

                    if (tagihan.tracking_newest[0].status == 'WAITING TO PICKUP') {
                        status_delivery = `<span class="badge badge-secondary">${ tagihan.tracking_newest[0].status }</span>`;
                    } else if (tagihan.tracking_newest[0].status == `SENDING`) {
                        status_delivery = `<span class="badge badge-primary">${ tagihan.tracking_newest[0].status }</span>`;
                    } else {
                        status_delivery = `<span class="badge badge-success">${ tagihan.tracking_newest[0].status }</span>`;
                    }

                } else {
                    status_delivery = '-'
                    driver = '-'
                }

                templateTghn += `
                        <tbody class="table-section" data-plugin="tableSection">
                            <tr style="cursor: pointer; text-align: center;">
                                <td class="text-center"><i class="table-section-arrow"></i></td>                                            
                                <td>
                                    ${ _index+1 }
                                </td>
                                <td>
                                    Tagihan ${ _index+1 }
                                    <input type="hidden" id="id_tagihan" name="id_tagihan" value="${tagihan.id}">
                                </td>
                                <td class="font-weight-medium" >
                                    ${moment(tagihan.created_at).format('dddd, DD MMMM YYYY')}
                                </td>
                                <td class="font-weight-medium text-secondary">
                                    ${ driver } <i class="icon md-truck" aria-hidden="true"></i> ${status} 
                                </td>
                                <td class="font-weight-medium text-danger">
                                    ${ total }
                                </td>
                                <td class="font-weight-medium text-danger">
                                    ${ tagihan.status }
                                </td>
                                <td class="font-weight-medium text-danger">
                                    ${ status_delivery }
                                </td>
                                <td class="font-weight-medium text-primary">`
                templateTghn += `<a href="{{route('cetak_tagihan')}}?no_nota=${ no_nota }&id_tagihan=${ tagihan.id }" target="_blank" type="button" name="" id="" class="btn btn-xs btn-primary"><i class="icon md-money-box" aria-hidden="true"></i> Tagihan</a>`
                templateTghn += `
                `
                templateTghn += `<a href="{{route('cetak_tagihan')}}?id_pembayaran=${ tagihan.id }" target="_blank" type="button" name="" id="" class="btn btn-xs btn-danger" style="ml-2"><i class="icon md-money" aria-hidden="true"></i> Bayar</a>`
                templateTghn += `
                </td>
                            </tr>
                        </tbody>
                        <tbody>`

                // array_tagihans.push({
                //         "Id": tagihan.id,
                //         "target": po.user,
                //         "po_id": po.id,
                //         "tagihan_id": tagihan.id,
                //         "orders": tagihan.orders,
                //     })
                // idx_array_tagihans++

                templateTghn += `<tr text>
                                    <td></td>
                                    <td class="font-weight-bold" colspan="5">NAMA PRODUK</td>
                                    <td class="font-weight-bold">QTY</td>
                                    <td class="font-weight-bold" colspan="2">RINCIAN HARGA</td>
                                </tr>`

                tagihan.orders.forEach((order, _index2) => {
                    templateTghn += `
                            <tr>
                                <td></td>
                                <td class="font-weight-medium text-success" colspan="5">
                                    ${ order.product.nama }
                                </td>
                                <td>${ order.qty }</td>
                                <td colspan="2">${  'Rp '+(order.qty * order.product.harga).toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1.")  }</td>
                            </tr>`
                }) // foreach

                templateTghn += `</tbody>`


                $table.append(templateTghn)
                console.log(templateTghn);
            }) // foreach       

            $('#modalTagihan').modal({
                backdrop: 'static',
                keyboard: false,
                show: true
            })
        })
        //modal pembayaran
        $('#table-prosses').on('click', 'td .go_pembayaran', function() {

            $headTable = $('#thead')
            $table = $('#tb_pembayaran')

            $table.empty();
            $table.append($headTable);

            const id = $(this).data('id')
            const no_nota = $(this).data('no_nota')
            const data = table.rows().data()[id]

            $('input[name=id]').val(data.id)
            var templatePby = '';
            templatePby += `
                        <tbody class="table-section" data-plugin="tableSection">
                            <tr style="cursor: pointer; text-align: center;">
                                <td class="text-center"><i class="table-section-arrow"></i></td>                                            
                                <td>
                                    ${ _index+1 }
                                </td>
                                <td>
                                    ${ product.nama }
                                </td>
                                <td class="font-weight-medium" >
                                    ${moment(tagihan.created_at).format('dddd, DD MMMM YYYY')}
                                </td>
                                <td class="font-weight-medium text-secondary">
                                    ${ driver } <i class="icon md-truck" aria-hidden="true"></i> ${status} 
                                </td>
                                <td class="font-weight-medium text-danger">
                                    ${ total }
                                </td>
                                <td class="font-weight-medium text-danger">
                                    ${ tagihan.status }
                                </td>
                                <td class="font-weight-medium text-danger">
                                    <input class="buktiTransfer" type="image">
                                </td>
                            </tr>
                        </tbody>
                        <tbody>`

            $('#modalPembayaran').modal({
                backdrop: 'static',
                keyboard: false,
                show: true
            })
        })
        //end modal pembayaran

        $('.btn-return').click(function() {
            toastr.options = {
                positionClass: 'toast-bottom-right',
            }

            const data = $('#form-list-return').serialize()
            $.ajax({
                url: `{{ url("data/order/return") }}`,
                type: 'POST',
                data: data,
                success: (res) => {
                    toastr.options.onShown = () => window.location.reload(true)
                    toastr["success"]("Berhasil mengubah data")
                }
            })
        })

        $('.btn-pickup').click(function() {
            toastr.options = {
                positionClass: 'toast-bottom-right',
            }

            const data = $('#form-list-pickup').serialize()
            $.ajax({
                url: `{{ route("storePickup") }}`,
                type: 'POST',
                data: data,
                success: (res) => {
                    // console.log(res);
                    toastr.options.onShown = () => window.location.reload(true)
                    toastr["success"]("Berhasil mengubah data")
                }
            })
        })

        $('.btn-confirm').click(function() {

            toastr.options = {
                positionClass: 'toast-bottom-right',
            }

            const data = $('#form-list-pickup').serialize()
            $.ajax({
                url: `{{ route("storeConfirm") }}`,
                type: 'POST',
                data: data,
                success: (res) => {
                    // console.log(res);
                    toastr.options.onShown = () => window.location.reload(true)
                    toastr["success"]("Berhasil mengubah data")
                }
            })
        })

        $('.btn-arrive').click(function() {
            toastr.options = {
                positionClass: 'toast-bottom-right',
            }

            const data = $('#form-list-pickup').serialize()
            $.ajax({
                url: `{{ route("storeArrive") }}`,
                type: 'POST',
                data: data,
                success: (res) => {
                    // console.log(res);
                    toastr.options.onShown = () => window.location.reload(true)
                    toastr["success"]("Berhasil mengubah data")
                }
            })
        })


        var pending_column = ["id", "nama_produk", "no_nota", "tgl_pesan", "total_pesanan", "qty"];
        var return_column = ["id", "tgl_return", "nama_produk", "no_nota", "qty", "alasan", "status"];
        dataTable("#tabel_pending", pending_column, 'pending');
        dataTable("#tabel_return", return_column, 'return');
        $("#tabel_riwayat").DataTable({
            dom: ''
        });
    })

    function dataTable(table, column, url) {
        var $table = table;
        var $url = "{{url('/profile_')}}" + url;

        var $column = []
        for (i in column) {
            var a;
            if (i == 0) {
                $column.push({
                    "data": column[i],
                    "name": column[i],
                    "orderable": false,
                    "searchable": false,
                    "render": function(data, type, row, meta) {
                        return meta.row + 1;
                    }
                })
            } else {
                $column.push({
                    "data": column[i],
                    "name": column[i]
                })
            }
        }

        table2 = $($table).DataTable({
            processing: true,
            serverSide: false,
            dom: '',
            ajax: {
                url: $url,
                type: "GET"
            },
            columns: $column
        });
    }
</script>
@endsection