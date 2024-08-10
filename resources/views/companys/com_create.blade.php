@extends('layouts.app')
@section('content')
@include('commons.errors')
<form action="{{ route('companys.store') }}" method="post">
    @include('companys.com_form')
    <button type="submit">投稿する</button>
    <a href="{{ route('companys.index') }}">キャンセル</a>
</form>
@endsection()