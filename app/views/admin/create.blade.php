@section('main')

    <h1>
        @include('admin._button-back', ['table' => $model->getTable()])
        @lang($model->getTable() . '::global.New')
    </h1>

    {{ BootForm::open()->action(route('admin.' . $model->getTable() . '.index'))->multipart()->role('form') }}
        @include($module . '.admin._form')
    {{ BootForm::close() }}

@stop
