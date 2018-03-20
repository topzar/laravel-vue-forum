@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-9">
            <div class="panel panel-default">
                <div class="panel-heading">更换头像</div>

                <div class="panel-body">
                    <user-avatar avatar="{{ Auth::user()->avatar }}"></user-avatar>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            @include('user.sidebar')
        </div>
    </div>
</div>
@endsection
