@extends('template.pages.datatable', [
'page' => 'Return',
'breadcumbs' => [
['nama' => 'Dashboard', 'link' => 'javascript:void(0)', 'active' => ''],
['nama' => 'Return', 'link' => 'javascript:void(0)', 'active' => ''],
['nama' => 'Return', 'link' => '', 'active' => 'active']
]
])

@section('table')
<table class="table table-hover" id="exampleAddRow">
    <thead>
        <tr>
            <th>Pembeli</th>
            <th>Tgl Return</th>
            <th>Nama Produk</th>
            <th>QTY</th>
        </tr>
    </thead>
    <tbody>

    </tbody>
</table>
@endsection

@section('js')
    <script>
        $(document).ready(function() {
            $('#exampleAddRow').DataTable({
                processing: true,
                serverSide: true,
                bInfo: false,
                ajax: `{{ url("data/return/pesanan") }}`,
                columns: [
                    { data: 'po.user.name' },
                    {
                        data: null,
                        render: (data, type, row, meta) => moment(row.po.updated_at).format('dddd, DD MMMM YYYY')
                    },
                    { data: 'product.nama' },
                    { data: 'qty' },
                ]
            });
        })
    </script>
@endsection


{{-- <tr>
    <td>Barokjaya</td>
    <td>
        <span class="text-muted"><i class="icon md-time"></i> Mei 12,
            2021</span>
    </td>
    <td>OPPO v1</td>
    <td>1</td>
    <td>Earphone tidak dapat digunakan</td>
    <td align="center">
        <a href="#" class="btn btn-sm btn-icon btn-pure btn-default on-default readyDelivery" data-toggle="tooltip" data-original-title="Approve"><i class="icon md-check-all" style="color: green" aria-hidden="true"></i></a>
        <a href="#" class="btn btn-sm btn-icon btn-pure btn-default on-default removeFromPendingList" data-toggle="tooltip" data-original-title="Pending"><i class="icon md-close" style="color: red" aria-hidden="true"></i></a>
    </td>
</tr> --}}
