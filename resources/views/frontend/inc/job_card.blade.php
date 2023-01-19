
<div class="card card-bordered mb-4 card-hover cursor-pointer job-card-shadow">
    <!-- card body -->
    <div class="card-body">
        <div>
            <div class="d-md-flex">
                <div class="mb-3 mb-md-0">
                    <!-- Img -->
                    <img src="{{ config("app.url")."/storage/".$job->companyDetails?->photos[0]?->filename }}"
                         width="68" height="68"
                         alt="{{ config("app.name") }}" class="icon-shape border rounded">
                </div>
                <!-- text -->
                <div class="ms-md-3 w-100 mt-3 mt-xl-1">
                    <div class="d-flex justify-content-between">
                        <div>
                            <!-- heading -->
                            <h3 class="mb-1 fs-4 text-capitalize">
                                <a href="{{ route('client.single_job', $job->slug) }}"
                                   class="text-inherit text-black">{{ $job->title }} ({{ $job->label }} / {{ $job->types }})</a>
                                @if($job->is_featured)
                                    <span class="badge bg-light-danger text-danger ms-2">Featured Job</span>
                                @endif
                            </h3>
                            <div>
                                <span>at <a href="{{ route('client.singleCompany', ['company_name' => $job->companyDetails?->name, 'id' => $job->companyDetails?->id]) }}" class="text-black text-capitalize">{{ $job->companyDetails->name }} </a></span>
                                <span class="ms-0">({{ $job->message_details_count ?? 0 }}) Applied</span>
                            </div>
                        </div>
                        <div>
                            @if(auth()->user()?->saveJobs->where('job_id', $job->id)->count() > 0)
                                <i class="text-black-50 mdi mdi-bookmark-check fs-3"></i>
                            @else
                                <a href="{{ route('save.job', ['slug' =>$job->slug, 'id' => $job->id]) }}">
                                    <i class="text-black-50 mdi mdi-bookmark-outline fs-3" disabled="true"></i>
                                </a>
                            @endif
                                <!-- bookmark -->
                        </div>

                    </div>

                    <div class="">
                        <div class="mb-2 mb-md-0">
                            <!-- year -->
                            <span class="me-2">
                                <i class="fe fe-briefcase text-muted"></i>
                                <span class="ms-1 ">{{ $job->min_experience }} - {{ $job->max_experience }} {{ $job->experience_type }}</span>
                            </span>
                            <!-- salary -->

                            <span class="me-2">
                                <i class="fe fe-dollar-sign text-muted"></i>
                                <span class="ms-1 ">{{ $job->min_salary }} - {{ $job->max_salary }} LPA</span>
                            </span>
                            <!-- location -->
                            <span class="me-2">
                                <i class="fe fe-map-pin text-muted"></i>
                                <span class="ms-1 ">{{ $job->location }}</span>
                            </span>
                        </div>

                        <div class="d-flex align-items-start flex-column">
                            <span class="me-2">
                                <i class="mdi mdi-fountain-pen-tip"></i>
                                <span class="ms-1 text-capitalize">
                                    @foreach(json_decode($job->tags) as $tag)
                                        {{ $tag }}
                                        @if(!$loop->last),@endif
                                    @endforeach
                                </span>
                            </span>
                            <span class="me-2 d-flex">
                                <i class="mdi mdi-note-outline"></i>
                                <span class="ms-1 text-capitalize">
                                    {!! Str::limit($job->job_details, 90) !!}
                                </span>
                            </span>
                        </div>
                        <span class="mt-2">{{ getTimeAgo($job->created_at) }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
