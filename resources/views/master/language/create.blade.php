<x-layout>
    <div class="container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-sm-12">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}"> <i data-feather="home"></i></a></li>
                        <li class="breadcrumb-item active"><a href="{{ route('language.index') }}"> List Newspaper Langugae (वृत्तपत्र भाषा यादी) </a></li>
                        <li class="breadcrumb-item active">Add Newspaper Language (वर्तमानपत्र भाषा जोडा)</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!-- Container-fluid starts-->
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <form action="{{ route('language.store') }}" method="post">
                    @csrf
                    <div class="card">
                        <div class="card-header border-bottom pb-2 bg-primary">
                            <h5 class="text-white item-center mb-2">Add Newspaper Language (वर्तमानपत्र भाषा जोडा)</h5>
                        </div>

                        <div class="card-body">
                            <div class="row g-3 pb-3">
                                <div class="col-md-6 col-lg-6 col-12">
                                    <label class="form-label" for="name">Newspaper Language (वृत्तपत्र भाषा) <span class="error">*</span></label>
                                    <input @if ($errors->has('name')) class="form-control is-invalid" @else style="border: 1px solid #475ecc6b;"  @endif class="form-control"  name="name" id="name" type="text" placeholder="वर्तमानपत्राची भाषा प्रविष्ट करा" value="{{ old('name') }}">
                                    @error('name')
                                        <span class="error">{{ $message }}</span>
                                    @enderror
                                </div>

                            </div>

                            <div class="text-end" >
                                <button class="btn btn-square btn-success-gradien" type="submit">Submit (जतन करा) </button>
                                <a href="{{ route('language.index') }}"><button class="btn btn-square btn-dark" type="button">Cancel (रद्द करा) </button></a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Container-fluid Ends-->
</x-layout>
