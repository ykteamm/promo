<!doctype html>
<html lang="en" class="h-100">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="generator" content="">
    <title>Promo Novatio</title>

    <!-- manifest meta -->
    <meta name="apple-mobile-web-app-capable" content="yes">


    @include('partials.css')

    <style>
        //VARIABLES BECAUSE CSS PREPROCESSORS ARE COOL
@bone: #fff;
@eggshell: #efeffe;
@body-bg: #fefefe;
@breakpoint-tablet: 800px;
@breakpoint-mobile: 450px;

body {
  background: @body-bg;
  background-image: linear-gradient(to bottom right, #973999, #f8598b, #f7bf00);
  font-family: Helvetica, Arial, sans-serif;
  min-height: 100vh;
}

.flex-box {
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  padding: 75px;
  @media only screen and (max-width: @breakpoint-tablet) {
    padding: 25px;
  }
}

h1 {
  color: @bone;
  font-size: 3.5em;
  line-height: 1.25;
  text-align: center;
}

h3 {
  color: @eggshell;
  opacity: 0.7;
  font-weight: 300;
  font-style: italic;
  :after {
    content: "\005f";
  }
}

h5 {
  color: @eggshell;
  font-size: 2em;
  font-weight: 400;
  text-transform: uppercase;
  letter-spacing: 1px;
  &:after {
    content: "";
    position: relative;
    display: block;
    padding-bottom: 5px;
    width: 100%;
    border-bottom: 2px solid #fff;
  }
}

.passcode-area {
  margin-top: 50px;
  text-align: center;
}

.passcode-area > input {
  background-color: @bone;
  border: 2px solid #d6d6d6;
  border-radius: 4px;
  padding: 0;
  margin: 25px 6px 0;
  width: 30px;
  height: 30px;
  text-align: center;
  /* font-size: 32px; */
  /* line-height: 1.29; */
  text-transform: uppercase;
  background-clip: padding-box;

  &:focus {
    -webkit-appearance: none;
    border: 2px solid skyblue;
    outline: 0;
    box-shadow: 0px 0px 3px rgba(131, 192, 253, 0.5);
  }
}


    </style>

</head>

<body class="body-scroll d-flex flex-column h-100 menu-overlay" data-page="landing">
    @include('components.loader')

    @yield('login')


    @include('partials.js')
    @yield('login-scripts')

</body>

</html>
