@extends('layouts.app')

@section('content')
    @include('vendor.ueditor.assets')
    <div class="container">
        <div class="row">
            <div class="col-md-9">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        @if( Auth::check() && Auth::user()->isOwner($question))
                            <div class="btn-group">
                                <a href="{{ route('question.edit',$question->id) }}" class="btn btn-primary">编辑问题</a>
                                <form action="{{ route('question.destroy', $question->id) }}" method="post">
                                    {{ method_field('DELETE') }}
                                    {{ csrf_field() }}
                                    <button type="submit" class="btn btn-danger">删除</button>
                                </form>
                            </div>
                        @endif
                        <h3>{{ $question->title }}</h3>
                        @foreach($question->topics as $topic)
                            <a href="{{ route('topic.show', $topic->id) }}" class="label label-info" style="margin:0 2px;"> # {{ $topic->name }} </a> &nbsp;
                        @endforeach
                    </div>
                    <div class="panel-body">
                        {!! $question->body !!}
                    </div>
                </div>

                <div class="panel panel-default">
                    <div class="panel-heading">共 {{ $question->answers_count }} 个答案</div>
                    <div class="panel-body">

                        @foreach($question->answers as $answer)
                            <div class="media">
                                <div class="media-left">
                                    <span>{{ $answer->votes_count }}个赞</span>
                                </div>
                                <div class="media-body">
                                    <h4 class="media-heading">
                                        <a href="/user/{{ $answer->user->name }}">
                                            <img src="{{ $answer->user->avatar  }}" alt="" class="img-circle" style="width: 40px;">
                                            {{ $answer->user->name }}
                                        </a>
                                    </h4>
                                    {!! $answer->body !!}
                                </div>
                            </div>
                        @endforeach

                        @if( Auth::check())
                            <form action="{{ route('question.answer', $question->id) }}" method="post">
                                {{ csrf_field() }}
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
                                    <button type="submit" class="btn btn-success">提交答案</button>
                                </div>
                            </form>
                        @else
                            <div class="no-login-area">
                                <a href="{{ url('login') }}">登录提交答案</a>
                            </div>
                        @endif
                    </div>
                </div>

            </div>
            <div class="col-md-3">
                <div class="panel panel-default questions-user">
                    <div class="panel-body">
                        <img src="{{ $question->user->avatar }}" alt="" class="img-circle" style="height: 60px;">
                        <h3>
                            <span>
                                {{ $question->user->name }}
                            </span>
                        </h3>
                        <p>
                            <follow-question-button question="{{ $question->id }}" user="{{ Auth::id() }}"></follow-question-button>
                            {{--@if( Auth::check())--}}
                                {{--<a href="{{ route('question.follow', $question->id) }}" class="btn {{ Auth::user()->followed($question->id) ? 'btn-success' : 'btn-default'}} ">--}}
                                    {{--{{ Auth::user()->followed($question->id) ? '已关注' : '关注问题' }}--}}
                                {{--</a>--}}
                                {{--<button class="btn btn-success">私 信</button>--}}
                            {{--@endif--}}
                        </p>
                    </div>
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
