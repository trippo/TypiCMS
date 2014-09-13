@section('js')
    {{ HTML::script(asset('//tinymce.cachefly.net/4.1/tinymce.min.js')) }}
    {{ HTML::script(asset('js/admin/form.js')) }}
@stop

@section('titleLeftButton')
    @include('admin._button-back', ['table' => $model->route])
@stop

@include('admin._buttons-form')

{{ BootForm::hidden('id'); }}

{{ BootForm::text(trans('labels.name'), 'name')->autofocus('autofocus') }}

@include('admin._tabs-lang-form', ['target' => 'content'])

<div class="tab-content">

@foreach ($locales as $lang)

    <div class="tab-pane fade @if($locale == $lang)in active @endif" id="content-{{ $lang }}">
        {{ BootForm::checkbox(trans('labels.online'), $lang.'[status]') }}
        {{ BootForm::textarea(trans('labels.body'), $lang.'[body]')->addClass('editor') }}
    </div>

@endforeach

</div>
