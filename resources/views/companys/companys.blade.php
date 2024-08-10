@foreach ($companys as $company)
<company class="company-item">
    <div class="company-name"><a href="{{ route('companys.show', $company) }}">{{ $company->name }}</a></div>
    <div class="company-info">
        {{ $company->created_at }}|{{ $company->user->name }}
    </div>
</company>
@endforeach