
<tr>
    <td class="align-middle border-top-0">
        <div class="d-flex align-items-center">
            <img src="{{ $user->photo }}" alt="" class="rounded-circle avatar-md me-2" />
            <div class="d-flex align-items-start flex-column">
                <h5 class="mb-0 text-capitalize">
                    <a href="{{ route('recruiter.appliendSeekerProfile', ['user_id' => $user->id]) }}">{{ $user->name }}</a></h5>
                <small>{{ $user->phone }}</small>
            </div>
        </div>
    </td>
    <td class="align-middle border-top-0 text-capitalize">
        {{ $appliedSeekers->title }}
    </td>
    <td class="align-middle text-warning border-top-0">
        {{ $user->created_at->format("D, m-Y") }}
    </td>




    <td class="align-middle border-top-0">
        <a href="{{ url("start-chat/".$user->id) }}" class="text-muted" data-bs-toggle="tooltip" data-placement="top" title="Message"><i class="fe fe-mail"></i></a>
    </td>
    <td class="text-muted px-4 py-3 align-middle border-top-0">
        <span class="dropdown dropstart">
            <a href="#" class="btn-icon btn btn-ghost btn-sm rounded-circle" role="button" id="courseDropdown"
               data-bs-toggle="dropdown"  data-bs-offset="-20,20" aria-expanded="false">
              <i class="fe fe-more-vertical"></i>
            </a>

            <span class="dropdown-menu" aria-labelledby="courseDropdown">
                <span class="dropdown-header">Settings</span>
                <a class="dropdown-item" href="#">
                    <i class="fe fe-edit dropdown-item-icon"></i>Edit
                </a>
                <a class="dropdown-item" href="#">
                    <i class="fe fe-trash dropdown-item-icon"></i>Remove
                </a>
            </span>
        </span>
    </td>
</tr>
