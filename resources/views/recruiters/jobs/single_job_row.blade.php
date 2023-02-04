
<tr>
    <td class="border-top-0">
        <div class="d-lg-flex">
            <div>
                <a href="{{ route('client.single_job', $value->slug) }}" target="_blank">
                    <img src="{{ global_asset($value->companyDetails->photos->count() ? $value->companyDetails->photos[1]->filename : null) }}"
                         height="70"
                         alt="{{ config("app.name") }}" class="rounded img-4by3-lg">
                </a>
            </div>
            <div class="ms-lg-3 mt-2 mt-lg-0">
                <h4 class="mb-1 h5">
                    <a href="{{ route('client.single_job', $value->slug) }}" class="text-inherit" target="_blank">{{ Str::limit($value->title, 20) }}</a>
                </h4>
                <span class="badge bg-light-primary text-primary">{{ $value->category->name }}</span>
                <!--                                        <ul class="list-inline fs-6 mb-0">
                                                            <li class="list-inline-item">
                                                                <i class="mdi mdi-clock-time-four-outline text-muted me-1"></i>1h 30m
                                                            </li>
                                                            <li class="list-inline-item">
                                                                <svg class="me-1 mt-n1" width="16" height="16" viewBox="0 0 16 16" fill="none"
                                                                     xmlns="http://www.w3.org/2000/svg">
                                                                    <rect x="3" y="8" width="2" height="6" rx="1" fill="#754FFE"></rect>
                                                                    <rect x="7" y="5" width="2" height="9" rx="1" fill="#DBD8E9"></rect>
                                                                    <rect x="11" y="2" width="2" height="12" rx="1" fill="#DBD8E9"></rect>
                                                                </svg>Beginner
                                                            </li>
                                                        </ul>-->
            </div>
        </div>
    </td>
    <td class="border-top-0">{{ $value->min_salary }} - {{ $value->max_salary }} LPA</td>
    <td class="border-top-0">
        @if(!isset($save))
            <a href="{{ route('recruiter.appliedSeekers', ['job-id' => $value->id]) }}">{{ $value->applied_users_count ?? 'no apply'}} Applied </a>
        @else
            <a href="{{ route('recruiter.appliedSeekers', ['job-id' => $value->id]) }}">{{ $value->applied_users_count->count() ?? 'no apply' }} Applied </a>
        @endif
    </td>
    <td class="border-top-0">
        <span class="badge bg-{{  $value->is_published ? 'primary' : 'warning' }}">{{ $value->is_published ? 'Published' : 'Un-Published' }}</span>
    </td>
    <td class="border-top-0">
        @if($value->lived == 'lived')
            <span class="badge bg-primary text-uppercase">{{ $value->lived }}</span>
        @elseif($value->lived == 'joined')
            <span class="badge bg-success text-uppercase">{{ $value->lived }}</span>
        @elseif($value->lived == 'cancel')
            <span class="badge bg-secondary text-uppercase">{{ $value->lived }}</span>
        @elseif($value->lived == 'draft')
            <span class="badge bg-info text-uppercase">{{ $value->lived }}</span>
        @elseif($value->lived == 'pending')
            <span class="badge bg-warning text-uppercase">{{ $value->lived }}</span>
        @elseif($value->lived == 'deleted')
            <span class="badge bg-danger text-uppercase">{{ $value->lived }}</span>
        @endif
    </td>
    @if(!isset($see))
        <td class="text-muted border-top-0">
        <span class="dropdown dropstart">
            <a class="btn-icon btn btn-ghost btn-sm rounded-circle " href="#" role="button" id="courseDropdown"
               data-bs-toggle="dropdown"  data-bs-offset="-20,20" aria-expanded="false">
                <i class="fe fe-more-vertical"></i>
            </a>
            <span class="dropdown-menu" aria-labelledby="courseDropdown">
                @if(!isset($save))
                    <span class="dropdown-header">Setting </span>
                    <button class="dropdown-item"
                            data-bs-toggle="modal"
                            data-bs-target="#protfollue">
                        <i class="fe fe-check-circle dropdown-item-icon"></i>
                        Change Status
                    </button>
                    <a class="dropdown-item" href="{{ route('recruiter.editJob', $value->slug) }}"><i class="fe fe-edit dropdown-item-icon"></i>Edit</a>

                    <button  class="dropdown-item" type="button"
                                 onclick="deleteData({{ $value->id }})"
                        >
                        <i class="fe fe-trash  dropdown-item-icon"></i>  <span>Delete</span>
                    </button>

                    <form id="delete-form-{{ $value->id }}"
                          method="POST"
                          action="{{ route('recruiter.deleteJob', $value->id) }}"
                          style="display: none">
                        @csrf
                        @method('DELETE')
                    </form>
                @else
                    <span class="dropdown-header">Setting </span>
                    <button  class="dropdown-item" type="button"
                             onclick="removeSaveJob({{ $item->id }})"
                    >
                        <i class="fe fe-trash  dropdown-item-icon"></i>  <span>Remove</span>
                    </button>

                    <form id="remvoe-form-{{ $item->id }}"
                          method="POST"
                          action="{{ route('removeSaveJOb', $item->id) }}"
                          style="display: none">
                        @csrf
                        @method('DELETE')
                    </form>
                @endif
            </span>
        </span>
    </td>
    @endif
</tr>

<!-- protfollue Modal -->
<div class="modal fade" id="protfollue" tabindex="-1" aria-labelledby="courseModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Want to change status</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('recruiter.updateJobStatus') }}" method="post">
                    @csrf
                    <div class="mb-3">
                        <input type="hidden" name="job_id" value="{{ $value->id }}">
                        <label for="recipient-name" class="col-form-label">Job Status</label>
                        <select class="selectpicker" data-width="100%" name="job_status">
                            <option value="lived" {{ $value->lived == 'lived' ? 'selected' : '' }}>Lived</option>
                            <option value="joined" {{ $value->lived == 'joined' ? 'selected' : '' }}>Joined</option>
                            <option value="cancel" {{ $value->lived == 'cancel' ? 'selected' : '' }}>Cancel</option>
                            <option value="draft" {{ $value->lived == 'draft' ? 'selected' : '' }}>Draft</option>
                            <option value="pending" {{ $value->lived == 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="deleted" {{ $value->lived == 'deleted' ? 'selected' : '' }}>Deleted</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Change status</button>
                </form>
            </div>
        </div>
    </div>
</div>

