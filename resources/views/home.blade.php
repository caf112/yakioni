@extends('layouts.app')
@section('content')
<h1 class="page-heading">マイページ</h1>
<p>ようこそ、{{ Auth::user()->name }}さん｜<a href="{{ route('articles.create') }}">記事を書く</a></p>
<a href="https://calendar.google.com/" class="button">Googleカレンダーへ</a>
@include('articles.articles')
@endsection()