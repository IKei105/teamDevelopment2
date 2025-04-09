<h2>検索結果</h2>

@if($results->isEmpty())
    <p>該当する募集はありませんでした。</p>
@else
    <ul>
        @foreach($results as $item)
            <li>
                <strong>{{ $item->sport_type }}</strong> / {{ $item->prefecture }} {{ $item->city }}<br>
                開催日: {{ $item->scheduled_at }}<br>
                一言: {{ $item->comment }}
            </li>
        @endforeach
    </ul>
@endif
