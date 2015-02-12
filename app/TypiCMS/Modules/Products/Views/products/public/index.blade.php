@section('main')

    <h2>{{ Str::title(trans_choice('products::global.products', 2)) }}</h2>

    @if ($models->count())

    <ul>
        @foreach ($models as $model)
        <li>
            <strong>{{ $model->title }}</strong>
            <br>
            <a href="{{ route($lang.'.products.categories.slug', array($model->category->slug, $model->slug)) }}">@lang('db.More')</a>
        </li>
        @endforeach
    </ul>

    @endif

@stop
