@extends('recruiters.layout.master')
@section('title', get_setting('name')." Recruiters Show Applied Seekers")
@section('recruiter_content')
    <div class="col-lg-9 col-md-8 col-12">
        <!-- Page header-->
        <div class="container-fluid p-4">
<!--            <div class="py-2">
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
        </div>-->
            <div class="row">
                <!-- Page Header -->
                <div class="col-lg-12 col-md-12 col-12">
                    <div class="pb-4 d-flex justify-content-between align-items-center">
                        <div class="mb-2 mb-lg-0">
                            <h1 class="h2 fw-bold">
                                Applied Seekers
                                <span class="fs-5 text-muted">({{ $appliedSeekers->total() }})</span>
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
                                <form action="{{ route('recruiter.appliedSeekers') }}" method="get">
                                    <input type="hidden" value="{{ $job->id }}" name="job-id">
                                    <div class="row">
                                        <div class="col">
                                            <div class="mb-3">
                                                <label class="form-label">Job Type</label>
                                                <select name="types" class="selectpicker" data-width="100%">
                                                    <option value="">Select Type</option>
                                                    <option value="Full Time">Full Time</option>
                                                    <option value="Part Time">Part Time</option>
                                                    <option value="Contract">Contract</option>
                                                </select>
                                                @error('title')
                                                <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col">
                                            <label class="form-label">Preferred State</label>
                                            <select class="selectpicker"
                                                    data-live-search="true"
                                                    name="division"
                                                    onchange="getCityByState(this)" data-width="100%">
                                                <option value="">Select Preferred State</option>
                                                @foreach($states as $state)
                                                    <option value="{{ $state->id }}">{{ $state->name }}</option>
                                                @endforeach
                                            </select>
                                            @error('types')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <div class="row">
                                            <div class="col" id="city-card" style="display: none">
                                                <label class="form-label">Job category</label>
                                                <select name="district" class="selectpicker"
                                                        data-live-search="true"
                                                        onchange="getUpoByDid(this)"
                                                        data-width="100%"  id="city_id" >
                                                    <option selected disabled  value="">Select child category</option>
                                                </select>
                                                @error('child_category_id')
                                                <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="row mt-3 align-items-center">
                                            <label class="form-label">Expacted Salary</label>
{{--                                            <div class="col">--}}
{{--                                                <input type="number" name="minSalary" class="form-control" placeholder="Min Expected Salary"/>--}}
{{--                                            </div>--}}
{{--                                            <-->--}}
                                            <div class="col">
                                                <input type="number" name="maxSalary" class="form-control" placeholder="Salary Up To"/>
                                            </div>
                                        </div>

                                        <div class="row mt-3 align-items-center">
                                            <label class="form-label">Date Range</label>
                                            <div class="col">
                                                <input class="form-control flatpickr flatpickr-input active"
                                                       type="text" placeholder="Select Date"
                                                       name="start_date"
                                                       aria-describedby="basic-addon2" readonly="readonly">
                                            </div>
                                            <-->
                                            <div class="col">
                                                <input class="form-control flatpickr flatpickr-input active"
                                                       type="text" placeholder="Select Date"
                                                       name="end_date"
                                                       aria-describedby="basic-addon2" readonly="readonly">
                                            </div>
                                        </div>
                                        <button type="submit" class="btn btn-success mt-1">Search</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12 col-md-12 col-12 mt-2">
                    <div class="card">
                        <div class="card-header">
                            <a href="{{ route('recruiter.exportPdf', ['job_id' => $job->id]) }}"  data-bs-toggle="tooltip" data-placement="top" title="Download PDF File"
                               class="btn btn-light-primary btn-lg btn-label-primary waves-effect">
                                <span class="fe fe-arrow-down-circle text-primary"></span>Pdf Download
                            </a>

                            <a href="{{ route('recruiter.exportExcel', ['job_id' => $job->id]) }}"  data-bs-toggle="tooltip" data-placement="top" title="Download Excel File"
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
                                    <th scope="col" class="border-0">Salary Range</th>
                                    <th scope="col" class="border-0"></th>
{{--                                    <th scope="col" class="border-0"></th>--}}
                                </tr>
                                </thead>
                                <tbody>
                                @forelse($appliedSeekers as $user)
                                    @include('recruiters.inc.user_list_view', ['user' => $user])
                                @empty
                                @endforelse
                                </tbody>
                            </table>
                            <!-- Pagination -->
                            <div class="pb-4 pt-4">
                                @include('frontend.inc.paginations', ['paginators' => $appliedSeekers])
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script>
        $(".submitMessageBUtton").on("click", function (){
            $(".submitMussage").submit();
        })
    </script>
@endpush
