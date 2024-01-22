<x-layout>
    <style>
        .select2-container--bgform .select2-selection--multiple .select2-selection__choice {
    clear: both;
}
    </style>
    <div class="container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-sm-12">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}"> <i data-feather="home"></i></a></li>
                        <li class="breadcrumb-item active"><a href="{{ route('advertise.index') }}"> जाहिरात करा </a></li>
                        <li class="breadcrumb-item active">जाहिरात पहा</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!-- Container-fluid starts-->
    <div class="container-fluid">
        <div class="select2-drpdwn">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-header border-bottom bg-primary pt-3 pb-1">
                            <div class="row">
                                <div class="col-6">
                                    <h5 class="text-white mt-1">जाहिरात पहा</h5>
                                </div>
                                <div class="col-6 text-end">
                                    <a href="{{ route('advertise.index') }}"><button class="btn btn-square btn-warning-gradien" type="button">परत जा <i class="fa fa-arrow-left" aria-hidden="true"></i>
                                    </button></a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            @php $newsPaperEmail = "";$newsPaperName = ""; @endphp
                            @foreach($newsPapers as $newsPaper)
                            @php
                                $emails = explode(',', $newsPaper->email);
                                $names = explode(',', $newsPaper->name);
                                foreach($emails as $email){
                                    $newsPaperEmail .= $email. ",  ";
                                }
                                foreach($names as $name){
                                    $newsPaperName .= $name. ",  ";
                                }
                            @endphp


                            @endforeach
                            <div class="table-responsive table-bordered">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>वर्तमानपत्र नाव</th>
                                            <td>{{ $newsPaperName }}</td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <th>वर्तमानपत्र ईमेल</th>
                                            <td>{{ $newsPaperEmail }}</td>
                                        </tr>
                                        <tr>
                                            <th>ईमेल विषय</th>
                                            <td>{{ $advertise->email_subject }}</td>
                                        </tr>
                                        <tr>
                                            <th>ईमेल वर्णन</th>
                                            <td>{{ $advertise->email_description }}</td>
                                        </tr>
                                        <tr>
                                            <th>PDF पहा</th>
                                            <td><a href="{{ asset('storage/'.$advertise->generate_pdf_url) }}" class="btn btn-primary" target="_blank">PDF</a></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Container-fluid Ends-->

</x-layout>
