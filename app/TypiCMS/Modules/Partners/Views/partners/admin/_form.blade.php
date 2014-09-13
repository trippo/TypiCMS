@section('js')
    {{ HTML::script(asset('//tinymce.cachefly.net/4.1/tinymce.min.js')) }}
    {{ HTML::script(asset('js/admin/form.js')) }}
@stop

@section('otherSideLink')
    @include('admin._navbar-public-link')
@stop

@section('titleLeftButton')
    @include('admin._button-back', ['table' => $model->route])
@stop

@include('admin._buttons-form')

{{ BootForm::hidden('id'); }}

@include('admin._image-fieldset', ['field' => 'logo'])

@include('admin._tabs-lang-form', ['target' => 'content'])

<div class="tab-content">

@foreach ($locales as $lang)

    <div class="tab-pane fade @if($locale == $lang)in active @endif" id="content-{{ $lang }}">
        <div class="row">
            <div class="col-md-6 form-group">
                {{ BootForm::text(trans('labels.title'), $lang.'[title]')->autofocus('autofocus') }}
            </div>
            <div class="col-md-6 form-group @if($errors->has($lang.'.slug'))has-error @endif">
                {{ Form::label($lang.'[slug]', trans('validation.attributes.slug'), array('class' => 'control-label')) }}
                <div class="input-group">
                    {{ Form::text($lang.'[slug]', $model->translate($lang)->slug, array('class' => 'form-control')) }}
                    <span class="input-group-btn">
                        <button class="btn btn-default btn-slug @if($errors->has($lang.'.slug'))btn-danger @endif" type="button">@lang('validation.attributes.generate')</button>
                    </span>
                </div>
                {{ $errors->first($lang.'.slug', '<p class="help-block">:message</p>') }}
            </div>
        </div>
        {{ BootForm::checkbox(trans('labels.online'), $lang.'[status]') }}
        <div class="form-group @if($errors->has($lang.'.website'))has-error @endif">
            {{ Form::label($lang.'[website]', trans('validation.attributes.website'), array('class' => 'control-label')) }}
            {{ Form::text($lang.'[website]', $model->translate($lang)->website, array('class' => 'form-control', 'placeholder' => 'http://')) }}
            {{ $errors->first($lang.'.website', '<p class="help-block">:message</p>') }}
        </div>
        {{ BootForm::textarea(trans('labels.body'), $lang.'[body]')->addClass('editor') }}
    </div>

@endforeach

</div>
