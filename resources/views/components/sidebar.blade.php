<div class="sidebar-wrapper">
    <div>
        <div class="logo-wrapper">
            <a href="{{ route('dashboard') }}"><img class="img-fluid for-light" src="{{ asset('assets/images/logo/logo.png') }}" alt=""></a>
            <div class="back-btn"><i class="fa fa-angle-left"></i></div>
            {{-- <div class="toggle-sidebar" checked="checked"><i class="fa fa-cog status_toggle middle sidebar-toggle"> </i></div> --}}
        </div>
        <div class="logo-icon-wrapper"><a href="{{ route('dashboard') }}"><img class="img-fluid" src="{{ asset('assets/images/logo/logo-icon1.png') }}" alt=""></a></div>
        <nav class="sidebar-main">
            <div class="left-arrow" id="left-arrow"><i data-feather="arrow-left"></i></div>
            <div id="sidebar-menu">
                <ul class="sidebar-links" id="simple-bar">
                    <li class="back-btn"><a href="{{ route('dashboard') }}"><img class="img-fluid" src="{{ asset('assets/images/logo/logo-icon.png') }}" alt=""></a>
                        <div class="mobile-back text-end"><span>Back</span><i class="fa fa-angle-right ps-2" aria-hidden="true"></i></div>
                    </li>
                    <li class="sidebar-main-title">
                        <h6 class="lan-1">सामान्य </h6>
                    </li>
                    <li class="menu-box">
                        <ul>
                            <li class="sidebar-list">
                                <a class="sidebar-link sidebar-title link-nav @if(Request::is('dashboard'))activeUrl @endif" href="{{ route('dashboard') }}">
                                    <i data-feather="home"> </i>
                                    <span>डॅशबोर्ड</span>
                                </a>
                            </li>

                            @php
                            $active = "";
                            if(Request::is('department') || Request::is('language') || Request::is('news-paper-type') || Request::is('cost') || Request::is('advertise-cost') || Request::is('publication-type') || Request::is('financial-year') || Request::is('banner-size') || Request::is('print-type') || Request::is('budget-provision') || Request::is('news-paper') || Request::is('signature') || Request::is('account-details') || Request::is('department/*') || Request::is('language/*') || Request::is('news-paper-type/*') || Request::is('cost/*') || Request::is('advertise-cost/*') || Request::is('publication-type/*') || Request::is('financial-year/*') || Request::is('banner-size/*') || Request::is('print-type/*') || Request::is('budget-provision/*') || Request::is('news-paper/*') || Request::is('signature/*') || Request::is('account-details/*')){
                                $active = "activeUrl";
                            }
                            @endphp
                            <li class="sidebar-list"><a class="sidebar-link sidebar-title {{ $active }}" href="javascript:void(0)"><i data-feather="airplay"></i><span >मास्टर</span></a>
                                <ul class="sidebar-submenu">
                                    <li>
                                        <a @if(Request::is('department') || Request::is('department/*'))class="activeSubUrl" @endif href="{{ route('department.index') }}">विभाग</a>
                                    </li>
                                    <li>
                                        <a @if(Request::is('language') || Request::is('language/*'))class="activeSubUrl" @endif href="{{ route('language.index') }}">भाषा</a>
                                    </li>
                                    <li>
                                        <a @if(Request::is('news-paper-type') || Request::is('news-paper-type/*'))class="activeSubUrl" @endif href="{{ route('news-paper-type.index') }}">प्रसिध्दीचा स्तर</a>
                                    </li>
                                    <li>    
                                        <a @if(Request::is('news-paper') || Request::is('news-paper/*'))class="activeSubUrl" @endif href="{{ route('news-paper.index') }}">वर्तमानपत्र</a>
                                    </li>
                                    <li>
                                        <a @if(Request::is('publication-type') || Request::is('publication-type/*'))class="activeSubUrl" @endif href="{{ route('publication-type.index') }}">पब्लिकेशन प्रकार</a>
                                    </li>
                                    <li>
                                        <a @if(Request::is('cost') || Request::is('cost/*'))class="activeSubUrl" @endif href="{{ route('cost.index') }}">कामाची किंमत</a>
                                    </li>
                                    <li>
                                        <a @if(Request::is('advertise-cost') || Request::is('advertise-cost/*'))class="activeSubUrl" @endif href="{{ route('advertise-cost.index') }}">जाहिरात खर्च</a>
                                    </li>
                                    <li>
                                        <a @if(Request::is('financial-year') || Request::is('financial-year/*'))class="activeSubUrl" @endif href="{{ route('financial-year.index') }}">आर्थिक वर्ष</a>
                                    </li>
                                    <li>
                                        <a @if(Request::is('banner-size') || Request::is('banner-size/*'))class="activeSubUrl" @endif href="{{ route('banner-size.index') }}">बॅनर आकार</a>
                                    </li>
                                    <li>
                                        <a @if(Request::is('print-type') || Request::is('print-type/*'))class="activeSubUrl" @endif href="{{ route('print-type.index') }}">प्रिंट प्रकार</a>
                                    </li>
                                    <li>
                                        <a @if(Request::is('budget-provision') || Request::is('budget-provision/*'))class="activeSubUrl" @endif href="{{ route('budget-provision.index') }}">बजेट तरतूद</a>
                                    </li>
                                    <li>
                                        <a @if(Request::is('signature') || Request::is('signature/*'))class="activeSubUrl" @endif href="{{ route('signature.index') }}">स्वाक्षरी</a>
                                    </li>
                                    <li>
                                        <a @if(Request::is('account-details') || Request::is('account-details/*'))class="activeSubUrl" @endif href="{{ route('account-details.index') }}">
                                        खाते तपशील</a>
                                    </li>
                                </ul>
                            </li>
                            <li class="sidebar-list">
                                <a class="sidebar-link sidebar-title link-nav @if(Request::is('advertise') || Request::is('advertise/*'))activeUrl @endif" href="{{ route('advertise.index') }}">
                                    <i data-feather="feather"> </i>
                                    <span>जाहिरात करा</span>
                                </a>
                            </li>
                            <li class="sidebar-list">
                                <a class="sidebar-link sidebar-title link-nav @if(Request::is('billing') || Request::is('billing/*'))activeUrl @endif" href="{{ route('billing.index') }}">
                                    <i data-feather="file-text"> </i>
                                    <span>बिल</span>
                                </a>
                            </li>
                            <li class="sidebar-list">
                                <a class="sidebar-link sidebar-title link-nav @if(Request::is('report'))activeUrl @endif" href="{{ route('report.index') }}">
                                    <i data-feather="alert-circle"> </i>
                                    <span>अहवाल</span>
                                </a>
                            </li>
                            <li class="sidebar-list">
                                <a class="sidebar-link sidebar-title link-nav @if(Request::is('expandeture.*'))activeUrl @endif" href="{{ route('expandeture.index') }}">
                                    <i data-feather="alert-circle"> </i>
                                    <span>अहवाल खर्च</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
            <div class="right-arrow" id="right-arrow"><i data-feather="arrow-right"></i></div>
        </nav>
    </div>
</div>
