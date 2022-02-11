@extends('layouts.backsite')

{{-- set title --}}
@section('title', 'Customer')

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
                    <h3 class="content-header-title mb-0 d-inline-block">Customer</h3>
                    <div class="row breadcrumbs-top d-inline-block">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('backsite.dashboard.index') }}">Dashboard</a></li>
                                <li class="breadcrumb-item active">Customer</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>

            {{-- add card --}}
            @can('customer_create')
                <div class="content-body">
                    <section id="add-home">
                        <div class="row">
                            <div class="col-12">

                                <div class="card">
                                    <div class="card-header bg-success text-white">
                                        <a data-action="collapse">
                                            <h4 class="card-title text-white">Add Data</h4>
                                            <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
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
                                            
                                            <form class="form form-horizontal" action="{{ route('backsite.customer.store') }}" method="POST" enctype="multipart/form-data">

                                                @csrf

                                                <div class="form-body">
                                                    <div class="form-section">
                                                        <p>Please complete the input <code>required</code>, before you click the submit button.</p>
                                                    </div>

                                                    <div class="form-group row">
                                                        <label class="col-md-3 label-control" for="name">Name <code style="color:red;">required</code></label>
                                                        <div class="col-md-9 mx-auto">
                                                            <input type="text" id="name" name="name" class="form-control" placeholder="example John Doe or Jane" value="{{old('name')}}" autocomplete="off" required>

                                                            @if($errors->has('name'))
                                                                <p style="font-style: bold; color: red;">{{ $errors->first('name') }}</p>
                                                            @endif
                                                        </div>
                                                    </div>

                                                    <div class="form-group row">
                                                        <label class="col-md-3 label-control" for="email">Email <code style="color:red;">required</code></label>
                                                        <div class="col-md-9 mx-auto">
                                                            <input type="text" id="email" name="email" class="form-control" placeholder="example People@mail.com or Human@mail.com" value="{{old('email')}}" autocomplete="off" data-inputmask="'alias': 'email'" required>

                                                            @if($errors->has('email'))
                                                                <p style="font-style: bold; color: red;">{{ $errors->first('email') }}</p>
                                                            @endif
                                                        </div>
                                                    </div>
                                                    
                                                    <div class="form-group row">
                                                        <label class="col-md-3 label-control" for="mobile_phone">Mobile Phone <code style="color:green;">optional</code></label>
                                                        <div class="col-md-9 mx-auto">
                                                            <input type="text" id="mobile_phone" name="mobile_phone" class="form-control" placeholder="example +62 812 1234 5678" value="{{old('mobile_phone')}}" autocomplete="off" data-inputmask="'mask': '+99 999 9999 9999'">

                                                            @if($errors->has('mobile_phone'))
                                                                <p style="font-style: bold; color: red;">{{ $errors->first('mobile_phone') }}</p>
                                                            @endif
                                                        </div>
                                                    </div>

                                                    <div class="form-group row {{ $errors->has('rate_id') ? 'has-error' : '' }}">
                                                        <label class="col-md-3 label-control">Rate <code style="color:red;">required</code></label>
                                                        <div class="col-md-9 mx-auto">
                                                            <select name="rate_id" 
                                                                    id="rate_id" 
                                                                    class="form-control select2" required>
                                                                    <option value="{{ '' }}" disabled selected>Choose</option>
                                                                    
                                                                    @forelse ($rates as $id => $rate)
                                                                        <option value="{{ $id }}">{{ $rate }}</option>
                                                                    @empty
                                                                        {{-- Not Found --}}
                                                                    @endforelse

                                                            </select>

                                                            @if($errors->has('rate_id'))
                                                                <p style="font-style: bold; color: red;">{{ $errors->first('rate_id') }}</p>
                                                            @endif
                                                        </div>
                                                    </div>

                                                    <div class="form-group row">
                                                        <label class="col-md-3 label-control" for="address">Address <code style="color:green;">optional</code></label>
                                                        <div class="col-md-9 mx-auto">
                                                            <textarea style="resize: none;" id="address" name="address" class="form-control" rows="8" placeholder="example used to explain in address this data" autocomplete="off">{{old('address')}}</textarea>
    
                                                            @if($errors->has('address'))
                                                                <p style="font-style: bold; color: red;">{{ $errors->first('address') }}</p>
                                                            @endif
                                                        </div>
                                                    </div>

                                                </div>

                                                <div class="form-actions text-right">
                                                    <button type="submit" style="width:120px;" class="btn btn-cyan" onclick="return confirm('Are you sure want to save this data ?')">
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
            @can('customer_table')
                <div class="content-body">
                    <section id="table-home">
                        <!-- Zero configuration table -->
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h4 class="card-title">Customer List</h4>
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
                                                            <th>Code</th>
                                                            <th>Name</th>
                                                            <th>No Meter</th>
                                                            <th>Rate Code</th>
                                                            <th style="text-align:center; width:150px;">Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @forelse($customers as $key => $customer)
                                                            <tr data-entry-id="{{ $customer->id }}">
                                                                <td>{{ date("d/m/Y H:i:s",strtotime($customer->created_at)) ?? '' }}</td>
                                                                <td>{{ $customer->code ?? '' }}</td>
                                                                <td>{{ $customer->user->name ?? '' }}</td>
                                                                <td>{{ $customer->no_meter ?? '' }}</td>
                                                                <td>{{ $customer->rate->code ?? '' }}</td>
                                                                <td class="text-center">

                                                                    <div class="btn-group mr-1 mb-1">
                                                                        <button type="button" class="btn btn-info btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action</button>
                                                                        <div class="dropdown-menu">
                                                                            @can('customer_show')
                                                                                <a href="#mymodal" 
                                                                                    data-remote="{{ route('backsite.customer.show', $customer->id) }}" 
                                                                                    data-toggle="modal" 
                                                                                    data-target="#mymodal" 
                                                                                    data-title="customer Detail" 
                                                                                    class="dropdown-item">
                                                                                    Show
                                                                                </a>
                                                                            @endcan
                                                                            @can('customer_edit')
                                                                                <a class="dropdown-item" href="{{ route('backsite.customer.edit', $customer->id) }}">
                                                                                    Edit
                                                                                </a>
                                                                            @endcan
                                                                            @can('customer_delete')
                                                                                <form action="{{ route('backsite.customer.destroy', $customer->id) }}" method="POST" onsubmit="return confirm('Are you sure want to delete this data ?');">
                                                                                    <input type="hidden" name="_method" value="DELETE">
                                                                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                                                    <input type="submit" class="dropdown-item" value="Delete">
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
                                                            <th>Code</th>
                                                            <th>Name</th>
                                                            <th>No Meter</th>
                                                            <th>Rate Code</th>
                                                            <th style="text-align:center; width:150px;">Action</th>
                                                        </tr>
                                                    </tfoot>
                                                </table>
                                            </div>

                                            <hr>

                                            <div class="table-responsive">
                                                <div class="text-center mb-3">
                                                    @if ($customers->hasPages())
                                                        <h4 class="card-title">Pagination Page</h4>
                                                        <p class="mt-1"><code class="text-dark">Page {{ $customers->currentPage() }}</code> & <code>All data {{ $customers->total() }}</code></p>
                                                    @endif
                                                    <nav aria-label="Page navigation">
                                                        @if ($customers->hasPages())
                                                            <ul class="pagination justify-content-center pagination-round">

                                                                {{-- Previous Page Link --}}
                                                                @if ($customers->onFirstPage())
                                                                    <li class="page-item disabled">
                                                                        <a class="page-link" href="#" aria-label="Previous">
                                                                            <span aria-hidden="true"><i class="ft-chevron-left"></i></span>
                                                                            <span class="sr-only"><i class="ft-chevron-left"></i></span>
                                                                        </a>
                                                                    </li>
                                                                @else
                                                                    <li class="page-item">
                                                                        <a class="page-link" href="{{ $customers->previousPageUrl() }}" aria-label="Previous">
                                                                            <span aria-hidden="true"><i class="ft-chevron-left"></i></span>
                                                                            <span class="sr-only"><i class="ft-chevron-left"></i></span>
                                                                        </a>
                                                                    </li>
                                                                @endif

                                                                @if($customers->currentPage() > 2)
                                                                    <li class="page-item"><a class="page-link" href="{{ $customers->url(1) }}">1</a></li>
                                                                @endif

                                                                @if($customers->currentPage() > 3)
                                                                    <li class="page-item disabled"><a class="page-link" href="#">...</a></li>
                                                                @endif

                                                                @foreach(range(1, $customers->lastPage()) as $i)
                                                                    @if($i >= $customers->currentPage() - 1 && $i <= $customers->currentPage() + 1)
                                                                        @if ($i == $customers->currentPage())
                                                                            <li class="page-item active"><span class="page-link">{{ $i }}</span></li>
                                                                        @else
                                                                            <li class="page-item"><a class="page-link" href="{{ $customers->url($i) }}">{{ $i }}</a></li>
                                                                        @endif
                                                                    @endif
                                                                @endforeach

                                                                @if($customers->currentPage() < $customers->lastPage() - 3)
                                                                    <li class="page-item disabled"><a class="page-link" href="#">...</a></li>
                                                                @endif

                                                                @if($customers->currentPage() < $customers->lastPage() - 2)
                                                                    <li class="page-item"><a class="page-link" href="{{ $customers->url($customers->lastPage()) }}">{{ $customers->lastPage() }}</a></li>
                                                                @endif

                                                                {{-- Next Page Link --}}
                                                                @if ($customers->hasMorePages())
                                                                    <li class="page-item">
                                                                        <a class="page-link" href="{{ $customers->nextPageUrl() }}" aria-label="Next">
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