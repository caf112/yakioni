@csrf 
<dl class="form-list">
    <dt>企業名<sup class="red">*</sup></dt>
    <dd><input type="text" name="title" value="{{ old('title', $article->title) }}"></dd>
    <dl class="form-list">
    <dt>ステータス<sup class="red">*</sup></dt>
    <dd>
        <input type="radio" name="status" value="0">未着手
        <input type="radio" name="status" value="1">一次選考
        <input type="radio" name="status" value="2">二次選考
        <input type="radio" name="status" value="3">三次選考
        <input type="radio" name="status" value="4">内定
        <input type="radio" name="status" value="5">アーカイブ
    </dd>
    <dt>タグ<sup class="red">*</sup></dt>
    <dd><input type="text" name="tag" value="{{ old('tag', $article->tag) }}"></dd>
    <dt>URL<sup class="red">*</sup></dt>
    <dd><input type="text" name="url" value="{{ old('url', $article->url) }}"></dd>
    <dt>メモ<sup class="red">*</sup></dt>
    <dd><textarea name="body" rows="5">{{ old('body', $article->body) }}</textarea></dd>

    <dt>イベント名<sup class="red">*</sup></dt>
    <dd><input type="text" name="summary" value="{{ old('summary') }}"></dd>

    <dt>開始日時<sup class="red">*</sup></dt>
    <dd><input type="datetime-local" name="start_date" value="{{ old('start_date') }}"></dd>

    <dt>終了日時<sup class="red">*</sup></dt>
    <dd><input type="datetime-local" name="end_date" value="{{ old('end_date') }}"></dd>

</dl>