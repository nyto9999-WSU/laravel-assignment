<div style="width: 80%; margin: auto;">
    <h3 style="text-align:center; font-size: 30px; margin-top: 30px;">Order Aricon</h3>
    <h3>Number of Job: {{ count($order->jobs) }}</h3>
    <hr>
    @forelse ($order->jobs as $job)
        <table style="width: 100%">
            <tbody>
                <tr>
                    <th style="padding: 10px 20px; width: 50%; text-align: left">Job ID</th>
                    <td style="width: 50%; padding: 10px 20px;">{{ $job->id }}</td>
                </tr>
                <tr>
                    <th style="padding: 10px 20px; width: 50%; text-align: left">Model</th>
                    <td style="width: 50%; padding: 10px 20px;">{{ $job->model_number }}</td>
                </tr>
                <tr>
                    <th style="padding: 10px 20px; width: 50%; text-align: left">Equipment Type</th>
                    <td style="width: 50%; padding: 10px 20px;">{{ $job->equipment_type }}</td>
                </tr>
                <tr>
                    <th style="padding: 10px 20px; width: 50%; text-align: left">Domestic Commercial</th>
                    <td style="width: 50%; padding: 10px 20px;">{{ $job->domestic_commercial }}</td>
                </tr>
                <tr>
                    <th style="padding: 10px 20px; width: 50%; text-align: left">Install Address</th>
                    <td style="width: 50%; padding: 10px 20px;">{{ $job->install_address }}</td>
                </tr>
                <tr>
                    <th style="padding: 10px 20px; width: 50%; text-align: left">Issue</th>
                    <td style="width: 50%; padding: 10px 20px;">{{ $job->issue }}</td>
                </tr>
                <tr>
                    <th style="padding: 10px 20px; width: 50%; text-align: left">Prefer Date</th>
                    <td style="width: 50%; padding: 10px 20px;">{{ date('d - M - Y', strtotime($job->prefer_date)) }}</td>
                </tr>
                <tr>
                    <th style="padding: 10px 20px; width: 50%; text-align: left">Prefer Time</th>
                    <td style="width: 50%; padding: 10px 20px;">{{ $job->prefer_time }}</td>
                </tr>
            </tbody>
        </table>
        <hr class="mb-2">
    @empty

    @endforelse

    <h3>Customer: {{ ucfirst($order->user->name) }} Info</h3>
    <table style="width: 100%"">
      <tbody>
          <tr>
              <th style=" padding: 10px 20px; width: 50%; text-align: left">Name</th>
      <td style="width: 50%; padding: 10px 20px;">{{ $order->name }}</td>
      </tr>
      <tr>
          <th style="padding: 10px 20px; width: 50%; text-align: left">Email</th>
          <td style="width: 50%; padding: 10px 20px;">{{ $order->email }}</td>
      </tr>
      <tr>
          <th style="padding: 10px 20px; width: 50%; text-align: left">Mobile Number</th>
          <td style="width: 50%; padding: 10px 20px;">{{ $order->mobile_number }}</td>
      </tr>
      <tr>
          <th style="padding: 10px 20px; width: 50%; text-align: left">Address</th>
          <td style="width: 50%; padding: 10px 20px;">{{ $order->address }}</td>
      </tr>
      <tr>
          <th style="padding: 10px 20px; width: 50%; text-align: left">State</th>
          <td style="width: 50%; padding: 10px 20px;">{{ $order->state }}</td>
      </tr>
      <tr>
          <th style="padding: 10px 20px; width: 50%; text-align: left">Suburb</th>
          <td style="width: 50%; padding: 10px 20px;">{{ $order->suburb }}</td>
      </tr>
      <tr>
          <th style="padding: 10px 20px; width: 50%; text-align: left">Postcode</th>
          <td style="width: 50%; padding: 10px 20px;">{{ $order->postcode }}</td>
      </tr>
      <tr>
          <th style="padding: 10px 20px; width: 50%; text-align: left">Extra Note</th>
          <td style="width: 50%; padding: 10px 20px;">{{ $order->extra_note }}</td>
      </tr>
      </tbody>
  </table>
  <hr>
</div>
