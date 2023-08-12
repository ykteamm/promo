<div class="modal fade" id="history-crystal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-sm modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-body p-0">
                <div class="container">
                    <img src="{{asset('mobile/kh.png')}}" width="111%" style="border-radius:15px;margin-left: -20px;margin-top:-5px;position:relative">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="opacity: 5;position:absolute;top:6px;right:10px;">
                        <img src="{{asset('mobile/xclose.png')}}" width="30px">
                    </button>
                </div>
                <div class="card mb-3 mt-3">
                        @foreach ($crystalhistory as $item)
                                <div class="col-12 ">
                                    <div class="card border-0 mb-1">
                                        <div class="card-body" class="pr-0" style="background: #c8d7ec;border-radius:15px;">
                                            <div class="row align-items-center supercell" style="font-size:13px;">
                                                <div class="col pr-0">
                                                    + {{$item->crystal}}                                                            
                                                </div>
                                                <div class="col-auto text-right">
                                                        <span class="mb-1 text-primary">
                                                        {{$item->comment}}
                                                        </span>
                                                </div>
                                                
                                            </div>
                                        </div>
                                    </div>
                                </div>
                        @endforeach
                </div>
            </div>
        </div>
    </div>
</div>