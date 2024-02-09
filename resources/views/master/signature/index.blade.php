<x-layout>
    <div class="container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-sm-12">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}"> <i data-feather="home"></i></a></li>
                        <li class="breadcrumb-item active"><a href="{{ route('signature.index') }}">List Signature (स्वाक्षरी यादी) </a></li>
                        <li class="breadcrumb-item active">Edit Signature (स्वाक्षरी संपादित करा)</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!-- Container-fluid starts-->
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <form action="{{ route('signature.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @if($signature && $signature->id)
                    <input type="hidden" name="id" value="{{ $signature->id }}" id="">
                    @endif

                    <div class="card">
                        <div class="card-header border-bottom pb-2 bg-primary">
                            <h5 class="text-white item-center mb-2">Edit Signature (स्वाक्षरी संपादित करा)</h5>
                        </div>

                        <div class="card-body">
                            <div class="row g-3 pb-3">
                                <div class="col-md-6 col-lg-6 col-12">
                                    <label class="form-label" for="name">Signature (स्वाक्षरी) <span class="error">*</span></label>
                                    @if($signature && $signature->name)
                                    <br>
                                    <img src="{{ asset('storage/'.$signature->name) }}" style="width: 150px" class="mb-2" alt="Signature">
                                    @endif

                                    <input @if ($errors->has('name')) class="form-control is-invalid" @else style="border: 1px solid #475ecc6b;"  @endif class="form-control"  name="name" id="name" type="file" value="{{ old('name') }}">
                                    @error('name')
                                        <span class="error">{{ $message }}</span>
                                    @enderror
                                </div>

                            </div>

                            <div class="text-end" >
                                <button class="btn btn-square btn-success-gradien" type="submit">Submit (जतन करा) </button>
                                <a href="{{ route('signature.index') }}"><button class="btn btn-square btn-dark" type="button">Cancel (रद्द करा) </button></a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Container-fluid Ends-->
</x-layout>
