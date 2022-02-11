@extends('layouts.backsite')

{{-- set title --}}
@section('title', 'Rate')

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
                    <h3 class="content-header-title mb-0 d-inline-block">Rate</h3>
                    <div class="row breadcrumbs-top d-inline-block">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('backsite.dashboard.index') }}">Dashboard</a></li>
                                <li class="breadcrumb-item active">Rate</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>

            {{-- add card --}}
            @can('rate_create')
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
                                            
                                            <form class="form form-horizontal" action="{{ route('backsite.rate.store') }}" method="POST" enctype="multipart/form-data">

                                                @csrf

                                                <div class="form-body">
                                                    <div class="form-section">
                                                        <p>Please complete the input <code>required</code>, before you click the submit button.</p>
                                                    </div>

                                                    <div class="form-group row {{ $errors->has('group_rate_id') ? 'has-error' : '' }}">
                                                        <label class="col-md-3 label-control">Group Rate <code style="color:red;">required</code></label>
                                                        <div class="col-md-9 mx-auto">
                                                            <select name="group_rate_id" 
                                                                    id="group_rate_id" 
                                                                    class="form-control select2" required>
                                                                    <option value="{{ '' }}" disabled selected>Choose</option>
                                                                    
                                                                    @forelse ($group_rates as $id => $group_rate)
                                                                        <option value="{{ $id }}">{{ $group_rate }}</option>
                                                                    @empty
                                                                        {{-- Not Found --}}
                                                                    @endforelse

                                                            </select>

                                                            @if($errors->has('group_rate_id'))
                                                                <p style="font-style: bold; color: red;">{{ $errors->first('group_rate_id') }}</p>
                                                            @endif
                                                        </div>
                                                    </div>

                                                    <div class="form-group row">
                                                        <label class="col-md-3 label-control" for="power">Power <code style="color:red;">required</code></label>
                                                        <div class="col-md-9 mx-auto">
                                                            <input type="text" id="power" name="power" class="form-control" placeholder="example used to explain in power this data" value="{{old('power')}}" autocomplete="off" data-inputmask="'alias': 'numeric', 'groupSeparator': ',', 'autoGroup': true, 'digits': 0, 'digitsOptional': 0, 'suffix': ' VA', 'placeholder': '0'" required>

                                                            @if($errors->has('power'))
                                                                <p style="font-style: bold; color: red;">{{ $errors->first('power') }}</p>
                                                            @endif
                                                        </div>
                                                    </div>

                                                    <div class="form-group row">
                                                        <label class="col-md-3 label-control" for="rate_power">Rate Power / KWh <code style="color:red;">required</code></label>
                                                        <div class="col-md-9 mx-auto">
                                                            <input type="text" id="rate_power" name="rate_power" class="form-control" placeholder="example used to explain in power rate this data" value="{{old('rate_power')}}" autocomplete="off" data-inputmask="'alias': 'numeric', 'groupSeparator': ',', 'autoGroup': true, 'digits': 0, 'digitsOptional': 0, 'prefix': 'IDR ', 'placeholder': '0'" required>

                                                            @if($errors->has('rate_power'))
                                                                <p style="font-style: bold; color: red;">{{ $errors->first('rate_power') }}</p>
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
            @can('rate_table')
                <div class="content-body">
                    <section id="table-home">
                        <!-- Zero configuration table -->
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h4 class="card-title">Rate List</h4>
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
                                                            <th>Group</th>
                                                            <th>Power</th>
                                                            <th>Rate Power / KWh</th>
                                                            <th style="text-align:center; width:150px;">Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @forelse($rates as $key => $rate)
                                                            <tr data-entry-id="{{ $rate->id }}">
                                                                <td>{{ date("d/m/Y H:i:s",strtotime($rate->created_at)) ?? '' }}</td>
                                                                <td>{{ $rate->code ?? '' }}</td>
                                                                <td>{{ $rate->group_rate->name ?? '' }}</td>
                                                                <td>{{ number_format($rate->power) ?? '' }}VA</td>
                                                                <td>Rp. {{ number_format($rate->rate_power) ?? '' }}</td>
                                                                <td class="text-center">

                                                                    <div class="btn-group mr-1 mb-1">
                                                                        <button type="button" class="btn btn-info btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action</button>
                                                                        <div class="dropdown-menu">
                                                                            @can('rate_show')
                                                                                <a href="#mymodal" 
                                                                                    data-remote="{{ route('backsite.rate.show', $rate->id) }}" 
                                                                                    data-toggle="modal" 
                                                                                    data-target="#mymodal" 
                                                                                    data-title="Rate Detail" 
                                                                                    class="dropdown-item">
                                                                                    Show
                                                                                </a>
                                                                            @endcan
                                                                            @can('rate_edit')
                                                                                <a class="dropdown-item" href="{{ route('backsite.rate.edit', $rate->id) }}">
                                                                                    Edit
                                                                                </a>
                                                                            @endcan
                                                                            @can('rate_delete')
                                                                                <form action="{{ route('backsite.rate.destroy', $rate->id) }}" method="POST" onsubmit="return confirm('Are you sure want to delete this data ?');">
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
                                                            <th>Group</th>
                                                            <th>Power</th>
                                                            <th>Rate Power / KWh</th>
                                                            <th style="text-align:center; width:150px;">Action</th>
                                                        </tr>
                                                    </tfoot>
                                                </table>
                                            </div>

                                            <hr>

                                            <div class="table-responsive">
                                                <div class="text-center mb-3">
                                                    @if ($rates->hasPages())
                                                        <h4 class="card-title">Pagination Page</h4>
                                                        <p class="mt-1"><code class="text-dark">Page {{ $rates->currentPage() }}</code> & <code>All data {{ $rates->total() }}</code></p>
                                                    @endif
                                                    <nav aria-label="Page navigation">
                                                        @if ($rates->hasPages())
                                                            <ul class="pagination justify-content-center pagination-round">

                                                                {{-- Previous Page Link --}}
                                                                @if ($rates->onFirstPage())
                                                                    <li class="page-item disabled">
                                                                        <a class="page-link" href="#" aria-label="Previous">
                                                                            <span aria-hidden="true"><i class="ft-chevron-left"></i></span>
                                                                            <span class="sr-only"><i class="ft-chevron-left"></i></span>
                                                                        </a>
                                                                    </li>
                                                                @else
                                                                    <li class="page-item">
                                                                        <a class="page-link" href="{{ $rates->previousPageUrl() }}" aria-label="Previous">
                                                                            <span aria-hidden="true"><i class="ft-chevron-left"></i></span>
                                                                            <span class="sr-only"><i class="ft-chevron-left"></i></span>
                                                                        </a>
                                                                    </li>
                                                                @endif

                                                                @if($rates->currentPage() > 2)
                                                                    <li class="page-item"><a class="page-link" href="{{ $rates->url(1) }}">1</a></li>
                                                                @endif

                                                                @if($rates->currentPage() > 3)
                                                                    <li class="page-item disabled"><a class="page-link" href="#">...</a></li>
                                                                @endif

                                                                @foreach(range(1, $rates->lastPage()) as $i)
                                                                    @if($i >= $rates->currentPage() - 1 && $i <= $rates->currentPage() + 1)
                                                                        @if ($i == $rates->currentPage())
                                                                            <li class="page-item active"><span class="page-link">{{ $i }}</span></li>
                                                                        @else
                                                                            <li class="page-item"><a class="page-link" href="{{ $rates->url($i) }}">{{ $i }}</a></li>
                                                                        @endif
                                                                    @endif
                                                                @endforeach

                                                                @if($rates->currentPage() < $rates->lastPage() - 3)
                                                                    <li class="page-item disabled"><a class="page-link" href="#">...</a></li>
                                                                @endif

                                                                @if($rates->currentPage() < $rates->lastPage() - 2)
                                                                    <li class="page-item"><a class="page-link" href="{{ $rates->url($rates->lastPage()) }}">{{ $rates->lastPage() }}</a></li>
                                                                @endif

                                                                {{-- Next Page Link --}}
                                                                @if ($rates->hasMorePages())
                                                                    <li class="page-item">
                                                                        <a class="page-link" href="{{ $rates->nextPageUrl() }}" aria-label="Next">
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