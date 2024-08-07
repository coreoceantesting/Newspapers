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
                        <li class="breadcrumb-item active">List Account Details (वर्तमानपत्र खात्यांच्या तपशिलांची यादी)</li>
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
                                <h5 class="text-white mt-1">List Account Details (वर्तमानपत्र खात्यांच्या तपशिलांची यादी)</h5>
                            </div>
                            <div class="col-6 text-end">
                                <a href="{{ route('account-details.create') }}"><button class="btn btn-square btn-warning-gradien" type="button">Add Account Details (वर्तमानपत्र खाते जोडा) <i class="fa fa-plus" aria-hidden="true"></i>
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
                                        <th>वर्तमानपत्राचे नाव</th>
                                        <th>बँक</th>
                                        <th>शाखा</th>
                                        <th>खाते क्रमांक</th>
                                        <th>IFSC कोड</th>
                                        <th>पॅन कार्ड</th>
                                        <th>GST No</th>
                                        <th>File</th>
                                        <th>कृती</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ( $accountDetails as $accountDetail )
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $accountDetail?->newsPaper?->name }}</td>
                                        <td>{{ $accountDetail->bank }}</td>
                                        <td>{{ $accountDetail->branch }}</td>
                                        <td>{{ $accountDetail->account_number }}</td>
                                        <td>{{ $accountDetail->ifsc_code }}</td>
                                        <td>{{ $accountDetail->pan_card }}</td>
                                        <td>{{ $accountDetail->gst_no }}</td>
                                        <td>@if($accountDetail->document)<a href="{{ asset('storage/'. $accountDetail->document) }}" target="_blank" class="btn btn-primary btn-sm">document</a> @else - @endif</td>
                                        <td>
                                            <ul class="action">
                                                <li class="edit">
                                                    <a href="{{ route('account-details.edit', $accountDetail->id) }}"><button class="btn btn-square btn-primary" type="button">Edit &nbsp;<i class="fa fa-pencil text-white" aria-hidden="true"></i>
                                                    </button></a>
                                                </li>
                                                <li class="delete">

                                                    <form action="{{ route('account-details.destroy', $accountDetail->id) }}" method="POST">
                                                        @csrf
                                                        @method('delete')
                                                        <input type="hidden" name="id" value="{{ $accountDetail->id }}">
                                                        <button class="btn btn-square btn-danger" type="submit" onclick="return confirm('Are you sure you want to remove this news paper account details')"><i class="fa fa-trash text-white" aria-hidden="true"></i>
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
