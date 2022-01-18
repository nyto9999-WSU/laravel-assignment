@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        {{-- Search bar --}}

        <div class="row g-2  mx-2">

            <div class="col-3">
                <h2>Login History</h1>
                    <small>All assigned service requests are shown in this page</small>
            </div>

            <div class="col-6">

            </div>

            <div class="col-3 text-end mt-3">
                <form type="get" action="{{ route('pages.loginSearch') }}">
                    <div class="input-group">
                        <input type="search" class="form-control mr-2" name="name">
                        <button class="btn btn-outline-secondary" type="submit" id="button-addon2">Search</button>
                    </div>
                </form>
                <hr>
            </div>

            <div class="col-12 shadow-sm rounded border border-2">
                <table class="table table-hover text-start mt-1">
                    <th id="blue"  class="text-white">ID</th>
                    <th id="blue" class="text-white">Name</th>
                    <th id="blue" class="text-white">Role</th>
                    <th id="blue" class="text-white">Login At</th>
                    <th id="blue" class="text-white">Last Login At</th>
                    <th id="blue" class="text-white">Last IP</th>

                    @forelse ($users as $user)
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td>{{ $user->name }}</td>
                        <td class="text-capitalize">{{ $user->getRole() }}</td>

                        @if (empty($user->login_at))
                        <td>N/A</td>
                        @else
                        <td>{{ date('d-M-Y h:i A', strtotime($user->login_at)) }}</td>
                        @endif
                        <td>{{ date('d-M-Y h:i A', strtotime($user->lastSuccessfulLoginAt())) }}</td>
                        <td>{{ $user->lastSuccessfulLoginIp() }}</td>

                    </tr>

                    @empty
                    <tr>
                        <td colspan="10" class=" text-center fw-bold">
                            No Result
                        </td>
                    </tr>
                    @endforelse
                </table>
                <div class="d-flex flex-row-reverse">
                    {!! $users->links() !!}
                </div>
            </div>
            @endsection
