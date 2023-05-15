<div class="modal fade " id="bonus" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-sm modal-dialog-centered" role="document">
        <div class="modal-content bg-transparent d-flex justify-content-center align-items-center">
            <div style="width: 390px;position:relative">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"
                    style="position:absolute;top:8px;right:10px;opacity:5">
                    <img src="{{ asset('mobile/xclose.png') }}" width="30px">
                </button>
                <div style="position:absolute;top:126px;left:79px;width:89px;height:29px;border-radius:10px" class="d-flex align-items-center justify-content-center">
                    <span style="font-weight: 600;color:#fff;font-size:16px" class="supercell">
                        {{ number_format(1250, 0, ',', ' ') }}
                    </span>
                </div>
                <img src="{{ asset('mobile/market/marketmain.png') }}" width="100%" alt="Image Market">
                <div style="position: absolute;top:187px;left:0;right:0;bottom:15px;width:100%;overflow:scroll;">

                    @foreach ($markets as $key => $item)
                        {{-- href="{{route('shop',$item->id)}}"  --}}
                        <a class="d-flex justify-content-center align-items-center">
                            <div style="position:relative;width:95%;padding-right:7px;padding-left:1px">
                                <img class="mb-1" width="100%" src="{{ asset('mobile/market/m.png') }}"
                                    alt="Image">
                                <div style="position:absolute;top:0;left:0;right:0;bottom:0;">
                                    <div
                                        style="position: absolute;left:21px;top:35px;width:110px;height:110px;overflow:hidden;border-radius:10px">
                                        <div class="d-flex align-items-center justify-content-center"
                                            style="width:100%;height:100%">
                                            <img width="100%" src="https://jang.novatio.uz/outermarket/{{ $item->image}} ">
                                        </div>
                                    </div>
                                    <div
                                        style="position: absolute;right:28px;top:38px;width:204px;height:28px;overflow:hidden;text-align:center;border-radius:5px">
                                        <span style="font-weight: 600;color:#fff;font-size:13px"
                                            class="supercell">{{ $item->name}}</span>
                                    </div>
                                    <div class="d-flex align-items-center justify-content-center"
                                        style="position: absolute;right:69px;top:81px;width:78px;height:45px;overflow:hidden;text-align:center;border-radius:5px">
                                        <span style="font-weight: 600;color:#fff;font-size:16px" class="supercell">
                                            {{ number_format($item->crystall, 0, ',', ' ') }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
