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
                        <li class="breadcrumb-item active">Expandature</li>
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
                                <h5 class="text-white mt-1">List Expandature</h5>
                            </div>
                            <div class="col-6 text-end">
                                <a href="{{ route('expandeture.create') }}"><button class="btn btn-square btn-warning-gradien" type="button">Add Expandature <i class="fa fa-plus" aria-hidden="true"></i>
                                </button></a>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="table-responsive table-bordered">
                            <table class="display" id="basic-1">
                                <thead>
                                    <tr>
                                        <th>Sr No.</th>
                                        <th>Bill No</th>
                                        <th>News Paper</th>
                                        <th>Invoice Amount</th>
                                        <th>Balance</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ( $expandatures as $expandature )
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $expandature?->billing?->bill_number }}</td>
                                        <td>{{ $expandature?->newsPaper?->name }}</td>
                                        <td>{{ $expandature->invoice_amount }}</td>
                                        <td>{{ $expandature->balance }}</td>
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
