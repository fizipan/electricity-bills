<table class="table table-bordered">
    <tr>
        <th>Customer Code</th>
        <td>{{ isset($customer_usage->customer->code) ? $customer_usage->customer->code : 'N/A' }}</td>
    </tr>
    <tr>
        <th>Name</th>
        <td>{{ isset($customer_usage->customer->user->name) ? $customer_usage->customer->user->name : 'N/A' }}</td>
    </tr>
    <tr>
        <th>Date Usage</th>
        <td>{{ isset($customer_usage->date_usage) ? $customer_usage->date_usage->format('F, Y') : 'N/A' }}</td>
    <tr>
        <th>Start Meter</th>
        <td>{{ isset($customer_usage->start_meter) ? $customer_usage->start_meter : 'N/A' }}</td>
    </tr>
    <tr>
        <th>End Meter</th>
        <td>{{ isset($customer_usage->end_meter) ? $customer_usage->end_meter : 'N/A' }}</td>
    </tr>
    <tr>
        <th>Date Check</th>
        <td>{{ isset($customer_usage->date_check) ? $customer_usage->date_check->format('F, Y'): 'N/A' }}</td>
    </tr>
</table>