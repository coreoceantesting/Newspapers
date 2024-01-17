<x-layout>
    <div class="container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-sm-12">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}"> <i data-feather="home"></i></a></li>
                        <li class="breadcrumb-item active"><a href="{{ route('account-details.index') }}"> List News Paper Account </a></li>
                        <li class="breadcrumb-item active">Add News Paper Account</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!-- Container-fluid starts-->
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <form action="{{ route('account-details.store') }}" method="post">
                    @csrf
                    <div class="card">
                        <div class="card-header border-bottom pb-2 bg-primary">
                            <h5 class="text-white item-center mb-2">Add News Paper Account</h5>
                        </div>

                        <div class="card-body">
                            <div class="row g-3 pb-3">
                                <div class="col-md-6 col-lg-6 col-12">
                                    <label class="form-label" for="news_paper_id">Select News Paper <span class="error">*</span></label>
                                    <select name="news_paper_id" required class="form-select">
                                        <option value="">Select News Paper</option>
                                        @foreach ( $newsPapers as $newsPaper )
                                            <option @if(old('news_paper_id') == $newsPaper->id)selected @endif value="{{ $newsPaper->id }}">{{ $newsPaper->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('news_paper_id')
                                        <span class="error">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-md-6 col-lg-6 col-12">
                                    <label class="form-label" for="bank">Bank <span class="error">*</span></label>
                                    <input @if ($errors->has('bank')) class="form-control is-invalid" @else style="border: 1px solid #475ecc6b;"  @endif class="form-control"  name="bank" id="bank" type="text" placeholder="Bank" value="{{ old('bank') }}">
                                    @error('bank')
                                        <span class="error">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-md-6 col-lg-6 col-12">
                                    <label class="form-label" for="branch">Branch <span class="error">*</span></label>
                                    <input @if ($errors->has('branch')) class="form-control is-invalid" @else style="border: 1px solid #475ecc6b;"  @endif class="form-control"  name="branch" id="branch" type="text" placeholder="Branch" value="{{ old('branch') }}">
                                    @error('branch')
                                        <span class="error">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-md-6 col-lg-6 col-12">
                                    <label class="form-label" for="account_number">Account Number <span class="error">*</span></label>
                                    <input @if ($errors->has('account_number')) class="form-control is-invalid" @else style="border: 1px solid #475ecc6b;"  @endif class="form-control"  name="account_number" id="account_number" type="text" placeholder="Account Number" value="{{ old('account_number') }}">
                                    @error('account_number')
                                        <span class="error">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-md-6 col-lg-6 col-12">
                                    <label class="form-label" for="ifsc_code">IFSC Code <span class="error">*</span></label>
                                    <input @if ($errors->has('ifsc_code')) class="form-control is-invalid" @else style="border: 1px solid #475ecc6b;"  @endif class="form-control"  name="ifsc_code" id="ifsc_code" type="text" placeholder="IFSC Code" value="{{ old('ifsc_code') }}">
                                    @error('ifsc_code')
                                        <span class="error">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-md-6 col-lg-6 col-12">
                                    <label class="form-label" for="pan_card">Pan Card <span class="error">*</span></label>
                                    <input @if ($errors->has('pan_card')) class="form-control is-invalid" @else style="border: 1px solid #475ecc6b;"  @endif class="form-control"  name="pan_card" id="pan_card" type="text" placeholder="Pan Card" value="{{ old('pan_card') }}">
                                    @error('pan_card')
                                        <span class="error">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-md-6 col-lg-6 col-12">
                                    <label class="form-label" for="gst_no">GST No</label>
                                    <input @if ($errors->has('gst_no')) class="form-control is-invalid" @else style="border: 1px solid #475ecc6b;"  @endif class="form-control"  name="gst_no" id="gst_no" type="text" placeholder="GST No" value="{{ old('gst_no') }}">
                                    @error('gst_no')
                                        <span class="error">{{ $message }}</span>
                                    @enderror
                                </div>

                            </div>

                            <div class="text-end" >
                                <button class="btn btn-square btn-success-gradien" type="submit">Save </button>
                                <a href="{{ route('account-details.index') }}"><button class="btn btn-square btn-dark" type="button">Cancel </button></a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Container-fluid Ends-->
</x-layout>
