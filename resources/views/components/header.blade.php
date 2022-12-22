<header class="header">
    <div class="row">
        <div class="text-left col align-self-center">
            {{-- <button class="menu-btn btn btn-40 btn-link" type="button">
                <span class="material-icons">menu</span>
            </button> --}}
            Promo
        </div>
        <div class="col">
            {{-- <a class="navbar-brand" href="#">
                <h5 class="mb-0">Finwallapp</h5>
            </a> --}}
            {{-- <div > --}}
                <a href="profile.html" class="avatar avatar-30 shadow-sm rounded-circle ml-2">
                    <figure class="m-0 background">
                        <img src="{{asset('promo/dist/img/promo/oltin3.png')}}" alt="">
                    </figure>
                </a>
            <div class="progress mb-3">
                <div class="progress-bar bg-success" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
            
            </div>
            
            {{-- </div> --}}
            

        </div>
        <div class="text-left col align-self-center">
            <div>

                <div class="progress mb-3">
                    <div class="progress-bar bg-success" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                    {{-- <img src="{{asset('promo/dist/img/promo/oltin3.png')}}" height="40px" alt="User Avatar"> --}}
                
                </div>
                <a href="profile.html" class="avatar avatar-30 shadow-sm rounded-circle ml-2">
                    <figure class="m-0 background">
                        <img src="{{asset('promo/dist/img/promo/eleksir3.png')}}" alt="">
                    </figure>
                </a>
                </div>
        </div>
    </div>
    <div class="@if(Route::current()->getName() != 'order') d-none @endif">
    <div class="container mb-4 text-white">
        <div class="row my-3 h6 font-weight-normal">
            <div class="col">Sub total</div>
            <div class="col text-right text-mute">$ 109.97</div>
        </div>
        <div class="row my-3 h6 font-weight-normal">
            <div class="col">Discount</div>
            <div class="col text-right text-mute">-$ 10.99</div>
        </div>
        <hr>
    </div>
    <div class="container">
        <a href="checkout.html" class="btn btn-default btn-block rounded">Checkout</a>
    </div>
    </div>
</header>