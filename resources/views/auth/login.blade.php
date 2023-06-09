@extends('layouts.login')
@section('login')

<div class="main-login">
    <form action="{{route('login')}}" method="POST" id="loginForm">
        @csrf
    <div class="flex-box">
    <h4 style="color:white;">Xush kelibsiz</h4>

        </div>
        <div class="passcode-area mb-5">
            <input autofocus type="text" maxlength="1" id='log1'>
            <input type="number" maxlength="1" id='log2'>
            <input type="number" maxlength="1" id='log3'>
            <input type="number" maxlength="1" id='log4'>
            <input type="number" maxlength="1" id='log5'>
            </div>
    <input type="text" id="logall" class="d-none" name="password">

    <div class="no-bg-shadow py-3 mt-4">
        <div class="row justify-content-center">
            <div class="col-6">
                <button type="button" onclick="myLogin()" class="btn btn-default rounded btn-block">Kirish</button>
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
