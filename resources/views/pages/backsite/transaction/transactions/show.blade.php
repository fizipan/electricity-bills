<table class="table table-bordered">
   <tr>
        <th>Customer Code</th>
        <td>{{ isset($transaction->customer_usage->customer->code) ? $transaction->customer_usage->customer->code : 'N/A' }}</td>
    </tr>
    <tr>
        <th>Name</th>
        <td>{{ isset($transaction->customer_usage->customer->user->name) ? $transaction->customer_usage->customer->user->name : 'N/A' }}</td>
    </tr>
    <tr>
        <th>Date Usage</th>
        <td>{{ isset($transaction->customer_usage->date_usage) ? $transaction->customer_usage->date_usage->format('F, Y') : 'N/A' }}</td>
    <tr>
        <th>Start Meter</th>
        <td>{{ isset($transaction->customer_usage->start_meter) ? $transaction->customer_usage->start_meter : 'N/A' }}</td>
    </tr>
    <tr>
        <th>End Meter</th>
        <td>{{ isset($transaction->customer_usage->end_meter) ? $transaction->customer_usage->end_meter : 'N/A' }}</td>
    </tr>
    <tr>
        <th>Total Meter</th>
        <td>{{ isset($transaction->total_meter) ? $transaction->total_meter : 'N/A' }}</td>
    </tr>
    <tr>
        <th>Rate Power / KWh</th>
        <td>Rp. {{ isset($transaction->customer_usage->customer->rate->rate_power) ? number_format($transaction->customer_usage->customer->rate->rate_power) : 'N/A' }}</td>
    </tr>
    <tr>
        <th>Total Price</th>
        <td>Rp. {{ isset($transaction->total_price) ? number_format($transaction->total_price) : 'N/A' }}</td>
    </tr>
    <tr>
        <th>Status</th>
        <td>
            @if (isset($transaction->status))
                @if ($transaction->status == '1')
                    <span class="badge badge-danger">UNPAID</span>
                @else
                    <span class="badge badge-success">PAID</span>
                @endif
            @else
                Not Found    
            @endif
        </td>
    </tr>
    <tr>
        <th>Photo</th>
        <td>
             @if (isset($transaction->photo))
                <img src="{{ Storage::url($transaction->photo) }}" alt="{{ $transaction->photo }}" width="100px" height="100px">
            @else
                Not Found    
            @endif
        </td>
    </tr>
</table>