<x-layout>
    <style>
        .select2-container--bgform .select2-selection--multiple .select2-selection__choice {
    clear: both;
}
    </style>
    <div class="container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-sm-12">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}"> <i data-feather="home"></i></a></li>
                        <li class="breadcrumb-item active"><a href="{{ route('advertise.index') }}"> जाहिरात करा </a></li>
                        <li class="breadcrumb-item active">जाहिरात जोडा</li>
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
                                <h5 class="text-white item-center mb-2">जाहिरात जोडा</h5>
                            </div>

                            <div class="card-body">
                                <div class="row g-3 pb-3">

                                    <div class="col-md-6 col-lg-6 col-12">
                                        <label class="form-label" for="publication_type_id">प्रसिध्दीचा स्तर निवडा <span class="error">*</span></label>
                                        <select name="publication_type_id" id="selectPublication" required class="form-select">
                                            <option value="">प्रसिध्दीचा स्तर निवडा</option>
                                            @php $isJahirNivida = "0"; @endphp
                                            @foreach ( $publicationTypes as $publicationType )
                                                @if( $advertise->publication_type_id == $publicationType->id )
                                                @if($publicationType->name  == "जाहिर निविदा" || $publicationType->name  == "जाहीर निविदा")
                                                @php $isJahirNivida = "1"; @endphp
                                                @endif
                                                @endif

                                                <option @if( $advertise->publication_type_id == $publicationType->id )selected @endif value="{{ $publicationType->id }}">{{ $publicationType->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('publication_type_id')
                                            <span class="error">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    {{-- not part of jahir nivida --}}
                                    <div class="col-md-6 col-lg-6 col-12 notJahirNivida @if($isJahirNivida != "0") d-none @endif">
                                        <label class="form-label" for="not_jahir_news_paper_type_id">वर्तमानपत्र प्रकार निवडा <span class="error">*</span></label>
                                        <select name="not_jahir_news_paper_type_id[]" required class="form-select js-example-basic-multiple selectNotJahirNividaType" id="selectNewsPaperType"  multiple="multiple">
                                            @foreach($advertise->advertiseNewsPapers as $newsPaperLang)
                                            @foreach ( $newsPaperTypes as $newsPaperType )
                                                <option @if( $newsPaperLang->newsPaper->newsPaperType->id == $newsPaperType->id )selected @endif value="{{ $newsPaperType->id }}">{{ $newsPaperType->name }}</option>
                                            @endforeach
                                            @endforeach
                                        </select>
                                        @error('not_jahir_news_paper_type_id')
                                            <span class="error">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="col-md-6 col-lg-6 col-12 notJahirNivida @if($isJahirNivida != "0") d-none @endif">
                                        <label class="form-label" for="not_jahir_language_id">वर्तमानपत्राची भाषा निवडा <span class="error">*</span></label>
                                        <select name="not_jahir_language_id[]" required class="form-select js-example-basic-multiple selectNotJahirNividaType" id="selectLanguage" multiple="multiple">
                                            @foreach($advertise->advertiseNewsPapers as $newsPaperLang)
                                            @foreach ( $languages as $language )
                                                <option @if( $newsPaperLang->newsPaper->language->id == $language->id )selected @endif value="{{ $language->id }}">{{ $language->name }}</option>
                                            @endforeach
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
                                    <div class="col-md-6 col-lg-6 col-12 jahirNivida @if($isJahirNivida == "0") d-none @endif">
                                        <label class="form-label" for="cost_id">कामाची किंमत निवडा <span class="error">*</span></label>
                                        <select name="cost_id" id="selectCosts" required class="form-select">
                                            <option value="">कामाची किंमत निवडा</option>
                                            @foreach ( $costs as $cost )
                                                <option @if( $advertise->cost_id == $cost->id )selected @endif value="{{ $cost->id }}">{{ $cost->name }}</option>
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
                                        <label class="form-label" for="department_id">विभाग निवडा <span class="error">*</span></label>
                                        <select name="department_id" id="selectDepartment" required class="form-select">
                                            <option value="">विभाग निवडा</option>
                                            @foreach ( $departments as $department )
                                                <option @if($department->id == $advertise->department_id)selected @endif value="{{ $department->id }}">{{ $department->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('department_id')
                                            <span class="error">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="col-md-6 col-lg-6 col-12">
                                        <label class="form-label" for="work_order_number">वर्क ऑर्डर क्रमांक <span class="error">*</span></label>
                                        <input @if ($errors->has('work_order_number')) class="form-control is-invalid" @else style="border: 1px solid #475ecc6b;"  @endif class="form-control"  name="work_order_number" id="work_order_number" type="text" placeholder="वर्क ऑर्डर क्रमांक" value="{{ $advertise->work_order_number }}">
                                        @error('work_order_number')
                                            <span class="error">{{ $message }}</span>
                                        @enderror
                                        <div id="work_order_number_error" class="text-danger"></div>
                                        <div id="work_order_number_success" class="text-success"></div>
                                    </div>

                                    <div class="col-md-6 col-lg-6 col-12">
                                        <label class="form-label" for="print_type_id">प्रिंटचा प्रकार <span class="error">*</span></label>
                                        <select name="print_type_id" id="selectTypeOfPrint" required class="form-select">
                                            <option value="">प्रिंटचा प्रकार</option>
                                            @foreach ( $printTypes as $printType )
                                                <option @if( $printType->id == $advertise->print_type_id )selected @endif value="{{ $printType->id }}">{{ $printType->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('print_type_id')
                                            <span class="error">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="col-md-6 col-lg-6 col-12">
                                        <label class="form-label" for="publication_date">पब्लिकेशन तारीख <span class="error">*</span></label>
                                        <input @if ($errors->has('publication_date')) class="form-control is-invalid" @else style="border: 1px solid #475ecc6b;"  @endif class="form-control"  name="publication_date" id="publication_date" type="date" placeholder="पब्लिकेशन तारीख" value="{{ $advertise->publication_date }}">
                                        @error('publication_date')
                                            <span class="error">{{ $message }}</span>
                                        @enderror
                                    </div>


                                    <div class="col-md-6 col-lg-6 col-12">
                                        <label class="form-label" for="banner_size_id">बॅनर आकार निवडा <span class="error">*</span></label>
                                        <select name="banner_size_id" id="selectDepartment" required class="form-select">
                                            <option value="">बॅनर आकार निवडा</option>
                                            @foreach ( $bannerSizes as $bannerSize )
                                                <option @if($advertise->banner_size_id == $bannerSize->id)selected @endif value="{{ $bannerSize->id }}">{{ $bannerSize->size }}</option>
                                            @endforeach
                                        </select>
                                        @error('banner_size_id')
                                            <span class="error">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="col-md-6 col-lg-6 col-12">
                                        <label class="form-label" for="image">फोटो अपलोड करा</label>
                                        @if($advertise->image != "")
                                        <div>
                                            <img src="{{ asset('storage/'.$advertise->image) }}" style="width:150px" alt="">
                                        </div>
                                        @endif
                                        <input @if ($errors->has('image')) class="form-control is-invalid" @else style="border: 1px solid #475ecc6b;"  @endif class="form-control"  name="image" id="image" type="file" accept="image/*" placeholder="Publication Date" value="{{ old('image') }}">
                                        @error('image')
                                            <span class="error">{{ $message }}</span>
                                        @enderror
                                    </div>



                                </div>

                                <div class="text-end" >
                                    <button class="btn btn-square btn-success-gradien" type="submit" id="submitForm">जतन करा आणि पूर्वावलोकन करा</button>
                                    <a href="{{ route('advertise.index') }}"><button class="btn btn-square btn-dark" type="button">रद्द करा</button></a>
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
                                            <div class="col-form-label">${val.name} वर्तमानपत्र निवडा</div>
                                            <select multiple="" class="js-example-basic-single col-12 selectOptionNewspaper" required name="jahir_news_paper_type_id[]" tabindex="-1" aria-hidden="true">`;

                                    $.each(val.advertise_cost, function(dataKey, dataVal){
                                        html += `<optgroup class="selectOptgroupNewspaper" label="${dataVal.language.name}" data-selectcount="${dataVal.no_of_newspaper}" data-state="${val.name}">`;
                                        $.each(dataVal.language.news_papers, function(newsKey, newsVal){
                                            // if(newsVal.news_paper_type_id == val.news_paper_type_id && newsVal.language_id == dataVal.id){
                                                html += `<option value="${newsVal.id}">${newsVal.name}</option>`;

                                            // }
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
                                                <div class="col-form-label">${val.name} वर्तमानपत्र निवडा</div>
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
