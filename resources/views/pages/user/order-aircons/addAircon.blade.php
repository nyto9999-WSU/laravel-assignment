@extends('layouts.app')

@section('content')
<div class="container">

<!--Request intro-->

<h2 class="text-center ">Air Conditioner request form</h2>
<p></p>
<p>Notice: If you have mutiple air conditioners to fix, please click <i>"Add new air conditioner"</i>. If you have only one air conditioner, please click the "Submit" button which is located at the bottom of the page</p>
<div class="text-end">
    <button class="btn btn-warning"><b>Add new air conditioner</b></button>
</div>


    <form action="{{ route('aircon.store', $order) }}" method="post">
        @csrf

        <div class="row g-2  shadow-sm rounded border px-1 py-1  border-2">
        <p>Please enter your air conditioner information and issues</p>

        {{-- model_number --}}
    

    <div class="col-md-12">
        <label for="model_number" class="form-label">Model Number</label>
        <input type="text" class="form-control" name="model_number" id="model_number" placeholder="eg: XGD78IJD7">
    </div>
    {{-- equipment_type --}}
    <div class="col-md-6">
    <label for="equipment_type" class="form-label">Equipment type</label>
    <select class="form-select" name="equipment_type" id="equipment_type" >
        <option value="">Choose...</option>
        <option>Spilt System</option>
        <option>Ducted System</option>
        <option>Package unit</option>
        <option>Watercool unit</option>
        <option>Mini VRF</option>
    </select>
    
    </div>

    {{-- other_type --}}
    <div class="col-md-6">
    <label for="other_type" class="form-label">Other Equipment Type</label>
    <input type="text" class="form-control" name="other_type" id="other_type" placeholder="Other...." >
    
    </div>

    {{-- issue --}}
        <div class="col-md-12">
    </div>
    <div class="description mb-1">
        <label for="issue" class="form-label">What is wrong with the air conditioner?</label>

        <textarea class="form-control" name="issue" id="issue" cols="30" rows="2" placeholder="eg: It only works for 30 mins, and it gets hot again."></textarea>
        
   <br> <small>Pioneer International Pty. Ltd. will contact you to confirm the service booking.</small>
    </div>
    
    <button type="submit" class="w-100 btn btn-primary">Submit</button>
    </form>





<div>
    <hr class="my-4">


    <h4>Successfully submited requests</h4>
<br>
@forelse ($order->aircons as $aircon)
<table class="table">
 <th>Model Number</th>
 <th>Equipment Type</th>
 <th>Issue</th>
 <th>Cancel</th>
 <tr>
     <td>{{ $aircon->model_number }}</td>
     <td>{{ $aircon->equipment_type }}</td>
     <td>{{ $aircon->issue }}</td>
     <td>
         <form action="{{ route('aircon.destroy', [$aircon, $order]) }}" method="post">
             @method('DELETE')
             @csrf
             <button type="submit">
                 <i class="bi bi-trash"></i>
             </button>
         </form>
     </td>
 </tr>
</table>
@empty
<h1>no data</h1>
@endforelse



</div>
</div>
</main>

<!--Footer-->
<footer class="my-5 pt-5 text-muted text-center text-small">
<p class="mb-1">&copy; 2017–2021 Company Name</p>
<ul class="list-inline">
<li class="list-inline-item"><a href="#">Privacy</a></li>
<li class="list-inline-item"><a href="#">Terms</a></li>
<li class="list-inline-item"><a href="admin-home-page.html">Admin</a></li>
</ul>
</footer>


<script src="../assets/dist/js/bootstrap.bundle.min.js"></script>
<script src="JS/form-validation.js"></script>
<script type="text/javascript">
$(function(){
$("#navigation").load("client-nav.html");
});
</script>
</body>
</html>
@endsection