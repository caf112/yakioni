@extends('layouts.app')
@section('content')
@include('commons.errors')
<form action="{{ route('articles.store') }}" method="post">
    @include('articles.form')
    <dt>イベント名<sup class="red">*</sup></dt>
    <dd><input type="text" name="summary" value="{{ old('summary') }}"></dd>

    <dt>開始日時<sup class="red">*</sup></dt>
    <dd><input type="datetime-local" name="start_date" value="{{ old('start_date') }}"></dd>

    <dt>終了日時<sup class="red">*</sup></dt>
    <dd><input type="datetime-local" name="end_date" value="{{ old('end_date') }}"></dd>
    <button type="submit">投稿する</button>
    <a href="{{ route('articles.index') }}">キャンセル</a>
</form>
@endsection()