    @foreach ($orders as $key => $item)
        <div class="modal fade" id="rmorder{{$item->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body p-0">
                        <div class="container p-0">
                            <div class="container">
                                <h3>Buyurtma #{{$item->number}}</h3>
                            </div>
                            <table class="table">
                                <thead class="thead-light">
                                <tr>
                                    <th scope="col">Dori</th>
                                    <th scope="col">Soni</th>
                                    <th scope="col">Sotildi</th>
                                </tr>
                                </thead>
                                <tbody>
                                    @foreach ($item->orderproduct as $ord)
                                        <tr>
                                            <td>{{$ord->product->name}}</td>
                                            <td>{{$ord->quantity}}</td>
                                            @php
                                                $sum = 0;
                                                        foreach ($ord->product->orderStock as $stock)
                                                        {
                                                            if ($ord->order_id == $stock->order_id)
                                                            {
                                                                $sum += $stock->quantity;
                                                            }
                                                        }

                                            @endphp

                                            <td>
                                                {{$sum}}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
