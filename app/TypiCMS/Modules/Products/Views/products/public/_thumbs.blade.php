@if ($model->photos->count())
    <div class="row">
    @foreach ($model->photos as $image)
        <div class="col-xs-4 col-sm-3 col-md-2">
            <div class="thumbnail">
                <a class="fancybox" href="{{ asset($image->path . $image->filename) }}" data-fancybox-group="{{ $model->slug }}">
                    {{ $image->present()->thumb(200, 200, array(), 'filename') }}
                </a>
            </div>
        </div>
    @endforeach
    </div>
@endif
