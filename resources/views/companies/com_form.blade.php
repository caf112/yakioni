@csrf 
<dl class="form-list">
    <dt>企業名</dt>
    <dd><input type="text" name="name" value="{{ old('name', $company->name) }}"></dd>

    <dt>ステータス</dt>
    <dd>
        <input type="radio" name="status" value="0">未着手
        <input type="radio" name="status" value="1">一次選考
        <input type="radio" name="status" value="2">二次選考
        <input type="radio" name="status" value="3">三次選考
    </dd>

    <dt>タグ</dt>
    <dd><input type="text" name="tag" value="{{ old('tag', $company->tag) }}"></dd>
    <dt>勤務地</dt>
    <dd><input type="text" name="place" value="{{ old('place', $company->place) }}"></dd>
    <dt>URL</dt>
    <dd><input type="text" name="url" value="{{ old('url', $company->url) }}"></dd>
    <dt>メモ</dt>
    <dd><textarea name="comment" rows="5">{{ old('comment', $company->comment) }}</textarea></dd>
</dl>