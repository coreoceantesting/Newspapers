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
                        <li class="breadcrumb-item active"><a href="{{ route('billing.index') }}"> बिल करा </a></li>
                        <li class="breadcrumb-item active">बिल पहा</li>
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
                                    <h5 class="text-white mt-1">बिल पहा</h5>
                                </div>
                                <div class="col-6 text-end">
                                    <a href="{{ route('billing.index') }}"><button class="btn btn-square btn-warning-gradien" type="button">परत जा <i class="fa fa-arrow-left" aria-hidden="true"></i>
                                    </button></a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive table-bordered">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th style="width:25%"><b>विभाग</b></th>
                                            <td>{{ $billing?->department?->name }}</td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <th><b>बिल क्रमांक</b></th>
                                            <td>{{ $billing->bill_number }}</td>
                                        </tr>
                                        <tr>
                                            <th><b>बिल तारीख</b></th>
                                            <td>{{ date('d-m-Y', strtotime($billing->bill_date)) }}</td>
                                        </tr>
                                        <tr>
                                            <th><b>वर्तमानपत्र नाव</b></th>
                                            <td>{{ $billing?->newsPaper?->name }}</td>
                                        </tr>
                                        <tr>
                                            <th><b>बँकेचे नाव</b></th>
                                            <td>{{ $billing?->accountDetails?->bank }}</td>
                                        </tr>
                                        <tr>
                                            <th><b>शाखेचे नाव</b></th>
                                            <td>{{ $billing?->accountDetails?->branch }}</td>
                                        </tr>
                                        <tr>
                                            <th><b>खाते क्रमांक</b></th>
                                            <td>{{ $billing?->accountDetails?->account_number }}</td>
                                        </tr>
                                        <tr>
                                            <th><b>IFSC कोड</b></th>
                                            <td>{{ $billing?->accountDetails?->ifsc_code }}</td>
                                        </tr>
                                        <tr>
                                            <th><b>पॅन कार्ड</b></th>
                                            <td>{{ $billing?->accountDetails?->pan_card }}</td>
                                        </tr>
                                        <tr>
                                            <th><b>GST क्रमांक</b></th>
                                            <td>{{ $billing?->accountDetails?->gst_no }}</td>
                                        </tr>
                                        <tr>
                                            <th><b>Basic Amount</b></th>
                                            <td>{{ $billing->basic_amount }}</td>
                                        </tr>
                                        <tr>
                                            <th><b>GST</b></th>
                                            <td>{{ $billing->gst }}</td>
                                        </tr>
                                        <tr>
                                            <th><b>Gross Amount</b></th>
                                            <td>{{ $billing->gross_amount }}</td>
                                        </tr>
                                        <tr>
                                            <th><b>TDS</b></th>
                                            <td>{{ $billing->tds }}</td>
                                        </tr>
                                        <tr>
                                            <th><b>IT</b></th>
                                            <td>
                                                {{ $billing->it }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <th><b>Net Amount</b></th>
                                            <td>{{ $billing->net_amount }}</td>
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
