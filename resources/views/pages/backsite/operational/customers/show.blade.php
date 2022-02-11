<table class="table table-bordered">
    <tr>
        <th>Code</th>
        <td>{{ isset($customer->code) ? $customer->code : 'N/A' }}</td>
    </tr>
    <tr>
        <th>Name</th>
        <td>{{ isset($customer->user->name) ? $customer->user->name : 'N/A' }}</td>
    </tr>
    <tr>
        <th>Mobile Phone</th>
        <td>{{ isset($customer->user->detail_users->mobile_phone) ? $customer->user->detail_users->mobile_phone : 'N/A' }}</td>
    <tr>
        <th>No Meter</th>
        <td>{{ isset($customer->no_meter) ? $customer->no_meter : 'N/A' }}</td>
    </tr>
    <tr>
        <th>Rate Code</th>
        <td>{{ isset($customer->rate->code) ? $customer->rate->code: 'N/A' }}</td>
    </tr>
    <tr>
        <th>Address</th>
        <td>{{ isset($customer->user->detail_users->address) ? $customer->user->detail_users->address : 'N/A' }}</td>
    </tr>
</table>