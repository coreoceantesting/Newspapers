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
                        <li class="breadcrumb-item active">List Bill (बिलांची यादी) </li>
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
                                <h5 class="text-white mt-1">List Bill (बिलांची यादी) </h5>
                            </div>
                            <div class="col-6 text-end">
                                <a href="{{ route('billing.export') }}"><button class="btn btn-square btn-success-gradien" type="button">Export As Excel
                                </button></a>

                                <a href="{{ route('billing.create') }}"><button class="btn btn-square btn-warning-gradien" type="button">Add Bill (बिल जोडा) <i class="fa fa-plus" aria-hidden="true"></i>
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
                                        <th>विभाग</th>
                                        <th>वर्तमानपत्राचे नाव</th>
                                        <th>बिल क्र.</th>
                                        <th>बँक</th>
                                        <th>शाखा</th>
                                        <th>खाते क्रमांक</th>
                                        <th>IFSC कोड</th>
                                        <th>कृती</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ( $billing as $bill )
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $bill?->department?->name }}</td>
                                        <td>{{ $bill?->newsPaper?->name }}</td>
                                        <td>{{ $bill->bill_number }}</td>
                                        <td>{{ $bill?->accountDetails?->bank }}</td>
                                        <td>{{ $bill?->accountDetails?->branch }}</td>
                                        <td>{{ $bill?->accountDetails?->account_number }}</td>
                                        <td>{{ $bill?->accountDetails?->ifsc_code }}</td>
                                        <td>
                                            <ul class="action">
                                                @if($bill->is_expandeture_created == "0")
                                                <li class="edit">
                                                    <a href="{{ route('billing.edit', $bill->id) }}"><button class="btn btn-square btn-primary" type="button"><i class="fa fa-pencil text-white" aria-hidden="true"></i>
                                                    </button></a>
                                                </li>
                                                <li class="delete">

                                                    <form action="{{ route('billing.destroy', $bill->id) }}" method="POST">
                                                        @csrf
                                                        @method('delete')
                                                        <input type="hidden" name="id" value="{{ $bill->id }}">
                                                        <button class="btn btn-square btn-danger" type="submit" onclick="return confirm('Are you sure you want to remove this bill')"><i class="fa fa-trash text-white" aria-hidden="true"></i>
                                                        </button>
                                                    </form>
                                                </li>
                                                @endif
                                                <li class="edit mx-1">
                                                    <a href="{{ route('billing.show', $bill->id) }}"><button class="btn btn-square btn-primary" type="button">पहा
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
