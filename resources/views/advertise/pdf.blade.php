@php
    function convertToMarathiNumerals($input) {
        $englishDigits = ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9'];
        $marathiDigits = ['०', '१', '२', '३', '४', '५', '६', '७', '८', '९'];
        
        // Replace each English digit with its Marathi equivalent
        return str_replace($englishDigits, $marathiDigits, $input);
    }
@endphp
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        
        p{
            font-size: 15px;
        }
        /* td{
            font-size:18px;
        } */

        body {
            font-family: 'freeserif', 'normal';
        }
        hr{
            margin: 0;
        }
        .alnright { text-align: center; }

    </style>

</head>
<body>
    <img src="{{ public_path('image/header.png') }}" alt="">
    <p style="font-size: 13px;margin: 0px;margin-top: 10px;border-bottom:1px solid;">
       कार्यालय: २७४५८०४०/४१/४२
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        पीक्स नं.: ०२२-२७४५२२३३
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        Email: panvelcorporation@gmail.com

        
    </p>
    <table style=" width: 100%;">
    <tr>
        <td><span>{{ $advertise->work_order_number }} </span></td>
        <td style="text-align: right;"><span>दिनांक:- {{ convertToMarathiNumerals(date('d-m-Y')) }}</span></td>
    </tr>
    </table>
    <p>
        प्रति,<br>
        जाहिरात व्यवस्थापक,<br>
        @php $count = count($advertise->advertiseNewsPapers); @endphp
        @foreach($advertise->advertiseNewsPapers as $newsPaper)
        {!! $newsPaper->newsPaper->name !!}@if($loop->iteration != $count), @endif
        @if($count > 4)
            @if(($loop->iteration) % 2 == 0)
            <br>
            @endif
        @else
        <br>
        @endif
        @endforeach
    </p>
    
        <table>
            <tr>
                <td style="width: 20%;text-align: right; vertical-align: top;">विषय :-</td>
                <td>पनवेल महानगरपालिकेची {{ $advertise?->department?->name }} विभागाकडील {{ $advertise?->publicationType?->name }} ({{ $advertise?->printType?->name }}) वृत्तपत्रात प्रसिध्दी करणेबाबत.</td>
            </tr>
            <tr>
                <td style="width: 20%;text-align: right; vertical-align: top;">संदर्भ :-</td>
                <td>{{ $advertise->context }} दिनांक : {{ convertToMarathiNumerals(date('d-m-Y', strtotime($advertise->context_date))) }} रोजीचे पत्रान्वये.</td>
            </tr>
        </table>
    
    <br>
    <p>
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        उपरोक्त विषयान्वये कळविणेत येते की, पनवेल महानगरपालिकेची {{ $advertise?->department?->name }} विभागाकडील {{ $advertise?->publicationType?->name }} ({{ $advertise?->printType->name }}) {{ $advertise->context }} दिनांक {{ convertToMarathiNumerals(date('d-m-Y', strtotime($advertise->context_date))) }} आपल्या दैनिकात प्रसिध्द करणेस सोबत जोडली आहे, <b>तरी सदरची जाहिरात आपण आपल्या दैनिकात दिनांक {{ convertToMarathiNumerals(date('d-m-Y', strtotime($advertise->publication_date))) }} रोजीच प्रसिध्द करावी.</b>
    </p>
    <p>
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        सदर जाहीरात {{ $advertise?->bannerSize?->size }} चौ. सेमी आकारात शासकीय दराने प्रसिध्द करण्यात यावी, जाहिरात प्रसिध्द केल्यानंतर शासनमान्य दराने देयक आकारणी करुन त्या वर्तमानपत्राच्या ४ प्रतीसह पुढील कार्यवाहीसाठी जनसंपर्क विभागाकडे सादर करण्यात यावे.
    </p>
    <p>
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        जाहिरात प्रसिध्द करताना जाहिरातीखाली वरील जाहिरात क्रमांक व दिनांक टाकणे बंधनकारक आहे. देयकात ह्या वितरण जाहिरातीचा जनसंपर्क क्रमांक व दिनांक लिहावा.
    </p>
    <p>
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        पनवेल महानगरपालिकेत आपल्या वर्तमानपत्राच्या नोंदीत असलेली बँकेचा तपशील माहिती व RTGS Details देयकासोबत जोडणे अनिवार्य आहे त्याशिवाय देयके स्विकारली जाणार नाहीत.
    </p>
    <p>
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        सदरची जाहिरात जनसंपर्क विभागामार्फत दिलेल्या साईजमध्ये व योग्य त्या स्वरुपात दिलेल्या मुदतीत प्रसिध्द करावी. वरील आकारापेक्षा जास्त आकारामध्ये जाहिरात प्रसिध्द झाल्यास जादा आकाराचे देयक अदा केले जाणार नाही याची नोंद घ्यावी. PMC GSTIN :- २७AAAGP०३७२BRZQ सदर GST नंबर जाहिरात देयकावर नोंदविणे अनिवार्य आहे.
    </p>
    {{-- <div class="enddisplay">



    </div> --}}
    <br>
    <table>
        <tr>
            <td style="width: 72%">&nbsp;</td>
            <td>
                <table style="width: 100%">
                    <tr>
                        <td class='alnright'><img src="{{ public_path('storage/'.$signature) }}" style="width: 150px" alt=""></td>
                    </tr>
                    <tr>
                        <td class='alnright'><b>विभाग प्रमुख,</b></td>
                    </tr>
                    <tr>
                        <td class='alnright'><b>(जनसंपर्क विभाग)</b></td>
                    </tr>

                    <tr>
                        <td class='alnright'><b>पनवेल महानगरपालिका</b></td>
                    </tr>
                    
                </table>
            </td>
        </tr>
        <tr>
            <td colspan="2">
                <p>सोबत :- वरिलप्रमाणे जाहिरातीचा मसूदा
                <br>
                टिप :- प्रधिध्द करण्यात आलेली जाहिरातीचे वृत्तपत्रात (एकुण २ प्रती) संबंधित विभागात सादर करण्यात याव्या...</p>
            </td>
        </tr>
    </table>
                

</body>
</html>
