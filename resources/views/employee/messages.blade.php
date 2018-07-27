@extends('layouts.employee')

@section('styles')
    
@endsection


@section('content')
<div class="row" >
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                Request Form
            </div>
            <div class="card-body">
            <form>
                <!-- service-form -->
                <div class="service-form">
                    <div class="row">
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12 ">
                            <div class="form-group">
                                <label class="control-label sr-only" for="subject"></label>
                                <input id="subject" type="text" placeholder="Subject" name="subject" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 col-12 ">
                            <div class="form-group">
                                <label class="control-label sr-only" for="start"></label>
                                <input type="text" class="form-control date-picker" id="start" required placeholder="Date" data-date-start-date="+7d" data-datepicker-color="">
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 col-12 ">
                            <div class="form-group">
                                <label class="control-label sr-only" for="end"></label>
                                <input type="text" class="form-control date-picker" id="end" required placeholder="Date" data-date-start-date="+7d" data-datepicker-color="">
                            </div>
                        </div>
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 ">
                            <div class="form-group">
                                <label class="control-label sr-only" for="textarea"></label>
                                <textarea class="form-control" id="textarea" name="textarea" rows="3" placeholder="Messages"></textarea>
                            </div>
                        </div>
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 ">
                            <button type="submit" name="singlebutton" class="btn btn-default btn-block mb10">send message</button>
                            <p><small>We promise we will never SPAM you with unwanted emails.</small></p>
                        </div>
                    </div>
                </div>
            </form>
            <!-- /.service-form -->
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                Messages
            </div>
            <div class="card-body">
                
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
    @parent
    <script src="{{ asset('js/plugins/bootstrap-datepicker.js') }}"></script>

    <script>

        $('.date-picker').datepicker({
            autoclose: true,
        }).on('changeDate', function(){
            console.log($(this).val());
        });
    </script>
@endsection