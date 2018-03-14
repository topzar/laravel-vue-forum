<li>
    @if($notification->unread())
        <p class="unread">
            <a href="{{ route('notifications.read', $notification->id) }}">
                <span><i class="fa fa-bullhorn"></i></span>
                用户
                [ {{ $notification->data['name'] }} ]
                关注了你。
            </a>
        </p>
        @else
        <p>
            <span><i class="fa fa-bullhorn"></i></span>
            用户
            <a href="{{ route('user.home', $notification->data['name']) }}">
                {{ $notification->data['name'] }}
            </a> 关注了你。
        </p>
    @endif
</li>
