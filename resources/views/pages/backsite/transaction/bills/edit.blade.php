@extends('layouts.backsite')

{{-- set title --}}
@section('title', 'Payment - Bill')

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
                    <h3 class="content-header-title mb-0 d-inline-block">Payment</h3>
                    <div class="row breadcrumbs-top d-inline-block">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a href="{{ route('backsite.dashboard.index') }}" onclick="return confirm('Are you sure close this page ?')">Dashboard</a>
                                </li>
                                <li class="breadcrumb-item">
                                    <a href="{{ route('backsite.bill.index') }}" onclick="return confirm('Are you sure close this page ?')">Bill</a>
                                </li>
                                <li class="breadcrumb-item active">Payment</li>
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
                                        <form class="form form-horizontal" action="{{ route("backsite.upload.pay.bill", [$bill->id]) }}" method="POST" enctype="multipart/form-data">

                                                @method('PUT')
                                                @csrf

                                                <div class="form-body">

                                                    <h4 class="form-section"><i class="fa fa-edit"></i> Form Payment</h4>

                                                    <div class="form-group row">
                                                        <label class="col-md-3 label-control" for="image">Image <code style="color:red;">required</code></label>
                                                        <div class="col-md-9 mx-auto">
                                                            <div class="custom-file">
                                                                <input type="file" accept="image/x-png,image/svg,image/jpeg" name="photo" class="custom-file-input" id="image">
                                                                <label class="custom-file-label" for="image" aria-describedby="image">Choose File</label>
                                                                <input class="form-input form-control" type="hidden" id="text-blob" name="image" required></input>
                                                            </div>
                                                            @if($errors->has('image'))
                                                                <p style="font-style: bold; color: red;">{{ $errors->first('image') }}</p>
                                                            @endif
                                                            <div id="image-holder" class="mt-2"></div>
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

@push('after-script')
    <script>
        $("#image").on('change', function () {
            if (typeof (FileReader) != "undefined") {
                var image_holder = $("#image-holder");
                image_holder.empty();
                var reader = new FileReader();
                reader.onload = function (e) {
                    $("<img />", {
                    "style": "height:300px; width:300px; object-fit:cover;",
                        "src": e.target.result,
                        "class": "users-avatar-shadow mr-2"
                    }).appendTo(image_holder);
                }
                image_holder.show();
                reader.readAsDataURL($(this)[0].files[0]);
            } else {
                alert("This browser does not support File Reader.");
            }
        });

        var uploadField = document.getElementById("image");

        uploadField.onchange = function() {
            if(this.files[0].size > 1000000){
                alert("File anda terlalu besar, maksimal ukuran file hanya 1 megabit");
                this.value = "";
            };
        };
    </script>
@endpush