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
            font-size: 11px;
            margin: 0px
        }
        p{
            font-size: 13px;
        }
        .enddisplay{
            display: flex;
            justify-content: end;
        }
        td{
            font-size:15px;
        }

        body {
	font-family: 'examplefont', sans-serif;
}

    </style>

<script src="https://printjs.crabbly.com/print.min.js"></script>

</head>
<body>
    <img src="{{ public_path('image/header.png') }}" alt="">
    <p class="headerP">
       कार्यालय: २७४५८०४०/४१/४९
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        पीक्स नं.: ०२२-२७४५२२३३
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        Email: panvelcorporation@gmail.com

        <hr>
        जा.क्र. पमपा/ जनसंपर्क./३१२३/प्र.क्र.४३६/४९४/२०२३
    </p>
    <p>
        प्रति,<br>
        जाहिरात व्यवस्थापक,<br>
        दै. रायगड टाईम्स<br>
    </p>
    <p>
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        विषय :- पनवेल महानगरपालिकेची माहिती व तंत्रज्ञान विभागाकडील जाहिर सुचना (कृष्णधवल) वृत्तपत्रात प्रसिध्दी करणेबाबत.
        <br>
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        संदर्भ:- जा.क्र. पमपा/मातंवि/२२२३/प्र.क्र.४/१८४/२०२३ दिनांक : ०३/११/२०२३ रोजीचे पत्रान्वये.
    </p>
    <p>
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        उपरोक्त विषयान्वये कळविणेत येते की, पनवेल महानगरपालिकेची माहिती व तंत्रज्ञान विभागाकडील जाहिर सुचना (कृष्णधवल) पमपा/मार्तवि/२२२३/प्र.क्र.४/१८४/२०२३ दिनांक ०३/११/२०२३ आपल्या दैनिकात प्रसिध्द करणेस सोबत जोडली आहे, तरी सदरची जाहिरात आपण आपल्या दैनिकात दिनांक ०४/११/२०२३ रोजीच प्रसिध्द करावी.
        <br>
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        सदर जाहीरात ८ X ६ चौ. सेमी आकारात शासकीय दराने प्रसिध्द करण्यात यावी, जाहिरात प्रसिध्द केल्यानंतर शासनमान्य दराने देयक आकारणी करुन त्या वर्तमानपत्राच्या ४ प्रतीसह पुढील कार्यवाहीसाठी जनसंपर्क विभागाकडे सादर करण्यात यावे. जाहिरात प्रसिध्द करताना जाहिरातीखाली वरील जाहिरात क्रमांक व दिनांक टाकणे बंधनकारक आहे. देयकात ह्या वितरण जाहिरातीचा जनसंपर्क क्रमांक व दिनांक लिहावा.
        <br>
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        पनवेल महानगरपालिकेत आपल्या वर्तमानपत्राच्या नोंदीत असलेली बँकेचा तपशील माहिती व RTGS Details देयकासोबत जोडणे अनिवार्य आहे त्याशिवाय देयके स्विकारली जाणार नाहीत.
        <br>
        सदरची जाहिरात जनसंपर्क विभागामार्फत दिलेल्या साईजमध्ये व योग्य त्या स्वरुपात दिलेल्या मुदतीत प्रसिध्द करावी. वरील आकारापेक्षा जास्त आकारामध्ये जाहिरात प्रसिध्द झाल्यास जादा आकाराचे देयक अदा केले जाणार नाही याची नोंद घ्यावी. PMC GSTIN :- २७AAAGP०३७२BRZQ सदर GST नंबर जाहिरात देयकावर नोंदविणे अनिवार्य आहे.
    </p>
    {{-- <div class="enddisplay">



    </div> --}}
    <table align="right">
        <tr>
            <td><b>विभाग प्रमुख, &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b></td>
        </tr>
        <tr>
            <td><b>(जनसंपर्क विभाग)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b></td>
        </tr>
        <tr>
            <td><b>पनवेल महानगरपालिका&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b></td>
        </tr>
    </table>

    <button onclick="downloadPdf()">Download PDF</button>

    <script>
        function downloadPdf() {
            // Use Print.js to trigger the PDF download
            printJS({ printable: '/download-pdf', type: 'pdf', showModal: true });
        }
    </script>
</body>
</html>
