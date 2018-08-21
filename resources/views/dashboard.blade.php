@extends('layouts.user')
@section('custom_styles')
<link rel="stylesheet" href="{{ asset('css/schedulerstyles.css') }}">
@endsection
@section('content')
<div style="background-color:rgba(0,0,0,0);height:100%;width:100%;position:relative;top:0;left:0;z-index:9999;">
    <div id="managerInfo" class=" ishidden">
        <div id="shadowBG">
        </div>
        <div id="EmployeeManagerTab" class="managerTab">
            <div class="titlecover">
                <button id = "emClose" class="closeBtn">&times;</button>
                <p>Employee Manager</p>
            </div>
            <div class="contentdiv">
                <div class = "tabBtns">
                    <button id="empListBtn">Employee List</button>
                    <button id="empInfoBtn">Employee Info</button>
                    <button id="empAddBtn">Add Employee</button>
                </div>
                <div class="contenttabs">
                    <div id="empList">
                        <div id="empList_emps"  class="managerTab2 listTab">
                        </div>
                        <div id="empList_right" class="managerTab2">
                            <p class="mth1">Choose an Employee in the list to view and edit.</p>
                            <div id="empList_search_container" class="labelinput" style="display:block;">
                                <p>Search Employee</p>
                                <input id="empList_search">
                                <p>&#8981;</p>
                            </div>
                        </div>
                    </div>
                    <div id="empInfo">
                        <div class="managerTab2">
                            <p class="mth1">Employee Name</p>
                            <!--<p id="empInfo_noselect" class="mth2">Choose an Employee in the Employee list to view Info.</p>-->
                            <div class="labelinput" style="">
                                <p>Last Name</p>
                                <input id="empInfo_lname">
                            </div>
                            <div class="labelinput">
                                <p>First Name</p>
                                <input id="empInfo_fname">
                            </div>
                            <div class="labelinput">
                                <p>Role</p>
                                <input id="empInfo_role">
                            </div>
                            <button id="empInfo_updatename" class="middleBtn2">Update Name</button>
                        </div>
                        <div class="managerTab2">
                            <p class="mth1">Employee Settings</p>
                            <div class="labelcheckbox">
                                <input id="empInfo_activeButton" type="checkbox">
                                <p>Employed (Scheduling in effect.)</p>
                            </div>
                            <p class="mth1">Preferred Day-off</p>
                            <select id="empInfo_preferredDayoff" style="width:140px;margin-left:12px;margin-top:0">
                                <option value="-1" selected>Any</option>
                                <option value="0">Sunday</option>
                                <option value="1">Monday</option>
                                <option value="2">Tuesday</option>
                                <option value="3">Wednesday</option>
                                <option value="4">Thursday</option>
                                <option value="5">Friday</option>
                                <option value="6">Saturday</option>
                            </select>
                                <!--<button id="empInfo_deleteButton" class="middleBtn1">Remove Employee</button>-->
                        </div>
                    </div>
                    <div id="empAdd">
                        <div class="managerTab2">
                            <p class="mth1">Add new Employee</p>
                            <div class="labelinput" style="">
                                <p>Last Name</p>
                                <input id="empAdd_lname">
                            </div>
                            <div class="labelinput">
                                <p>First Name</p>
                                <input id="empAdd_fname">
                            </div>
                            <div class="labelinput">
                                <p>Role</p>
                                <input id="empAdd_role">
                            </div>
                            <br>
                            <button id="empAdd_add" class="middleBtn1">Add</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div id="RoleManagerTab" class="managerTab">
            <div class="titlecover">
                <button id = "rmClose" class="closeBtn">&times;</button>
                <p>Role Manager</p>
            </div>
            <div  class="contentdiv">
                <div class = "tabBtns">
                    <button id="roleListBtn">Role List</button>
                    <button id="roleInfoBtn">Role Info</button>
                    <button id="roleAddBtn">Add Role</button>
                </div>
                <div class="contenttabs">
                    <div id="roleList">
                        <div id="roleList_roles"  class="managerTab2 listTab">
                        </div>
                    </div>
                    <div id="roleInfo">
                        <div class="managerTab2">
                            <p id="roleInfo_roletitle" class="mth1" style="font-size:28px;">Role Name</p>
                            <p class="mth1">Schedule Generation Configuration</p>
                            <div id="roleInfo_dayofftoggle">
                                <div class="container1">
                                    <!--<div class="labelcheckbox">
                                        <input id="roleInfo_fixedButton" type="checkbox">
                                        <p>Fixed Day off Schedule</p>
                                    </div>-->
                                    <p class="mth2 tooltip" style="margin-bottom:4px;">Working Days<span class="tooltiptext">days which scheduling is in effect</span></p>
                                    <div class="blockedDayDiv">
                                        <button id="roleInfo_toggle0">SUN</button>
                                        <button id="roleInfo_toggle1">MON</button>
                                        <button id="roleInfo_toggle2">TUE</button>
                                        <button id="roleInfo_toggle3">WED</button>
                                        <button id="roleInfo_toggle4">THU</button>
                                        <button id="roleInfo_toggle5">FRI</button>
                                        <button id="roleInfo_toggle6">SAT</button>
                                    </div>
                                </div>
                            </div>
                            <p class="mth1">Add Shift</p>
                            <div class="container1">
                                <p class="p1 tooltip">From<span class="tooltiptext">start time of shift</span></p>
                                <input id="roleInfo_addShiftFrom" class="inputtime" type="time">
                                <p class="p1 tooltip">To<span class="tooltiptext">end time of shift</span></p>
                                <input id="roleInfo_addShiftTo" class="inputtime" type="time">
                                <br>
                                <p class="p1 tooltip">Assignments : Min <span class="tooltiptext">minimum employees needed</span></p>
                                <input id="roleInfo_addShiftMin" class="inputnumber" type="number" min="0">
                                <p class="p1 tooltip">Max<span class="tooltiptext">maximum employees needed</span></p>
                                <input id="roleInfo_addShiftMax" class="inputnumber" type="number" min="0">
                                <button id="roleInfo_addShiftButton" class="middleBtn2">Add Shift</button>
                            </div>
                            <p class="mth1">Shift Generation</p>
                            <div id="roleInfo_shiftscontainer" class="container1" style="padding:12px;margin-bottom:12px;">
                                <div id="roleInfo_shiftlistheader" class="shiftlistcontainer">
                                    <p class="shiftlistheader" style="width:100px;">From</p>
                                    <p class="shiftlistheader" style="width:100px;">To</p>
                                    <p class="shiftlistheader" style="width:40px;">Min</p>
                                    <p class="shiftlistheader" style="width:40px;">Max</p>
                                </div>
                                <div class="shiftlistcontainer">
                                    <input type="time" class="shiftlistheader" style="width:100px;">
                                    <input type="time" class="shiftlistheader" style="width:100px;">
                                    <input type="number" class="shiftlistheader" style="width:40px;">
                                    <input type="number" class="shiftlistheader" style="width:40px;">
                                </div>
                            </div>
                            <button id="roleInfo_updateShiftButton" class="middleBtn2">Update Shifts</button>
                            <p class="mth1">Generate Schedule</p>
                            <div class="container1">
                                <p class="p1 tooltip">Date<span class="tooltiptext">start day of sched</span></p>
                                <input type="date" id="roleInfo_generateDate" class="inputtime" style="width:140px;">
                                <br>
                                <p class="p1 tooltip">Days<span class="tooltiptext">number of days</span></p>
                                <input type="number" id="roleInfo_generateDays" class="inputtime" value="7" min="1" max="31" style="width:60px;">
                                <!--<p class="p1 tooltip">Day offs<span class="tooltiptext">number of day offs</span></p>
                                <input type="number" id="roleInfo_generateDayoffs" class="inputtime" value="1" min="1" max="30" style="width:60px;">-->
                                <button id="roleInfo_generateScheduleButton" class="middleBtn2" style="width:240px;font-size:24px;">Generate Schedule</button>
                            </div>
                        </div>
                        <div class="managerTab2">
                            <!--<p class="mth1">Default Settings</p>-->

                        </div>
                    </div>
                    <div id="roleAdd">
                        <div class="managerTab2">
                            <p class="mth1">Add new Role</p>
                            <div class="labelinput" style="">
                                <p>Role Name</p>
                                <input id="roleAdd_name">
                            </div>
                            <button id="roleAdd_add" class="middleBtn1">Add</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



<section id="user-dashboard">
    <div class="container-fluid">
        @if(session('success'))
            <div class="alert alert-success notice notice-success notice-sm" role="alert">
                <strong><span class="fa fa-check"></span></strong>{{ session('success') }}
                Click <a href="{{ asset('storage/pdf/') }}/{{ App\EvaluationFile::where('user_id', auth()->user()->id)->latest('id')->first()->filename }}" target="_blank"> here </a> to view file.
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">
                        <i class="fa fa-window-close"></i>
                    </span>
                </button>
            </div>
        @endif
        <div class="row" id="employee-list">
            <div class="col-12">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        Employees
                        <span class="float-right" style="position:absolute; right: 50px; top: 5px;">
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
                                <a class="dropdown-item" href="{{ route('user.manage') }}">Manage Employees</a>
                            </div>
                        </span>
                    </div>
                    <div class="card-body">
                        <div class="container-fluid">
                            <div id="carousel" class="carousel slide" data-ride="carousel" data-interval="0">

                                <div class="carousel-inner row no-gutters w-100 mx-auto" role="listbox">
                                    @if(count(auth()->user()->employees->where('status', 1)) > 0)
                                    @php
                                        $count = 0;
                                    @endphp
                                    @foreach(auth()->user()->employees->where('status', 1) as $employee)
                                    <div class="carousel-item col-sm-4 col-md-3 {{ $count == 0 ? 'active' : '' }}">
                                        <div class="card" style="padding:10px">
                                            <div class="row">
                                                <div class="col-4">
                                                    <img class="img-fluid mx-auto d-block" src="{{ asset('storage/avatar/') }}/{{ $employee->profile->avatar }}" alt="avatar">
                                                </div>
                                                <div class="col-8">
                                                    <strong>{{ Helper::employee_name($employee->firstname, $employee->lastname) }}</strong>
                                                    <p>{{ $employee->position->name }}</p>
                                                    <div>
                                                        <input type="hidden" id="employee_id" value="{{ $employee->id }}">
                                                        <a href="#myModal" class="profile" data-toggle="modal" role="button">
                                                            <i class="fa fa-eye" data-toggle="tooltip" data-placement="top" title="View Profile"></i>
                                                        </a>
                                                        {{-- <a href="#myModal" class="message" data-toggle="modal" role="button">
                                                            <i class="fa fa-envelope" data-toggle="tooltip" data-placement="top" title="Send Message"></i>
                                                        </a> --}}
                                                        <a href="#myModal" class="evaluation" data-toggle="modal" role="button">
                                                            <i class="fa fa-bar-chart" data-toggle="tooltip" data-placement="top" title="Evaluate"></i>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                        @php
                                            $count++;
                                        @endphp
                                        @endforeach
                                    @else
                                    <div class="carousel-item col-sm-4 col-md-3 active">
                                        <div class="card" style="padding:10px">
                                            No Employee
                                        </div>
                                    </div>
                                    @endif
                                </div>
                                        
                                 <!-- /.carousel-inner -->
                                 <a class="carousel-control-prev" href="#carousel" role="button" data-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="sr-only">Previous</span>
                                </a>
                                <a class="carousel-control-next" href="#carousel" role="button" data-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span class="sr-only">Next</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12" id="schedule">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        <p style="float:left;"><strong>Schedule</strong></p>
                        <!--<p id ="roleLabel1"><strong>Cook</strong></p>-->
                        <div id="roleContainer">
                            <button id ="roleLeft">&#171;</button>
                            <p id = "roleViewLabel">Cook</p>
                            <button id ="roleRight">&#187;</button>
                        </div>
                        <div style="float:right;">
                            <span class="float-right dropdown">
                                <a href="#" class="text-white dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fa fa-gear"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
                                    <a class="dropdown-item" href="{{ route('user.schedule.generate') }}">Generate Schedule</a>
                                    <a class="dropdown-item" href="{{ route('user.settings') }}">Scheduler Settings</a>
                                </div>
                            </span>
                        </div>
                        <div id="monthContainer">
                            <button id ="monthLeft">&#171;</button>
                            <p id = "monthViewLabel">2018<br>September</p>
                            <button id ="monthRight">&#187;</button>
                        </div>
                    </div>
                    <div class="card-body" style="margin:0;padding:0;">
                        <div id="ManagerWindowWrapper">
                            <div class="managerwindow">
                                <div id="ManagerTable">
                                    <div id="LeftTableWrap">
                                        <table id="LeftTable">
                                        </table>
                                    </div>
                                    <div id="RightTableWrap">
                                        <div id="TopTableWrap">
                                            <table id="TopTable">
                                            </table>
                                        </div>
                                        <div id="BottomTableWrap">
                                            <table id="RightTable">
                                            </table>
                                        </div>
                                    </div>
                                    <div id="headerWindow" class=" ishidden">
                                        <div id="headerWindow1" class="hwwrap">
                                            <div id="headerWindowInfo">Day aa<br>Generation: aug 1 to aug 7</div>
                                            <button id="headerWindowDeleteDaily" class="headerBtn1">Clear all shifts from this day</button>
                                            <button id="headerWindowDeleteGenerated" class="headerBtn1">Delete Generated Schedule</button>
                                            <button id="headerWindowCopyGenerated" class="headerBtn1">Copy Generated Schedule</button>
                                            <button id="headerWindowPasteGenerated" class="headerBtn1">Paste Generated Schedule</button>
                                            <button id="headerWindowGenerate7" class="headerBtn1">Generate New Schedule (7 Days)</button>
                                            <button id="headerWindowGenerate7S" class="headerBtn1">Generate Shuffled Schedule (7 Days)</button>
                                            <button id="headerWindowGenerate7S2" class="headerBtn1">Generate Shuffled Schedule (7 Days,Rested)</button>
                                        </div>
                                        <div id="headerWindow2" class="hwwrap">
                                            <div id="headerWindow2Info">aimer<br>friday<br>aug 6</div>
                                            <button id="headerWindow2DeleteShift" class="headerBtn1">Remove Shift</button>
                                            <button id="headerWindow2EditShift" class="headerBtn1">Edit Shift</button>
                                            <button id="headerWindow2AddShift" class="headerBtn1">Add Shift</button>
                                            <button id="headerWindow2SwapShift" class="headerBtn1">Swap Shift</button>
                                            <button id="headerWindow2SwapSchedule" class="headerBtn1">Swap Schedule</button>
                                        </div>
                                        <button id="headerWindowClose" class="closeBtn">&times;</button>
                    
                                    </div>
                                </div>
                            </div>
                            <div class="managerwindow" style="margin-top:20px">
                                <button id="empManagerBtn" class = "managerBtn1">Manage Employees</button>
                                <button id="roleManagerBtn" class = "managerBtn1">Manage Roles</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@include('components.modal')

@endsection

@section('custom_scripts')
    <script src="{{ asset('js/lzjs.js') }}"></script>
    <script src="{{ asset('js/scheduler.js') }}"></script>
    <script src="{{ asset('js/schedulerUI.js') }}"></script>
    <script>
    // --------------------------- SAUCE VVVV
    document.getElementsByTagName("html")[0].style.height = "100%";
    document.getElementsByTagName("body")[0].style.height = "100%";
	//document.getElementById('badi').setAttribute("style","background-color:rgb(255,255,255)");

        
        var scheduler = new ScheduleManager();
        var schedulerUI = new ScheduleManagerHTML(document,scheduler);
        scheduler.ui = schedulerUI;
        schedulerUI.Initialize();


        let employees = {!! $employs !!}
        let settings = {!! $settings !!}; 
        let criteria = {!! $criteria !!}; 
        let shifts = {!! $shifts !!}; 
        let required_shifts = {!! $required_shifts !!}; 

        for (var index = 0; index < employees.length; index++) {
            var trueEmp = employees[index];
            var emp = scheduler.addEmployee(trueEmp.firstname,trueEmp.lastname,trueEmp.position);        
            emp.trueId = trueEmp.id;
        }

        scheduler.injectDB(employees,shifts,required_shifts,settings,criteria);

        console.log("byo",employees);

        
        var role = scheduler.getRole("Clerk");
        role.addShift("07:00","15:00",1,2);
        role.addShift("10:00","18:00",1,2);
        role.addShift("13:00","21:00",1,2);
        role.addShift("15:00","23:00",1,2);
        role.addShift("21:00","05:00",1,2);
        role.addShift("23:00","07:00",1,2);
        role.setScheduleRefresh("1W",0);
        //role.disableDay(0);


        //role.generate(scheduler.currentDate.getDateAfterDays(1).toArrayMMDDYYY(),7);
        
        
        //role.generate(scheduler.currentDate.getDateAfterDays(7).toArrayMMDDYYY(),7);
        for (var i=0;i<scheduler.employees.length;i++){
            var e = scheduler.employees[i];
            //console.log(e.fname +" "+e.lname+" assigns : "+e.assignments.length);
        }
        //console.log("hrs : "+scheduler.employees[0].getTotalHoursWorked());


        schedulerUI.changeRoleView("Clerk");
        //schedulerUI.loadRoleMonthly();
        console.log(scheduler.currentDate.Year,scheduler.currentDate.Month,scheduler.currentDate.Date,scheduler.currentDate.t);


        //var d = new DateCalc(Date.now());//new DateCalc(DateCalc.resetDay(Date.now()));
        //d.resetDay();
        //document.getElementById("timeLabel").innerHTML = (d.Month+1)+" "+d.Date+" "+d.Year+"<br>"+d.Hour +":"+d.Minutes+":"+d.Seconds;
        
        
        
        // --------------------------- SAUCE ^^^^
    </script>
    <script>
        $(document).ready(() => {

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $('#carousel').on('slide.bs.carousel', function (e) {
                var $e = $(e.relatedTarget);
                var idx = $e.index();
                var itemsPerSlide = 4;
                var totalItems = $('.carousel-item').length;
                
                if (idx >= totalItems-(itemsPerSlide-1)) {
                    var it = itemsPerSlide - (totalItems - idx);
                    for (var i=0; i<it; i++) {
                        // append slides to end
                        if (e.direction=="left") {
                            $('.carousel-item').eq(i).appendTo('.carousel-inner');
                        }
                        else {
                            $('.carousel-item').eq(0).appendTo('.carousel-inner');
                        }
                    }
                }
            });
            
            $('a.profile').on('click', function(){
                let id = $(this).siblings('input').val();
                var url = "{{ url('/dashboard/employee/') }}"+"/"+id;
                $.ajax({
                    url: url,
                    type: 'GET',
                    dataType: 'json',
                    contentType: 'application/json; charset=utf-8',
                    success: function (result) {
                        $('.modal .modal-header').html('');
                        $('.modal .modal-body').html('');
                        $('.modal .modal-header').html(`
                            Employee Profile
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        `);
                        $('.modal .modal-body').html(
                            `
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="author text-center">
                                                    <a href="#">
                                                        <img class="avatar border-gray" src="{{ asset('storage/avatar/') }}/`+result.data.profile.avatar+`" alt="Avatar" width="70" height="70">
                                                        <h5 class="name">`+result.data.name+`</h5>
                                                    </a>
                                                    <p class="text-black">`+check(result.data.email)+`</p>
                                                    <p class="text-black">`+result.data.position+`</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="card">
                                            <div class="card-header bg-primary text-white">Personal Information</div>
                                            <div class="card-body">
                                                <table class="table">
                                                    <tbody>
                                                        <tr>
                                                            <td>Gender</td>
                                                            <td>
                                                                `+checkGender(result.data.profile.gender)+`
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Birthday</td>
                                                            <td>
                                                                `+check(result.data.profile.birthdate)+`
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Contact</td>
                                                            <td>
                                                                `+check(result.data.profile.contact)+`
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Address</td>
                                                            <td>
                                                                `+check(result.data.address.number)+`
                                                                `+check(result.data.address.street)+`
                                                                `+check(result.data.address.city)+`
                                                                `+check(result.data.address.state)+`
                                                                `+check(result.data.address.zip)+`
                                                                `+check(result.data.address.country)+`
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="card">
                                            <div class="card-header bg-primary text-white">Schedules</div>
                                            <div class="card-body" style="height: 200px; overflow-y: auto;">
                                                
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6" id="evaluation_files">
                                        <div class="card">
                                            <div class="card-header bg-primary text-white">Evaluation</div>
                                            <div class="card-body" style="height: 200px; overflow-y: auto;">
                                                `+getEvaluation(result.evaluation)+`
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            `
                        );
                        $('input[type="checkbox"]').on('change', function() {
                            if ($(this).is(':checked')){ 
                                var url = "{{ url('/dashboard/evaluation/status/update') }}";
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
                                var url = "{{ url('/dashboard/evaluation/status/update') }}";
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

                    },
                });
            });


            function getEvaluation(evaluations){ 
                var data = '';
                var keys = Object.keys(evaluations);
                if(keys.length > 0){
                    for(var i = 0; i < keys.length; i++){
                        var d = new Date(evaluations[i].created_at);
                        var date = (d.getMonth()+1) + '/' + d.getDay() +'/'+ d.getFullYear();
                        data += `
                            <div class="row">
                                <div class="col-6">
                                    <a href="{{ asset('storage/pdf/') }}/`+evaluations[i].filename+`" target="_blank"> 
                                        `+evaluations[i].filename+`
                                    </a>
                                </div>
                                <div class="col-3">
                                    `+date+`
                                </div>`;
                        if(evaluations[i].active){
                            data += `
                                <div class="col-3">
                                    <input type="checkbox" id="active" value="`+evaluations[i].id+`" checked>
                                </div>
                            `;
                        } else {
                            data += `
                                <div class="col-3">
                                    <input type="checkbox" id="active" value="`+evaluations[i].id+`">
                                </div>
                            `;
                        }
                                
                        data += `
                            </div>
                        `;
                    }
                    return data;
                }

                return 'No Evaluation';
            }

            $('a.message').on('click', function(){
                let id = $(this).siblings('input').val();
                var url = "{{ url('/dashboard/employee/') }}"+"/"+id;
                $.ajax({
                    url: url,
                    type: 'GET',
                    dataType: 'json',
                    contentType: 'application/json; charset=utf-8',
                    success: function (result) {
                        $('.modal .modal-header').html('');
                        $('.modal .modal-body').html('');
                        $('.modal .modal-header').html(`
                            Requests
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        `);
                        $('.modal .modal-body').html(
                            `
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="card">
                                            <div class="card-header bg-primary text-white">Messages</div>
                                            <div class="card-body" style="height:70vh; overflow-y: auto">

                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="card">
                                            <div class="card-header bg-primary text-white">Messages</div>
                                            <div class="card-body" style="height:70vh">

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            `
                        );
                    },
                });
            });

            $('a.evaluation').on('click', function(){
                let id = $(this).siblings('input').val();
                var url = "{{ url('/dashboard/employee/') }}"+"/"+id;
                $.ajax({
                    url: url,
                    type: 'GET',
                    dataType: 'json',
                    contentType: 'application/json; charset=utf-8',
                    success: function (result) {
                        $('.modal .modal-header').html('');
                        $('.modal .modal-body').html('');
                        $('.modal .modal-header').html(`
                            Performance Evaluation form
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        `);
                        $('.modal .modal-body').html(
                            `
                            <div class="container-fluid">
                                <div class="row" id="evaluation-form">
                                    <div class="col-12">
                                        <div class="card">
                                            
                                            <div class="card-body">
                                                <form method="POST" action="{{ url('/dashboard/employee/`+id+`/evaluation_results') }}">
                                                @csrf
                                                <div class="container-fluid text-default">
                                                    <div class="row">
                                                        <div class="col-6">
                                                            Name: <strong>`+result.data.name+`</strong>
                                                        </div>
                                                        <div class="col-6">
                                                            <p class="float-right"> Date: <strong>{{ date('F d, Y') }} </strong></p>
                                                        </div>
                                                        <div class="col-6">
                                                            Employee ID: <strong> `+result.data.username+` </strong>
                                                        </div>
                                                    </div>
                                                    <hr>
                                                    <div class="row">
                                                        <div class="col-3">
                                                        <strong>FACTOR</strong> 
                                                        </div>
                                                        <div class="col-6">
                                                            <strong>DESCRIPTION</strong> 
                                                        </div>
                                                        <div class="col-3">
                                                            <strong>Evaluation</strong>
                                                        </div>
                                                    </div>
                                                    <hr>
                                                    @foreach(\App\Evaluation::all() as $eval)
                                                    <div class="row">
                                                        <div class="col-3">
                                                            {{ $eval->factor }}
                                                        </div>
                                                        <div class="col-6">
                                                            {{ $eval->description }} 
                                                        </div>
                                                        <div class="col-3">
                                                            <select class="form-control" name="{{ $eval->factor }}" id="eval">
                                                                <option value="0">0 - Not Applicable</option>
                                                                <option value="1">1 - Unsatisfactory</option>
                                                                <option value="2">2 - Below Average</option>
                                                                <option value="3">3 - Average</option>
                                                                <option value="4">4 - Above Average</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <hr>
                                                    @endforeach
                                                    <hr>
                                                    <div class="row">
                                                        <div class="col-12">
                                                            <div class="form-label-group">
                                                            <textarea class="form-control noresize" name="qualities" maxlength="200" id="qualities" rows="3" placeholder="Best qualities demonstrated"></textarea>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-12">
                                                            <div class="form-label-group">
                                                                <textarea class="form-control noresize" name="improvements" maxlength="200" id="improvements" rows="3" placeholder="How improvements can be Made"></textarea>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-12">
                                                            <div class="form-label-group">
                                                                <textarea class="form-control noresize" name="comments" maxlength="200" id="comments" rows="3" placeholder="Comments"></textarea>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row text-center">
                                                        <div class="col-md-12">
                                                            <button type="submit" class="btn btn-primary form-control text-white">
                                                                {{ __('Save & Print') }}
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            `
                        );
                    },
                });
            });
            
            function check(value){
                if(value == null)
                    return "";
                return value;
            }

            function checkGender(value){
                if(value == null)
                    return "";
                return (value == 1) ? "Male" : "Female";
            }

            $('#search').on("keyup", function(e){
                var value = $(this).val().toLowerCase();
                var content = $('#carousel').html();
                if(value == ''){
                    $('#carousel .carousel-inner').html(content);
                } else {
                    $('#carousel .carousel-inner .carousel-item').filter(function(){
                        $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                    });
                }
            });

        });
        //========================================================================================================================================================================
        //========================================================================================================================================================================
        //========================================================================================================================================================================
        //========================================================================================================================================================================

        //========================================================================================================================================================================
        //========================================================================================================================================================================
        //========================================================================================================================================================================
        //========================================================================================================================================================================
    </script>
@endsection