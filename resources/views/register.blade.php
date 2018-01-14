@extends('templates.form')

@section('title', 'Basketball Registration')

@section('content')
<form id="fullpage" action="/register/submit" method="post">
  {{ csrf_field() }}
  <section class="section container" id="welcome-section">
    <header>
      <h1>{{$student->first_name}}, Welcome To The Marist Band Basketball Registration</h1>
      @if($student->scholarship)
      <br/>
      <h2>Since you are a scholarship student, you must go to all games.</h2>
      @endif
    </header>
    <a class="btn btn-primary" href="#instrument">Get Started</a>
  </section>
  <section class="section container" id="instrument-section">
    <header>
      <h1>Which instrument do you play?</h1>
    </header>
    <select class="form-control" name="instrument">
      <option>Piccolo</option>
      <option>Flute</option>
      <option>Clarinet</option>
      <option>Alto Sax</option>
      <option>Tenor Sax</option>
      <option>Trumpet</option>
      <option>Mellophone</option>
      <option>Trombone</option>
      <option>Baritone Horn</option>
      <option>Baritone Sax</option>
      <option>Sousaphone</option>
      <option>Percussion</option>
    </select>
    <a class="btn btn-primary" href="#class">Keep Going</a>
    <br/>
    <br/>
    <a href="#welcome">&larr; Back</a>
  </section>
  <section class="section container" id="class-section">
    <header>
      <h1>Let Us Know When You Have Class</h1>
    </header>
    <div class="row">
      <div class="col-sm-6">
        <div class="form-group">
          <label>Monday 5:00PM</label>
          <input type="checkbox" class="option-input checkbox" name="class[1-17:00:00]">
        </div>
        <div class="form-group">
          <label>Monday 6:30PM</label>
          <input type="checkbox" class="option-input checkbox" name="class[1-18:30:00]">
        </div>
        <div class="form-group">
          <label>Tuesday 5:00PM</label>
          <input type="checkbox" class="option-input checkbox" name="class[2-17:00:00]">
        </div>
        <div class="form-group">
          <label>Tuesday 6:30PM</label>
          <input type="checkbox" class="option-input checkbox" name="class[2-18:30:00]">
        </div>
        <div class="form-group">
          <label>Wednesday 3:30PM</label>
          <input type="checkbox" class="option-input checkbox" name="class[3-15:30:00]">
        </div>
        <div class="form-group">
          <label>Wednesday 5:00PM</label>
          <input type="checkbox" class="option-input checkbox" name="class[3-17:00:00]">
        </div>

      </div>
      <div class="col-sm-6">
        <div class="form-group">
          <label>Wednesday 6:30PM</label>
          <input type="checkbox" class="option-input checkbox" name="class[3-18:30:00]">
        </div>
        <div class="form-group">
          <label>Thursday 5:00PM</label>
          <input type="checkbox" class="option-input checkbox" name="class[4-17:00:00]">
        </div>
        <div class="form-group">
          <label>Thursday 6:30PM</label>
          <input type="checkbox" class="option-input checkbox" name="class[4-18:30:00]">
        </div>
        <div class="form-group">
          <label>Friday 5:00PM</label>
          <input type="checkbox" class="option-input checkbox" name="class[5-17:00:00]">
        </div>
        <div class="form-group">
          <label>Friday 6:30PM</label>
          <input type="checkbox" class="option-input checkbox" name="class[5-18:30:00]">
        </div>
      </div>
    </div>
    @if($student->scholarship)
    <a class="btn btn-primary" href="#required">Keep Going</a>
    @else
    <a class="btn btn-primary" href="#weekday">Keep Going</a>
    @endif
    <br/>
    <br/>
    <a href="#instrument">&larr; Back</a>
  </section>
  @if(!$student->scholarship)
  <section class="section container" id="weekday-section">
    <header>
      <h1>Weekday Games - </h1><h2>Choose {{ round($weekday->count()*0.6) }}</h2>
    </header>
    <table class="table table-striped">
      <th>Game</th>
      <th>Date</th>
      <th>Will Go</th>
      <th>Can't Go</th>
      <th>Don't Want To</th>
      @foreach($weekday as $game)
      <tr>
        <td>{{$game->game_name}}</td>
        <td>{{\Carbon\Carbon::parse($game->game_datetime)->format('l, M d, Y h:i A')}}</td>
        <td><input type="radio" value="1" class="option-input radio" name="games[{{ $game->game_id }}]" checked="checked"></td>
        <td><input type="radio" value="2" class="option-input radio" name="games[{{ $game->game_id }}]"></td>
        <td><input type="radio" value="3" class="option-input radio" name="games[{{ $game->game_id }}]"></td>
      </tr>
      @endforeach
    </table>
    <a class="btn btn-primary" href="#weekend">Keep Going</a>
    <br/>
    <br/>
    <a href="#class">&larr; Back</a>
    <br/>
  </section>
  <section class="section container" id="weekend-section">
    <header>
      <h1>Weekend Games - </h1><h2>Choose {{ round($weekend->count()*0.6) }}</h2>
    </header>
    <table class="table table-striped">
      <th>Game</th>
      <th>Date</th>
      <th>Will Go</th>
      <th>Can't Go</th>
      <th>Don't Want To</th>
      @foreach($weekend as $game)
      <tr>
        <td>{{$game->game_name}}</td>
        <td>{{\Carbon\Carbon::parse($game->game_datetime)->format('l, M d, Y h:i A')}}</td>
        <td><input type="radio" value="1" class="option-input radio" name="games[{{ $game->game_id }}]" checked></td>
        <td><input type="radio" value="2" class="option-input radio" name="games[{{ $game->game_id }}]"></td>
        <td><input type="radio" value="3" class="option-input radio" name="games[{{ $game->game_id }}]"></td>
      </tr>
      @endforeach
    </table>
    <a class="btn btn-primary" href="#required">Keep Going</a>
    <br/>
    <br/>
    <a href="#weekday">&larr; Back</a>
  </section>
  @endif
  <section class="section container" id="required-section">
    <header>
      <h1>Required Games - </h1><h2>You Need To Go To These</h2>
    </header>
    <table class="table table-striped">
      <th>Game</th>
      <th>Date</th>
      <th>Will Go</th>
      <th>Can't Go</th>
      <th>Don't Want To</th>
      @foreach($required as $game)
      <tr>
        <td>{{$game->game_name}}</td>
        <td>{{\Carbon\Carbon::parse($game->game_datetime)->format('l, M d, Y h:i A')}}</td>
        <input type="hidden" name="games[{{ $game->game_id }}]" value="1">
        <td><input type="radio" class="option-input radio" name="games[{{ $game->game_id }}]" checked disabled></td>
        <td><input type="radio" class="option-input radio" name="games[{{ $game->game_id }}]" disabled></td>
        <td><input type="radio" class="option-input radio" name="games[{{ $game->game_id }}]" disabled></td>
      </tr>
      @endforeach
      @if($student->scholarship)
      @foreach($weekday as $game)
      <tr>
        <td>{{$game->game_name}}</td>
        <td>{{\Carbon\Carbon::parse($game->game_datetime)->format('l, M d, Y h:i A')}}</td>
        <input type="hidden" name="games[{{ $game->game_id }}]" value="1">
        <td><input type="radio" class="option-input radio" name="games[{{ $game->game_id }}]" checked disabled></td>
        <td><input type="radio" class="option-input radio" name="games[{{ $game->game_id }}]" disabled></td>
        <td><input type="radio" class="option-input radio" name="games[{{ $game->game_id }}]" disabled></td>
      </tr>
      @endforeach
      @foreach($weekend as $game)
      <tr>
        <td>{{$game->game_name}}</td>
        <td>{{\Carbon\Carbon::parse($game->game_datetime)->format('l, M d, Y h:i A')}}</td>
        <input type="hidden" name="games[{{ $game->game_id }}]" value="1">
        <td><input type="radio" class="option-input radio" name="games[{{ $game->game_id }}]" checked disabled></td>
        <td><input type="radio" class="option-input radio" name="games[{{ $game->game_id }}]" disabled></td>
        <td><input type="radio" class="option-input radio" name="games[{{ $game->game_id }}]" disabled></td>
      </tr>
      @endforeach
      @endif
    </table>
    <button class="btn btn-primary" type="submit">Submit My Choices</button>
    <br/>
    <br/>
    @if($student->scholarship)
    <a href="#class">&larr; Back</a>
    @else
    <a href="#weekend">&larr; Back</a>
    @endif
  </section>
</form>

<script>
$(document).ready(function() {

  @if($student->scholarship)
  var anchors = ['welcome', 'instrument', 'class', 'required'];
  @else
  var anchors = ['welcome', 'instrument', 'class', 'weekday', 'weekend', 'required'];
  @endif

  $('#fullpage').fullpage({
    scrollOverflow: true,
    anchors:anchors,
    keyboardScrolling: false,
    scrollOverflowOptions: {
      click:false,    
      preventDefaultException: {tagName: /.*/}
    } 
  });

  $.fn.fullpage.setMouseWheelScrolling(false);
  $.fn.fullpage.setAllowScrolling(false);
});
</script>
@endsection