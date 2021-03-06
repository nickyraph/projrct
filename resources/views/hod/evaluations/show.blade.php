@extends('layouts.main')

@section('page-title')
    Evaluation Details
@endsection

@section('content')
    <hr class="mb-4">
    <div class="row g-4 settings-section">
        <div class="col-12 col-md-12">
            <div class="app-card app-card-settings shadow-sm p-4">
                <div class="app-card-body text-center">
                    <h3>{{$course->name}} </h3>
                    <hr>
                    Lecturer(s):
                    @forelse($course->lecturers as $lecturer)
                        <span class="mr-3">{{$loop->iteration.": ".$lecturer->first_name." ".$lecturer->last_name}}</span>
                    @empty
                        -
                    @endforelse
                </div>
            </div>
        </div>
        <div class="row g-4 mb-4">
            @if($studentEv == null)
                 <div class="app-card app-card-settings shadow-sm ml-3">
                     <div class="app-card-body">
                         <h4 class="text-center py-5">No Evaluations Yet!</h4>
                     </div>
                 </div>
            @else

                <span>Evaluation progress: </span>
                <div class="progress" style="height: 20px;">
                    <div class="progress-bar @if($studentEv <= 30) bg-danger @elseif($studentEv > 30 && $studentEv <= 60) bg-warning @elseif($studentEv > 60 && $studentEv <= 80) bg-info @else bg-success @endif progress-bar-animated" role="progressbar"  style="width: {{$studentEv}}%" aria-valuenow="{{$studentEv}}" aria-valuemin="0" aria-valuemax="100">
                        {{$studentEv}}%
                    </div>
                </div>
                <h4>
                    <a class="btn btn-primary w-100" data-toggle="collapse" href="#evaluations" >
                        Evaluations
                    </a>
                </h4>

                <div class="collapse multi-collapse" id="evaluations">
                    <div class="row">
                        @forelse($data as $chart)
                            <div class="col-md-4 mt-4">
                                <div class="app-card app-card-stat shadow-sm">
                                    <div class="card-body">
                                        {!! $chart['student']->container() !!}
                                    </div>
                                    <p class="text-left pb-3 pl-4"> Teacher's answer: {{$chart['lecturer' ?? "-"]}}</p>
                                </div>
                            </div>
                        @empty
                        @endforelse
                    </div>
                </div>

                @if($studentEv === 100)
                    <h4>
                        <a class="btn btn-primary w-100" data-toggle="collapse" href="#summary" >
                            Summary
                        </a>
                    </h4>
                    <div class="row collapse multi-collapse" id="summary">
                        <div class="card ml-3">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-sm text-center">
                                        <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Criteria</th>
                                            <th>Lecturer Answers</th>
                                            <th>Students Answers</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr>
                                            <td>1</td>
                                            <td class="text-left">If class tests were done</td>
                                            <td><span class="text-secondary"><b>{{$lecturer_answers['class_test']}}</b></span></td>
                                            <td><span class="text-secondary"><b>{{$summary['class_test']}}</b></span></td>
                                        </tr>

                                        <tr>
                                            <td>2</td>
                                            <td class="text-left">If class assignments were done</td>
                                            <td><span class="text-secondary"><b>{{$lecturer_answers['assignment']}}</b></span></td>
                                            <td><span class="text-secondary"><b>{{$summary['assignment']}}</b></span></td>
                                        </tr>

                                        <tr>
                                            <td>3</td>
                                            <td class="text-left">If corrections were made:</td>
                                            <td><span class="text-secondary"><b>{{$lecturer_answers['corrections']}}</b></span></td>
                                            <td><span class="text-secondary"><b>{{$summary['corrections']}}</b></span></td>
                                        </tr>

                                        <tr>
                                            <td>4</td>
                                            <td class="text-left">Frequency of tests & assignments return</td>
                                            <td><span class="text-secondary"><b>{{$lecturer_answers['test_returned']}}</b></span></td>
                                            <td><span class="text-secondary"><b>{{$summary['test_returned']}}</b></span></td>
                                        </tr>

                                        <tr>
                                            <td>5</td>
                                            <td class="text-left">Understanding level</td>
                                            <td><span class="text-secondary"><b>{{$lecturer_answers['understanding']}}</b></span></td>
                                            <td><span class="text-secondary"><b>{{$summary['understanding']}}</b></span></td>
                                        </tr>

                                        <tr>
                                            <td>6</td>
                                            <td class="text-left">Availability of Materials</td>
                                            <td><span class="text-secondary"><b>{{$lecturer_answers['material_available']}}</b></span></td>
                                            <td><span class="text-secondary"><b>{{$summary['material_available']}}</b></span></td>
                                        </tr>

                                        <tr>
                                            <td>7</td>
                                            <td class="text-left">Course is organized in a manner that helped students in understanding the underlying concept</td>
                                            <td><span class="text-secondary"><b>{{$lecturer_answers['well_organized']}}</b></span></td>
                                            <td><span class="text-secondary"><b>{{$summary['well_organized']}}</b></span></td>
                                        </tr>

                                        <tr>
                                            <td>8</td>
                                            <td class="text-left">Course is worth recommending to the coming students</td>
                                            <td><span class="text-secondary"><b>{{$lecturer_answers['recommend']}}</b></span></td>
                                            <td><span class="text-secondary"><b>{{$summary['recommend']}}</b></span></td>
                                        </tr>

                                        <tr>
                                            <td>9</td>
                                            <td class="text-left">Course meets expectations</td>
                                            <td><span class="text-secondary"><b>{{$lecturer_answers['meet_expectations']}}</b></span></td>
                                            <td><span class="text-secondary"><b>{{$summary['meet_expectations']}}</b></span></td>
                                        </tr>

                                        <tr>
                                            <td>10</td>
                                            <td class="text-left">Course is helpful in progressing towards student's study</td>
                                            <td><span class="text-secondary"><b>{{$lecturer_answers['helpful']}}</b></span></td>
                                            <td><span class="text-secondary"><b>{{$summary['helpful']}}</b></span></td>
                                        </tr>

                                        </tbody>
                                    </table>
                                </div>

                                <div class="mt-2 d-flex justify-content-center">
                                    <a href="{{route('print.evaluation', [$course->id, $course->year])}}" class="btn btn-info mr-2"><i class="fas fa-print mr-1"></i>Print</a>
                                    <a href="{{route('download.evaluation', [$course->id, $course->year])}}" class="btn btn-success"><i class="fas fa-download mr-1"></i>Download</a>
                                </div>


                             @if(auth()->user()->role_id === 4)
                                <h4>Remark1s</h4>
                                <hr>
                                @if($course->remarks()->count() > 0)
                                    <h6 class="text-center">Remarks already submitted</h6>
                                @else
                                <form action="{{route('hod.remarks.store')}}" method="post">
                                    @csrf
                                    <input type="hidden" name="course_id" value="{{$course->id}}">
                                     <div class="form-group">
                                         <label for="">Remarks</label>
                                         <textarea name="remarks" id="remarks" cols="30" rows="20" class="form-control @error('remarks') is-invalid @enderror"></textarea>
                                         @error('remarks')
                                         <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                         @enderror
                                     </div>
                                    <button class="btn btn-success">Submit</button>
                                </form>
                                @endif
                             @endif
                            </div>
                        </div>
                    </div>
                @endif
            @endif
       </div>
   </div>

@endsection
@section('scripts')
    <script src="{{asset('js/apexcharts.js')}}"></script>
{{--    <script src="{{ $data['class_test']['student']->cdn() }}"></script>--}}

    @forelse($data as $chart)
        {{ $chart['student']->script() }}
    @empty
    @endforelse

@endsection
