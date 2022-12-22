@extends('layouts.app')
@section('content')
    
<div class="main-container overflow-auto">

    <div class="container bg-default-light mb-4 py-3 overflow-auto" >

        <div class="row">
            <div class="col-6 col-md-4 col-lg-3">
                <div class="card border-0 mb-4 overflow-hidden">
                    <div class="card-body h-150 position-relative">
                        <div class="top-right m-2">
                            <button class="btn btn-sm btn-light btn-rounded btn-40 rounded-circle"><i class="material-icons mt-0 vm">favorite_border</i></button>
                        </div>
                        <div class="bottom-left m-2">
                            <button class="btn btn-sm btn-default rounded">New</button>
                        </div>
                        <a href="product.html" class="background">
                            <img src="{{asset('mobile/media/telefon.png')}}" alt="">
                        </a>
                    </div>
                    <div class="card-body ">
                        <p class="mb-0"><small class="text-secondary">Rockstar</small></p>
                        <a href="product.html">
                            <p class="mb-0">Men Jacket brown</p>
                        </a>
                        <h5 class="mb-0">$ 39.99</h5>
                    </div>
                </div>
            </div>
            <div class="col-6 col-md-4 col-lg-3">
                <div class="card border-0 mb-4 overflow-hidden">
                    <div class="card-body h-150 position-relative">
                        <div class="top-right m-2">
                            <button class="btn btn-sm btn-light btn-rounded btn-40 rounded-circle text-danger"><i class="material-icons mt-0 vm ">favorite</i></button>
                        </div>
                        <div class="bottom-left m-2">
                            <button class="btn btn-sm btn-default rounded">New</button>
                        </div>
                        <figure class="background">
                            <img src="{{asset('mobile/media/mikropech.png')}}" alt="">
                        </figure>
                    </div>
                    <div class="card-body ">
                        <p class="mb-0"><small class="text-secondary">Adididas</small></p>
                        <a href="product.html">
                            <p class="mb-0">Women Jacket</p>
                        </a>
                        <h5 class="mb-0">$ 49.99</h5>
                    </div>
                </div>
            </div>
            <div class="col-6 col-md-4 col-lg-3">
                <div class="card border-0 mb-4 overflow-hidden">
                    <div class="card-body h-150 position-relative">
                        <div class="top-right m-2">
                            <button class="btn btn-sm btn-light btn-rounded btn-40 rounded-circle text-danger"><i class="material-icons mt-0 vm">favorite</i></button>
                        </div>
                        <div class="bottom-left m-2">
                            <button class="btn btn-sm btn-default rounded">New</button>
                        </div>
                        <figure class="background">
                            <img src="{{asset('mobile/media/televizor.png')}}" alt="">
                        </figure>
                    </div>
                    <div class="card-body ">
                        <p class="mb-0"><small class="text-secondary">Rockstar</small></p>
                        <a href="product.html">
                            <p class="mb-0">Shorts Uunisex</p>
                        </a>
                        <h5 class="mb-0">$ 28.99</h5>
                    </div>
                </div>
            </div>
            <div class="col-6 col-md-4 col-lg-3">
                <div class="card border-0 mb-4 overflow-hidden">
                    <div class="card-body h-150 position-relative">
                        <div class="top-right m-2">
                            <button class="btn btn-sm btn-light btn-rounded btn-40 rounded-circle"><i class="material-icons mt-0 vm ">favorite_border</i></button>
                        </div>
                        <div class="bottom-left m-2">
                            <button class="btn btn-sm btn-default rounded">New</button>
                        </div>
                        <figure class="background">
                            <img src="{{asset('mobile/media/plesons.png')}}" alt="">
                        </figure>
                    </div>
                    <div class="card-body ">
                        <p class="mb-0"><small class="text-secondary">Mansheri</small></p>
                        <a href="product.html">
                            <p class="mb-0">Women Jacket</p>
                        </a>
                        <h5 class="mb-0">$ 35.99</h5>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-6 col-md-4 col-lg-3">
                <div class="card border-0 mb-4 overflow-hidden">
                    <div class="card-body h-150 position-relative">
                        <div class="top-right m-2">
                            <button class="btn btn-sm btn-light btn-rounded btn-40 rounded-circle"><i class="material-icons mt-0 vm">favorite_border</i></button>
                        </div>
                        <div class="bottom-left m-2">
                            <button class="btn btn-sm btn-default rounded">New</button>
                        </div>
                        <a href="product.html" class="background">
                            <img src="{{asset('mobile/media/telefon.png')}}" alt="">
                        </a>
                    </div>
                    <div class="card-body ">
                        <p class="mb-0"><small class="text-secondary">Rockstar</small></p>
                        <a href="product.html">
                            <p class="mb-0">Men Jacket brown</p>
                        </a>
                        <h5 class="mb-0">$ 39.99</h5>
                    </div>
                </div>
            </div>
            <div class="col-6 col-md-4 col-lg-3">
                <div class="card border-0 mb-4 overflow-hidden">
                    <div class="card-body h-150 position-relative">
                        <div class="top-right m-2">
                            <button class="btn btn-sm btn-light btn-rounded btn-40 rounded-circle text-danger"><i class="material-icons mt-0 vm ">favorite</i></button>
                        </div>
                        <div class="bottom-left m-2">
                            <button class="btn btn-sm btn-default rounded">New</button>
                        </div>
                        <figure class="background">
                            <img src="{{asset('mobile/media/mikropech.png')}}" alt="">
                        </figure>
                    </div>
                    <div class="card-body ">
                        <p class="mb-0"><small class="text-secondary">Adididas</small></p>
                        <a href="product.html">
                            <p class="mb-0">Women Jacket</p>
                        </a>
                        <h5 class="mb-0">$ 49.99</h5>
                    </div>
                </div>
            </div>
            <div class="col-6 col-md-4 col-lg-3">
                <div class="card border-0 mb-4 overflow-hidden">
                    <div class="card-body h-150 position-relative">
                        <div class="top-right m-2">
                            <button class="btn btn-sm btn-light btn-rounded btn-40 rounded-circle text-danger"><i class="material-icons mt-0 vm">favorite</i></button>
                        </div>
                        <div class="bottom-left m-2">
                            <button class="btn btn-sm btn-default rounded">New</button>
                        </div>
                        <figure class="background">
                            <img src="{{asset('mobile/media/televizor.png')}}" alt="">
                        </figure>
                    </div>
                    <div class="card-body ">
                        <p class="mb-0"><small class="text-secondary">Rockstar</small></p>
                        <a href="product.html">
                            <p class="mb-0">Shorts Uunisex</p>
                        </a>
                        <h5 class="mb-0">$ 28.99</h5>
                    </div>
                </div>
            </div>
            <div class="col-6 col-md-4 col-lg-3">
                <div class="card border-0 mb-4 overflow-hidden">
                    <div class="card-body h-150 position-relative">
                        <div class="top-right m-2">
                            <button class="btn btn-sm btn-light btn-rounded btn-40 rounded-circle"><i class="material-icons mt-0 vm ">favorite_border</i></button>
                        </div>
                        <div class="bottom-left m-2">
                            <button class="btn btn-sm btn-default rounded">New</button>
                        </div>
                        <figure class="background">
                            <img src="{{asset('mobile/media/plesons.png')}}" alt="">
                        </figure>
                    </div>
                    <div class="card-body ">
                        <p class="mb-0"><small class="text-secondary">Mansheri</small></p>
                        <a href="product.html">
                            <p class="mb-0">Women Jacket</p>
                        </a>
                        <h5 class="mb-0">$ 35.99</h5>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection
