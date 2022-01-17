@extends('layouts.app')

@section('content')

<script src="https://code.jquery.com/jquery-1.10.2.js"></script>
<!-- Bootstrap core CSS -->
<link rel="canonical" href="https://getbootstrap.com/docs/5.1/examples/headers/">
<link href="{{asset('assets/CSS/bootstrap.min.css')}}" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
<!-- Custom styles for this template -->
<link href="{{asset('assets/CSS/form-validation.css')}}" rel="stylesheet">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>

<style media="screen">
  .navbar-nav{
    font-size:14px !important;
  }
  .container {
    max-width:1070px !important;
  }
  table {
    overflow:hidden;
  }
</style>



<div class="container-fluid mt-3">
    <!-- <h1>Role: {{ Auth::user()->getRole() }}</h1> -->
    <!-- <h1>currentOrder.blade(admin)</h1> -->

    <div class="row g-2  mx-2">

      <div class="col-3">
        <h2>Role & Permission</h1>
        <small>All roles and permissions are shown in this page</small>
      </div>

      <div class="col-6">

      </div>

      <div class="col-3">
          <input type="text" class="form-control" id="search" placeholder="Search roles">
          <hr>
      </div>

                {{-- filter --}}
                <div class="row mb-2">
                    <div class="col-md-3">
                        <a href="{{ route('user.index') }}">All</a>
                    </div>
                    <div class="col-md-3">
                        <a href="{{ route('pages.admins') }}">Admins</a>
                    </div>
                    <div class="col-md-3">
                        <a href="{{ route('pages.technicians') }}">Technicians</a>
                    </div>
                    <div class="col-md-3">
                        <a href="{{ route('pages.users') }}">Users</a>
                    </div>
                </div>
            

                {{-- create user --}}
                <a href="{{ route('user.create') }}" class="btn btn-primary">Add</a>

                {{-- Users table --}}
                <div class="col-12 shadow-sm rounded border border-2">

                    <table class="table table-hover text-start mt-1">
          
                        <thead class="text-white">
                        <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Role</th>
                    <th>Edit</th>
                    <th>Delete</th>
                        </tr>
                        </thead>
                    @forelse ($users as $user)
                        <tr>
                            {{-- user id --}}
                            <th scope="row">{{ $user->id }}</th>

                            {{-- user name --}}
                            <td>
                                <a href="{{ route('user.show', $user) }}">{{ $user->name }}</a>
                            </td>

                            {{-- role dropdown --}}
                            <td>
                                <form action="{{ route('user.updateRole', $user) }}" method="POST">
                                    @method('PATCH')
                                    @csrf

                                    <select class="" name="action" onchange="this.form.submit()">
                                        <option disabled selected value>{{ $user->getRole() }}</option>
                                        <option value="user">User</option>
                                        <option value="technician">Technician</option>
                                        <option value="admin">Admin</option>
                                    </select>

                                </form>
                            </td>

                            {{-- edit button --}}
                            <td><a href="{{ route('user.edit', $user) }}" class="btn btn-primary"><i
                                        class="bi bi-pencil-square"></i></a>
                            </td>

                            {{-- delete button --}}
                            <td>
                                <form action="{{ route('user.destroy', $user->id) }}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-primary"><i class="bi bi-trash"></i></button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <h1>no data</h1>
                        @endforelse
                    </table>

                    <div class="d-flex flex-row-reverse">
                        {!! $users->links() !!}
                    </div>
                </div>
                <nav aria-label="Page navigation example ">
                    <ul class="pagination justify-content-end ">
                      <li class="page-item disabled ">
                        <a class="page-link" href="#" tabindex="-1" aria-disabled="true">Previous</a>
                      </li>
                      <li class="page-item"><a class="page-link " href="#">1</a></li>
                      <li class="page-item"><a class="page-link " href="#">2</a></li>
                      <li class="page-item"><a class="page-link " href="#">3</a></li>
                      <li class="page-item">
                        <a class="page-link  text-dark" href="#">Next</a>
                      </li>
                    </ul>
                  </nav>
            </div>
        </div>

    </div>


    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script>
$('#search').on('keyup',function(){
$value=$(this).val();
$.ajax({
type : 'get',
url : '/pages/order/search-requested-jobs',
data:{'s':$value, status:'Booked'},
success:function(data){
    // console.log(data);
$('#current_orders').html(data.html);
}
});
})
</script>
<script type="text/javascript">
    $.ajaxSetup({ headers: { 'csrftoken' : '{{ csrf_token() }}' } });
</script>
@endsection
