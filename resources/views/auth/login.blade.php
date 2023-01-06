@extends('layouts.login')
@section('login')
<div class="main-landing @if(Session::has('user')) d-none @endif">
    <main class="flex-shrink-0 main has-footer pt-2">

        <div class="container h-100">
            <!-- Swiper intro -->
            <div class="swiper-container introduction text-white">
                <div class="swiper-wrapper">
                    <div class="swiper-slide overflow-hidden text-center">
                        <div class="row no-gutters h-100">
                            <div class="col align-self-center px-3">
                                <img src="{{asset('mobile/img/install-app.png')}}" alt="" class="mw-100 my-5">
                                <div class="row">
                                    <div class="container mb-5">
                                        <h4>Amazing Finance template</h4>
                                        <p>Lorem ipsum dolor sit amet, consect etur adipiscing elit. Sndisse conv allis.</p>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="swiper-slide overflow-hidden text-center">
                        <div class="row no-gutters h-100">
                            <div class="col align-self-center px-3">
                                <img src="{{asset('mobile/img/about.png')}}" alt="" class="mw-100 my-5">
                                <div class="row">
                                    <div class="container mb-5">
                                        <h4>Best Wallet app</h4>
                                        <p>Lorem ipsum dolor sit amet, consect etur adipiscing elit. Sndisse conv allis.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide overflow-hidden text-center">
                        <div class="row no-gutters h-100">
                            <div class="col align-self-center px-3">
                                <img src="{{asset('mobile/img/install-app.png')}}" alt="" class="mw-100 my-5">
                                <div class="row">
                                    <div class="container mb-5">
                                        <h4>World Class Design</h4>
                                        <p>Lorem ipsum dolor sit amet, consect etur adipiscing elit. Sndisse conv allis.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Add Pagination -->
                <div class="swiper-pagination"></div>
            </div>
            <!-- Swiper intro ends -->
        </div>
    </main>

    <!-- footer-->
    <div class="footer no-bg-shadow py-3">
        <div class="row justify-content-center">
            <div class="col">
                <button type="button" onclick="login()" class="btn btn-warning rounded btn-block">Login</button>
            </div>
            <div class="col">
                <a href="signup.html" class="btn btn-outline-warning rounded btn-block">Register</a>
            </div>
        </div>
    </div>
</div>
<div class="main-login @if(!Session::has('user')) d-none @endif">
    <form action="{{route('login')}}" method="POST" id="loginForm">
        @csrf
    <main class="flex-shrink-0 main has-footer">
        <!-- Fixed navbar -->
        <header class="header" style="background: none;">
            <div class="row">
                <div class="col-auto px-0">
                    <button onclick="landing()" class="menu-btn btn btn-40 back-btn" type="button">
                        <span class="material-icons">keyboard_arrow_left</span>
                    </button>
                </div>
                <div class="text-left col align-self-center">
                   
                </div>
                <div class="ml-auto col-auto align-self-center">
                    <a href="{{route('register')}}" class="text-white">
                        Registratsiya
                    </a>
                </div>
            </div>
        </header>
        
        
        <div class="container h-100 text-white" style="margin-top:50%;">
            <div class="row h-100">
                <div class="col-12 align-self-center mb-4">
                    <div class="row justify-content-center">
                        <div class="col-11 col-sm-7 col-md-6 col-lg-5 col-xl-4">
                            <h2 class="font-weight-normal mb-5">Profilingizga kiring</h2>
                            <div class="form-group float-label position-relative">
                                <input type="text" class="form-control text-white delete-input" data-inputmask='"mask": "(99) 999-99-99"' data-mask name="phone_number" onfocus="this.removeAttribute('readonly');" readonly>
                                <label class="form-control-label text-white">Telefon raqam</label>
                                <input type="text" class="form-control text-white d-none login-input" name="phone_number">

                            </div>
                            <div class="form-group float-label position-relative">
                                <input type="password" class="form-control text-white" onfocus="this.removeAttribute('readonly');" readonly name="password">
                                <label class="form-control-label text-white">Parol</label>
                            </div>  
                            {{-- <p class="text-right"><a href="forgot_password.html" class="text-white">Forgot Password?</a></p> --}}
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
    </main>

    <!-- footer-->
    <div class="footer no-bg-shadow py-3">
        <div class="row justify-content-center">
            <div class="col">
                <button type="button" onclick="loginEnter()" class="btn btn-default rounded btn-block">Login</button>
            </div>
        </div>
    </div>
    </form>

</div>
@endsection
@section('login-scripts')
<script src="{{asset('promo/plugins/inputmask/jquery.inputmask.min.js')}}"></script>

    <script>
        function loginEnter()
        {
            var suffix = $('.delete-input').val();
            var number = suffix.replace(/[^0-9]/g,'');    
            $('.delete-input').remove();
            $('.login-input').val(number);
            $("#loginForm").submit();
        }
        $(function () {
            $('[data-mask]').inputmask()
        });
        function login()
        {
            $('.main-landing').addClass('d-none');
            $('.main-login').removeClass('d-none');
        }
        function landing()
        {
            $('.main-landing').removeClass('d-none');
            $('.main-login').addClass('d-none');
        }
    </script>
@endsection