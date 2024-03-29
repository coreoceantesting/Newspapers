<x-layout>
    <style>
        .select2-drpdwn .select2-selection{
            height: auto!important;
        }
        .select2-container--default .select2-selection--multiple .select2-selection__rendered li{
            margin: 2px 4px;
        }
    </style>
    <div class="container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-sm-12">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}"> <i data-feather="home"></i></a></li>
                        <li class="breadcrumb-item active"><a href="{{ route('advertise.index') }}">List Advertise (जाहिरात यादी) </a></li>
                        <li class="breadcrumb-item active">Add Advertise (जाहिरात जोडा)</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!-- Container-fluid starts-->
    <div class="container-fluid">
        <div class="select2-drpdwn">
            <div class="row">
                <div class="col-sm-12">
                    <form action="{{ route('advertise.store') }}" id="saveAdvertiseForm" enctype="multipart/form-data" method="post">
                        @csrf
                        <div class="card">
                            <div class="card-header border-bottom pb-2 bg-primary">
                                <h5 class="text-white item-center mb-2">Add Advertise (जाहिरात जोडा)</h5>
                            </div>

                            <div class="card-body">
                                <div class="row g-3 pb-3">

                                    <div class="col-md-6 col-lg-6 col-12">
                                        <label class="form-label" for="publication_type_id">Select Publication Type (पब्लिकेशन प्रकार निवडा) <span class="error">*</span></label>
                                        <select name="publication_type_id" id="selectPublication" required class="form-select">
                                            <option value="">Select Publication Type (पब्लिकेशन प्रकार निवडा)</option>
                                            @foreach ( $publicationTypes as $publicationType )
                                                <option value="{{ $publicationType->id }}">{{ $publicationType->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('publication_type_id')
                                            <span class="error">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    {{-- not part of jahir nivida --}}
                                    <div class="col-md-6 col-lg-6 col-12 notJahirNivida d-none">
                                        <label class="form-label" for="not_jahir_news_paper_type_id">Select Publication Level (प्रसिध्दीचा स्तर निवडा) <span class="error">*</span></label>
                                        <select name="not_jahir_news_paper_type_id[]" required class="form-select js-example-basic-multiple selectNotJahirNividaType" id="selectNewsPaperType"  multiple="multiple">
                                            @foreach ( $newsPaperTypes as $newsPaperType )
                                                <option value="{{ $newsPaperType->id }}">{{ $newsPaperType->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('not_jahir_news_paper_type_id')
                                            <span class="error">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="col-md-6 col-lg-6 col-12 notJahirNivida d-none">
                                        <label class="form-label" for="not_jahir_language_id">Select Language (वर्तमानपत्राची भाषा निवडा) <span class="error">*</span></label>
                                        <select name="not_jahir_language_id[]" required class="form-select js-example-basic-multiple selectNotJahirNividaType" id="selectLanguage" multiple="multiple">
                                            @foreach ( $languages as $language )
                                                <option value="{{ $language->id }}">{{ $language->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('not_jahir_language_id')
                                            <span class="error">{{ $message }}</span>
                                        @enderror
                                    </div>


                                    <div class="notJahirNivida selectNewsPaperOption d-none row" id="addNotJahirNivida">

                                      </div>
                                    {{-- end of not part of jahir nivida  --}}


                                    {{-- start jahirNivida --}}
                                    <div class="col-md-6 col-lg-6 col-12 jahirNivida d-none">
                                        <label class="form-label" for="cost_id">Select Cost (कामाची किंमत निवडा) <span class="error">*</span></label>
                                        <select name="cost_id" id="selectCosts" required class="form-select">
                                            <option value="">Select Cost (कामाची किंमत निवडा)</option>
                                            @foreach ( $costs as $cost )
                                                <option value="{{ $cost->id }}">{{ $cost->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('cost_id')
                                            <span class="error">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div id="checkjahirnivida"></div>
                                    <div id="addJahirNivida" class="row jahirNivida"></div>
                                    {{-- end of jahirNivida --}}



                                    <hr class="m-0">

                                    <div class="col-md-6 col-lg-6 col-12">
                                        <label class="form-label" for="department_id">Select Department (विभाग निवडा) <span class="error">*</span></label>
                                        <select name="department_id" id="selectDepartment" required class="form-select">
                                            <option value="">Select Department (विभाग निवडा)</option>
                                            @foreach ( $departments as $department )
                                                <option value="{{ $department->id }}">{{ $department->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('department_id')
                                            <span class="error">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="col-md-6 col-lg-6 col-12">
                                        <label class="form-label" for="work_order_number">Work Order Number (वर्क ऑर्डर क्रमांक) <span class="error">*</span></label>
                                        <input @if ($errors->has('work_order_number')) class="form-control is-invalid" @else style="border: 1px solid #475ecc6b;"  @endif class="form-control"  name="work_order_number" id="work_order_number" type="text" placeholder="वर्क ऑर्डर क्रमांक" value="{{ old('work_order_number') }}" required>
                                        @error('work_order_number')
                                            <span class="error">{{ $message }}</span>
                                        @enderror
                                        <div id="work_order_number_error" class="text-danger"></div>
                                        <div id="work_order_number_success" class="text-success"></div>
                                    </div>

                                    <div class="col-md-6 col-lg-6 col-12">
                                        <label class="form-label" for="print_type_id">Select Print Type (प्रिंटचा प्रकार) <span class="error">*</span></label>
                                        <select name="print_type_id" id="selectTypeOfPrint" required class="form-select" required>
                                            <option value="">Select Print Type (प्रिंटचा प्रकार)</option>
                                            @foreach ( $printTypes as $printType )
                                                <option value="{{ $printType->id }}">{{ $printType->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('print_type_id')
                                            <span class="error">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="col-md-6 col-lg-6 col-12">
                                        <label class="form-label" for="publication_date">Select Publication Date (पब्लिकेशन तारीख) <span class="error">*</span></label>
                                        <input @if ($errors->has('publication_date')) class="form-control is-invalid" @else style="border: 1px solid #475ecc6b;"  @endif class="form-control"  name="publication_date" id="publication_date" type="date" placeholder="पब्लिकेशन तारीख" value="{{ old('publication_date') }}" required>
                                        @error('publication_date')
                                            <span class="error">{{ $message }}</span>
                                        @enderror
                                    </div>


                                    <div class="col-md-6 col-lg-6 col-12">
                                        <label class="form-label" for="context">Context (संदर्भ) <span class="error">*</span></label>
                                        <input @if ($errors->has('context')) class="form-control is-invalid" @else style="border: 1px solid #475ecc6b;"  @endif class="form-control"  name="context" id="context" type="text" placeholder="संदर्भ" value="{{ old('context') }}" required>
                                        @error('context')
                                            <span class="error">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="col-md-6 col-lg-6 col-12">
                                        <label class="form-label" for="context_date">Select Context Date (संदर्भ तारीख) <span class="error">*</span></label>
                                        <input @if ($errors->has('context_date')) class="form-control is-invalid" @else style="border: 1px solid #475ecc6b;"  @endif class="form-control"  name="context_date" id="context_date" type="date" placeholder="संदर्भ तारीख" value="{{ old('context_date') }}" required>
                                        @error('context_date')
                                            <span class="error">{{ $message }}</span>
                                        @enderror
                                    </div>


                                    <div class="col-md-6 col-lg-6 col-12">
                                        <label class="form-label" for="banner_size_id"> Select Banner Size (बॅनर आकार निवडा (चौ. सेमी)) <span class="error">*</span></label>
                                        <select name="banner_size_id" id="selectDepartment" required class="form-select">
                                            <option value=""> Select Banner Size (बॅनर आकार निवडा)</option>
                                            @foreach ( $bannerSizes as $bannerSize )
                                                <option value="{{ $bannerSize->id }}">{{ $bannerSize->size }}</option>
                                            @endforeach
                                        </select>
                                        @error('banner_size_id')
                                            <span class="error">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="col-md-6 col-lg-6 col-12">
                                        <label class="form-label" for="image">Select Photo (फोटो अपलोड करा) <span class="error">*</span></label>
                                        <input @if ($errors->has('image')) class="form-control is-invalid" @else style="border: 1px solid #475ecc6b;"  @endif class="form-control"  name="image" id="image" type="file" accept="image/*" required placeholder="Publication Date" value="{{ old('image') }}">
                                        @error('image')
                                            <span class="error">{{ $message }}</span>
                                        @enderror
                                    </div>



                                </div>

                                <div class="text-end" >
                                    <button class="btn btn-square btn-success-gradien" type="submit" id="submitForm">Save & Preview (जतन करा आणि पूर्वावलोकन करा)</button>
                                    <a href="{{ route('advertise.index') }}"><button class="btn btn-square btn-dark" type="button">Cancel (रद्द करा)</button></a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Container-fluid Ends-->

    @push('scripts')
        <script>
            $(document).ready(function(){
                $('body').on('change', '#selectPublication', function(){
                    let publicationType = $(this).find('option:selected').text();
                    if(publicationType  == "जाहिर निविदा" || publicationType  == "जाहीर निविदा"){
                        $('#checkjahirnivida').html('<input type="hidden" value="1" name="is_jahir_nivida"/>')
                        $('.jahirNivida').removeClass('d-none')
                        $('.notJahirNivida').addClass('d-none')
                        $('select[name="jahir_news_paper_type_id[]"]').attr('required', true)
                        $('select[name="cost_id"]').attr('required', true)
                        $('select[name="not_jahir_news_paper_type_id[]"]').removeAttr('required')
                        $('select[name="not_jahir_language_id[]"]').removeAttr('required')
                    }else{
                        $('#checkjahirnivida').html('')
                        $('.jahirNivida').addClass('d-none')
                        $('.notJahirNivida').removeClass('d-none')
                        $('select[name="jahir_news_paper_type_id[]"]').removeAttr('required')
                        $('select[name="cost_id"]').removeAttr('required')
                        $('select[name="not_jahir_news_paper_type_id[]"]').attr('required', true)
                        $('select[name="not_jahir_language_id[]"]').attr('required', true)
                    }
                });

                // start of jahir nivida
                $('body').on('change', '#selectCosts', function(e){
                    e.preventDefault();
                    let costId = $(this).val();

                    $.ajax({
                        url: "{{ route('get-newspaper-type') }}",
                        type: "get",
                        data: {cost_id : costId},
                        beforeSend: function()
                        {
                            $('.ajax-loader').removeClass('d-none');
                        },
                        success: function(response){

                            if(response.status === 200){
                                let html = '';

                                $.each(response.data, function(key, val){
                                    html += `<div class="col-md-6 col-lg-6">
                                        <div class="mb-2">
                                            <div class="col-form-label">${val.name} वर्तमानपत्र निवडा  <span class="error">*</span></div>
                                            <select multiple="" class="js-example-basic-single col-12 selectOptionNewspaper" required name="jahir_news_paper_type_id[]" tabindex="-1" aria-hidden="true">`;

                                    $.each(val.advertise_cost, function(dataKey, dataVal){
                                        html += `<optgroup class="selectOptgroupNewspaper" label="${dataVal.language.name}" data-selectcount="${dataVal.no_of_newspaper}" data-state="${val.name}">`;
                                        $.each(dataVal.language.news_papers, function(newsKey, newsVal){
                                            if(newsVal.news_paper_type_id == val.id){
                                                html += `<option value="${newsVal.id}">${newsVal.name}</option>`;
                                            }
                                        });
                                        html += `</optgroup>`;
                                    });
                                    html += `</select>
                                            </div>
                                    </div>`;

                                })

                                $('body').find('#addJahirNivida').html(html)
                                $('body').find(".js-example-basic-single").select2();
                            }else{
                                alert('Something went wrong')
                            }
                        },
                        error: function(xhr) {
                            $('.ajax-loader').addClass('d-none');
                        },
                        complete: function() {
                            $('.ajax-loader').addClass('d-none');
                        },
                    });
                });


                // start of not part of jahir nivida
                $('body').on('change', '.selectNotJahirNividaType', function(){
                    let newsPaperType = $('#selectNewsPaperType').val();
                    let language = $('#selectLanguage').val();

                    if(newsPaperType != "" && language != ""){
                        $.ajax({
                            url: "{{ route('get-not-jahir-newspaper-type') }}",
                            type: "get",
                            data: {newsPaperType : newsPaperType, language : language},
                            beforeSend: function()
                            {
                                $('.ajax-loader').removeClass('d-none');
                            },
                            success: function(response){
                                if(response.status === 200){
                                    let html = '';
                                    $.each(response.data, function(key, val){
                                        html += `<div class="col-md-6 col-lg-6">
                                            <div class="mb-2">
                                                <div class="col-form-label">${val.name} वर्तमानपत्र निवडा  <span class="error">*</span></div>
                                                <select multiple="" class="js-example-basic-single col-12" required name="not_jahir_news_paper_id[]">`;


                                        $.each(val.language, function(langKey, langVal){
                                            html += `<optgroup label="${langVal.name}">`;
                                                $.each(langVal.news_papers, function(newsKey, newsVal){
                                                    console.log(newsVal)
                                                    html += `<option value="${newsVal.id}">${newsVal.name}</option>`;
                                                });
                                            html += `</optgroup>`;
                                        });
                                        html += `</select>
                                                </div>
                                        </div>`;

                                    })
                                    $('body').find('#addNotJahirNivida').html(html)
                                    $('body').find(".js-example-basic-single").select2();
                                }else{
                                    alert('Something is wrong please try again')
                                }
                            },
                            error: function(xhr) {
                                $('.ajax-loader').addClass('d-none');
                            },
                            complete: function() {
                                $('.ajax-loader').addClass('d-none');
                            },
                        });
                    }
                })
                // end of not part of jahir nivida

                // form submit
                $('body').on('click', '#submitForm', function(e){

                    let publicationType = $('#selectPublication').find('option:selected').text();

                    if(publicationType == "जाहिर निविदा"){
                        var message = "";
                        var isSubmit = 1;
                        $('body').find('.selectOptionNewspaper').each(function(){
                            var $this = $(this);
                            $this.find('.selectOptgroupNewspaper').each(function(){
                                let option1 = $(this).find(":selected").length

                                var optionCount = parseInt($(this).data('selectcount'));
                                var state = $(this).data('state');
                                let label = $(this).prop('label')
                                if(optionCount !== option1){
                                    alert(`You are not selected ${optionCount} option of ${label} language of ${state}`)
                                    isSubmit = 0;
                                    return false;
                                }
                            })
                            if(isSubmit == 0){
                                return false;
                            }

                        })
                        if(isSubmit == 0){
                            return false;
                        }
                    }
                })


                // ajax to check work order is duplicate or not
                $('body').on('blur', '#work_order_number', function(){
                    let workOrderNumber = $(this).val();
                    if(workOrderNumber != ""){
                        $.ajax({
                            url: "{{ route('check-duplicate-work-order-number') }}",
                            type: "get",
                            data: {workOrderNumber : workOrderNumber},
                            beforeSend: function()
                            {
                                $('.ajax-loader').removeClass('d-none');
                            },
                            success: function(response){
                                if(response.status === 200){
                                    $('#work_order_number_error').html(`Work Order Number ${response.data} Already Created`)
                                    $('#work_order_number_success').html('')
                                    $('#work_order_number').val('')
                                    $('#submitForm').prop('disabled', true)
                                }else{
                                    $('#work_order_number_success').html(`Work Order Number ${workOrderNumber} Available.`)
                                    $('#work_order_number_error').html('')
                                    $('#submitForm').prop('disabled', false)
                                }
                            },
                            error: function(xhr) {
                                $('.ajax-loader').addClass('d-none');
                            },
                            complete: function() {
                                $('.ajax-loader').addClass('d-none');
                            },
                        });
                    }
                })

            })
        </script>
    @endpush
</x-layout>
