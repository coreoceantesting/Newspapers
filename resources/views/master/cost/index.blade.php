<x-layout>
    <div class="container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-sm-6">
                    {{-- <h5>कामाची किंमत</h5> --}}
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('/dashboard') }}"> <i data-feather="home"></i></a></li>
                        <li class="breadcrumb-item active">List Cost (कामाची किंमत)</li>
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
                                <h5 class="text-white mt-1">List Cost (कामाची किंमत यादी)</h5>
                            </div>
                            <div class="col-6 text-end">
                                <a href="{{ route('cost.create') }}"><button class="btn btn-square btn-warning-gradien" type="button">Add Cost (कामाची किंमत जोडा) <i class="fa fa-plus" aria-hidden="true"></i>
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
                                        <th>कामाची किंमत </th>
                                        <th>कृती</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ( $costs as $cost )
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $cost->name }}</td>
                                        <td>
                                            <ul class="action">
                                                <li class="edit">
                                                    <a href="{{ route('cost.edit', $cost->id) }}"><button class="btn btn-square btn-primary" type="button"><i class="fa fa-pencil text-white" aria-hidden="true"></i>
                                                    </button></a>
                                                </li>
                                                <li class="delete">

                                                    <form action="{{ route('cost.destroy', $cost->id) }}" method="POST">
                                                        @csrf
                                                        @method('delete')
                                                        <input type="hidden" name="id" value="{{ $cost->id }}">
                                                        <button class="btn btn-square btn-danger" type="submit" onclick="return confirm('Are you sure you want to remove this cost')"><i class="fa fa-trash text-white" aria-hidden="true"></i>
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
