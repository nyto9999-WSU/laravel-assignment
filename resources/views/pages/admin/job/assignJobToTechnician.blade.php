@extends('layouts.app')

@section('content')
    <div class="container mb-2">
        <div class="row">
            <h2 class="text-center">Assign a job to a Technician</h2>
            <small></small>

            {{-- assign table left --}}
            <div class="col-md-9 shadow-sm px-1 rounded border border-2 pb-0">
                <table class="table table-hover  text-start mb-2 mt-1">

                    {{-- order_id --}}
                    <tr>
                        <td>Job</td>
                        <td>{{ $job->id }}</td>
                    </tr>

                    {{-- model_number --}}
                    <tr>
                        <td>Model Number</td>
                        <td>
                            <a href={{ route('aircon.show', ['id' => $job->aircon_id, $order]) }}>
                                {{ $aircon->model_number }}
                            </a>
                        </td>
                    </tr>
                    {{-- model_number --}}
                    <tr>
                        <td>Serial Number</td>
                        <td>
                            <a href={{ route('aircon.show', ['id' => $job->aircon_id, $order]) }}>
                                {{ $aircon->serial_number }}
                            </a>
                        </td>
                    </tr>

                    {{-- domestic_commercial --}}
                    <tr>
                        <td>Domestic Commercial</td>
                        <td>{{ $aircon->domestic_commercial }}</td>
                    </tr>

                    {{-- extra_note --}}
                    <tr>
                        <td>Description</td>
                        <td>{{ $order->extra_note }}</td>
                    </tr>

                    {{-- name --}}
                    <tr>
                        <td>Owner</td>
                        <td>{{ $order->name }}</td>
                    </tr>

                    {{-- email --}}
                    <tr>
                        <td>Email Address</td>
                        <td>{{ $order->email }}</td>
                    </tr>

                    {{-- install_address --}}
                    <tr>
                        <td>Installation Address</td>
                        <td>{{ $aircon->install_address }}</td>
                    </tr>

                    {{-- mobile_number --}}
                    <tr>
                        <td>Mobile</td>
                        <td>{{ $order->mobile_number }}</td>
                    </tr>

                    {{-- prefer_time --}}
                    <tr>
                        <td>Prefer Time</td>
                        <td>{{ $job->prefer_time }}</td>
                    </tr>

                    {{-- prefer_date --}}
                    <tr>
                        <td>Prefer Date</td>
                        <td>{{ date('d-m-Y', strtotime($job->prefer_date)) }}</td>
                    </tr>

                    {{-- status --}}
                    <tr>
                        <td>Issue</td>
                        <td>{{ $aircon->issue }}</td>
                    </tr>

                    {{-- status --}}
                    <tr>
                        <td>Status</td>
                        <td>{{ $job->status }}</td>
                    </tr>

                    {{-- success alert --}}
                    <tr id="js-alert" style="display:none">
                        <td colspan="2" class="bg-warning text-center">Add note successfully</td>
                    </tr>
                </table>
            </div>

            {{-- assign table right --}}
            <div class="col-3">
                <div class="col-12 shadow-sm px-1 py-1 rounded border border-2">
                    <form action="{{ route('job.store', [$job, $order]) }}" method="post">
                        @csrf

                        {{-- choose time title --}}
                        <div id="blue" class="text-center px-2 mb-1 text-white">
                            <div class="pt-2" style="height: 49px">
                                Choose Time and Date
                            </div>
                        </div>

                        {{-- job_start_date --}}
                        <label for="start_date">Start Date</label>
                        <input type="text" class="form-select" id="datepicker" name="start_date">

                        {{-- job_start_time --}}
                        <label for="start-time">Start Time</label>
                        <select class="form-select w-100" name="start_time">
                            <option value="">Choose...</option>
                            <option>Morning</option>
                            <option>Afternoon</option>
                            <option>Evening</option>
                        </select>

                        {{-- add technician --}}
                        <div class="mt-2 mb-2">
                            <label for="tech_name">Techinicain</label>
                            <select class="form-select" name="tech_name">
                                <option disabled selected value>Technician</option>
                                @forelse ($technicians as $t)
                                    <option value="{{ $t->name }}">{{ $t->name }}</option>
                                @empty

                                @endforelse
                            </select>
                        </div>

                        {{-- add ntoe title --}}
                        <div id="blue" class="text-center px-2 mb-1 text-white">
                            <div class="pt-2" style="height: 49px">
                                Notes
                            </div>
                        </div>

                        {{-- notes record --}}
                        <div class="mt-2 mb-2">
                            <ul class="list-group border border-dark" id="js-notes" style="height: 180px; overflow: auto">

                                @forelse ($job->notes as $note)
                                    <li class="wraptext-li">
                                        {{ $note->description }}
                                    </li>
                                @empty
                                    N/A
                                @endforelse
                            </ul>
                        </div>

                        {{-- textarea --}}
                        <div class="mt-1" style="display: block;">
                            <textarea id="textarea" name="description" rows="3" class="form-control mb-1"></textarea>

                            {{-- js note submit --}}
                            <button id="js-note-submit" class="w-100 btn btn-secondary border border-secondary text-white mb-1" style="background-color: #2d333b;">Add
                                Note</button>
                        </div>

                        {{-- Assign btn --}}
                        <button type="submit" id="blue"
                            class="w-100 btn border border-dark text-white font-weight-bold">Assign</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('css')
    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.0/themes/base/jquery-ui.css">
@endpush

@push('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://code.jquery.com/ui/1.13.0/jquery-ui.js"></script>
    <script>
        //在後端改日期匹配mysql格式FIXME:
        $('#datepicker').datepicker("setDate", new Date());
        $("#datepicker").datepicker({
            dateFormat: "dd-mm-yy",
            minDate: '0'
        });
    </script>
    <script>
        $(document).ready(function() {
            $('#js-note-submit').click(function(e) {
                e.preventDefault();
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $("meta[name='csrf-token']").attr('content')
                    }
                });

                $.ajax({
                    type: "POST",
                    url: '/note/ajax',
                    data: {
                        'id': {{ $job->id }},
                        'description': $("#textarea").val()
                    },
                    success: function(response) {
                        var row = "";
                        $("#js-alert").show().delay(900).fadeOut();
                        $("#js-notes").empty();
                        console.log(response);
                        $.each(response, function(idx, obj) {
                            row += ("<li class='wraptext-li'>" + obj.description +
                                "</li>");
                        });

                        $("#js-notes").html(row);
                    }
                });

            });
        });
    </script>
@endpush
