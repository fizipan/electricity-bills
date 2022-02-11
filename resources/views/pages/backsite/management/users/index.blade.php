@extends('layouts.backsite')

{{-- set title --}}
@section('title', 'User')

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
                    <h3 class="content-header-title mb-0 d-inline-block">User</h3>
                    <div class="row breadcrumbs-top d-inline-block">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('backsite.dashboard.index') }}">Dashboard</a></li>
                                <li class="breadcrumb-item active">User</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>

            {{-- add card --}}
            @can('user_create')
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
                                            
                                            <form class="form form-horizontal" action="{{ route('backsite.users.store') }}" method="POST" enctype="multipart/form-data">

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

                                                    <div class="form-group row {{ $errors->has('roles') ? 'has-error' : '' }}">
                                                        <label class="col-md-3 label-control">Role <code style="color:red;">required</code></label>
                                                        <div class="col-md-9 mx-auto">
                                                            <label for="roles">
                                                                <span class="btn btn-warning btn-sm select-all">{{ 'Select all' }}</span>
                                                                <span class="btn btn-warning btn-sm deselect-all">{{ 'Delete all' }}</span>
                                                            </label>
                                                        
                                                            <select name="roles[]" 
                                                                    id="roles" 
                                                                    class="form-control select2"
                                                                    multiple="multiple" required>
                                                                @foreach($roles as $id => $roles)
                                                                    <option value="{{ $id }}" {{ (in_array($id, old('roles', [])) || isset($role) && $user->roles->contains($id)) ? 'selected' : '' }}>{{ $roles }}</option>
                                                                @endforeach
                                                            </select>

                                                            @if($errors->has('roles'))
                                                                <p style="font-style: bold; color: red;">{{ $errors->first('roles') }}</p>
                                                            @endif
                                                        </div>
                                                    </div>

                                                    <div class="form-group row">
                                                        <label class="col-md-3 label-control" for="address">Address <code style="color:green;">optional</code></label>
                                                        <div class="col-md-9 mx-auto">
                                                            <textarea style="resize: none;" id="address" name="address" class="form-control" rows="8" placeholder="example used to explain in more detail what this data is for." autocomplete="off">{{old('address')}}</textarea>
    
                                                            @if($errors->has('address'))
                                                                <p style="font-style: bold; color: red;">{{ $errors->first('address') }}</p>
                                                            @endif
                                                        </div>
                                                    </div>

                                                    <div class="form-group row">
                                                        <label class="col-md-3 label-control" for="information">Information <code style="color:green;">optional</code></label>
                                                        <div class="col-md-9 mx-auto">
                                                            <textarea style="resize: none;" id="information" name="information" class="form-control" rows="8" placeholder="example used to explain in more detail what this data is for." autocomplete="off">{{old('information')}}</textarea>
    
                                                            @if($errors->has('information'))
                                                                <p style="font-style: bold; color: red;">{{ $errors->first('information') }}</p>
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

            @can('user_filter')
                {{-- Filter --}}
                <div class="card border-bottom-info box-shadow-0">
                    <a data-action="collapse">
                        <div class="card-header">
                            <h4 class="card-title">Filter <small> search</small></h4>
                            <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                            <div class="heading-elements">
                                <ul class="list-inline mb-0">
                                    <li><a data-action="collapse"><i class="ft-plus"></i></a></li>
                                </ul>
                            </div>
                        </div>
                    </a>
                    <div class="card-content collapse hide">
                        <div class="card-body">
                            <form class="form" action="{{ route('backsite.filter.users') }}" method="GET">
                                
                                <div class="form-body">
                                    <div class="row">

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="find">Find Something <code style="color:green;">optional</code></label>
                                                <input type="text" id="find" name="find" class="form-control" placeholder="Search Name" value="{{isset($find) ? $find : ''}}" autocomplete="off">

                                                @if($errors->has('find'))
                                                    <p style="font-style: bold; color: red;">{{ $errors->first('find') }}</p>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="from">From <code style="color:red;">required</code></label>
                                                <input type="text" id="from" name="from" class="form-control" placeholder="example for start date" value="{{isset($from) ? $from : ''}}" autocomplete="off" data-inputmask-alias="datetime" data-inputmask-inputformat="dd/mm/yyyy HH:ss:ss" data-inputmask-placeholder="dd/mm/yyyy HH:mm:ss" required>

                                                @if($errors->has('from'))
                                                    <p style="font-style: bold; color: red;">{{ $errors->first('from') }}</p>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="to">To <code style="color:red;">required</code></label>
                                                <input type="text" id="to" name="to" class="form-control" placeholder="example for end date" value="{{isset($to) ? $to : ''}}" autocomplete="off" data-inputmask-alias="datetime" data-inputmask-inputformat="dd/mm/yyyy HH:ss:ss" data-inputmask-placeholder="dd/mm/yyyy HH:mm:ss" required>

                                                @if($errors->has('to'))
                                                    <p style="font-style: bold; color: red;">{{ $errors->first('to') }}</p>
                                                @endif
                                            </div>
                                        </div>

                                    </div>
                                    <div class="form-actions">
                                        <a href="{{ route('backsite.users.index') }}" style="width:100px;" class="btn bg-blue-grey text-white mr-1" onclick="return confirm('Are you sure filter with this data ?')"> <i class="ft-x"></i> Reset </a>

                                        <button type="submit" style="width:100px;" class="btn btn-primary">
                                            <i class="la la-check-square-o"></i> Submit
                                        </button>
                                    </div>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            @endcan

            {{-- table card --}}
            @can('user_table')
                <div class="content-body">
                    <section id="table-home">
                        <!-- Zero configuration table -->
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h4 class="card-title">User List</h4>
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
                                                            <th>Name</th>
                                                            <th>Email</th>
                                                            <th>Mobile Phone</th>
                                                            <th>Role</th>
                                                            <th>Status</th>
                                                            <th style="text-align:center; width:150px;">Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @forelse($users as $key => $user)
                                                            <tr data-entry-id="{{ $user->id }}">
                                                                <td>{{ date("d/m/Y H:i:s",strtotime($user->created_at)) ?? '' }}</td>
                                                                <td>{{ $user->name ?? '' }}</td>
                                                                <td>{{ $user->email ?? '' }}</td>
                                                                <td>{{ $user->detail_users->mobile_phone ?? '' }}</td>
                                                                <td style="width:200px;">
                                                                    @foreach($user->roles as $key => $item)
                                                                    <span class="badge bg-yellow text-dark mr-1 mb-1">{{ $item->title }}</span>
                                                                    @endforeach
                                                                </td>
                                                                <td>
                                                                    @if (isset($user->detail_users->status))
                                                                        @if ($user->detail_users->status == 1)
                                                                            <span class="badge badge block badge-success">{{ 'Active' }}</span>
                                                                        @else
                                                                            <span class="badge badge block badge-danger">{{ 'Suspend' }}</span>
                                                                        @endif
                                                                    @else
                                                                        {{ 'N/A' }}
                                                                    @endif
                                                                </td>
                                                                <td class="text-center">

                                                                    <div class="btn-group mr-1 mb-1">
                                                                        <button type="button" class="btn btn-info btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action</button>
                                                                        <div class="dropdown-menu">
                                                                            @can('user_show')
                                                                                <a href="#mymodal" 
                                                                                    data-remote="{{ route('backsite.users.show', $user->id) }}" 
                                                                                    data-toggle="modal" 
                                                                                    data-target="#mymodal" 
                                                                                    data-title="User Detail" 
                                                                                    class="dropdown-item">
                                                                                    Show
                                                                                </a>
                                                                            @endcan
                                                                            @can('user_edit')
                                                                                <a class="dropdown-item" href="{{ route('backsite.users.edit', $user->id) }}">
                                                                                    Edit
                                                                                </a>
                                                                            @endcan
                                                                            @can('user_delete')
                                                                                <form action="{{ route('backsite.users.destroy', $user->id) }}" method="POST" onsubmit="return confirm('Are you sure want to delete this data ?');">
                                                                                    <input type="hidden" name="_method" value="DELETE">
                                                                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                                                    <input type="submit" class="dropdown-item" value="Delete">
                                                                                </form>
                                                                            @endcan
                                                                            @can('user_reset_password')
                                                                                <a class="dropdown-item" href="{{ route('backsite.reset.password.users', $user->id) }}">
                                                                                    Reset Password
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
                                                            <th>Name</th>
                                                            <th>Email</th>
                                                            <th>Mobile Phone</th>
                                                            <th>Role</th>
                                                            <th>Status</th>
                                                            <th style="text-align:center; width:150px;">Action</th>
                                                        </tr>
                                                    </tfoot>
                                                </table>
                                            </div>

                                            <hr>

                                            <div class="table-responsive">
                                                <div class="text-center mb-3">
                                                    @if ($users->hasPages())
                                                        <h4 class="card-title">Pagination Page</h4>
                                                        <p class="mt-1"><code class="text-dark">Page {{ $users->currentPage() }}</code> & <code>All data {{ $users->total() }}</code></p>
                                                    @endif
                                                    <nav aria-label="Page navigation">
                                                        @if ($users->hasPages())
                                                            <ul class="pagination justify-content-center pagination-round">

                                                                {{-- Previous Page Link --}}
                                                                @if ($users->onFirstPage())
                                                                    <li class="page-item disabled">
                                                                        <a class="page-link" href="#" aria-label="Previous">
                                                                            <span aria-hidden="true"><i class="ft-chevron-left"></i></span>
                                                                            <span class="sr-only"><i class="ft-chevron-left"></i></span>
                                                                        </a>
                                                                    </li>
                                                                @else
                                                                    <li class="page-item">
                                                                        <a class="page-link" href="{{ $users->previousPageUrl() }}" aria-label="Previous">
                                                                            <span aria-hidden="true"><i class="ft-chevron-left"></i></span>
                                                                            <span class="sr-only"><i class="ft-chevron-left"></i></span>
                                                                        </a>
                                                                    </li>
                                                                @endif

                                                                @if($users->currentPage() > 2)
                                                                    <li class="page-item"><a class="page-link" href="{{ $users->url(1) }}">1</a></li>
                                                                @endif

                                                                @if($users->currentPage() > 3)
                                                                    <li class="page-item disabled"><a class="page-link" href="#">...</a></li>
                                                                @endif

                                                                @foreach(range(1, $users->lastPage()) as $i)
                                                                    @if($i >= $users->currentPage() - 1 && $i <= $users->currentPage() + 1)
                                                                        @if ($i == $users->currentPage())
                                                                            <li class="page-item active"><span class="page-link">{{ $i }}</span></li>
                                                                        @else
                                                                            <li class="page-item"><a class="page-link" href="{{ $users->url($i) }}">{{ $i }}</a></li>
                                                                        @endif
                                                                    @endif
                                                                @endforeach

                                                                @if($users->currentPage() < $users->lastPage() - 3)
                                                                    <li class="page-item disabled"><a class="page-link" href="#">...</a></li>
                                                                @endif

                                                                @if($users->currentPage() < $users->lastPage() - 2)
                                                                    <li class="page-item"><a class="page-link" href="{{ $users->url($users->lastPage()) }}">{{ $users->lastPage() }}</a></li>
                                                                @endif

                                                                {{-- Next Page Link --}}
                                                                @if ($users->hasMorePages())
                                                                    <li class="page-item">
                                                                        <a class="page-link" href="{{ $users->nextPageUrl() }}" aria-label="Next">
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

        $(function () {
            $('#from').datetimepicker({
                format: 'DD/MM/YYYY HH:mm:ss'
            });

            $('#to').datetimepicker({
                format: 'DD/MM/YYYY HH:mm:ss'
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