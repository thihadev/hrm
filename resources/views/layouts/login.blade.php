<!DOCTYPE html>
<html style=""><head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width,initial-scale=1">
        <meta name="description" content="A fully featured admin theme which can be used to build CRM, CMS, etc.">
        <meta name="author">

        <link rel="shortcut icon" href="http://coderthemes.com/minton/dark/assets/images/favicon.ico">

        <title>HRM - Admin Dashboard Template</title>

        <link href="{{ asset ('css/login.css')}}" rel="stylesheet">


    </head>
    <body class="widescreen">

        <div class="wrapper-page">
            <div class="text-center">
                <div class="logo-lg">
                    <i class="fa fa-snowflake-o"></i> <span>HRM</span>
                </div>
                    
                    @yield('content')

            </div>
                      
        </div>

        <!-- Plugins  -->
        <script src="{{ asset ('js/login.js') }}"></script>
	
	
    </body>
</html>