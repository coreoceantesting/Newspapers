<x-layout>
    <div class="container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-sm-12">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}"> <i data-feather="home"></i></a></li>
                        <li class="breadcrumb-item active"><a href="{{ route('advertise-cost.index') }}"> Bill </a></li>
                        <li class="breadcrumb-item active">Edit Bill</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!-- Container-fluid starts-->
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <form action="{{ route('billing.update', $billing->id) }}" method="post">
                    @csrf
                    @method('put')
                    <input type="hidden" name="id" value="{{ $billing->id }}">
                    <div class="card">
                        <div class="card-header border-bottom pb-2 bg-primary">
                            <h5 class="text-white item-center mb-2">Edit Bill</h5>
                        </div>

                        <div class="card-body">
                            <div class="row g-3 pb-3">
                                <div class="col-md-6 col-lg-6 col-12">
                                    <label class="form-label" for="department_id">Select Department <span class="error">*</span></label>
                                    <select name="department_id" id="selectDepartment" required class="form-select">
                                        <option value="">Select Department</option>
                                        @foreach ( $departments as $department )
                                            <option @if($billing->department_id == $department->id)selected @endif value="{{ $department->id }}">{{ $department->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('department_id')
                                        <span class="error">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-md-6 col-lg-6 col-12 workOrderNumberDiv">
                                    <label class="form-label" for="advertise_id">Work Order Number <span class="error">*</span></label>
                                    <select name="advertise_id" id="workOrderNumber" required class="form-select">
                                        <option value="">Select Work order Number</option>
                                        @foreach($workOrderNumbers as $workOrderNumber)
                                        <option @if($workOrderNumber->id == $billing->advertise_id)selected @endif value="{{ $workOrderNumber->id }}">{{ $workOrderNumber->work_order_number }}</option>
                                        @endforeach
                                    </select>
                                    @error('advertise_id')
                                        <span class="error">{{ $message }}</span>
                                    @enderror
                                </div>


                                <div class="col-12" id="advertiseDataDiv">
                                    <div class="table-responsive">
                                        <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Publication Type</th>
                                                <th>Print Type</th>
                                                <th>Banner Type</th>
                                                <th>Publication Type</th>
                                                <th>Image</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>{{ $advertise->publicationType->name }}</td>
                                                <td>{{ $advertise->printType->name }}</td>
                                                <td>{{ $advertise->bannerSize->size }}</td>
                                                <td>{{ $advertise->publication_date }}</td>
                                                <td><img src="{{ asset('storage/'.$advertise->image) }}" style="width:150px" alt="Image not found" /></td>
                                            </tr>
                                        </tbody>
                                        </table>
                                    </div>
                                    <div class="col-md-6 col-lg-6 col-12">
                                        <label class="form-label" for="news_paper_id">Select News Paper <span class="error">*</span></label>
                                        <select name="news_paper_id" required class="form-select">
                                            <option value="">Select news papers</option>
                                            @foreach($advertiseNewsPapers as $advertiseNewsPaper)
                                                <option @if($advertiseNewsPaper->newsPaper->id == $billing->news_paper_id)selected @endif value="{{ $advertiseNewsPaper->newsPaper->id }}">{{ $advertiseNewsPaper->newsPaper->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-6 col-lg-6 col-12">
                                    <label class="form-label" for="bill_number">Bill Number <span class="error">*</span></label>
                                    <input @if ($errors->has('bill_number')) class="form-control is-invalid" @else style="border: 1px solid #475ecc6b;"  @endif class="form-control"  name="bill_number" id="bill_number" type="text" placeholder="Bill Number" value="{{ $billing->bill_number }}">
                                    @error('bill_number')
                                        <span class="error">{{ $message }}</span>
                                    @enderror
                                    <div class="text-danger" id="bill_number_error"></div>
                                </div>

                                <div class="col-md-6 col-lg-6 col-12">
                                    <label class="form-label" for="bank">Bank Name <span class="error">*</span></label>
                                    <input @if ($errors->has('bank')) class="form-control is-invalid" @else style="border: 1px solid #475ecc6b;"  @endif class="form-control"  name="bank" id="bank" type="text" placeholder="Bank Name" value="{{ $billing->bank }}">
                                    @error('bank')
                                        <span class="error">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-md-6 col-lg-6 col-12">
                                    <label class="form-label" for="branch">Branch Name <span class="error">*</span></label>
                                    <input @if ($errors->has('branch')) class="form-control is-invalid" @else style="border: 1px solid #475ecc6b;"  @endif class="form-control"  name="branch" id="branch" type="text" placeholder="Branch Name" value="{{ $billing->branch }}">
                                    @error('branch')
                                        <span class="error">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-md-6 col-lg-6 col-12">
                                    <label class="form-label" for="account_number">Account Number <span class="error">*</span></label>
                                    <input @if ($errors->has('account_number')) class="form-control is-invalid" @else style="border: 1px solid #475ecc6b;"  @endif class="form-control"  name="account_number" id="account_number" type="number" placeholder="Account Number" value="{{ $billing->account_number }}">
                                    @error('account_number')
                                        <span class="error">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-md-6 col-lg-6 col-12">
                                    <label class="form-label" for="ifsc_code">IFSC Code <span class="error">*</span></label>
                                    <input @if ($errors->has('ifsc_code')) class="form-control is-invalid" @else style="border: 1px solid #475ecc6b;"  @endif class="form-control"  name="ifsc_code" id="ifsc_code" type="text" placeholder="IFSC Code" value="{{ $billing->ifsc_code }}">
                                    @error('ifsc_code')
                                        <span class="error">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-md-6 col-lg-6 col-12">
                                    <label class="form-label" for="pan_card">Pan Card No <span class="error">*</span></label>
                                    <input @if ($errors->has('pan_card')) class="form-control is-invalid" @else style="border: 1px solid #475ecc6b;"  @endif class="form-control"  name="pan_card" id="pan_card" type="text" placeholder="Pan Card" value="{{ $billing->pan_card }}">
                                    @error('pan_card')
                                        <span class="error">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-md-6 col-lg-6 col-12">
                                    <label class="form-label" for="bill_date">Bill Date <span class="error">*</span></label>
                                    <input @if ($errors->has('bill_date')) class="form-control is-invalid" @else style="border: 1px solid #475ecc6b;"  @endif class="form-control"  name="bill_date" id="bill_date" type="date" placeholder="ISTN Date" value="{{ $billing->bill_date }}">
                                    @error('bill_date')
                                        <span class="error">{{ $message }}</span>
                                    @enderror
                                </div>



                                <div class="col-md-6 col-lg-6 col-12">
                                    <label class="form-label" for="basic_amount">Basic Amount <span class="error">*</span></label>
                                    <input @if ($errors->has('basic_amount')) class="form-control is-invalid" @else style="border: 1px solid #475ecc6b;"  @endif class="form-control"  name="basic_amount" id="basic_amount" type="number" placeholder="Basic Amount" value="{{ $billing->basic_amount }}">
                                    @error('basic_amount')
                                        <span class="error">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-md-6 col-lg-6 col-12">
                                    <label class="form-label" for="gst">GST(5%) <span class="error">*</span></label>
                                    <input @if ($errors->has('gst')) class="form-control is-invalid" @else style="border: 1px solid #475ecc6b;"  @endif class="form-control" readonly name="gst" id="gst" type="number" placeholder="GST(5%)" value="{{ $billing->gst }}">
                                    @error('gst')
                                        <span class="error">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-md-6 col-lg-6 col-12">
                                    <label class="form-label" for="gross_amount">Gross Amount <span class="error">*</span></label>
                                    <input @if ($errors->has('gross_amount')) class="form-control is-invalid" @else style="border: 1px solid #475ecc6b;"  @endif readonly class="form-control" name="gross_amount" id="gross_amount" type="number" placeholder="Gross Amount" value="{{ $billing->gross_amount }}">
                                    @error('gross_amount')
                                        <span class="error">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-md-6 col-lg-6 col-12">
                                    <label class="form-label" for="tds">TDS(-2%) <span class="error">*</span></label>
                                    <input @if ($errors->has('tds')) class="form-control is-invalid" @else style="border: 1px solid #475ecc6b;"  @endif class="form-control" readonly  name="tds" id="tds" type="number" placeholder="TDS(2%)" value="{{ $billing->tds }}">
                                    @error('tds')
                                        <span class="error">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-md-6 col-lg-6 col-12">
                                    <label class="form-label" for="it">IT(-2%) <span class="error">*</span></label>
                                    <input @if ($errors->has('it')) class="form-control is-invalid" @else style="border: 1px solid #475ecc6b;"  @endif class="form-control" readonly  name="it" id="it" type="number" placeholder="IT(2%)" value="{{ $billing->it }}">
                                    @error('it')
                                        <span class="error">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-md-6 col-lg-6 col-12">
                                    <label class="form-label" for="net_amount">Net Amount <span class="error">*</span></label>
                                    <input @if ($errors->has('net_amount')) class="form-control is-invalid" @else style="border: 1px solid #475ecc6b;"  @endif class="form-control"  name="net_amount" readonly id="net_amount" type="number" placeholder="Net Amount" value="{{ $billing->net_amount }}">
                                    @error('account_number')
                                        <span class="error">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="text-end" >
                                <button class="btn btn-square btn-success-gradien" id="submitForm" type="submit">Save </button>
                                <a href="{{ route('billing.index') }}"><button class="btn btn-square btn-dark" type="button">Cancel </button></a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Container-fluid Ends-->

    @push('scripts')
        <script>
            $(document).ready(function(){
                $('body').on('change', '#selectDepartment', function(){
                    let departmentId = $(this).val()

                    if(departmentId != ""){
                        $('.workOrderNumberDiv').removeClass('d-none');
                        $.ajax({
                            url: "{{ route('get-work-order-number') }}",
                            type: "get",
                            data: {department_id : departmentId},
                            beforeSend: function()
                            {
                                $('.ajax-loader').removeClass('d-none')
                            },
                            success: function(response){
                                if(response.status === 200){
                                    let html = `<option value="">Work Order Number</option>`;
                                    $.each(response.data, function(key, val){
                                        html += `<option value="${val.id}">${val.work_order_number}</option>`;
                                    });
                                    $('#workOrderNumber').html(html)
                                }
                            },
                            error: function(xhr) {
                                $('.ajax-loader').addClass('d-none')
                            },
                            complete: function() {
                                $('.ajax-loader').addClass('d-none')
                            },
                        });
                    }else{
                        $('.workOrderNumberDiv').addClass('d-none')
                        $('#selectDepartment').val('').change();
                    }
                });


                $('body').on('keyup', '#basic_amount', function(){
                    let basicAmount = parseInt($(this).val());
                    let gst = (basicAmount * 5) / 100;
                    $('#gst').val(gst)
                    let grossAmount = basicAmount + gst;
                    $('#gross_amount').val(grossAmount);
                    let tds = (basicAmount * 2) / 100;
                    $('#tds').val(tds)
                    let it = (basicAmount * 2) / 100;
                    $('#it').val(it)
                    $('#net_amount').val(grossAmount - (tds + it))
                });


                // function to get ork order details
                $('body').on('change', '#workOrderNumber', function(){
                    var id = $(this).val();
                    if(id != ""){
                        $.ajax({
                            url: "{{ route('get-work-order-details') }}",
                            type: "get",
                            data: {id : id},
                            beforeSend: function()
                            {
                                $('.ajax-loader').removeClass('d-none');
                            },
                            success: function(response){
                                if(response.status === 200){
                                    let html = `<div class="table-responsive">
                                        <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Publication Type</th>
                                                <th>Print Type</th>
                                                <th>Banner Type</th>
                                                <th>Publication Type</th>
                                                <th>Image</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>${response.data.publication_type.name}</td>
                                                <td>${response.data.print_type.name}</td>
                                                <td>${response.data.banner_size.size}</td>
                                                <td>${response.data.publication_date}</td>
                                                <td><img src="{{ asset('storage') }}/${response.data.image}" style="width:150px" alt="Image not found" /></td>
                                            </tr>
                                        </tbody>
                                        </table>
                                    </div>`
                                    html += `
                                    <div class="col-md-6 col-lg-6 col-12">
                                    <label class="form-label" for="news_paper_id">Select Department <span class="error">*</span></label>
                                    <select name="news_paper_id" required class="form-select">
                                        <option value="">Select news papers</option>`;
                                    $.each(response.advertiseNewsPapers, function(key, val){
                                        html += `<option value="${val.news_paper.id}">${val.news_paper.name}</option>`;
                                    });

                                    html += `</select>
                                </div>`;

                                    $('#advertiseDataDiv').html(html)
                                }
                            },
                            error: function(xhr) {
                                $('.ajax-loader').addClass('d-none');
                            },
                            complete: function() {
                                $('.ajax-loader').addClass('d-none');
                            },
                        })
                    }
                })


                // ajax to check bill number is duplicate or not
                $('body').on('blur', '#bill_number', function(){
                    let billNumber = $(this).val();
                    if(billNumber != ""){
                        $.ajax({
                            url: "{{ route('check-duplicate-bill-number') }}",
                            type: "get",
                            data: {billNumber : billNumber},
                            beforeSend: function()
                            {
                                $('.ajax-loader').removeClass('d-none');
                            },
                            success: function(response){
                                console.log(response)
                                if(response.status === 200){
                                    $('#bill_number_error').html(`Bill Number ${response.data} Already Assigned`)
                                    $('#bill_number').val('')
                                    $('#submitForm').prop('disabled', true)
                                }else{
                                    $('#bill_number_error').html('')
                                    $('#submitForm').prop('disabled', false)
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
            })
        </script>
    @endpush
</x-layout>
