@php
$showNavigation = false;
$bodyType = 'site-menubar-unfold';
@endphp

@extends('app')

@section('css')
<style>
    @media only screen and (max-width: 1280px){
        #product-wrapper {
            /* column-count: 2; */
            margin: 0 auto;
            width: max-content;
        }
        .card:nth-child(2n+1){
            clear: left;
        }
        .card{
            float: left;
            margin: 5px;
            margin-bottom: 10px;
            width: 350px;
        }
    }

    @media only screen and (min-width: 1281px) {
        #product-wrapper {
            margin: 0 auto;
            width: max-content;
        }
        .card:nth-child(4n+1){
            clear: left;
        }
        .card{
            float: left;
            margin: 5px;
            margin-bottom: 10px;
            width: 280px;
            max-width: 401px;
        }
    }

    @media (min-width: 480px) {
        .card-columns{
            -webkit-column-gap: 1.429rem;
            column-gap: 1.429rem;
            orphans: 1;
            widows: 1;
        }
    }

    .loader-grill::before {
        background: #3f51b5
    }

    .loader-grill {
        background: #3f51b5
    }

    .loader-grill::after {
        background: #3f51b5
    }
</style>
@endsection

@section('page')
<div class="row">
    <div class="col-12">
        <div class="py-15">
            <div class="text-center">
                <div class="btn-group" aria-label="Basic example" role="group">
                    <a type="button" class="btn btn-icon btn-primary waves-effect waves-classic" style="color: #fff"><i class="icon md-collection-image" aria-hidden="true"></i></a>
                    <a class="btn btn-icon btn-light waves-effect waves-classic" href="{{ url('index-tabel') }}" style="color: #3f51b5"><i class="icon md-view-list" aria-hidden="true"></i></a>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="example-wrap">
            <div class="row">
                <div class="" id="product-wrapper">
                </div>
            </div>
            <div class="row" style="margin: 0 auto; width: fit-content; margin-top: 20px;">
                <div id="loader" class="text-center" style="margin-top: 25px; margin-bottom: 25px">
                    <div class="loader vertical-align-middle loader-grill"></div>
                </div>
            </div>
            <div class="row" style="margin: 0 auto; width: fit-content;">
                <div class="text-center">
                    <div class="btn-group" aria-label="Basic example" role="group">
                        <button type="button" id="load-more" class="btn btn-icon btn-primary waves-effect waves-classic" style="color: #fff">
                            <i class="icon md-refresh" aria-hidden="true"></i>
                            Load More
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
<script>
    console.log(window.innerWidth)
    var path = ''
    var currentPage = 1

    $(document).ready(function() {
        toastr.options = {
            positionClass: 'toast-bottom-right',
        }

        // define requests
        var json = $.getJSON({
            url: `{{ url('/data/catalogue/products') }}`,
            type: 'GET',
            async: true
        }).then((res) => {
            const {
                data
            } = res
            if (carts == null) {
                carts = []
            }

            $('#product-wrapper').empty()
            bindView(data)
        });
        //button filter katalog
        $('#btn_filter').on('click', function() {
            filter()
        });
        //end button

        $("#search_form").submit(function(event) {
            event.preventDefault();
            var input = $("#input_search").val();
            search(input)
        });

        $('#btn-buy').click(function() {
            let total = 0
            carts.forEach((product, _index) => total += parseInt(product.harga) * parseInt(product.qty))
            buy(carts, total)
            carts = []
        })
        //function load more
        $('#load-more').on('click', function() {
            move(path, (currentPage + 1))
        })
        //end function
        
        //function reset filter kategori
        $(document).ready(function() {
            $("#reset").click(function() {
                document.getElementById("form_filter").reset();
                $('#kategori').val($('#kategori option:first-child').val()).trigger('change');
                $('#merek').val($('#merek option:first-child').val()).trigger('change');
                $("#filterKatalog").modal();
            });
        })
        //end reset filter kategori
    }) // end of jquery

    function search(input) {
        $.ajax({
            type: "POST",
            url: "{{ url('search') }}",
            dataType: "json",
            data: {
                search: input
            },
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: (response) => {
                $('#product-wrapper').empty()
                bindView(response.data)
            }
        })
    }

    function filter() {
        $.ajax({
            url: "{{ url('filter') }}",
            type: 'POST',
            dataType: 'json',
            data: $('#form_filter').serialize(),
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: (response) => {
                $('#product-wrapper').empty()
                bindView(response.data)
            }
        });
    }

    let newdata = []
    let iterationCart = 0
    let iterationBuy = 0
    function bindView(data) {
        path = data.path
        currentPage = data.current_page

        $('#loader').hide()
        if (data.data != null && data.data.length != 0) {
            $('#result-not-found').hide()
            data.data.forEach((product, index) => {
                newdata.push(product);
                if(currentPage != 1){
                    index = index + (4 * (currentPage-1))
                    console.log('true', index)
                }
                let template = `
                            <div class="card card-shadow">
                                <figure class="card-img-top overlay-hover overlay">
                                    <img class="overlay-figure"
                                        src="{{ asset('storage/app/public/photo') }}/` + product.images[0].path + `">
                                    <figcaption class="overlay-panel overlay-background overlay-fade text-center vertical-align">
                                        <a class="btn btn-inverse" href="{{ url('product') }}/` + product.id + `"><b> Lihat Detail </b></a>
                                    </figcaption>
                                </figure>
                                <div class="card-block table-responsive">
                                    <h4 class="card-title text-center" style="font-size: 1rem; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">` + product.nama + `</h4>
                                    <p class="text-center" style="color: #fb8b34; font-weight: bold">Rp ` + product.harga.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1.") + `</p>
                            </div>
                            <div class="card-block text-center div_card_beli my-cart-btn" style=" padding-top: 5px; col-lg-2">   
                                <div class="input-group bootstrap-touchspin bootstrap-touchspin-injected">
                                    <input type="text" class="form-control" id="qty" data-plugin="TouchSpin" data-min="1" data-max="1000000000" data-stepinterval="50" data-maxboostedstep="10000000" value="1" />
                                        <span class="input-group-text">Stok<b id="data-stock"></b></span>
                                    @if (Auth::check())
                                        <button type="button" class="btn btn-md btn-round add-to-cart"
                                            style="background: #fb8b34; color: white; margin-left: 10px; font-weight: bold" data-id="${ index }">
                                            <a class="icon md-shopping-cart" aria-hidden="true"></a>
                                        </button>
                                        <button type="button" class="btn btn-md btn-round buyitem"
                                            style="background: #3f51b5; color: white; margin-left: 10px; font-weight: bold" data-target="#purchaseOrder"
                                            data-toggle="modal" data-id="${ index }">
                                            Beli
                                        </button>
                                    @else
                                        <a href="{{ url('/login') }}" class="btn btn-md btn-round"
                                            style="background: #fb8b34; color: white; margin-left: 10px; font-weight: bold">
                                            <i class="icon md-shopping-cart" aria-hidden="true"></i>
                                        </a>
                                        <a href="{{ url('/login') }}" class="btn btn-md btn-round"
                                            style="background: #3f51b5; color: white; margin-left: 10px; font-weight: bold">
                                            Beli
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </div>`;
                $('#product-wrapper').append(template);
            })
        } else {
            let template = `
                <div class="panel text-center" id="result-not-found">
                    <div class="panel-body" style="background-color: #f1f4f5;">
                        <div class="vertical-align text-center" data-animsition-in="fade-in" data-animsition-out="fade-out" style="background-color: #f1f4f5;">
                            <div class="vertical-align-middle">
                                <header>
                                    <h1 class="animation-slide-top" style="font-size: 7rem;"> &#129488 </h1>
                                    <br>
                                    <p style="font-size: 1.5rem;">Data yang anda cari tidak ada !</p>
                                </header>
                            </div>
                        </div>
                    </div>
                </div>`;
            $('#product-wrapper').before(template);
        }

        if (data.current_page == data.last_page) {
            $('#load-more').hide()
        } else {
            $('#load-more').show()
        }

        $('#catatan').text(data.data[0].catatan)

    }
    $(document).on('click', '.buyitem', function() {
        const $parent = $($(this).parent())
        qty = $($parent.children()[0]).val()

        const product = newdata[$(this).data('id')]
        var template = `
                    <tr style="text-align: center";>
                        <td>1.</td>
                        <td><a class="waves-effect waves-light waves-round" style="color: blue">${ product.nama }</a></td>
                        <td><input type="text" class="form-control qty" style="text-center" id="catatan" value=""/></td>
                        <td>Rp ${ product.harga.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1.") }</td>
                        <td>${ qty }</td>
                        <td>Rp ${ qty * product.harga }</td>
                    </tr>`

        let total = qty * product.harga

        $('.pembelian-content').empty()
        $('.pembelian-content').append(template)
        $('#data-harga').html(`Rp ${ total }`.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1."))
        $('#btn-buy-item').data('id', $(this).data('id'))
        $('#btn-buy-item').click(function() {
            var arr = []
            var index = $(this).data('id')
            var param = newdata[index]
            param.qty = qty
            arr.push(param)
            buy(arr, total)
        })
    })

    $(document).on('click', '.add-to-cart', function() {
        const $parent = $($(this).parent())
        console.log($parent)
        qty = $($parent.children()[0]).val()
        product = newdata[$(this).data('id')]
        id = product.id
        console.log($(this).data('id'))

        addToChart(product, qty, currentPage, id)
    });

    function move(path, id) {
        $('#loader').show()

        var json = $.getJSON({
            url: `${path}?page=${id}`,
            type: 'GET',
            async: true
        }).then((res) => {
            const {
                data
            } = res
            if (carts == null) {
                carts = []
            }

            bindView(data)
        });
    }
</script>
@endsection