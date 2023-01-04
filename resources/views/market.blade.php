@extends('layouts.app')
@section('content')
    
<div class="main-container overflow-auto">

    <div class="container bg-default-light mb-4 py-3 overflow-auto" >

        <div class="row">
            @isset($products)
                @foreach ($products as $item)
                    <div class="col-6 col-md-4 col-lg-3">
                        <div class="card border-0 mb-4 overflow-hidden">
                            <div class="card-body h-150 position-relative">
                                {{-- <div class="top-right m-2">
                                    <button class="btn btn-sm btn-light btn-rounded btn-40 rounded-circle"><i class="material-icons mt-0 vm">favorite_border</i></button>
                                </div> --}}
                                <div class="bottom-left m-2">
                                    <button class="btn btn-sm btn-default rounded">
                                        {{$item->elexir}}
                                        <img src="{{asset('promo/dist/img/promo/eleksir3.png')}}" width="20px" alt="">
                                    </button>

                                </div>
                                <a href="product.html" class="background">
                                    <img src="{{asset('images/'.$item->image)}}" alt="">
                                </a>
                            </div>
                            <div class="card-body ">
                                {{-- <p class="mb-0"><small class="text-secondary">Rockstar</small></p> --}}
                                <a href="product.html">
                                    <p class="mb-0">{{$item->name}}</p>
                                </a>
                                {{-- <h5 class="mb-0">
                                    {{$item->elexir}}
                                        <img src="{{asset('promo/dist/img/promo/eleksir3.png')}}" width="20px" alt="">
                                </h5> --}}
                            </div>
                        </div>
                    </div>
                @endforeach
            @endisset
        </div>
    </div>
</div>
@endsection
