<x-layout>
    <!-- Container-fluid starts-->

    @push('styles')
        <style>
            .default-dash .investment-sec:hover{
                box-shadow: 19px 23px 22px 0 rgba(135,135,135, 0.4);
                transition: 1;
            }

            .default-dash .investment-sec{
                border: 1px solid #a39e9e;
            }
        </style>
    @endpush
    <div class="container-fluid default-dash">

        <div class="row">
            <div class="col-lg-6 col-md-6 col-12">
                <div class="row" style="margin-bottom: -14px;">
                    <div class="col-xl-4 col-lg-4 col-sm-4 p-0">
                        <a href="{{ route('advertise.index') }}">
                            <div class="card investment-sec">
                                <div class="card-header bg-primary"><span class="text-white">Today's Advertise <br>(आजच्या जाहिराती)</span></div>
                                {{-- <div class="animated-bg"><i></i><i></i><i></i></div> --}}
                                <div class="card-body">
                                    <h6 class="text-dark">{{ $todayAdvertise }}</h6>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-xl-4 col-lg-4 col-sm-4 p-0">
                        <a href="{{ route('advertise.index') }}">
                            <div class="card investment-sec">
                                <div class="card-header bg-primary"><span class="text-white">Monthly Advertise <br>(मासिक जाहिराती )</span></div>
                                {{-- <div class="animated-bg"><i></i><i></i><i></i></div> --}}
                                <div class="card-body">
                                    <h6 class="text-dark">{{ $thisMonthAdvertise }}</h6>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-xl-4 col-lg-4 col-sm-4 p-0">
                        <a href="{{ route('advertise.index') }}">
                            <div class="card investment-sec">
                                <div class="card-header bg-primary"><span class="text-white">Total Advertise <br>(एकूण जाहिराती)</span></div>
                                {{-- <div class="animated-bg"><i></i><i></i><i></i></div> --}}
                                <div class="card-body">
                                    <h6 class="text-dark">{{ $thisYearAdvertise }}</h6>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>



                <div class="row" style="margin-bottom: -14px;">
                    <div class="col-xl-4 col-lg-4 col-sm-4 p-0">
                        <a href="{{ route('billing.index') }}">
                            <div class="card investment-sec">
                                <div class="card-header bg-primary"><span class="text-white">Today's Bill <br>(आजची बिले)</span></div>
                                {{-- <div class="animated-bg"><i></i><i></i><i></i></div> --}}
                                <div class="card-body">
                                    <h6 class="text-dark">{{ $todayBill }}</h6>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-xl-4 col-lg-4 col-sm-4 p-0">
                        <a href="{{ route('billing.index') }}">
                            <div class="card investment-sec">
                                <div class="card-header bg-primary"><span class="text-white">Monthly Bill <br>(मासिक बिले)</span></div>
                                {{-- <div class="animated-bg"><i></i><i></i><i></i></div> --}}
                                <div class="card-body">
                                    <h6 class="text-dark">{{ $thisMonthBill }}</h6>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-xl-4 col-lg-4 col-sm-4 p-0">
                        <a href="{{ route('billing.index') }}">
                            <div class="card investment-sec">
                                <div class="card-header bg-primary"><span class="text-white">Total Bill <br>(एकूण बिले)</span></div>
                                {{-- <div class="animated-bg"><i></i><i></i><i></i></div> --}}
                                <div class="card-body">
                                    <h6 class="text-dark">{{ $thisYearBill }}</h6>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>

                <div class="row" style="margin-bottom: -14px;">
                    <div class="col-xl-4 col-lg-4 col-sm-4 p-0">
                        <a href="javascript:void(0)">
                            <div class="card investment-sec">
                                <div class="card-header bg-primary"><span class="text-white">Total Budget <br> (एकूण बजेट)</span></div>
                                {{-- <div class="animated-bg"><i></i><i></i><i></i></div> --}}
                                <div class="card-body">
                                    <h6 class="text-dark">{{ round($totalBudget, 2) }}</h6>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-xl-4 col-lg-4 col-sm-4 p-0">
                        <a href="javascript:void(0)">
                            <div class="card investment-sec">
                                <div class="card-header bg-primary"><span class="text-white">Total Advertise Cost <br>(एकूण जाहिरात खर्च)</span></div>
                                {{-- <div class="animated-bg"><i></i><i></i><i></i></div> --}}
                                <div class="card-body">
                                    <h6 class="text-dark">{{ round($totalAdvertiseCost, 2) }}</h6>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-xl-4 col-lg-4 col-sm-4 p-0">
                        <a href="javascript:void(0)">
                            <div class="card investment-sec">
                                <div class="card-header bg-primary"><span class="text-white">Remaining Budget <br>(उर्वरित बजेट)</span></div>
                                {{-- <div class="animated-bg"><i></i><i></i><i></i></div> --}}
                                <div class="card-body">
                                    <h6 class="text-dark">{{ round($totalBudget - $totalAdvertiseCost, 2) }}</h6>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>

            <div class="col-lg-6 col-md-6 col-12">
                <div class="card">
                    <div class="card-header bg-primary">
                        <div class="d-flex justify-content-between">
                            <p class="text-white" style="font-size: 16px;margin-bottom: 1px;">Latest Advertise</p>
                            <a href="{{ route('advertise.index') }}" style="padding: 6px 13px 4px 13px;font-size:10px" class="btn btn-sm btn-warning">View All</a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th style="font-size: 12px;">Sr.No</th>
                                        <th style="font-size: 12px;">Unique No</th>
                                        <th style="font-size: 12px;">Publication Type</th>
                                        <th style="font-size: 12px;">Publication Date</th>
                                        <th style="font-size: 12px;">Print Type</th>
                                        <th style="font-size: 12px;">Banner Size</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($advertises as $advertise)
                                    <tr>
                                        <td style="font-size: 12px;">{{ $loop->iteration }}</td>
                                        <td style="font-size: 12px;">{{ $advertise->unique_number }}</td>
                                        <td style="font-size: 12px;">{{ $advertise->publicationType?->name }}</td>
                                        <td style="font-size: 12px;">{{ date('d-m-Y', strtotime($advertise->publication_date)) }}</td>
                                        <td style="font-size: 12px;">{{ $advertise->printType?->name }}</td>
                                        <td style="font-size: 12px;">{{ $advertise->bannerSize?->size }}</td>
                                    </tr>
                                    @empty
                                        <tr>
                                            <td align="center" colspan="5" style="font-size: 12px;">Data Not Found</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="row">
            <div class="col-lg-6 col-md-6 col-12">
                <div class="card">
                    <div class="card-header bg-primary">
                        <div class="d-flex justify-content-between">
                            <p class="text-white" style="font-size: 16px;margin-bottom: 1px;">Latest Bill</p>
                            <a href="{{ route('billing.index') }}" style="padding: 6px 13px 4px 13px;font-size:10px" class="btn btn-sm btn-warning">View All</a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th style="font-size: 12px;">Sr.No</th>
                                        <th style="font-size: 12px;">Bill No</th>
                                        <th style="font-size: 12px;">Bill Date</th>
                                        <th style="font-size: 12px;">Bank</th>
                                        <th style="font-size: 12px;">Branch</th>
                                        <th style="font-size: 12px;">Account Number</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($billing as $bill)
                                    <tr>
                                        <td style="font-size: 12px;">{{ $loop->iteration }}</td>
                                        <td style="font-size: 12px;">{{ $bill->bill_number }}</td>
                                        <td style="font-size: 12px;">{{ date('d-m-Y', strtotime($bill->bill_date)) }}</td>
                                        <td style="font-size: 12px;">{{ $bill->accountDetails?->bank }}</td>
                                        <td style="font-size: 12px;">{{ $bill->accountDetails?->branch }}</td>
                                        <td style="font-size: 12px;">{{ $bill->accountDetails?->account_number }}</td>
                                    </tr>
                                    @empty
                                        <tr>
                                            <td align="center" colspan="5" style="font-size: 12px;">Data Not Found</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-6 col-md-6 col-12">
                <div class="card">
                    <div class="card-header bg-primary">
                        <div class="d-flex justify-content-between">
                            <p class="text-white" style="font-size: 16px;margin-bottom: 1px;">Latest Expense</p>
                            <a href="{{ route('expandeture.index') }}" style="padding: 6px 13px 4px 13px;font-size:10px" class="btn btn-sm btn-warning">View All</a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th style="font-size: 12px;">Sr.No</th>
                                        <th style="font-size: 12px;">Unique No</th>
                                        <th style="font-size: 12px;">Net Amount</th>
                                        <th style="font-size: 12px;">Prograssive Expandetures</th>
                                        <th style="font-size: 12px;">Balance</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($expenses as $expense)
                                    <tr>
                                        <td style="font-size: 12px;">{{ $loop->iteration }}</td>
                                        <td style="font-size: 12px;">{{ $expense->unique_no }}</td>
                                        <td style="font-size: 12px;">{{ $expense->net_amount }}</td>
                                        <td style="font-size: 12px;">{{ $expense->progressive_expandetures }}</td>
                                        <td style="font-size: 12px;">{{ $expense->balance }}</td>
                                    </tr>
                                    @empty
                                        <tr>
                                            <td align="center" colspan="5" style="font-size: 12px;">Data Not Found</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </div>
    <!-- Container-fluid Ends-->
</x-layout>
