@extends('app')

@section('title', '記事一覧')


@section('content')
    @include('nav')
      @include('articles.tags')
    <div class="col-md-10 col-xs-12">
      @foreach($articles as $article)
          @include('articles.card')
      @endforeach
    </div>
@endsection