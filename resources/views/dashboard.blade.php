<x-layout>
    <!-- Container-fluid starts-->
    <div class="container-fluid default-dash">
        <div class="row">


                    <div class="col-xl-3 col-lg-4 col-sm-4">
                        <a href="{{ route('billing.index') }}">
                            <div class="card investment-sec">
                                <div class="animated-bg"><i></i><i></i><i></i></div>
                                <div class="card-body">
                                    <div class="icon"><i data-feather="dollar-sign"></i></div>
                                    <p>एकूण बिल</p>
                                    <h3>{{ $totalBilling }}</h3>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-xl-3 col-lg-4 col-sm-4">
                        <a href="{{ route('advertise.index') }}">
                            <div class="card investment-sec">
                                <div class="animated-bg"><i></i><i></i><i></i></div>
                                <div class="card-body">
                                    <div class="icon"><i data-feather="database"></i></div>
                                    <p>एकूण जाहिरात</p>
                                    <h3>{{ $totalAdvertise }}</h3>
                                </div>
                            </div>
                        </a>
                    </div>

        </div>
    </div>
    <!-- Container-fluid Ends-->
</x-layout>
