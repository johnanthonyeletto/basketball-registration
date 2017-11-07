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


<!-- Modal -->
<div class="modal fade" id="response-modal" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"></h4>
      </div>
      <div class="modal-body">
        <form>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>

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
    
    
    $("#response-modal").find("form").html("");
    $("#response-modal").find(".modal-title").html("Loading...");
    
    $("#response-modal").modal();
    
    
    
    
    
    $.ajax({
      type: "POST",
      url: "/api/get-game-responses",
      data: {
        game_id: selected[0]
      }
    }).done(function(response){
      
      response = $.parseJSON(response);
      
      $("#response-modal").find(".modal-title").html(selected[1]);
      
      var append = "<table class='table'>";
      
      var currentInstrument = ""
      
      $.each(response['responses'], function(){
        
        if(this['instrument'] != currentInstrument){
          append += "<tr><td></td></tr>";
          append += "<tr style='background-color: #E0E0E0;'><td><b>" + this['instrument'] + "</b></td></tr>";
          currentInstrument = this['instrument'];
        }
        
        switch(this["choice_id"]){
          case 1:
            append += "<tr style='background-color: #A5D6A7;'>";
            break;
          case 2:
            append += "<tr style='background-color: #EF9A9A;'>";
            break;
          case 3:
            append += "<tr style='background-color: #FFF59D'>";
            break;
          default:
            append += "<tr>";
        }
        
        append += "<td>" + this['student_name'] + "</td>";
        
        append += "</tr>";
        
      });
      
      append += "</table>"
      $("#response-modal").find("form").append(append);
    });

  }
} );
</script>

@endsection