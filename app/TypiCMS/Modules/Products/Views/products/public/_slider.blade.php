@if ($model->photos->count())
<div class="swiper-device">
    <div class="swiper-container">
        <div class="swiper-wrapper">
        @foreach ($model->photos as $image)
            <div class="swiper-slide">
                {{ $image->present()->thumb(1200, 340, ['quadrant' => 'T'], 'filename') }}
            </div>
        @endforeach
        </div>
    </div>
    <div class="swiper-pagination"></div>
</div>
@endif
