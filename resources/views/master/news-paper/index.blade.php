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
                        <li class="breadcrumb-item active">वृत्तपत्र</li>
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
                                <h5 class="text-white mt-1">वृत्तपत्र यादी</h5>
                            </div>
                            <div class="col-6 text-end">
                                <a href="{{ route('news-paper.create') }}"><button class="btn btn-square btn-warning-gradien" type="button">वृत्तपत्र जोडा <i class="fa fa-plus" aria-hidden="true"></i>
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
                                        <th>वृत्तपत्र प्रकार</th>
                                        <th>भाषा</th>
                                        <th>नाव</th>
                                        <th>संपादकाचे नाव</th>
                                        <th>ईमेल</th>
                                        <th>मोबाईल</th>
                                        <th>कृती</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ( $newsPapers as $newsPaper )
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $newsPaper?->newsPaperType?->name }}</td>
                                        <td>{{ $newsPaper?->language?->name }}</td>
                                        <td>{{ $newsPaper->name }}</td>
                                        <td>{{ $newsPaper->editor_name }}</td>
                                        <td>{{ $newsPaper->email }}</td>
                                        <td>{{ $newsPaper->mobile }}</td>
                                        <td>
                                            <ul class="action">
                                                <li class="edit">
                                                    <a href="{{ route('news-paper.edit', $newsPaper->id) }}"><button class="btn btn-square btn-primary" type="button">सुधारणे &nbsp;<i class="fa fa-pencil text-white" aria-hidden="true"></i>
                                                    </button></a>
                                                </li>
                                                <li class="delete">

                                                    <form action="{{ route('news-paper.destroy', $newsPaper->id) }}" method="POST">
                                                        @csrf
                                                        @method('delete')
                                                        <input type="hidden" name="id" value="{{ $newsPaper->id }}">
                                                        <button class="btn btn-square btn-danger" type="submit" onclick="return confirm('Are you sure you want to remove this news paper')">हटवा &nbsp;<i class="fa fa-trash text-white" aria-hidden="true"></i>
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
