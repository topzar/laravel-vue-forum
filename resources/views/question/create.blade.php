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
                            <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                                <input type="text" name="title" id="" class="form-control" placeholder="标题" value="{{ old('title') }}">
                                @if ($errors->has('title'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('title') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group">
                                @foreach($topics as $topic)
                                <label class="checkbox-inline">
                                    <input type="checkbox" id="inlineCheckbox1" value="{{ $topic->id }}" name="topics[]"> {{ $topic->name }}
                                </label>
                                @endforeach
                                @if ($errors->has('topics'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('topics') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group{{ $errors->has('body') ? ' has-error' : '' }}">
                                <!-- 编辑器容器 -->
                                <script id="container" name="body" type="text/plain">{!! old('body') !!}</script>
                                @if ($errors->has('body'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('body') }}</strong>
                                    </span>
                                @endif
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
