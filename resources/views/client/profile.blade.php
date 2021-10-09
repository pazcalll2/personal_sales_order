@php
$showNavigation = false;
$bodyType = 'site-menubar-unfold site-menubar-show site-navbar-collapse-show';
@endphp

@extends('app')

@section('css')
<link rel="stylesheet" href="{{ asset('public/themeforest/global/vendor/datatables.net-bs4/dataTables.bootstrap4.css') }}">
<link rel="stylesheet" href="{{ asset('public/themeforest/global/vendor/datatables.net-responsive-bs4/dataTables.responsive.bootstrap4.css') }}">
@endsection

@section('page')
<div class="page-content container-fluid">
    <div class="row">
        <div class="col-lg-4">
            <!-- Page Widget -->
            <div class="card card-shadow text-center">
                <div class="card-block">
                    <a class="avatar avatar-100" href="javascript:void(0)">
                        <img src="{{ asset('public/img/5.jpg') }}" alt="..." style="height: 100px; width: 100px;">
                    </a>
                    <h4 class="profile-user">{{ Auth::user()->name }}</h4>
                    <p class="profile-job badge badge-table badge-info" style="font-size: 15px;">
                        {{ Auth::user()->group_id }}
                    </p>
                    <h5><b>{{ Auth::user()->address }}</b></h5>
                    <h5><b>{{ Auth::user()->no_handphone }}</b></h5>
                </div>

                <div class="card-block">
                    <button data-target="#modalEditProfile" data-toggle="modal" type="button" data-original-title="EditProfile" class="btn btn-primary"><i class="icon md-edit" aria-hidden="true"></i>Edit</button>
                </div>
            </div>
        </div>

        @if (Auth::user()->group_id === 'AGENT')
        <div class="col-lg-8">
            <div class="card card-shadow text-center">
                <div class="card card-block p-30">
                    <div class="counter counter-md text-left">
                        <div class="counter-label text-uppercase mb-9 text-left">Limit Nominal Hutang</div>
                        <br>
                        <div class="counter-number-group mb-10">
                            <span class="counter-number">Rp. {{ number_format($agent->limit, 2, ',', '.') }}</span>
                        </div>
                        <div class="counter-label">
                            <div class="progress progress-xs mb-10">
                                <div class="progress-bar progress-bar-info bg-blue-600" aria-valuenow="55.8989" aria-valuemin="0" aria-valuemax="100" style="width: 55.8989%" role="progressbar">
                                    <span class="sr-only">55.8989%</span>
                                </div>
                            </div>
                            <div class="counter counter-sm text-left">
                                <div class="counter-number-group">
                                    <span class="counter-icon red-600 mr-5"><i class="md-money-box"></i></span>
                                    <span class="counter-number">Rp. {{ number_format($limitUsed, 2, ',', '.') }}</span>
                                    <span class="counter-number-related">telah terpakai</span>
                                </div>
                            </div>
                            <div class="counter counter-sm text-left">
                                <div class="counter-number-group">
                                    <span class="counter-icon blue-600 mr-5"><i class="md-money-box"></i></span>
                                    <span class="counter-number">Rp. {{ number_format($agent->limit - $limitUsed, 2, ',', '.') }}</span>
                                    <span class="counter-number-related">sisa limit yang dapat digunakan</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endif
    </div>
</div>
@endsection

@section('modal')
<div class="modal fade example-modal-md modal-3d-sign" id="modalEditProfile" aria-hidden="true" aria-labelledby="modalEditProfile" role="dialog" tabindex="-1">
    <div class="modal-dialog modal-simple modal-center modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
                <h4 class="modal-title" style="color: blue">Form Edit Profile</h4>
            </div>
            <form id="form-update-profile" enctype="multipart/form-data" method="POST">
                @csrf
                

                <div class="modal-body" style="margin-bottom: -50px; margin-left: 30px;">
                    <div class="row row-md">
                        <div class="col-xl-12">
                            <div class="form-group row form-material">
                                <label class="col-xl-12 col-md-3 form-control-label text-left">Nama
                                    <span class="required">*</span>
                                </label>
                                <div class="col-xl-12 col-md-6">
                                    <input type="text" class="form-control" name="name" value="{{ Auth::user()->name }}" required="">
                                </div>
                            </div>

                            <div class="form-group row form-material">
                                <label class="col-xl-12 col-md-3 form-control-label text-left">Alamat
                                    <span class="required">*</span>
                                </label>
                                <div class=" col-xl-12 col-md-6">
                                    <input type="text" class="form-control" name="address" value="{{ Auth::user()->address }}" required="">
                                </div>
                            </div>

                            <div class="form-group row form-material">
                                <label class="col-xl-12 col-md-3 form-control-label text-left">No. Telp
                                    <span class="required">*</span>
                                </label>
                                <div class=" col-xl-12 col-md-6">
                                    <input type="text" class="form-control" name="no_handphone" value="{{ Auth::user()->no_handphone }}" required="">
                                </div>
                            </div>
                        </div>

                        <div class="form-group form-material col-xl-12" style="margin-bottom: 50px;">
                            <button type="reset" class="btn btn-default" style="background: #fb8b34; color: white;" id="resetBtn">Reset</button>
                            <button type="submit" name="submit" class="btn btn-primary" id="update-profile">Simpan</button>
                        </div>
                    </div>
            </form>
        </div>
    </div>
</div>
</div>

<div class="modal fade example-modal-lg modal-3d-sign" id="modalBayar" aria-hidden="true" aria-labelledby="modalBayar" role="dialog" tabindex="-1">
    <div class="modal-dialog modal-simple modal-center modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
                <h4 class="modal-title">Konfirmasi Pembayaran Tagihan</h4>
            </div>
            <div class="modal-body">
                <div class="example-wrap">
                    <br>
                    <h4 class="example-title text-center">Daftar tagihan</h4>
                    <div class="example">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>Nama</th>
                                        <th>Tanggal Pesan</th>
                                        <th>Total Pesanan</th>
                                        <th>Qty</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>1.</td>
                                        <td>Apple iPhone 12 Pro Max 128GB - Pacific Blue</td>
                                        <td>
                                            <span class="text-muted"><i class="icon md-time"></i> Apr 12,
                                                2021</span>
                                        </td>
                                        <td>Rp. 20.499.000</td>
                                        <td>
                                            1
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <div class="form-group form-material col-3" data-plugin="formMaterial">
                                <label class="form-control-label" for="select">Metode Bayar <span class="required">*</span></label>
                                <select class="form-control" id="select" required="">
                                    <option>Tunai</option>
                                    <option>Transfer</option>
                                    <option>Link Aja</option>
                                    <option>Dana</option>
                                    <option>Ovo</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default"><a href="{{ url('/client.profile') }}">Batal</a></button>
                <button type="button" class="btn btn-primary"><a href="{{ url('/client.profile') }}" style="color: beige;">Bayar</a></button>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
<script src="{{ asset('public/themeforest/global/js/Plugin/bootstrap-datepicker.js') }}"></script>
<script src="{{ asset('public/themeforest/global/vendor/bootstrap-datepicker/bootstrap-datepicker.js') }}"></script>
<script src="{{ asset('public/themeforest/page-base/examples/js/forms/validation.js') }}"></script>
<script src="{{ asset('public/themeforest/global/vendor/toastr/toastr.js') }}"></script>
<script src="{{ asset('public/themeforest/global/js/Plugin/toastr.js') }}"></script>
<script src="{{ asset('public/themeforest/page-base/examples/js/forms/validation.js') }}"></script>
<script src="{{ asset('public/themeforest/page-base//examples/js/forms/uploads.js') }}"></script>


<script>
        $(document).ready(function(e) {
            formValidation({
                element: $('#form-update-profile'),
                action: $('#update-profile'),
                fields: {},
                method: 'POST',
                targetUri: `{{ route('profile_update',Auth::user()->id) }}`
            })
        })

</script>

<script>
    var table;
    $(document).ready(function() {
        $("#resetBtn").click(function() {
            $("#form-return").reset();
            $("#modalEditProfile").modal();
        });

        $("#update-profile").click(function() {
            $("#form-update-profile").data();
            $("#modalEditProfile").modal();
        });
    })

    function dataTable(table, column, url) {
        var $table = table;
        var $url = "{{url('/profile_update')}}";

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

        table = $($table).DataTable({
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