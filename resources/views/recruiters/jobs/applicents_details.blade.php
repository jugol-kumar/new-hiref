@extends('frontend.layout.master')

@section('title', 'verification number')

@section('content')

    <div class="bg-light-primary py-lg-14 py-12 bg-cover ">
        <div class="container">
            <div class="col-md-6 mx-auto">
                <div class="card">
                    <div class="card-header bg-light-success d-flex justify-content-between">
                        <a href="{{ route('recruiter.downloadSeekerCV', ['user_id' => $user->id]) }}" class="btn btn-flat-danger fs-3"> <i class="fe fe-download-cloud"></i> Download CV</a>
{{--                        <a class="btn btn-flat-danger fs-3"> <i class="fe fe-eye"></i> View CV</a>--}}
                    </div>
                    <div class="card-body">
                        <div class="d-flex align-items-start justify-content-between">
                            <div>
                                <h2 class="card-title">{{ $user->name }}</h2>
                                <p>{{ $user->seeker?->designation }} | {{ $user->seeker?->company_name }}</p>
                            </div>
                            <img class="avatar rounded-circle" src="{{ asset($user->photo) }}" alt="">
                        </div>
                        <hr class="my-4">
                        <div class="">
                            <p class="fw-medium">No searching job now</p>
                            <div class="d-flex align-items-start justify-content-between">
                                <div class="d-flex align-items-baseline">
                                    <i class="mdi mdi-briefcase-check fs-2 fw-bold text-black-50"></i>
                                    <p class="ms-2 fw-semibold">{{ $user->seeker?->end_date->format('y') - $user->seeker?->start_date->format('y') }} years</p>
                                </div>
                                <div class="d-flex align-items-baseline">
                                    <i class="mdi mdi-school fs-2 fw-bold text-black-50"></i>
                                    <p class="ms-2 fw-semibold">{{ $user->seeker?->end_date->format('y') - $user->seeker?->start_date->format('y') }} years</p>
                                </div>
                                <div class="d-flex align-items-baseline">
                                    <i class="mdi mdi-cake-layered fs-2 fw-bold text-black-50"></i>
                                    <p class="ms-2 fw-semibold">{{ $user->seeker?->end_date->format('y') - $user->seeker?->start_date->format('y') }} years</p>
                                </div>
                            </div>
                            <p class="">{{ $user->about }}</p>
                        </div>
                        <hr class="my-4">

                        <div>
                            <h2 class="d-flex align-items-center text-black-50 mb-5"><span class="badge-dot bg-success me-3"></span>Job Preference</h2>

                            <div class="d-flex align-items-center justify-content-between">
                                <h3 class="text-capitalize">{{ $user->seeker?->category->name }}</h3>
                                <h5>{{ $user->seeker?->exp_min_sal }} LPA- {{ $user->seeker?->exp_max_sal }}LPA</h5>
                            </div>
                            <p class="mb-0 pb-0">{{ $user->seeker?->types }}</p>
                            <p class="my-0 py-0">{{ $user->seeker?->division->name }}, {{ $user->seeker?->district->name }}</p>
                        </div>
                        <hr class="my-4">

                        <div>
                            <h2 class="d-flex align-items-center text-black-50 mb-5"><span class="badge-dot bg-success me-3"></span>Working Experience</h2>

                            <div class="d-flex align-items-center justify-content-between">
                                <h3 class="text-capitalize">{{ $user->seeker?->company_name }}</h3>
                                <h5>{{ $user->seeker?->start_date->format("M, Y") }} - {{ $user->seeker?->end_date->format("M, Y") }}</h5>
                            </div>
                            <p class="mb-0 pb-0">{{ $user->seeker?->designation }}</p>

                            <p class="mt-3">{{ $user->seeker?->experience }}</p>
                        </div>
                        <hr class="my-4">

                        <div>
                            <h2 class="d-flex align-items-center text-black-50 mb-5"><span class="badge-dot bg-success me-3"></span>Education</h2>

                            <div class="d-flex align-items-center justify-content-between">
                                <h3 class="text-capitalize">{{ $user->seeker?->university }}</h3>
                                <h5>{{ $user->seeker?->uni_start_date->format("M, Y") }} - {{ $user->seeker?->uni_end_date->format("M, Y") }}</h5>
                            </div>
                            <p class="mb-0 pb-0">{{ $user->seeker?->education_level->label }} / {{ $user->seeker?->educaiton->education_name }}</p>
                        </div>
                        <hr class="my-4">
                        <div>
                            <div class="d-flex align-items-start justify-content-between">
                                <h2 class="d-flex align-items-center text-black-50 mb-5">
                                    <span class="badge-dot bg-success me-3"></span>
                                    My Skaills
                                </h2>
                            </div>

                            @if(json_decode(json_decode($user->seeker?->skills)) != null)
                                @forelse(json_decode(json_decode($user->seeker?->skills)) as $skill)
                                    <span class="badge bg-light-secondary text-black-50">{{ $skill->value }}</span>
                                @empty
                                @endforelse
                            @endif
                        </div>
                        <hr class="my-4">
                        <div>
                            <div class="d-flex align-items-start justify-content-between">
                                <h2 class="d-flex align-items-center text-black-50 mb-5">
                                    <span class="badge-dot bg-success me-3"></span>
                                    Protfollue Link
                                </h2>
                            </div>
                            <i class="fe fe-globe"></i>
                            <a class="text-decoration-underline" href="{{ $user->portfolio_url }}" target="_blank">{{ $user->portfolio_url }}</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection
