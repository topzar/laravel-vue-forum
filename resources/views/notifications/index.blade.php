@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">站内通知</div>

                <div class="panel-body notifications-list">
                    @foreach($user->notifications as $notification)
                        @include('notifications.'.snake_case(class_basename($notification->type)))
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
