@extends('template.pages.datatable', [
'page' => 'Manajemen Menu',
'breadcumbs' => [
['nama' => 'Dashboard', 'link' => 'javascript:void(0)', 'active' => ''],
['nama' => 'Setting', 'link' => 'javascript:void(0)', 'active' => ''],
['nama' => 'Manajemen Menu', 'link' => '', 'active' => 'active']
]
])

@section('top-panel')
<div class="row">
    <div class="col-md-6">
        <div class="mb-15">
            <button id="addToTable" class="btn btn-primary" type="button">
                <i class="icon md-plus" aria-hidden="true"></i> Add row
            </button>
        </div>
    </div>
</div>
@endsection

@section('table')
    <table class="table table-bordered table-hover table-striped" id="exampleAddRow">
        <thead>
            <tr>
                <th>Nama</th>
                <th>Link</th>
                <th>Parent Menu</th>
                <th>Urutan</th>
                <th>Icon</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach (App\Menu::all() as $i => $item)
                <tr class="gradeA">
                    <td>{{ $item->nama }}</td>
                    <td>{{ $item->link }}</td>
                    <td>{{ $item->parentString->nama ?? '' }}</td>
                    <td>{{ $item->urutan }}</td>
                    <td>{{ $item->icon }}</td>
                    <td class="actions">
                      <a href="#" class="btn btn-sm btn-icon btn-pure btn-default on-editing save-row"
                        data-toggle="tooltip" data-original-title="Save" hidden><i class="icon md-wrench" aria-hidden="true"></i></a>
                      <a href="#" class="btn btn-sm btn-icon btn-pure btn-default on-editing cancel-row"
                        data-toggle="tooltip" data-original-title="Delete" hidden><i class="icon md-close" aria-hidden="true"></i></a>
                      <a href="#" class="btn btn-sm btn-icon btn-pure btn-default on-default edit-row"
                        data-toggle="tooltip" data-original-title="Edit"><i class="icon md-edit" aria-hidden="true"></i></a>
                      <a href="#" class="btn btn-sm btn-icon btn-pure btn-default on-default remove-row"
                        data-toggle="tooltip" data-original-title="Remove"><i class="icon md-delete" aria-hidden="true"></i></a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
