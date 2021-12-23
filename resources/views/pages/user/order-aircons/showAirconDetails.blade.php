@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <h1>Role: {{ Auth::user()->getRole() }}</h1>
        <h1>showAirconDetails.blade</h1>
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <h1>ID:{{ $aircon->id }}</h1>
                    <h1>Type:{{ $aircon->equipment_type }}</h1>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
