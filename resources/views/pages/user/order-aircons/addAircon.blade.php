@extends('layouts.app')

@section('content')

    <div class="container">

        <!--Request intro-->

        <h2 class="text-center ">Air Conditioner request form</h2>
        <p></p>
        <p>Notice: If you have mutiple air conditioners to fix, please click <i>"Add new air conditioner"</i>. If you have
            only one air conditioner, please click the "Submit" button which is located at the bottom of the page</p>
        <form action="{{ route('aircon.store', $order) }}" method="post">
            @csrf

            {{-- add new aircon button --}}
            <div class="text-end">
                <button type="submit" class="btn btn-warning"><b>Add new air conditioner</b></button>
            </div>

            <div class="row g-2 shadow-sm rounded border px-1 py-1  border-2">
                <p>Please enter your air conditioner information and issues</p>

                {{-- model_number --}}
                <div class="col-md-12">
                    <label for="model_number" class="form-label">Model Number</label>
                    <input type="text" class="form-control" name="model_number" id="model_number" required>
                </div>

                {{-- serial_number --}}
                <div class="col-md-12">
                    <label for="serial_number" required class="form-label">Serial Number</label>
                    <input type="text" class="form-control" name="serial_number" id="serial_number"
                        placeholder="eg: XGD78IJD7" required>
                </div>
                {{-- equipment_type --}}
                <div class="col-md-6">
                    <label for="equipment_type" required class="form-label">Equipment type</label>
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
                    <label for="other_type" class="form-label">Other Equipment Type(optional)</label>
                    <input type="text" class="form-control" name="other_type" id="other_type" placeholder="Other....">
                </div>

                {{-- prefer_date --}}
                <div class="col-md-4">
                    <label for="prefer_date" class="form-label">Prefer Date</label>
                    <input type="text" class="form-control" id="datepicker" name="prefer_date" required>
                </div>


                {{-- prefer_time --}}
                <div class="col-md-4">
                    <label for="prefer_time" class="form-label">Prefer Time</label>
                    <select class="form-select" name="prefer_time" id="prefer_time" required>
                        <option value="">Choose...</option>
                        <option>Morning</option>
                        <option>Afternoon</option>
                        <option>Evening</option>
                    </select>
                </div>


                {{-- domestic_commercial --}}
                <div class="col-md-4">
                    <label for="domestic_commercial" class="form-label">Domestic / Commercial</label>
                    <select class="form-select" required name="domestic_commercial" id="domestic_commercial">
                        <option value="">Choose...</option>
                        <option>Domestic</option>
                        <option>Commercial</option>
                    </select>
                </div>

                {{-- install_address --}}
                <div class="col-md-12">
                    <label for="install_address" class="form-label">Install Address</label>
                    <input type="text" required class="form-control" name="install_address" id="install_address"
                        placeholder="eg: king st.">
                </div>

                {{-- issue --}}
                <div class="col-md-12">
                </div>
                <div class="description mb-1">
                    <label for="issue" class="form-label">What is wrong with the air conditioner?</label>

                    <textarea required class="form-control" name="issue" id="issue" cols="30" rows="2"
                        placeholder="eg: It only works for 30 mins, and it gets hot again."></textarea>
                </div>
            </div>


        </form>

        @if (!count($order->jobs))
            <small>Please Add aircon before submitting.</small>
            <a href="#" id="blue" class="w-100 btn btn-primary disabled" role="button" aria-disabled="true">Submit</a>
        @else
            <h4 class="mt-2">Successfully submited requests</h4>
            <table class="table table-hover text-start mt-1">
                <th id="blue" class="text-white">Model/Serial</th>
                <th id="blue" class="text-white">Equipment Type</th>
                <th id="blue" class="text-white">Install Address</th>
                <th id="blue" class="text-white">Issue</th>
                <th id="blue" class="text-white">Cancel</th>
                @forelse ($order->aircons as $aircon)
                    <tr>
                        <td>Model: {{ $aircon->model_number }} / Serial: {{ $aircon->serial_number }}</td>
                        <td>{{ $aircon->equipment_type }}</td>
                        <td>{{ $aircon->install_address }}</td>
                        <td>{{ $aircon->issue }}</td>
                        <td>
                            <form action="{{ route('aircon.destroy', [$aircon, $order]) }}" method="post">
                                @method('DELETE')
                                @csrf
                                <button type="" id="blue" class="btn btn-primary"><i class="bi bi-trash"></i></button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr class="text-center">
                        <td colspan="5">Once you add aircon info, the successfull added aircon will be displayed here</td>
                    </tr>
                @endforelse
            </table>
            <small>Pioneer International Pty. Ltd. will contact you to confirm the service booking.</small>
            <a href="{{ route('aircon.mail', $order) }}" type="button" id="blue"
                class="sub w-100 btn btn-primary">Submit</a>

        @endif
    </div>

@endsection

@push('css')
    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.0/themes/base/jquery-ui.css">
@endpush

@push('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://code.jquery.com/ui/1.13.0/jquery-ui.js"></script>
    <script>
        $('#datepicker').datepicker("setDate", new Date());
        $("#datepicker").datepicker({
            dateFormat: "dd-mm-yy",
            minDate: '0'
        });
    </script>
    <script>
        $(".sub").on("click", function() {
            $(this).text("Processing");
            $(this).addClass("disabled").prop("disabled", true);
            $(this).append("<div class='spinner-border ms-2' style='width: 1rem; height: 1rem;'>")
        });
    </script>

@endpush
