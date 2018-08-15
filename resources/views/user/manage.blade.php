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
                        
                        <div class="float-right">
                            <a class="btn btn-sm btn-primary" data-toggle="modal" data-target="#exampleModalCenter">
                                <span><i class="fa fa-user-plus"></i>Add Employee</span>
                            </a>
                        </div>
                    </div>
                    
                    <div class="card-body">
                        @include('components.messages')
                        @include('components.sessions')
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Position</th>
                                    <th>Activate</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(count(auth()->user()->employees) > 0)
                                @foreach(auth()->user()->employees->sortByDesc('username') as $employee)
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
                                </tr>
                                @endforeach
                                @else
                                    No Employee
                                @endif 
                            </tbody>
                        </table>
                    </div>                 
                </div>
            </div>
            {{-- <div class="col-md-3" id="add_employee">
                <div id="accordion"> --}}
                    {{-- <div class="card">
                        <div class="card-header bg-primary" id="headingOne">
                            <h5 class="mb-0">
                                <a class="btn-link text-white" href="#" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                Upload a file
                                </a>
                            </h5>
                        </div>
                    
                        <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
                            <div class="card-body">
                                <div class="card-body">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="customFile" accept=".csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel">
                                        <label class="custom-file-label" for="customFile">Choose Excel file</label>
                                    </div>
                                    <div class="bs-example">
                                        <div class="alert alert-warning">
                                            <strong>Note:</strong> To be able to successfully upload the file here are the columns needed.
                                            <ul>
                                                <li>ID</li>
                                                <li>Firstname</li>
                                                <li>Lastname</li>
                                                <li>Email</li>
                                                <li>Position</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> --}}
                    {{-- <div class="card">
                        <div class="card-header bg-primary" id="headingTwo">
                            <h5 class="mb-0">
                                <a class="btn-link collapsed text-white" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                Add Employee
                                </a>
                            </h5>
                        </div>
                        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
                            <div class="alert alert-warning notice notice-warning">
                                <strong>Notice:</strong> view documentation for managing employees and giving access.
                            </div>
                            <form action="{{ url('/dashboard/employee/create') }}" method="POST" class="form-signin">
                                @csrf
                                <div class="form-label-group">
                                    <input type="text" id="username" name="username" class="form-control" placeholder="Employee ID" required>
                                    <label for="username" class="text-primary">Employee ID</label>
                                </div>
                                <div class="form-label-group">
                                    <input type="text" id="firstname" name="firstname" class="form-control" placeholder="Employee ID" required>
                                    <label for="firstname" class="text-primary">Firstname</label>
                                </div>
                                <div class="form-label-group">
                                    <input type="text" id="lastname" name="lastname" class="form-control" placeholder="Employee ID" required>
                                    <label for="lastname" class="text-primary">Lastname</label>
                                </div>
                                <div class="form-label-group">
                                    <input type="text" id="email" name="email" class="form-control" placeholder="Employee ID">
                                    <label for="email" class="text-primary">Email <small>optional</small></label>
                                </div>
                                    <div class="form-group">
                                        <label for="emp_position"></label>
                                        <select name="position_id" id="position_id" class="form-control text-primary" required>
                                            <option value="">Select Position</option>
                                            @foreach(\App\Position::all() as $position)
                                                <option value="{{ $position->id }}">{{ $position->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary form-control">Save</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                </div>

            </div> --}}
        </div>
    </div>
</section>

<!-- Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="exampleModalLongTitle">Add Employee</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ url('/dashboard/employee/create') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="username"></label>
                        <input type="text" id="username" name="username" class="form-control form-control-sm" placeholder="Employee ID" required>
                    </div>
                    <div class="form-group">
                        <label for="emp_position"></label>
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
                    <div class="form-group">
                        <label for="firstname"></label>
                        <input type="text" id="firstname" name="firstname" class="form-control form-control-sm" placeholder="First Name" required>
                    </div>
                    <div class="form-group">
                        <label for="lastname" class="text-primary"></label>
                        <input type="text" id="lastname" name="lastname" class="form-control form-control-sm" placeholder="Last Name" required>
                    </div>
                    <div class="form-group">
                        <label for="email"></label>
                        <input type="text" id="email" name="email" class="form-control form-control-sm" placeholder="Email (optional)">
                    </div>
                    <div class="form-group float-right">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>    
            </div>
            <div class="text-center"><i>or</i></div>
            <div class="modal-footer">
                <form action="{{ route('upload.excel.file') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" name="excelfile" id="excelfile" accept=".csv">
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
@endsection

@section('custom_scripts')
<script src="{{ asset('js/lib/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('js/lib/bootstrap-toggle.min.js') }}"></script>
<script>
    $(document).ready(function(){
        $('.table').DataTable({

        });

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
                    success: function (result) {},
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
                    success: function (result) {}
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
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                        </form>
                    </div>
                `
                );
            }
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
                success: function (result) {}
            });
        });

        $('.custom-file-input').on('change', function() { 
            let fileName = $(this).val().split('\\').pop(); 
            $(this).next('.custom-file-label').addClass("selected").html(fileName);
        });
    });
</script>
@endsection
