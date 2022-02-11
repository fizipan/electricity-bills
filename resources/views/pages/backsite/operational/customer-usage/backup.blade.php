@extends('layouts.backsite')

{{-- set title --}}
@section('title', 'Customer Usage')

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
                    <h3 class="content-header-title mb-0 d-inline-block">Customer Usage</h3>
                    <div class="row breadcrumbs-top d-inline-block">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a
                                        href="{{ route('backsite.dashboard.index') }}">Dashboard</a></li>
                                <li class="breadcrumb-item active">Customer Usage</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>

            {{-- add card --}}
            @can('customer_usage_create')
                <div class="content-body">
                    <section id="add-home">
                        <div class="row">
                            <div class="col-12">

                                <div class="card">
                                    <div class="card-header bg-success text-white">
                                        <a data-action="collapse">
                                            <h4 class="card-title text-white">Add Data</h4>
                                            <a class="heading-elements-toggle"><i
                                                    class="la la-ellipsis-v font-medium-3"></i></a>
                                            <div class="heading-elements">
                                                <ul class="list-inline mb-0">
                                                    <li><a data-action="collapse"><i class="ft-plus"></i></a></li>
                                                    <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                                                </ul>
                                            </div>
                                        </a>
                                    </div>

                                    <div class="card-content collapse hide">
                                        <div class="card-body card-dashboard">

                                            <form class="form form-horizontal"
                                                action="{{ route('backsite.customer_usage.store') }}" method="POST"
                                                enctype="multipart/form-data">

                                                @csrf

                                                <div class="form-body">
                                                    <div class="form-section">
                                                        <p>Please complete the input <code>required</code>, before you click the
                                                            submit button.</p>
                                                    </div>

                                                    <div
                                                        class="form-group row {{ $errors->has('customer_id') ? 'has-error' : '' }}">
                                                        <label class="col-md-3 label-control">Customer <code
                                                                style="color:red;">required</code></label>
                                                        <div class="col-md-9 mx-auto">
                                                            <select name="customer_id" id="customer_id"
                                                                class="form-control select2" required>
                                                                <option value="{{ '' }}" disabled selected>Choose
                                                                </option>

                                                                @forelse ($customers as $customer)
                                                                    <option value="{{ $customer->id }}">
                                                                        {{ $customer->user->name }} | {{ $customer->code }}
                                                                    </option>
                                                                @empty
                                                                    {{-- Not Found --}}
                                                                @endforelse

                                                            </select>

                                                            @if ($errors->has('customer_id'))
                                                                <p style="font-style: bold; color: red;">
                                                                    {{ $errors->first('customer_id') }}</p>
                                                            @endif
                                                        </div>
                                                    </div>


                                                    <div class="form-group row">
                                                        <label class="col-md-3 label-control" for="date_usage">Date Usage <code
                                                                style="color:red;">required</code></label>
                                                        <div class="col-md-9 mx-auto">
                                                            <input type="text" id="date_usage" name="date_usage"
                                                                class="form-control"
                                                                placeholder="example used to explain in date_usage this data"
                                                                value="{{ old('date_usage') }}"
                                                                data-inputmask-alias="datetime"
                                                                data-inputmask-inputformat="dd/mm/yyyy"
                                                                data-inputmask-placeholder="dd/mm/yyyy" autocomplete="off"
                                                                required>

                                                            @if ($errors->has('date_usage'))
                                                                <p style="font-style: bold; color: red;">
                                                                    {{ $errors->first('date_usage') }}</p>
                                                            @endif
                                                        </div>
                                                    </div>

                                                    <div class="form-group row">
                                                        <label class="col-md-3 label-control" for="start_meter">Start Meter
                                                            <code style="color:red;">required</code></label>
                                                        <div class="col-md-9 mx-auto">
                                                            <input type="number" id="start_meter" name="start_meter"
                                                                class="form-control"
                                                                placeholder="example used to explain in start_meter this data"
                                                                value="{{ old('start_meter') }}" autocomplete="off" required>

                                                            @if ($errors->has('start_meter'))
                                                                <p style="font-style: bold; color: red;">
                                                                    {{ $errors->first('start_meter') }}</p>
                                                            @endif
                                                        </div>
                                                    </div>

                                                    <div class="form-group row">
                                                        <label class="col-md-3 label-control" for="end_meter">End Meter <code
                                                                style="color:red;">required</code></label>
                                                        <div class="col-md-9 mx-auto">
                                                            <input type="number" id="end_meter" name="end_meter"
                                                                class="form-control"
                                                                placeholder="example used to explain in end_meter this data"
                                                                value="{{ old('end_meter') }}" autocomplete="off" required>

                                                            @if ($errors->has('end_meter'))
                                                                <p style="font-style: bold; color: red;">
                                                                    {{ $errors->first('end_meter') }}</p>
                                                            @endif
                                                        </div>
                                                    </div>

                                                    <div class="form-group row">
                                                        <label class="col-md-3 label-control" for="date_check">Date Check <code
                                                                style="color:red;">required</code></label>
                                                        <div class="col-md-9 mx-auto">
                                                            <input type="text" id="date_check" name="date_check"
                                                                class="form-control"
                                                                placeholder="example used to explain in date_check this data"
                                                                value="{{ old('date_check') }}"
                                                                data-inputmask-alias="datetime"
                                                                data-inputmask-inputformat="dd/mm/yyyy"
                                                                data-inputmask-placeholder="dd/mm/yyyy" autocomplete="off"
                                                                required>

                                                            @if ($errors->has('date_check'))
                                                                <p style="font-style: bold; color: red;">
                                                                    {{ $errors->first('date_check') }}</p>
                                                            @endif
                                                        </div>
                                                    </div>

                                                </div>

                                                <div class="form-actions text-right">
                                                    <button type="submit" style="width:120px;" class="btn btn-cyan"
                                                        onclick="return confirm('Are you sure want to save this data ?')">
                                                        <i class="la la-check-square-o"></i> Submit
                                                    </button>
                                                </div>
                                            </form>

                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </section>
                </div>
            @endcan

            {{-- table card --}}
            @can('customer_usage_table')
                <div class="content-body">
                    <section id="table-home">
                        <!-- Zero configuration table -->
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h4 class="card-title">Customer Usage List</h4>
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
                                                <table
                                                    class="table table-striped table-bordered text-inputs-searching default-table">
                                                    <thead>
                                                        <tr>
                                                            <th>Date</th>
                                                            <th>Customer Code</th>
                                                            <th>Customer Name</th>
                                                            <th>Date Usage</th>
                                                            <th>Start Meter</th>
                                                            <th>End Meter</th>
                                                            <th>Date Check</th>
                                                            <th style="text-align:center; width:150px;">Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @forelse($customer_usage as $key => $usage)
                                                            <tr data-entry-id="{{ $usage->id }}">
                                                                <td>{{ date('d/m/Y H:i:s', strtotime($usage->created_at)) ?? '' }}
                                                                </td>
                                                                <td>{{ $usage->customer->code ?? '' }}</td>
                                                                <td>{{ $usage->customer->user->name ?? '' }}</td>
                                                                <td>{{ $usage->date_usage->format('F Y') ?? '' }}</td>
                                                                <td>{{ $usage->start_meter ?? '' }}</td>
                                                                <td>{{ $usage->end_meter ?? '' }}</td>
                                                                <td>{{ $usage->date_check->format('d, F Y') ?? '' }}</td>
                                                                <td class="text-center">

                                                                    <div class="btn-group mr-1 mb-1">
                                                                        <button type="button"
                                                                            class="btn btn-info btn-sm dropdown-toggle"
                                                                            data-toggle="dropdown" aria-haspopup="true"
                                                                            aria-expanded="false">Action</button>
                                                                        <div class="dropdown-menu">
                                                                            @can('customer_usage_show')
                                                                                <a href="#mymodal"
                                                                                    data-remote="{{ route('backsite.customer_usage.show', $usage->id) }}"
                                                                                    data-toggle="modal" data-target="#mymodal"
                                                                                    data-title="Customer Usage Detail"
                                                                                    class="dropdown-item">
                                                                                    Show
                                                                                </a>
                                                                            @endcan
                                                                            @can('customer_usage_edit')
                                                                                <a class="dropdown-item"
                                                                                    href="{{ route('backsite.customer_usage.edit', $usage->id) }}">
                                                                                    Edit
                                                                                </a>
                                                                            @endcan
                                                                            @can('customer_usage_delete')
                                                                                <form
                                                                                    action="{{ route('backsite.customer_usage.destroy', $usage->id) }}"
                                                                                    method="POST"
                                                                                    onsubmit="return confirm('Are you sure want to delete this data ?');">
                                                                                    <input type="hidden" name="_method"
                                                                                        value="DELETE">
                                                                                    <input type="hidden" name="_token"
                                                                                        value="{{ csrf_token() }}">
                                                                                    <input type="submit" class="dropdown-item"
                                                                                        value="Delete">
                                                                                </form>
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
                                                            <th>Customer Name</th>
                                                            <th>Date Usage</th>
                                                            <th>Start Meter</th>
                                                            <th>End Meter</th>
                                                            <th>Date Check</th>
                                                            <th style="text-align:center; width:150px;">Action</th>
                                                        </tr>
                                                    </tfoot>
                                                </table>
                                            </div>

                                            <hr>

                                            <div class="table-responsive">
                                                <div class="text-center mb-3">
                                                    @if ($customer_usage->hasPages())
                                                        <h4 class="card-title">Pagination Page</h4>
                                                        <p class="mt-1"><code class="text-dark">Page
                                                                {{ $customer_usage->currentPage() }}</code> & <code>All data
                                                                {{ $customer_usage->total() }}</code></p>
                                                    @endif
                                                    <nav aria-label="Page navigation">
                                                        @if ($customer_usage->hasPages())
                                                            <ul class="pagination justify-content-center pagination-round">

                                                                {{-- Previous Page Link --}}
                                                                @if ($customer_usage->onFirstPage())
                                                                    <li class="page-item disabled">
                                                                        <a class="page-link" href="#"
                                                                            aria-label="Previous">
                                                                            <span aria-hidden="true"><i
                                                                                    class="ft-chevron-left"></i></span>
                                                                            <span class="sr-only"><i
                                                                                    class="ft-chevron-left"></i></span>
                                                                        </a>
                                                                    </li>
                                                                @else
                                                                    <li class="page-item">
                                                                        <a class="page-link"
                                                                            href="{{ $customer_usage->previousPageUrl() }}"
                                                                            aria-label="Previous">
                                                                            <span aria-hidden="true"><i
                                                                                    class="ft-chevron-left"></i></span>
                                                                            <span class="sr-only"><i
                                                                                    class="ft-chevron-left"></i></span>
                                                                        </a>
                                                                    </li>
                                                                @endif

                                                                @if ($customer_usage->currentPage() > 2)
                                                                    <li class="page-item"><a class="page-link"
                                                                            href="{{ $customer_usage->url(1) }}">1</a></li>
                                                                @endif

                                                                @if ($customer_usage->currentPage() > 3)
                                                                    <li class="page-item disabled"><a class="page-link"
                                                                            href="#">...</a></li>
                                                                @endif

                                                                @foreach (range(1, $customer_usage->lastPage()) as $i)
                                                                    @if ($i >= $customer_usage->currentPage() - 1 && $i <= $customer_usage->currentPage() + 1)
                                                                        @if ($i == $customer_usage->currentPage())
                                                                            <li class="page-item active"><span
                                                                                    class="page-link">{{ $i }}</span>
                                                                            </li>
                                                                        @else
                                                                            <li class="page-item"><a
                                                                                    class="page-link"
                                                                                    href="{{ $customer_usage->url($i) }}">{{ $i }}</a>
                                                                            </li>
                                                                        @endif
                                                                    @endif
                                                                @endforeach

                                                                @if ($customer_usage->currentPage() < $customer_usage->lastPage() - 3)
                                                                    <li class="page-item disabled"><a class="page-link"
                                                                            href="#">...</a></li>
                                                                @endif

                                                                @if ($customer_usage->currentPage() < $customer_usage->lastPage() - 2)
                                                                    <li class="page-item"><a class="page-link"
                                                                            href="{{ $customer_usage->url($customer_usage->lastPage()) }}">{{ $customer_usage->lastPage() }}</a>
                                                                    </li>
                                                                @endif

                                                                {{-- Next Page Link --}}
                                                                @if ($customer_usage->hasMorePages())
                                                                    <li class="page-item">
                                                                        <a class="page-link"
                                                                            href="{{ $customer_usage->nextPageUrl() }}"
                                                                            aria-label="Next">
                                                                            <span aria-hidden="true"><i
                                                                                    class="ft-chevron-right"></i></span>
                                                                            <span class="sr-only"><i
                                                                                    class="ft-chevron-right"></i></span>
                                                                        </a>
                                                                    </li>
                                                                @else
                                                                    <li class="page-item disabled">
                                                                        <a class="page-link" href="#" aria-label="Next">
                                                                            <span aria-hidden="true"><i
                                                                                    class="ft-chevron-right"></i></span>
                                                                            <span class="sr-only"><i
                                                                                    class="ft-chevron-right"></i></span>
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
    <link rel="stylesheet"
        href="{{ asset('/back-design/third-party/datetimepicker/css/bootstrap-datetimepicker.min.css') }}">
@endpush

@push('after-script')

    <script src="{{ url('https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js') }}"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
    </script>

    <script src="{{ url('https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js') }}"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
    </script>

    <script src="{{ url('https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.21.0/moment.min.js') }}"
        type="text/javascript"></script>

    <script src="{{ asset('/back-design/third-party/datetimepicker/js/bootstrap-datetimepicker.min.js') }}"></script>

    <script>
        jQuery(document).ready(function($) {
            $('#mymodal').on('show.bs.modal', function(e) {
                var button = $(e.relatedTarget);
                var modal = $(this);

                modal.find('.modal-body').load(button.data("remote"));
                modal.find('.modal-title').html(button.data("title"));
            });
        });

        $(function() {
            $('#date_usage').datetimepicker({
                format: 'DD/MM/YYYY'
            });

            $('#date_check').datetimepicker({
                format: 'DD/MM/YYYY'
            });
        });

        $('.default-table').DataTable({
            "order": [],
            "paging": true,
            "lengthMenu": [
                [5, 10, 25, 50, 100, -1],
                [5, 10, 25, 50, 100, "All"]
            ],
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
