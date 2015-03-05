@section('main')

    <h1>
	    <?php if($model->getTable()=='photos'){ ?>
	    @include('admin._button-url-back', ['table' => 'products','url' => $model->returnUrl()])
	    <?php }elseif($model->getTable()=='files'){ ?>
	    @include('admin._button-url-back', ['table' => 'galleries','url' => $model->returnUrl()])
        <?php }else{ ?>   
        @include('admin._button-back', ['table' => $model->getTable()])
	    <?php } ?>
        {{ $model->present()->title }}
    </h1>

    {{ Form::model( $model, array( 'route' => array('admin.' . $model->getTable() . '.update', $model->id), 'files' => true, 'method' => 'put', 'role' => 'form' ) ) }}
        @include($model->getTable() . '.admin._form')
    {{ Form::close() }}

@stop
