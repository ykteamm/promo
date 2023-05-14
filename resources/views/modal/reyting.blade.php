<div class="modal fade" id="reyting" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                    <img src="{{asset('mobile/reyting.png')}}" width="111%" style="border-radius:15px;margin-left: -20px;margin-top:-18px;position:relative">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="opacity: 5;position:absolute;top:8px;right:10px;">
                        <img src="{{asset('mobile/xclose.png')}}" width="30px">
                    </button>
            </div>
            <div class="modal-body p-0">

            <div class="container p-0">
                <div class="mb-3 pt-3">
                    @foreach (getReyting() as $key => $item)
                    @php
                        if ($key == 0) { $color = 'e0aa2c'; }
                        if ($key ==1) { $color = 'bdccdb'; }
                        if ($key == 2) { $color = 'cc8448'; }
                        if (!in_array($key,[0,1,2])) { $color = '8d9eb8'; }
                    @endphp
                        <div class="col-12 col-md-6 supercell">
                            <div class="card border-0 mb-1">
                                <div class="card-body" class="pr-0" style="background: #c8d7ec;border-radius:15px;">
                                    <div class="row align-items-center">
                                        <div class="col-2">
                                            <button type="button" class="btn btn-sm btn-secondary supercell" style="background: #{{$color}};box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);">
                                                {{$key+1}}
                                            </button>
                                        </div>
                                        <div class="col-4 pr-0">
                                            <span class="mb-1" style="color: #272730;font-size:12px">{{$item->user->first_name}} {{substr($item->user->last_name,0,1)}}</span>
                                            {{-- <p style="color: #272730;font-size:10px;color:#6c757d;">
                                                {{setRegionTosh($item->t)}}
                                            </p> --}}
                                        </div>
                                        <div class="col-2 pl-0 pr-1 text-right">
                                            <img src="{{asset('mobile/oltin.png')}}" width="23px;">
                                        </div>
                                        <div class="col-4 pl-0 pr-0">
                                            <button type="button" class="btn btn-sm btn-secondary supercell" style="background: #6b829ee0;box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);">
                                               <span style="font-size:11px;">{{number_format($item->allmoney,0,',',' ')}}</span>
                                            </button>
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
</div>
