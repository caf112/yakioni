@extends('layouts.app')
@section('content')
<article class="article-detail">
    <h1 class="article-title">{{ $article->title }}</h1>
    <div class="article-info">{{ $article->created_at }}</div>
    <h3>ステータス</h3>
    <div class="article-sutatus">
    @if($article->status == 0)
        未着手
    @elseif($article->status == 1)
        1次選考
    @elseif($article->status == 2)
        2次選考
    @elseif($article->status == 3)
        最終選考
    @elseif($article->status == 4)
        内定
    @elseif($article->status == 5)
        アーカイブ
    @else
        {{ $article->status }}
    @endif
</div>
<h3>タグ</h3>
    <div class="article-tag">{{ $article->tag }}</div>
    <h3>URL</h3>
    <div class="article-url">{{ $article->url }}</div>
    <h3>メモ</h3>
    <div class="article-body">{!! nl2br(e($article->body)) !!}</div>
    @can('update', $article)
    <div class="article-control">
        <a href="{{ route('articles.edit', $article) }}">編集</a>
        <form action="{{ route('articles.destroy', $article) }}" method="post">
            @csrf 
            @method('delete')
            <button type="submit">削除</button>
        </form>
    </div>
    @endcan
</article>
@endsection