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
            <div class="list-group">
                <a href="{{ route('user.home', Auth::user()->name) }}" class="list-group-item">个人主页</a>
                <a href="{{ route('user.avatar', Auth::user()->name) }}" class="list-group-item active">更换头像</a>
                <a href="#" class="list-group-item">修改密码</a>
                <a href="#" class="list-group-item">其他信息</a>
            </div>
        </div>
    </div>
</div>
@endsection
