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
                        <li class="breadcrumb-item active">List Advertise Cost (जाहिरात खर्च यादी)</li>
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
                                <h5 class="text-white mt-1">List Advertise Cost (जाहिरात खर्च यादी)</h5>
                            </div>
                            <div class="col-6 text-end">
                                <a href="{{ route('advertise-cost.create') }}"><button class="btn btn-square btn-warning-gradien" type="button">Add Advertise Cost (जाहिरात खर्च जोडा) <i class="fa fa-plus" aria-hidden="true"></i>
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
                                        <th>किंमत</th>
                                        <th>प्रसिध्दीचा स्तर</th>
                                        <th>भाषा</th>
                                        <th>वर्तमानपत्राची संख्या</th>
                                        <th>कृती</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ( $advertiseCosts as $advertiseCost )
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $advertiseCost?->cost?->name }}</td>
                                        <td>{{ $advertiseCost?->newsPaperType?->name }}</td>
                                        <td>{{ $advertiseCost?->language?->name }}</td>
                                        <td>{{ $advertiseCost->no_of_newspaper }}</td>
                                        <td>
                                            <ul class="action">
                                                <li class="edit">
                                                    <a href="{{ route('advertise-cost.edit', $advertiseCost->id) }}"><button class="btn btn-square btn-primary" type="button"><i class="fa fa-pencil text-white" aria-hidden="true"></i>
                                                    </button></a>
                                                </li>
                                                <li class="delete">

                                                    <form action="{{ route('advertise-cost.destroy', $advertiseCost->id) }}" method="POST">
                                                        @csrf
                                                        @method('delete')
                                                        <input type="hidden" name="id" value="{{ $advertiseCost->id }}">
                                                        <button class="btn btn-square btn-danger" type="submit" onclick="return confirm('Are you sure you want to remove this news paper type')"><i class="fa fa-trash text-white" aria-hidden="true"></i>
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
