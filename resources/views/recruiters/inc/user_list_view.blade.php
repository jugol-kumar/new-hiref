
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
        {{ $job->title }}
    </td>
    <td class="align-middle text-warning border-top-0">
        {{ $user->created_at->format("D, m-Y") }}
    </td>
    <td>
        <span>{{ $user->seeker?->exp_min_sal }} - {{ $user->seeker?->exp_max_sal }} LPA</span>
    </td>

    <form method="POST" action="{{ route('sendMessage') }}" class="submitMussage" style="display:none">
        @csrf
        <input type="hidden" name="send_id" value="{{ $user->id }}">
    </form>


    <td class="align-middle border-top-0">
        <button class="text-muted submitMessageBUtton btn btn-icon rounded-circle" data-bs-toggle="tooltip" data-placement="top" title="Message">
            <i class="fe fe-mail"></i>
        </button>
    </td>
{{--    <td class="text-muted px-4 py-3 align-middle border-top-0">--}}
{{--        <span class="dropdown dropstart">--}}
{{--            <a href="#" class="btn-icon btn btn-ghost btn-sm rounded-circle" role="button" id="courseDropdown"--}}
{{--               data-bs-toggle="dropdown"  data-bs-offset="-20,20" aria-expanded="false">--}}
{{--              <i class="fe fe-more-vertical"></i>--}}
{{--            </a>--}}

{{--            <span class="dropdown-menu" aria-labelledby="courseDropdown">--}}
{{--                <span class="dropdown-header">Settings</span>--}}
{{--                <a class="dropdown-item" href="#">--}}
{{--                    <i class="fe fe-edit dropdown-item-icon"></i>Edit--}}
{{--                </a>--}}
{{--                <a class="dropdown-item" href="#">--}}
{{--                    <i class="fe fe-trash dropdown-item-icon"></i>Remove--}}
{{--                </a>--}}
{{--            </span>--}}
{{--        </span>--}}
{{--    </td>--}}
</tr>
