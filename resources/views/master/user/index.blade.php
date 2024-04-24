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
                        <li class="breadcrumb-item active">List user (वापरकर्ता यादी)</li>
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
                                <h5 class="text-white mt-1">List user (वापरकर्ता यादी)</h5>
                            </div>
                            <div class="col-6 text-end">
                                <a href="{{ route('user.create') }}"><button class="btn btn-square btn-warning-gradien" type="button">Add user (वापरकर्ता जोडा)<i class="fa fa-plus" aria-hidden="true"></i>
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
                                        <th>नाव</th>
                                        <th>ईमेल</th>
                                        <th>वापरकर्ता प्रकार</th>
                                        <th>स्थिती</th>
                                        <th>कृती</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ( $users as $user )
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>{{ ($user->user_type == "1") ? "Admin" : "User" }}</td>
                                        <td>
                                            @if($user->status)
                                                <span class="badge bg-success">Active</span>
                                            @else
                                                <span class="badge bg-danger">Inactive</span>
                                            @endif
                                        </td>
                                        <td>
                                            <ul class="action">
                                                <li class="edit">
                                                    <a href="{{ route('user.edit', $user->id) }}"><button class="btn btn-square btn-primary" type="button"><i class="fa fa-pencil text-white" aria-hidden="true"></i>
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
