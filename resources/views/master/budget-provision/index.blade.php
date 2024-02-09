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
                        <li class="breadcrumb-item active">List Budget Provision (बजेट तरतूद यादी)</li>
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
                                <h5 class="text-white mt-1">List Budget Provision (बजेट तरतूद यादी)</h5>
                            </div>
                            <div class="col-6 text-end">
                                <a href="{{ route('budget-provision.create') }}"><button class="btn btn-square btn-warning-gradien" type="button">Add Budget Provision (बजेट तरतूद जोडा) <i class="fa fa-plus" aria-hidden="true"></i>
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
                                        <th>आर्थिक वर्ष</th>
                                        <th>विभाग</th>
                                        <th>बजेट</th>
                                        <th>कृती</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ( $budgetProvisions as $budgetProvision )
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $budgetProvision?->financialYear?->year }}</td>
                                        <td>{{ $budgetProvision?->department?->name }}</td>
                                        <td>{{ $budgetProvision->budget }}</td>
                                        <td>
                                            <ul class="action">
                                                <li class="edit">
                                                    <a href="{{ route('budget-provision.edit', $budgetProvision->id) }}"><button class="btn btn-square btn-primary" type="button"><i class="fa fa-pencil text-white" aria-hidden="true"></i>
                                                    </button></a>
                                                </li>
                                                <li class="delete">

                                                    <form action="{{ route('budget-provision.destroy', $budgetProvision->id) }}" method="POST">
                                                        @csrf
                                                        @method('delete')
                                                        <input type="hidden" name="id" value="{{ $budgetProvision->id }}">
                                                        <button class="btn btn-square btn-danger" type="submit" onclick="return confirm('Are you sure you want to remove this budget provision')"><i class="fa fa-trash text-white" aria-hidden="true"></i>
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
