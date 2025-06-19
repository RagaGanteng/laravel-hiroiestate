<h2 style="text-align:center;">Transaction Report</h2>
<table width="100%" border="1" cellspacing="0" cellpadding="5">
    <thead>
        <tr>
            <th>Customer</th>
            <th>Email</th>
            <th>Property Type</th>
            <th>Agent</th>
            <th>Status</th>
            <th>Date</th>
        </tr>
    </thead>
    <tbody>
        @foreach($transactions as $tx)
        <tr>
            <td>{{ $tx->customer_name }}</td>
            <td>{{ $tx->customer_email }}</td>
            <td>{{ $tx->propertyType->name }}</td>
            <td>{{ $tx->agent->name }}</td>
            <td>{{ ucfirst($tx->status) }}</td>
            <td>{{ $tx->date }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
