@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                @foreach($questions as $question)
                    <div class="media">
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
                <div class="alert label-info">some infos here</div>
            </div>
        </div>
    </div>
    </div>
@endsection
