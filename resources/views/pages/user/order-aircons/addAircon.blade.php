@extends('layouts.app')

@section('content')

    <div class="container">

        <!--Request intro-->

        <h2 class="text-center ">Air Conditioner request form</h2>
        <p></p>
        <p>Notice: If you have mutiple air conditioners to fix, please click <i>"Add new air conditioner"</i>. If you have
            only one air conditioner, please click the "Submit" button which is located at the bottom of the page</p>
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
                    <input type="text" class="form-control" name="model_number" id="model_number"
                        placeholder="eg: XGD78IJD7">
                </div>

                {{-- serial_number --}}
                <div class="col-md-12">
                    <label for="serial_number" class="form-label">Serial Number</label>
                    <input type="text" class="form-control" name="serial_number" id="serial_number"
                        placeholder="eg: XGD78IJD7">
                </div>
                {{-- equipment_type --}}
                <div class="col-md-6">
                    <label for="equipment_type" class="form-label">Equipment type</label>
                    <select class="form-select" name="equipment_type" id="equipment_type">
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
                    <input type="text" class="form-control" name="other_type" id="other_type" placeholder="Other....">
                </div>

                {{-- prefer_date --}}
                <div class="col-md-4">
                    <label for="prefer_date">Prefer Date</label>
                    <input type="text" class="form-control" id="datepicker" name="prefer_date">
                </div>


                {{-- prefer_time --}}
                <div class="col-md-4">
                    <label for="prefer_time" class="form-label">Prefer Time</label>
                    <select class="form-select" name="prefer_time" id="prefer_time">
                        <option value="">Choose...</option>
                        <option>Morning</option>
                        <option>Afternoon</option>
                        <option>Evening</option>
                    </select>
                </div>


                {{-- domestic_commercial --}}
                <div class="col-md-4">
                    <label for="domestic_commercial" class="form-label">Domestic / Commercial</label>
                    <select class="form-select" name="domestic_commercial" id="domestic_commercial">
                        <option value="">Choose...</option>
                        <option>Domestic</option>
                        <option>Commercial</option>
                    </select>
                </div>

                {{-- install_address --}}
                <div class="col-md-12">
                    <label for="install_address" class="form-label">Install Address</label>
                    <input type="text" class="form-control" name="install_address" id="install_address"
                        placeholder="eg: king st.">
                </div>

                {{-- issue --}}
                <div class="col-md-12">
                </div>
                <div class="description mb-1">
                    <label for="issue" class="form-label">What is wrong with the air conditioner?</label>

                    <textarea class="form-control" name="issue" id="issue" cols="30" rows="2"
                        placeholder="eg: It only works for 30 mins, and it gets hot again."></textarea>

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
                    <th>Serial Number</th>
                    <th>Equipment Type</th>
                    <th>Issue</th>
                    <th>Cancel</th>
                    <tr>
                        <td>{{ $aircon->model_number }}</td>
                        <td>{{ $aircon->serial_number }}</td>
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

    <!--Footer-->
    <footer class="my-5 pt-5 text-muted text-center text-small">
        <p class="mb-1">&copy; 2017–2021 Company Name</p>
        <ul class="list-inline">
            <li class="list-inline-item"><a href="#">Privacy</a></li>
            <li class="list-inline-item"><a href="#">Terms</a></li>
            <li class="list-inline-item"><a href="admin-home-page.html">Admin</a></li>
        </ul>
    </footer>

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
@endpush
