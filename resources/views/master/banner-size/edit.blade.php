<x-layout>
    <div class="container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-sm-12">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}"> <i data-feather="home"></i></a></li>
                        <li class="breadcrumb-item active"><a href="{{ route('banner-size.index') }}">List Banner Size (बॅनर आकार यादी) </a></li>
                        <li class="breadcrumb-item active">Edit Banner Size (बॅनर आकार संपादित करा)</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!-- Container-fluid starts-->
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <form action="{{ route('banner-size.update', $bannerSize->id) }}" method="post">
                    @csrf
                    @method('put')
                    <input type="hidden" name="id" value="{{ $bannerSize->id }}">
                    <div class="card">
                        <div class="card-header border-bottom pb-2 bg-primary">
                            <h5 class="text-white item-center mb-2">Edit Banner Size (बॅनर आकार संपादित करा)</h5>
                        </div>

                        <div class="card-body">
                            <div class="row g-3 pb-3">
                                <div class="col-md-6 col-lg-6 col-12">
                                    <label class="form-label" for="size">Banner Size (बॅनर आकार) <span class="error">*</span></label>
                                    <input @if ($errors->has('size')) class="form-control is-invalid" @else style="border: 1px solid #475ecc6b;"  @endif class="form-control"  name="size" id="size" type="text" placeholder="बॅनर आकार" value="{{ $bannerSize->size }}">
                                    @error('size')
                                        <span class="error">{{ $message }}</span>
                                    @enderror
                                </div>


                            </div>

                            <div class="text-end" >
                                <button class="btn btn-square btn-success-gradien" type="submit">Submit (जतन करा) </button>
                                <a href="{{ route('banner-size.index') }}"><button class="btn btn-square btn-dark" type="button">Cancel (रद्द करा) </button></a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Container-fluid Ends-->
</x-layout>
