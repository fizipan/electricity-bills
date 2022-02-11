<table class="table table-bordered">
    <tr>
        <th>Code</th>
        <td>{{ isset($rate->code) ? $rate->code : 'N/A' }}</td>
    </tr>
    <tr>
        <th>Group Rate</th>
        <td>{{ isset($rate->group_rate->name) ? $rate->group_rate->name : 'N/A' }}</td>
    </tr>
    <tr>
        <th>Power</th>
        <td>{{ isset($rate->power) ? $rate->power : 'N/A' }}VA</td>
    </tr>
    <tr>
        <th>Rate Power / KWh</th>
        <td>Rp. {{ isset($rate->rate_power) ? number_format($rate->rate_power) : 'N/A' }}</td>
    </tr>
</table>