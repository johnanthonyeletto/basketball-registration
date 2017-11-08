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
      @font-face {
        font-family: collegiate-black;
        src: url(/fonts/CollegiateBlackFLF.ttf);
      }

      @font-face {
        font-family: collegiate;
        src: url(/fonts/CollegiateFLF.ttf);
      }

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

      header{
        height: 100px;
        width: 100%;
        background-color: rgb(227,0,54);
        margin-bottom: 10px;
      }

      header img{
        height: 100%;
        vertical-align: middle;
        -webkit-filter: drop-shadow(5px 5px rgba(0,0,0,0.2));
        filter: drop-shadow(5px 5px rgba(0,0,0,0.2));
      }

      header h1{
        display: inline;
        vertical-align: middle;
        height: 100%;
        color: white;
        font-family: collegiate;
        font-size: 50px;
        text-shadow: 5px 5px rgba(0,0,0,0.2);
      }
      
      footer{
        margin-top: 10px;
      }
      
      .table-hover tr{
        cursor: pointer;
      }
    </style>

  </head>

  <body>
    @yield('content')
  </body>
</html>