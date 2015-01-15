@section('js')
    {{ HTML::script(asset('//tinymce.cachefly.net/4.1/tinymce.min.js')) }}
    {{ HTML::script(asset('js/admin/form.js')) }}
@stop

@section('otherSideLink')
    @include('admin._navbar-public-link')
@stop


@include('admin._buttons-form')

{{ Form::hidden('id'); }}

@include('admin._image-fieldset', ['field' => 'image'])

<div class="row">
    <div class="col-sm-4 form-group">
        {{ Form::label('parent_id', trans('categories::global.parent_category'), array('class' => 'control-label')) }}        
        {{ Form::select('parent_id', $selectCategories, $model->parent_id, array('class' => 'form-control')) }}
        
    </div>
</div>

@include('admin._tabs-lang')

<div class="tab-content tab-lang">

    @foreach ($locales as $lang)

    <div class="tab-pane fade @if ($locale == $lang)in active @endif" id="{{ $lang }}">
        <div class="row">
            <div class="col-md-6 form-group">
                {{ Form::label($lang.'[title]', trans('validation.attributes.title')) }}
                {{ Form::text($lang.'[title]', $model->translate($lang)->title, array('class' => 'form-control')) }}
            </div>
            <div class="col-md-6 form-group @if($errors->has($lang.'.slug'))has-error @endif">
                {{ Form::label($lang.'[slug]', trans('validation.attributes.slug')) }}
                <div class="input-group">
                    {{ Form::text($lang.'[slug]', $model->translate($lang)->slug, array('class' => 'form-control')) }}
                    <span class="input-group-btn">
                        <button class="btn btn-default btn-slug @if($errors->has($lang.'.slug'))btn-danger @endif" type="button">@lang('validation.attributes.generate')</button>
                    </span>
                </div>
                {{ $errors->first($lang.'.slug', '<p class="help-block">:message</p>') }}
            </div>
        </div>
        <div class="checkbox">
            <label>
                {{ Form::checkbox($lang.'[status]', 1, $model->translate($lang)->status) }} @lang('validation.attributes.online')
            </label>
        </div>
		<div class="row">
            <div class="col-sm-12 form-group">
                {{ Form::label($lang.'[excerpt]', trans('validation.attributes.excerpt')) }}
                {{ Form::text($lang.'[excerpt]', $model->translate($lang)->excerpt, array('class' => 'form-control')) }}
            </div>
		</div>
		
		<div class="row">
            <div class="col-sm-12 form-group">
                {{ Form::label($lang.'[description]', trans('validation.attributes.description')) }}
                {{ Form::textarea($lang.'[description]', $model->translate($lang)->description, array('class' => 'editor form-control')) }}
            </div>
		</div>
    </div>

    @endforeach

</div>
