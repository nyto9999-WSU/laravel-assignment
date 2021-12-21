@extends('layouts.app')

@push('css')
    <link href="{{ asset('css/datepicker.css') }}" rel="stylesheet">
@endpush
@push('js')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
    <script type="text/javascript">
        $(function(){
            $('#datepicker').datepicker({
                format: 'yyyy/mm/dd'
            });
        });
    </script>
@endpush

@section('content')
<div class="container">
    <h1>Role: {{ Auth::user()->role }}</h1>

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <h1>Create Order</h1>

                    <!--TODO:Fill #8 all data based on our client-request-form-->
                    <form action="{{ route('order.store') }}" method="post">
                        @csrf


                            <!--TODO: fill data here-->

                            <!--Datepicker-->
                            <div class="input-group date" id="datepicker">
                                <input type="text" class="form-control" name="prefer_date" id="date"/>
                                <span class="input-group-append">
                                    <span class="input-group-text bg-light d-block">
                                        <i class="fa fa-calendar"></i>
                                    </span>
                                </span>
                            </div>

                            <!--Extra Note-->
                            <label for="extra_note">Extra Note</label>
                            <input type="text" name="extra_note">


                            <button type="submit">submit</button>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>

@endsection
