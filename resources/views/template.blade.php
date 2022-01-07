public function index()
{
    $orders = Order::where('status', '=', 'Booked')->get();

    foreach($orders as $order)
    {
        $date = $order->prefer_date;
        switch ($order->prefer_time) {
            case 'Morning':
                $s = "09:00:00";
                $e = "12:00:00";
                break;
            case 'Afternoon':
                $s = "12:00:00";
                $e = "15:00:00";
                break;
            case 'Morning':
                $s = "15:00:00";
                $e = "18:00:00";
                break;

            default:
                # code...
                break;
        }

        $id[] = $order->id;
        $install_address[] = $order->install_address;
        $start[] = "${date}T${s}";
        $end[] = "${date}T${e}";
    }


    return view('pages.admin.calendar', compact('id','install_address','start','end'));
}