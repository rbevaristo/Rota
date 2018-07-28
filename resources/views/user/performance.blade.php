@extends('layouts.user')

@section('breadcrumb')
    <li class="breadcrumb-item" aria-current="page">
        <a href="{{ route('dashboard')}}"><span class="fa fa-home"></span><span class="breadcrumb-text"> Home</span></a>
    </li>
    <li class="breadcrumb-item {{ Request::is('dashboard/performance-evaluation') ? 'active' : '' }}" aria-current="page">
        <a href="{{ route('user.performance')}}"><span class="fa fa-bar-chart"></span><span class="breadcrumb-text"> Performance Evaluation</span></a>
    </li>
@endsection
@section('content')
<div class="row">
    {{-- <div class="card">
        <div class="card-header">

        </div>
        <div class="card-body text-center"> --}}
            {{-- <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="table-responsive">
                            <table class="table table-responsive w-100 d-block d-md-table" id="eval-table">
                                <caption>LEGEND: S = Satisfactory   A = Adequate    NI = Needs Improvement</caption>
                                <thead>
                                    <tr>
                                        <th colspan="3">Evaluation Factors</th>
                                        <th>S</th>
                                        <th>A</th>
                                        <th>NI</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td rowspan="2" style="vertical-align: middle">Dedication</td>
                                        <td colspan="2">Reports to work on time.</td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">Uses time constructively.</td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td rowspan="2" style="vertical-align: middle">Performance</td>
                                        <td colspan="2">Good working knowledge of job assignment.</td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">Organizes and performs work in a timely, professional manner.</td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td rowspan="2" style="vertical-align: middle">Cooperation</td>
                                        <td colspan="2">Willingly accepts work assignments.</td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">Willingly accepts changes in assignments not directly related to job.</td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td rowspan="3" style="vertical-align: middle">Initiative</td>
                                        <td colspan="2">Performs assigned duties with little or no supervision.</td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">Performs assigned duties with little or no supervision, even under pressure.</td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">Strives to meet deadlines.</td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td style="vertical-align: middle">Communication</td>
                                        <td colspan="2">Communicates clearly and intelligently in person and during telephone contacts.</td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td style="vertical-align: middle">Teamwork</td>
                                        <td colspan="2">Works well with fellow employees without friction.</td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td style="vertical-align: middle">Character</td>
                                        <td colspan="2">Accepts constructive criticism without unfavorable responses.</td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td style="vertical-align: middle">Responsiveness</td>
                                        <td colspan="2">Handles stressful situations with tact.</td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td style="vertical-align: middle">Personality</td>
                                        <td colspan="2">Demonstrates a pleasant, calm personality when dealing with customers and fellow employees.</td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td rowspan="2" style="vertical-align: middle">Appearance</td>
                                        <td colspan="2">Well groomed. Clean. Neat.</td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">Dresses appropriately for work.</td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td rowspan="2" style="vertical-align: middle">Work Habits</td>
                                        <td colspan="2">Maintains neat and orderly workstation.</td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">Maintains neat and orderly paperwork.</td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                </tbody>
                            </table>
                            <div class="form-group">
                                <label for="comments" style="color: #333">Comments or Recommendations</label>
                                <textarea class="form-control" placeholder="Comments or Recommendations" rows="5" id="comments" name="comments"></textarea>
                            </div>
                            <div class="form-group float-right">
                                <button class="btn btn-primary">Submit</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div> --}}
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="d-flex align-items-center p-3 my-3 bg-purple rounded shadow-sm">
                                <div class="lh-100">
                                    <h6 class="mb-0 lh-100">Performance Evaluation</h6>
                                    <small>LEGEND: S = Satisfactory   A = Adequate    NI = Needs Improvement</small>
                                    <hr>
                                </div>
                            </div>
                            
                            <div class="my-3 p-3 bg-white rounded shadow-sm">
                                <h6 class="border-bottom border-gray pb-2 mb-0">Evaluation Factors <span class="float-right">S  A  NI</span></h6>
                                <div class="media text-muted pt-2">
                                    <div class="media-body pb-3 mb-0 small lh-125 border-bottom border-gray">
                                        <div class="d-flex justify-content-between">
                                            <strong class="text-gray-dark">Dedication</strong>
                                            <strong class="turn-small">
                                                Reports to work on time.           <br>
                                                Uses time constructively.             
                                            </strong>
                                            <div>
                                                <label class="checkbox-inline">
                                                    <input type="checkbox" value="">
                                                </label>
                                                <label class="checkbox-inline">
                                                    <input type="checkbox" value="">
                                                </label>
                                                <label class="checkbox-inline">
                                                    <input type="checkbox" value="">
                                                </label> <br>
                                                <label class="checkbox-inline">
                                                    <input type="checkbox" value="">
                                                </label>
                                                <label class="checkbox-inline">
                                                    <input type="checkbox" value="">
                                                </label>
                                                <label class="checkbox-inline">
                                                    <input type="checkbox" value="">
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="media text-muted pt-3">
                                    <div class="media-body pb-3 mb-0 small lh-125 border-bottom border-gray">
                                        <div class="d-flex justify-content-between">
                                            <strong class="text-gray-dark">Performance</strong>
                                            <strong class="turn-small">
                                                Good working knowledge of job assignment. <br>
                                                Organizes and performs work in a timely, professional manner.
                                            </strong>
                                            <div>
                                                <label class="checkbox-inline">
                                                    <input type="checkbox" value="">
                                                </label>
                                                <label class="checkbox-inline">
                                                    <input type="checkbox" value="">
                                                </label>
                                                <label class="checkbox-inline">
                                                    <input type="checkbox" value="">
                                                </label> <br>
                                                <label class="checkbox-inline">
                                                    <input type="checkbox" value="">
                                                </label>
                                                <label class="checkbox-inline">
                                                    <input type="checkbox" value="">
                                                </label>
                                                <label class="checkbox-inline">
                                                    <input type="checkbox" value="">
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="media text-muted pt-3">
                                    <div class="media-body pb-3 mb-0 small lh-125 border-bottom border-gray">
                                        <div class="d-flex justify-content-between">
                                            <strong class="text-gray-dark">Cooperation</strong>
                                            <strong class="turn-small">
                                                Willingly accepts work assignments. <br>
                                                Willingly accepts changes in assignments not directly related to job.
                                            </strong>
                                            <div>
                                                <label class="checkbox-inline">
                                                    <input type="checkbox" value="">
                                                </label>
                                                <label class="checkbox-inline">
                                                    <input type="checkbox" value="">
                                                </label>
                                                <label class="checkbox-inline">
                                                    <input type="checkbox" value="">
                                                </label> <br>
                                                <label class="checkbox-inline">
                                                    <input type="checkbox" value="">
                                                </label>
                                                <label class="checkbox-inline">
                                                    <input type="checkbox" value="">
                                                </label>
                                                <label class="checkbox-inline">
                                                    <input type="checkbox" value="">
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="media text-muted pt-3">
                                    <div class="media-body pb-3 mb-0 small lh-125 border-bottom border-gray">
                                        <div class="d-flex justify-content-between">
                                            <strong class="text-gray-dark">Initiative</strong>
                                            <strong class="turn-small">
                                                Performs assigned duties with little or no supervision. <br>
                                                Performs assigned duties with little or no supervision, even under pressure. <br>
                                                Strives to meet deadlines.
                                            </strong>
                                            <div>
                                                <label class="checkbox-inline">
                                                    <input type="checkbox" value="">
                                                </label>
                                                <label class="checkbox-inline">
                                                    <input type="checkbox" value="">
                                                </label>
                                                <label class="checkbox-inline">
                                                    <input type="checkbox" value="">
                                                </label> <br>
                                                <label class="checkbox-inline">
                                                    <input type="checkbox" value="">
                                                </label>
                                                <label class="checkbox-inline">
                                                    <input type="checkbox" value="">
                                                </label>
                                                <label class="checkbox-inline">
                                                    <input type="checkbox" value="">
                                                </label> <br>
                                                <label class="checkbox-inline">
                                                    <input type="checkbox" value="">
                                                </label>
                                                <label class="checkbox-inline">
                                                    <input type="checkbox" value="">
                                                </label>
                                                <label class="checkbox-inline">
                                                    <input type="checkbox" value="">
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="media text-muted pt-3">
                                    <div class="media-body pb-3 mb-0 small lh-125 border-bottom border-gray">
                                        <div class="d-flex justify-content-between">
                                            <strong class="text-gray-dark">Communication</strong>
                                            <strong class="turn-small">
                                                Communicates clearly and intelligently in person and during telephone contacts.
                                            </strong>
                                            <div>
                                                <label class="checkbox-inline">
                                                    <input type="checkbox" value="">
                                                </label>
                                                <label class="checkbox-inline">
                                                    <input type="checkbox" value="">
                                                </label>
                                                <label class="checkbox-inline">
                                                    <input type="checkbox" value="">
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                

                                <div class="media text-muted pt-3">
                                    <div class="media-body pb-3 mb-0 small lh-125 border-bottom border-gray">
                                        <div class="d-flex justify-content-between">
                                            <strong class="text-gray-dark">Teamwork</strong>
                                            <strong class="turn-small">
                                                Works well with fellow employees without friction. <br>
                                            </strong>
                                            <div>
                                                <label class="checkbox-inline">
                                                    <input type="checkbox" value="">
                                                </label>
                                                <label class="checkbox-inline">
                                                    <input type="checkbox" value="">
                                                </label>
                                                <label class="checkbox-inline">
                                                    <input type="checkbox" value="">
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="media text-muted pt-3">
                                    <div class="media-body pb-3 mb-0 small lh-125 border-bottom border-gray">
                                        <div class="d-flex justify-content-between">
                                            <strong class="text-gray-dark">Character</strong>
                                            <strong class="turn-small">
                                                Accepts constructive criticism without unfavorable responses.
                                            </strong>
                                            <div>
                                                <label class="checkbox-inline">
                                                    <input type="checkbox" value="">
                                                </label>
                                                <label class="checkbox-inline">
                                                    <input type="checkbox" value="">
                                                </label>
                                                <label class="checkbox-inline">
                                                    <input type="checkbox" value="">
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="media text-muted pt-3">
                                    <div class="media-body pb-3 mb-0 small lh-125 border-bottom border-gray">
                                        <div class="d-flex justify-content-between">
                                            <strong class="text-gray-dark">Responsiveness</strong>
                                            <strong class="turn-small">
                                                Demonstrates a pleasant, calm personality when dealing with customers and fellow employees.
                                            </strong>
                                            <div>
                                                <label class="checkbox-inline">
                                                    <input type="checkbox" value="">
                                                </label>
                                                <label class="checkbox-inline">
                                                    <input type="checkbox" value="">
                                                </label>
                                                <label class="checkbox-inline">
                                                    <input type="checkbox" value="">
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="media text-muted pt-3">
                                    <div class="media-body pb-3 mb-0 small lh-125 border-bottom border-gray">
                                        <div class="d-flex justify-content-between">
                                            <strong class="text-gray-dark">Appearance</strong>
                                            <strong class="turn-small">
                                                Well groomed. Clean. Neat. <br>
                                                Dresses appropriately for work.
                                            </strong>
                                            <div>
                                                <label class="checkbox-inline">
                                                    <input type="checkbox" value="">
                                                </label>
                                                <label class="checkbox-inline">
                                                    <input type="checkbox" value="">
                                                </label>
                                                <label class="checkbox-inline">
                                                    <input type="checkbox" value="">
                                                </label> <br>
                                                <label class="checkbox-inline">
                                                    <input type="checkbox" value="">
                                                </label>
                                                <label class="checkbox-inline">
                                                    <input type="checkbox" value="">
                                                </label>
                                                <label class="checkbox-inline">
                                                    <input type="checkbox" value="">
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="media text-muted pt-3">
                                    <div class="media-body pb-3 mb-0 small lh-125 border-bottom border-gray">
                                        <div class="d-flex justify-content-between">
                                            <strong class="text-gray-dark">Work Habits</strong>
                                            <strong class="turn-small">
                                                    Maintains neat and orderly workstation. <br>
                                                    Maintains neat and orderly paperwork.
                                            </strong>
                                            <div>
                                                <label class="checkbox-inline">
                                                    <input type="checkbox" value="">
                                                </label>
                                                <label class="checkbox-inline">
                                                    <input type="checkbox" value="">
                                                </label>
                                                <label class="checkbox-inline">
                                                    <input type="checkbox" value="">
                                                </label> <br>
                                                <label class="checkbox-inline">
                                                    <input type="checkbox" value="">
                                                </label>
                                                <label class="checkbox-inline">
                                                    <input type="checkbox" value="">
                                                </label>
                                                <label class="checkbox-inline">
                                                    <input type="checkbox" value="">
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
            
                
            </div>
        {{-- </div>
    </div> --}}
</div>
@endsection
