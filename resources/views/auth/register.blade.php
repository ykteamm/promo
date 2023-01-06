@extends('layouts.login')
@section('login')
<div class="reg-fio">
    <main class="flex-shrink-0 main has-footer">
        <header class="header" style="background: none;">
            <div class="row">
                <div class="text-left col align-self-center">
                   
                </div>
                <div class="ml-auto col-auto align-self-center">
                    <a href="{{route('login')}}" class="text-white">
                        Login
                    </a>
                </div>
            </div>
        </header>
        
        
        <div class="container h-100 text-white" style="margin-top:30%;">
            <div class="row h-100">
                <div class="col-12 align-self-center mb-4">
                    <div class="row justify-content-center">
                        <div class="col-11 col-sm-7 col-md-6 col-lg-5 col-xl-4">
                            <h2 class="font-weight-normal mb-5 text-center">Ismingiz va familiyangizni kiriting</h2>
                            <div class="form-group float-label @if(Session::get('first_name')) active @else position-relative @endif">
                                <input type="text" class="form-control text-white" name="first_name" value="@if(Session::get('first_name')) {{Session::get('first_name')}} @endif">
                                <label class="form-control-label text-white">Ismingiz</label>
                            </div>
                            <div class="form-group float-label @if(Session::get('last_name')) active @else position-relative @endif">
                                <input type="text" class="form-control text-white" name="last_name" value="@if(Session::get('last_name')) {{Session::get('last_name')}} @endif">
                                <label class="form-control-label text-white">Familiyangiz</label>
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
    </main>
    <div class="footer no-bg-shadow py-3">
        <div class="row justify-content-center">
            <div class="col">
                <button type="submit" onclick="nameEtap()" class="btn btn-default rounded btn-block">Keyingisi</button>
            </div>
        </div>
    </div>
</div>
<div class="reg-birth d-none">
    <main class="flex-shrink-0 main has-footer">
        <header class="header" style="background: none;">
            <div class="row">
                <div class="ml-auto col-auto align-self-center">
                    <a href="{{route('login')}}" class="text-white">
                        <button type="button" class="btn btn-default rounded btn-block">Login</button>
                    </a>
                </div>
            </div>
        </header>
        
        
        <div class="container h-100 text-white" style="margin-top:30%;">
            <div class="row h-100">
                <div class="col-12 align-self-center mb-4">
                    <div class="row justify-content-center">
                        <div class="col-11 col-sm-7 col-md-6 col-lg-5 col-xl-4">
                            <h2 class="font-weight-normal mb-5 text-center">Tug'ilgan sanangizni tanlang</h2>
                            <div class="row">
                                <div class="col-lg-4 col-4 text-center">
                                    <div class="form-group">
                                    <label>Yil</label>
                                    <select class="form-control select2" style="width: 100%;" name="year">
                                        @if(!Session::get('year')) 
                                            <option disabled selected hidden></option>
                                        @endif
                                        @for ($i = 2004; $i > 1950; $i--)
                                        @if(Session::get('year') == $i) 
                                            <option selected>{{$i}}</option>
                                        @else
                                            <option>{{$i}}</option>
                                        @endif
                                        @endfor
                                    </select>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-4 text-center">
                                    <div class="form-group">
                                    <label>Oy</label>
                                    <select class="form-control select2" style="width: 100%;" name="month">
                                        <option disabled selected hidden></option>
                                        @for ($i = 1; $i <= 12; $i++)
                                            @if(strlen($i) == 1)
                                            {
                                                @if(Session::get('month') == '0'.$i) 
                                                    <option selected>0{{$i}}</option>
                                                @else
                                                    <option>0{{$i}}</option>
                                                @endif
                                            }
                                            @else
                                                @if(Session::get('month') == $i) 
                                                    <option selected>{{$i}}</option>
                                                @else
                                                    <option>{{$i}}</option>
                                                @endif
                                            @endif
                                        @endfor
                                    </select>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-4 text-center">
                                    <div class="form-group">
                                    <label>Kun</label>
                                    <select class="form-control select2" style="width: 100%;" name="day">
                                        <option disabled selected hidden></option>
                                        @for ($i = 1; $i <= 31; $i++)
                                            @if(strlen($i) == 1)
                                            {
                                                @if(Session::get('day') == '0'.$i) 
                                                    <option selected>0{{$i}}</option>
                                                @else
                                                    <option>0{{$i}}</option>
                                                @endif
                                            }
                                            @else
                                                @if(Session::get('day') == $i) 
                                                    <option selected>{{$i}}</option>
                                                @else
                                                    <option>{{$i}}</option>
                                                @endif
                                            @endif
                                        @endfor
                                    </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
    </main>
    <div class="footer no-bg-shadow py-3">
        <div class="row justify-content-center">
            <div class="col">
                <button type="submit" onclick="dateEtap()" class="btn btn-default rounded btn-block">Keyingisi</button>
                <button type="submit" onclick="lastNameEtap()" class="btn btn-default rounded btn-block">Orqaga</button>
            </div>
        </div>
    </div>
</div>
<div class="reg-phone d-none">
    <main class="flex-shrink-0 main has-footer">
        <header class="header" style="background: none;">
            <div class="row">
                <div class="ml-auto col-auto align-self-center">
                    <a href="{{route('login')}}" class="text-white">
                        <button type="button" class="btn btn-default rounded btn-block">Login</button>
                    </a>
                </div>
            </div>
        </header>
        
        
        <div class="container h-100 text-white" style="margin-top:30%;">
            <div class="row h-100">
                <div class="col-12 align-self-center mb-4">
                    <div class="row justify-content-center">
                        <div class="col-11 col-sm-7 col-md-6 col-lg-5 col-xl-4">
                            <h2 class="font-weight-normal mb-5 text-center">Parol o'ylab toping va telefon raqamingizni kiriting</h2>
                            <div class="form-group float-label position-relative">
                                <input type="password" class="form-control text-white" onfocus="this.removeAttribute('readonly');" readonly name="password">
                                <label class="form-control-label text-white">Parol</label>
                            </div> 
                            <div class="form-group float-label position-relative">
                                <input type="text" class="form-control text-white" data-inputmask='"mask": "(99) 999-99-99"' data-mask name="phone" onfocus="this.removeAttribute('readonly');" readonly>
                                <label class="form-control-label text-white">Telefon raqam</label>
                            </div>
                            <div class="form-group float-label position-relative for-code d-none">
                                <input type="number" class="form-control text-white" onfocus="this.removeAttribute('readonly');" readonly name="code">
                                <label class="form-control-label text-white">Smsdan kelgan kodni kiriting</label>
                            </div> 
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
    </main>
    <div class="footer no-bg-shadow py-3">
        <div class="row justify-content-center">
            <div class="col">
                <button type="submit" onclick="phoneEtap()" class="btn btn-default rounded btn-block for-send-code">Keyingisi</button>
                <button type="submit" onclick="phoneNextEtap()" class="btn btn-default rounded btn-block for-code d-none">Kodni tasdiqlash</button>
                <button type="submit" onclick="lastBirthEtap()" class="btn btn-default rounded btn-block">Orqaga</button>
            </div>
        </div>
    </div>
</div>
<div class="reg-loc d-none">
    <main class="flex-shrink-0 main has-footer">
        <header class="header" style="background: none;">
            <div class="row">
                <div class="ml-auto col-auto align-self-center">
                    <a href="{{route('login')}}" class="text-white">
                        <button type="button" class="btn btn-default rounded btn-block">Login</button>
                    </a>
                </div>
            </div>
        </header>
        
        
        <div class="container h-100 text-white" style="margin-top:30%;">
            <div class="row h-100">
                <div class="col-12 align-self-center mb-4">
                    <div class="row justify-content-center">
                        <div class="col-11 col-sm-7 col-md-6 col-lg-5 col-xl-4">
                            <h2 class="font-weight-normal mb-5 text-center">Dorixonangizni kiriting va joylashuv joyini tanlang</h2>
                            <div class="form-group float-label position-relative">
                                <input type="text" class="form-control text-white" value="@if(Session::get('pharmacy')) {{Session::get('pharmacy')}} @endif" onfocus="this.removeAttribute('readonly');" readonly name="pharmacy">
                                <label class="form-control-label text-white">Dorixonangiz nomi</label>
                            </div>
                            <div class="form-group float-label position-relative">
                                <div class="after-delete-map"></div>
                                <div id="map" style="height: 300px" class="mapping"></div>  
                                <input type="text" name="lat" class="d-none">
                                <input type="text" name="long" class="d-none">  
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
    </main>
    <div class="footer no-bg-shadow py-3">
        <div class="row justify-content-center">
            <div class="col">
                <button type="submit" onclick="locEtap()" class="btn btn-default rounded btn-block">Tugatish</button>
                <button type="submit" onclick="lastPhoneEtap()" class="btn btn-default rounded btn-block">Orqaga</button>
            </div>
        </div>
    </div>
</div>
@endsection
@section('login-scripts')
<script src="{{asset('promo/plugins/inputmask/jquery.inputmask.min.js')}}"></script>

    <script>
        $(function () {
            $('[data-mask]').inputmask()
        });
        function nameEtap()
        {
                var first_name = $("input[name=first_name]").val();
                var last_name = $("input[name=last_name]").val();
                if(first_name.length > 0 && last_name.length > 0)
                {
                    var _token = $('meta[name="csrf-token"]').attr('content');
                    $.ajax({
                        url: "/name-etap",
                        type:"POST",
                        data:{
                            first_name: first_name,
                            last_name: last_name,
                            _token: _token
                        },
                        success:function(response){
                            if(response.status == 200){
                                $('.reg-fio').addClass('d-none');
                                $('.reg-birth').removeClass('d-none');
                            }
                        }
                    });
                }
        }
        function lastNameEtap()
        {
            $('.reg-fio').removeClass('d-none');
            $('.reg-birth').addClass('d-none');
        }
        function lastBirthEtap()
        {
            $('.reg-phone').addClass('d-none');
            $('.reg-birth').removeClass('d-none');
            $('.for-code').addClass('d-none');
            $('.for-send-code').removeClass('d-none');
            $("input[name=password]").val('');

        }
        function lastPhoneEtap()
        {
            $('.reg-phone').removeClass('d-none');
            $('.reg-loc').addClass('d-none');

            $('.for-code').addClass('d-none');
            $('.for-send-code').removeClass('d-none');
        }
        function dateEtap()
        {
            var year = $("select[name=year]").val();
            var month = $("select[name=month]").val();
            var day = $("select[name=day]").val();
            if(year.length > 0 && month.length > 0 && day.length > 0)
            {
                var _token   = $('meta[name="csrf-token"]').attr('content');
                $.ajax({
                        url: "/date-etap",
                        type:"POST",
                        data:{
                            year: year,
                            month: month,
                            day: day,
                            _token: _token
                        },
                        success:function(response){
                            if(response.status == 200){
                                $('.reg-phone').removeClass('d-none');
                                $('.reg-birth').addClass('d-none');
                            }
                            // if(response.code == 200 && response.phone == 200){
                            //     $('.for-kod-etap').addClass('d-none');
                            //     $('.next-etap').removeClass('d-none');
                            // }
                            // if(response.code != 200 && response.phone == 200){
                            //     $('.for-kod-etap').addClass('d-none');
                            //     $('.kod-etap').removeClass('d-none');
                            // }
                            // if(response.code == 200 && response.phone != 200){
                            //     $('.for-kod-etap').addClass('d-none');
                            //     $('.kod-etap').removeClass('d-none');
                            // }
                        }
                });
            }
        }
        function phoneEtap()
        {
            var phone = $("input[name=phone]").val();
            var password = $("input[name=password]").val();
            if(phone.length > 0 && password.length > 4)
            {
                var _token   = $('meta[name="csrf-token"]').attr('content');
                $.ajax({
                        url: "/phone-etap",
                        type:"POST",
                        data:{
                            phone: phone,
                            password: password,
                            _token: _token
                        },
                        success:function(response){
                            if(response.status == 200){
                                $('.for-code').removeClass('d-none');
                                $('.for-send-code').addClass('d-none');
                            }
                            // if(response.status == 505){
                            //     $('.register-user').addClass('d-none');
                            //     $('.user-login').addClass('d-none');
                            //     $('.login-user').removeClass('d-none');
                            //     $('.user-register').removeClass('d-none');
                            //     $('.retape-text').removeClass('d-none');
                            // }
                        }
                });
            }
        }
        function phoneNextEtap()
        {
            var code = $("input[name=code]").val();
            if(code.length > 0)
            {
                var _token   = $('meta[name="csrf-token"]').attr('content');
                $.ajax({
                        url: "/code-etap",
                        type:"POST",
                        data:{
                            code: code,
                            _token: _token
                        },
                        success:function(response){
                            if(response.status == 200){
                                $('.reg-phone').addClass('d-none');
                                $('.reg-loc').removeClass('d-none');
                                geoLocationInit();

                                // $('.retry-etap').addClass('d-none');
                                // $('.done-code-etap').removeClass('d-none');
                                // $('.phone-number').text(response.status.number);

                                // $('.kod-etap').addClass('d-none');
                                // $('.phone-etap').addClass('d-none');
                                // $('.parol-etap').removeClass('d-none');
                                // $('.phone-etap-last').removeClass('d-none');
                                // $('.code-etap-last').addClass('d-none');
                                // $('.date-etap-last').addClass('d-none');

                                // $('.first-phone-text').text('Telefon raqamingiz tasdiqlangan');


                            }
                            // else{
                            //     $('.retry-etap').removeClass('d-none');
                            // }
                        }
                });
            }

        }
        function locEtap()
        {
            var lat = $("input[name=lat]").val();
            var long = $("input[name=long]").val();
            var pharmacy = $("input[name=pharmacy]").val();
            if(lat.length > 0 && long.length > 0 && pharmacy.length > 0)
            {
                var _token   = $('meta[name="csrf-token"]').attr('content');
                $.ajax({
                        url: "/map-etap",
                        type:"POST",
                        data:{
                            lat: lat,
                            long: long,
                            pharmacy: pharmacy,
                            _token: _token
                        },
                        success:function(response){
                            if(response.status == 200)
                            {
                                window.location.href = "{{ route('login')}}";
                            }
                        }
                });
            }
        }
    </script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBhaf1dM31SC1MV8cdYpbY2WlhHEhAFg4s&libraries=places"></script>
    
    
    <script>
        var map;
        var myLatLng;
        function geoLocationInit() {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(success, fail);
            } else {
                alert("Browser not supported");
            }
        }
        function success(position) {
            // console.log(position);
            // var coords = e.get('coords');
            
            var latval = position.coords.latitude;
            var lngval = position.coords.longitude;
            $("input[name=lat]").val(latval);
            $("input[name=long]").val(lngval);
            myLatLng = new google.maps.LatLng(latval, lngval);
            createMap(myLatLng);
        }
        function fail() {
            alert("it fails");
        }
        function createMap(myLatLng) {
            map = new google.maps.Map(document.getElementById('map'), {
                center: myLatLng,
                zoom: 12
            });
            var marker = new google.maps.Marker({
                position: myLatLng,
                map: map
            });
        }
        function createMarker(latlng, icn, name) {
            var marker = new google.maps.Marker({
                position: latlng,
                map: map,
                icon: icn,
                title: name
            });
        }
    </script>
@endsection