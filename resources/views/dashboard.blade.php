<x-layout>
    <!-- Container-fluid starts-->
    <div class="container-fluid default-dash">

        <div class="row">
            <div class="col-xl-4 col-lg-4 col-sm-4">
                <a href="{{ route('advertise.index') }}">
                    <div class="card investment-sec">
                        <div class="card-header bg-warning"><h3>Today Advertise</h3></div>
                        {{-- <div class="animated-bg"><i></i><i></i><i></i></div> --}}
                        <div class="card-body">
                            <h2 class="text-dark">{{ $todayAdvertise }}</h2>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-xl-4 col-lg-4 col-sm-4">
                <a href="{{ route('advertise.index') }}">
                    <div class="card investment-sec">
                        <div class="card-header bg-success"><h3>This Month Advertise</h3></div>
                        {{-- <div class="animated-bg"><i></i><i></i><i></i></div> --}}
                        <div class="card-body">
                            <h2 class="text-dark">{{ $thisMonthAdvertise }}</h2>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-xl-4 col-lg-4 col-sm-4">
                <a href="{{ route('advertise.index') }}">
                    <div class="card investment-sec">
                        <div class="card-header bg-danger"><h3>Total Advertise</h3></div>
                        {{-- <div class="animated-bg"><i></i><i></i><i></i></div> --}}
                        <div class="card-body">
                            <h2 class="text-dark">{{ $thisYearAdvertise }}</h2>
                        </div>
                    </div>
                </a>
            </div>
        </div>


        <div class="row">
            <div class="col-xl-4 col-lg-4 col-sm-4">
                <a href="{{ route('billing.index') }}">
                    <div class="card investment-sec">
                        <div class="card-header bg-warning"><h3>Today Bill</h3></div>
                        {{-- <div class="animated-bg"><i></i><i></i><i></i></div> --}}
                        <div class="card-body">
                            <h2 class="text-dark">{{ $todayBill }}</h2>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-xl-4 col-lg-4 col-sm-4">
                <a href="{{ route('billing.index') }}">
                    <div class="card investment-sec">
                        <div class="card-header bg-success"><h3>This month Bill</h3></div>
                        {{-- <div class="animated-bg"><i></i><i></i><i></i></div> --}}
                        <div class="card-body">
                            <h2 class="text-dark">{{ $thisMonthBill }}</h2>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-xl-4 col-lg-4 col-sm-4">
                <a href="{{ route('billing.index') }}">
                    <div class="card investment-sec">
                        <div class="card-header bg-danger"><h3>Total Bill</h3></div>
                        {{-- <div class="animated-bg"><i></i><i></i><i></i></div> --}}
                        <div class="card-body">
                            <h2 class="text-dark">{{ $thisYearBill }}</h2>
                        </div>
                    </div>
                </a>
            </div>
        </div>

        <div class="row">
            <div class="col-xl-4 col-lg-4 col-sm-4">
                <a href="javascript:void(0)">
                    <div class="card investment-sec">
                        <div class="card-header bg-warning"><h3>Total Budget</h3></div>
                        {{-- <div class="animated-bg"><i></i><i></i><i></i></div> --}}
                        <div class="card-body">
                            <h2 class="text-dark">{{ round($totalBudget, 2) }}</h2>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-xl-4 col-lg-4 col-sm-4">
                <a href="javascript:void(0)">
                    <div class="card investment-sec">
                        <div class="card-header bg-success"><h3>Total Advertise Cost</h3></div>
                        {{-- <div class="animated-bg"><i></i><i></i><i></i></div> --}}
                        <div class="card-body">
                            <h2 class="text-dark">{{ round($totalAdvertiseCost, 2) }}</h2>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-xl-4 col-lg-4 col-sm-4">
                <a href="javascript:void(0)">
                    <div class="card investment-sec">
                        <div class="card-header bg-danger"><h3>Remaining Cost</h3></div>
                        {{-- <div class="animated-bg"><i></i><i></i><i></i></div> --}}
                        <div class="card-body">
                            <h2 class="text-dark">{{ round($totalBudget - $totalAdvertiseCost, 2) }}</h2>
                        </div>
                    </div>
                </a>
            </div>
        </div>

    </div>
    <!-- Container-fluid Ends-->
</x-layout>
