<x-layout>
    <div class="container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-sm-12">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}"> <i data-feather="home"></i></a></li>
                        <li class="breadcrumb-item active"><a href="{{ route('expandeture.index') }}"> खर्चाची यादी </a></li>
                        <li class="breadcrumb-item active">खर्च जोडा</li>
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
                            <h5 class="text-white item-center mb-2">खर्च जोडा</h5>
                        </div>

                        <div class="card-body">
                            <div class="row g-3 pb-3">
                                <div class="col-md-6 col-lg-6 col-12">
                                    <label class="form-label" for="billingId">बिल निवडा <span class="error">*</span></label>
                                    <select name="billing_id" id="billingId" required class="form-select">
                                        <option value="">बिल निवडा</option>
                                        @foreach($bills as $bill)
                                        <option value="{{ $bill->id }}">{{ $bill->bill_number }}</option>
                                        @endforeach
                                    </select>
                                    @error('billing_id')
                                        <span class="error">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-md-6 col-lg-6 col-12">
                                    <input type="hidden" name="news_paper_id" id="news_paper_id ">
                                    <label class="form-label" for="news_paper_name">वर्तमानपत्र नाव <span class="error">*</span></label>
                                    <input type="hidden" id="news_paper_id" name="news_paper_id">
                                    <input @if ($errors->has('news_paper_name')) class="form-control is-invalid" @else style="border: 1px solid #475ecc6b;"  @endif class="form-control"  name="news_paper_name" id="news_paper_name" type="text" readonly placeholder="वर्तमानपत्र नाव" required>
                                    @error('news_paper_name')
                                        <span class="error">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-md-6 col-lg-6 col-12">
                                    <label class="form-label" for="invoice_amount">देयाकावारची रक्कम <span class="error">*</span></label>
                                    <input @if ($errors->has('invoice_amount')) class="form-control is-invalid" @else style="border: 1px solid #475ecc6b;"  @endif class="form-control"  name="invoice_amount" id="invoice_amount" type="text" readonly placeholder="देयाकावारची रक्कम" required>
                                    @error('invoice_amount')
                                        <span class="error">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-md-6 col-lg-6 col-12">
                                    <label class="form-label" for="other_charges">इतर शुल्क <span class="error">*</span></label>
                                    <input @if ($errors->has('other_charges')) class="form-control is-invalid" @else style="border: 1px solid #475ecc6b;"  @endif class="form-control"  name="other_charges" id="other_charges" type="text" readonly placeholder="इतर शुल्क" required>
                                    @error('other_charges')
                                        <span class="error">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-md-6 col-lg-6 col-12">
                                    <label class="form-label" for="net_amount">निव्वळ रक्कम <span class="error">*</span></label>
                                    <input @if ($errors->has('net_amount')) class="form-control is-invalid" @else style="border: 1px solid #475ecc6b;"  @endif class="form-control"  name="net_amount" id="net_amount" type="text" readonly placeholder="निव्वळ रक्कम" required>
                                    @error('net_amount')
                                        <span class="error">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-md-6 col-lg-6 col-12">
                                    <label class="form-label" for="progressive_expandetures">प्रगतीशील खर्च <span class="error">*</span></label>
                                    <input @if ($errors->has('progressive_expandetures')) class="form-control is-invalid" @else style="border: 1px solid #475ecc6b;"  @endif class="form-control"  name="progressive_expandetures" id="progressive_expandetures" type="text" readonly placeholder="प्रगतीशील खर्च" required>
                                    @error('progressive_expandetures')
                                        <span class="error">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-md-6 col-lg-6 col-12">
                                    <label class="form-label" for="balance">पुढील खर्चासाठी शिल्लक <span class="error">*</span></label>
                                    <input @if ($errors->has('balance')) class="form-control is-invalid" @else style="border: 1px solid #475ecc6b;"  @endif class="form-control"  name="balance" id="balance" type="text" readonly placeholder="पुढील खर्चासाठी शिल्लक" required>
                                    @error('balance')
                                        <span class="error">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="text-end" >
                                <button onClick="return confirm('A bill cannot be edited and deleted once an expandature is created')" class="btn btn-square btn-success-gradien" type="submit">जतन करा </button>
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
                                $('#news_paper_name').val(response.data.newsPaperName)
                                $('#invoice_amount').val(response.data.invoiceAmount)
                                $('#other_charges').val(response.data.otherCharges)
                                $('#net_amount').val(response.data.netAmount)
                                $('#progressive_expandetures').val(response.data.prograssiveExpendature)
                                $('#balance').val(response.data.balance)
                                $('#news_paper_id ').val(response.data.newsPaperId)
                            }else{
                                alert('Something went wrong.')
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
