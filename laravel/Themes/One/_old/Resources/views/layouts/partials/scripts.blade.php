{{-- Bootstrap core JavaScript
	<script src="/themes/foodpicky/js/jquery.min.js"></script>
	<script src="/themes/foodpicky/js/tether.min.js"></script>
	<script src="/themes/foodpicky/js/bootstrap.min.js"></script>
	<script src="/themes/foodpicky/js/animsition.min.js"></script>
	<script src="/themes/foodpicky/js/bootstrap-slider.min.js"></script>
	<script src="/themes/foodpicky/js/jquery.isotope.min.js"></script>
	<script src="/themes/foodpicky/js/headroom.js"></script>
	<script src="/themes/foodpicky/js/foodpicky.min.js"></script>
	================================================== --}}
<script>
    var base_url = '{{ asset('/') }}';
    var lang = '{{ app()->getLocale() }}';
    {{-- var google_maps_api='{{ config('xra.google.maps.api') }}'; --}}
    @if (\Request::has('address'))
        var address ="{{ \Request::input('address') }}";
    @endif
    @if (\Request::has('lat') && \Request::has('lng'))
        var lat ="{{ \Request::input('lat') }}";
        var lng ="{{ \Request::input('lng') }}";
    @endif
</script>
@stack('scripts_before')
@php
//Theme::add('pub_ui::js/jquery.min.js',1);
//Theme::add('pub_ui::js/tether.min.js');
/*Theme::add('pub_ui::js/bootstrap.min.js');*/
/*Theme::add('pub_ui::js/foodpicky.js');*/
/*
 Theme::add('pub_ui::js/bootstrap-slider.min.js');
 Theme::add('pub_ui::js/jquery.isotope.min.js');
 Theme::add('pub_ui::js/headroom.js');
 Theme::add('/theme/bc/matchHeight/dist/jquery.matchHeight-min.js');
 //Theme::add('pub_ui::js/jquery.validate.min.js');

Theme::add('pub_ui::js/xot.js');*/
@endphp
<livewire:scripts />

{!! Theme::showScripts(false) !!}
@stack('scripts')

{{--<script defer src="https://unpkg.com/@alpinejs/focus@3.x.x/dist/cdn.min.js"></script>--}}

{{--<script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>--}}

<script src="https://cdn.jsdelivr.net/gh/livewire/sortable@v0.x.x/dist/livewire-sortable.js"></script>

@livewire('modal-pro')
