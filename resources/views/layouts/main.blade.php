<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>管理系统</title>
    <!--STYLESHEET-->
    <!--=================================================-->
    <!--Bootstrap Stylesheet [ REQUIRED ]-->
    <link rel="stylesheet" href="/css/fonts/linecons/css/linecons.css">
    <link rel="stylesheet" href="/css/fonts/fontawesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="/css/bootstrap.css">
    <link rel="stylesheet" href="/css/xenon-core.css">
    <link rel="stylesheet" href="/css/xenon-forms.css">
    <link rel="stylesheet" href="/css/xenon-components.css">
    <link rel="stylesheet" href="/css/xenon-skins.css">
    <link rel="stylesheet" href="/css/custom.css">
    @yield('styles')
    <script src="/js/jquery-1.11.1.min.js"></script>
</head>
<body class="page-body">
{{--@include('common.settingsPane')--}}
<div class="page-container"><!-- add class "sidebar-collapsed" to close sidebar by default, "chat-visible" to make chat appear always -->
    <!-- Add "fixed" class to make the sidebar fixed always to the browser viewport. -->
    <!-- Adding class "toggle-others" will keep only one menu item open at a time. -->
    <!-- Adding class "collapsed" collapse sidebar root elements and show only icons. -->
    <div class="sidebar-menu toggle-others fixed">
        <div class="sidebar-menu-inner">
            @include('common.logo')
            @include('common.menu')
        </div>
    </div>
    <div class="main-content">
        @include('common.header')
        <!--========================提示信息、报错信息=========================-->
        @if (Session::has('flash.alert.message'))
            <div class="alert alert-{{ Session::get('flash.alert.type') }}">
                <button type="button" class="close" data-dismiss="alert">
                    <span aria-hidden="true">&times;</span>
                    <span class="sr-only">Close</span>
                </button>
                {{ Session::get('flash.alert.message') }}
            </div>
        @endif
        @if (count($errors) > 0)
            <div class="alert alert-danger">
                <button type="button" class="close" data-dismiss="alert">
                    <span aria-hidden="true">&times;</span>
                    <span class="sr-only">Close</span>
                </button>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <!--========================提示信息、报错信息 end=========================-->
        @yield('content')
        @include('common.footer')
    </div>
{{--    @include('common.chat')--}}
</div>
<div class="page-loading-overlay">
    <div class="loader-2"></div>
</div>
<!-- Modal-->
<div class="modal fade" id="defaultModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="defaultModalTitle"></h4>
            </div>
            <div class="modal-body" id="defaultModalContent">
                Content is loading...
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-white" data-dismiss="modal">关闭</button>
                <button type="button" class="btn btn-info" id="defaultModalBtn">确定</button>
            </div>
        </div>
    </div>
</div>

<!--JAVASCRIPT-->
<!-- Bottom Scripts -->
<script src="/js/bootstrap.min.js"></script>
<script src="/js/TweenMax.min.js"></script>
<script src="/js/resizeable.js"></script>
<script src="/js/joinable.js"></script>
<script src="/js/xenon-api.js"></script>
<script src="/js/xenon-toggles.js"></script>
<!-- Imported scripts on this page -->
<script src="/js/xenon-widgets.js"></script>
<script src="/js/devexpress-web-14.1/js/globalize.min.js"></script>
<script src="/js/devexpress-web-14.1/js/dx.chartjs.js"></script>
<script src="/js/toastr/toastr.min.js"></script>
<!-- JavaScripts initializations and stuff -->
<script src="/js/xenon-custom.js"></script>
@yield('scripts')
</body>
</html>
