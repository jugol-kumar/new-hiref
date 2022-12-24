@extends('frontend.layout.master')

@section('title', 'verification number')

@section('content')

    <div class="bg-light-primary py-lg-14 py-12 bg-cover ">
        <div class="container">
            <div class="col-md-6 mx-auto">
                <div class="card">
                    <div class="card-header bg-transparent border-0">
                        <a href="{{ route('seeker.editProfile') }}" class="btn btn-icon rounded-circle btn-primary float-end" title="Edit Profile">
                            <i class="mdi mdi-account-edit"></i>
                        </a>
                    </div>
                    <div class="card-body">
                        <div class="d-flex align-items-start justify-content-between">
                            <div>
                                <h2 class="card-title">{{ $user->name }}</h2>
                                <p>{{ $user->seeker->designation }} | {{ $user->seeker->company_name }}</p>
                            </div>
                            <img class="avatar rounded-circle" src="{{ asset($user->photo) }}" alt="">
                        </div>
                        <hr class="my-4">
                        <div class="">
                            <p class="fw-medium">No searching job now</p>
                            <div class="d-flex align-items-start justify-content-between">
                                <div class="d-flex align-items-baseline">
                                    <i class="mdi mdi-briefcase-check fs-2 fw-bold text-black-50"></i>
                                    <p class="ms-2 fw-semibold">{{ $user->seeker->end_date->format('y') - $user->seeker->start_date->format('y') }} years</p>
                                </div>
                                <div class="d-flex align-items-baseline">
                                    <i class="mdi mdi-school fs-2 fw-bold text-black-50"></i>
                                    <p class="ms-2 fw-semibold">{{ $user->seeker->end_date->format('y') - $user->seeker->start_date->format('y') }} years</p>
                                </div>
                                <div class="d-flex align-items-baseline">
                                    <i class="mdi mdi-cake-layered fs-2 fw-bold text-black-50"></i>
                                    <p class="ms-2 fw-semibold">{{ $user->seeker->end_date->format('y') - $user->seeker->start_date->format('y') }} years</p>
                                </div>
                            </div>
                            <p class="">{{ $user->about }}</p>
                        </div>
                        <hr class="my-4">

                        <div>
                            <h2 class="d-flex align-items-center text-black-50 mb-5"><span class="badge-dot bg-success me-3"></span>Job Preference</h2>

                            <div class="d-flex align-items-center justify-content-between">
                                <h3 class="text-capitalize">{{ $user->seeker->category->name }}</h3>
                                <h5>{{ $user->seeker->exp_min_sal }} LPA- {{ $user->seeker->exp_max_sal }}LPA</h5>
                            </div>
                            <p class="mb-0 pb-0">{{ $user->seeker->types }}</p>
                            <p class="my-0 py-0">{{ $user->seeker->division->name }}, {{ $user->seeker->district->name }}</p>
                        </div>
                        <hr class="my-4">

                        <div>
                            <h2 class="d-flex align-items-center text-black-50 mb-5"><span class="badge-dot bg-success me-3"></span>Working Experience</h2>

                            <div class="d-flex align-items-center justify-content-between">
                                <h3 class="text-capitalize">{{ $user->seeker->company_name }}</h3>
                                <h5>{{ $user->seeker->start_date->format("M, Y") }} - {{ $user->seeker->end_date->format("M, Y") }}</h5>
                            </div>
                            <p class="mb-0 pb-0">{{ $user->seeker->designation }}</p>

                            <p class="mt-3">{{ $user->seeker->experience }}</p>
                        </div>
                        <hr class="my-4">

                        <div>
                            <h2 class="d-flex align-items-center text-black-50 mb-5"><span class="badge-dot bg-success me-3"></span>Education</h2>

                            <div class="d-flex align-items-center justify-content-between">
                                <h3 class="text-capitalize">{{ $user->seeker->university }}</h3>
                                <h5>{{ $user->seeker->uni_start_date->format("M, Y") }} - {{ $user->seeker->uni_end_date->format("M, Y") }}</h5>
                            </div>
                            <p class="mb-0 pb-0">{{ $user->seeker->education_level->label }} / {{ $user->seeker->educaiton->education_name }}</p>
                        </div>
                        <hr class="my-4">
                        <div>
                            <div class="d-flex align-items-start justify-content-between">
                                <h2 class="d-flex align-items-center text-black-50 mb-5">
                                    <span class="badge-dot bg-success me-3"></span>
                                    My Skaills
                                </h2>

                                <a href="#" class="btn btn-icon rounded-circle btn-primary btn-sm"  data-bs-toggle="modal" data-bs-target="#courseModal" title="Add New Skills">
                                    <i class="mdi mdi-plus"></i>
                                </a>
                            </div>

                            @foreach(json_decode(json_decode($user->seeker->skills)) as $skill)
                                <span class="badge bg-light-secondary text-black-50">{{ $skill->value }}</span>
                            @endforeach
                        </div>
                        <hr class="my-4">
                        <div>
                            <div class="d-flex align-items-start justify-content-between">
                                <h2 class="d-flex align-items-center text-black-50 mb-5">
                                    <span class="badge-dot bg-success me-3"></span>
                                    Protfollue Link
                                </h2>
                                <a href="#" class="btn btn-icon rounded-circle btn-primary btn-sm"  data-bs-toggle="modal" data-bs-target="#protfollue" title="Add New Skills">
                                    <i class="mdi mdi-plus"></i>
                                </a>
                            </div>
                            <i class="fe fe-globe"></i>
                            <a class="text-decoration-underline" href="{{ $user->portfolio_url }}" target="_blank">{{ $user->portfolio_url }}</a>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- Course Modal -->
<div class="modal fade" id="courseModal" tabindex="-1" aria-labelledby="courseModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-body">
                <h3>I want to add or remove my skills</h3>
                    <form id="sillsForm">
                        <label class="form-label">Hash Tag</label>
                        <input name='tags' placeholder="Add New Skills" autofocus value="{{json_decode($user->seeker->skills) }}">
                        @error('tags')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                        <button type="submit" class="btn btn-sm btn-primary mt-2">Save Now</button>
                    </form>
                </div>
            </div>
    </div>
</div>

    <!-- protfollue Modal -->
    <div class="modal fade" id="protfollue" tabindex="-1" aria-labelledby="courseModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="card">
                        <div class="card-body">
                            <h3 class="title">This is my protfollue address</h3>
                            <form id="protfolioForm">
                                <div class="form-group">
                                    <label class="form-label">Website Link</label>
                                    <input name='portfolio_url' class="form-control" value="{{ $user->portfolio_url }}"/>
                                    <button type="submit" class="btn btn-sm btn-primary mt-2">Save Now</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



@endsection
@push('js')
    <script>


        $('#sillsForm').on('submit', function(event){
            event.preventDefault();
            $.ajax({
                url: `{{ route('seeker.updateSkills') }}`,
                method:"POST",
                data:new FormData(this),
                dataType:'JSON',
                contentType: false,
                cache: false,
                processData: false,
                success:function(res)
                {
                    Toast.fire({
                        icon: 'success',
                        title: res.success
                    })
                    $("#courseModal").modal('hide')
                },
                error:function (res){
                    console.log("err")
                    console.log(res);
                }
            })
        });


        $('#protfolioForm').on('submit', function(event){
            event.preventDefault();
            $.ajax({
                url: `{{ route('seeker.updateProtfolio') }}`,
                method:"POST",
                data:new FormData(this),
                dataType:'JSON',
                contentType: false,
                cache: false,
                processData: false,
                success:function(res)
                {
                    Toast.fire({
                        icon: 'success',
                        title: res.success
                    })
                    $("#protfollue").modal('hide')
                },
                error:function (res){
                    console.log("err")
                    console.log(res);
                }
            })
        });
    </script>
@endpush
