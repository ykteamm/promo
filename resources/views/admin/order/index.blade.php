@extends('admin.layouts.app')
@section('admin')
 

<div class="main-container">
    <div class="container">
        <div class="accordion" id="accordionExample">
            @foreach ($users as $user)
            <div class="card">
                <div class="card-header" id="headingThree">
                    <h2 class="mb-0">
                        <button class="btn btn-block text-left px-0 collapsed" type="button" data-toggle="collapse" data-target="#collapseThree{{$user->id}}" aria-expanded="false" aria-controls="collapseThree">
                            {{$user->last_name}} {{$user->first_name}}
                        </button>
                    </h2>
                </div>
                <div id="collapseThree{{$user->id}}" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
                    <div class="card-body">
                        {{-- <div class="card-header border-0 bg-none">
                                <div class="row">
                                    <div class="col align-self-center">
                                        <h6 class="mb-0">Table Responsive</h6>
                                    </div>
                                    <div class="col-auto align-self-center">
                                        <button class="btn btn-default btn-sm rounded">
                                            Export
                                        </button>
                                    </div>
                                </div>
                        </div> --}}
                        @foreach ($user->order as $key => $order)
                        <div class="accordion" id="accordionExampleOrder">
                        <div class="card">
                        <div class="card-header" id="headingThreeOrder">
                            {{-- <h2 class="mb-0">
                                <button class="btn btn-block text-left px-0 collapsed" type="button" data-toggle="collapse" data-target="#collapseThreeOrder{{$order->id}}" aria-expanded="false" aria-controls="collapseThree">
                                    #order{{$order->sort}}
                                </button>
                            </h2> --}}
                            <div class="row">
                                <div class="col">
                                    <button class="btn btn-block text-left px-0 collapsed" type="button" data-toggle="collapse" data-target="#collapseThreeOrder{{$order->id}}" aria-expanded="false" aria-controls="collapseThree">
                                        #order{{$order->sort}}
                                    </button>

                                </div>
                                <div class="col-auto pl-0">
                                    <div class="btn-group mr-2" role="group" aria-label="Second group">
                                        @if($order->delivery == 0)
                                            <form action="{{route('delivery',['id' => $order->id])}}" method="POST">
                                                @csrf
                                                <button type="submit" class="btn btn-outline-danger">
                                                    <i class="fa-regular fa-truck"></i>
                                                </button>
                                            </form>
                                        @else
                                            <button type="button" class="btn btn-outline-primary">
                                                <i class="fa-regular fa-truck"></i>
                                            </button>
                                        @endif
                                        @if($order->cashback == 0)
                                            <form action="{{route('cashback',['id' => $order->id])}}" method="POST">
                                                @csrf
                                                <button type="submit" class="btn btn-outline-danger">
                                                    <i class="fa-solid fa-sack-dollar"></i>
                                                </button>
                                            </form>
                                        @else
                                                <button type="button" class="btn btn-outline-primary">
                                                    <i class="fa-solid fa-sack-dollar"></i>
                                                </button>
                                        @endif
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="collapseThreeOrder{{$order->id}}" class="collapse" aria-labelledby="headingThreeOrder" data-parent="#accordionExampleOrder">
                            <div class="card-body">
                                <div class="card-body p-0">
                                        <div class="table-responsive">
                                            <table class="table table-striped">
                                                <thead>
                                                    <tr>
                                                        <th scope="col">#</th>
                                                        <th scope="col">Mahsulot</th>
                                                        <th scope="col">Soni</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($order->orderProduct as $k => $orp)
                                                    <tr>
                                                        <th scope="row">{{$k+1}}</th>
                                                        <th scope="row">{{$orp->product->name}}</th>
                                                        <th scope="row">{{$orp->stock}}</th>
                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                </div>
        
                            </div>
                        </div>
                        </div>
                        </div>
                        @endforeach

                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
