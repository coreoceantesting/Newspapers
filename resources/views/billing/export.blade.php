<table>
    <thead>
        <tr>
            <th colspan="16" style="font-size: 20px;font-weight:700;margin-top:3px;margin-bottom:3px" align="center">
                @if(Request()->is_paid == 0)
                List Bill (बिलांची यादी)
                @else
                Paid Bill(बिल दिले)
                @endif
            </th>
        </tr>
        <tr>
            <th>विभाग</th>
            <th>बिल क्रमांक</th>
            <th>बिल तारीख</th>
            <th>वर्तमानपत्राचे नाव</th>
            <th>बँकेचे नाव</th>
            <th>शाखेचे नाव</th>
            <th>खाते क्रमांक</th>
            <th>IFSC कोड</th>
            <th>पॅन कार्ड</th>
            <th>GST क्रमांक</th>
            <th>Basic Amount</th>
            <th>GST</th>
            <th>Gross Amount</th>
            <th>TDS</th>
            <th>IT</th>
            <th>Net Amount</th>
        </tr>
    </thead>
    <tbody>
        @foreach($billing as $bill)
        <tr>
            <td>{{ $bill?->department?->name }}</td>
            <td>{{ $bill->bill_number }}</td>
            <td>{{ ($bill->bill_date) ? date('d-m-Y', strtotime($bill->bill_date)) : '' }}</td>
            <td>{{ $bill?->newsPaper?->name }}</td>
            <td>{{ $bill?->accountDetails?->bank }}</td>
            <td>{{ $bill?->accountDetails?->branch }}</td>
            <td>{{ $bill?->accountDetails?->account_number }}</td>
            <td>{{ $bill?->accountDetails?->ifsc_code }}</td>
            <td>{{ $bill?->accountDetails?->pan_card }}</td>
            <td>{{ $bill?->accountDetails?->gst_no }}</td>
            <td>{{ $bill->basic_amount }}</td>
            <td>{{ $bill->gst }}</td>
            <td>{{ $bill->gross_amount }}</td>
            <td>{{ $bill->tds }}</td>
            <td>{{ $bill->it }}</td>
            <td>{{ $bill->net_amount }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
