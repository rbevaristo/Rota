@extends('layouts.user')
@section('custom_styles')

@endsection
@section('content')
<section id="evaluation">
    <div class="container-fluid">
        
        <div class="row d-flex justify-content-center">
            <div class="col-md-4">
                <div class="card">
                    <canvas id="chart" width="100" height="100">    
                </div>
            </div>
        </div>
</section>
@endsection

@section('custom_scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.min.js"></script>
{!! $chartjs->render() !!}
@endsection