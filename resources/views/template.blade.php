// @php
// foreach($roles as $r) {
//     echo "['".$r->name."', ".$r->users_count."],";
// }
// @endphp


@php
                    $months = array('Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec');
                    for($i = 0; $i < 12 ; $i++)
                    {
                        echo "['.$months[$i].', ".$monthlyOrders[$i]."],";
                    }
                @endphp


@php
for($y = 0; $y<3; $y++)
{
    echo "[".$equipmentChart[$y*7].", ".$equipmentChart[$y*7+1].", ".$equipmentChart[$y*7+2].", ".$equipmentChart[$y*7+3].", ".$equipmentChart[$y*7+4].", ".$equipmentChart[$y*7+5].", ".$equipmentChart[$y*7+6].", ''],";
}
@endphp