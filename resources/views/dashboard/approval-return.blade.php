@extends('template.pages.datatable', [
'page' => 'Approval Return',
'breadcumbs' => [
['nama' => 'Dashboard', 'link' => 'javascript:void(0)', 'active' => ''],
['nama' => 'Return', 'link' => 'javascript:void(0)', 'active' => ''],
['nama' => 'Approval Return', 'link' => '', 'active' => 'active']
]
])

@section('table')
<table class="table table-bordered table-hover table-striped" id="exampleAddRow">
    <thead>
        <tr>
            <th>Pembeli</th>
            <th>Tgl Return</th>
            <th>Nama Produk</th>
            <th>QTY</th>
            <th>Alasan</th>
            <th>Tgl Terima</th>
            <!-- <th></th> -->
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>Barokjaya</td>
            <td>
                <span class="text-muted"><i class="icon md-time"></i> Mei 12,
                    2021</span>
            </td>
            <td>OPPO v1</td>
            <td>1</td>
            <td>Earphone tidak dapat digunakan</td>
            <td>
                <span class="text-muted"><i class="icon md-time"></i> Mei 22,
                    2021</span>
            </td>
            <!-- <td align="center">
                <a href="#" class="btn btn-sm btn-icon btn-pure btn-default on-default readyDelivery" data-toggle="tooltip" data-original-title="Approve"><i class="icon md-check-all" style="color: green" aria-hidden="true"></i></a>
                <a href="#" class="btn btn-sm btn-icon btn-pure btn-default on-default removeFromPendingList" data-toggle="tooltip" data-original-title="Pending"><i class="icon md-close" style="color: red" aria-hidden="true"></i></a>
            </td> -->
        </tr>
    </tbody>
</table>
@endsection