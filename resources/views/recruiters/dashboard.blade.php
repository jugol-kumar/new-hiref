@extends('recruiters.layout.master')
@section('title', get_setting('name')." Recruiters Dashboard")@push('css')
    <style>
        .counter_card{
            background: linear-gradient(45deg, #5dffd9, #c4fff6);
            border-radius: 10px;
            box-shadow: 0px 4px 8px 0px #a1a1a1;
        }
    </style>
@endpush
@section('recruiter_content')
    <div class="col-lg-9 col-md-8 col-12">
        <div class="row">
            <div class="col-lg-4 col-md-12 col-12">
                <!-- Card -->
                <div class="card mb-4">
                    <div class="card-body text-center p-0 counter_card">
                        <h4 class="mt-3">Chats</h4>
                        <p>{{ $totalChats ?? 0 }}</p>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-12 col-12">
                <!-- Card -->
                <div class="card mb-4">
                    <div class="card-body text-center p-0 counter_card">
                        <h4 class="mt-3">Total Jobs</h4>
                        <p>{{ $jobs->count() ?? 0 }}</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-12 col-12">
                <!-- Card -->
                <div class="card mb-4">
                    <div class="card-body text-center p-0 counter_card">
                        <h4 class="mt-3">Saved Jobs</h4>
                        <p>{{ $saveJobs ?? 0 }}</p>
                    </div>
                </div>
            </div>
        </div>
        {{--
        <!-- Card -->
        <div class="card mb-4">
            <!-- Card header -->
            <div class="card-header">
                <h3 class="h4 mb-0">Earnings</h3>
            </div>
            <!-- Card body -->
            <div class="card-body">
                <div id="earning" class="apex-charts"></div>
            </div>
        </div>
        <!-- Card -->
        <div class="card mb-4">
            <!-- Card header -->
            <div class="card-header">
                <h3 class="h4 mb-0">Order</h3>
            </div>
            <!-- Card body -->
            <div class="card-body">
                <div id="orderColumn" class="apex-charts"></div>
            </div>
        </div>
        --}}
        <div class="card mb-4">
            <!-- Card header -->
            <div class="card-header border-bottom-0">
                <h3 class="h4 mb-0">Latest Created Jobs</h3>
            </div>
            <!-- Table -->
            <div class="table-responsive border-0">
                <table class="table mb-0 text-nowrap">
                    <thead class="table-light">
                    <tr>
                        <th scope="col" class="border-0">Jobs</th>
                        <th scope="col" class="border-0">Students</th>
                        <th scope="col" class="border-0">Applied</th>
                        <th scope="col" class="border-0">Status</th>
                        <th scope="col" class="border-0"></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($jobs->take(10) as $key => $value)
                        @include('recruiters.jobs.single_job_row')
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
