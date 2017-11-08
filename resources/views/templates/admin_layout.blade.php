<!DOCTYPE html>
<html>
  <head>
    <title>@yield('title')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <link href="//cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

    <script src="//cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>

    <style>
      .loading {
        width: 100%;
        height: 100%;
        position: fixed;
        top: 0;
        right: 0;
        bottom: 0;
        left: 0;
        background-color: rgba(0,0,0,.5);
        z-index: 1000;
        display: none;
      }
      .loading-wheel {
        width: 20px;
        height: 20px;
        margin-top: -40px;
        margin-left: -40px;

        position: absolute;
        top: 50%;
        left: 50%;

        border-width: 30px;
        border-radius: 50%;
        -webkit-animation: spin 1s linear infinite;
      }
      .style-2 .loading-wheel {
        border-style: double;
        border-color: #ccc transparent;
      }
      @-webkit-keyframes spin {
        0% {
          -webkit-transform: rotate(0);
        }
        100% {
          -webkit-transform: rotate(-360deg);
        }
      }
    </style>

  </head>

  <body>
    @yield('content')
  </body>
</html>