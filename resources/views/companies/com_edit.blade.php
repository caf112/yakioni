@extends('layouts.app')
@section('content')
@include('commons.errors')
<form action="{{ route('companies.update', $company) }}" method="post">
    @method('patch')
    @include('companies.com_form')
    <button type="submit">更新する</button>
    <a href="{{ route('companies.show', $company) }}">キャンセル</a>
</form>
@endsection()