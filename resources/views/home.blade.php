@extends('layouts.app')
@section('content')
    
<div class="container-fluid px-0">
    <div class="overflow-hidden">
        <div class="card-body p-0 h-150">
            <div class="background">
            </div>
        </div>
    </div>
</div>
<div class="container-fluid text-center mb-4">
    <div class="avatar avatar-140 rounded-circle mx-auto shadow" style="width: 170px;height:170px">
        <div class="background">
            <img src="https://api.multiavatar.com/kathrin.svg" alt="">
        </div>
    </div>
</div>

<div class="container text-center text-white mb-5" style="margin-top: 20%;">
    <h3 class="mb-1" style="font-family: Supercell-Magic">{{Auth::user()->last_name}} {{Auth::user()->first_name}}</h1>
    <h1 style="font-family: Supercell-Magic">{{ Auth::user()->pharmacy }}</h1>
</div>
<div class="container mt-5">
    <div class="row">
        <div class="col-6">
            <a href="{{'my-shop'}}">
                <button class="btn btn-outline-warning px-2 btn-block rounded"><span class="material-icons mr-1">local_mall</span>Market</button>
            </a>
        </div>
        <div class="col-6">
            <a href="{{route('my-order')}}">
                <button class="btn btn-outline-warning px-2 btn-block rounded"><span class="material-icons mr-1">shopping_cart</span>Buyurtma</button>
            </a>
        </div>
    </div>
</div>
@endsection
@section('scripts')
<script>
    ymaps.ready(init);

function init() {
    var geolocation = ymaps.geolocation,
        myMap = new ymaps.Map('map', {
            center: [55, 34],
            zoom: 10
        }, {
            searchControlProvider: 'yandex#search'
        });

    // Сравним положение, вычисленное по ip пользователя и
    // положение, вычисленное средствами браузера.
    geolocation.get({
        provider: 'yandex',
        mapStateAutoApply: true
    }).then(function (result) {
        // Красным цветом пометим положение, вычисленное через ip.
        result.geoObjects.options.set('preset', 'islands#redCircleIcon');
        result.geoObjects.get(0).properties.set({
            balloonContentBody: 'Мое местоположение'
        });
        myMap.geoObjects.add(result.geoObjects);
    });

    geolocation.get({
        provider: 'browser',
        mapStateAutoApply: true
    }).then(function (result) {
        // Синим цветом пометим положение, полученное через браузер.
        // Если браузер не поддерживает эту функциональность, метка не будет добавлена на карту.
        result.geoObjects.options.set('preset', 'islands#blueCircleIcon');
        myMap.geoObjects.add(result.geoObjects);
    });
}
</script>
@endsection