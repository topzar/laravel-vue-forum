@extends('layouts.app')

@section('content')
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
                            <button class="btn btn-default">关 注</button>
                            <button class="btn btn-success">私 信</button>
                        </p>
                    </div>
                </div>
            </div>
            </div>
        </div>
    </div>
@endsection
