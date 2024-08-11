@csrf 
<dl class="form-list">
    <dt>タイトル</dt>
    <dd><input type="text" name="title" value="{{ old('title', $article->title) }}"></dd>
    <dt>本文</dt>
    <dd><textarea name="body" rows="5">{{ old('body', $article->body) }}</textarea></dd>

    <dt>イベント名:</dt>
    <dd><input type="text" name="summary" value="{{ old('summary') }}"></dd>

    <dt>開始日時</dt>
    <dd><input type="datetime-local" name="start_date" value="{{ old('start_date') }}"></dd>

    <dt>終了日時</dt>
    <dd><input type="datetime-local" name="end_date" value="{{ old('end_date') }}"></dd>

</dl>