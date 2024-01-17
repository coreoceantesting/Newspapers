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
                        <li class="breadcrumb-item active">Reports</li>
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
                    <div class="card-body">
                        <form action="" method="get">
                            <input type="hidden" name="search" value="search">
                            <div class="row">
                                <div class="col-lg-3 col-md-4 col-12">
                                    <label class="form-label" for="selectDepartment">Select Department</label>
                                    <select name="department" id="selectDepartment" class="form-select">
                                        <option value="">Select Department</option>
                                        @foreach ( $departments as $department )
                                            <option @if(isset(Request()->department) && $department->id == Request()->department)selected @endif value="{{ $department->id }}">{{ $department->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-lg-3 col-md-4 col-12">
                                    <label class="form-label" for="selectWorkOrderNumber">Select Work Order Number</label>
                                    <select name="work_order_number" id="selectWorkOrderNumber" class="form-select">
                                        <option value="">Select Work Order Number</option>

                                    </select>
                                </div>

                                <div class="col-lg-3 col-md-4 col-12">
                                    <label class="form-label" for="selectNewsPaper">Select News Paper</label>
                                    <select name="news_paper" id="selectNewsPaper" class="form-select">
                                        <option value="">Select News Paper</option>

                                    </select>
                                </div>
                                <div class="col-lg-3 col-md-4 col-12">
                                    <div class="form-label">&nbsp;</div>
                                    <button class="btn btn-primary">Search</button>
                                </div>
                            </div>
                        </form>

                        @if(isset(Request()->search))
                        <div class="table-responsive mt-5" id="printableArea">
                            @foreach($billing as $bill)
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
                                        <th style="width: 25%" colspan="3">GST No :- {{ $bill->gst }}<br>Pan No:- {{ $bill->pan_card }}</th>
                                    </tr>
                                    <tr align="center">
                                        <th>Work Order</th>
                                        <th><b>विभागाचे नाव व जाहिरातीचा प्रकार</b></th>
                                        <th>Sr. No.</th>
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
                                    <tr align="center">
                                        <td>जा.क्र.पमपा/जनसंपर्क/3123/प्र.क्र.{{ $bill?->advertise?->unique_number }}/443/{{ date('Y', strtotime($bill?->advertise?->publication_date)) }} दिनांक :- {{ date('d/m/Y', strtotime($bill?->advertise?->publication_date)) }}</td>
                                        <td>{{ $bill->department->name.' | '. $bill->advertise->publicationType->name }}</td>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $bill->bill_number }}</td>
                                        <td>{{ $bill->bill_date }}</td>
                                        <td>{{ $bill->basic_amount }}</td>
                                        <td>{{ $bill->gst }}</td>
                                        <td>{{ $bill->gross_amount }}</td>
                                        <td>{{ $bill->tds }}</td>
                                        <td>{{ $bill->it }}</td>
                                        <td>{{ $bill->net_amount }}</td>
                                    </tr>
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
                // ajax to check bill number is duplicate or not
                $('body').on('change', '#selectDepartment', function(){
                    let department = $(this).val();
                    if(department != ""){
                        getWorkOrderNumber(department)
                    }
                });
                let departmentId = "{{ Request()->department }}";
                if(departmentId != ""){
                    getWorkOrderNumber(departmentId)
                }
                function getWorkOrderNumber(department){
                    $.ajax({
                        url: "{{ route('get-work-order-by-department') }}",
                        type: "get",
                        data: {department : department},
                        beforeSend: function()
                        {
                            $('.ajax-loader').removeClass('d-none');
                        },
                        success: function(response){
                            if(response.status === 200){
                                let html = `<option value="">Select Work Order Number</option>`;
                                $.each(response.data, function(key, val){
                                    html += `<option value="${val.id}">${val.work_order_number}</option>`;
                                });
                                $('#selectWorkOrderNumber').html(html)
                            }else{
                                alert('Something is wrong')
                            }
                        },
                        error: function(xhr) {
                            $('.ajax-loader').addClass('d-none');
                        },
                        complete: function() {
                            $('.ajax-loader').addClass('d-none');
                        },
                    });
                }

                $('body').on('change', '#selectWorkOrderNumber', function(){
                    let workOrderNumber = $(this).val();

                    if(workOrderNumber != ""){
                        $.ajax({
                            url: "{{ route('get-news-papers-by-advertise') }}",
                            type: "get",
                            data: {workOrderNumber : workOrderNumber},
                            beforeSend: function()
                            {
                                $('.ajax-loader').removeClass('d-none');
                            },
                            success: function(response){
                                if(response.status === 200){
                                    let html = `<option value="">Select News paper</option>`;
                                    console.log(response.data)
                                    $.each(response.data, function(key, val){
                                        html += `<option value="${val.news_paper.id}">${val.news_paper.name}</option>`;
                                    });
                                    $('#selectNewsPaper').html(html)
                                }else{
                                    alert('Something is wrong')
                                }
                            },
                            error: function(xhr) {
                                $('.ajax-loader').addClass('d-none');
                            },
                            complete: function() {
                                $('.ajax-loader').addClass('d-none');
                            },
                        });
                    }
                })


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
