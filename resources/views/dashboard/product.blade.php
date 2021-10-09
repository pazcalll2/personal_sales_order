@extends('template.pages.datatable', [
'page' => 'Manajemen Produk',
'breadcumbs' => [
['nama' => 'Dashboard', 'link' => 'javascript:void(0)', 'active' => ''],
['nama' => 'Produk', 'link' => 'javascript:void(0)', 'active' => ''],
['nama' => 'Manajemen produk', 'link' => '', 'active' => 'active']
]
])


@section('top-panel')
<div class="row">
    <div class="col-md-6">
        <div class="mb-15">
            <a href="{{ url('/dashboard/produk/create') }}" class="btn btn-primary" type="button">
                <i class="icon md-plus" aria-hidden="true"></i> Add row
            </a>
        </div>
    </div>
</div>
@endsection

@section('table')
    <table class="table table-bordered table-hover table-striped" id="exampleAddRow">
        <thead>
            <tr>
                <th style="width: 25%;">Nama</th>
                <th style="width: 25%;">Kategori</th>
                <th style="width: 12%;">Harga</th>
                <th style="width: 9%;">Deskripsi</th>
                <th style="width: 12%;">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($stocks as $i => $stock)
                <tr>
                    <td> {{ $stock->product->nama }} </td>
                    <td> {{ $stock->product->category->name }} </td>
                    <td>Rp {{ number_format($stock->product->harga, 2, ',', '.') }}</td>
                    <td align="center">
                        <button class="btn btn-sm btn-icon btn-pure btn-default on-default" data-target="#modalDescription"
                            data-toggle="modal" type="button" data-original-title="Deskripsi" id="btn-deskripsi"
                            data-deskripsi="{{ $stock->product->deskripsi }}">
                            <i class="icon md-file" aria-hidden="true"></i>
                        </button>

                        <button class="btn btn-sm btn-icon btn-pure btn-default on-default " data-target="#modalImage"
                            data-toggle="modal" type="button" data-original-title="Deskripsi">
                            <i class="icon md-aspect-ratio-alt" aria-hidden="true"></i>
                        </button>
                    </td>
                    <td align="center">
                        <button class="btn btn-sm btn-icon btn-pure btn-default on-default" data-toggle="tooltip"
                            type="button" data-original-title="Edit Data Produk">
                            <a href="{{ url('/dashboard/produk') . '/' . $stock->product->id }}/edit"
                                data-original-title="Edit"><i class="icon md-edit" aria-hidden="true"></i></a>
                        </button>

                        <button class="btn btn-sm btn-icon btn-pure btn-default on-default removeProductConfirmation"
                            type="button" data-id="{{ $stock->product->id }}">
                            <i class="icon md-delete" aria-hidden="true"></i>
                        </button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Modal Deskripsi -->
    <div class="modal fade" id="modalDescription" aria-hidden="true" aria-labelledby="examplePositionCenter" role="dialog"
        tabindex="-1">
        <div class="modal-dialog modal-simple modal-center">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                    <h4 class="modal-title">Deskripsi</h4>
                </div>
                <div class="modal-body">
                    <p id="deskripsi">
                </p>
            </div>
        </div>
    </div>
</div>
</div>

<!--  Modal Images -->
<div class="modal fade" id="modalImage" aria-hidden="true" aria-labelledby="examplePositionCenter" role="dialog" tabindex="-1">
    <div class="modal-dialog modal-simple modal-center">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
                <h4 class="modal-title">Gambar Produk</h4>
            </div>

            <div class="modal-body">
                <div class="carousel slide" id="exampleCarouselCaptions" data-ride="carousel">
                    <ol class="carousel-indicators carousel-indicators-fillin">
                        <li class="active" data-slide-to="0" data-target="#exampleCarouselCaptions"></li>
                        <li data-slide-to="1" data-target="#exampleCarouselCaptions"></li>
                        <li data-slide-to="2" data-target="#exampleCarouselCaptions"></li>
                    </ol>
                    <div class="carousel-inner" role="listbox">
                        <div class="carousel-item active">
                            <img class="rounded" src="{{ asset('public/themeforest/page-base/examples/images/lockscreen.jpg') }}" alt="..." width="100%" height="100%">
                        </div>
                        <div class="carousel-item">
                            <img class="rounded" src="{{ asset('public/themeforest/page-base/examples/images/lockscreen.jpg') }}" alt="..." width="100%" height="100%">
                        </div>
                        <div class="carousel-item">
                            <img class="rounded" src="{{ asset('public/themeforest/page-base/examples/images/lockscreen.jpg') }}" alt="..." width="100%" height="100%">
                        </div>
                    </div>
                    <a class="carousel-control-prev" href="#exampleCarouselCaptions" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon md-chevron-left" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#exampleCarouselCaptions" role="button" data-slide="next">
                        <span class="carousel-control-next-icon md-chevron-right" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>

            </div>
            <!-- <div class="modal-footer">
                <button type="button" class="btn btn-default btn-pure" data-dismiss="modal">Close</button>
            </div> -->
        </div>
    </div>
</div>
<!-- End Modal -->
@endsection

@section('script')
    <script>
        $(document).ready(function() {
            $('#btn-deskripsi').click(function() {
                const deskripsi = $(this).data('deskripsi')
                $('#deskripsi').html(deskripsi)
            });

            const data = 1;
            const text = data === 1 ? "Anda akan menampilkan product ini ke daftar product" :
                "Anda akan menyembunyikan product ini dari daftar product";

            // alert untuk menampilkan / menghide product di listing page
            showSwalAlert({
                element: $('.toggleOnListingConfirmation'),
                title: 'Peringatan!',
                text: text,
                type: 'warning',
                callback: () => {
                    swal.close()

                    $.ajax({
                        url: `{{ url('dashboard/produk') }}/${ $('.toggleOnListingConfirmation').data('id') }/visible`,
                        type: 'POST',
                        dataType: 'JSON',
                        processData: false,
                        contentType: false,
                        complete: (res) => {
                            res = res.responseJSON;

                            toastr.options.onShown = () => window.location.reload(true)
                            toastr[res.status](res.message)
                        }
                    })
                }
            })

            // alert hapus product
            showSwalAlert({
                element: $('.removeProductConfirmation'),
                title: 'Peringatan!',
                text: 'Apa anda yakin untuk menghapus product ini dari list?',
                type: 'warning',
                callback: () => {
                    swal.close()

                    $.ajax({
                        url: `{{ url('dashboard/produk') }}/` + $('.removeProductConfirmation').data('id'),
                        type: 'DELETE',
                        dataType: 'JSON',
                        processData: false,
                        contentType: false,
                        complete: (res) => {
                            res = res.responseJSON;

                            toastr.options.onShown = () => window.location.reload(true)
                            toastr[res.status](res.message)
                        }
                    })
                }
            })
    })
</script>
@endsection
