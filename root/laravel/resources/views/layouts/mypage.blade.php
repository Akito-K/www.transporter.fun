<!DOCTYPE html>
<html lang="ja" class="page-admin">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{!! $pagemeta->description !!}：{!! $pagemeta->title !!}</title>

    <!-- Styles -->
    <link href="{{ url('') }}/css/AdminLTE/AdminLTE.min.css" rel="stylesheet">
    <link href="{{ url('') }}/css/AdminLTE/all_skins.min.css" rel="stylesheet">
    <link href="{{ url('') }}/css/dest/admin.css" rel="stylesheet">

    <!-- Scripts -->
    <script>
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
        ]); ?>
    </script>

</head>
<body class="hold-transition sidebar-mini {!! $pagemeta->body_class !!} skin-yellow">

@include('include.admin.ajaxing')

    <div class="wrapper">

        <!-- Main Header -->
        <header class="main-header">
            <!-- Logo -->
            <a href="{{ url('') }}/mypage" class="logo">
                <!-- mini logo for sidebar mini 50x50 pixels -->
                <span class="logo-mini"><b>T</b>P</span>
                <!-- logo for regular state and mobile devices -->
                <span class="logo-lg"><b>Trans</b>Porter</span>
            </a>

            <!-- Header Navbar -->
            <nav class="navbar navbar-static-top" role="navigation">
                <!-- Sidebar toggle button-->
                <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                    <span class="sr-only">Toggle navigation</span>
                </a>

                <!-- Navbar Right Menu -->
                <div class="navbar-custom-menu">
                    <ul class="nav navbar-nav">
                        <!-- Messages: style can be found in dropdown.less-->
                        @include('include.mypage.push_messages')
                        <!-- User Account Menu -->
                        @include('include.mypage.user_account')
                    </ul>
                </div>
            </nav>
        </header>

        <!-- Left side column. contains the logo and sidebar -->
        <aside class="main-sidebar">

            <!-- sidebar: style can be found in sidebar.less -->
            <section class="sidebar">
                <!-- Sidebar user panel (optional) -->
                @include('include.mypage.user_panel')

                <!-- Sidebar Menu -->
                <ul class="sidebar-menu">
                    <li class="header">MENU</li>

                    <!-- Optionally, you can add icons to the links -->
                    @include('include.mypage.navi')

                </ul><!-- /.sidebar-menu -->
            </section>
              <!-- /.sidebar -->
        </aside>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
          <!-- Content Header (Page header) -->
            <section class="content-header">
                <h1>
                    @if (isset($pagemeta->title)) {!! $pagemeta->title !!} @endif
                    <small>
                        @if (isset($pagemeta->description)) {!! $pagemeta->description !!} @endif
                    </small>
                </h1>
                <ol class="breadcrumb">
                    <li><a href="{{ url('') }}/mypage/dashboard"><i class="fa fa-dashboard"></i> マイページ</a></li>
                    @if (isset($pagemeta->breadcrumbs)) {!! $pagemeta->breadcrumbs !!} @endif
                    @if (isset($pagemeta->title)) <li class="active">{!! $pagemeta->title !!}</li> @endif
                </ol>
            </section>

          <!-- Main content -->
            <section class="content">
                <div class="content__body">

                    @yield('content')

                </div>

            </section><!-- /.content -->
        </div><!-- /.content-wrapper -->

        <!-- Main Footer -->
        <footer class="main-footer">
            <!-- To the right -->
            <div class="pull-right hidden-xs">Powered by AdminLTE</div>

            <!-- Default to the left -->
            <strong>Copyright &copy; 2018- <a href="#">トランスポーター CO.,LTD.</a></strong> All rights reserved.
        </footer>

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Create the tabs -->
            <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
                <li class="active"><a href="#control-sidebar-home-tab" data-toggle="tab"><i class="fa fa-home"></i></a></li>
                <li><a href="#control-sidebar-settings-tab" data-toggle="tab"><i class="fa fa-gears"></i></a></li>
            </ul>
            <!-- Tab panes -->
            <div class="tab-content">
            <!-- Home tab content -->
                <div class="tab-pane active" id="control-sidebar-home-tab">

<?php /*
                    @include('include.admin.status_list')
*/ ?>

                </div><!-- /.tab-pane -->

                <!-- Stats tab content -->
                <div class="tab-pane" id="control-sidebar-stats-tab">Stats Tab Content</div><!-- /.tab-pane -->
                <!-- Settings tab content -->
                <div class="tab-pane" id="control-sidebar-settings-tab">

                    @include('include.admin.skin_list')

                </div><!-- /.tab-pane -->
            </div>
        </aside><!-- /.control-sidebar -->

        <!-- Add the sidebar's background. This div must be placed immediately after the control sidebar -->
        <div class="control-sidebar-bg"></div>
    </div><!-- ./wrapper -->

    <!-- jQuery 2.1.4 -->
    <script src="{{ url('') }}/js/plugins/jquery-2.1.4.min.js"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="{{ url('') }}/js/plugins/jquery-ui.min.js"></script>

    <!-- Bootstrap 3.3.5 -->
    <script src="{{ url('') }}/js/AdminLTE/bootstrap.min.js"></script>
    <!-- AdminLTE App -->
    <script src="{{ url('') }}/js/AdminLTE/app.min.js"></script>
    <script src="{{ url('') }}/js/dest/admin.js"></script>

</body>
</html>
