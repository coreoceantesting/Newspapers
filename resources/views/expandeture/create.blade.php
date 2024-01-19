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
                                    <select name="billing_id" required class="form-select">
                                        <option value="">Select Bill</option>
                                        <option value="">12456456</option>
                                        <option value="">12456456</option>
                                    </select>
                                    @error('billing_id')
                                        <span class="error">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-md-6 col-lg-6 col-12">
                                    <label class="form-label" for="billing_id">Select Paper <span class="error">*</span></label>
                                    <select name="billing_id" required class="form-select">
                                        <option value="">Select Paper</option>
                                        <option value="">17 X 45</option>
                                        <option value="">60 X 78</option>
                                    </select>
                                    @error('billing_id')
                                        <span class="error">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-md-6 col-lg-6 col-12">
                                    <label class="form-label" for="from_date">Invoice Amount <span class="error">*</span></label>
                                    <input @if ($errors->has('from_date')) class="form-control is-invalid" @else style="border: 1px solid #475ecc6b;"  @endif class="form-control"  name="from_date" id="from_date" type="text" readonly placeholder="invoice Amount" value="1256" required>
                                    @error('from_date')
                                        <span class="error">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-md-6 col-lg-6 col-12">
                                    <label class="form-label" for="from_date">Other Changes <span class="error">*</span></label>
                                    <input @if ($errors->has('from_date')) class="form-control is-invalid" @else style="border: 1px solid #475ecc6b;"  @endif class="form-control"  name="from_date" id="from_date" type="text" readonly placeholder="Other Changes" value="1256" required>
                                    @error('from_date')
                                        <span class="error">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-md-6 col-lg-6 col-12">
                                    <label class="form-label" for="from_date">Net Amount <span class="error">*</span></label>
                                    <input @if ($errors->has('from_date')) class="form-control is-invalid" @else style="border: 1px solid #475ecc6b;"  @endif class="form-control"  name="from_date" id="from_date" type="text" readonly placeholder="Net Amount" value="1256" required>
                                    @error('from_date')
                                        <span class="error">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-md-6 col-lg-6 col-12">
                                    <label class="form-label" for="from_date">Progressive expenditure <span class="error">*</span></label>
                                    <input @if ($errors->has('from_date')) class="form-control is-invalid" @else style="border: 1px solid #475ecc6b;"  @endif class="form-control"  name="from_date" id="from_date" type="text" readonly placeholder="Progressive expenditure" value="1256" required>
                                    @error('from_date')
                                        <span class="error">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-md-6 col-lg-6 col-12">
                                    <label class="form-label" for="from_date">Balance For Further Expendature <span class="error">*</span></label>
                                    <input @if ($errors->has('from_date')) class="form-control is-invalid" @else style="border: 1px solid #475ecc6b;"  @endif class="form-control"  name="from_date" id="from_date" type="text" readonly placeholder="Balance For Further Expendature" value="1256" required>
                                    @error('from_date')
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
</x-layout>
