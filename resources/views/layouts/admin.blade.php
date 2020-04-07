<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
{{--    <script src="{{ asset('backend/js/app.js') }}" defer></script>--}}

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
{{--    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">--}}
    <link href="{{ asset('backend/css/style.default.css') }}" rel="stylesheet">
    <link href="{{ asset('backend/css/jquery.datatables.css') }}" rel="stylesheet">

    <!-- Styles -->
{{--    <link href="{{ asset('backend/css/app.css') }}" rel="stylesheet">--}}
</head>
<body>

<!-- Preloader -->
<div id="preloader">
    <div id="status"><i class="fa fa-spinner fa-spin"></i></div>
</div>

<section>

    <div class="leftpanel">

        <div class="logopanel">
            <h1><span>[</span> Jaco <span>]</span></h1>
        </div><!-- logopanel -->

        <div class="leftpanelinner">
            <!-- This is only visible to small devices -->
            <div class="visible-xs hidden-sm hidden-md hidden-lg">
                <div class="media userlogged">
                    <img alt="" src="{{ asset('/backend/images/photos/loggeduser.png') }}" class="media-object">
                    <div class="media-body">
                        <h4>John Doe</h4>
                        <span>"Life is so..."</span>
                    </div>
                </div>

                <h5 class="sidebartitle actitle">Account</h5>
                <ul class="nav nav-pills nav-stacked nav-bracket mb30">
                    <li><a href="profile.html"><i class="fa fa-user"></i> <span>Profile</span></a></li>
                    <li><a href=""><i class="fa fa-cog"></i> <span>Account Settings</span></a></li>
                    <li><a href=""><i class="fa fa-question-circle"></i> <span>Help</span></a></li>
                    <li><a href="{{ route('logout') }}"
                           onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();"><i
                                class="fa fa-sign-out"></i> Log Out</a></li>
                </ul>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </div>

            <h5 class="sidebartitle">Navigation</h5>
            <ul class="nav nav-pills nav-stacked nav-bracket">
                <li class="active"><a href="index.html"><i class="fa fa-home"></i> <span>Dashboard</span></a></li>
                <li><a href="email.html"><span class="pull-right badge badge-success">2</span><i class="fa fa-envelope-o"></i> <span>Email</span></a></li>
                <li class="nav-parent"><a href=""><i class="fa fa-edit"></i> <span>Forms</span></a>
                    <ul class="children">
                        <li><a href="general-forms.html"><i class="fa fa-caret-right"></i> General Forms</a></li>
                        <li><a href="form-layouts.html"><i class="fa fa-caret-right"></i> Form Layouts</a></li>
                        <li><a href="form-validation.html"><i class="fa fa-caret-right"></i> Form Validation</a></li>
                        <li><a href="form-wizards.html"><i class="fa fa-caret-right"></i> Form Wizards</a></li>
                        <li><a href="wysiwyg.html"><i class="fa fa-caret-right"></i> WYSIWYG Text Editor</a></li>
                    </ul>
                </li>
                <li class="nav-parent"><a href=""><i class="fa fa-suitcase"></i> <span>UI Elements</span></a>
                    <ul class="children">
                        <li><a href="buttons.html"><i class="fa fa-caret-right"></i> Buttons</a></li>
                        <li><a href="icons.html"><i class="fa fa-caret-right"></i> Icons</a></li>
                        <li><a href="typography.html"><i class="fa fa-caret-right"></i> Typography</a></li>
                        <li><a href="alerts.html"><i class="fa fa-caret-right"></i> Alerts &amp; Notifications</a></li>
                        <li><a href="tabs-accordions.html"><i class="fa fa-caret-right"></i> Tabs &amp; Accordions</a></li>
                        <li><a href="sliders.html"><i class="fa fa-caret-right"></i> Sliders</a></li>
                        <li><a href="graphs.html"><i class="fa fa-caret-right"></i> Graphs &amp; Charts</a></li>
                        <li><a href="widgets.html"><i class="fa fa-caret-right"></i> Panels &amp; Widgets</a></li>
                        <li><a href="extras.html"><i class="fa fa-caret-right"></i> Extras</a></li>
                    </ul>
                </li>
                <li><a href="tables.html"><i class="fa fa-th-list"></i> <span>Tables</span></a></li>
                <li><a href="maps.html"><i class="fa fa-map-marker"></i> <span>Maps</span></a></li>
                <li class="nav-parent"><a href=""><i class="fa fa-file-text"></i> <span>Pages</span></a>
                    <ul class="children">
                        <li><a href="calendar.html"><i class="fa fa-caret-right"></i> Calendar</a></li>
                        <li><a href="media-manager.html"><i class="fa fa-caret-right"></i> Media Manager</a></li>
                        <li><a href="timeline.html"><i class="fa fa-caret-right"></i> Timeline</a></li>
                        <li><a href="blog-list.html"><i class="fa fa-caret-right"></i> Blog List</a></li>
                        <li><a href="blog-single.html"><i class="fa fa-caret-right"></i> Blog Single</a></li>
                        <li><a href="people-directory.html"><i class="fa fa-caret-right"></i> People Directory</a></li>
                        <li><a href="profile.html"><i class="fa fa-caret-right"></i> Profile</a></li>
                        <li><a href="invoice.html"><i class="fa fa-caret-right"></i> Invoice</a></li>
                        <li><a href="search-results.html"><i class="fa fa-caret-right"></i> Search Results</a></li>
                        <li><a href="blank.html"><i class="fa fa-caret-right"></i> Blank Page</a></li>
                        <li><a href="notfound.html"><i class="fa fa-caret-right"></i> 404 Page</a></li>
                        <li><a href="locked.html"><i class="fa fa-caret-right"></i> Locked Screen</a></li>
                        <li><a href="signin.html"><i class="fa fa-caret-right"></i> Sign In</a></li>
                        <li><a href="signup.html"><i class="fa fa-caret-right"></i> Sign Up</a></li>
                    </ul>
                </li>
                <li class="nav-parent"><a href="layouts.html"><i class="fa fa-laptop"></i> <span>Skins &amp; Layouts</span></a>
                    <ul class="children">
                        <li><a href="layouts.html"><i class="fa fa-caret-right"></i> General Layouts</a></li>
                        <li><a href="horizontal-menu.html"><span class="pull-right badge badge-info">new</span><i class="fa fa-caret-right"></i> Top Menu</a></li>
                        <li><a href="horizontal-menu2.html"><span class="pull-right badge badge-info">new</span><i class="fa fa-caret-right"></i> Top Menu w/ Sidebar</a></li>
                        <li><a href="fixed-width.html"><span class="pull-right badge badge-info">new</span><i class="fa fa-caret-right"></i> Fixed Width Page</a></li>
                    </ul>
                </li>
            </ul>

            <div class="infosummary">
                <h5 class="sidebartitle">Information Summary</h5>
                <ul>
                    <li>
                        <div class="datainfo">
                            <span class="text-muted">Daily Traffic</span>
                            <h4>630, 201</h4>
                        </div>
                        <div id="sidebar-chart" class="chart"></div>
                    </li>
                    <li>
                        <div class="datainfo">
                            <span class="text-muted">Average Users</span>
                            <h4>1, 332, 801</h4>
                        </div>
                        <div id="sidebar-chart2" class="chart"></div>
                    </li>
                    <li>
                        <div class="datainfo">
                            <span class="text-muted">Disk Usage</span>
                            <h4>82.2%</h4>
                        </div>
                        <div id="sidebar-chart3" class="chart"></div>
                    </li>
                    <li>
                        <div class="datainfo">
                            <span class="text-muted">CPU Usage</span>
                            <h4>140.05 - 32</h4>
                        </div>
                        <div id="sidebar-chart4" class="chart"></div>
                    </li>
                    <li>
                        <div class="datainfo">
                            <span class="text-muted">Memory Usage</span>
                            <h4>32.2%</h4>
                        </div>
                        <div id="sidebar-chart5" class="chart"></div>
                    </li>
                </ul>
            </div><!-- infosummary -->

        </div><!-- leftpanelinner -->
    </div><!-- leftpanel -->

    <div class="mainpanel">

        <div class="headerbar">

            <a class="menutoggle"><i class="fa fa-bars"></i></a>

            <div class="header-right">
                <ul class="headermenu">
                    <li>
                        <div class="btn-group">
                            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                                <img src="/backend/images/photos/loggeduser.png" alt="" />
                                John Doe
                                <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-usermenu pull-right">
                                <li><a href="profile.html"><i class="glyphicon glyphicon-user"></i> My Profile</a></li>
                                <li><a href="#"><i class="glyphicon glyphicon-cog"></i> Account Settings</a></li>
                                <li><a href="#"><i class="glyphicon glyphicon-question-sign"></i> Help</a></li>
                                <li><a href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();"><i
                                            class="glyphicon glyphicon-log-out"></i> Log Out</a></li>
                            </ul>
                        </div>
                    </li>
                </ul>
            </div><!-- header-right -->

        </div><!-- headerbar -->

<section>
    @yield('content')
</section>

    </div><!-- mainpanel -->


</section>





<script src="{{ asset('backend/js/jquery-1.10.2.min.js') }}"></script>
<script src="{{ asset('backend/js/jquery-migrate-1.2.1.min.js') }}"></script>
<script src="{{ asset('backend/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('backend/js/modernizr.min.js') }}"></script>
<script src="{{ asset('backend/js/retina.min.js') }}"></script>

<script src="{{ asset('backend/js/jquery.sparkline.min.js') }}"></script>
<script src="{{ asset('backend/js/toggles.min.js') }}"></script>
<script src="{{ asset('backend/js/jquery.cookies.js') }}"></script>

<script src="{{ asset('backend/js/jquery.datatables.min.js') }}"></script>
<script src="{{ asset('backend/js/chosen.jquery.min.js') }}"></script>

<script src="{{ asset('backend/js/custom.js') }}"></script>

@yield('scripts')
</body>
</html>
