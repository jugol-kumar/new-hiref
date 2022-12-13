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
                            <img src="{{ config("app.url")."/storage/".$job->companyDetails->photos[0]->filename }}" alt="" width="78" height="78" class="icon-shape border rounded-circle">
                        </div>
                        <!-- text -->
                        <div class="ms-xl-3  w-100 mt-3 mt-xl-0">
                            <div class="d-flex justify-content-between mb-5">
                                <div>
                                    <h3 class="text-success">{{ $job->title }} ({{ $job->label }} / {{ $job->types }})</h3>
                                    <div>
                                        <span>at {{ $job->companyDetails->name }} </span>
                                        <!-- star -->
                                        <span class="text-dark ms-2 fw-medium">4.5 <svg xmlns="http://www.w3.org/2000/svg" width="10"
                                                                                        height="10" fill="currentColor" class="bi bi-star-fill text-warning align-baseline"
                                                                                        viewBox="0 0 16 16">
                        <path
                            d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z" />
                      </svg>
                                            <!-- text -->
                    </span><span class="ms-0">(131 Reviews)</span>
                                    </div>
                                </div>
                                <div>
                                    <!-- bookmark -->
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                         class="bi bi-bookmark text-muted bookmark" viewBox="0 0 16 16">
                                        <path
                                            d="M2 2a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v13.5a.5.5 0 0 1-.777.416L8 13.101l-5.223 2.815A.5.5 0 0 1 2 15.5V2zm2-1a1 1 0 0 0-1 1v12.566l4.723-2.482a.5.5 0 0 1 .554 0L13 14.566V2a1 1 0 0 0-1-1H4z" />
                                    </svg>
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
                                                    <span class="ms-1 ">12k - 18k</span>
                                                </span>
                                    <!-- location -->
                                    <span class="me-2">
                                                    <i class="fe fe-map-pin text-muted"></i>
                                                    <span class="ms-1 ">{{ $job->location }}</span>
                                                </span>
                                </div>
                                <!-- time -->
                                <div>
                                    <i class="fe fe-clock text-muted"></i> <span>{{ $job->created_at->diffForhumans() }}</span>
                                </div>
                            </div>
                            <div class="d-flex justify-content-between mt-2">
                                <div class="">
                                    Required Skills:
                                    @foreach(json_decode($job->skills) as $skill)
                                        <span class="badge me-1 bg-light-success text-success">{{ $skill }}</span>
                                    @endforeach
                                </div>
                                <div class="d-flex align-items-center">
                                    <button class="btn btn-light-primary btn-sm me-1">Apply Now</button>
                                    <button class="btn btn-light-success btn-sm"> <i class="mdi mdi-message"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <hr class="my-4">
                    <!-- text -->
                    <div>
                        <p><span>Job Applicants: <span class="text-dark">306</span></span></p>
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
                        @forelse($job->category->jobs  as $job)
                            @include('frontend.inc.job_card')
                        @empty

                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>


{{--    @include('frontend.inc.chat',  ['reactor' => $job->user])--}}
@endsection
