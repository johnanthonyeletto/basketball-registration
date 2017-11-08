@extends('templates.admin_layout')

@section('title', 'Admin - Basketball Registration')

@section('content')

<div class="loading style-2"><div class="loading-wheel"></div></div>

<header class="container-fluid">
  <img src="/redFox.png">
  <h1>Red Fox Music</h1>
</header>

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
        <td>{{\Carbon\Carbon::parse($game->game_datetime)->format('l, M d, Y - h:i A')}}</td>
      </tr>
      @endforeach
    </tbody>
  </table>
</section>

<footer class="container-fluid">
  <small>Created by <a href="http://www.johneletto.com/" target="_blank"><b>John Eletto</b></a> for <a href="http://clubs.marist.edu/band" target="_blank"><i>The Marist College Band</i></a>.</small>
  <br/>
  <small>&copy;{{ date("Y") }} John Eletto</small>
</footer>

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
        <form method="post" action="/api/assign-game">
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Save</button>
      </div>
    </div>

  </div>
</div>

<script>
var table = $('#gameTable').DataTable({
  paging: false,
  ordering: false,
  searching: false
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

      $("#response-modal").find(".modal-title").html(selected[1] + " - <span style='color: #1565C0'>" +response['game_info']['number_assigned'] + " Assigned</span><br/><small>" + selected[2] + "</small>");

      var append = "<table class='table'>";

      append += "<input type='hidden' name='game_id' value='" + selected[0] + "'>";

      append += "<thead><th></th><th>Name</th><th>Weekend</th><th>Weekday</th></thead>"

      var currentInstrument = ""

      $.each(response['responses'], function(){

        if(this['instrument'] != currentInstrument){
          append += "<tr><td></td></tr>";
          append += "<tr style='background-color: #E0E0E0;'><td colspan='4'><b>" + this['instrument'] + "</b></td></tr>";
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

        if(this['scholarship'] == 1 || response['game_info']['game_required'] == 1){
          append += "<td><input type='checkbox' name='student_assigned[]' value='" + this["cwid"] + "' checked disabled></td>";
          append += "<input type='hidden' name='student_assigned[]' value='" + this["cwid"] + "'>";
        }else if(this['assigned'] == 1){
          append += "<td><input type='checkbox' name='student_assigned[]' value='" + this["cwid"] + "' checked></td>";
        }else{
          append += "<td><input type='checkbox' name='student_assigned[]' value='" + this["cwid"] + "'></td>";
        }

        append += "<td>" + this['student_name'] + "</td>";

        append += "<td>" + this['weekend_assigned'] + "</td>";

        append += "<td>" + this['weekday_assigned'] + "</td>";

        append += "</tr>";

      });

      append += "</table>"
      $("#response-modal").find("form").append(append);
    });

  }
} );

$("#response-modal").find("form").submit(function(e) {
  e.preventDefault();
  $.ajax({
    type: 'POST',
    url: '/api/assign-game',
    data: $("#response-modal").find("form").serialize(),
    success: function() {
      $(".loading.style-2").hide();
    },
    error: function() {
      alert("There was an error. Reloading page. Please try again.");
      
      location.reload();
    }
  });
});


  $('#response-modal').on('hidden.bs.modal', function (e) {
    $(".loading.style-2").show();
    
    
    $("#response-modal").find("form").submit();  
  });



</script>

@endsection