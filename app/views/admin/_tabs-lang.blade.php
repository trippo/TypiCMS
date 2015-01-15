        @if (count($locales) > 1)
        <div class="clearfix">
        <ul class="nav nav-tabs pull-right nav-lang">
            @foreach ($locales as $lang)
            <li class="@if ($locale == $lang)active @endif">
                <a href="#{{ $lang }}" data-target="#{{ $lang }}" data-toggle="tab"><img src="/img/languages/{{$lang}}.png" width="20"/> @lang('global.languages.'.$lang)</a>
            </li>
            @endforeach
        </ul>
        </div>
        @endif
