<table class="table table-bordered">
   <tr>
        <th>Customer Code</th>
        <td>{{ isset($bill->customer_usage->customer->code) ? $bill->customer_usage->customer->code : 'N/A' }}</td>
    </tr>
    <tr>
        <th>Name</th>
        <td>{{ isset($bill->customer_usage->customer->user->name) ? $bill->customer_usage->customer->user->name : 'N/A' }}</td>
    </tr>
    <tr>
        <th>Date Usage</th>
        <td>{{ isset($bill->customer_usage->date_usage) ? $bill->customer_usage->date_usage->format('F, Y') : 'N/A' }}</td>
    <tr>
        <th>Start Meter</th>
        <td>{{ isset($bill->customer_usage->start_meter) ? $bill->customer_usage->start_meter : 'N/A' }}</td>
    </tr>
    <tr>
        <th>End Meter</th>
        <td>{{ isset($bill->customer_usage->end_meter) ? $bill->customer_usage->end_meter : 'N/A' }}</td>
    </tr>
    <tr>
        <th>Total Meter</th>
        <td>{{ isset($bill->total_meter) ? $bill->total_meter : 'N/A' }}</td>
    </tr>
    <tr>
        <th>Rate Power / KWh</th>
        <td>Rp. {{ isset($bill->customer_usage->customer->rate->rate_power) ? number_format($bill->customer_usage->customer->rate->rate_power) : 'N/A' }}</td>
    </tr>
    <tr>
        <th>Total Price</th>
        <td>Rp. {{ isset($bill->total_price) ? number_format($bill->total_price) : 'N/A' }}</td>
    </tr>
    <tr>
        <th>Photo</th>
        <td>
             @if (isset($bill->photo))
                <img src="{{ asset('storage/'.$bill->photo) }}" alt="{{ $bill->photo }}" width="100px" height="100px">
            @else
                Not Found    
            @endif
        </td>
    </tr>
</table>