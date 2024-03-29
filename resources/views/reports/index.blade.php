<x-layout>
    @push('styles')
    <style>
        @media print {
            /* Hide header */
            header {
                display: none;
            }

            /* Hide page title */
            title {
                display: none;
            }

            /* Hide footer link */
            footer a {
                display: none;
            }
        }
    </style>
    @endpush
    <div class="container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-sm-6">
                    {{-- <h5>Newspaper Department</h5> --}}
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}"> <i data-feather="home"></i></a></li>
                        <li class="breadcrumb-item">Report (अहवाल)</li>
                        <li class="breadcrumb-item active">Bill Report (बिल अहवाल)</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!-- Container-fluid starts-->

    <!-- Container-fluid starts-->
    <div class="container-fluid">
        <div class="row">
            <!-- Zero Configuration  Starts-->
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header border-bottom pb-2">
                        <h5 class="card-title">Bill Report (बिल अहवाल)</h5>
                    </div>
                    <div class="card-body">
                        <form action="" method="get">
                            <input type="hidden" name="search" value="search">
                            <div class="row">
                                <div class="col-lg-3 col-md-4 col-12">
                                    <label class="form-label" for="news_paper">Select Newspaper (वर्तमानपत्र निवडा)</label>
                                    <select name="news_paper" id="news_paper" class="js-example-basic-single col-sm-12 select2-hidden-accessible">
                                        <option value="">Select Newspaper (वर्तमानपत्र निवडा)</option>
                                        @foreach ( $newsPapers as $newsPaper )
                                            <option @if(isset(Request()->news_paper) && $newsPaper->id == Request()->news_paper)selected @endif value="{{ $newsPaper->id }}">{{ $newsPaper->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-lg-3 col-md-4 col-12">
                                    <label class="form-label" for="selectWorkOrderNumber">Start Date (या तारखेपासून)</label>
                                    <input type="date" value="@if(isset(Request()->from)){{ date('Y-m-d', strtotime(Request()->from)) }}@endif" name="from" class="form-control p-1" id="from">
                                </div>

                                <div class="col-lg-3 col-md-4 col-12">
                                    <label class="form-label" for="selectWorkOrderNumber">End Date (आजपर्यंत)</label>
                                    <input type="date" value="@if(isset(Request()->to)){{ date('Y-m-d', strtotime(Request()->to)) }}@endif" name="to" class="form-control p-1" id="to">
                                </div>
                                <div class="col-lg-3 col-md-4 col-12">
                                    <label class="form-label" for="status">Select Bill Status (बिल स्थिती निवडा)</label>
                                    <select name="status" id="status" class="js-example-basic-single col-sm-12 select2-hidden-accessible">
                                        <option value="">Select Bill Status</option>
                                        <option @if(isset(Request()->status) && "1" == Request()->status)selected @endif value="1">Paid</option>
                                        <option @if(isset(Request()->status) && "0" == Request()->status)selected @endif value="0">Unpaid</option>

                                    </select>
                                </div>
                                <div class="col-lg-12 col-md-12 col-12 d-flex justify-content-center">
                                    <div class="form-label">&nbsp;</div>
                                    <button class="btn btn-primary p-1" style="font-size: 12px">Search (शोधा)</button>
                                </div>
                            </div>
                        </form>

                        @if(isset(Request()->search) && count($billings) > 0)
                        <div class="table-responsive mt-5" id="printableArea">
                            @foreach($billings as $bill)
                            <table class="table table-bordered">

                                <tbody>
                                    <tr align="center">
                                        <td colspan="11"><h3>{{ $bill->newsPaper->name }}</h3></td>
                                    </tr>
                                    <tr align="center">
                                        <th style="width: 20%">
                                            Bank Name :- {{ $bill->bank }}<br>
                                            Branch :- {{ $bill->branch }}
                                        </th>
                                        <th style="width: 30%" colspan="4">Account Number : {{ $bill->account_number }}</th>
                                        <th style="width: 25%" colspan="3">Bank Branch IFSC Code :- {{ $bill->ifsc_code }}</th>
                                        <th style="width: 25%" colspan="3">GST NO :- {{ $bill->gst_no }}<br>PAN No :- {{ $bill->pan_card }}</th>
                                    </tr>
                                    <tr align="center">
                                        <th>Work Order</th>
                                        <th><b>विभागाचे नाव व जाहिरातीचा प्रकार</b></th>
                                        <th>Sr.No.</th>
                                        <th>Bill No.</th>
                                        <th>Date</th>
                                        <th>Basic Amount</th>
                                        <th>5% GST/SGST</th>
                                        <th>Gross Amount</th>
                                        <th>2% TDS</th>
                                        <th>2% IT</th>
                                        <th>Net Amount</th>
                                    </tr>
                                    <tr align="center">
                                        @for($i=1; $i <= 11; $i++)
                                        <th>{{ $i }}</th>
                                        @endfor
                                    </tr>
                                    @foreach($bill->billing as $bills)
                                    <tr align="center">
                                        <td>जा.क्र.पमपा/जनसंपर्क/3123/प्र.क्र.{{ $bills?->advertise?->unique_number }}/443/{{ date('Y', strtotime($bills?->advertise?->publication_date)) }} दिनांक :- {{ date('d/m/Y', strtotime($bills?->advertise?->publication_date)) }}</td>
                                        <td>{{ $bills?->department?->name.' | '. $bills?->advertise?->publicationType->name }}</td>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $bills?->bill_number }}</td>
                                        <td>{{ date('d-m-Y', strtotime($bills?->bill_date)) }}</td>
                                        <td>{{ $bills?->basic_amount }}</td>
                                        <td>{{ $bills?->gst }}</td>
                                        <td>{{ $bills?->gross_amount }}</td>
                                        <td>{{ $bills?->tds }}</td>
                                        <td>{{ $bills?->it }}</td>
                                        <td>{{ $bills?->net_amount }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <br>
                            @endforeach
                        </div>
                        <div class="d-flex justify-content-end">
                            <button class="btn btn-primary" id="printButton">Print</button>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            $(document).ready(function(){
                $('#printButton').on('click', function() {
                    // Call printContent function
                    printDiv('printableArea');
                });
                function printDiv(divId) {
                    var printContents = document.getElementById(divId).innerHTML;
                    var originalContents = document.body.innerHTML;

                    document.body.innerHTML = printContents;

                    window.print();

                    document.body.innerHTML = originalContents;
                }
            })
        </script>
    @endpush
</x-layout>
