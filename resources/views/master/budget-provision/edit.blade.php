<x-layout>
    <div class="container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-sm-12">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}"> <i data-feather="home"></i></a></li>
                        <li class="breadcrumb-item active"><a href="{{ route('budget-provision.index') }}"> खर्चाची यादी जाहिरात करा </a></li>
                        <li class="breadcrumb-item active">जाहिरात खर्च जोडा</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!-- Container-fluid starts-->
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <form action="{{ route('budget-provision.update', $budgetProvision->id) }}" method="post">
                    @csrf
                    @method('put')
                    <input type="hidden" name="id" value="{{ $budgetProvision->id }}">
                    <div class="card">
                        <div class="card-header border-bottom pb-2 bg-primary">
                            <h5 class="text-white item-center mb-2">जाहिरात खर्च जोडा</h5>
                        </div>

                        <div class="card-body">
                            <div class="row g-3 pb-3">

                                <div class="col-md-6 col-lg-6 col-12">
                                    <label class="form-label" for="financial_year_id">आर्थिक वर्ष निवडा <span class="error">*</span></label>
                                    <select name="financial_year_id" required class="form-select">
                                        <option value="">आर्थिक वर्ष निवडा</option>
                                        @foreach ( $financialYears as $financialYear )
                                            <option @if( $budgetProvision->financial_year_id == $financialYear->id)selected @endif value="{{ $financialYear->id }}">{{ $financialYear->year }}</option>
                                        @endforeach
                                    </select>
                                    @error('financial_year_id')
                                        <span class="error">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-md-6 col-lg-6 col-12">
                                    <label class="form-label" for="language_id">विभाग निवडा <span class="error">*</span></label>
                                    <select name="department_id" required class="form-select">
                                        <option value="">विभाग निवडा</option>
                                        @foreach ( $departments as $department )
                                            <option @if( $budgetProvision->department_id == $department->id)selected @endif value="{{ $department->id }}">{{ $department->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('department_id')
                                        <span class="error">{{ $message }}</span>
                                    @enderror
                                </div>


                                <div class="col-md-6 col-lg-6 col-12">
                                    <label class="form-label" for="budget">बजेट <span class="error">*</span></label>
                                    <input @if ($errors->has('budget')) class="form-control is-invalid" @else style="border: 1px solid #475ecc6b;"  @endif class="form-control"  name="budget" id="budget" type="number" placeholder="बजेट" value="{{ $budgetProvision->budget }}">
                                    @error('budget')
                                        <span class="error">{{ $message }}</span>
                                    @enderror
                                </div>


                            </div>

                            <div class="text-end" >
                                <button class="btn btn-square btn-success-gradien" type="submit">जतन करा </button>
                                <a href="{{ route('budget-provision.index') }}"><button class="btn btn-square btn-dark" type="button">रद्द करा </button></a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Container-fluid Ends-->
</x-layout>