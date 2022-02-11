@extends('layouts.backsite')

{{-- set title --}}
@section('title', 'Edit - Customer Usage')

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
                    <h3 class="content-header-title mb-0 d-inline-block">Edit Customer Usage</h3>
                    <div class="row breadcrumbs-top d-inline-block">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="{{ route('backsite.dashboard.index') }}" onclick="return confirm('Are you sure close this page ?')">Dashboard</a>
                                </li>
                                <li class="breadcrumb-item">
                                    <a href="{{ route('backsite.customer_usage.index') }}" onclick="return confirm('Are you sure close this page ?')">Customer Usage</a>
                                </li>
                                <li class="breadcrumb-item active">Edit</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>

            {{-- forms --}}
            <div class="content-body"><!-- Basic form layout section start -->
                <section id="horizontal-form-layouts">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title" id="horz-layout-basic">Form Input</h4>
                                    <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                                    <div class="heading-elements">
                                        <ul class="list-inline mb-0">
                                            <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                                            <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="card-content collpase show">
                                    <div class="card-body">
                                        <div class="card-text">
                                            <p>Please complete the input <code>required</code>, before you click the submit button.</p>
                                        </div>
                                        <form class="form form-horizontal" action="{{ route("backsite.customer_usage.update", [$customer_usage->id]) }}" method="POST" enctype="multipart/form-data">

                                                @method('PUT')
                                                @csrf

                                                <div class="form-body">

                                                    <h4 class="form-section"><i class="fa fa-edit"></i> Form Customer Usage</h4>

                                                    <div class="form-group row {{ $errors->has('customer_id') ? 'has-error' : '' }}">
                                                        <label class="col-md-3 label-control">Customer <code style="color:red;">required</code></label>
                                                        <div class="col-md-9 mx-auto">
                                                            <select name="customer_id" 
                                                                    id="customer_id" 
                                                                    class="form-control select2" required>
                                                                    <option value="{{ '' }}" disabled selected>Choose</option>
                                                                    
                                                                    @forelse ($customers as $customer)
                                                                        <option value="{{ $customer->id }}" {{ $customer_usage->customer_id === $customer->id ? 'selected' : ''}}>{{ $customer->user->name }} | {{ $customer->code }}</option>
                                                                    @empty
                                                                        {{-- Not Found --}}
                                                                    @endforelse

                                                            </select>

                                                            @if($errors->has('customer_id'))
                                                                <p style="font-style: bold; color: red;">{{ $errors->first('customer_id') }}</p>
                                                            @endif
                                                        </div>
                                                    </div>

                                                    <div class="form-group row">
                                                        <label class="col-md-3 label-control" for="date_usage">Date Usage <code style="color:red;">required</code></label>
                                                        <div class="col-md-9 mx-auto">
                                                            <input type="text" id="date_usage" name="date_usage" class="form-control" placeholder="example used to explain in date_usage this data" value="{{old('date_usage') ?? $customer_usage->date_usage }}" data-inputmask-alias="datetime" data-inputmask-inputformat="dd/mm/yyyy" data-inputmask-placeholder="dd/mm/yyyy" autocomplete="off" required>

                                                            @if($errors->has('date_usage'))
                                                                <p style="font-style: bold; color: red;">{{ $errors->first('date_usage') }}</p>
                                                            @endif
                                                        </div>
                                                    </div>

                                                    <div class="form-group row">
                                                        <label class="col-md-3 label-control" for="start_meter">Start Meter <code style="color:red;">required</code></label>
                                                        <div class="col-md-9 mx-auto">
                                                            <input type="number" id="start_meter" name="start_meter" class="form-control" placeholder="example used to explain in start_meter this data" value="{{old('start_meter') ?? $customer_usage->start_meter }}" autocomplete="off" required>

                                                            @if($errors->has('start_meter'))
                                                                <p style="font-style: bold; color: red;">{{ $errors->first('start_meter') }}</p>
                                                            @endif
                                                        </div>
                                                    </div>

                                                    <div class="form-group row">
                                                        <label class="col-md-3 label-control" for="end_meter">End Meter <code style="color:red;">required</code></label>
                                                        <div class="col-md-9 mx-auto">
                                                            <input type="number" id="end_meter" name="end_meter" class="form-control" placeholder="example used to explain in end_meter this data" value="{{old('end_meter') ?? $customer_usage->end_meter}}" autocomplete="off" required>

                                                            @if($errors->has('end_meter'))
                                                                <p style="font-style: bold; color: red;">{{ $errors->first('end_meter') }}</p>
                                                            @endif
                                                        </div>
                                                    </div>

                                                    <div class="form-group row">
                                                        <label class="col-md-3 label-control" for="date_check">Date Check <code style="color:red;">required</code></label>
                                                        <div class="col-md-9 mx-auto">
                                                            <input type="text" id="date_check" name="date_check" class="form-control" placeholder="example used to explain in date_check this data" value="{{old('date_check') ?? $customer_usage->date_check}}" data-inputmask-alias="datetime" data-inputmask-inputformat="dd/mm/yyyy" data-inputmask-placeholder="dd/mm/yyyy" autocomplete="off" required>

                                                            @if($errors->has('date_check'))
                                                                <p style="font-style: bold; color: red;">{{ $errors->first('date_check') }}</p>
                                                            @endif
                                                        </div>
                                                    </div>

                                                </div>

                                                <div class="form-actions text-right">
                                                    <a href="{{ route('backsite.customer_usage.index') }}" style="width:120px;" class="btn bg-blue-grey text-white mr-1" onclick="return confirm('Are you sure want to close this page? , Any changes you make will not be saved.')">
                                                        <i class="ft-x"></i> Cancel
                                                    </a>
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

        $(function () {
            $('#date_usage').datetimepicker({
                format: 'DD/MM/YYYY'
            });

            $('#date_check').datetimepicker({
                format: 'DD/MM/YYYY'
            });
        });
    </script>

@endpush