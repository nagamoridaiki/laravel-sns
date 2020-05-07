@extends('app')

@section('title', $user->name."さんの経歴・実績を作成")

@section('content')
@include('nav')


<div class="container">

<div class="card mt-3">
    <div class="card-body">
        <a href="/background" class="right-side"><< 経歴・実績一覧に戻る</a>
    </div>
</div>

    <div class="card mt-3">
        <div class="card-body">
            <div class="col-md-8">
                <form method="POST" action="/newbackground">
                    @csrf
                    <input type="hidden" name="user_id" value="{{ $user->id }}">
                    <div class="form-row mb-1">
                        <div class="form-group col-md-9">
                            <label for="background_title">概要</label>
                            <input id="name" type="text" class="form-control" name="title" value="">
                        </div>
                    </div>
                    <div class="form-row mb-1">
                        <div class="form-group col-md-9">
                            詳細<textarea name="job_detail" required class="form-control" rows="5"></textarea>
                        </div>
                    </div>
                    <div class="form-row mb-1">
                        <div class="form-group col-md-12">
                            <div for="self_introduction">期間</div>
                            <input type="number" name="start_year" value="2020" ><input type="number" name="start_month" value="1">〜
                            <input type="number" name="end_year" value="2020" ><input type="number" name="end_month" value="1">
                        </div>
                    </div>
                    <div class="card-text">
                        <button type="submit" class="btn btn-block blue-gradient" name="confirm">登録する</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
