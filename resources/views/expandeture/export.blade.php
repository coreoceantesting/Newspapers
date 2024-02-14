<table>
    <thead>
        <tr>
            <th colspan="6" style="font-size: 15px;font-weight:700;margin-top:3px;margin-bottom:3px" align="center">List Expense (खर्चाची यादी)</th>
        </tr>
        <tr>
            <th>दिनांक</th>
            <th>युनिक क्र</th>
            <th>बिल क्र</th>
            <th>वर्तमानपत्र नाव</th>
            <th>देयाकावारची रक्कम</th>
            <th>शिल्लक</th>
        </tr>
    </thead>
    <tbody>
        @foreach($expandetures as $expandeture)
        <tr>
            <td>{{ ($expandeture->created_at) ? date('d-m-Y', strtotime($expandeture->created_at)) : '' }}</td>
            <td>{{ $expandeture->unique_no }}</td>
            <td>{{ $expandeture?->billing?->bill_number }}</td>
            <td>{{ $expandeture?->newsPaper?->name }}</td>
            <td>{{ round($expandeture->invoice_amount, 2) }}</td>
            <td>{{ round($expandeture->balance, 2) }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
