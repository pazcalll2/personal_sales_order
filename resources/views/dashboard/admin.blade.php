@extends('app')

@section('css')
    <link rel="stylesheet" href="{{ asset('themeforest/page-base/examples/css/widgets/statistics.css') }}">
@endsection

@section('page')
    <div class="page-content">
        <div class="row">
            <div class="col-xl-8 col-lg-12">
                <div class="row">
                    <div class="col-lg-6">
                        <!-- Card -->
                        <div class="card p-30 flex-row justify-content-between">
                            <div class="white">
                                <i class="icon icon-circle icon-2x md-accounts bg-red-600" aria-hidden="true"></i>
                            </div>
                            <div class="counter counter-md counter text-right">
                                <div class="counter-number-group">
                                    <span
                                        class="counter-number">{{ App\User::where('group_id', 'AGENT')->get()->count() }}</span>
                                    <span class="counter-number-related text-capitalize">Agent</span>
                                </div>
                                <div class="counter-label text-capitalize font-size-16">Di Seluruh indonesia</div>
                            </div>
                        </div>
                        <!-- End Card -->
                    </div>

                    <div class="col-lg-6">
                        <!-- Card -->
                        <div class="card p-30 flex-row justify-content-between">
                            <div class="counter counter-md text-left">
                                <div class="counter-number-group">
                                    <span
                                        class="counter-number">{{ App\User::where('group_id', 'CUSTOMER')->get()->count() }}</span>
                                    <span class="counter-number-related text-capitalize">customer</span>
                                </div>
                                <div class="counter-label text-capitalize font-size-16">Di seluruh Indonesia</div>
                            </div>
                            <div class="white">
                                <i class="icon icon-circle icon-2x md-accounts bg-blue-600" aria-hidden="true"></i>
                            </div>
                        </div>
                        <!-- End Card -->
                    </div>

                    <div class="col-lg-6">
                        <!-- Card -->
                        <div class="card card-block p-30">
                            <div class="counter counter-md text-left">
                                <div class="counter-label text-uppercase mb-5">Order pada 2021</div>
                                <div class="counter-number-group mb-10">
                                    <span class="counter-number">12,657</span>
                                </div>
                                <div class="counter-label">
                                    <div class="progress progress-xs mb-10">
                                        <div class="progress-bar progress-bar-info bg-blue-600" aria-valuenow="70.3"
                                            aria-valuemin="0" aria-valuemax="100" style="width: 70.3%" role="progressbar">
                                            <span class="sr-only">70.3%</span>
                                        </div>
                                    </div>
                                    <div class="counter counter-sm text-left">
                                        <div class="counter-number-group">
                                            <span class="counter-icon blue-600 mr-5"><i class="md-trending-up"></i></span>
                                            <span class="counter-number">38%</span>
                                            <span class="counter-number-related">more than last month</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- End Card -->
                    </div>

                    <div class="col-lg-6">
                        <!-- Card -->
                        <div class="card card-block p-30">
                            <div class="counter counter-md text-left">
                                <div class="counter-label text-uppercase mb-5">Pending Order</div>
                                <div class="counter-number-group mb-10">
                                    <span class="counter-number">2,381</span>
                                </div>
                                <div class="counter-label">
                                    <div class="progress progress-xs mb-5">
                                        <div class="progress-bar progress-bar-info bg-red-600" aria-valuenow="20.3"
                                            aria-valuemin="0" aria-valuemax="100" style="width: 20.3%" role="progressbar">
                                            <span class="sr-only">20.3%</span>
                                        </div>
                                    </div>
                                    <div class="counter counter-sm text-left">
                                        <div class="counter-number-group">
                                            <span class="counter-icon red-600 mr-5"><i class="md-trending-down"></i></span>
                                            <span class="counter-number">14%</span>
                                            <span class="counter-number-related">less than last month</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- End Card -->
                    </div>
                </div>
            </div>

            <div class="col-xl-2 col-md-6">
                <!-- Card -->
                <div class="card card-block p-30 bg-orange-600 text-center vertical-align h-350">
                    <div class="counter counter-lg counter-inverse vertical-align-middle">
                        <span class="counter-number"> {{ App\Product::all()->count() }} </span>
                        <div class="counter-label text-capitalize">Produk</div>
                    </div>
                </div>
                <!-- End Card -->
            </div>
            <div class="col-xl-2 col-md-6">
                <!-- Card -->
                <div class="card card-block p-30 bg-green-600 text-center vertical-align h-350">
                    <div class="counter counter-lg counter-inverse vertical-align-middle">
                        <span class="counter-number"> {{ App\Category::all()->count() }} </span>
                        <div class="counter-label text-capitalize">Kategori</div>
                    </div>
                </div>
                <!-- End Card -->
            </div>
        </div>
    </div>
@endsection
