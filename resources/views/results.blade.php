@forelse ($urls as $url)
    <li><a href="/{{ $url->id26 }}" target="_blank">{{ $url->url }}</a></li>
@empty
    <p>Нет записей</p>
@endforelse
