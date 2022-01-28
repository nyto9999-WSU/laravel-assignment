@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css">
    <div class="container-fluid">
        <div class="row g-2 mx-2">

            <div class="col-3">
                <h2>Role & Permission</h1>
                    <small>All roles and permissions are shown in this page</small>
            </div>

            {{-- filter --}}
            <div class="col-6 justify-content-center mt-5 pe-3">
                <div class="row justify-content-center text-center fw-bold mt-1">
                    <div class="col-md-4">
                        <div class="row">
                            <a href="{{ route('user.index') }}" class="col-md-6">All</a>
                            <a href="{{ route('pages.admins') }}" class="col-md-6">Admins</a>
                        </div>
                    </div>
                    <div class="col-md-2 text-center">
                        <a href="{{ route('pages.technicians') }}" class="">Technicians</a>
                    </div>
                    <div class="col-md-4">
                        <div class="row">
                            <a href="{{ route('pages.users') }}" class="col-md-6">Users</a>
                            <a href="" class="col-md-6" data-bs-toggle="modal"
                                data-bs-target=".bd-example-modal-xl">Add User</a>

                            {{-- modal calendar --}}
                            <div class="modal fade bd-example-modal-xl " id="exampleModal" tabindex="-1"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">

                                <div class="modal-dialog modal-dialog-scrollable">

                                    <div class="modal-content">
                                        <div class="modal-header p-2">
                                            <h5 class="modal-title">Create User</h5>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{ route('user.store') }}" method="POST">
                                                @csrf
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <label for="name" class="col-form-label">User Name:</label>
                                                        <input type="text" class="form-control" name="name" placeholder="" oninvalid="setCustomValidity('User name is required');" required>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <label for="role_id" class="col-form-label">Role:</label>
                                                        <select class="form-control" name="role_id">
                                                            <option disabled selected value>Required</option>
                                                            <option value="1">User</option>
                                                            <option value="3">Technician</option>
                                                            <option value="2">Admin</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <label for="email">Phone:</label>
                                                        <input type="text" class="form-control" name="mobile_number" placeholder="Optional">
                                                    </div>
                                                    <div class="col-md-12">
                                                        <label for="email">Email:</label>
                                                        <input type="text" class="form-control" name="email" placeholder="Optional">
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label for="state">State</label>
                                                        <select class="form-select" name="state" id="state">
                                                            <<option disabled selected value>Optional</option>
                                                            <option>NSW</option>
                                                            <option>Victoria</option>
                                                            <option>Queensland</option>
                                                            <option>South Australia</option>
                                                            <option>Western Australia</option>
                                                            <option>Tasmania</option>
                                                            <option>Northern Territory</option>
                                                            <option>Australian Capital Territory</option>
                                                        </select>
                                                        <div class="invalid-feedback">
                                                            Please provide a valid state.
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label for="email">Postcode:</label>
                                                        <input type="text" class="form-control" name="postcode" placeholder="Optional">
                                                    </div>
                                                </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary">Add User</button>
                                        </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-3 mt-3">
                {{-- Search bar --}}
                <form type="get" action="/admin/role-permission-search">
                    <div class="input-group mb-3">
                        <input type="search" class="form-control mr-2" name="query" placeholder="Recipient's username"
                            aria-label="Recipient's username" aria-describedby="button-addon2"
                            value="{{ !empty($name) ? $name : '' }}">
                        <button class="btn btn-outline-secondary" type="submit" id="button-addon2">Search</button>
                    </div>
                </form>
                <hr>
            </div>
        </div>




        {{-- Users table --}}
        <div class="col-12 shadow-sm rounded border border-2">

            <table class="table table-hover text-start text-center mt-1">

                <thead id="blue" class="text-white">
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
                        <th>{{ $user->id }}</th>

                        {{-- user name --}}
                        <td>
                            <a href="{{ route('user.show', $user) }}">{{ $user->name }}</a>
                        </td>

                        {{-- role dropdown --}}
                        <td>
                            <form action="{{ route('user.updateRole', $user) }}" method="POST">
                                @method('PATCH')
                                @csrf

                                <select class="form-control-sm" name="action" onchange="this.form.submit()">
                                    <option disabled selected value class="text-capitalize">
                                        {{ ucfirst($user->getRole()) }}</option>
                                    <option value="user">User</option>
                                    <option value="technician">Technician</option>
                                    <option value="admin">Admin</option>
                                </select>

                            </form>
                        </td>

                        {{-- edit button --}}
                        <td><a href="{{ route('user.edit', $user) }}" id="blue" class="btn btn-primary"><i
                                    class="bi bi-pencil-square"></i></a>
                        </td>

                        {{-- delete button --}}
                        <td>
                            <form id="delete-form_{{$user->id}}" action="{{ route('user.destroy', $user->id) }}" method="post">
                                @csrf
                                @method('DELETE')
                                <button type="button" user="{{$user->id}}" id="red" class="twitter btn text-white"><i class="bi bi-trash"></i></button>
                            </form>
                        </td>

                    </tr>
                @empty
                    <tr>
                        <td colspan="10" class=" text-center fw-bold">
                            No Result
                        </td>
                    </tr>
                @endforelse
            </table>

        </div>
        <div class="d-flex flex-row-reverse">
            {!! $users->links() !!}
        </div>

    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js"></script>

    <script type="text/javascript">
    $('.twitter').confirm({
      title: 'Are you sure?',
      content: 'Do you want to delete this user?',
      buttons: {
        Yes: function(){
          var user = this.$target.attr('user');
          $("#delete-form_"+user).submit();
        },
        No: {
          text: 'No', // With spaces and symbols
          action: function () {
          }
        }
      }
    });
    </script>
@endsection
