@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Role: {{ Auth::user()->getRole() }}</h1>
        <h1>rolePermission.blade(admin)</h1>
        <div class="row justify-content-center">
            <div class="col-md-8">

                {{-- Search bar --}}
                <form type="get" action="admin/role-permission-search">
                    <div class="input-group mb-3">
                        <input type="search" class="form-control mr-2" name="query" placeholder="Recipient's username"
                            aria-label="Recipient's username" aria-describedby="button-addon2">
                        <button class="btn btn-outline-secondary" type="submit" id="button-addon2">Button</button>
                    </div>
                </form>

                {{-- Users table --}}
                <table class="table table-striped">
                    <th scope="col">ID</th>
                    <th scope="col">Name</th>
                    <th scope="col">Role</th>
                    @forelse ($users as $user)
                        <tr>
                            <th scope="row">{{ $user->id }}</th>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->getRole() }}</td>
                            <td>
                                <form action="{{ route('rolePermission.update', $user) }}" method="POST">
                                    @method('PATCH')
                                    @csrf

                                    <select class="" name="action" onchange="this.form.submit()">
                                        <option>Switch Role</option>
                                        <option value="user">User</option>
                                        <option value="technician">Technician</option>
                                        <option value="admin">Admin</option>
                                    </select>

                                    <button class="btn btn-danger" type="submit" name=" action"
                                        value="delete">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <h1>no data</h1>
                    @endforelse
                </table>
            </div>
        </div>
        <div class="d-flex flex-row-reverse">
            {!! $users->links() !!}
        </div>
    </div>

    </div>


    </div>
@endsection
