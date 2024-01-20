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
                        <li class="breadcrumb-item active">जाहिरात यादी</li>
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
                                <h5 class="text-white mt-1">जाहिरात यादी</h5>
                            </div>
                            <div class="col-6 text-end">
                                <a href="{{ route('advertise.create') }}"><button class="btn btn-square btn-warning-gradien" type="button">जाहिरात जोडा <i class="fa fa-plus" aria-hidden="true"></i>
                                </button></a>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
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
                                                <li class="edit">
                                                    <a href="#"><button class="btn btn-square btn-primary" type="button">पहा
                                                    </button></a>
                                                </li>
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
</x-layout>
