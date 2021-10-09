@extends('template.pages.datatable', [
'page' => 'Perintah Kirim',
'breadcumbs' => [
['nama' => 'Dashboard', 'link' => 'javascript:void(0)', 'active' => ''],
['nama' => 'Pesanan', 'link' => 'javascript:void(0)', 'active' => ''],
['nama' => 'Perintah Kirim', 'link' => '', 'active' => 'active']
]
])

@section('bottom-panel')
    <button type="button" class="btn btn-primary waves-effect waves-classic btn-kirim" >
        Kirim Pesanan
    </button>
@endsection

@section('table')
    <table class="table table-bordered table-hover table-striped" id="exampleAddRow">
        <thead id="thead">
            <tr>
                <th class="w-50">
                </th>
                <th colspan="2">
                    No. Nota
                </th>
                <th>
                    Pembeli
                </th>
                <th class="hidden-sm-down w-200">
                    Tanggal Pesan
                </th>
                <th>
                    Alamat
                </th>
            </tr>
        </thead>
    </table>
@endsection

@section('modal')
    <div class="modal fade modal-fade-in-scale-up" id="modal-select-driver" aria-hidden="true"
        aria-labelledby="exampleModalTitle" role="dialog" tabindex="-1">
        <div class="modal-dialog modal-simple">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                    <h5 class="modal-title">Pilih Driver</h4>
                </div>
                <div class="modal-body">
                    <select id="list-driver" class="form-control select2-hidden-accessible" data-plugin="select2"
                        data-select2-id="1" tabindex="-1" aria-hidden="true">
                    </select>
                    <h5 class="modal-title" style="margin-bottom: 10px">Jatuh Tempo</h4>
                    <input type="text" class="form-control datepicker" id="jatuh_tempo" placeholder="{{date("Y-m-d")}}" name="jatuh_tempo" value="{{ now() }}" />
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-default btn-pure" data-dismiss="modal">Tutup</button>
                    <button type="button" class="btn btn-primary btn_simpan">Simpan</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
<script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/js/bootstrap-datepicker.js"></script>
    <script>
        $(document).ready(function() {

            var formatter = new Intl.NumberFormat('en-ID', {
                style: 'currency',
                currency: 'IDR',
            });

            $headTable = $('#thead')
            $table = $('#exampleAddRow')
            var array_tagihans = []
            var idx_array_tagihans = 0
            var user = [];
            $.ajax({
                url: '{{ url('/data/purchase-order/perintah-kirim') }}',
                type: 'GET',
                success: (response) => {
                    $table.empty()
                    $table.append($headTable)
                    let {
                        data
                    } = response
                    console.log(data)
                    data.forEach((po, index) => {
                        var d = new window.Date(po.created_at);
                        var day = d.getDate();
                        var month = d.getMonth();
                        var year = d.getFullYear();
                        var dd = year + '-' + month + '-' + day;
                        var template = `
                                <tbody class="table-section" data-plugin="tableSection">
                                    <tr>
                                        <td class="text-center">${index+1}</td>
                                        
                                        <td class="font-weight-medium" colspan="2">
                                            ${ po.no_nota }
                                        </td>
                                        <td>
                                            <span class="font-weight-medium">${ po.user.name }</span>
                                        </td>
                                        <td class="hidden-sm-down">
                                            <span class="text-muted">${ dd }</span>
                                        </td>
                                        <td width="40%" colspan="2">
                                            ${ po.user.address }
                                        </td>
                                    </tr>
                                </tbody>
                                <tbody>
                                    <tr>
                                        <td colspan="7" class="p-0">`
                                        

                        // retrive detail
                        var data_tagihan = []

                        po.tagihans.forEach((tagihan, _index) => {
                            var total = tagihan.nominal_total != null ? 'Rp. '+tagihan.nominal_total.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1.") : '-'  
                            console.log(tagihan)
                            template += `
                                <tbody class="table-section" data-plugin="tableSection">
                                    <tr style="cursor: pointer">
                                        <td>
                                            <div class="checkbox-custom checkbox-warning">
                                                <input type="checkbox" class="check" name="check[]" value="${ idx_array_tagihans }">
                                                <label for="inputUnchecked"></label>
                                            </div>    
                                        </td>
                                        <td class="text-center"><i class="table-section-arrow"></i></td>                                            
                                        <td width="">
                                            Tagihan ${ _index+1 }
                                            <input type="hidden" id="id_tagihan" name="id_tagihan" value="${tagihan.id}">
                                        </td>
                                        <td class="font-weight-medium text-success" colspan="2">
                                            ${moment(tagihan.created_at).format('dddd, DD MMMM YYYY')}
                                        </td>
                                        <td class="font-weight-medium text-success">
                                            ${ total }
                                        </td>
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
                                            <td></td>
                                            <td class="font-weight-bold" colspan="2">NAMA PRODUK</td>
                                            <td class="font-weight-bold">QTY</td>
                                            <td class="font-weight-bold">RINCIAN HARGA</td>
                                        </tr>`

                            console.log(tagihan)
                            tagihan.orders.forEach((order, _index2) => {
                                template += `
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td class="font-weight-medium text-success" colspan="2">
                                            ${ order.product.nama }
                                        </td>
                                        <td>${ order.qty }</td>
                                        <td>${  'Rp. '+(order.qty * order.product.harga).toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1.")  }</td>
                                    </tr>`
                            }) // foreach

                            template += `</tbody>`

                        }) // foreach
                        // orders.push({"target" : po.user.group_id});

                        template += `</td></tr></tbody>`
                        $table.append(template)
                    }) // foreach

                } // on success
            }) // ajax

            // console.log(array_tagihans);

            $.ajax({
                url: '{{ url('data/drivers') }}',
                type: 'GET',
                success: (response) => {
                    // console.log(response);
                    let {
                        data
                    } = response
                    data.forEach((driver, index) => {
                        $('#list-driver').append(
                            `<option value="${ driver.id }">${ driver.user.name }</option>`
                        )
                    })
                }
            })

            var dataChecked = []
            $(document).on('change', '.check', function() {
                if ($(this).is(':checked')) {
                    var data = array_tagihans[$(this).val()];
                    dataChecked.push(data);
                } else {
                    var x = dataChecked.indexOf($(this).val());
                    dataChecked.splice(x, 1);
                }
                // var tag = 'oka'
                // var obj = {};

                // obj[tag] = 'OKOK'
                // console.log(obj);

                // dataChecked = [];
                // $(".check").each(function() {
                //     if ($(this).is(":checked")) {

                //         dataChecked.push({
                //             'tagihan_id':$(this).val(),
                //             'group_id':$(this).data('group_id'),
                //         });
                        
                //     }
                // });

                console.log(dataChecked);
            });

            $('.btn_simpan').on('click', function() {
                var id_driver = $("#list-driver").val();
                var data = dataChecked;
                var jatuh_tempo = $("#jatuh_tempo").val();

                $.ajax({
                    url: "{{ url('data/purchase-order/kirim') }}",
                    type: 'POST',
                    dataType: 'json',
                    data: {
                        id_driver: id_driver,
                        data: data,
                        jatuh_tempo : jatuh_tempo
                    },
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: (response) => swal({
                        title: 'Yeaaay!',
                        text: response.message,
                        type: "success"
                    }, function() {
                        window.location.href = "{{url('dashboard/order/tagihan')}}"
                    }),
                    error: (response) => swal({
                        title: 'Hufffttt!',
                        text: 'Please try again later',
                        type: "error"
                    })
                });
            });
        })

        $(".btn-kirim").click(function() {
            $("#modal-select-driver").modal("show");
            $('#modal-select-driver').on('shown.bs.modal', function(e) {
            $('.datepicker').datepicker({
                format: "yyyy-mm-dd",
                todayBtn: "linked",
                autoclose: true,
                todayHighlight: true
            });
        });
    });

    </script>
@endsection
