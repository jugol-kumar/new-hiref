@extends('recruiters.layout.master')
@section('title', get_setting('name')." Recruiters All Jobs")
@section('recruiter_content')
    <div class="col-lg-9 col-md-8 col-12">
        <!-- Card -->
        <div class="card mb-4">
            <!-- Card header -->
            <div class="card-header d-flex align-items-center justify-content-between">
                <div>
                    <h3 class="mb-0">Save Jobs</h3>
                    <span>Manage your Jobs and its update like live, draft and
								insight.</span>
                </div>
            </div>
        <!-- Table -->
            <div class="table-responsive border-0 overflow-y-hidden">
                <table class="table mb-0 text-nowrap">
                    <thead class="table-light">
                    <tr>
                        <th scope="col" class="border-0">Jobs</th>
                        <th scope="col" class="border-0">Salary</th>
                        <th scope="col" class="border-0">Applied</th>
                        <th scope="col" class="border-0">Status</th>
                        <th scope="col" class="border-0"></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($jobs as $key => $item)
                        @php($value = $item->job)
                        @include('recruiters.jobs.single_job_row')
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
