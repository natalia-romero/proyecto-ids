@php
if (!isset($options)) {
    $options = [];
}
$options = Arr::where($options, function ($option, $key) {
   // return $option['can'] && Route::currentRouteName() != $option['route'];
    return Route::currentRouteName() != $option['route'];
});
@endphp

@section('options')
    @if (count($options) > 0)
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Opciones</h3>
            </div>
            <div class="card-body d-inline-flex flex-wrap p-2">
                @foreach ($options as $option)
                    <a class="btn flex-fill m-1 {{ $option['btn_class'] }}" style="min-width: 200px"
                        href="{{ $option['route_url'] }}">
                        @if (isset($option['icon']))
                            <i class="{{ $option['icon'] }}"></i>
                        @endif
                        {{ $option['text'] }}
                    </a>
                @endforeach
            </div>
        </div>
    @endif
@stop