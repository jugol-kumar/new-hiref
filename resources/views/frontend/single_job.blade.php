@extends('frontend.layout.master')
@section('title', get_setting('name')." Single Job")
@push('css')
    <link rel="stylesheet" href="{{ asset('frontend/chat/') }}/css/chat.css">
    <link rel="stylesheet" href="{{ asset('frontend/chat/') }}/css/style.css">
    <link rel="stylesheet" href="{{ asset('frontend/chat/') }}/css/typing.css">
@endpush

@section('content')
    <div class="py-14">
        <div class="container">
            <div class="row">
                <div class="offset-xl-2 col-xl-8 col-md-12 ">
                    <div class="d-xl-flex ">
                        <div class="mb-3 mb-md-0">
                            <!-- Img -->
                            <img src="{{ config("app.url")."/storage/".$job->companyDetails->photos[1]->filename }}" alt="" width="78" height="78" class="icon-shape border rounded-circle">
                        </div>
                        <!-- text -->
                        <div class="ms-xl-3  w-100 mt-3 mt-xl-0">
                            <div class="d-flex justify-content-between mb-5">
                                <div>
                                    <h3 class="text-success text-capitalize">{{ $job->title }} ({{ $job->label }} / {{ $job->types }})</h3> {{ $job->id }}
                                    <div>
                                        at  <a class="text-capitalize" href="{{ route('client.singleCompany', ['company_name' => $job->companyDetails?->name, 'id' => $job->companyDetails?->id]) }}">{{ $job->companyDetails->name }} </a>
                                        <!-- star -->
                                        <span class="text-dark ms-2 fw-medium">{{ $job->show_count }}</span>
                                        <span class="ms-0">(Views)</span>
                                    </div>
                                </div>
                                <div>
                                    @if(auth()->user()?->saveJobs->where('job_id', $job->id)->count() > 0)
                                        <i class="text-black-50 mdi mdi-bookmark-check fs-2"></i>
                                    @else
                                        <a href="{{ route('save.job', ['slug' =>$job->slug, 'id' => $job->id]) }}">
                                            <i class="text-black-50 mdi mdi-bookmark-outline fs-2" disabled="true"></i>
                                        </a>
                                    @endif
                                </div>
                            </div>
                            <div class="d-md-flex justify-content-between ">
                                <div class="mb-2 mb-md-0">
                                    <!-- year -->
                                    <span class="me-2">
                                        <i class="fe fe-briefcase text-muted"></i>
                                        <span class="ms-1 ">{{ $job->min_experience }} - {{ $job->max_experience }} {{ $job->experience_type }}</span>
                                    </span>
                                    <!-- salary -->

                                    <span class="me-2">
                                        <i class="fe fe-dollar-sign text-muted"></i>
                                        <span class="ms-1 ">{{ $job->min_salary }} - {{ $job->max_salary }}</span>
                                    </span>
                                    <!-- location -->
                                    <span class="me-2">
                                        <i class="fe fe-map-pin text-muted"></i>
                                        <span class="ms-1 ">{{ $job->location }}</span>
                                    </span>
                                </div>
                                <!-- time -->
                                <div>
                                    <i class="fe fe-clock text-muted"></i> <span>{{ getTimeAgo($job->created_at) }}</span>
                                </div>
                            </div>
                            <div class="d-flex justify-content-between mt-2">
                                <div class="">
                                    Required Skills:
                                    @foreach(json_decode($job->skills) as $skill)
                                        <span class="border small-badge">{{ $skill }}</span>
                                    @endforeach
                                </div>
                                <div class="d-flex align-items-center">
                                    @if(Auth::check())
<!--                                    <form method="POST" action="{{ route('seeker.sendMessage') }}">
                                        @csrf
                                        <input type="hidden" name="rec_id" value="{{  $job->creator }}">
                                        <input type="hidden" name="job_id" value="{{ $job->id }}">
                                        <input type="hidden" name="type" value="recruiter">
                                        <button type="submit" class="btn btn-light-success btn-sm me-1">Apply Now</button>
                                    </form>-->
                                        @if($applyStatus > 0)
                                            <button type="button" id="alreadyApplied" class="btn btn-light-dark btn-sm me-1 btn-disabled">Already Apply</button>
                                        @else
                                            <a href="{{ route('client.applyJob', ['user_id' => auth()->id(), 'job'=> $job->slug, 'job_id' => $job->id]) }}" class="btn btn-light-success">Apply Now</a>
                                        @endif
                                    @else
                                        <button type="button" id="authNotLogin" class="btn btn-light-success btn-sm me-1">Apply Now</button>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                    <hr class="my-4">
                    <!-- text -->
                    <div>
                        <p><span>Job Applicants: <span class="text-dark">{{ $job->message_details_count }}</span></span></p>
                    </div>
                    <div>
                        {!! $job->job_details !!}
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="offset-xl-2 col-xl-8 col-md-12 ">
                    <div class="mt-12">
                        <h2 class="mb-4">Similar Jobs</h2>
                        @forelse($job->category->jobs->where('is_published', \App\Properties::$true)  as $job)
                            @include('frontend.inc.job_card')
                        @empty
                            <h2>No have any jobs like this</h2>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>


{{--    @include('frontend.inc.chat',  ['reactor' => $job->user])--}}
@endsection

@push('js')
    <script>
        $("#authNotLogin").on("click", ()=>{
            Toast.fire({
                icon: 'error',
                text:"Please Login First As Job Seeker And Apply Here"
            })
        })
        $("#alreadyApplied").on("click", ()=>{
            Toast.fire({
                icon: 'warning',
                text:"Already Applied This Job. Find Another Job Femaler With You"
            })
        })
    </script>
@endpush
