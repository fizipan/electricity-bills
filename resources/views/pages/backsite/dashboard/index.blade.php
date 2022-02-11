@extends('layouts.backsite')

{{-- set title --}}
@section('title', ' Dashboard')

@section('content')
    <!-- BEGIN: Content-->
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="content-wrapper">

            {{-- error --}}
            @if ($errors->any())
                <div class="alert bg-danger alert-dismissible mb-2" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>

                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {{-- breadcumb --}}
            <div class="content-header row">
                <div class="content-header-left col-md-6 col-12 mb-2 breadcrumb-new">
                    <h3 class="content-header-title mb-0 d-inline-block">Dashboard</h3>
                    <div class="row breadcrumbs-top d-inline-block">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item active">Dashboard Activity</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            {{-- breadcumb --}}

            <div class="content-body">
                {{-- card statistic --}}
                <div class="row">

                    <div class="col-xl-4 col-lg-4 col-sm-6 col-12">
                        <div class="card bg-gradient-directional-info">
                            <div class="card-content">
                                <div class="card-body">
                                    <div class="media d-flex">
                                        <div class="media-body text-white text-left">
                                            <h3 class="text-white">{{ number_format($transaction) }}</h3>
                                            <span>Total Transaction</span>
                                        </div>
                                        <div class="align-self-center">
                                            <i class='text-white font-large-2 float-right bx bx-money bx-burst'></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-4 col-lg-4 col-sm-6 col-12">
                        <div class="card bg-gradient-directional-amber">
                            <div class="card-content">
                                <div class="card-body">
                                    <div class="media d-flex">
                                        <div class="media-body text-white text-left">
                                            <h3 class="text-white">{{ number_format($bill_paid) }}</h3>
                                            <span>Total Bill Paid</span>
                                        </div>
                                        <div class="align-self-center">
                                            <i class='text-white font-large-2 float-right bx bx-badge-check bx-burst'></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-4 col-lg-4 col-sm-6 col-12">
                        <div class="card bg-gradient-directional-purple">
                            <div class="card-content">
                                <div class="card-body">
                                    <div class="media d-flex">
                                        <div class="media-body text-white text-left">
                                            <h3 class="text-white">{{ number_format($bill_unpaid) }}</h3>
                                            <span>Total Bill Unpaid</span>
                                        </div>
                                        <div class="align-self-center">
                                            <i class='text-white font-large-2 float-right bx bx-x bx-burst'></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>
    <!-- END: Content-->

    <div class="sidenav-overlay"></div>
    <div class="drag-target"></div>

@endsection
