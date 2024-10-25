<div class="task">
    <h2>{{ $title }}</h2>
    <p>{{ $description }}</p>
    <p><strong>Дата создания:</strong> {{ $created_at }}</p>
    <p><strong>Дата обновления:</strong> {{ $updated_at }}</p>
    <p><strong>Статус:</strong> {{ $completed ? 'Выполнена' : 'Не выполнена' }}</p>
    <p><strong>Приоритет:</strong> {{ $priority }}</p>
    <p><strong>Исполнитель:</strong> {{ $assigned_to }}</p>
    <div class="actions">
        <a href="{{ route('tasks.edit', $id) }}">Редактировать</a>
        <form action="{{ route('tasks.destroy', $id) }}" method="POST" style="display:inline;">
            @csrf
            @method('DELETE')
            <button type="submit">Удалить</button>
        </form>
    </div>
</div>
