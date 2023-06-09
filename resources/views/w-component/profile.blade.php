<div class="swiper-slide overflow-hidden text-center">
    <div class="container p-0">
                    <div class="mb-3 pt-3">
                        @foreach ($orders as $key => $item)
                        <div class="col-12 col-md-6">
                            <div class="card border-0 mb-4">
                                <div class="card-body">
                                    <div class="row align-items-center" data-toggle="modal" data-target="#rmorder{{$item->id}}">
                                        {{-- <div class="col-auto pr-0">
                                            <div class="avatar avatar-50 border-0 bg-default-light rounded-circle text-default">
                                                <i class="material-icons vm text-template">local_atm</i>
                                            </div>
                                        </div> --}}
                                        <div class="col-5 p-0 align-self-center">
                                            <h6 class="mb-1" style="color:#272730;">Buyurtma #{{$item->number}}</h6>
                                            <p class="small text-secondary">{{date('d.m.Y',strtotime($item->created_at))}}</p>
                                        </div>
                                        <div class="col-7 p-0 align-self-center border-left text-center">
                                            <h6 class="mb-1" style="color:#272730;">{{number_format($item->order_price,0,',',' ')}} so'm</h6>
                                            <p class="small text-secondary">
                                                    @if($item->status == 1)
                                                        <span class="badge badge-warning" style="font-size:12px;">
                                                            Buyurtma yuborildi
                                                        </span>
                                                    @elseif($item->status == 2)
                                                        <span class="badge badge-info" style="font-size:12px;">
                                                            Buyurtma tasdiqlandi
                                                        </span>
                                                    @elseif($item->status == 3)
                                                        <span class="badge badge-primary" style="font-size:12px;">
                                                            Buyurtma yo'lda
                                                        </span>
                                                    @elseif($item->status == 4)
                                                        <span class="badge badge-success" style="font-size:12px;">
                                                            Tasdiqlangan
                                                        </span>
                                                    @else
                                                        <span class="badge badge-danger" style="font-size:12px;">
                                                            Bekor qilindi
                                                        </span>
                                                    @endif
                                            </p>
                                        </div>
                                        @if($item->status == 3)

                                        <div class="col-12 p-0 align-self-center mt-2">
                                            <p style="font-size:12px;color:black;">
                                                Buyurtmani olgan bo'lsangiz tasdiqlang
                                            </p>
                                            <a href="{{route('orderpro.status',['order_id' => $item->id,'status' => 4])}}">
                                                <button type="button" class="btn btn-success">Tasdiqlayman</button>
                                            </a>
                                        </div>
                                        @endif

                                    </div>
                                </div>
                            </div>
                        </div>

                        @endforeach
                    </div>
                </div>
</div>


