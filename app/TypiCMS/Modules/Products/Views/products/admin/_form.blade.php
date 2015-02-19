@section('js')
    {{ HTML::script(asset('//tinymce.cachefly.net/4.1/tinymce.min.js')) }}
    {{ HTML::script(asset('js/admin/form.js')) }}
@stop

@section('otherSideLink')
    @include('admin._navbar-public-link')
@stop


@include('admin._buttons-form')

{{ Form::hidden('id'); }}

<ul class="nav nav-tabs">
    <li class="active">
        <a href="#tab-main" data-target="#tab-main" data-toggle="tab">@lang('global.Info')</a>
    </li>
    <li>
        <a href="#tab-files" data-target="#tab-images" data-toggle="tab">@lang('global.Images')</a>
    </li>
    <li>
        <a href="#tab-meta" data-target="#tab-meta" data-toggle="tab">@lang('global.Meta')</a>
    </li>
    <li>
        <a href="#tab-options" data-target="#tab-options" data-toggle="tab">@lang('global.Options')</a>
    </li>
</ul>

<div class="tab-content">
	
    {{-- Main tab --}}
    <div class="tab-pane fade in active" id="tab-main">
	
		<div class="row">
		    <div class="col-sm-4 form-group">
		        {{ Form::label('sku', trans('validation.attributes.sku'), array('class' => 'control-label')) }}
		        {{ Form::text('sku', $model->sku, array('id' => 'sku', 'class' => 'form-control')) }}
		    </div>
		    
		    <div class="col-sm-4 form-group @if($errors->has('partner_id'))has-error @endif">
		        {{ Form::label('partner_id', trans('validation.attributes.partner_id'), array('class' => 'control-label')) }}
		        {{ Form::select('partner_id', Partners::getAllForSelect(), null, array('class' => 'form-control')) }}
		        {{ $errors->first('partner_id', '<p class="help-block">:message</p>') }}
		    </div>
		    
		    <div class="col-sm-4 form-group @if($errors->has('category_id'))has-error @endif">
		        {{ Form::label('category_id', trans('validation.attributes.category_id'), array('class' => 'control-label')) }}
		        {{ Form::select('category_id', Categories::getCategoriesForSelect(), null, array('class' => 'form-control')) }}
		        {{ $errors->first('category_id', '<p class="help-block">:message</p>') }}
		    </div>
		</div>
		
		
		<div class="row">
		    <div class="col-sm-4 form-group">
		        {{ Form::label('price', trans('validation.attributes.price'), array('class' => 'control-label')) }}
		        <div class="input-group">
					<span class="input-group-addon">{{ trans('global.currency') }}</span>
					{{ Form::number('price', $model->price, array('id' => 'price', 'class' => 'form-control')) }}
		        </div>
		    </div>
		    <div class="col-sm-4 form-group">
		        {{ Form::label('discount', trans('validation.attributes.discount'), array('class' => 'control-label')) }}
		        <div class="input-group">
					<span class="input-group-addon">{{ trans('global.currency') }}</span>
					{{ Form::number('discount', $model->discount, array('id' => 'discount', 'class' => 'form-control')) }}
		        </div>
		    </div>
		    <div class="col-sm-4 form-group">
		        {{ Form::label('weight', trans('validation.attributes.weight'), array('class' => 'control-label')) }}
		        <div class="input-group">
					<span class="input-group-addon">{{ trans('global.weight_unit') }}</span>
					{{ Form::number('weight', $model->weight, array('id' => 'weight', 'class' => 'form-control')) }}
		        </div>
		    </div>
		</div>
		
		<div class="form-group">
		    {{ Form::label('tags', trans('validation.attributes.tags'), array('class' => 'control-label')) }}
		    {{ Form::text('tags', $tags, array('id' => 'tags', 'class' => 'form-control')) }}
		</div>
		
		@include('admin._tabs-lang')
		
		<div class="tab-content tab-lang">
		
		    @foreach ($locales as $lang)
		
		    <div class="tab-pane fade @if ($locale == $lang)in active @endif" id="{{ $lang }}">
		
		        <div class="row">
		            <div class="col-md-6 form-group">
		                {{ Form::label($lang.'[title]', trans('validation.attributes.name')) }}
		                {{ Form::text($lang.'[title]', $model->translate($lang)->title, array('class' => 'form-control')) }}
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
		
		        <div class="checkbox">
		            <label>
		                {{ Form::checkbox($lang.'[status]', 1, $model->translate($lang)->status) }} @lang('validation.attributes.online')
		            </label>
		        </div>
		        <div class="form-group">
		            {{ Form::label($lang.'[summary]', trans('validation.attributes.summary')) }}
		            {{ Form::textarea($lang.'[summary]', $model->translate($lang)->summary, array('class' => 'form-control', 'rows' => 4)) }}
		        </div>
		        <div class="form-group">
		            {{ Form::label($lang.'[body]', trans('validation.attributes.body')) }}
		            {{ Form::textarea($lang.'[body]', $model->translate($lang)->body, array('class' => 'editor form-control')) }}
		        </div>
		    </div>
		
		    @endforeach
		
		</div>
    </div>
    
    {{-- Galleries tab --}}
    <div class="tab-pane fade in" id="tab-images">

    </div>

    {{-- Metadata tab --}}
    <div class="tab-pane fade in" id="tab-meta">

        @include('admin._tabs-lang-form', ['target' => 'meta'])

        <div class="tab-content tab-lang">

        {{-- Headers --}}
        @foreach ($locales as $lang)

        <div class="tab-pane fade in @if ($locale == $lang)active @endif" id="meta-{{ $lang }}">

            <div class="form-group">
                {{ Form::label($lang.'[meta_title]', trans('validation.attributes.meta_title')) }}
                {{ Form::text($lang.'[meta_title]', $model->translate($lang)->meta_title, array('class' => 'form-control')) }}
            </div>

            <div class="form-group">
                {{ Form::label($lang.'[meta_keywords]', trans('validation.attributes.meta_keywords')) }}
                {{ Form::text($lang.'[meta_keywords]', $model->translate($lang)->meta_keywords, array('class' => 'form-control')) }}
            </div>

            <div class="form-group">
                {{ Form::label($lang.'[meta_description]', trans('validation.attributes.meta_description')) }}
                {{ Form::text($lang.'[meta_description]', $model->translate($lang)->meta_description, array('class' => 'form-control')) }}
            </div>

        </div>

        @endforeach

        </div>

    </div>

    {{-- Options --}}
    <div class="tab-pane fade in" id="tab-options">
    </div>
</div>
