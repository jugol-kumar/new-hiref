@extends('recruiters.layout.master')
@section('title', get_setting('name')." Recruiters Show Applied Seekers")
@section('recruiter_content')
    <div class="col-lg-9 col-md-8 col-12">
        <!-- Page header-->
        <div class="container-fluid p-4">
            <div class="py-2">
                <div class="row">
                    <div class="col">
                        <div class="card mb-4">
                            <div class="card-body text-center p-0 counter_card">
                                <h4 class="mt-3">Total Jobs</h4>
                                <p>Applied</p>
                            </div>
                        </div>
                    </div>

                    <div class="col">
                        <div class="card mb-4">
                            <div class="card-body text-center p-0 counter_card">
                                <h4 class="mt-3">Total Jobs</h4>
                                <p>Applied</p>
                            </div>
                        </div>
                    </div>

                    <div class="col">
                        <div class="card mb-4">
                            <div class="card-body text-center p-0 counter_card">
                                <h4 class="mt-3">Total Jobs</h4>
                                <p>Applied</p>
                            </div>
                        </div>
                    </div>

                    <div class="col">
                        <div class="card mb-4">
                            <div class="card-body text-center p-0 counter_card">
                                <h4 class="mt-3">Total Jobs</h4>
                                <p>Applied</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
                <div class="row">
                    <!-- Page Header -->
                    <div class="col-lg-12 col-md-12 col-12">
                        <div class="pb-4 mb-4 d-flex justify-content-between align-items-center">
                            <div class="mb-2 mb-lg-0">
                                <h1 class="mb-1 h2 fw-bold">
                                    Applied Seekers
                                    <span class="fs-5 text-muted">({{ $appliedSeekers->appliedUsers->count() }})</span>
                                </h1>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="card">
                            <div class="card-body">
                                <p class="mb-2 demo-inline-spacing">
                                    <button type="button"
                                            data-bs-toggle="collapse"
                                            data-bs-target="#collapseExample"
                                            aria-expanded="false"
                                            aria-controls="collapseExample"
                                            class="btn btn-icon btn-icon rounded-circle btn-flat-success waves-effect">
                                        <i class="fe fe-filter"></i>
                                    </button>
                                </p>
                                <div class="collapse" id="collapseExample">
                                    <form novalidate="novalidate">
                                            <div class="row">
                                                <div class="mb-1 col-md-6">
                                                    <label class="form-label" for="username">Username</label>
                                                    <input type="text" name="username" id="username" class="form-control" placeholder="johndoe">
                                                </div>
                                                <div class="mb-1 col-md-6">
                                                    <label class="form-label" for="email">Email</label>
                                                    <input type="email" name="email" id="email" class="form-control" placeholder="john.doe@email.com" aria-label="john.doe">
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="mb-1 form-password-toggle col-md-6">
                                                    <label class="form-label" for="password">Password</label>
                                                    <input type="password" name="password" id="password" class="form-control" placeholder="············">
                                                </div>
                                                <div class="mb-1 form-password-toggle col-md-6">
                                                    <label class="form-label" for="confirm-password">Confirm Password</label>
                                                    <input type="password" name="confirm-password" id="confirm-password" class="form-control" placeholder="············">
                                                </div>
                                            </div>
                                        </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12 col-md-12 col-12">
                        <div class="card">
                            <div class="card-header">
                                <a href="{{ route('recruiter.exportPdf', ['job_id' => $appliedSeekers->id]) }}"  data-bs-toggle="tooltip" data-placement="top" title="Download PDF File"
                                   class="btn btn-light-primary btn-lg btn-label-primary waves-effect">
                                    <span class="fe fe-arrow-down-circle text-primary"></span>Pdf Download
                                </a>

                                <a href="{{ route('recruiter.exportExcel', ['job_id' => $appliedSeekers->id]) }}"  data-bs-toggle="tooltip" data-placement="top" title="Download Excel File"
                                   class="btn btn-light-info  btn-lg btn-label-primary waves-effect">
                                    <span class="fe fe-arrow-down-circle text-info"></span>Excel Download
                                </a>

<!--                                <a href="#"  data-bs-toggle="tooltip" data-placement="top" title="Download Word File"
                                   class="btn btn-light-warning btn-lg btn-label-primary waves-effect">
                                    <span class="fe fe-arrow-down-circle text-warning"></span>Word Download
                                </a>-->

                            </div>
                            <!-- table -->
                            <div class="table-responsive">
                                <table class="table mb-0 text-nowrap">
                                    <thead class="table-light">
                                    <tr>
                                        <th scope="col" class="border-0">Name</th>
                                        <th scope="col" class="border-0">Topic</th>
                                        <th scope="col" class="border-0">
                                            Apply Date
                                        </th>
                                        <th scope="col" class="border-0"></th>
                                        <th scope="col" class="border-0"></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @forelse($appliedSeekers->appliedUsers as $user)
                                        @include('recruiters.inc.user_list_view', ['user' => $user])
                                    @empty
                                    @endforelse
                                    </tbody>
                                </table>
                                <!-- Pagination -->
                                <div class="pb-4 pt-4">
                                    @include('frontend.inc.paginations', ['paginators' => $appliedSeekers->appliedUsers])
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </div>
@endsection
