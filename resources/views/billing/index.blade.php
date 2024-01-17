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
                        <li class="breadcrumb-item active">Bill</li>
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
                                <h5 class="text-white mt-1">Bill</h5>
                            </div>
                            <div class="col-6 text-end">
                                <a href="{{ route('billing.create') }}"><button class="btn btn-square btn-warning-gradien" type="button">Add Bill <i class="fa fa-plus" aria-hidden="true"></i>
                                </button></a>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="table-responsive table-bordered">
                            <table class="display" id="basic-1">
                                <thead>
                                    <tr>
                                        <th>Sr no.</th>
                                        <th>Department</th>
                                        <th>News paper</th>
                                        <th>Bill No</th>
                                        <th>Bank</th>
                                        <th>Branch</th>
                                        <th>Account No</th>
                                        <th>IFSC Code</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ( $billing as $bill )
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $bill?->department->name }}</td>
                                        <td>{{ $bill?->newsPaper->name }}</td>
                                        <td>{{ $bill->bill_number }}</td>
                                        <td>{{ $bill->bank }}</td>
                                        <td>{{ $bill->branch }}</td>
                                        <td>{{ $bill->account_number }}</td>
                                        <td>{{ $bill->ifsc_code }}</td>
                                        <td>
                                            <ul class="action">
                                                <li class="edit">
                                                    <a href="{{ route('billing.edit', $bill->id) }}"><button class="btn btn-square btn-primary" type="button">Edit &nbsp;<i class="fa fa-pencil text-white" aria-hidden="true"></i>
                                                    </button></a>
                                                </li>
                                                <li class="delete">

                                                    <form action="{{ route('billing.destroy', $bill->id) }}" method="POST">
                                                        @csrf
                                                        @method('delete')
                                                        <input type="hidden" name="id" value="{{ $bill->id }}">
                                                        <button class="btn btn-square btn-danger" type="submit" onclick="return confirm('Are you sure you want to remove this bill')">Delete &nbsp;<i class="fa fa-trash text-white" aria-hidden="true"></i>
                                                        </button>
                                                    </form>
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
