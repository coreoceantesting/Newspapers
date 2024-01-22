<x-layout>
    @push('styles')
    <style>
        @media print {
            /* Hide header */
            header {
                display: none;
            }

            /* Hide page title */
            title {
                display: none;
            }

            /* Hide footer link */
            footer a {
                display: none;
            }
        }
    </style>
    @endpush
    <div class="container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-sm-6">
                    {{-- <h5>Newspaper Department</h5> --}}
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}"> <i data-feather="home"></i></a></li>
                        <li class="breadcrumb-item">अहवाल</li>
                        <li class="breadcrumb-item active">खर्च अहवाल</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!-- Container-fluid starts-->

    <!-- Container-fluid starts-->
    <div class="container-fluid">
        <div class="row">
            <!-- Zero Configuration  Starts-->
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('report.expandeture.pdf') }}" method="get">
                            <input type="hidden" name="search" value="search">
                            <div class="row">
                                <div class="col-lg-3 col-md-4 col-12">
                                    <label class="form-label" for="department">विभाग निवडा</label>
                                    <select name="department" id="department" class="form-select">
                                        @foreach ( $departments as $department )
                                            <option @if(isset(Request()->department) && $department->id == Request()->department)selected @endif value="{{ $department->id }}">{{ $department->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-lg-3 col-md-4 col-12">
                                    <label class="form-label" for="selectWorkOrderNumber">या तारखेपासून</label>
                                    <input type="date" value="{{ date('Y-m-d') }}" name="from" class="form-control" id="from">
                                </div>

                                <div class="col-lg-3 col-md-4 col-12">
                                    <label class="form-label" for="selectWorkOrderNumber">आजपर्यंत</label>
                                    <input type="date" value="{{ date('Y-m-d') }}" name="to" class="form-control" id="to">
                                </div>

                                <div class="col-lg-3 col-md-4 col-12">
                                    <div class="form-label">&nbsp;</div>
                                    <button class="btn btn-primary">शोधा</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            $(document).ready(function(){


            })
        </script>
    @endpush
</x-layout>
