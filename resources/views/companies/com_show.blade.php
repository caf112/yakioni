@extends('layouts.app')
@section('content')
<company class="company-detail">
    <h1 class="company-name">{{ $company->name }}</h1>
    <div class="company-info">{{ $company->created_at }}</div>
    <div class="company-status">{{ $company->tag }}</div>
    <div class="company-tag">{{ $company->tag }}</div>
    <div class="company-place">{{ $company->place }}</div>
    <div class="company-url">{{ $company->url }}</div>
    <div class="company-comment">{!! nl2br(e($company->comment)) !!}</div>
    @can('update', $company)
    <div class="company-control">
        <a href="{{ route('companies.edit', $company) }}">編集</a>
        <form action="{{ route('companies.destroy', $company) }}" method="post">
            @csrf 
            @method('delete')
            <button type="submit">削除</button>
        </form>
    </div>
    @endcan
</company>
@endsection