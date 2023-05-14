@extends('layouts.login')
@section('login')

<div class="main-login">
    {{-- <form action="{{route('login')}}" method="POST" id="loginForm">
        @csrf
     <main class="flex-shrink-0 main has-footer">


        <div class="container h-100 text-white" style="margin-top:50%;">
            <div class="row h-100">
                <div class="col-12 align-self-center mb-4">
                    <div class="row justify-content-center">
                        <div class="col-11 col-sm-7 col-md-6 col-lg-5 col-xl-4">
                            <h2 class="font-weight-normal mb-5">Profilingizga kiring</h2>
                            <div class="form-group float-label position-relative">
                                <input type="password" class="form-control text-white" onfocus="this.removeAttribute('readonly');" readonly name="password">
                                <label class="form-control-label text-white">Parol</label>
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
                <button type="submit" class="btn btn-default rounded btn-block">Login</button>
            </div>
        </div>
    </div>
    </form> --}}
    <form action="{{route('login')}}" method="POST" id="loginForm">
        @csrf
    <div class="flex-box">
    <h4>Parolni kiriting</h4>
        <div class="passcode-area">
        <input autofocus type="text" maxlength="1" id='log1'>
        <input type="text" maxlength="1" id='log2'>
        <input type="text" maxlength="1" id='log3'>
        <input type="text" maxlength="1" id='log4'>
        <input type="text" maxlength="1" id='log5'>
        </div>
        </div>

    <input type="text" id="logall" class="d-none" name="password">

    <div class=" no-bg-shadow py-3">
        <div class="row justify-content-center">
            <div class="col-6">
                <button type="button" onclick="myLogin()" class="btn btn-default rounded btn-block">Login</button>
            </div>
        </div>
    </div>
    </form>

</div>
@endsection
@section('login-scripts')


    <script>

    function myLogin()

    {
        var log1 = $('#log1').val();
        var log2 = $('#log2').val();
        var log3 = $('#log3').val();
        var log4 = $('#log4').val();
        var log5 = $('#log5').val();

        $('#logall').val(log1+log2+log3+log4+log5);

        $('#loginForm').submit()
    }
        //To Do: Add Visibility toggle
const inputs = document.querySelectorAll('.passcode-area input');
inputs[0].focus();
    for (elem of inputs) {
    elem.addEventListener('input', function() {
        const value = this.value;
        const nextElement = this.nextElementSibling;
        if (value === '' || !nextElement) {
        return;
        }
        nextElement.focus();
    });
    }
for (let elem of inputs) {
  elem.addEventListener('keydown', function(event) {
     //Right Arrow Key
    if (event.keyCode == 39) {
      this.nextElementSibling.focus();
    }
     //Left Arrow Key
    //Add Highlight
    if (event.keyCode == 37) {
      this.previousElementSibling.focus();
    }
    //Backspace Key
    if (event.keyCode == 8 && event.metaKey) {
      console.log('🐰🥚 FOUND!!! Cmd + Backspace = clear all');
      for (innerElem of inputs) {
        innerElem.value = '';
      }
      inputs[0].focus();
    } else if (event.keyCode == 8) {
      if(elem.value === '') {
        this.previousElementSibling.focus();
        return;
      }
      elem.value = '';
    }
  });
}

    </script>
@endsection
