<div class="swiper-slide overflow-hidden text-center">
    @if ($active_order)
    <div class="container mb-1 p-0">
        <div class="row">
            <div class="col-12 col-md-6">
                <div class="card mb-4">

                    @php
                        $quantity = 0;
                        $sold = 0;
                        foreach ($active_order->orderProduct as $ord) {
                            $quantity += $ord->quantity;
                            foreach ($ord->product->orderStock as $stock) {
                                if($ord->order_id == $stock->order_id)
                                {
                                    $sold += $stock->quantity;
                                }
                            }
                        }
                    @endphp
                    <div class="card-body" data-toggle="modal" data-target="#rmorder{{$active_order->id}}">
                        <div class="row">
                            <div class="col text-left">
                                <h5 class="mb-1" style="color:#272730;"> Buyurtma #{{$active_order->number}} </h5>
                            </div>
                            <div class="col-auto pl-0">
                                <h5 class="mb-1" style="color:#272730;"> {{number_format($quantity,0,',',' ')}} dona</h5>

                            </div>
                        </div>
                        @php
                            $foiz = round($sold/$quantity*100,1);
                        @endphp
                        <div class="progress mt-3" style="height:20px;">
                            <div class="progress-bar"  role="progressbar" style="width:{{$foiz}}%;background:#1f92da;" aria-valuenow="{{$foiz}}" aria-valuemin="0" aria-valuemax="100">
                                {{$foiz}}%
                            </div>
                        </div>
                        <div class="mt-3"> <span style="color:#272730;background: #50f074;border-radius: 8px;padding: 4px 16px;">Sotuv {{$sold}}/{{$quantity}}</span> </div>
                        @if ($qarz)

                        @foreach ($qarz as $q)
                            @php
                                $quantity = 0;
                                $sold = 0;
                                foreach ($q->orderProduct as $ord) {
                                    $quantity += $ord->quantity;
                                    foreach ($ord->product->orderStock as $stock) {
                                        if($ord->order_id == $stock->order_id)
                                        {
                                            $sold += $stock->quantity;
                                        }
                                    }
                                }
                            @endphp
                            <div class="col-12 text-left mt-1" style="color:#272730">
                                <span>Qarzdorlik  {{number_format(($quantity-$sold),0,',',' ')}} dona --- Buyurtma #{{$q->number}} </span>
                            </div>
                        @endforeach
                    @endif
                    </div>

                </div>
            </div>
        </div>
    </div>
    @else
    <div class="container mb-1 p-0">
        <div class="row">
            <div class="col-12 col-md-6">
                <div class="card mb-4">
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <h5 class="mb-1" style="color:#272730;"> Sizda faol buyurtmalar yo'q </h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif
    @if ($my_battle)
    <div class="container-fluid text-center mb-2 mt-1 pl-0 pd-0 img-container">
        <img class="responsive-img" src="{{ asset('mobile/jang3.webp') }}">
        <div class="user-image1">
            <div class="for-avatar avatar avatar-140 rounded-circle mx-auto"
                style="width: 130px;height:130px;">
                <div class="background">
                    <img src="https://api.multiavatar.com/kathrin.svg" height="10px" alt="">
                </div>
            </div>

            <div class="text-dark mt-1 supercell text-font for-name">
                @if (Auth::user()->id == $my_battle->u1ids->id)
                    {{ $my_battle->u1ids->first_name }}
                    {{ substr($my_battle->u1ids->last_name, 0, 1) }}
                @else
                    {{ $my_battle->u2ids->first_name }}
                    {{ substr($my_battle->u2ids->last_name, 0, 1) }}
                @endif
            </div>
        </div>
        <div class="user-image2">
            <div class="for-avatar avatar avatar-140 rounded-circle mx-auto"
                style="width: 130px;height:130px;">
                <div class="background">
                    <img src="https://api.multiavatar.com/kathrin.svg" height="10px" alt="">
                </div>
            </div>
            <div class="text-dark mt-1 supercell text-font for-name">
                @if (Auth::user()->id != $my_battle->u1ids->id)
                    {{ $my_battle->u1ids->first_name }}
                    {{ substr($my_battle->u1ids->last_name, 0, 1) }}
                @else
                    {{ $my_battle->u2ids->first_name }}
                    {{ substr($my_battle->u2ids->last_name, 0, 1) }}
                @endif
            </div>
        </div>
        <div class="battle_date supercell">
            {{-- <span>{{ $my_battle[0]->day + 1 }} / {{ $my_battle[0]->days }}</span> --}}
            <span>
                {{ date_diff(date_create(date('Y-m-d')), date_create(date('Y-m-d', strtotime($my_battle->start_day))))->format('%a') }}
            </span>
            <p>KUN</p>
        </div>
        <div class="bugun1 img-container first_one" onclick="changeDay(0)">
            <img src="{{ asset('mobile/bugun.webp') }}" width="140px" alt="">
        </div>
        <div class="bugun1 img-container first_two d-none" onclick="changeDay(1)">
            <img src="{{ asset('mobile/bugun.webp') }}" width="140px" alt="">
        </div>
        <div class="bugun_date1 supercell first_one" onclick="changeDay(0)">
            <span>Bugun</span>
        </div>
        <div class="bugun_date1 supercell first_two d-none" onclick="changeDay(1)">
            <span>{{ date_diff(date_create(date('Y-m-d')), date_create(date('Y-m-d', strtotime($my_battle->start_day))))->format('%a') }}
                kun</span>
        </div>
        @php
            if(Auth::user()->id == $my_battle->u1ids->id)
            {
                $summa1 = getMoneyUser($my_battle->start_day,$my_battle->start_day,$my_battle->u1id);
                $summa_all1 = getMoneyUser($my_battle->start_day,$my_battle->end_day,$my_battle->u1id);
                $bonus1 = getMoneyUserBonus($my_battle->start_day,$my_battle->end_day,$my_battle->u1id,$my_battle->u2id);

            }else{
                $summa1 = getMoneyUser($my_battle->start_day,$my_battle->start_day,$my_battle->u2id);
                $summa_all1 = getMoneyUser($my_battle->start_day,$my_battle->end_day,$my_battle->u2id);
                $bonus1 = getMoneyUserBonus($my_battle->start_day,$my_battle->end_day,$my_battle->u2id,$my_battle->u1id);
            }

            if(Auth::user()->id != $my_battle->u1ids->id)
            {
                $summa2 = getMoneyUser($my_battle->start_day,$my_battle->start_day,$my_battle->u1id);
                $summa_all2 = getMoneyUser($my_battle->start_day,$my_battle->end_day,$my_battle->u1id);
                $bonus2 = getMoneyUserBonus($my_battle->start_day,$my_battle->end_day,$my_battle->u1id,$my_battle->u2id);
            }else{
                $summa2 = getMoneyUser($my_battle->start_day,$my_battle->start_day,$my_battle->u2id);
                $summa_all2 = getMoneyUser($my_battle->start_day,$my_battle->end_day,$my_battle->u2id);
                $bonus2 = getMoneyUserBonus($my_battle->start_day,$my_battle->end_day,$my_battle->u2id,$my_battle->u1id);
            }

            $bonus_pro = ($summa_all1 + $summa_all2)*0.6*0.1;

        @endphp
        <div class="bugun_price1 supercell first_one" style="font-size: 13px;"
            onclick="changeDay(0)">
                {{ number_format($summa1, 0, ',', ' ') }}
        </div>
        <div class="bugun_price1 supercell first_two d-none" onclick="changeDay(1)" style="font-size: 13px;">
                {{ number_format($summa_all1, 0, ',', ' ') }}
        </div>

        <div class="bugun2 img-container first_one" onclick="changeDay(0)">
            <img src="{{ asset('mobile/bugun.webp') }}" width="140px" alt="">
        </div>
        <div class="bugun2 img-container first_two" onclick="changeDay(1)">
            <img src="{{ asset('mobile/bugun.webp') }}" width="140px" alt="">
        </div>
        <div class="bugun_date2 supercell first_one" onclick="changeDay(0)">
            <span>Bugun</span>
        </div>
        <div class="bugun_date2 supercell first_two d-none" onclick="changeDay(1)">
            <span>{{ date_diff(date_create(date('Y-m-d')), date_create(date('Y-m-d', strtotime($my_battle->start_day))))->format('%a') }}
                kun</span>
        </div>
        <div class="bugun_price2 supercell first_one" style="font-size: 13px;"
            onclick="changeDay(0)">
            {{ number_format($summa2, 0, ',', ' ') }}
        </div>
        <div class="bugun_price2 supercell first_two d-none" style="font-size: 13px;"
            onclick="changeDay(1)">
            {{ number_format($summa_all2, 0, ',', ' ') }}
        </div>
        <div class="container mt-5 natija-img">
            <img src="{{ asset('mobile/natija.webp') }}" width="190px" alt="">

                <div class="bonus_pro supercell" style="border-radius:5px;padding: 2px 2px;">

                    {{number_format(floor($bonus1/1000),0,',',' ')}}

                </div>
        </div>

    </div>

    @else
    <div class="container-fluid text-center mb-2 mt-3 pl-0 pd-0 img-container">
        {{-- <img class="responsive-img" src="{{asset('mobile/jang3.webp')}}"> --}}
        <div class="">
            <div class="for-avatar avatar avatar-140 rounded-circle mx-auto"
                style="width: 130px;height:130px;">
                <div class="background">
                    <img src="https://api.multiavatar.com/kathrin.svg" height="100px" alt="">
                </div>
            </div>
            <div class="text-white mt-1 supercell text-font for-name">
                {{ Auth::user()->first_name }} {{ Auth::user()->last_name }}
            </div>
        </div>
    </div>
    @endif
    <div class="container pl-0 pr-0 reyting-user">
        <div class="row">
            <div class="col-6 pl-3 pr-0">

                <button type="button" class="btn pr-0" data-toggle="modal"
                    data-target="#reyting">
                    <img src="{{ asset('mobile/reyting.webp') }}" class="for-media-img"
                        width="160px" alt="">
                </button>
            </div>
            <div class="col-6 pl-0 pr-4">

                {{-- <button type="button" class="btn pl-0" data-toggle="modal" data-target="#bonus">
                    <img src="{{ asset('mobile/market2233.png') }}" class="for-media-img" width="160px"
                    style="box-shadow: 0px 0px 11px 7px #32d345;border-radius: 12px;animation: btn 2s linear infinite;"
                        alt="">
                </button> --}}
                <button type="button" class="btn btn-primary mt-2 supercell" data-toggle="modal"
                    data-target="#bonus"
                    style="box-shadow: 0px 0px 11px 7px #a5da6e;border-radius: 12px;
                    animation: btn 2s linear infinite;margin-top:11px !important;background:#ffbb2c;"
                    >
                    <span style="-webkit-text-stroke: 1px black;color:white;font-s">MARKET</span>
                </button>
            </div>
        </div>

    </div>



</div>

