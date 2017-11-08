@component('mail::layout')
{{-- Header --}}
@slot('header')
@component('mail::header', ['url' => config('app.url')])
The Marist College Band
@endcomponent
@endslot

{{-- Body --}}
{{ $slot }}

{{-- Subcopy --}}
@isset($subcopy)
@slot('subcopy')
@component('mail::subcopy')
{{ $subcopy }}
@endcomponent
@endslot
@endisset

{{-- Footer --}}
@slot('footer')
@component('mail::footer')
Created by <a href="http://www.johneletto.com/" target="_blank"><b>John Eletto</b></a> for <a href="http://clubs.marist.edu/band" target="_blank"><i>The Marist College Band</i></a>.
<br/>
<small>&copy;{{ date("Y") }} John Eletto</small>
@endcomponent
@endslot
@endcomponent
