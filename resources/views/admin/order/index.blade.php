@extends('admin.layouts.app')
@section('admin')
 

<div class="main-container">
    <div class="container">
        <div class="accordion" id="accordionExample">
            @foreach ($users as $item)
            <div class="card">
                <div class="card-header" id="headingThree">
                    <h2 class="mb-0">
                        <button class="btn btn-block text-left px-0 collapsed" type="button" data-toggle="collapse" data-target="#collapseThree{{$item->id}}" aria-expanded="false" aria-controls="collapseThree">
                            {{$item->last_name}} {{$item->first_name}}
                        </button>
                    </h2>
                </div>
                <div id="collapseThree{{$item->id}}" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
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
                        <div class="card-body p-0">
                                <div class="table-responsive">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th scope="col">#</th>
                                                <th scope="col">Mahsulot</th>
                                                <th scope="col">Soni</th>
                                                <th scope="col">Harakat</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($orders as $key => $order)
                                                @if ($order->user_id == $item->id)
                                                    <tr>
                                                        <th scope="row">{{$key+1}}</th>
                                                        <th scope="row">{{$order->product->name}}</th>
                                                        <th scope="row">{{$order->stock}}</th>
                                                        <th scope="row">
                                                            <div class="btn-group mr-2" role="group" aria-label="First group">
                                                                <button type="button" class="btn btn-outline-secondary"><i class="fas fa-user"></i></button>
                                                                <button type="button" class="btn btn-secondary">2</button>
                                                            </div>
                                                        </th>
                                                    </tr>
                                                @endif
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
