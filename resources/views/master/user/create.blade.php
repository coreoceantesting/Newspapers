<x-layout>
    <div class="container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-sm-12">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}"> <i data-feather="home"></i></a></li>
                        <li class="breadcrumb-item active"><a href="{{ route('user.index') }}">List user (वापरकर्ता यादी) </a></li>
                        <li class="breadcrumb-item active">Add user (वापरकर्ता जोडा)</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!-- Container-fluid starts-->
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <form action="{{ route('user.store') }}" method="post">
                    @csrf
                    <div class="card">
                        <div class="card-header border-bottom pb-2 bg-primary">
                            <h5 class="text-white item-center mb-2">Add user (वापरकर्ता जोडा)</h5>
                        </div>

                        <div class="card-body">
                            <div class="row g-3 pb-3">

                                <div class="col-md-6 col-lg-6 col-12">
                                    <label class="form-label" for="name">Name (नाव) <span class="error">*</span></label>
                                    <input @if ($errors->has('name')) class="form-control is-invalid" @else style="border: 1px solid #475ecc6b;"  @endif class="form-control"  name="name" id="name" type="text" placeholder="Enter name" value="{{ old('name') }}" required>
                                    @error('name')
                                        <span class="error">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-md-6 col-lg-6 col-12">
                                    <label class="form-label" for="email">Email (ईमेल) <span class="error">*</span></label>
                                    <input @if ($errors->has('email')) class="form-control is-invalid" @else style="border: 1px solid #475ecc6b;"  @endif class="form-control"  name="email" id="email" type="email" placeholder="Enter email" value="{{ old('email') }}" required>
                                    @error('email')
                                        <span class="error">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-md-6 col-lg-6 col-12">
                                    <label class="form-label" for="password">Password (पासवर्ड) <span class="error">*</span></label>
                                    <input @if ($errors->has('password')) class="form-control is-invalid" @else style="border: 1px solid #475ecc6b;"  @endif class="form-control"  name="password" id="password" type="password" placeholder="Enter password" value="{{ old('password') }}" required>
                                    @error('password')
                                        <span class="error">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-md-6 col-lg-6 col-12">
                                    <label class="form-label" for="user_type">Select user type (वापरकर्ता प्रकार निवडा) <span class="error">*</span></label>
                                    <select name="user_type" required class="form-select">
                                        <option value="">Select User type</option>
                                        <option value="1">Admin</option>
                                        <option value="2">User</option>

                                    </select>
                                    @error('user_type')
                                        <span class="error">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-md-6 col-lg-6 col-12">
                                    <label class="form-label" for="status">Select status (स्थिती निवडा) <span class="error">*</span></label>
                                    <select name="status" required class="form-select">
                                        <option value="">Select status</option>
                                        <option value="1">Active</option>
                                        <option value="0">Inactive</option>
                                    </select>
                                    @error('status')
                                        <span class="error">{{ $message }}</span>
                                    @enderror
                                </div>


                            </div>

                            <div class="text-end" >
                                <button class="btn btn-square btn-success-gradien" type="submit">Submit (जतन करा) </button>
                                <a href="{{ route('user.index') }}"><button class="btn btn-square btn-dark" type="button">Cancel (रद्द करा) </button></a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Container-fluid Ends-->
</x-layout>
