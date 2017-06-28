<span>
    Категория:
    <a href="{{ route('professions.index', ['category' => $profession->category->id]) }}">
        {{ $profession->category->title }}
    </a>
</span>
<br><br>

<p>{{ $profession->short_description }}</p>
<p>{!! $profession->full_description !!}</p>
