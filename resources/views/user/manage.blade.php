@extends('layouts.user')

@section('custom_styles')
<link rel="stylesheet" href="{{ asset('css/jquery.dataTables.min.css') }}">
<link href="{{ asset('css/bootstrap-toggle.min.css') }}" rel="stylesheet">
@endsection
@section('content')
<section id="manage-employees">
    <div class="container-fluid align-items-center">
        <div class="row">
            <div class="col-md-12">
                <h2>
                    Manage Employees
                </h2>
                <div class="card box-shadow">
                    <div class="card-header bg-primary text-white">
                        Employees
                       
                        <span class="float-right" style="position:absolute; right: 50px; top: 7px;">
                            <form>
                                <div class="input-group">
                                    <input class="form-control border-secondary py-2" type="search" id="search" placeholder="Search...">
                                    <div class="input-group-append">
                                        <button class="btn btn-primary" type="button">
                                            <i class="fa fa-search text-white"></i>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </span>
                        <span class="float-right dropdown">
                            <a href="#" class="text-white dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fa fa-gear"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#exampleModalCenter"><i class="fa fa-user-plus"></i> Add Employee</a>
                                <a class="dropdown-item" href="{{ route('user.settings') }}"><i class="fa fa-gear"></i> Scheduler Settings</a>                                
                            </div>
                        </span>
                    </div>
                    
                    <div class="card-body">
                        @if(count(auth()->user()->employees) > 0)
                        <table class="table text-center">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Position</th>
                                    <th><a href="#" id="activate-all"> Activate </a> / <a href="#" id="deactivate-all"> Deactivate </a>All</th>
                                    <th>Reset Password</th>
                                </tr>
                            </thead>
                            <tbody>
                                
                                @foreach(auth()->user()->employees->sortBy('position_id') as $employee)
                                <tr>
                                    <td>
                                        {{ $employee->username }}
                                    </td>
                                    <td>
                                        <img src="{{ asset('img/default.png') }}" class="rounded" alt="avatar">
                                        <strong>{{ Helper::employee_name($employee->firstname, $employee->lastname) }}</strong>
                                    </td>
                                    <td>
                                        <div class="form-group">
                                            <input type="hidden" value="{{ $employee->id }}">
                                            <select class="form-control myposition">
                                            <option value="{{ $employee->position->id }}">{{ $employee->position->name }}</option>
                                            @foreach(\App\Position::all()->where('user_id', null) as $position)
                                                @if($employee->position->name != $position->name)
                                                <option value="{{ $position->id }}">{{ $position->name }}</option>
                                                @endif
                                            @endforeach
                                            @foreach(auth()->user()->positions as $position)
                                                @if($employee->position->name != $position->name)
                                                <option value="{{ $position->id }}">{{ $position->name }}</option>
                                                @endif
                                            @endforeach
                                            </select>
                                        </div>
                                    </td>
                                    <td>
                                        <input type="checkbox" data-toggle="toggle" id="status" value="{{ $employee->id }}" {{ $employee->status == false ? '' : 'checked' }}>
                                    </td>
                                    <td>
                                        @if(auth()->user()->resets->where('username', $employee->username)->first())
                                            <button type="button" class="btn btn-sm btn-secondary reset" id="{{ $employee->username }}">
                                                Reset Password
                                            </button>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        @else
                            No Employee
                        @endif 
                    </div>                 
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title " id="exampleModalLongTitle">
                    Add Employee
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6">
                    <small>
                        <div class="alert alert-info">
                        Added employees will be provided an account automatically. The following are the credentials employees can use to access their accounts:
                        <ul>
                            <li>Username:<strong class="text-primary"> Employee ID </strong></li>
                            <li>Password:
                                <ul>
                                    <li> <strong class="text-primary">CASE SENSITIVE</strong></li>
                                    <li> <strong class="text-primary">1ST</strong> letter of their firstname (lowercase)</li>
                                    <li> <strong class="text-primary">Full</strong> lastname (lowercase)</li>
                                    <li> <strong class="text-primary">LAST TWO</strong> characters of their Employee ID </li>
                                </ul>
                                
                            </li>
                        </ul>
                        </div>
                    </small>
                    </div>
                    <div class="col-md-6">
                        <form action="{{ url('/dashboard/employee/create') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text"><i class="fa fa-id-card"></i></div>
                                    </div>
                                     <input type="text" id="username" name="username" class="form-control form-control-sm" placeholder="Employee ID" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text"><i class="fa fa-tasks"></i></div>
                                    </div>
                                    <select name="position_id" id="position_id" class="form-control form-control-sm" required>
                                        <option value="">Select Position</option>
                                        @foreach(\App\Position::all()->where('user_id', null) as $position)
                                            <option value="{{ $position->id }}">{{ $position->name }}</option>
                                        @endforeach
                                        @foreach(auth()->user()->positions as $position)
                                            <option value="{{ $position->id }}">{{ $position->name }}</option>
                                        @endforeach
                                        <option value="Others">Others</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text"><i class="fa fa-user"></i></div>
                                    </div>
                                    <input type="text" id="firstname" name="firstname" class="form-control form-control-sm" placeholder="First Name" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text"><i class="fa fa-user"></i></div>
                                    </div>
                                    <input type="text" id="lastname" name="lastname" class="form-control form-control-sm" placeholder="Last Name" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text"><i class="fa fa-envelope"></i></div>
                                    </div>
                                    <input type="text" id="email" name="email" class="form-control form-control-sm" placeholder="Email (optional)">
                                </div>
                            </div>
                            <div class="form-group float-right">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                <button type="submit" class="btn btn-primary">Save</button>
                            </div>
                        </form>    
                    </div>
                </div>
            </div>
            <div class="text-center"><i>or</i></div>
            <div class="modal-footer">
                <div class="row">
                    <div class="col-md-6">
                        <div class="alert alert-info">
                            <small>
                                To add employee using csv file upload. The following columns are required. Details enclosed with () are not needed, details only in Capitalize Letters.
                                <ul>
                                    <li><strong class="text-primary">ID</strong> (employee id, must be atleast 5 characters)</li>
                                    <li><strong class="text-primary">FIRSTNAME</strong></li>
                                    <li><strong class="text-primary">LASTNAME</strong></li>
                                    <li><strong class="text-primary">POSITION</strong></li>
                                    <li><strong class="text-primary">EMAIL</strong> (optional)</li>
                                </ul>
                            </small>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <form action="{{ route('upload.excel.file') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" name="excelfile" id="excelfile" accept=".csv" required>
                                <label class="custom-file-label" for="excelfile">Choose CSV file</label>
                            </div>
                            <div class="form-group float-right">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                <button type="submit" class="btn btn-primary">Upload</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('custom_scripts')
<script src="{{ asset('js/lib/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('js/lib/bootstrap-toggle.min.js') }}"></script>
<script>
    $(document).ready(function(){
        // $('.table').DataTable({

        // });

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('input[type="checkbox"]').on('change', function() {
            if ($(this).is(':checked')){ 
                var url = "{{ url('/dashboard/manage/status/update') }}";
                $.ajax({
                    url: url,
                    type: 'POST',
                    data: {
                        id : $(this).val(),
                        status: 1
                    },
                    success: function (result) {
                        toastr.info('Employee activated');
                    },
                });
            } 
            else { 
                var url = "{{ url('/dashboard/manage/status/update') }}";
                $.ajax({
                    url: url,
                    type: 'POST',
                    data: {
                        id : $(this).val(),
                        status: 0
                    },
                    success: function (result) {
                        toastr.warning('Employee deactivated');
                    }
                });
            }
        });

        $('#position_id').on('change', function(){
            var html = $('.modal-content').html();
            if($(this).val() == "Others"){
                $('.modal-content').html(
                `
                    <div class="modal-header bg-primary text-white">
                        <h5 class="modal-title" id="exampleModalLongTitle">Add Position</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('user.position.create') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="username"></label>
                            <input type="text" id="position" name="position" class="form-control" placeholder="Position Name" required>
                        </div>
                        <div class="form-group float-right">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal" id="cancel">Cancel</button>
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                        </form>
                    </div>
                `
                );
            }
            $('#cancel').on('click', function(){
                setTimeout(() => {
                    location.reload();
                }, 1000);
            });
        });

        

        $('.myposition').on('change', function() {
            var url = "{{ url('/dashboard/employee/position/update') }}";
            var emp_id = $(this).siblings('input').val();
            $.ajax({
                url: url,
                type: 'POST',
                data: {
                    id : emp_id,
                    position: $(this).val()
                },
                success: function (result) {
                    toastr.info('Position updated');
                }
            });
        });

        $('.custom-file-input').on('change', function() { 
            let fileName = $(this).val().split('\\').pop(); 
            $(this).next('.custom-file-label').addClass("selected").html(fileName);
        });

         $('#search').on("keyup", function(e){
            var value = $(this).val().toLowerCase();
            var content = $('#carousel').html();
            if(value == ''){
                $('tbody').html(content);
            } else {
                $('tbody tr').filter(function(){
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                });
            }
        });

        $('#activate-all').on('click', function(){
            var url = "{{ url('/dashboard/employee/update/all') }}";
            var id = "{{ auth()->user()->id }}";
            $.ajax({
                url: url,
                type: 'POST',
                data: {
                    id : id,
                    val: 1
                },
                success: function (result) {
                    toastr.info('Activating Employees...');
                    setTimeout(() => {
                        location.reload();                        
                    }, 3000);
                    
                }
            });
        });
        $('#deactivate-all').on('click', function(){
            var url = "{{ url('/dashboard/employee/update/all') }}";
            var id = "{{ auth()->user()->id }}";
            $.ajax({
                url: url,
                type: 'POST',
                data: {
                    id : id,
                    val: 0
                },
                success: function (result) {
                    toastr.info('Deactivating Employees...');
                    setTimeout(() => {
                        location.reload();
                    }, 3000);

                }
            });
        });

        $('button.reset').on('click', function(){
            console.log($(this).attr('id'));
            var url = "{{ url('/dashboard/password/reset') }}";
            $.ajax({
                url: url,
                type: 'POST',
                data: {
                    id : $(this).attr('id'),
                },
                success: function (result) {
                    toastr.success(result["data"]);
                    setTimeout(() => {
                        location.reload();
                    }, 2000);

                }
            });
        });
    });
</script>
@endsection
