@extends('layouts.backsite')

{{-- set title --}}
@section('title', 'Edit - Rate')

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
                    <h3 class="content-header-title mb-0 d-inline-block">Edit Rate</h3>
                    <div class="row breadcrumbs-top d-inline-block">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="{{ route('backsite.dashboard.index') }}" onclick="return confirm('Are you sure close this page ?')">Dashboard</a>
                                </li>
                                <li class="breadcrumb-item">
                                    <a href="{{ route('backsite.rate.index') }}" onclick="return confirm('Are you sure close this page ?')">User</a>
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
                                        <form class="form form-horizontal" action="{{ route("backsite.rate.update", [$rate->id]) }}" method="POST" enctype="multipart/form-data">

                                                @method('PUT')
                                                @csrf

                                                <div class="form-body">

                                                    <h4 class="form-section"><i class="fa fa-edit"></i> Form User</h4>

                                                    <div class="form-group row {{ $errors->has('group_rate_id') ? 'has-error' : '' }}">
                                                        <label class="col-md-3 label-control">Group Rate <code style="color:red;">required</code></label>
                                                        <div class="col-md-9 mx-auto">
                                                            <select name="group_rate_id" 
                                                                    id="group_rate_id" 
                                                                    class="form-control select2" required>
                                                                    <option value="{{ '' }}" disabled selected>Choose</option>
                                                                    
                                                                    @forelse ($group_rates as $id => $group_rate)
                                                                        <option value="{{ $id }}" {{ $rate->group_rate_id === $id ? 'selected' : '' }}>{{ $group_rate }}</option>
                                                                    @empty
                                                                        {{-- Not Found --}}
                                                                    @endforelse

                                                            </select>

                                                            @if($errors->has('group_user_id'))
                                                                <p style="font-style: bold; color: red;">{{ $errors->first('group_user_id') }}</p>
                                                            @endif
                                                        </div>
                                                    </div>

                                                    <div class="form-group row">
                                                        <label class="col-md-3 label-control" for="power">Power <code style="color:red;">required</code></label>
                                                        <div class="col-md-9 mx-auto">
                                                            <input type="text" id="power" name="power" class="form-control" placeholder="example used to explain in power this data" value="{{old('power', isset($rate) ? $rate->power : '')}}" autocomplete="off" data-inputmask="'alias': 'numeric', 'groupSeparator': ',', 'autoGroup': true, 'digits': 0, 'digitsOptional': 0, 'suffix': ' VA', 'placeholder': '0'" required>

                                                            @if($errors->has('power'))
                                                                <p style="font-style: bold; color: red;">{{ $errors->first('power') }}</p>
                                                            @endif
                                                        </div>
                                                    </div>

                                                    <div class="form-group row">
                                                        <label class="col-md-3 label-control" for="rate_power">Rate Power <code style="color:red;">required</code></label>
                                                        <div class="col-md-9 mx-auto">
                                                            <input type="text" id="rate_power" name="rate_power" class="form-control" placeholder="example used to explain in power rate this data" value="{{old('rate_power', isset($rate) ? $rate->rate_power : '')}}" autocomplete="off" data-inputmask="'alias': 'numeric', 'groupSeparator': ',', 'autoGroup': true, 'digits': 0, 'digitsOptional': 0, 'prefix': 'IDR ', 'placeholder': '0'" required>

                                                            @if($errors->has('rate_power'))
                                                                <p style="font-style: bold; color: red;">{{ $errors->first('rate_power') }}</p>
                                                            @endif
                                                        </div>
                                                    </div>

                                                </div>

                                                <div class="form-actions text-right">
                                                    <a href="{{ route('backsite.rate.index') }}" style="width:120px;" class="btn bg-blue-grey text-white mr-1" onclick="return confirm('Are you sure want to close this page? , Any changes you make will not be saved.')">
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