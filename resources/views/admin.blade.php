@extends('templates.admin_layout')

@section('title', 'Admin - Basketball Registration')

@section('content')

<section class="container">
  <table class="table table-striped table-hover" id="gameTable">
    <thead>
      <th class="hidden">Game ID</th>
      <th>Game</th>
      <th>Date</th>
    </thead>
    <tbody>
      @foreach($games as $game)
      <tr>
        <td class="hidden">{{ $game->game_id }}</td>
        <td>{{ $game->game_name }} @if($game->game_required == 1) - <b style="color: red;">Required</b>@endif</td>
        <td>{{\Carbon\Carbon::parse($game->game_datetime)->format('l, M d, Y h:i A')}}</td>
      </tr>
      @endforeach
    </tbody>
  </table>
</section>

<script>
var table = $('#gameTable').DataTable({
  paging: false
});

$('#gameTable tbody').on( 'click', 'tr', function () {
  if ( $(this).hasClass('selected') ) {
    $(this).removeClass('selected');
  }
  else {
    table.$('tr.selected').removeClass('selected');
    $(this).addClass('selected');
    
    var selected = table.row( this ).data();
    
    $.ajax({
      type: "POST",
      url: "/api/get-game-responses",
      data: {
        game_id: selected[0]
      }
    }).done(function(response){
      console.log(response);
    });
    
  }
} );
</script>

@endsection