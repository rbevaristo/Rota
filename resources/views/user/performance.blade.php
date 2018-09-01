@extends('layouts.user')
@section('custom_styles')
<link rel="stylesheet" href="{{ asset('css/jquery.dataTables.min.css') }}">
<link rel="stylesheet" href="{{ asset('css/dataTables.bootstrap4.min.css') }}">
<link href="{{ asset('css/bootstrap-toggle.min.css') }}" rel="stylesheet">
@endsection
@section('content')
<section id="evaluation">
    <div class="container-fluid">
        <div class="card">
            <div class="card-header bg-primary text-white">
                Performance Evaluation
                <span class="float-right">
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
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    @if(count(auth()->user()->evaluation_files) > 0)
                    <table class="table w-100 d-block d-md-table text-center">
                        <thead>
                            <tr>
                                <th>Employee</th>
                                <th>File</th>
                                <th>Date</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach(auth()->user()->evaluation_files->sortByDesc('created_at') as $files)
                            @php
                                $emp = auth()->user()->employees->where('id', $files->emp_id)->first();
                            @endphp
                            <tr>
                                <td>
                                    <img src="{{ asset('storage/avatar') }}/{{ $emp->profile->avatar }}" class="rounded" alt="avatar">
                                    {{ Helper::employee_name($emp->firstname, $emp->lastname) }}                               
                                </td>
                                <td>
                                    <a href="{{ asset('storage/pdf/') }}/{{ $files->filename }}" target="_blank"> {{ substr($files->filename, 0, 10) }}... </a></td>
                                <td>{{ date('F d, Y', strtotime($files->created_at)) }}</td>
                                <td>
                                    <input type="checkbox" data-toggle="toggle" id="status" value="{{ $files->id }}" {{ ($files->active) ? 'checked' : '' }}>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @else
                        No files
                    @endif
                </div>
            </div>
        </div>
        {{-- <div class="row d-flex justify-content-center">
            <div class="col-md-4">
                <div class="card">
                    <canvas id="chart" width="100" height="100">    
                </div>
            </div>
        </div> --}}
    </div>
</section>
@endsection

@section('custom_scripts')
{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.min.js"></script>
{!! $chartjs->render() !!} --}}
<script src="{{ asset('js/lib/bootstrap-toggle.min.js') }}"></script>
<script src="{{ asset('js/lib/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('js/lib/dataTables.bootstrap4.min.js') }}"></script>
<script>
        $(document).ready(function(){
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

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
            $('#search').on("keyup", function(e){
                var value = $(this).val().toLowerCase();
                var content = $('tbody').html();
                if(value == ''){
                    $('tbody').html(content);
                } else {
                    $('tbody tr').filter(function(){
                        $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                    });
                }
            });
        });
</script>
@endsection