@forelse ($aircons as $aircon)
<li>
{{$aircon->model_number}}
 </li>

@empty
N/A
@endforelse

