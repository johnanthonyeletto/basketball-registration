<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


Route::post('/get-game-responses', function(Request $request){
  $responses = DB::table('student')->leftJoin('game_response', 'student.CWID', '=', 'game_response.CWID')->leftJoin('assignment', 'student.CWID', '=', 'assignment.CWID')->select('student.cwid', DB::raw('CONCAT(student.first_name, " ", student.last_name) AS student_name'), 'student.instrument', 'student.scholarship', 'game_response.choice_id', DB::raw("EXISTS(select * from assignment where assignment.CWID = student.CWID AND assignment.game_id = ". $request['game_id'] .") AS assigned"), DB::raw('(SELECT COUNT(assignment.CWID) from assignment JOIN game on assignment.game_id = game.game_id WHERE assignment.CWID = student.CWID AND DAYOFWEEK(game.game_datetime) IN (1,7)) AS weekend_assigned'), DB::raw('(SELECT COUNT(assignment.CWID) from assignment JOIN game on assignment.game_id = game.game_id WHERE assignment.CWID = student.CWID AND DAYOFWEEK(game.game_datetime) IN (2,3,4,5,6)) AS weekday_assigned'))->where('game_response.game_id', '=', $request['game_id'])->orWhereNull('game_response.choice_id')->groupBy('student.cwid', 'student_name', 'assigned', 'instrument', 'scholarship', 'choice_id')->orderBy('student.instrument', 'ASC')->orderBy('student.first_name', 'ASC')->orderBy('student.last_name', 'ASC')->get();

  $game_info = DB::table('game')->leftJoin('assignment', 'game.game_id', '=', 'assignment.game_id')->select(DB::raw("COUNT(assignment.game_id) AS number_assigned"), 'game.game_required')->where("game.game_id", "=", $request['game_id'])->groupBy('game.game_required')->get();

  return json_encode([
    "game_info" => $game_info[0],
    "responses" => $responses
  ]);
});

Route::post('/assign-game', function(Request $request){

  DB::table('assignment')->where('game_id', '=', $request['game_id'])->delete();
  if(isset($request['student_assigned'])){
    foreach($request['student_assigned'] as $student){
      DB::table('assignment')->insert([
        'game_id' => $request['game_id'], 
        'CWID' => $student
      ]);
    }
  }


  return response(200);
});
