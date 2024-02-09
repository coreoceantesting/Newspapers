<x-layout>
    <div class="container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-sm-12">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}"> <i data-feather="home"></i></a></li>
                        <li class="breadcrumb-item active"><a href="{{ route('advertise-cost.index') }}">List Advertise Cost (जाहिरात खर्च यादी) </a></li>
                        <li class="breadcrumb-item active">Add Advertise Cost (जाहिरात खर्च जोडा)</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!-- Container-fluid starts-->
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <form action="{{ route('advertise-cost.store') }}" method="post">
                    @csrf
                    <div class="card">
                        <div class="card-header border-bottom pb-2 bg-primary">
                            <h5 class="text-white item-center mb-2">Add Advertise Cost (जाहिरात खर्च जोडा)</h5>
                        </div>

                        <div class="card-body">
                            <div class="row g-3 pb-3">
                                <div class="col-md-6 col-lg-6 col-12">
                                    <label class="form-label" for="cost_id">Select Cost (कामाची किंमत निवडा) <span class="error">*</span></label>
                                    <select name="cost_id" required class="form-select">
                                        <option value="">Select Cost (कामाची किंमत निवडा)</option>
                                        @foreach ( $costs as $cost )
                                            <option @if(old('cost_id') == $cost->id)selected @endif value="{{ $cost->id }}">{{ $cost->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('cost_id')
                                        <span class="error">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-md-6 col-lg-6 col-12">
                                    <label class="form-label" for="news_paper_type_id">Select Publication Level (प्रसिध्दीचा स्तर निवडा) <span class="error">*</span></label>
                                    <select name="news_paper_type_id" required class="form-select">
                                        <option value="">Select Publication Level (प्रसिध्दीचा स्तर निवडा)</option>
                                        @foreach ( $newsPaperTypes as $newsPaperType )
                                            <option @if(old('news_paper_type_id') == $newsPaperType->id)selected @endif value="{{ $newsPaperType->id }}">{{ $newsPaperType->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('news_paper_type_id')
                                        <span class="error">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-md-6 col-lg-6 col-12">
                                    <label class="form-label" for="language_id">Select Language (वर्तमानपत्राची भाषा निवडा) <span class="error">*</span></label>
                                    <select name="language_id" required class="form-select">
                                        <option value="">Select Language (वर्तमानपत्राची भाषा निवडा)</option>
                                        @foreach ( $language as $lang )
                                            <option @if(old('language_id') == $lang->id)selected @endif value="{{ $lang->id }}">{{ $lang->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('language_id')
                                        <span class="error">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-md-6 col-lg-6 col-12">
                                    <label class="form-label" for="no_of_newspaper">No of Newspaper (वर्तमानपत्राची संख्या) <span class="error">*</span></label>
                                    <input @if ($errors->has('no_of_newspaper')) class="form-control is-invalid" @else style="border: 1px solid #475ecc6b;"  @endif class="form-control"  name="no_of_newspaper" id="no_of_newspaper" type="number" placeholder="वर्तमानपत्राची संख्या" value="{{ old('no_of_newspaper') }}">
                                    @error('no_of_newspaper')
                                        <span class="error">{{ $message }}</span>
                                    @enderror
                                </div>


                            </div>

                            <div class="text-end" >
                                <button class="btn btn-square btn-success-gradien" type="submit">Submit (जतन करा) </button>
                                <a href="{{ route('advertise-cost.index') }}"><button class="btn btn-square btn-dark" type="button">Cancel (रद्द करा) </button></a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Container-fluid Ends-->
</x-layout>
