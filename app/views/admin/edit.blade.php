@section('main')

    <h1>
        @include('admin._button-back', ['table' => $model->getTable()])
        {{ $model->present()->title }}
    </h1>

    {{ BootForm::open()->put()->action(route('admin.' . $model->getTable() . '.update', $model->id))->multipart()->role('form') }}
    {{ BootForm::bind($model) }}
        @include($module . '.admin._form')
    {{ BootForm::close() }}

@stop
