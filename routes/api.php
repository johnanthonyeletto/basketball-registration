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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/get-game-responses', function(Request $request){
  $responses = DB::table('student')->leftJoin('game_response', 'student.CWID', 'game_response.CWID')->select('student.cwid', DB::raw('CONCAT(student.first_name, " ", student.last_name) AS student_name'), 'student.instrument', 'student.scholarship', 'game_response.choice_id')->where('game_response.game_id', '=', $request['game_id'])->orWhereNull('game_response.choice_id')->get();
  
  return json_encode($responses);
});
