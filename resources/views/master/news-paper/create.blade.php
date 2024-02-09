<x-layout>
    <div class="container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-sm-12">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}"> <i data-feather="home"></i></a></li>
                        <li class="breadcrumb-item active"><a href="{{ route('news-paper.index') }}"> वर्तमानपत्र यादी </a></li>
                        <li class="breadcrumb-item active">वर्तमानपत्र जोडा</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!-- Container-fluid starts-->
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <form action="{{ route('news-paper.store') }}" method="post">
                    @csrf
                    <div class="card">
                        <div class="card-header border-bottom pb-2 bg-primary">
                            <h5 class="text-white item-center mb-2">वर्तमानपत्र जोडा</h5>
                        </div>

                        <div class="card-body">
                            <div class="row g-3 pb-3">
                                <div class="col-md-6 col-lg-6 col-12">
                                    <label class="form-label" for="news_paper_type_id">प्रसिध्दीचा स्तर निवडा <span class="error">*</span></label>
                                    <select name="news_paper_type_id" required class="form-select">
                                        <option value="">प्रसिध्दीचा स्तर निवडा</option>
                                        @foreach ( $newsPaperTypes as $newsPaperType )
                                        <option @if( old('news_paper_type_id') == $newsPaperType->id )selected @endif value="{{ $newsPaperType->id }}">{{ $newsPaperType->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('news_paper_type_id')
                                        <span class="error">{{ $message }}</span>
                                    @enderror
                                </div>


                                <div class="col-md-6 col-lg-6 col-12">
                                    <label class="form-label" for="language_id">भाषा निवडा <span class="error">*</span></label>
                                    <select name="language_id" required class="form-select">
                                        <option value="">भाषा निवडा</option>
                                        @foreach ( $languages as $language )
                                        <option @if( old('language_id') == $language->id )selected @endif value="{{ $language->id }}">{{ $language->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('language_id')
                                        <span class="error">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-md-6 col-lg-6 col-12">
                                    <label class="form-label" for="name">वर्तमानपत्राचे नाव <span class="error">*</span></label>
                                    <input @if ($errors->has('name')) class="form-control is-invalid" @else style="border: 1px solid #475ecc6b;"  @endif class="form-control"  name="name" id="name" type="text" placeholder="वर्तमानपत्राचे नाव" value="{{ old('name') }}" required>
                                    @error('name')
                                        <span class="error">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-md-6 col-lg-6 col-12">
                                    <label class="form-label" for="editor_name">संपादकाचे नाव <span class="error">*</span></label>
                                    <input @if ($errors->has('editor_name')) class="form-control is-invalid" @else style="border: 1px solid #475ecc6b;"  @endif class="form-control"  name="editor_name" id="editor_name" type="text" placeholder="संपादकाचे नाव" value="{{ old('editor_name') }}" required>
                                    @error('editor_name')
                                        <span class="error">{{ $message }}</span>
                                    @enderror
                                </div>

                                {{-- <div class="col-md-6 col-lg-6 col-12">
                                    <label class="form-label" for="email">ईमेल <span class="error">*</span></label>
                                    <input @if ($errors->has('email')) class="form-control is-invalid" @else style="border: 1px solid #475ecc6b;"  @endif class="form-control" name="email" id="email" type="text" required placeholder="ईमेल" value="{{ old('email') }}">
                                    @error('email')
                                    <span class="error">{{ $message }}</span>
                                    @enderror
                                    <label class="text-danger">For multiple emails use comma separated (e.g xyz@gmail.com, abc@gmail.com...)</label>
                                </div>

                                <div class="col-md-6 col-lg-6 col-12">
                                    <label class="form-label" for="mobile">मोबाईल <span class="error">*</span></label>
                                    <input @if ($errors->has('mobile')) class="form-control is-invalid" @else style="border: 1px solid #475ecc6b;"  @endif class="form-control" name="mobile" id="mobile" required type="text" placeholder="मोबाईल" value="{{ old('mobile') }}">
                                    @error('mobile')
                                        <span class="error">{{ $message }}</span>
                                    @enderror
                                    <label class="text-danger">For multiple mobile numbers use comma separated (e.g 9999999999, 8888888888...)</label>
                                </div> --}}

                                <div class="col-md-6 col-lg-6 col-12">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>ईमेल <span class="error">*</span></th>
                                                <th><button class="btn btn-primary btn-sm" id="addMoreEmailBtn" type="button">Add More</button></th>
                                            </tr>
                                        </thead>
                                        <tbody id="tableEmailTbody">
                                            <tr>
                                                <td><input @if ($errors->has('email')) class="form-control is-invalid" @else style="border: 1px solid #475ecc6b;"  @endif class="form-control" name="email[]" type="email" required placeholder="ईमेल"></td>
                                                <td></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>

                                <div class="col-md-6 col-lg-6 col-12">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>मोबाईल <span class="error">*</span></th>
                                                <th><button class="btn btn-primary btn-sm" id="addMoreMobileBtn" type="button">Add More</button></th>
                                            </tr>
                                        </thead>
                                        <tbody id="tableMobileTbody">
                                            <tr>
                                                <td><input @if ($errors->has('mobile')) class="form-control is-invalid" @else style="border: 1px solid #475ecc6b;" @endif class="form-control" name="mobile[]" onkeypress="return event.charCode &gt;= 48 &amp;&amp; event.charCode &lt;= 57" maxlength="12" minlength="10" type="tel" required placeholder="मोबाईल"></td>
                                                <td></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>


                            </div>

                            <div class="text-end" >
                                <button class="btn btn-square btn-success-gradien" type="submit">जतन करा </button>
                                <a href="{{ route('news-paper.index') }}"><button class="btn btn-square btn-dark" type="button">रद्द करा </button></a>
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
            var mobileCount = 1;
            $('body').on('click', '#addMoreMobileBtn', function(){
                let html = `<tr id="mobileRow${mobileCount}">
                            <td><input @if ($errors->has('mobile')) class="form-control is-invalid" @else style="border: 1px solid #475ecc6b;" @endif class="form-control" onkeypress="return event.charCode &gt;= 48 &amp;&amp; event.charCode &lt;= 57" name="mobile[]" maxlength="12" minlength="10" type="tel" required placeholder="मोबाईल"></td>
                            <td><button class="btn btn-danger btn-sm btnRemoveMobile" data-count="${mobileCount}" type="button">Remove</button></td>
                        </tr>`;
                mobileCount = mobileCount + 1;

                $('#tableMobileTbody').append(html)

            });

            var emailCount = 1;
            $('body').on('click', '#addMoreEmailBtn', function(){
                let html = `<tr id="emailRow${emailCount}">
                            <td><input @if ($errors->has('email')) class="form-control is-invalid" @else style="border: 1px solid #475ecc6b;"  @endif class="form-control" name="email[]" type="email" required placeholder="ईमेल"></td>
                            <td><button class="btn btn-danger btn-sm btnRemoveEmail" data-count="${emailCount}" type="button">Remove</button></td>
                        </tr>`;
                emailCount = emailCount + 1;

                $('#tableEmailTbody').append(html)

            });

            $('body').on('click', '.btnRemoveEmail', function(){
                let id = $(this).data('count');
                $('#emailRow'+id).remove();
            })

            $('body').on('click', '.btnRemoveMobile', function(){
                let id = $(this).data('count');
                $('#mobileRow'+id).remove();
            })
        })
    </script>
    @endpush

</x-layout>
