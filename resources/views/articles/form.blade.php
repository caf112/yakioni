@csrf 
<dl class="form-list">
    <dt>企業名</dt>
    <dd><input type="text" name="title" value="{{ old('title', $article->title) }}"></dd>
    <dl class="form-list">
    <dt>ステータス</dt>
    <dd>
        <input type="radio" name="status" value="0">未着手
        <input type="radio" name="status" value="1">一次選考
        <input type="radio" name="status" value="2">二次選考
        <input type="radio" name="status" value="3">三次選考
    </dd>
    <dt>タグ</dt>
    <dd><input type="text" name="tag" value="{{ old('tag', $article->tag) }}"></dd>
    <dt>URL</dt>
    <dd><input type="text" name="url" value="{{ old('url', $article->url) }}"></dd>
    <dt>メモ</dt>
    <dd><textarea name="body" rows="5">{{ old('body', $article->body) }}</textarea></dd>
</dl>