@extends('layouts.app')

@section('content')
    <div class="container-fluid questions-bar">
        <div class="container">
            <h3>
                论坛
                <a href="{{ route('question.create') }}" class="btn btn-success pull-right"> 发布问题</a>
            </h3>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                @foreach($questions as $question)
                    <div class="media questions-list">
                        <div class="media-left">
                            <a href="#">
                                <img class="media-object img-rounded" src="{{ asset($question->user->avatar) }}" alt="..." height="60px">
                            </a>
                        </div>
                        <div class="media-body">
                            <h4 class="media-heading">
                                <a href="{{ route('question.show', $question->id) }}"> {{ $question->title }} </a>
                            </h4>
                            <div class="questions_info">
                                <span>由 {{$question->user->name}}</span>
                                <span>发布于 {{$question->updated_at}}</span>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="col-md-4">
                <div class="panel panel-default">
                    <div class="panel-heading">热门话题</div>
                    <div class="panel-body">
                        @foreach($topics as $topic)
                            <a href="" class="label label-success" style="margin-bottom: 4px;display: inline-block">{{ $topic->name }}</a>
                        @endforeach
                    </div>
                </div>

                <div class="panel panel-default">
                    <div class="panel-heading">活跃用户</div>
                    <div class="panel-body">
                        @foreach($users as $user)
                            <img src="{{ $user->avatar }}" alt="" class="img-circle" style="height: 40px;margin-bottom: 4px; ">
                        @endforeach
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
