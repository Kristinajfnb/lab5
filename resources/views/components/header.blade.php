<header>
    <h1>{{ $title }}</h1>
    <nav>
        <ul>
            <li><a href="{{ route('tasks.index') }}">Список задач</a></li>
            <li><a href="{{ route('tasks.create') }}">Создать задачу</a></li>
            <li><a href="{{ route('about') }}">О нас</a></li>
        </ul>
    </nav>
</header>
