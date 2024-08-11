@foreach ($companies as $company)
<articele class="company-item">
    <div class="company-name"><a href="{{ route('companies.show', $company) }}">{{ $company->name }}</a></div>
    <div class="company-info">
        {{ $company->created_at }}|{{ $company->user->name }}
    </div>
</article>
@endforeach