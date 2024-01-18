<div class="sidebar-wrapper">
    <div>
        <div class="logo-wrapper1"><a href="{{ route('dashboard') }}"><img class="img-fluid for-light" src="{{ asset('assets/images/logo/logo.jpg') }}" alt=""></a>
            <div class="back-btn"><i class="fa fa-angle-left"></i></div>
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
                                <a class="sidebar-link sidebar-title link-nav" href="{{ route('dashboard') }}">
                                    <i data-feather="home"> </i>
                                    <span>डॅशबोर्ड</span>
                                </a>
                            </li>
                            <li class="sidebar-list"><a class="sidebar-link sidebar-title" href="javascript:void(0)"><i data-feather="airplay"></i><span >मास्टर</span></a>
                                <ul class="sidebar-submenu">
                                    <li><a href="{{ route('department.index') }}">विभाग</a></li>
                                    <li><a href="{{ route('language.index') }}">भाषा</a></li>
                                    <li><a href="{{ route('news-paper-type.index') }}">वृत्तपत्राचा प्रकार</a></li>
                                    <li><a href="{{ route('cost.index') }}">खर्च</a></li>
                                    <li><a href="{{ route('advertise-cost.index') }}">जाहिरात खर्च</a></li>
                                    <li><a href="{{ route('publication-type.index') }}">प्रकाशन प्रकार</a></li>
                                    <li><a href="{{ route('financial-year.index') }}">आर्थिक वर्ष</a></li>
                                    <li><a href="{{ route('banner-size.index') }}">बॅनर आकार</a></li>
                                    <li><a href="{{ route('print-type.index') }}">मुद्रण प्रकार</a></li>
                                    <li><a href="{{ route('budget-provision.index') }}">अर्थसंकल्पात तरतूद</a></li>
                                    <li><a href="{{ route('news-paper.index') }}">वृत्तपत्र</a></li>
                                    <li><a href="{{ route('signature.index') }}">स्वाक्षरी</a></li>
                                    <li><a href="{{ route('account-details.index') }}">
                                        खाते तपशील</a></li>
                                </ul>
                            </li>
                            <li class="sidebar-list">
                                <a class="sidebar-link sidebar-title link-nav" href="{{ route('advertise.index') }}">
                                    <i data-feather="feather"> </i>
                                    <span>जाहिरात करा</span>
                                </a>
                            </li>
                            <li class="sidebar-list">
                                <a class="sidebar-link sidebar-title link-nav" href="{{ route('billing.index') }}">
                                    <i data-feather="file-text"> </i>
                                    <span>बिल</span>
                                </a>
                            </li>
                            <li class="sidebar-list">
                                <a class="sidebar-link sidebar-title link-nav" href="{{ route('report.index') }}">
                                    <i data-feather="alert-circle"> </i>
                                    <span>अहवाल द्या</span>
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
