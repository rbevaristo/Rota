@extends('layouts.user')
@section('custom_styles')
    <style>
        #schedule {
            margin-top: 30px;
        }
    </style>
@endsection
@section('content')
<section id="schedule">
    <div class="container-fluid">
        <div class="card">
            <div class="card-header bg-primary text-white">
                Schedule Files
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
                    @if(count(auth()->user()->schedule_files) > 0)
                    <table class="table w-100 d-block d-md-table text-center">
                        <thead>
                            <tr>
                                <th>File</th>
                                <th>Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach(auth()->user()->schedule_files->sortByDesc('created_at') as $files)
                            <tr>

                                <td>
                                    <a href="{{ asset('storage/schedule/') }}/{{ $files->filename }}" target="_blank"> {{ $files->filename }}</a></td>
                                <td>{{ date('F d, Y', strtotime($files->created_at)) }}</td>
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
    </div>
</section>
@endsection

@section('custom_scripts')
    <script>
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
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