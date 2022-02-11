@extends('layouts.backsite')

{{-- set title --}}
@section('title', 'Profile')

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

            <div class="content-body">
                <!-- users edit start -->
                <section class="users-edit">
                    <div class="card">
                        <div class="card-content">
                            <div class="card-body">
                                <ul class="nav nav-tabs mb-2" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link d-flex align-items-center active" id="account-tab" data-toggle="tab" href="#account" aria-controls="account" role="tab" aria-selected="true">
                                            <i class='bx bx-user mr-25'></i><span class="d-none d-sm-block">Account</span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link d-flex align-items-center" id="security-tab" data-toggle="tab" href="#security" aria-controls="security" role="tab" aria-selected="false">
                                            <i class='bx bx-lock-open mr-25' ></i></i><span class="d-none d-sm-block">Security</span>
                                        </a>
                                    </li>
                                </ul>

                                <div class="tab-content">
                                    <div class="tab-pane active" id="account" aria-labelledby="account-tab" role="tabpanel">
                                        <!-- users edit media object start -->
                                        <div class="media mb-2">
                                            <img src=" 
                                                @if (auth()->user()->detail_users()->first()->photo != "" || auth()->user()->detail_users()->first()->photo != null) 

                                                    @if(File::exists('storage/'.substr(auth()->user()->detail_users()->first()->photo, strpos(auth()->user()->detail_users()->first()->photo, 'assets/'))))
                                                        
                                                        {{ auth()->user()->detail_users()->first()->photo }}
                                                    
                                                    @elseif(File::exists(str_replace(substr(auth()->user()->detail_users()->first()->photo, 0, strpos(auth()->user()->detail_users()->first()->photo, 'assets/')), 'storage/app/public/', auth()->user()->detail_users()->first()->photo)))

                                                        {{ url(str_replace(substr(auth()->user()->detail_users()->first()->photo, 0, strpos(auth()->user()->detail_users()->first()->photo, 'assets/')), 'storage/app/public/', auth()->user()->detail_users()->first()->photo)) }}

                                                    @else
                                                        {{ asset('/back-design/clients/default/user-profile.svg') }}
                                                    @endif

                                                @else 
                                                    {{ asset('/back-design/clients/default/user-profile.svg') }} 
                                                @endif " 
                                                alt="users avatar" class="users-avatar-shadow rounded-circle mr-2" height="64" width="64">
                                            
                                            <div id="image-holder"> </div>
                                            
                                            <div class="media-body">
                                                <h4 class="media-heading">Photo Profile</h4>
                                                <div class="col-12 px-0 d-flex">
                                                    <label class="btn btn-sm btn-primary mb-50 mb-sm-0 cursor-pointer mr-25" for="account-upload">Choose Photo</label>
                                                    
                                                    <form action="{{ route('backsite.upload.photo.profiles', [$user->id]) }}" method="POST" enctype="multipart/form-data">

                                                        @method('PUT')
                                                        @csrf

                                                        <input type="file" accept="image/*" id="account-upload" name="photo" hidden required>
                                                        @if($errors->has('name'))
                                                            <p style="font-style: bold; color: red;">{{ $errors->first('photo') }}</p>
                                                        @endif

                                                        <button type="submit" class="btn btn-sm bg-cyan text-white mr-25" onclick="return confirm('Are you sure want to update this photo ?')">Upload Photo Changes</button>
                                                    </form>
                                                    
                                                    <a href="{{ route('backsite.reset.photo.profiles', [$user->id]) }}" class="btn btn-sm btn-danger text-white" onclick="return confirm('Apakah anda ingin melakukan reset pada Foto Profile ini ?')">Reset</a>
                                                </div>
                                                <p class="text-muted mt-25"><small>Only for JPEG, SVG or PNG. Maximum size is 1 Megabyte</small></p>
                                            </div>
                                        </div>
                                        <!-- users edit media object ends -->

                                        <!-- users edit account form start -->
                                        <form action="{{ route("backsite.update.account.profiles", [$user->id]) }}" method="POST">

                                            @method('PUT')
                                            @csrf

                                            <div class="row">
                                                <div class="col-12 col-sm-6">
                                                    <div class="form-group">
                                                        <div class="controls">
                                                            <label>Name <code style="color:red;">required</code></label>
                                                            <input type="text" id="name" name="name" class="form-control" placeholder="example John Doe or Jane" value="{{$user->name}}" autocomplete="off" required data-validation-required-message="This name field is required">

                                                            @if($errors->has('name'))
                                                                <p style="font-style: bold; color: red;">{{ $errors->first('name') }}</p>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-12 col-sm-6">
                                                    <div class="form-group">
                                                        <div class="controls">
                                                            <label>Status <code style="color:red;">required</code></label>
                                                            <input type="text" class="form-control" value="{{ $detail_user->status == 1 ? 'Active' : 'Suspend' }}" readonly>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-12 col-sm-6">
                                                    <div class="form-group">
                                                        <div class="controls">
                                                            <label>Email <code style="color:red;">required</code></label>
                                                            <input type="email" id="email" name="email" class="form-control" placeholder="example People@mail.com or Human@mail.com" value="{{ $user->email ?? '' }}" autocomplete="off" data-inputmask="'alias': 'email'" required>

                                                            @if($errors->has('email'))
                                                                <p style="font-style: bold; color: red;">{{ $errors->first('email') }}</p>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-12 col-sm-6">
                                                    <div class="form-group">
                                                        <div class="controls">
                                                            <label>Mobile Phone <code style="color:green;">optional</code></label>
                                                            <input type="text" id="mobile_phone" name="mobile_phone" class="form-control" placeholder="example +62 812 1234 5678" value="{{ $detail_user->mobile_phone ?? '' }}" autocomplete="off" data-inputmask="'mask': '+99 999 9999 9999'">

                                                            @if($errors->has('mobile_phone'))
                                                                <p style="font-style: bold; color: red;">{{ $errors->first('mobile_phone') }}</p>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-12 col-sm-12">
                                                    <div class="form-group">
                                                        <div class="controls">
                                                            <label>Address <code style="color:green;">optional</code></label>
                                                            <textarea style="resize: none;" id="address" name="address" class="form-control" rows="8" placeholder="example used to explain in more detail what this data is for." autocomplete="off">{{ $detail_user->address ?? '' }}</textarea>
    
                                                            @if($errors->has('address'))
                                                                <p style="font-style: bold; color: red;">{{ $errors->first('address') }}</p>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                                <div class="col-12 col-sm-12">
                                                    <div class="form-group">
                                                        <div class="controls">
                                                            <label>Information <code style="color:green;">optional</code></label>
                                                            <textarea style="resize: none;" id="information" name="information" class="form-control" rows="8" placeholder="example used to explain in more detail what this data is for." autocomplete="off">{{ $detail_user->information ?? '' }}</textarea>
    
                                                            @if($errors->has('information'))
                                                                <p style="font-style: bold; color: red;">{{ $errors->first('information') }}</p>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                                <div class="col-12 d-flex flex-sm-row flex-column justify-content-end mt-1">
                                                    <button type="submit" style="width:120px;" class="btn btn-cyan" onclick="return confirm('Are you sure want to update this data ?')">
                                                        <i class="la la-check-square-o"></i> Submit
                                                    </button>
                                                </div>
                                            </div>
                                        </form>
                                        <!-- users edit account form ends -->
                                    </div>

                                    <div class="tab-pane" id="security" aria-labelledby="security-tab" role="tabpanel">
                                        <!-- users edit Info form start -->
                                        <form validate action="{{ route('backsite.update.security.profiles', [$user->id]) }}" method="POST">
    
                                            @method('PUT')
                                            @csrf
                                            
                                            <div class="row">
                                                <div class="col-12 col-sm-6">
                                                    <div class="form-group">
                                                        <div class="controls">
                                                            <label>New password <code style="color:red;">required</code></label>
                                                            <input id="password" type="password" placeholder="input your new password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
    
                                                            @if($errors->has('password'))
                                                                <p style="font-style: bold; color: red;">{{ $errors->first('password') }}</p>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-12 col-sm-6">
                                                    <div class="form-group">
                                                        <div class="controls">
                                                            <label>Confirm password <code style="color:red;">required</code></label>
                                                            <input id="password-confirm" type="password" placeholder="confirm your new password" class="form-control" name="password_confirmation" required autocomplete="new-password">
    
                                                            @if($errors->has('password_confirmation'))
                                                                <p style="font-style: bold; color: red;">{{ $errors->first('password_confirmation') }}</p>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                                    
                                                <div class="col-12 d-flex flex-sm-row flex-column justify-content-end mt-1">
                                                    <button type="submit" style="width:120px;" class="btn btn-cyan" onclick="return confirm('Are you sure you want to save this data ?')">
                                                        <i class="la la-check-square-o"></i> Save
                                                    </button>
                                                </div>
                                            </div>
                                        </form>
                                        <!-- users edit Info form ends -->
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </section>
                <!-- users edit ends -->
            </div>

        </div>
    </div>
<!-- END: Content-->

@endsection

@push('after-script')
    <script>
        $("#account-upload").on('change', function () {
            if (typeof (FileReader) != "undefined") {
                var image_holder = $("#image-holder");
                image_holder.empty();
                var reader = new FileReader();
                reader.onload = function (e) {
                    $("<img />", {
                    "style": "height:64px; width:64px; object-fit:cover;",
                        "src": e.target.result,
                        "class": "users-avatar-shadow rounded-circle mr-2"
                    }).appendTo(image_holder);
                }
                image_holder.show();
                reader.readAsDataURL($(this)[0].files[0]);
            } else {
                alert("This browser does not support File Reader.");
            }
        });

        var uploadField = document.getElementById("account-upload");

        uploadField.onchange = function() {
            if(this.files[0].size > 1000000){
                alert("File anda terlalu besar, maksimal ukuran file hanya 1 megabit");
                this.value = "";
            };
        };
    </script>
@endpush