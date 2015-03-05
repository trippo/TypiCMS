@section('bodyClass')
@stop
@section('navbar')
@stop
@section('sidebar')
@stop
@section('mainClass')
col-xs-12
@stop
@section('breadcrumbs')
@stop

@section('h1')
    <span id="nb_elements">{{ $models->getTotal() }}</span> @choice('photos::global.photos', $models->getTotal())
@stop

@section('titleLeftButton')
@stop

@section('main')

    @include('photos.admin.thumbnails')

@stop
