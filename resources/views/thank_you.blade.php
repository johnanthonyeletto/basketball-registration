@extends('templates.form')

@section('title', 'Basketball Registration')

@section('content')
<form id="fullpage" action="/register/submit" method="post">
  {{ csrf_field() }}
  <section class="section container" id="welcome-section">
    <header>
    <h1>Thanks for letting us know your game preferences!</h1>
    <br/>
    <h2>You will be contacted when assignments are released.</h2>
    </header>
    <a class="btn btn-primary" href="https://goo.gl/forms/mPKdhFVEvu0ipH9U2">Let us know if you're going abroad this semester!</a>
  </section>
</form>

<script>
$(document).ready(function() {

  var anchors = ['thank_you'];

  $('#fullpage').fullpage({
    anchors:anchors,
    scrollOverflow: true,
    keyboardScrolling: false,
  });

  $.fn.fullpage.setMouseWheelScrolling(false);
  $.fn.fullpage.setAllowScrolling(false);
});
</script>
@endsection