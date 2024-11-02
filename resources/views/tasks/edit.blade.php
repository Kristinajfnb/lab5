<form action="{{ route('tasks.update', $task->id) }}" method="POST">
    @csrf
    @method('PUT')
    <div>
        <label for="title">Название задачи:</label>
        <input type="text" name="title" id="title" value="{{ $task->title }}" required>
    </div>
    <div>
        <label for="description">Описание задачи:</label>
        <textarea name="description" id="description" required>{{ $task->description }}</textarea>
    </div>
    <div>
        <label for="category_id">Категория:</label>
        <select name="category_id" id="category_id">
            @foreach ($categories as $category)
                <option value="{{ $category->id }}" {{ $category->id == $task->category_id ? 'selected' : '' }}>{{ $category->name }}</option>
            @endforeach
        </select>
    </div>
    <div>
        <label for="tags">Теги:</label>
        <select name="tags[]" id="tags" multiple>
            @foreach ($tags as $tag)
                <option value="{{ $tag->id }}" {{ $task->tags->contains($tag->id) ? 'selected' : '' }}>{{ $tag->name }}</option>
            @endforeach
        </select>
    </div>
    <button type="submit">Сохранить изменения</button>
</form>
