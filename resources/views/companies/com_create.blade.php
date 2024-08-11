@extends('layouts.app')
@section('content')
@include('commons.errors')
<form action="{{ route('companies.store') }}" method="post">
    @include('companies.com_form')
    <button type="submit">投稿する</button>
    <a href="{{ route('companies.index') }}">キャンセル</a>
</form>
@endsection()