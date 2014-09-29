@section('main')

    <h1>
        @include('admin._button-back', ['table' => $model->getTable()])
        @lang($module . '::global.New')
    </h1>

    {{ BootForm::open()->action(route('admin.blocks.index'))->multipart()->role('form') }}
        @include($module . '.admin._form')
    {{ BootForm::close() }}

@stop
