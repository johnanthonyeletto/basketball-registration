@component('mail::message')

{{ $student->first_name }},

You are receiving your schedule again because the one you received earlier today had the games out of order. This is to make your schedule easier to read.

You are still assigned to the same games.

You've been assigned to {{ $games->count() }} basketball games for the Spring 2018 Semester.

Please be sure to email band@marist.edu if you're unable to make any of the games that you've been assigned to.

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
