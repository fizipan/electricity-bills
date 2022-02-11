@extends('layouts.backsite')

{{-- set title --}}
@section('title', 'Edit - User')

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
                    <h3 class="content-header-title mb-0 d-inline-block">Edit User</h3>
                    <div class="row breadcrumbs-top d-inline-block">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="{{ route('backsite.dashboard.index') }}" onclick="return confirm('Are you sure close this page ?')">Dashboard</a>
                                </li>
                                <li class="breadcrumb-item">
                                    <a href="{{ route('backsite.users.index') }}" onclick="return confirm('Are you sure close this page ?')">User</a>
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
                                        <form class="form form-horizontal" action="{{ route("backsite.users.update", [$user->id]) }}" method="POST" enctype="multipart/form-data">

                                                @method('PUT')
                                                @csrf

                                                <div class="form-body">

                                                    <h4 class="form-section"><i class="fa fa-edit"></i> Form User</h4>

                                                    <div class="form-group row">
                                                        <label class="col-md-3 label-control" for="name">Name <code style="color:red;">required</code></label>
                                                        <div class="col-md-9 mx-auto">
                                                            <input type="text" id="name" name="name" class="form-control" placeholder="example John Doe or Jane" value="{{ old('name', isset($user) ? $user->name : '') }}" autocomplete="off" required>

                                                            @if($errors->has('name'))
                                                                <p style="font-style: bold; color: red;">{{ $errors->first('name') }}</p>
                                                            @endif
                                                        </div>
                                                    </div>

                                                    <div class="form-group row">
                                                        <label class="col-md-3 label-control" for="email">Email <code style="color:red;">required</code></label>
                                                        <div class="col-md-9 mx-auto">
                                                            <input type="text" id="email" name="email" class="form-control" placeholder="example People@mail.com or Human@mail.com" value="{{ old('email', isset($user) ? $user->email : '') }}" autocomplete="off" data-inputmask="'alias': 'email'" required>

                                                            @if($errors->has('email'))
                                                                <p style="font-style: bold; color: red;">{{ $errors->first('email') }}</p>
                                                            @endif
                                                        </div>
                                                    </div>

                                                    <div class="form-group row">
                                                        <label class="col-md-3 label-control" for="mobile_phone">Mobile Phone <code style="color:green;">optional</code></label>
                                                        <div class="col-md-9 mx-auto">
                                                            <input type="text" id="mobile_phone" name="mobile_phone" class="form-control" placeholder="example +62 812 1234 5678" value="{{ old('mobile_phone', isset($detail_user) ? $detail_user->mobile_phone : '') }}" autocomplete="off" data-inputmask="'mask': '+99 999 9999 9999'">

                                                            @if($errors->has('mobile_phone'))
                                                                <p style="font-style: bold; color: red;">{{ $errors->first('mobile_phone') }}</p>
                                                            @endif
                                                        </div>
                                                    </div>

                                                    <div class="form-group row {{ $errors->has('permissions') ? 'has-error' : '' }}">
                                                        <label class="col-md-3 label-control">Role <code style="color:red;">required</code></label>
                                                        <div class="col-md-9 mx-auto">
                                                            <label for="roles">
                                                                <span class="btn btn-warning btn-sm select-all">{{ 'Select all' }}</span>
                                                                <span class="btn btn-warning btn-sm deselect-all">{{ 'Deselect all' }}</span>
                                                            </label>
                                                        
                                                            <select name="roles[]" 
                                                                    id="roles" 
                                                                    class="form-control select2"
                                                                    multiple="multiple" required>
                                                                @foreach($roles as $id => $roles)
                                                                    <option value="{{ $id }}" {{ (in_array($id, old('roles', [])) || isset($user) && $user->roles->contains($id)) ? 'selected' : '' }}>{{ $roles }}</option>
                                                                @endforeach
                                                            </select>

                                                            @if($errors->has('roles'))
                                                                <p style="font-style: bold; color: red;">{{ $errors->first('roles') }}</p>
                                                            @endif
                                                        </div>
                                                    </div>
                                                    
                                                    <div class="form-group row">
                                                        <label class="col-md-3 label-control" for="address">address <code style="color:green;">optional</code></label>
                                                        <div class="col-md-9 mx-auto">
                                                            <textarea style="resize: none;" id="address" name="address" class="form-control" rows="8" placeholder="example used to explain in more detail what this data is for." autocomplete="off">{{ old('address', isset($detail_user) ? $detail_user->address : '') }}</textarea>
    
                                                            @if($errors->has('address'))
                                                                <p style="font-style: bold; color: red;">{{ $errors->first('address') }}</p>
                                                            @endif
                                                        </div>
                                                    </div>

                                                    <div class="form-group row">
                                                        <label class="col-md-3 label-control" for="information">Information <code style="color:green;">optional</code></label>
                                                        <div class="col-md-9 mx-auto">
                                                            <textarea style="resize: none;" id="information" name="information" class="form-control" rows="8" placeholder="example used to explain in more detail what this data is for." autocomplete="off">{{ old('information', isset($detail_user) ? $detail_user->information : '') }}</textarea>
    
                                                            @if($errors->has('information'))
                                                                <p style="font-style: bold; color: red;">{{ $errors->first('information') }}</p>
                                                            @endif
                                                        </div>
                                                    </div>

                                                    <div class="form-group row {{ $errors->has('status') ? 'has-error' : '' }}">
                                                        <label class="col-md-3 label-control">Status <code style="color:red;">required</code></label>
                                                        <div class="col-md-9 mx-auto">
                                                            <select name="status" 
                                                                    id="status" 
                                                                    class="form-control select2" required>
                                                                    <option value="{{ '' }}" disabled selected>Choose</option>
                                                                    <option value="{{ 1 }}" {{ $user->detail_users->status == 1 ? 'selected' : '' }}>{{ 'Active' }}</option>
                                                                    <option value="{{ 0 }}" {{ $user->detail_users->status == 0 ? 'selected' : '' }}>{{ 'Suspend' }}</option>
                                                            </select>

                                                            @if($errors->has('status'))
                                                                <p style="font-style: bold; color: red;">{{ $errors->first('status') }}</p>
                                                            @endif
                                                        </div>
                                                    </div>

                                                </div>

                                                <div class="form-actions text-right">
                                                    <a href="{{ route('backsite.users.index') }}" style="width:120px;" class="btn bg-blue-grey text-white mr-1" onclick="return confirm('Are you sure want to close this page? , Any changes you make will not be saved.')">
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


@push('after-script')

    <script>
        jQuery(document).ready(function($){
            $('.select-all').click(function () {
                let $select2 = $(this).parent().siblings('.select2')
                $select2.find('option').prop('selected', 'selected')
                $select2.trigger('change')
            })

            $('.deselect-all').click(function () {
                let $select2 = $(this).parent().siblings('.select2')
                $select2.find('option').prop('selected', '')
                $select2.trigger('change')
            })
        });
    </script>

@endpush