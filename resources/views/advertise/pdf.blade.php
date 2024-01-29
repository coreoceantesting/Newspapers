<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        .headerP{
            font-size: 13px;
            margin: 0px;
            margin-top: 10px;
        }
        p{
            font-size: 15px;
        }
        td{
            font-size:18px;
        }

        body {
            font-family: 'freeserif', 'normal';
        }
        hr{
            margin: 0;
        }
        .alnright { text-align: right; }

    </style>

</head>
<body>
    <img src="{{ public_path('image/header.png') }}" alt="">
    <p class="headerP">
       कार्यालय: २७४५८०४०/४१/४२
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        पीक्स नं.: ०२२-२७४५२२३३
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        Email: panvelcorporation@gmail.com

        <hr>
        <span>जा.क्र. पमपा/ जनसंपर्क./३१२३/प्र.क्र.{{ $advertise->unique_number }}/४९४/{{ date('d-m-Y') }} </span>
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <span>दिनांक:- ---/{{ date('m') }}/{{ date('Y') }}</span>
    </p>
    <p>
        प्रति,<br>
        जाहिरात व्यवस्थापक,<br>
        @php $count = count($advertise->advertiseNewsPapers); @endphp
        @foreach($advertise->advertiseNewsPapers as $newsPaper)
        {{ $newsPaper->newsPaper->name }}@if($loop->iteration != $count), @endif

        <br>
        @endforeach
    </p>
    <p>
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        विषय :- पनवेल महानगरपालिकेची {{ $advertise?->department?->name }} विभागाकडील {{ $advertise?->publicationType?->name }} ({{ $advertise?->printType?->name }}) वृत्तपत्रात प्रसिध्दी करणेबाबत.
        <br>
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        संदर्भ:- जा.क्र. पमपा/-----/-----/प्र.क्र.-----/-----/{{ date('Y') }} दिनांक : {{ date('d-m-Y', strtotime($advertise->publication_date)) }} रोजीचे पत्रान्वये.
    </p>
    <br>
    <p>
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        उपरोक्त विषयान्वये कळविणेत येते की, पनवेल महानगरपालिकेची {{ $advertise?->department?->name }} विभागाकडील {{ $advertise?->publicationType?->name }} ({{ $advertise?->printType->name }}) पमपा/-----/-----/प्र.क्र.----/----/{{ date('Y') }} दिनांक ----/----/{{ date('Y') }} आपल्या दैनिकात प्रसिध्द करणेस सोबत जोडली आहे, <b>तरी सदरची जाहिरात आपण आपल्या दैनिकात दिनांक ----/----/{{ date('Y') }} रोजीच प्रसिध्द करावी.</b>
    </p>
    <p>
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        सदर जाहीरात {{ $advertise?->bannerSize?->size }} चौ. सेमी आकारात शासकीय दराने प्रसिध्द करण्यात यावी, जाहिरात प्रसिध्द केल्यानंतर शासनमान्य दराने देयक आकारणी करुन त्या वर्तमानपत्राच्या ४ प्रतीसह पुढील कार्यवाहीसाठी जनसंपर्क विभागाकडे सादर करण्यात यावे.
    </p>
    <p>
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        जाहिरात प्रसिध्द करताना जाहिरातीखाली वरील जाहिरात क्रमांक व दिनांक टाकणे बंधनकारक आहे. देयकात ह्या वितरण जाहिरातीचा जनसंपर्क क्रमांक व दिनांक लिहावा.
    </p>
    <p>
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        पनवेल महानगरपालिकेत आपल्या वर्तमानपत्राच्या नोंदीत असलेली बँकेचा तपशील माहिती व RTGS Details देयकासोबत जोडणे अनिवार्य आहे त्याशिवाय देयके स्विकारली जाणार नाहीत.
    </p>
    <p>
        सदरची जाहिरात जनसंपर्क विभागामार्फत दिलेल्या साईजमध्ये व योग्य त्या स्वरुपात दिलेल्या मुदतीत प्रसिध्द करावी. वरील आकारापेक्षा जास्त आकारामध्ये जाहिरात प्रसिध्द झाल्यास जादा आकाराचे देयक अदा केले जाणार नाही याची नोंद घ्यावी. PMC GSTIN :- २७AAAGP०३७२BRZQ सदर GST नंबर जाहिरात देयकावर नोंदविणे अनिवार्य आहे.
    </p>
    {{-- <div class="enddisplay">



    </div> --}}
    <br>
    <br>
    <table style="width: 100%">
        <tr>
            <td colspan="2" class='alnright'><b>विभाग प्रमुख, &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b></td>
        </tr>
        <tr>
            <td colspan="2" class='alnright'><b>(जनसंपर्क विभाग)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b></td>
        </tr>
        <tr>
            <td>सोबत :- वरिलप्रमाणे जाहिरातीचा मसूदा</td>
            <td class='alnright'>
                <b>पनवेल महानगरपालिका&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b>
                <br>
                <img src="{{ public_path('storage/'.$signature) }}" style="width: 150px" alt="">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            </td>
        </tr>
    </table>



</body>
</html>
