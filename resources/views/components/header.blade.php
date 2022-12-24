<header class="header">
    <div class="row" style="flex-wrap: inherit">
        <div class="col-md-2" style="width: 30%;">
            PROMO
        </div>
        <div class="col-md-4">
            <div class="input-group">
                <input type="text" value="{{Auth::user()->account}}" class="form-control" disabled style="border-top-right-radius: 18px !important;border-bottom-right-radius: 18px !important;height: calc(1.5em + 0.75rem + -6px);">
                <div class="input-group-append">
                    <button class="btn" type="button" style="padding: 0px 0px;">
                        <img src="{{asset('promo/dist/img/promo/oltin3.png')}}" width="30px" alt="">
                    </button>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="input-group">
                <input type="text" value="{{Auth::user()->cashback}}" class="form-control" disabled style="border-top-right-radius: 18px !important;border-bottom-right-radius: 18px !important;height: calc(1.5em + 0.75rem + -6px);">
                <div class="input-group-append">
                    <button class="btn" type="button" style="padding: 0px 0px;">
                        <img src="{{asset('promo/dist/img/promo/eleksir3.png')}}" width="30px" alt="">
                    </button>
                </div>
            </div>
        </div>
    </div>
    {{-- <div class="@if(Route::current()->getName() != 'order') d-none @endif"> --}}
    <div class="order-header" style="display:none;">
    <div class="container mb-4 text-white">
        <div class="row my-3 h6 font-weight-normal">
            <div class="col">Buyurtma summasi</div>
            <div class="col text-right text-mute"><span class="summa-header">0</span></div>
        </div>
        <div class="row my-3 h6 font-weight-normal">
            <div class="col">Bonus</div>
            <div class="col text-right text-mute"><span class="bonus-header">0</span></div>
        </div>
        <hr>
    </div>
    <div class="container">
        <button type="button" id="submitBtn" class="btn btn-default btn-block rounded">Buyurtma berish</button>
    </div>
    </div>
</header>