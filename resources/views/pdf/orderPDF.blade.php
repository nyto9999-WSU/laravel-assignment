<div style="width: 80%; margin: auto;">
  <h3 style="text-align:center; font-size: 30px; margin-top: 30px;">Order Aricon</h3>
  <table style="width: 100%">
    <tbody>
      <tr>
        <th style="padding: 10px 20px; width: 50%; text-align: right">Name</th>
        <td style="width: 50%; padding: 10px 20px;">{{ $order->name }}</td>
      </tr>
      <tr>
        <th style="padding: 10px 20px; width: 50%; text-align: right">Email</th>
        <td style="width: 50%; padding: 10px 20px;">{{ $order->email }}</td>
      </tr>
      <tr>
        <th style="padding: 10px 20px; width: 50%; text-align: right">Mobile Number</th>
        <td style="width: 50%; padding: 10px 20px;">{{ $order->mobile_number }}</td>
      </tr>
      <tr>
        <th style="padding: 10px 20px; width: 50%; text-align: right">Address</th>
        <td style="width: 50%; padding: 10px 20px;">{{ $order->address }}</td>
      </tr>
      <tr>
        <th style="padding: 10px 20px; width: 50%; text-align: right">State</th>
        <td style="width: 50%; padding: 10px 20px;">{{ $order->state }}</td>
      </tr>
      <tr>
        <th style="padding: 10px 20px; width: 50%; text-align: right">Suburb</th>
        <td style="width: 50%; padding: 10px 20px;">{{ $order->suburb }}</td>
      </tr>
      <tr>
        <th style="padding: 10px 20px; width: 50%; text-align: right">Postcode</th>
        <td style="width: 50%; padding: 10px 20px;">{{ $order->postcode }}</td>
      </tr>
      <tr>
        <th style="padding: 10px 20px; width: 50%; text-align: right">Extra Note</th>
        <td style="width: 50%; padding: 10px 20px;">{{ $order->extra_note }}</td>
      </tr>
      <tr>
        <th style="padding: 10px 20px; width: 50%; text-align: right">Model</th>
        <td style="width: 50%; padding: 10px 20px;">{{ $aircon->model_number }}</td>
      </tr>
      <tr>
        <th style="padding: 10px 20px; width: 50%; text-align: right">Equipment Type</th>
        <td style="width: 50%; padding: 10px 20px;">{{ $aircon->equipment_type }}</td>
      </tr>
      <tr>
        <th style="padding: 10px 20px; width: 50%; text-align: right">Other Type</th>
        <td style="width: 50%; padding: 10px 20px;">{{ $aircon->other_type }}</td>
      </tr>
      <tr>
        <th style="padding: 10px 20px; width: 50%; text-align: right">Domestic Commercial</th>
        <td style="width: 50%; padding: 10px 20px;">{{ $aircon->domestic_commercial }}</td>
      </tr>
      <tr>
        <th style="padding: 10px 20px; width: 50%; text-align: right">Install Address</th>
        <td style="width: 50%; padding: 10px 20px;">{{ $aircon->install_address }}</td>
      </tr>
      <tr>
        <th style="padding: 10px 20px; width: 50%; text-align: right">Issue</th>
        <td style="width: 50%; padding: 10px 20px;">{{ $aircon->issue }}</td>
      </tr>
    </tbody>
  </table>
</div>