@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h3>消息通知</h3><br><br>
            <ul class="nav nav-tabs">
                <li role="presentation">
                    <a href="{{ route('notifications', Auth::user()->name) }}">
                        未读消息
                        <span class="label label-danger">
                            {{ count(Auth::user()->unreadNotifications) }}
                        </span>
                    </a>
                </li>
                <li role="presentation"  class="active">
                    <a href="{{ route('notifications.all',Auth::user()->name) }}">全部消息</a>
                </li>
            </ul>
            <br>
            <div class="notifications-list">
                @foreach($user->notifications as $notification)
                    @include('notifications.'.snake_case(class_basename($notification->type)))
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection
