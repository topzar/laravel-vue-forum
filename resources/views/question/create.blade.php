@extends('layouts.app')

@section('content')
    @include('vendor.ueditor.assets')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">发布问题</div>

                    <div class="panel-body">
                        <form action="{{ url('question') }}" method="post">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label for="">title</label>
                                <input type="text" name="title" id="" class="form-control" placeholder="title here">
                            </div>
                            <div class="form-group">
                                <!-- 编辑器容器 -->
                                <script id="container" name="body" type="text/plain"></script>

                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-success">发布问题</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- 实例化编辑器 -->
    <script type="text/javascript">
        var ue = UE.getEditor('container');
        ue.ready(function() {
            ue.execCommand('serverparam', '_token', '{{ csrf_token() }}'); // 设置 CSRF token.
        });
    </script>

@endsection
