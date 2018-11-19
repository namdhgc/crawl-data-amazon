BEGIN HEADER -->
<style type="text/css">
    .goog-te-banner-frame.skiptranslate {
            display: none !important;
    } 
    body {
        top: 0px !important; 
    }

    #google_translate_element {
      color: transparent;
    }

    #google_translate_element a {
      display: none;
    }

    select.goog-te-combo {
        color: black;
    }

    div.goog-te-gadget {
        color: transparent !important;
    }

    .logo-default {
        width: 150px;
        margin: 20px 10px 0 !important;
    }

</style>
<div class="page-header navbar navbar-fixed-top">
    <!-- BEGIN HEADER INNER -->
    <div class="page-header-inner ">
        <!-- BEGIN LOGO -->
        
        <div class="page-logo">
            <a href="#">
                <img src="{{ URL::asset('assets/layouts/layout4/img/logo-light.png') }}" alt="logo" class="logo-default" />
            </a>
            <div class="menu-toggler sidebar-toggler " data-toggle="collapse" data-target=".navbar-collapse">
                <!-- DOC: Remove the above "hide" to enable the sidebar toggler button on header -->
            </div>
        </div>
        <!-- END LOGO -->
        <!-- BEGIN RESPONSIVE MENU TOGGLER -->
        <a href="javascript:;" class="menu-toggler responsive-toggler" data-toggle="collapse" data-target=".navbar-collapse"> </a>
        <!-- END RESPONSIVE MENU TOGGLER -->
        <!-- BEGIN PAGE ACTIONS -->
        <!-- DOC: Remove "hide" class to enable the page header actions -->
        <!-- <div class="page-actions">
            <div class="gg-translate">
                <div id="google_translate_element"></div>
            </div>   
        </div> -->
        <!-- END PAGE ACTIONS -->
        <!-- BEGIN PAGE TOP -->
        <div class="page-top">
            
            <div class="top-menu">
                <ul class="nav navbar-nav pull-right">
                    <li class="separator hide"> </li>
                    <li class="dropdown dropdown-user dropdown-dark">
                        <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">

                            <span class="username username-hide-on-mobile">{{ @Auth::guard('web')->user()->username }}</span>
                            <!-- DOC: Do not remove below empty space(&nbsp;) as its purposely used -->
                            <img alt="" class="img-circle" src="{{ URL::asset('assets/layouts/layout4/img/avatar9.jpg') }}" /> 
                            <span class="username username-hide-mobile">{{@Auth::guard('web')->user()->displayName}}</span>
                            
                        </a>

                        <ul class="dropdown-menu dropdown-menu-default">
                            <li>
                                <a href="{{ URL::Route('auth-get-change-password') }}">
                                    <i class="icon-user"></i> Đổi mật khẩu </a>
                            </li>
                            <li class="divider"> </li>
                            <li>
                                @if(@Auth::guard('web')->check() == true)
                                <a href="{{ URL::Route('auth-get-logout')}}"><i class="icon-key"></i> Đăng xuất </a>
                                @endif
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
            <!-- END TOP NAVIGATION MENU -->
        </div>
        <!-- END PAGE TOP -->
    </div>
    <!-- END HEADER INNER -->
</div>
<!-- END HEADER