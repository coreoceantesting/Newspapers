<x-layout>
    <div class="container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-sm-6">
                    {{-- <h5>Newspaper Department</h5> --}}
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}"> <i data-feather="home"></i></a></li>
                        <li class="breadcrumb-item active">List Advertise (जाहिरात यादी)</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!-- Container-fluid starts-->
    <div class="container-fluid">
        <div class="row">
            <!-- Zero Configuration  Starts-->
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header border-bottom bg-primary pt-3 pb-1">
                        <div class="row">
                            <div class="col-6">
                                <h5 class="text-white mt-1">List Advertise (जाहिरात यादी)</h5>
                            </div>
                            <div class="col-6 text-end">
                                {{-- <a href="{{ route('advertise.export', ['is_mail_send' => 0]) }}"><button class="btn btn-square btn-success-gradien" type="button">Export As Excel
                                </button></a> --}}

                                <a href="{{ route('advertise.create') }}"><button class="btn btn-square btn-warning-gradien" type="button">Add Advertise (जाहिरात जोडा) <i class="fa fa-plus" aria-hidden="true"></i>
                                </button></a>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        <form class="mb-2" id="filterList">
                            <div class="row">
                                <input type="hidden" name="is_mail_send" value="0">
                                <div class="col-lg-3 col-md-4 col-12">
                                    <label class="form-label" for="selectWorkOrderNumber">Start Date (या तारखेपासून)</label>
                                    <input type="date" value="@if(isset(Request()->from)){{ date('Y-m-d', strtotime(Request()->from)) }}@endif" name="from" class="form-control" id="from">
                                </div>

                                <div class="col-lg-3 col-md-4 col-12">
                                    <label class="form-label" for="selectWorkOrderNumber">End Date (आजपर्यंत)</label>
                                    <input type="date" value="@if(isset(Request()->to)){{ date('Y-m-d', strtotime(Request()->to)) }}@endif" name="to" class="form-control" id="to">
                                </div>
                                <div class="col-lg-4 col-md-4 col-12">
                                    <div class="form-label">&nbsp;</div>
                                    <button class="btn btn-primary" style="font-size: 12px">Search (शोधा)</button>
                                    <button class="btn btn-success" type="button" id="exportAsExcel" style="font-size: 12px">Export As Excel</button>
                                </div>
                            </div>
                        </form>
                        <hr>
                        <div class="table-responsive table-bordered">
                            <table class="display" id="basic-1">
                                <thead>
                                    <tr>
                                        <th>अ.क्र.</th>
                                        <th>युनिक क्र</th>
                                        <th>वर्क ऑर्डर क्र</th>
                                        <th>प्रसिध्दीचा स्तर</th>
                                        <th>कामाची किंमत</th>
                                        <th>विभाग</th>
                                        <th>प्रिंट प्रकार</th>
                                        <th>बॅनर आकार</th>
                                        <th>कृती </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ( $advertises as $advertise )
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $advertise->unique_number }}</td>
                                        <td>{{ $advertise->work_order_number }}</td>
                                        <td>{{ $advertise?->publicationType?->name }}</td>
                                        <td>{{ $advertise?->cost?->name }}</td>
                                        <td>{{ $advertise?->department?->name }}</td>
                                        <td>{{ $advertise?->printType?->name }}</td>
                                        <td>{{ $advertise?->bannerSize?->size }}</td>
                                        <td>
                                            <ul class="action">
                                                @if($advertise->is_mail_send == '0')
                                                <li class="edit">
                                                    <a href="{{ route('advertise.edit', $advertise->id) }}"><button class="btn btn-square btn-warning" type="button">सुधारणे
                                                    </button></a>
                                                </li>
                                                @endif
                                                @if($advertise->is_mail_send == '0')
                                                <li class="edit">
                                                    <a href="{{ route('send-mail.index', $advertise->id) }}"><button class="btn btn-square btn-info" type="button">मेल पाठवा
                                                    </button></a>
                                                </li>
                                                @endif
                                                <li class="edit">
                                                    <a href="{{ route('advertise.preview', $advertise->id) }}"><button class="btn btn-square btn-primary" type="button">पहा
                                                    </button></a>
                                                </li>

                                                @if(Auth::user()->user_type == "1")
                                                <li class="delete">
                                                    <form action="{{ route('advertise.delete', $advertise->id) }}" method="POST">
                                                        @csrf
                                                        <input type="hidden" name="id" value="{{ $advertise->id }}">
                                                        <button class="btn btn-square btn-danger" type="submit" onclick="return confirm('Are you sure you want to remove this advertise')">हटवा
                                                        </button>
                                                    </form>
                                                </li>
                                                @endif
                                            </ul>
                                        </td>
                                    </tr>
                                    @endforeach

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Zero Configuration  Ends-->
        </div>
    </div>
    <!-- Container-fluid Ends-->
    @push('scripts')
    <script>
        $(document).ready(function(){
            $('#exportAsExcel').click(function(){
                let data = $('#filterList').serialize()
                window.location.href = "{{ route('advertise.export') }}?"+data;
            })
        });
    </script>
    @endpush
</x-layout>
