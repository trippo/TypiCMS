        @if (count($locales) > 1)
        <div class="clearfix">
         <ul class="nav nav-tabs pull-right nav-lang" role="tablist">
         		@foreach ($locales as $locale)
              {{ Html::langButton($locale, array('data-target' => '#' . $target .'-'. $locale, 'data-toggle' => 'tab')) }}
            @endforeach
			  </ul>
			  </div>
        @endif
