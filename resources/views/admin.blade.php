@extends('templates.admin_layout')

@section('title', 'Admin - Basketball Registration')

@section('content')

<section class="container">
  <table class="table table-striped table-hover" id="gameTable">
    <thead>
      <th>Game</th>
      <th>Date</th>
    </thead>
    <tbody>
      @foreach($games as $game)
      <tr>
        <td>{{ $game->game_name }} @if($game->game_required == 1) - <b style="color: red;">Required</b>@endif</td>
        <td>{{\Carbon\Carbon::parse($game->game_datetime)->format('l, M d, Y h:i A')}}</td>
      </tr>
      @endforeach
    </tbody>
  </table>
</section>

<script>
$(document).ready(function(){
    $('#gameTable').DataTable({
      paging: false
    });
});
</script>

@endsection