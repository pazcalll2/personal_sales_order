@extends('template.pages.datatable', [
'page' => 'Pesanan Masuk',
'breadcumbs' => [
['nama' => 'Dashboard', 'link' => 'javascript:void(0)', 'active' => ''],
['nama' => 'Pesanan', 'link' => 'javascript:void(0)', 'active' => ''],
['nama' => 'Pesanan Masuk', 'link' => '', 'active' => 'active']
]
])

@section('table')
<table class="table table-bordered table-hover table-striped" id="exampleAddRow">
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
            <th class="hidden-sm-down w-200">
                Tanggal Pesan
            </th>
            <th class="hidden-sm-down w-200">
                Aksi
            </th>
        </tr>
    </thead>
</table>
@endsection

@section('script')
    <script>
        $(document).ready(function() {
            preparingOrderTable()
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
            console.log('approve confirmation ', id)
            // $('.approveConfirmation').on("click", function () {
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
                    if (input!=false) {
                        updateStatusOrder({
                            id: id,
                            data: {
                                qty: input
                            }
                        })
                    }
                });
            // });
        }

        function updateStatusOrder(data) {
            console.log('ajaxx ', data)
            $.ajax({
                url: `{{ url('/dashboard/order/update') }}`,
                type: 'POST',
                // data: JSON.stringify(data),
                // dataType: "json",
                // contentType: "application/json; charset=utf-8",
                data: {
                    // _token: $('meta[name="csrf-token"]').attr('content'),
                    // total: total,
                    data
                },
                success: (response) => {
                    console.log('orders updated with pending')
                    preparingOrderTable()
                }
            })
        }

        $(document).on('click','.add_tagihan', function (e) { 
            e.preventDefault();
            // console.log($(this).data('id'))
            $.ajax({
                url: `{{ route('addTagihan') }}`,
                type: 'POST',
                data: {po_id:$(this).data('id')},
                success: (response) => swal({
                    title: 'Sukses!',
                    text: "Berhasil membuat tagihan",
                    type: "success"
                }, function(){
                    $('#exampleAddRow').DataTable().clear().destroy();
                    preparingOrderTable()
                })
            })
        });
        function preparingOrderTable() {
            $(document).ready(function() {
                $headTable = $('#thead')
                $table = $('#exampleAddRow')

                var formatter = new Intl.NumberFormat('en-ID', {
                    style: 'currency',
                    currency: 'IDR',
                });
                console.log('formatter ',formatter)

                $.ajax({
                    url: '{{ url("/data/purchase-order/new") }}',
                    type: 'GET',
                    success: (response) => {
                        $table.DataTable().destroy()
                        $table.empty()
                        $table.append($headTable)
                        let { data } = response

                        data.forEach((po, index) => {
                            template = `
                                <tbody class="table-section" data-plugin="tableSection">
                                    <tr style="cursor: pointer">
                                        <td class="text-center"><i class="table-section-arrow"></i></td>
                                        <td class="font-weight-medium">
                                            ${ po.no_nota }
                                        </td>
                                        <td>
                                            <span class="font-weight-medium">${ po.user.group_id }</span>
                                        </td>
                                        <td>
                                            <span class="font-weight-medium">${ po.user.name }</span>
                                        </td>
                                        <td class="hidden-sm-down">
                                            <span class="text-muted">${ moment(po.created_at).format('dddd, DD MMMM YYYY') }</span>
                                        </td>
                                        <td>`
                            if (po.orders.length > 0) {
                                console.log(po.orders)
                                template += `<a type="button" data-id="${po.id}" class="btn btn-xs btn-success text-white add_tagihan"><i class="icon md-money-box" aria-hidden="true"></i>Buat Tagihan</a>`
                            } else {
                                template += `-`
                            }
                            template += `</td>                                    
                                    </tr>
                                </tbody>
                                <tbody>
                                    <tr>
                                        <td><input class="form-check-input check-master${po.id}" style="margin-left: 1.571rem;" type="checkbox"></td>
                                        <td class="font-weight-bold">NAMA PRODUK</td>
                                        <td class="font-weight-bold">QTY</td>
                                        <td class="font-weight-bold">TOTAL HARGA</td>
                                        <td class="font-weight-bold">QTY DISETUJUI</td>
                                        <td class="font-weight-bold"></td>
                                    </tr>`

                            // retrive detail
                            let newOrders = []  // save order from po.orders per loop
                            let toSubmit = []   // saves order item for each checked checkbox 
                            let order_id = []   // id of the checked order checkbox
                            po.orders.forEach((order, _index) => {
                                console.log('order.id', po.orders.length)
                                newOrders.push(order)
                                template += `
                                    <tr>
                                        <td><input class="form-check-input check${po.id}" id="check${order.id}" style="margin-left: 1.571rem;" type="checkbox"></td>
                                        <td class="font-weight-medium text-success">
                                            ${ order.product.nama }
                                        </td>
                                        <td id="qty${order.id}">${ order.qty }</td>
                                        <td>${ formatter.format(order.qty * order.product.harga) }</td>
                                        <td>
                                            <div class="row">
                                                <input class="form-check" style="margin-left: 1.571rem; width: 60px" type="number" value="${order.qty}" min="0" max="${order.qty}" id="inp${order.id}">
                                            <!--    
                                                <button class="btn btn-sm btn-icon btn-pure btn-default on-default approveConfirmation" data-toggle="tooltip" data-id="${ order.id }" data-original-title="Approve Sebagian"><i class="icon md-check" style="color: orange" aria-hidden="true"></i></button>
                                                <button class="btn btn-sm btn-icon btn-pure btn-default on-default pendingConfirmation" data-toggle="tooltip" data-id="${ order.id }" data-original-title="Pending Semua"><i class="icon md-minus" style="color: red" aria-hidden="true"></i></button> 
                                            -->
                                            </div>
                                        </td>
                                        </tr>
                                        `
                                if(po.orders.length == _index+1){
                                    template+=`
                                    <tr>
                                        <td colspan=6><a id="btn${po.id}" class="btn btn-info" style="color: white; width: 70%; margin-inline: 15%;">Setujui Checkbox dan Buat Tagihan</a></td>
                                    </tr>
                                    `
                                }
                                // $(`#check${order.id}`).change(function(){
                                //     if(this.checked){
                                //         $(`.check${po.id}`).prop("checked", true) 
                                //     }
                                // })
                            }) // foreach

                            template += `</tbody>`
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
                            // CHECKBOXES
                            $(`.check-master${po.id}`).change(function(){
                                if(this.checked){
                                    $(`.check${po.id}`).prop("checked", true) 
                                    console.log($(`.check${po.id}:checked`).val())
                                    newOrders.forEach((order) => {
                                        if ($(`#check${order.id}`).prop("checked")===true) {
                                            if (order_id.filter(function(e) {return e !== order.id})) {
                                                order_id = order_id.filter(function(e) {return e !== order.id})
                                                toSubmit = toSubmit.filter(function(e){return e.id !== order.id})
                                                order_id.push(order.id)
                                                toSubmit.push(order) 
                                            }else{
                                                order_id.push(order.id)
                                                toSubmit.push(order)
                                            }
                                        }
                                        else if($(`#check${order.id}`).prop("checked")===false){
                                            order_id.remove(order.id)
                                            toSubmit = toSubmit.filter(function(e){return e.id !== order.id})
                                        }
                                    })
                                }
                            })
                            newOrders.forEach((order) => {
                                $(`#check${order.id}`).change(function(){
                                    if(this.checked){
                                        order_id.push(order.id)
                                        toSubmit.push(order)
                                    }else if(!this.checked){
                                        order_id = order_id.filter(function(e) {
                                            return e !== order.id
                                        })
                                        toSubmit = toSubmit.filter(function(e){return e.id !== order.id})
                                    }
                                })
                            })
                            let beforeSubmit = []
                            let toPending = []
                            let sameQty = true
                            $(`#btn${po.id}`).on('click', function(){
                                toSubmit.forEach((order)=>{
                                    console.log($(`#inp${order.id}`).val());
                                    if($(`#inp${order.id}`).val() !== order.qty){
                                        order.qty = $(`#inp${order.id}`).val()
                                        beforeSubmit.push(order);
                                    }else{
                                        beforeSubmit.push(order);
                                    }
                                })
                                toSubmit = beforeSubmit
                                console.log('final ',toSubmit)
                                // toSubmit.forEach((order, _index)=>{
                                    // if (po.orders.length === toSubmit.length && parseInt(order.qty) !== parseInt($(`#qty${order.id}`).html())) {
                                    //     console.log('order ', order)
                                    //     console.log('qty.order ', parseInt($(`#qty${order.id}`).html()))
                                    //     sameQty = false
                                    //     throw false
                                    // }else sameQty = true
                                // })
                                for (let i = 0; i < toSubmit.length; i++) { 
                                    // to check whether the requested qty same as the max qty or not and then change the value of qty similarity dynamically
                                    if (po.orders.length === toSubmit.length && parseInt(toSubmit[i].qty) !== parseInt($(`#qty${toSubmit[i].id}`).html())) {
                                        console.log('toSubmit[i] ', toSubmit[i])
                                        console.log('qty.toSubmit[i] ', parseInt($(`#qty${toSubmit[i].id}`).html()))
                                        sameQty = false
                                        break
                                    }else sameQty = true
                                }
                                if (po.orders.length === toSubmit.length && sameQty === true) { 
                                    // to submit the order if all checkboxes are checked and the req qty same as the max qty
                                    $.ajax({
                                        url: `{{ route('addTagihan') }}`,
                                        type: 'POST',
                                        data: {po_id: po.id},
                                        success: (response) => swal({
                                            title: 'Sukses!',
                                            text: "Berhasil membuat tagihan",
                                            type: "success"
                                        }, function(){
                                            console.log('Order command is being processed')
                                            $('#exampleAddRow').DataTable().clear().destroy();
                                            preparingOrderTable()
                                        })
                                    })
                                }else if(po.orders.length !== toSubmit.length || sameQty !== true){ 
                                    // to submit the order if not all checkboxes are checked and the req qty is not same as the max qty
                                    // format of the data in updateStatusOrder(data) by default is 
                                    // data:{
                                    //      id, 
                                    //      data:{
                                    //          qty
                                    //      }
                                    // }
                                    let products_id = []
                                    updateStatusOrder(toSubmit);
                                    // toSubmit.forEach((order, _index) => {
                                    //     products_id.push(order.product.id)
                                    //     if (toSubmit.length-1 == _index) {
                                    //         updateStatusOrder({
                                    //             id: order.id,
                                    //             po_id: po.id,
                                    //             products_id: products_id,
                                    //             finished: 'true',
                                    //             data: {
                                    //                 qty: order.qty
                                    //             }
                                    //         })
                                    //     }else{
                                    //         updateStatusOrder({
                                    //             id: order.id,
                                    //             po_id: po.id,
                                    //             finished: 'false',
                                    //             products_id: products_id,
                                    //             data: {
                                    //                 qty: order.qty
                                    //             }
                                    //         })
                                    //     }
                                    // })
                                    // console.log(toSubmit)
                                    // console.log('qty similarity ', sameQty)
                                    // console.log('length similarity ', po.orders.length !== toSubmit.length)
                                    // console.log('po length ', po.orders.length)
                                    // console.log('tosubmit length ', toSubmit.length)

                                }
                                // console.log(parseInt(order.qty) !== parseInt($(`#qty${order.id}`).html()))
                                // console.log('order.qty', order)
                                // console.log('max qty', parseInt($(`#qty${order.id}`).html()))
                                beforeSubmit = []
                                // console.log('qty similarity ', sameQty)
                                console.log('data length ', data.length)
                            })
                        }) // foreach
                        $('#exampleAddRow').DataTable()
                    } // on success
                }).done($('#exampleAddRow').DataTable())// ajax
            })
        }
    </script>
@endsection
