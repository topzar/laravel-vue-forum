@extends('layouts.app')

@section('content')
    <div class="container-fluid questions-bar">
        <div class="container">
            <h3>
                <span><i class="fa fa-comments"></i> 问答 - 请文明讨论</span>
                <a href="{{ route('question.create') }}" class="btn btn-primary pull-right"> 发布问题</a>
            </h3>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-9">
                @foreach($questions as $question)
                    <div class="media questions-list">
                        <div class="media-left">
                            <a href="#">
                                <img class="media-object img-circle questions-user-avatar" src="{{ asset($question->user->avatar) }}" alt="...">
                            </a>
                        </div>
                        <div class="media-body">
                            <h4 class="media-heading">
                                <a href="{{ route('question.show', $question->id) }}" class="media-heading-title"> {{ $question->title }} </a>
                            </h4>
                            <div class="questions-info">
                                <span>由 <a href="{{ route('user.home', $question->user->name) }}">{{$question->user->name}}</a></span>
                                <span>发布于 {{ getDiffTimeFromNow($question->updated_at) }}</span>
                            </div>
                        </div>
                    </div>
                @endforeach
                <div>
                    {{ $questions->links() }}
                </div>
            </div>
            <div class="col-md-3">
                <div class="panel panel-default">
                    <div class="panel-heading">热门话题</div>
                    <div class="panel-body">
                        @foreach($topics as $topic)
                            <a href="{{ route('topic.show', $topic->id) }}" class="label label-default" style="margin-bottom: 4px;display: inline-block">{{ $topic->name }}</a>
                        @endforeach
                    </div>
                </div>

                <div class="panel panel-default">
                    <div class="panel-heading">活跃用户</div>
                    <div class="panel-body">
                        {{--@foreach($users as $user)--}}
                            {{--<img src="{{ $user->avatar }}" alt="" class="img-circle" style="height: 40px;margin-bottom: 4px; ">--}}
                        {{--@endforeach--}}
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
