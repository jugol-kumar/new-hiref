<div class="card card-bordered mb-4 card-hover cursor-pointer job-card-shadow">
    <!-- card body -->
    <div class="card-body">
        <div>
            <div class="d-md-flex">
                <div class="mb-3 mb-md-0">
                    <!-- Img -->
                    <img src="{{ config("app.url")."/storage/".$value->photos[0]->filename }}"
                         width="68" height="68"
                         alt="{{ config("app.name") }}" class="icon-shape border rounded">
                </div>
                <!-- text -->
                <div class="ms-md-3 w-100 mt-3 mt-xl-1">
                    <div class="d-flex justify-content-between">
                        <div>
                            <!-- heading -->
                            <h3 class="mb-1 fs-4 text-capitalize">
                                <a href="{{ route('client.singleCompany', ['company' => $company?->name, 'id' => $company?->id]) }}"
                                   class="text-inherit text-black text-capitalize">{{ $value->name }}</a>
                            </h3>
                            <div class="fs-12">
                                <!-- reviews -->
                                <span class="text-dark fw-medium text-black-50">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="10" height="10" fill="currentColor" class="bi bi-star-fill text-warning align-baseline" viewBox="0 0 16 16">
                                        <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z">
                                        </path>
                                    </svg>
                                    4.5
                                </span>
                                |
                                <span class="ms-0 text-black-50">131 Reviews</span>
                            </div>
                            <div>
                                @php
                                    $date = Carbon\Carbon::parse($company?->starting_date);
                                    $diffYears = \Carbon\Carbon::now()->diffInYears($date);
                                @endphp
                                <span class="ms-0 border small-badge">{{ $diffYears }} Years Works</span> <span class="text-capitalize border small-badge">{{ Str::limit($company->type." Industry", 20) }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
