<x-layout>
    <div class="container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-sm-12">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}"> <i data-feather="home"></i></a></li>
                        <li class="breadcrumb-item active"><a href="{{ route('news-paper.index') }}"> List Newspaper (वर्तमानपत्र यादी) </a></li>
                        <li class="breadcrumb-item active">Edit Newspaper (वर्तमानपत्र संपादित करा)</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!-- Container-fluid starts-->
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <form action="{{ route('news-paper.update', $newsPaper->id) }}" method="post">
                    @csrf
                    @method('put')
                    <input type="hidden" name="id" value="{{ $newsPaper->id }}">
                    <div class="card">
                        <div class="card-header border-bottom pb-2 bg-primary">
                            <h5 class="text-white item-center mb-2">Edit Newspaper (वर्तमानपत्र संपादित करा)</h5>
                        </div>

                        <div class="card-body">
                            <div class="row g-3 pb-3">
                                <div class="col-md-6 col-lg-6 col-12">
                                    <label class="form-label" for="news_paper_type_id">Select Publication Lavel (प्रसिध्दीचा स्तर निवडा) <span class="error">*</span></label>
                                    <select name="news_paper_type_id" required class="form-select">
                                        <option value="">Select Publication Level (प्रसिध्दीचा स्तर निवडा)</option>
                                        @foreach ( $newsPaperTypes as $newsPaperType )
                                        <option @if( $newsPaper->news_paper_type_id == $newsPaperType->id )selected @endif value="{{ $newsPaperType->id }}">{{ $newsPaperType->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('news_paper_type_id')
                                        <span class="error">{{ $message }}</span>
                                    @enderror
                                </div>


                                <div class="col-md-6 col-lg-6 col-12">
                                    <label class="form-label" for="language_id">Select Language (भाषा निवडा) <span class="error">*</span></label>
                                    <select name="language_id" required class="form-select">
                                        <option value="">Select Language (भाषा निवडा)</option>
                                        @foreach ( $languages as $language_id )
                                        <option @if( $newsPaper->language_id == $language_id->id )selected @endif value="{{ $language_id->id }}">{{ $language_id->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('language_id')
                                        <span class="error">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-md-6 col-lg-6 col-12">
                                    <label class="form-label" for="name">Newspaper Name (वर्तमानपत्राचे नाव) <span class="error">*</span></label>
                                    <input @if ($errors->has('name')) class="form-control is-invalid" @else style="border: 1px solid #475ecc6b;"  @endif class="form-control"  name="name" id="name" type="text" placeholder="वर्तमानपत्राचे नाव" value="{{ $newsPaper->name }}" required>
                                    @error('name')
                                        <span class="error">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-md-6 col-lg-6 col-12">
                                    <label class="form-label" for="editor_name">Editor Name (संपादकाचे नाव) <span class="error">*</span></label>
                                    <input @if ($errors->has('editor_name')) class="form-control is-invalid" @else style="border: 1px solid #475ecc6b;"  @endif class="form-control"  name="editor_name" id="editor_name" type="text" placeholder="संपादकाचे नाव" value="{{ $newsPaper->editor_name }}" required>
                                    @error('editor_name')
                                        <span class="error">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-md-6 col-lg-6 col-12">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Email (ईमेल) <span class="error">*</span></th>
                                                <th><button class="btn btn-primary btn-sm" id="addMoreEmailBtn" type="button">Add More</button></th>
                                            </tr>
                                        </thead>
                                        <tbody id="tableEmailTbody">

                                            @php
                                            $emails = explode(',', $newsPaper->email);
                                            $count = 1;
                                            @endphp
                                            @for($i=0; $i < count($emails); $i++)
                                            <tr id="emailRow{{ $count }}">
                                                <td>
                                                    @error('email.*')
                                                        <span class="error">{{ $message }}</span>
                                                    @enderror
                                                    <input @if ($errors->has('email')) class="form-control is-invalid" @else style="border: 1px solid #475ecc6b;"  @endif class="form-control" value="{{ $emails[$i] }}" name="email[]" type="email" required placeholder="ईमेल">
                                                </td>
                                                <td>@if($i != 0)<button class="btn btn-danger btn-sm btnRemoveEmail" data-count="{{ $count }}" type="button">Remove</button>@endif</td>
                                            </tr>
                                            @php $count = $count + 1; @endphp
                                            @endfor
                                        </tbody>
                                    </table>
                                </div>

                                <div class="col-md-6 col-lg-6 col-12">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Mobile (मोबाईल) <span class="error">*</span></th>
                                                <th><button class="btn btn-primary btn-sm" id="addMoreMobileBtn" type="button">Add More</button></th>
                                            </tr>
                                        </thead>
                                        <tbody id="tableMobileTbody">
                                            @php
                                            $mobiles = explode(',', $newsPaper->mobile);
                                            $count = 1;
                                            @endphp
                                            @for($i=0; $i < count($mobiles); $i++)
                                            <tr id="mobileRow{{ $count }}">
                                                <td>
                                                    @error('mobile.*')
                                                        <span class="error">{{ $message }}</span>
                                                    @enderror
                                                    <input @if ($errors->has('mobile')) class="form-control is-invalid" @else style="border: 1px solid #475ecc6b;" @endif class="form-control" name="mobile[]" onkeypress="return event.charCode &gt;= 48 &amp;&amp; event.charCode &lt;= 57" maxlength="12" minlength="10" type="tel" value="{{ $mobiles[$i] }}" required placeholder="मोबाईल"></td>
                                                <td>@if($i != 0)<button class="btn btn-danger btn-sm btnRemoveMobile" data-count="{{ $count }}" type="button">Remove</button>@endif</td>
                                            </tr>
                                            @php $count = $count + 1; @endphp
                                            @endfor
                                        </tbody>
                                    </table>
                                </div>


                            </div>

                            <div class="text-end" >
                                <button class="btn btn-square btn-success-gradien" type="submit">Submit (जतन करा) </button>
                                <a href="{{ route('news-paper.index') }}"><button class="btn btn-square btn-dark" type="button">Cancel (रद्द करा) </button></a>
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
            var mobileCount = 100;
            $('body').on('click', '#addMoreMobileBtn', function(){
                let html = `<tr id="mobileRow${mobileCount}">
                            <td><input @if ($errors->has('mobile')) class="form-control is-invalid" @else style="border: 1px solid #475ecc6b;" @endif class="form-control" onkeypress="return event.charCode &gt;= 48 &amp;&amp; event.charCode &lt;= 57" name="mobile[]" maxlength="12" minlength="10" type="tel" required placeholder="मोबाईल"></td>
                            <td><button class="btn btn-danger btn-sm btnRemoveMobile" data-count="${mobileCount}" type="button">Remove</button></td>
                        </tr>`;
                mobileCount = mobileCount + 1;

                $('#tableMobileTbody').append(html)

            });

            var EmailCount = 100;
            $('body').on('click', '#addMoreEmailBtn', function(){
                let html = `<tr id="emailRow${EmailCount}">
                            <td><input @if ($errors->has('email')) class="form-control is-invalid" @else style="border: 1px solid #475ecc6b;"  @endif class="form-control" name="email[]" type="email" required placeholder="ईमेल"></td>
                            <td><button class="btn btn-danger btn-sm btnRemoveEmail" data-count="${EmailCount}" type="button">Remove</button></td>
                        </tr>`;
                EmailCount = EmailCount + 1;

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
