@extends('template.pages.datatable', [
'page' => 'Riwayat Pesanan',
'breadcumbs' => [
['nama' => 'Dashboard', 'link' => 'javascript:void(0)', 'active' => ''],
['nama' => 'Pesanan', 'link' => 'javascript:void(0)', 'active' => ''],
['nama' => 'Riwayat Pesanan', 'link' => '', 'active' => 'active']
]
])

@section('table')
<table class="table table-bordered table-hover" id="exampleAddRow">
    <thead id="thead">
        <tr>
            <th class="w-50">
            </th>
            <th>
                No. Nota
            </th>
            <th width="10%">
                Tipe User
            </th>
            <th >
                Pembeli
            </th>
            <th>
                Status
            </th>
            <th class="hidden-sm-down w-200">
                Tanggal Pesan
            </th>
        </tr>
    </thead>
</table>
@endsection

@section('script')
    <script>
        $(document).ready(function() {
            $headTable = $('#thead')
            $table = $('#exampleAddRow')

            var formatter = new Intl.NumberFormat('en-ID', {
                style: 'currency',
                currency: 'IDR',
            });

            $.ajax({
                url: '{{ url("/data/purchase-order/riwayat") }}',
                type: 'GET',
                success: (response) => {
                    $table.empty()
                    $table.append($headTable)
                    let { data } = response

                    data.forEach((po, index) => {
                        template = `
                            <tbody class="table-section" data-plugin="tableSection">
                                <tr style="cursor: pointer" id="">
                                    <td class="text-center"><i class="table-section-arrow"></i></td>
                                    <td class="font-weight-medium">
                                        ${ po.no_nota }
                                    </td>
                                    <td>
                                        <span class="font-weight-medium">${ po.user.group_id }</span>
                                    </td>
                                    <td >
                                        <span class="font-weight-medium">${ po.user.name }</span>
                                    </td>
                                    <td></td>
                                    <td class="hidden-sm-down">
                                        <span class="text-muted">${ moment(po.created_at).format('dddd, DD MMMM YYYY') }</span>
                                    </td>
                                </tr>
                            </tbody>
                            <tbody>
                                <tr>
                                    <td></td>
                                    <td class="font-weight-bold">NAMA PRODUK</td>
                                    <td class="font-weight-bold">QTY</td>
                                    <td  class="font-weight-bold">TOTAL HARGA</td>
                                    <td class="font-weight-bold"></td>
                                    <td></td>
                                    <td></td>
                                </tr>`

                        // retrive detail
                        po.orders.forEach((order, _index) => {
                            let color = (order.status === 'NEW' || order.status === 'APPROVE') ? 'text-success' : (order.status === 'PENDING') ? 'text-danger' : (order.status === 'SENT') ? 'text-primary' : (order.status === 'RETURN') ? 'text-warning': '';
                            template += `
                                <tr>
                                    <td></td>
                                    <td class="font-weight-medium">
                                        ${ order.product.nama }
                                    </td>
                                    <td>${ order.qty }</td>
                                    <td >${ formatter.format(order.qty * order.product.harga) }</td>
                                    <td  class="font-weight-medium ${ color }">${ order.status }</td>
                                    <td>
                                        ${ moment(order.updated_at).format('dddd, DD MMMM YYYY') }
                                    </td>
                                </tr>`
                        }) // foreach

                        template += '</tbody>'
                        $table.append(template)
                        $('.approveAllConfirmation').on("click", function () {
                            setConfirmation($(this), "Produk ini akan diterima semua dan merubah status menjadi siap dikirim", 'APPROVE')
                        })

                        $('.pendingConfirmation').on("click", function () {
                            setConfirmation($(this), 'Proses order pada bulan selanjutnya.', 'PENDING')
                        })

                        $('.approveConfirmation').on('click', function() {
                            approveConfirmation($(this))
                        })
                    }) // foreach
                } // on success
            }) // ajax
        })

        function setConfirmation($this, warning, status) {
            let id = $this.data('id')

            swal({
                title: 'Peringatan!',
                text: warning,
                type: "warning",
                showCancelButton: true,
                confirmButtonClass: "btn-warning",
                confirmButtonText: 'Ya',
                closeOnConfirm: false, //closeOnCancel: false
                cancelButtonText: 'Batal'
            }, function () {
                updateStatusOrder({
                    id: id,
                    data: {
                        status: status
                    }
                })
            }) // swal end
        }

        function approveConfirmation($this) {
            const id = $this.data('id')

            $('.approveConfirmation').on("click", function () {
                swal({
                    title: 'Peringatan!',
                    text: "Berapa yang anda berikan pada order ini ?",
                    type: "input",
                    showCancelButton: true,
                    confirmButtonClass: "btn-warning",
                    confirmButtonText: 'Ya',
                    closeOnConfirm: false,
                    cancelButtonText: 'Batal'
                }, function (input) {
                    updateStatusOrder({
                        id: id,
                        data: {
                            qty: input
                        }
                    })
                });
            });
        }

        function updateStatusOrder(data) {
            $.ajax({
                url: `{{ url('/dashboard/order/update') }}/${ data.id }`,
                type: 'POST',
                data: data,
                success: (response) => swal({
                    title: 'Yeaaay!',
                    text: "Berhasil mengupdate data.",
                    type: "success"
                }, function() {
                    window.location.reload()
                })
            })
        }
    </script>
@endsection
