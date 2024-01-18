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
                        <li class="breadcrumb-item active">अहवाल</li>
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
                                    <label class="form-label" for="selectDepartment">विभाग निवडा</label>
                                    <select name="department" id="selectDepartment" class="form-select">
                                        <option value="">विभाग निवडा</option>
                                        @foreach ( $departments as $department )
                                            <option @if(isset(Request()->department) && $department->id == Request()->department)selected @endif value="{{ $department->id }}">{{ $department->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-lg-3 col-md-4 col-12">
                                    <label class="form-label" for="selectWorkOrderNumber">वर्क ऑर्डर नंबर निवडा</label>
                                    <select name="work_order_number" id="selectWorkOrderNumber" class="form-select">
                                        <option value="">वर्क ऑर्डर नंबर निवडा</option>

                                    </select>
                                </div>

                                <div class="col-lg-3 col-md-4 col-12">
                                    <label class="form-label" for="selectNewsPaper">वृत्तपत्र निवडा</label>
                                    <select name="news_paper" id="selectNewsPaper" class="form-select">
                                        <option value="">वृत्तपत्र निवडा</option>

                                    </select>
                                </div>
                                <div class="col-lg-3 col-md-4 col-12">
                                    <div class="form-label">&nbsp;</div>
                                    <button class="btn btn-primary">शोधा</button>
                                </div>
                            </div>
                        </form>

                        @if(isset(Request()->search))
                        <div class="table-responsive mt-5" id="printableArea">
                            @foreach($billings as $bill)
                            <table class="table table-bordered">

                                <tbody>
                                    <tr align="center">
                                        <td colspan="11"><h3>{{ $bill->newsPaper->name }}</h3></td>
                                    </tr>
                                    <tr align="center">
                                        <th style="width: 20%">
                                            बँकेचे नाव :- {{ $bill->bank }}<br>
                                            शाखा :- {{ $bill->branch }}
                                        </th>
                                        <th style="width: 30%" colspan="4">खाते क्रमांक : {{ $bill->account_number }}</th>
                                        <th style="width: 25%" colspan="3">बँक शाखा IFSC कोड :- {{ $bill->ifsc_code }}</th>
                                        <th style="width: 25%" colspan="3">GST No :- {{ $bill->gst_no }}<br>Pan No:- {{ $bill->pan_card }}</th>
                                    </tr>
                                    <tr align="center">
                                        <th>काम पुर्ण करण्यचा क्रम</th>
                                        <th>विभागाचे नाव व जाहिरातीचा प्रकार</th>
                                        <th>क्र.</th>
                                        <th>बिल क्र.</th>
                                        <th>तारीख</th>
                                        <th>मूळ रक्कम</th>
                                        <th>5% GST/SGST</th>
                                        <th>एकूण रक्कम</th>
                                        <th>2% TDS</th>
                                        <th>2% IT</th>
                                        <th>निव्वळ रक्कम</th>
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
                                        <td>{{ $bill->gst }}</td>
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
                                let html = `<option value="">वर्क ऑर्डर नंबर निवडा</option>`;
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
                                    let html = `<option value="">वृत्तपत्र निवडा</option>`;
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
