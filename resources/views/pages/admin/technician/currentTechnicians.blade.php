@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Role: {{ Auth::user()->getRole() }}</h1>
        <h1>technicians.blade</h1>
        <div class="row justify-content-center">
            <div class="col-md-8">

                {{-- add technician --}}
                <form action="{{ route('technician.store') }}" method="post">
                    @csrf
                    <div class="input-group mb-3">
                        <input type="text" name="name" class="form-control" placeholder="Recipient's username"
                            aria-label="Recipient's username" aria-describedby="button-addon2">
                        <button type="submit" id="button-addon2" class="btn btn-outline-secondary">
                            <i class="bi bi-person-plus"></i>
                        </button>
                    </div>
                </form>

                {{-- Search bar --}}
                <form type="get" action="admin/role-permission-search">
                    <div class="input-group mb-3">
                        <input type="search" class="form-control mr-2" name="query" placeholder="Recipient's username"
                            aria-label="Recipient's username" aria-describedby="button-addon2">
                        <button class="btn btn-outline-secondary" type="submit" id="button-addon2">Button</button>
                    </div>
                </form>

                {{-- technician table --}}
                <table class="table table-stripe">
                    <th>ID</th>
                    <th>name</th>
                    <th>Edit</th>
                    <th>Delete</th>


                    @forelse ($technicians as $t)
                        <tr>
                            <td>{{ $t->id }}</td>
                            <td>{{ $t->name }}</td>
                            <td><a href="{{ route('technician.edit', $t) }}" class="btn btn-primary"><i class="bi bi-pencil-square"></i></i></a>
                            </td>
                            <td>
                                <form action="{{ route('technician.destroy', $t) }}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-primary"><i class="bi bi-trash"></i></button>
                                </form>
                            </td>
                        </tr>
                    @empty

                    @endforelse
                </table>
            </div>
        </div>
        <div class="d-flex flex-row-reverse">
            {!! $technicians->links() !!}
        </div>
    </div>

    </div>


    </div>
@endsection
