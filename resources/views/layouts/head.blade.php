<!-- Title -->
<title>@yield("title")</title>

<!-- Favicon -->
<link rel="shortcut icon" href="{{ URL::asset('assets/images/favicon.ico') }}" type="image/x-icon" />

<!-- ===== PWA Meta Tags (Feature 5) ===== -->
<link rel="manifest" href="{{ URL::asset('manifest.json') }}">
<meta name="theme-color" content="#1a237e">
<meta name="application-name" content="مدرستي">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="default">
<meta name="apple-mobile-web-app-title" content="مدرستي">
<meta name="mobile-web-app-capable" content="yes">
<link rel="apple-touch-icon" href="{{ URL::asset('pwa-icons/apple-touch-icon.png') }}">
<link rel="icon" type="image/png" sizes="192x192" href="{{ URL::asset('pwa-icons/icon-192.png') }}">
<link rel="icon" type="image/png" sizes="512x512" href="{{ URL::asset('pwa-icons/icon-512.png') }}">
<meta name="msapplication-TileColor" content="#1a237e">
<meta name="msapplication-TileImage" content="{{ URL::asset('pwa-icons/icon-192.png') }}">
<!-- ===== End PWA Meta Tags ===== -->

<!-- Font -->
<link rel="stylesheet"
    href="https://fonts.googleapis.com/css?family=Poppins:200,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900">

<link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>

<link href="{{ URL::asset('css/wizard.css') }}" rel="stylesheet" id="bootstrap-css">

@yield('css')

<!--- Style css (RTL/LTR) -->
@if (App::getLocale() == 'en')
    <link href="{{ URL::asset('assets/css/ltr.css') }}" rel="stylesheet">
@else
    <link href="{{ URL::asset('assets/css/rtl.css') }}" rel="stylesheet">
@endif
