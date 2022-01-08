@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Role: {{ Auth::user()->getRole() }}</h1>
        <h1>currentUser.blade(admin)</h1>
        <div class="row justify-content-center">
            <div class="col-md-8">

                {{-- Search bar --}}
                <form type="get" action="/admin/role-permission-search">
                    <div class="input-group mb-3">
                        <input type="search" class="form-control mr-2" name="query" placeholder="Recipient's username"
                            aria-label="Recipient's username" aria-describedby="button-addon2" value="{{!empty($name) ? $name : ''}}">
                        <button class="btn btn-outline-secondary" type="submit" id="button-addon2">Search</button>
                    </div>
                </form>

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
                <table class="table table-striped">
                    <th scope="col">ID</th>
                    <th scope="col">Name</th>
                    <th scope="col">Role</th>
                    <th scope="col">Edit</th>
                    <th scope="col">Delete</th>
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
            </div>
        </div>

    </div>


    </div>
@endsection
