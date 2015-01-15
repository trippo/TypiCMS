@section('languagesMenu') @stop
@section('header')        @stop
@section('mainMenu')      @stop
@section('footer')        @stop

@section('main')

    <div class="row">

        <div class="col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">

            <div class="page-header">

                <h1 class="text-center">Choose language</h1>

            </div>


            <div class="btn-group btn-group-justified">

                @foreach ($locales as $locale)

                <a href="/{{ $locale }}" class="btn btn-default btn-lg"><img src="/img/languages/{{$locale}}.png" width="40" alt="{{ trans('db.languages.'.$locale) }}" /> {{ trans('db.languages.'.$locale) }}</a>

                @endforeach

            </div>

        </div>

    </div>

@stop
