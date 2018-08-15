@extends('layouts.employee')

@section('custom_styles')
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
@endsection


@section('content')
<section style="margin-top:30px">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header bg-primary text-white">Evaluation</div>
                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Filename</th>
                                    <th>Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(count(auth()->user()->evaluation_files->where('active', 1)) > 0)
                                @foreach(auth()->user()->evaluation_files->where('active', 1)->sortByDesc('id') as $files)
                                <tr>
                                    <td>
                                        <a href="{{ asset('storage/pdf/') }}/{{ $files->filename }}" target="_blank">{{ $files->filename }} </a> 
                                    </td>
                                    <td>
                                        {{ $files->created_at->format('F d, Y') }}
                                    </td>
                                </tr>
                                @endforeach
                                @else
                                    No files.
                                @endif 
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@section('custom_scripts')
    <script src="//cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function(){
            $('.table').DataTable({

            });
        });
    </script>
@endsection