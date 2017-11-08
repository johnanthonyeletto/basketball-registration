@component('mail::message')

{{ $student->first_name }},

You've been assigned to {{ $games->count() }} basketball games for the Fall 2017 Semester.

<table width="100%" style="text-align: left;">
  <thead>
    <th>Game</th>
    <th>Date</th>
  </thead>
  <tbody>
    @foreach($games as $game)
    <tr>
      <td>{{ $game->game_name }}</td>
      <td>{{ \Carbon\Carbon::parse($game->game_datetime)->format('l, M d, Y - h:i A') }}</td>
    </tr>
    @endforeach
  </tbody>
</table>


<br/>
<br/>
Thanks,

The Marist Band

<a href="http://clubs.marist.edu/band">clubs.marist.edu/band</a>
@endcomponent
