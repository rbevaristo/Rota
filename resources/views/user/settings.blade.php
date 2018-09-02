@extends('layouts.user')
@section('custom_styles')
<link rel="stylesheet" href="{{ asset('css/bootstrap-toggle.min.css') }}">
<style>
  .padding {
    padding: 5px;
  }
  input[type="number"] {
    width: 50px;
    padding:5px;
  }

  .gender_value {
    width: 80px;
  }

  #required input[type="number"]{
    padding: 0;
    font-size: 12px;
  }

  @media(max-width: 576px){
    #shifts .input-group-text {
      padding: 5px;
    }
    #shifts input[type="time"]{
      font-size: 10px;
      padding: 5px;
    }
    #required {
      font-size:10px;
    }

    #required input[type="number"]{
      width:30px;
    }
  }
</style>
@endsection

@section('content')
<section style="margin-top:30px">
    <div class="container-fluid">
        <div class="card">
          <div class="card-header text-white bg-primary">
            Scheduler Settings
            <span class="float-right dropdown">
                <a href="#" class="text-white dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fa fa-gear"></i>
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
                    <a class="dropdown-item" href="{{ route('user.manage') }}"><i class="fa fa-gear"></i> Manage Employees</a>                                
                </div>
            </span>
          </div>
          <div class="card-body">
            <div class="row">

            <div class="col-md-3">
              <div class="card">
                <div class="card-header">
                 <strong>Schedule</strong>
                </div>
                <div class="card-body">
                  <div class="row padding">
                    {{-- <div class="col-md-12">
                      <div class="form-group">
                        <div class="input-group">
                          <div class="input-group-prepend">
                              <div class="input-group-text">Days to Generate</div>
                          </div>
  
                          <input type="number" class="text-center num_days" name="num_days" id="{{ auth()->user()->setting->id }}" value="{{ auth()->user()->setting->num_days }}" min="7">
                        </div>
                      </div>
                    </div>
                    <div class="col-md-12">
                      <div class="form-group">
                        <div class="input-group">
                          <div class="input-group-prepend">
                              <div class="input-group-text">Dayoff</div>
                          </div>
  
                          <input type="number" class="text-center num_dayoff" name="num_dayoff" id="{{ auth()->user()->setting->id }}" value="{{ auth()->user()->setting->num_dayoff }}" min="1" disabled>
                        </div>
                      </div>
                    </div> --}}
                    <div class="col-md-12">
                        <div class="alert alert-info">
                         <small>Choose <strong>Dayoff</strong> to alter fix dayoff in the scheduler. </small> 
                        </div>
                        <div class="btn-group" role="group">

                            <button type="button" name="inactive" class="btn btn-sm btn-secondary btnDays" id="0">Sun</button>
                            <button type="button" name="inactive" class="btn btn-sm btn-secondary btnDays" id="0">Mon</button>
                            <button type="button" name="inactive" class="btn btn-sm btn-secondary btnDays" id="0">Tue</button>
                            <button type="button" name="inactive" class="btn btn-sm btn-secondary btnDays" id="0">Wed</button>
                            <button type="button" name="inactive" class="btn btn-sm btn-secondary btnDays" id="0">Thu</button>
                            <button type="button" name="inactive" class="btn btn-sm btn-secondary btnDays" id="0">Fri</button>
                            <button type="button" name="inactive" class="btn btn-sm btn-secondary btnDays" id="0">Sat</button>
                        
                        </div>
                    </div>
                  </div>
                  <div class="row padding">
                    <div class="col-md-12">
                        <div class="alert alert-info">
                            <small>Toggle <strong>Pass Lock</strong> to lock and unlock past dates schedules.</small>
                        </div>
                    </div>
                    <div class="col-8" style="margin-top:16px;">
                      
                      <div class="form-group">
                        <div class="input-group">
                          <div class="input-group-prepend">
                              <div class="input-group-text">Past Lock</div>
                          </div>
                        </div>
                        
                      </div>
                    </div>
                    <div class="col-4" style="margin-top:16px;">
                      <div class="form-group">
                        <input type="checkbox" data-toggle="toggle"" class="sched_lock" value="{{ auth()->user()->setting->sched_lock }}"  id="{{ auth()->user()->setting->id }}" name="sched_lock" {{ (auth()->user()->setting->sched_lock == 0) ? '' : 'checked' }}>                        
                      </div>
                    </div>


                  </div>
                </div>
              </div>
            </div>

            <div class="col-md-3">
              <div class="card">
                <div class="card-header">
                 <strong> Criteria </strong>
                </div>
                <div class="card-body">
                  <div class="row padding">
                    <div class="col-md-12">
                      <div class="alert alert-info">
                          <small>Options to alter scheduler. </small> 
                      </div>
                    </div>
                    <div class="col-8">
                      <div class="form-group">
                        <div class="input-group">
                          <div class="input-group-prepend">
                              <div class="input-group-text">Age > </div>
                          </div>
                          <input type="number" class="text-center criteria_value age_range" name="age_range" id="{{ auth()->user()->criteria->id }}" value="{{ auth()->user()->criteria->age_range }}" min="18" {{ (auth()->user()->criteria->age == 0) ? 'disabled': '' }}>
                        </div>
                      </div>
                    </div>
                    <div class="col-4">
                      <div class="form-group">
                        <input type="checkbox" data-toggle="toggle" class="criteria" value="{{ auth()->user()->criteria->id }}" id="age" name="age" {{ (auth()->user()->criteria->age == 0) ? '' : 'checked' }}>                        
                      </div>
                    </div>

                    <div class="col-8">
                      <div class="form-group">
                        <div class="input-group">
                          <div class="input-group-prepend">
                              <div class="input-group-text">Gender</div>
                          </div>
  
                          <select class="form-control criteria_value gender_value" name="gender_value" id="{{ auth()->user()->criteria->id }}" {{ auth()->user()->criteria->gender == 0 ? 'disabled' : '' }}>
                            @if(!auth()->user()->criteria->gender_value)
                            <option value="0">Female</option>
                            <option value="1">Male</option>
                            @else
                            <option value="1">Male</option>
                            <option value="0">Female</option>
                            @endif

                          </select>
                        </div>
                      </div>
                    </div>
                    <div class="col-4">
                      <div class="form-group">
                        <input type="checkbox" data-toggle="toggle" class="criteria" value="{{ auth()->user()->criteria->id }}" id="gender" name="gender" {{ (auth()->user()->criteria->gender == 0) ? '' : 'checked' }}>                        
                      </div>
                    </div>

                    <div class="col-8">
                      <div class="form-group">
                        <div class="input-group">
                          <div class="input-group-prepend">
                              <div class="input-group-text">Name</div>
                          </div>
  
                          <select class="form-control criteria_value name_value" name="name_value" id="{{ auth()->user()->criteria->id }}" {{ auth()->user()->criteria->name == 0 ? 'disabled' : '' }}>
                            @if(!auth()->user()->criteria->name_value)
                            <option value="0">Firstname</option>
                            <option value="1">Lastname</option>
                            @else
                            <option value="1">Lastname</option>
                            <option value="0">Firstname</option>
                            @endif
                          </select>
                        </div>
                      </div>
                    </div>
                    <div class="col-4">
                      <div class="form-group">
                        <input type="checkbox" data-toggle="toggle" class="criteria" value="{{ auth()->user()->criteria->id }}" id="name" name="name" {{ (auth()->user()->criteria->name == 0) ? '' : 'checked' }}>                        
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="col-md-6">
              <div class="card">
                <div class="card-header">
                <strong> Preferences </strong>
                </div>
                <div class="card-body">
                  
                  <div class="row padding" id="preferrence_dayoff">
                    <div class="col-md-12">
                      <div class="alert alert-info">
                          <small>Toggle <strong>Dayoff</strong> to enable employee to set their preferred dayoff.  </small> 
                      </div>
                    </div>
                    <div class="col-8">
                      Dayoff
                    </div>
                    <div class="col-4">
                      <input type="checkbox" data-toggle="toggle" class="settings" value="{{ auth()->user()->setting->id }}" id="dayoff" name="dayoff" {{ (auth()->user()->setting->dayoff == 0) ? '' : 'checked' }}>
                    </div>
                  </div>

                  <div class="row padding">
                    <div class="col-md-12">
                        <div class="alert alert-info">
                            <small>Toggle <strong>Shift</strong> to enable employee to set their preferred shift. </small> 
                        </div>
                    </div>
                    <div class="col-8">
                      Shift
                    </div>
                    <div class="col-4">
                        <input type="checkbox" data-toggle="toggle" class="settings" value="{{ auth()->user()->setting->id }}" id="shift" name="shift" {{ (auth()->user()->setting->shift == 0) ? '' : 'checked' }}>
                    </div>
                  </div>

                  {{-- <div class="row padding">
                    <div class="col-8">
                      Sharing
                    </div>
                    <div class="col-4">
                      <input type="checkbox" data-toggle="toggle" class="settings" value="{{ auth()->user()->setting->id }}" id="sharing" name="sharing" {{ (auth()->user()->setting->sharing == 0) ? '' : 'checked' }}>
                    </div>
                  </div> --}}

                  {{-- <div class="row padding">
                    <div class="col-8">
                      Shuffle
                    </div>
                    <div class="col-4">
                      <input type="checkbox" data-toggle="toggle" class="settings" value="{{ auth()->user()->setting->id }}" id="shuffle" name="shuffle" {{ (auth()->user()->setting->shuffle == 0) ? '' : 'checked' }}>
                    </div>
                  </div> --}}

                </div>
              </div>
            </div>
            
            <div class="col-md-12" id="shifts">
              <div class="card">
                <div class="card-header">
                <strong> Shifts </strong>
                </div>
                <div class="card-body">
                  
                  <div class="row padding">
                    <div class="col-md-12">
                      <div class="alert alert-info">
                          <small>Min Shift: 1 | Max Shift: 6 | To recreate shift do delete all first</small>
                      </div>
                    </div>
                    <div class="col-12">
                      @if(auth()->user()->shifts->count() == 0)
                      <div class="form-group">
                          <div class="input-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text">Number of Shifts </div>
                            </div>
                            <input type="number" name="nos" id="nos" value="0" min="0" max="6"> 
                            <button type="button" class="btn btn-default" id="nosBtn" data-toggle="modal" data-target="#modal" disabled>Go</button>
                          </div>
                      </div>
                      @endif
                      <div class="form-group">
                        @foreach(auth()->user()->shifts as $shift)
                          <div class="input-group">
                              {{-- <div class="input-group-text">
                                <input type="checkbox" id="shift_status" class="shift_active" value="{{ $shift->id }}" {{ ($shift->status) ? 'checked' : '' }}>
                              </div> --}}
                              <div class="input-group-prepend">
                                  <div class="input-group-text"><i class="fa fa-clock-o"></i></div>
                              </div>
                              <input type="time" class="form-control" name="{{ $shift->id }}" id="start" value="{{ $shift->start }}">
                              <div class="input-group-text">to</div>
                              <input type="time" class="form-control" name="{{ $shift->id }}" id="end" value="{{ $shift->end }}">
                              <div class="input-group-prepend">
                                  <div class="input-group-text"><i class="fa fa-clock-o"></i></div>
                              </div>
                              <div class="input-group-text">
                                <span class="delete_shift text-secondary" name="{{ $shift->id }}"><i class="fa fa-times"></i></span>
                              </div>
                          </div>
                        @endforeach
                      </div>
                    </div>
                  </div>
                  
                </div>
              </div>
            </div>

            <div class="col-md-12" id="required">
              <div class="card">
                <div class="card-header">
                 <strong>Required Per Position and Shift</strong>
                </div>
                <div class="card-body text-center">

                  <div class="row padding">
                    <div class="col-md-12">
                      <div class="alert alert-info">
                        Set the required min and max employee per shift.
                      </div>
                    </div>
                    <div class="col-md-2 col-4">
                      Shifts <br><br>
                      @php
                        $s = [];
                      @endphp
                      @foreach(auth()->user()->shifts as $shift)
                        @php
                          $s[] = $shift->id;
                        @endphp
                          <div class="form-group">
                              {{ substr($shift->start,0,5) }} - {{ substr($shift->end,0,5) }}
                          </div>
                      @endforeach
                    </div>
                    @php
                      $temp = '';
                      $count = 1;
                    @endphp
                    @foreach(auth()->user()->employees->sortBy('position_id') as $employee)

                      @if($temp != $employee->position->name)
                      @php
                        $temp = $employee->position->name;
                        $count = auth()->user()->employees->where('position_id', $employee->position->id)->where('status',1)->count();
                      @endphp
                      <div class="col-md-2 col-4">
                        <span class="position_name">{{ $employee->position->name }} 
                          <span class="badge badge-secondary post_counter">{{ $count }}</span>
                        </span> <br>
                        <span>min</span> <span> max</span>
                        @for($i = 0; $i < auth()->user()->shifts->count(); $i++)
                        <div class="form-group">
                            @php
                              $m = auth()->user()->required_shifts->where('position_id', $employee->position->id)->where('shift_id', $s[$i])->first();
                            @endphp
                            
                            <input type="number" class="text-center minimum" id="{{ $employee->position->id }}" name="{{ $s[$i] }}" min="0" max="{{ $count }}" value="{{ $m["min"] != null ? $m["min"] : 0 }}">

                            <input type="number" class="text-center maximum" id="{{ $employee->position->id }}" name="{{ $s[$i] }}" min="0" max="{{ $count }}" value="{{ $m["max"] != null ? $m["max"] : 0 }}" {{ $m["max"] > 0 ? '' : 'disabled' }}>
                        </div>
                        @endfor
                      </div>                     
                      @endif
                    @endforeach
                    
                  </div>


                </div>
              </div>
            </div>

            </div>
          </div>
        </div>
    </div>
</section>

<div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="modal" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Shift Configuration</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="{{ url('/dashboard/setting/shift/create') }}" method="POST">
        @csrf
      <div class="modal-body">
        <div class="container">
          <div class="row">

          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        <button type="submit" class="btn btn-primary" id="save_nos" disabled>Save Shifts</button>
      </div>
      </form>
    </div>
  </div>
</div>
@endsection

@section('custom_scripts')
<script src="{{ asset('js/lib/bootstrap-toggle.min.js') }}"></script>
<script>
  $(document).ready(function(){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $('#nos').on('change', function(){
      if($(this).val()!="" && $(this).val() != 0){
        $('#nosBtn').removeAttr('disabled');
      } else {
        $('#nosBtn').attr('disabled', 'true');
      }
    });
    
    $('#nosBtn').on('click', function(){
      var data = "";
      for(var i = 1; i <= $('#nos').val(); i++){
       data += `
        <div class="col-12">
          <div class="form-group">
              <div class="input-group">
                  <div class="input-group-prepend">
                      <div class="input-group-text"><i class="fa fa-clock-o"></i></div>
                  </div>
                  <input type="time" class="form-control" name="start_shift`+i+`" id="start">
                  <div class="input-group-text">to</div>
                  <input type="time" class="form-control" name="end_shift`+i+`" id="end">
                  <div class="input-group-prepend">
                      <div class="input-group-text"><i class="fa fa-clock-o"></i></div>
                  </div>
              </div>
          </div>
        </div>
       `;
      }
      $('.modal-body .container .row').html(data);
      if(data != "")
      $('.modal-footer button[type="submit"]').removeAttr('disabled');
      else
      $('.modal-footer button[type="submit"]').attr('disabled', 'true');
    });

    $('#save_nos').on('click', function(){
      $('.modal-body input').each(function(){
        console.log($(this).val());
      });
      $('#modal').modal('toggle');
    });

    $('.settings').on('change', function(){
      if($(this).is(':checked')){
          var url = "{{ url('/dashboard/setting/update/') }}";
          $.ajax({
              url: url,
              type: 'POST',
              data: {
                id: $(this).val(),
                column: $(this).attr('name'),
                value: 1
              },
              success: function (result) {
                toastr.info('Preference activated');
              },
          });
      } else {
          var url = "{{ url('/dashboard/setting/update/') }}";
          $.ajax({
              url: url,
              type: 'POST',
              data: {
                id: $(this).val(),
                column: $(this).attr('name'),
                value: 0
              },
              success: function (result) {
                toastr.warning('Preference deactivated');
              },
          });
      }
    });

    $('input[type="time"]').on('change', function(){
        var url = "{{ url('/dashboard/setting/shift/update') }}";
        $.ajax({
            url: url,
            type: 'POST',
            data: {
              id: $(this).attr('name'),
              column: $(this).attr('id'),
              value: $(this).val()
            },
            success: function (result) {
              toastr.info('Shift updated');
            },
        });
    });

    $('.shift_active').on('change', function(){
      if($(this).is(':checked')){
          var url = "{{ url('/dashboard/setting/shift/activate') }}";
          $.ajax({
              url: url,
              type: 'POST',
              data: {
                id: $(this).val(),
                value: 1
              },
              success: function (result) {
                toastr.info('Shift Activated');
              },
          });
      } else {
          var url = "{{ url('/dashboard/setting/shift/activate') }}";
          $.ajax({
              url: url,
              type: 'POST',
              data: {
                id: $(this).val(),
                value: 0
              },
              success: function (result) {
                toastr.warning('Shift deactivated');
              },
          });
      }
    });

    $('.criteria').on('change', function(){
      if($(this).is(':checked')){
          var url = "{{ url('/dashboard/setting/criteria/update') }}";
          $.ajax({
              url: url,
              type: 'POST',
              data: {
                id: $(this).val(),
                column: $(this).attr('name'),
                value: 1
              },
              success: function (result) {
                toastr.info('Criteria activated');
              },
          });
          if($(this).attr('name') == 'age'){
            $('.age_range').removeAttr('disabled');
          } else if($(this).attr('name') == 'gender'){
            $('.gender_value').removeAttr('disabled');
          } else if($(this).attr('name') == 'name'){
            $('.name_value').removeAttr('disabled');
          }
      } else {
          var url = "{{ url('/dashboard/setting/criteria/update') }}";
          $.ajax({
              url: url,
              type: 'POST',
              data: {
                id: $(this).val(),
                column: $(this).attr('name'),
                value: 0
              },
              success: function (result) {
                toastr.warning('Criteria deactivated');
              },
          });
          if($(this).attr('name') == 'age'){
            $('.age_range').attr('disabled', 'true');
          } else if($(this).attr('name') == 'gender'){
            $('.gender_value').attr('disabled', 'true');
          } else if($(this).attr('name') == 'name'){
            $('.name_value').attr('disabled', 'true');
          }
      }
    });

    $('.criteria_value').on('change', function(){
      var url = "{{ url('/dashboard/setting/criteria/update') }}";
      $.ajax({
          url: url,
          type: 'POST',
          data: {
            id: $(this).attr('id'),
            column: $(this).attr('name'),
            value: $(this).val()
          },
          success: function (result) {},
      });
    });

    $('.delete_shift').on('click', function(){
      var url = "{{ url('/dashboard/setting/shift/delete') }}";
        $.ajax({
            url: url,
            type: 'POST',
            data: {
              id: $(this).attr('name'),
            },
            success: function (result) {
              setTimeout(() => {
                toastr.warning('Shift deleted');
              }, 3000);
              location.reload();
            },
        });
    });

    $('.num_days').on('change', function(){
      var days = parseInt($(this).val());
      if(days < 7){
        $(this).val(7);
      }
      $('.num_dayoff').val(Math.floor(days/7));
      var url = "{{ url('/dashboard/setting/update/') }}";
      $.ajax({
          url: url,
          type: 'POST',
          data: {
            id: $(this).attr('id'),
            column: $(this).attr('name'),
            value: $(this).val()
          },
          success: function (result) {
            toastr.info('Days to generate updated');
          },
      });
      
      $.ajax({
          url: url,
          type: 'POST',
          data: {
            id: $('.num_dayoff').attr('id'),
            column: $('.num_dayoff').attr('name'),
            value: $('.num_dayoff').val()
          },
          success: function (result) {},
      });
    });


    $('.sched_lock').on('change', function(){
      if($(this).is(':checked')){
          var url = "{{ url('/dashboard/setting/update') }}";
          $.ajax({
              url: url,
              type: 'POST',
              data: {
                id: $(this).attr('id'),
                column: $(this).attr('name'),
                value: 1
              },
              success: function (result) {
              },
          });
          $('.sched_lock').removeAttr('disabled');
      } else {
          var url = "{{ url('/dashboard/setting/update') }}";
          $.ajax({
              url: url,
              type: 'POST',
              data: {
                id: $(this).attr('id'),
                column: $(this).attr('name'),
                value: 0
              },
              success: function (result) {
              },
          });
          $('.sched_lock').removeAttr('disabled');
      }
    });

    $('.minimum').on('change', function(){
      var min = parseInt($(this).val());
      var count = parseInt($(this).parent().siblings('span').children('span').html());
      if(min >= count){
        $(this).val(count);
      }
      $(this).siblings('.maximum').removeAttr('disabled');
      $(this).siblings('.maximum').val(count);
      
      var url = "{{ url('/dashboard/setting/shift/required/create') }}";
      $.ajax({
          url: url,
          type: 'POST',
          data: {
            position: $(this).attr('id'),
            min: $(this).val(),
            max: $(this).siblings('.maximum').val(),
            shift: $(this).attr('name')
          },
          success: function (result) {},
      });

    });

    $('.maximum').on('change', function(){
      var max = parseInt($(this).val());
      var min = parseInt($(this).siblings('.minimum').val());
      var count = parseInt($(this).parent().siblings('span').children('span').html());
      if(max >= count){
        $(this).val(count);
      }

      if(min > max){
        $(this).val(min);
      }

      var url = "{{ url('/dashboard/setting/shift/required/create') }}";
      $.ajax({
          url: url,
          type: 'POST',
          data: {
            position: $(this).attr('id'),
            min: $(this).siblings('.minimum').val(),
            max: $(this).val(),
            shift: $(this).attr('name')
          },
          success: function (result) {},
      });

    });
    var d = {!! auth()->user()->setting !!};
    var e = d.sched_dayoff.toString();
    var f = [];
    var c = d.num_dayoff;
    var dayoff_counter = 0;
    for(var i = 0; i < e.length; i++){
        f[i] = e.charAt(i);
    }

    if(d != null){
        var count = 0;
        $('.btnDays').each(function(){
            if(f[count] == '1'){
                $(this).removeClass('btn-secondary').addClass('btn-primary');
                $(this).removeAttr('name');
                $(this).attr('name', 'active');
                $(this).removeAttr('id');
                $(this).attr('id', '1');
                dayoff_counter++;
            }
            count++;
        });
    }
    
    if(dayoff_counter == c){
        $('.btnDays').each(function(){
            if($(this).attr('id') == '0'){
                $(this).attr('disabled', 'true');
            }
        });
    }

    $('#preferrence_dayoff')[{!! auth()->user()->setting->sched_dayoff !!}=="0000000"?"show":"hide"]();

    $('.btnDays').on('click', function(){
        var x = '';
        var cc = 0;
        if($(this).attr('name') == 'inactive'){
            $(this).removeClass('btn-secondary').addClass('btn-primary');
            $(this).removeAttr('name');
            $(this).attr('name', 'active');
            $(this).removeAttr('id');
            $(this).attr('id', '1');
            cc++;
        } else {
            $(this).removeClass('btn-primary').addClass('btn-secondary');
            $(this).removeAttr('name');
            $(this).attr('name', 'inactive');
            $(this).removeAttr('id');
            $(this).attr('id', '0');
            cc--;
        }
        $('.btnDays').each(function(){
            x += $(this).attr('id');
        });

        var url = "{{ url('dashboard/setting/schedule-dayoff/update') }}";
        $.ajax({
            url: url,
            type: 'POST',
            data: {
                // id: {!! auth()->user()->id !!},
                column: 'sched_dayoff',
                value: x.toString()
            },
            success: function (result) {
              //toastr.info('Dayoff updated'); //spam lag
            },
        });

        $('#preferrence_dayoff')[x=="0000000"?"show":"hide"]();

        if(cc == c){
            $('.btnDays').each(function(){
                if($(this).attr('id') == '0'){
                    $(this).attr('disabled', 'true');
                }
            }); 
        } else {
            $('.btnDays').each(function(){
                if($(this).attr('id') == '0'){
                    $(this).removeAttr('disabled');
                }
            }); 
        }
    });
  });
</script>
@endsection