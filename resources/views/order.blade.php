@extends('layouts.app')
@section('content')
    
<div class="main-container overflow-auto product-margin">

    <div class="container bg-default-light mb-4 py-3 overflow-auto" >
        
        <div class="row">
            <form action="{{route('order.store')}}" method="POST" style="display: flex !important;" id="myForm">
                @csrf
            @foreach ($products as $item)
            
            <div class="col-6 col-md-4 col-lg-3">
                <div class="card border-0 mb-4 overflow-hidden">
                    <div class="card-body h-150 position-relative">
                        <div class="bottom-left m-2">
                            <button type="button" class="btn btn-sm btn-default rounded">Bonus: <span class="product-bonus{{$item->id}}">{{$item->bonus}}</span></button>
                        </div>
                        <figure class="background">
                            <img src="{{asset('images/'.$item->image)}}" alt="">
                        </figure>
                    </div>
                    <div class="card-body ">
                        {{-- <p class="mb-0"><small class="text-secondary">Rockstar</small></p> --}}
                        <a href="product.html">
                            <p class="mb-0">{{$item->name}} {{Session::get('user')->id}}</p>
                        </a>
                        <a href="product.html">
                            <p class="mb-0"><span class="product-price{{$item->id}}">{{$item->price}}</span></p>
                        </a>
                        <div class="container">

                        <div class="btn-group mb-2" role="group" aria-label="Basic example">
                            <button type="button" onclick="minus({{$item->id}})" class="btn btn-sm btn-danger">-</button>
                            <input type="number" name="{{$item->id}}" value="0" class="form-control product{{$item->id}}" style="border-radius: 0px;">

                            {{-- <button type="button" class="product{{$item->id}} btn btn-sm btn-secondary">0</button> --}}
                            <button type="button" onclick="plus({{$item->id}})" class="btn btn-sm btn-primary">+</button>
                        </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </form>


        </div>

    </div>
</div>
@endsection
@section('scripts')
<script>
    $(document).ready(function(){
        $("#submitBtn").click(function(){        
            $("#myForm").submit(); // Submit the form
        });
    });
    function minus($id)
    {
        var stock = parseInt($(`.product${$id}`).val());
        if(stock != 0)
        {
            $(`.product${$id}`).val(stock-1);
            var price = parseInt($(`.product-price${$id}`).text());
            var bonus = parseInt($(`.product-bonus${$id}`).text());
            var orderPrice = parseInt($('.summa-header').text());
            var orderBonus = parseInt($('.bonus-header').text());
            $('.order-header').css('display','');
            $('.summa-header').text(orderPrice-price);
            $('.bonus-header').text(orderBonus-bonus);
            var orderPrice = parseInt($('.summa-header').text());
            if(orderPrice == 0)
            {
                $('.order-header').css('display','none');
                $('.product-margin').css('margin-top','0%');
            }
        }
        
    }
    function plus($id)
    {
        var stock = parseInt($(`.product${$id}`).val());
        $(`.product${$id}`).val(stock+1);
        var price = parseInt($(`.product-price${$id}`).text());
        var bonus = parseInt($(`.product-bonus${$id}`).text());
        var orderPrice = parseInt($('.summa-header').text());
        var orderBonus = parseInt($('.bonus-header').text());
        $('.order-header').css('display','');
        $('.product-margin').css('margin-top','35%');
        $('.summa-header').text(price+orderPrice);
        $('.bonus-header').text(bonus+orderBonus);
    }
</script>
@endsection

