@extends('layouts.app')
@section('content')
@include('commons.errors')
<form action="{{ route('companys.update', $company) }}" method="post">
    @method('patch')
    @include('companys.form')
    <button type="submit">更新する</button>
    <a href="{{ route('companys.show', $company) }}">キャンセル</a>
</form>
@endsection()