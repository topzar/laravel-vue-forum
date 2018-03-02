@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        @if( Auth::check() && Auth::user()->isOwner($question))
                            <a href="{{ route('question.edit',$question->id) }}" class="btn btn-primary">编辑问题</a>
                        @endif
                        {{ $question->title }}
                        @foreach($question->topics as $topic)
                            <span class="label label-info" style="margin:0 2px;"> # {{ $topic->name }} </span> &nbsp;
                        @endforeach
                    </div>
                    <div class="panel-body">
                        {!! $question->body !!}
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
