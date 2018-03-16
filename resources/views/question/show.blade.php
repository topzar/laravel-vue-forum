@extends('layouts.app')

@section('content')
    <div class="container-fluid question_title_bar">
        <div class="container">
            <div class="row">
                <div class="col-md-9">
                    <h3>{{ $question->title }}</h3>
                    <div class="question-topics">
                        @foreach($question->topics as $topic)
                            <a href="{{ route('topic.show', $topic->id) }}" class="label" style="margin:0 2px;"> # {{ $topic->name }} </a> &nbsp;
                        @endforeach
                    </div>
                    <div class="question_action">
                        <follow-question-button question="{{ $question->id }}"></follow-question-button>
                        @if( Auth::check() && Auth::user()->isOwner($question))
                            <a href="{{ route('question.edit',$question->id) }}" class="btn edit-question">编辑问题</a>
                            <form action="{{ route('question.destroy', $question->id) }}" method="post" style="display: inline-block">
                                {{ method_field('DELETE') }}
                                {{ csrf_field() }}
                                <button type="submit" class="btn delete-question">删除</button>
                            </form>
                        @endif
                    </div>
                </div>
                <div class="col-md-3 question-statics">
                    <h4>关注者: {{ $question->followers_count }}</h4>
                </div>
            </div>
        </div>
    </div>
    @include('vendor.ueditor.assets')
    <div class="container">
        <div class="row">
            <div class="col-md-9">
                <div class="panel panel-default">
                    <div class="panel-body">
                        {!! $question->body !!}
                        <comment type="question" id="{{ $question->id }}" count="{{ $question->comments()->count() }}"></comment>
                    </div>
                </div>

                <div class="panel panel-default">
                    <div class="panel-heading">共 {{ $question->answers_count }} 个答案</div>
                    <div class="panel-body">

                        @foreach($question->answers as $answer)
                            <div class="media">
                                <div class="media-left">
                                    <votes-answer answer="{{ $answer->id }}" votes_count="{{$answer->votes_count}}"></votes-answer>
                                </div>
                                <div class="media-body">
                                    <h4 class="media-heading">
                                        <a href="/user/{{ $answer->user->name }}">
                                            <img src="{{ $answer->user->avatar  }}" alt="" class="img-circle" style="width: 40px;">
                                            {{ $answer->user->name }}
                                        </a>
                                    </h4>
                                    {!! $answer->body !!}
                                    <comment type="answer" id="{{ $answer->id }}" count="{{ $answer->comments()->count() }}"></comment>
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
                <div class="media question-author">
                    <h4 class="question-author-name">关于作者</h4>
                    <div class="media-left">
                        <a href="#">
                            <img class="media-object" src="{{ $question->user->avatar }}" alt="">
                        </a>
                    </div>
                    <div class="media-body">
                        <h4 class="media-heading">{{ $question->user->name }}</h4>
                        <span class="label label-default">新手上路</span>
                    </div>
                    <div class="author-statics">
                        <p>
                            <span>积分</span>
                            <span>{{ $question->user->experience }}</span>
                        </p>
                        <p>
                            <span>问题</span>
                            <span>{{ $question->user->questions_count }}</span>
                        </p>
                        <p>
                            <span>回答</span>
                            <span>{{ $question->user->answers_count }}</span>
                        </p>
                        <p>
                            <span>粉丝</span>
                            <span>{{ $question->user->followers_count }}</span>
                        </p>
                    </div>
                    <div>
                        <user-follow-button user="{{ $question->user->id }}"></user-follow-button>
                        <send-message user="{{ $question->user->id }}" to_user="{{ $question->user->name }}"></send-message>
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
