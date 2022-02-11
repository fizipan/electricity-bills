@extends('layouts.backsite')

{{-- set title --}}
@section('title', 'Transaction')

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
                    <h3 class="content-header-title mb-0 d-inline-block">Transaction</h3>
                    <div class="row breadcrumbs-top d-inline-block">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('backsite.dashboard.index') }}">Dashboard</a></li>
                                <li class="breadcrumb-item active">Transaction</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>

            {{-- table card --}}
            @can('transaction_table')
                <div class="content-body">
                    <section id="table-home">
                        <!-- Zero configuration table -->
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h4 class="card-title">Transaction List</h4>
                                        <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                                        <div class="heading-elements">
                                            <ul class="list-inline mb-0">
                                                <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                                                <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                                                <!-- <li><a data-action="close"><i class="ft-x"></i></a></li> -->
                                            </ul>
                                        </div>
                                    </div>
                                    
                                    <div class="card-content collapse show">
                                        <div class="card-body card-dashboard">

                                            <div class="table-responsive">
                                                <table class="table table-striped table-bordered text-inputs-searching default-table">
                                                    <thead>
                                                        <tr>
                                                            <th>Date</th>
                                                            <th>Customer Code</th>
                                                            <th>Start Meter</th>
                                                            <th>End Meter</th>
                                                            <th>Total Meter</th>
                                                            <th>Rate Power / KWh</th>
                                                            <th>Total Price</th>
                                                            <th style="text-align:center; width:80px;">Status</th>
                                                            <th style="text-align:center; width:150px;">Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @forelse($transactions as $key => $transaction)
                                                            <tr data-entry-id="{{ $transaction->id }}">
                                                                <td>{{ date("d/m/Y H:i:s",strtotime($transaction->created_at)) ?? '' }}</td>
                                                                <td>{{ $transaction->customer_usage->customer->code ?? '' }}</td>
                                                                <td>{{ $transaction->customer_usage->start_meter ?? '' }}</td>
                                                                <td>{{ $transaction->customer_usage->end_meter ?? '' }}</td>
                                                                <td>{{ $transaction->total_meter ?? '' }}</td>
                                                                <td>Rp. {{ number_format($transaction->customer_usage->customer->rate->rate_power) ?? '' }}</td>
                                                                <td>Rp. {{ number_format($transaction->total_price) ?? '' }}</td>
                                                                <td>
                                                                    @if (isset($transaction->status))
                                                                        @if ($transaction->status == 1)
                                                                            <span class="badge badge-danger">UNPAID</span>
                                                                        @elseif ($transaction->status == 2)
                                                                            <span class="badge badge-warning">WAITING</span>
                                                                        @else
                                                                            <span class="badge badge-success">PAID</span>
                                                                        @endif
                                                                    @else
                                                                        Not Found    
                                                                    @endif
                                                                </td>
                                                                <td class="text-center">

                                                                    <div class="btn-group mr-1 mb-1">
                                                                        <button type="button" class="btn btn-info btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action</button>
                                                                        <div class="dropdown-menu">
                                                                            @can('transaction_show')
                                                                                <a href="#mymodal" 
                                                                                    data-remote="{{ route('backsite.transaction.show', $transaction->id) }}" 
                                                                                    data-toggle="modal" 
                                                                                    data-target="#mymodal" 
                                                                                    data-title="Rate Detail" 
                                                                                    class="dropdown-item">
                                                                                    Show
                                                                                </a>
                                                                            @endcan
                                                                        </div>
                                                                    </div>

                                                                </td>
                                                            </tr>
                                                        @empty
                                                            {{-- not found --}}
                                                        @endforelse
                                                    </tbody>
                                                    <tfoot>
                                                        <tr>
                                                            <th>Date</th>
                                                            <th>Customer Code</th>
                                                            <th>Start Meter</th>
                                                            <th>End Meter</th>
                                                            <th>Total Meter</th>
                                                            <th>Rate Power / KWh</th>
                                                            <th>Total Price</th>
                                                            <th style="text-align:center; width:80px;">Status</th>
                                                            <th style="text-align:center; width:150px;">Action</th>
                                                        </tr>
                                                    </tfoot>
                                                </table>
                                            </div>

                                            <hr>

                                            <div class="table-responsive">
                                                <div class="text-center mb-3">
                                                    @if ($transactions->hasPages())
                                                        <h4 class="card-title">Pagination Page</h4>
                                                        <p class="mt-1"><code class="text-dark">Page {{ $transactions->currentPage() }}</code> & <code>All data {{ $transactions->total() }}</code></p>
                                                    @endif
                                                    <nav aria-label="Page navigation">
                                                        @if ($transactions->hasPages())
                                                            <ul class="pagination justify-content-center pagination-round">

                                                                {{-- Previous Page Link --}}
                                                                @if ($transactions->onFirstPage())
                                                                    <li class="page-item disabled">
                                                                        <a class="page-link" href="#" aria-label="Previous">
                                                                            <span aria-hidden="true"><i class="ft-chevron-left"></i></span>
                                                                            <span class="sr-only"><i class="ft-chevron-left"></i></span>
                                                                        </a>
                                                                    </li>
                                                                @else
                                                                    <li class="page-item">
                                                                        <a class="page-link" href="{{ $transactions->previousPageUrl() }}" aria-label="Previous">
                                                                            <span aria-hidden="true"><i class="ft-chevron-left"></i></span>
                                                                            <span class="sr-only"><i class="ft-chevron-left"></i></span>
                                                                        </a>
                                                                    </li>
                                                                @endif

                                                                @if($transactions->currentPage() > 2)
                                                                    <li class="page-item"><a class="page-link" href="{{ $transactions->url(1) }}">1</a></li>
                                                                @endif

                                                                @if($transactions->currentPage() > 3)
                                                                    <li class="page-item disabled"><a class="page-link" href="#">...</a></li>
                                                                @endif

                                                                @foreach(range(1, $transactions->lastPage()) as $i)
                                                                    @if($i >= $transactions->currentPage() - 1 && $i <= $transactions->currentPage() + 1)
                                                                        @if ($i == $transactions->currentPage())
                                                                            <li class="page-item active"><span class="page-link">{{ $i }}</span></li>
                                                                        @else
                                                                            <li class="page-item"><a class="page-link" href="{{ $transactions->url($i) }}">{{ $i }}</a></li>
                                                                        @endif
                                                                    @endif
                                                                @endforeach

                                                                @if($transactions->currentPage() < $transactions->lastPage() - 3)
                                                                    <li class="page-item disabled"><a class="page-link" href="#">...</a></li>
                                                                @endif

                                                                @if($transactions->currentPage() < $transactions->lastPage() - 2)
                                                                    <li class="page-item"><a class="page-link" href="{{ $transactions->url($transactions->lastPage()) }}">{{ $transactions->lastPage() }}</a></li>
                                                                @endif

                                                                {{-- Next Page Link --}}
                                                                @if ($transactions->hasMorePages())
                                                                    <li class="page-item">
                                                                        <a class="page-link" href="{{ $transactions->nextPageUrl() }}" aria-label="Next">
                                                                            <span aria-hidden="true"><i class="ft-chevron-right"></i></span>
                                                                            <span class="sr-only"><i class="ft-chevron-right"></i></span>
                                                                        </a>
                                                                    </li>
                                                                @else
                                                                    <li class="page-item disabled">
                                                                        <a class="page-link" href="#" aria-label="Next">
                                                                            <span aria-hidden="true"><i class="ft-chevron-right"></i></span>
                                                                            <span class="sr-only"><i class="ft-chevron-right"></i></span>
                                                                        </a>
                                                                    </li>
                                                                @endif

                                                            </ul>
                                                        @endif
                                                    </nav>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            @endcan

        </div>
    </div>
<!-- END: Content-->

@endsection

@push('after-style')
    <link rel="stylesheet" href="{{ asset('/back-design/third-party/datetimepicker/css/bootstrap-datetimepicker.min.css') }}">
@endpush

@push('after-script')

    <script src="{{ url('https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js') }}" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>

    <script src="{{ url('https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js') }}" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

    <script src="{{ url('https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.21.0/moment.min.js') }}" type="text/javascript"></script>

    <script src="{{ asset('/back-design/third-party/datetimepicker/js/bootstrap-datetimepicker.min.js') }}"></script>

    <script>
        jQuery(document).ready(function($){
            $('#mymodal').on('show.bs.modal', function(e){
                var button = $(e.relatedTarget);
                var modal = $(this);

                modal.find('.modal-body').load(button.data("remote"));
                modal.find('.modal-title').html(button.data("title"));
            });
        });

        $('.default-table').DataTable( {
            "order": [],
            "paging": true,
            "lengthMenu": [ [5, 10, 25, 50, 100, -1], [5, 10, 25, 50, 100, "All"] ],
            "pageLength": 10
        });
    </script>

    <div class="modal fade" id="mymodal" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"></h5>
                    <button class="btn close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <i class="fa fa-spinner fa spin"></i>
                </div>
            </div>
        </div>
    </div>

@endpush