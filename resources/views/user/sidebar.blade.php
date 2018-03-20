<div class="list-group">
    <a href="{{ route('user.home', Auth::user()->name) }}" class="list-group-item">个人主页</a>
    <a href="{{ route('user.avatar', Auth::user()->name) }}" class="list-group-item">更换头像</a>
    <a href="{{ route('user.password', Auth::user()->name) }}" class="list-group-item">修改密码</a>
</div>