@extends('recruiters.layout.master')
@section('title', get_setting('name')." Recruiters Show Applied Seekers")
@section('recruiter_content')
    <div class="col-lg-9 col-md-8 col-12">
        <!-- Page header-->
        <div class="container-fluid p-4">
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
                            <div class="nav btn-group" role="tablist">
                                <button class="btn btn-outline-white  active" data-bs-toggle="tab" data-bs-target="#tabPaneGrid" role="tab" aria-controls="tabPaneGrid" aria-selected="true">
                                    <span class="fe fe-grid"></span>
                                </button>
                                <button class="btn btn-outline-white " data-bs-toggle="tab" data-bs-target="#tabPaneList" role="tab" aria-controls="tabPaneList" aria-selected="false">
                                    <span class="fe fe-list"></span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-12">
                        <!-- Tab -->
                        <div class="tab-content">
                            <!-- Tab pane -->
                            <div class="tab-pane fade show active" id="tabPaneGrid" role="tabpanel" aria-labelledby="tabPaneGrid">
                                <button class="btn-icon btn btn-sm rounded-circle" data-bs-toggle="tooltip" data-placement="top" title="Download Word File"> <i class="mdi mdi-upload"></i> </button>
                                <button class="btn-icon btn btn-sm rounded-circle" data-bs-toggle="tooltip" data-placement="top" title="Download Excel File"> <i class="mdi mdi-upload"></i> </button>
                                <button class="btn-icon btn btn-sm rounded-circle" data-bs-toggle="tooltip" data-placement="top" title="Download PDF File"> <i class="mdi mdi-upload"></i> </button>
                                <div class="mb-4">
                                    <input type="search" class="form-control" placeholder="Search Instructor" />
                                </div>
                                <div class="row">
                                    @forelse($appliedSeekers->appliedUsers as $user)
                                        @include('recruiters.inc.user_card_view', ['user' => $user])
                                    @empty
                                    @endforelse
                                    @include('frontend.inc.paginations', ['paginators' => $appliedSeekers->appliedUsers])
                                </div>
                            </div>
                            <!-- tab pane -->
                            <div class="tab-pane fade" id="tabPaneList" role="tabpanel" aria-labelledby="tabPaneList">
                                <!-- card -->
                                <div class="card">
                                    <!-- card header -->
                                    <div class="card-header">
                                        <input type="search" class="form-control" placeholder="Search Instructor" />
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
            </div>
    </div>
@endsection
