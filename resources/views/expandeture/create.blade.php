<x-layout>
    <div class="container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-sm-12">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}"> <i data-feather="home"></i></a></li>
                        <li class="breadcrumb-item active"><a href="{{ route('expandeture.index') }}"> Expandeture </a></li>
                        <li class="breadcrumb-item active">Add Expandeture</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!-- Container-fluid starts-->
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <form action="{{ route('expandeture.store') }}" method="post">
                    @csrf
                    <div class="card">
                        <div class="card-header border-bottom pb-2 bg-primary">
                            <h5 class="text-white item-center mb-2">Add Expandeture</h5>
                        </div>

                        <div class="card-body">
                            <div class="row g-3 pb-3">
                                <div class="col-md-6 col-lg-6 col-12">
                                    <label class="form-label" for="billing_id">Select Bill <span class="error">*</span></label>
                                    <select name="billing_id" id="billingId" required class="form-select">
                                        <option value="">Select Bill</option>
                                        @foreach($bills as $bill)
                                        <option value="{{ $bill->id }}">{{ $bill->bill_number }}</option>
                                        @endforeach
                                    </select>
                                    @error('billing_id')
                                        <span class="error">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-md-6 col-lg-6 col-12">
                                    <label class="form-label" for="news_paper_name">News paper <span class="error">*</span></label>
                                    <input type="hidden" id="news_paper_id" name="news_paper_id">
                                    <input @if ($errors->has('news_paper_name')) class="form-control is-invalid" @else style="border: 1px solid #475ecc6b;"  @endif class="form-control"  name="news_paper_name" id="news_paper_name" type="text" readonly placeholder="invoice Amount" value="1256" required>
                                    @error('news_paper_name')
                                        <span class="error">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-md-6 col-lg-6 col-12">
                                    <label class="form-label" for="invoice_amount">Invoice Amount <span class="error">*</span></label>
                                    <input @if ($errors->has('invoice_amount')) class="form-control is-invalid" @else style="border: 1px solid #475ecc6b;"  @endif class="form-control"  name="invoice_amount" id="invoice_amount" type="text" readonly placeholder="invoice Amount" value="1256" required>
                                    @error('invoice_amount')
                                        <span class="error">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-md-6 col-lg-6 col-12">
                                    <label class="form-label" for="other_charges">Other Changes <span class="error">*</span></label>
                                    <input @if ($errors->has('other_charges')) class="form-control is-invalid" @else style="border: 1px solid #475ecc6b;"  @endif class="form-control"  name="other_charges" id="other_charges" type="text" readonly placeholder="Other Changes" value="1256" required>
                                    @error('other_charges')
                                        <span class="error">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-md-6 col-lg-6 col-12">
                                    <label class="form-label" for="net_amount">Net Amount <span class="error">*</span></label>
                                    <input @if ($errors->has('net_amount')) class="form-control is-invalid" @else style="border: 1px solid #475ecc6b;"  @endif class="form-control"  name="net_amount" id="net_amount" type="text" readonly placeholder="Net Amount" value="1256" required>
                                    @error('net_amount')
                                        <span class="error">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-md-6 col-lg-6 col-12">
                                    <label class="form-label" for="progressive_expandetures">Progressive expenditure <span class="error">*</span></label>
                                    <input @if ($errors->has('progressive_expandetures')) class="form-control is-invalid" @else style="border: 1px solid #475ecc6b;"  @endif class="form-control"  name="progressive_expandetures" id="progressive_expandetures" type="text" readonly placeholder="Progressive expenditure" value="1256" required>
                                    @error('progressive_expandetures')
                                        <span class="error">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-md-6 col-lg-6 col-12">
                                    <label class="form-label" for="balance">Balance For Further Expendature <span class="error">*</span></label>
                                    <input @if ($errors->has('balance')) class="form-control is-invalid" @else style="border: 1px solid #475ecc6b;"  @endif class="form-control"  name="balance" id="balance" type="text" readonly placeholder="Balance For Further Expendature" value="1256" required>
                                    @error('balance')
                                        <span class="error">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="text-end" >
                                <button class="btn btn-square btn-success-gradien" type="submit">जतन करा </button>
                                <a href="{{ route('expandeture.index') }}"><button class="btn btn-square btn-dark" type="button">रद्द करा </button></a>
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
            $('body').on('change', '#billingId', function(){
                let bill = $(this).val();
                if(bill != ""){
                    $.ajax({
                        url: "{{ route('get-billing-details-for-expandature') }}",
                        type: "get",
                        data: {bill : bill},
                        beforeSend: function()
                        {
                            $('.ajax-loader').removeClass('d-none');
                        },
                        success: function(response){
                            if(response.status === 200){
                                let basicAmount = parseInt(response.tds);
                                let otherCharges = parseInt(response.tds) + parseInt(response.it);
                                let netAmount = otherCharges - parseInt(response.basic_amount);
                                $('#news_paper_name').val(response.news_paper.name)
                                $('#news_paper_id').val(response.news_paper.id)
                                $('#invoice_amount').val(basicAmount)
                                $('#other_charges').val(otherCharges)
                                $('#net_amount').val(netAmount)
                                $('#').val(response.)
                                $('#').val(response.)
                                $('#').val(response.)
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
        });
    </script>
    @endpush
</x-layout>
