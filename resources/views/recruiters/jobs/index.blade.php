@extends('recruiters.layout.master')
@section('title', get_setting('name')." Recruiters All Jobs")
@section('recruiter_content')
    <div class="col-lg-9 col-md-8 col-12">
        <!-- Card -->
        <div class="card mb-4">
            <!-- Card header -->
            <div class="card-header d-flex align-items-center justify-content-between">
                <div>
                    <h3 class="mb-0">Jobs</h3>
                    <span>Manage your Jobs and its update like live, draft and
								insight.</span>
                </div>
                <a href="{{ route('recruiter.createJob') }}" class="btn btn-primary btn-sm">Add new job</a>
            </div>
            {{--
            <!-- Card body -->
            <div class="card-body">
                <!-- Form -->
                <form class="row">
                    <div class="col-lg-9 col-md-7 col-12 mb-lg-0 mb-2">
                        <input type="search" class="form-control" placeholder="Search Your Jobs" />
                    </div>
                    <div class="col-lg-3 col-md-5 col-12">
                        <select class="selectpicker" data-width="100%">
                            <option value="">Date Created</option>
                            <option value="Newest">Newest</option>
                            <option value="High Rated">High Rated</option>
                            <option value="Law Rated">Law Rated</option>
                            <option value="High Earned">High Earned</option>
                        </select>
                    </div>
                </form>
            </div>
            --}}
            <!-- Table -->
            <div class="table-responsive border-0 overflow-y-hidden">
                <table class="table mb-0 text-nowrap">
                    <thead class="table-light">
                    <tr>
                        <th scope="col" class="border-0">Jobs</th>
                        <th scope="col" class="border-0">Students</th>
                        <th scope="col" class="border-0">Rating</th>
                        <th scope="col" class="border-0">Status</th>
                        <th scope="col" class="border-0"></th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach($jobs as $key => $value)
                            @include('recruiters.jobs.single_job_row')
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
