<x-layout>
    <div class="container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-sm-12">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}"> <i data-feather="home"></i></a></li>
                        <li class="breadcrumb-item active"><a href="{{ route('financial-year.index') }}">List Financial Year (आर्थिक वर्षांची यादी) </a></li>
                        <li class="breadcrumb-item active">Edit Financial Year (आर्थिक वर्ष संपादित करा)</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!-- Container-fluid starts-->
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <form action="{{ route('financial-year.update', $financialYear->id) }}" method="post">
                    @csrf
                    @method('put')
                    <input type="hidden" name="id" id="id" value="{{ $financialYear->id }}">
                    <div class="card">
                        <div class="card-header border-bottom pb-2 bg-primary">
                            <h5 class="text-white item-center mb-2">Edit Financial Year (आर्थिक वर्ष संपादित करा)</h5>
                        </div>

                        <div class="card-body">
                            <div class="row g-3 pb-3">


                                <div class="col-md-6 col-lg-6 col-12">
                                    <label class="form-label" for="from_date">Start Date (या तारखेपासून) <span class="error">*</span></label>
                                    <input @if ($errors->has('from_date')) class="form-control is-invalid" @else style="border: 1px solid #475ecc6b;"  @endif class="form-control"  name="from_date" id="from_date" type="date" placeholder="वर्ष" value="{{ date('Y-m-d', strtotime($financialYear->from_date)) }}" required>
                                    @error('from_date')
                                        <span class="error">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-md-6 col-lg-6 col-12">
                                    <label class="form-label" for="to_date">End Date (आजपर्यंत) <span class="error">*</span></label>
                                    <input @if ($errors->has('to_date')) class="form-control is-invalid" @else style="border: 1px solid #475ecc6b;"  @endif class="form-control"  name="to_date" id="to_date" type="date" value="{{ date('Y-m-d', strtotime($financialYear->to_date)) }}" placeholder="वर्ष" required>
                                    @error('to_date')
                                        <span class="error">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-md-6 col-lg-6 col-12">
                                    <label class="form-label" for="year">Year (वर्ष) <span class="error">*</span></label>
                                    <input @if ($errors->has('year')) class="form-control is-invalid" @else style="border: 1px solid #475ecc6b;"  @endif class="form-control"  name="year" id="year" type="text" placeholder="वर्ष" value="{{ $financialYear->year }}" required>
                                    @error('year')
                                        <span class="error">{{ $message }}</span>
                                    @enderror
                                </div>


                                <div class="col-md-6 col-lg-6 col-12">
                                    <label class="form-label" for="sequence">Sequence No (क्रम)</label>
                                    <input @if ($errors->has('sequence')) class="form-control is-invalid" @else style="border: 1px solid #475ecc6b;"  @endif class="form-control"  name="sequence" id="sequence" type="number" placeholder="क्रम" value="{{ $financialYear->sequence }}" >
                                    @error('sequence')
                                        <span class="error">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-md-6 col-lg-6 col-12">
                                    <label class="form-label" for="status">Select status (स्थिती निवडा) <span class="error">*</span></label>
                                    <select name="status" required class="form-select">
                                        <option {{ ($financialYear->is_active == "0") ? 'selected' : '' }} value="0">Inactive</option>
                                        <option {{ ($financialYear->is_active == "1") ? 'selected' : '' }} value="1">Active</option>
                                    </select>
                                    @error('status')
                                        <span class="error">{{ $message }}</span>
                                    @enderror
                                </div>


                            </div>

                            <div class="text-end" >
                                <button class="btn btn-square btn-success-gradien" type="submit">Submit (जतन करा) </button>
                                <a href="{{ route('financial-year.index') }}"><button class="btn btn-square btn-dark" type="button">Cancel (रद्द करा) </button></a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Container-fluid Ends-->
</x-layout>
