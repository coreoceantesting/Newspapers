<table>
    <thead>
        <tr>
            <th colspan="9" style="font-size: 17px;font-weight:700;margin-top:3px;margin-bottom:3px" align="center">@if($is_mail_send == "0")List Bill (बिलांची यादी)@else List Advertise Mail (जाहिरात मेल यादी) @endif</th>
        </tr>
        <tr>
            <th>युनिक क्र</th>
            <th>वर्क ऑर्डर क्र</th>
            <th>प्रसिध्दीचा स्तर</th>
            <th>कामाची किंमत</th>
            <th>विभाग</th>
            <th>प्रिंट प्रकार</th>
            <th>बॅनर आकार</th>
            <th>संदर्भ</th>
            <th>संदर्भ तारीख</th>
        </tr>
    </thead>
    <tbody>
        @foreach($advertises as $advertise)
        <tr>
            <td>{{ $advertise->unique_number }}</td>
            <td>{{ $advertise->work_order_number }}</td>
            <td>{{ $advertise?->publicationType?->name }}</td>
            <td>{{ $advertise?->cost?->name }}</td>
            <td>{{ $advertise?->department?->name }}</td>
            <td>{{ $advertise?->printType?->name }}</td>
            <td>{{ $advertise?->bannerSize?->size }}</td>
            <td>{{ $advertise->context }}</td>
            <td>{{ ($advertise->context_date) ? date('d-m-Y', strtotime($advertise->context_date)) : '' }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
