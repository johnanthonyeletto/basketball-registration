<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use Illuminate\Http\Request;

Route::get('/', function () {
  cas()->authenticate();
  
  $cwid = explode('@', cas()->user())[0];

  $weekday = DB::table('game')->where('game_required', '<>', 1)->whereIn(DB::raw('DAYOFWEEK(game_datetime)'), [2,3,4,5,6])->orderBy('game_datetime', 'asc')->get();

  $weekend = DB::table('game')->where('game_required', '<>', 1)->whereIn(DB::raw('DAYOFWEEK(game_datetime)'), [1,7])->orderBy('game_datetime', 'asc')->get();

  $required = DB::table('game')->where('game_required', '=', 1)->orderBy('game_datetime', 'asc')->get();
  
  $student = DB::table('student')->where('CWID', '=', $cwid)->get();

  //  return json_encode($games);
  return view('register', ['weekday' => $weekday, 'weekend' => $weekend, 'required' => $required, 'student' => $student[0]]);
});

Route::post('/register/submit', function(Request $request){
  cas()->authenticate();

  $cwid = explode('@', cas()->user())[0];

  DB::table('game_response')->where('CWID', '=', $cwid)->delete();

  foreach($request->input()['games'] as $key => $value){

    DB::table('game_response')->insert([
      'CWID' => $cwid,
      'game_id' => $key,
      'choice_id' => $value
    ]);
  }

  DB::table('class_response')->where('CWID', '=', $cwid)->delete();

  if(isset($request->input()['class'])){
    foreach($request->input()['class'] as $key => $value){

      $split = explode('-', $key);

      DB::table('class_response')->insert([
        'CWID' => $cwid,
        'class_day' => $split[0],
        'class_time' => $split[1]
      ]);
    }
  }

  return redirect('/register/thank-you');
});

Route::get('/register/thank-you', function(){
  cas()->authenticate();
  return view('thank_you');
});

Route::get('/admin', function(){
  cas()->authenticate();
  
  $cwid = explode('@', cas()->user())[0];
  
  $admin = DB::table('student')->where([ ['CWID', '=', $cwid], ['admin', '=', 1]])->get();
  
  if($admin->count() <= 0){
    App::abort(404);
    die();
  }
  
  $games = DB::table('game')->orderBy('game_datetime')->get();
  
  return view('admin', ['games' => $games]);
});
