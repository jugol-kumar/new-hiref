
<table class="messenger-list-item" data-contact="{{ $user->id }}">
    <tr data-action="0">
        {{-- Avatar side --}}
        <td style="position: relative">
            @if($user->active_status)
                <span class="activeStatus"></span>
            @endif
            <div class="avatar av-m"
                 style="background-image: url('{{ $user->photo }}');">
            </div>
        </td>
        {{-- center side --}}
        <td>
            <p data-id="{{ $user->id }}" data-type="user">
                {{ strlen($user->name) > 12 ? trim(substr($user->name,0,12)).'..' : $user->name }}
                <span>{{ $user->messages->last()->created_at->diffForHumans() }}</span></p>
            <span>
                                        {{-- Last Message user indicator --}}
                {!!
                    $user->messages->last()->from_id == Auth::user()->id
                    ? '<span class="lastMessageIndicator">You :</span>'
                    : ''
                !!}
                {{-- Last message body --}}
                @if($user->messages->last()->attachment == null)
                    {!!
                        strlen($user->messages->last()->body) > 30
                        ? trim(substr($user->messages->last()->body, 0, 30)).'..'
                        : $user->messages->last()->body
                    !!}
                @else
                    <span class="fas fa-file"></span> Attachment
                @endif
                                    </span>
            {{-- New messages counter --}}
            {{--     {!! $unseenCounter > 0 ? "<b>".$unseenCounter."</b>" : '' !!}--}}
        </td>

    </tr>
</table>
