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
    <script src="/js/jquery-1.11.1.min.js"></script>

</head>
<body class="page-body login-page">
@yield('content')
<!--JAVASCRIPT-->
<!-- Bottom Scripts -->
<script src="/js/bootstrap.min.js"></script>
<script src="/js/TweenMax.min.js"></script>
<script src="/js/resizeable.js"></script>
<script src="/js/joinable.js"></script>
<script src="/js/xenon-api.js"></script>
<script src="/js/xenon-toggles.js"></script>
<!-- Imported scripts on this page -->
<script src="/js/jquery-validate/jquery.validate.min.js"></script>
<script src="/js/toastr/toastr.min.js"></script>
<!-- JavaScripts initializations and stuff -->
<script src="/js/xenon-custom.js"></script>
@yield('scripts')
</body>
</html>
