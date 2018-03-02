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
                <a href="{{ route('question.create') }}"> 登录发布问题</a>
            </div>
        </div>
    </div>
@endsection
