@extends('app')

@section('title', '記事一覧')


@section('content')
    @include('nav')
    @if(Session::has('flash_message'))  
        <div class="alert alert-success">
            {{ session('flash_message') }}
        </div>
    @endif
    <div class="col-md-2 col-xs-12">
      @include('articles.tags')
    </div>
    <div class="col-md-10 col-xs-12">
      @foreach($articles as $article)
          @include('articles.card')
      @endforeach
    </div>
@endsection