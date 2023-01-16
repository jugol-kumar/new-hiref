@extends('seekers.layout.master')
@section('title', get_setting('name')." Seeker Dashboard")
@push('css')
    <style>
        .counter_card{
            background: linear-gradient(45deg, #5dff79, #ccffc4);
            border-radius: 10px;
            box-shadow: 0px 4px 8px 0px #a1a1a1;
        }
    </style>
@endpush
@section('seeker_content')
    <div class="col-lg-9 col-md-8 col-12">
        <!-- Card -->
        <div class="card mb-4">
            <!-- Card header -->
            <div class="card-header d-flex align-items-center justify-content-between">
                <div>
                    <h3 class="mb-0">Applied Jobs</h3>
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
                        <th scope="col" class="border-0">Job Status</th>
                    </tr>
                    </thead>
                    <tbody>
                        @forelse($jobs->appliedJobs as $key => $value)
                            @include('recruiters.jobs.single_job_row', ['see' => false])
                        @empty
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
