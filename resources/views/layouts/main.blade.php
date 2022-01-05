<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>@yield('title')</title>
    <meta name="keywords" content="clean, portfolio, blog template, html css layout" />
    <meta name="description" content="Clean Blog - Portfolio Page in 2-column style" />
    <link href="templatemo_style.css" rel="stylesheet" type="text/css" />
    {!! \Biscolab\ReCaptcha\Facades\ReCaptcha::htmlScriptTagJsApi() !!}

    <!--////// CHOOSE ONE OF THE 3 PIROBOX STYLES  \\\\\\\-->
    <link href="css_pirobox/white/style.css" media="screen" title="shadow" rel="stylesheet" type="text/css" />
    <!--<link href="css_pirobox/white/style.css" media="screen" title="white" rel="stylesheet" type="text/css" />
    <link href="css_pirobox/black/style.css" media="screen" title="black" rel="stylesheet" type="text/css" />-->
    <!--////// END  \\\\\\\-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <!--////// INCLUDE THE JS AND PIROBOX OPTION IN YOUR HEADER  \\\\\\\-->
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <script type="text/javascript" src="js/jquery.min.js"></script>
    <script type="text/javascript" src="js/piroBox.1_2.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $().piroBox({
                my_speed: 600, //animation speed
                bg_alpha: 0.5, //background opacity
                radius: 4, //caption rounded corner
                scrollImage : false, // true == image follows the page, false == image remains in the same open position
                pirobox_next : 'piro_next', // Nav buttons -> piro_next == inside piroBox , piro_next_out == outside piroBox
                pirobox_prev : 'piro_prev',// Nav buttons -> piro_prev == inside piroBox , piro_prev_out == outside piroBox
                close_all : '.piro_close',// add class .piro_overlay(with comma)if you want overlay click close piroBox
                slideShow : 'slideshow', // just delete slideshow between '' if you don't want it.
                slideSpeed : 4 //slideshow duration in seconds(3 to 6 Recommended)
            });
        });
    </script>
    <!--////// END  \\\\\\\-->

</head>
<body>


<div id="templatemo_wrapper">

    <div id="templatemo_menu">

        <ul>
            <li><a href="/">Blog</a></li>
            <li><a href="/reviews" class="cur">Reviews</a></li>
            <?php if (session()->has('auth')): ?>
            <li><a href="/admin">Admin Panel</a></li>
            <li><a href="/exit">Exit</a></li>
            <?php else: ?>
            <li><a href="/login">Sign In</a></li>
            <li><a href="/signup">Sign Up</a></li>
            <?php endif; ?>

        </ul>

    </div> <!-- end of templatemo_menu -->

    <div id="templatemo_left_column">
        <div id="templatemo_header">

            <div id="site_title">
                <h1><a href="/" target="_parent">
                        <?php if (session()->has('username')): ?>
                                    <?php echo session()->get('username') ?>
                                    <?php else: ?>
                                    Welcome
                                    <?php endif; ?>


                        <strong><?php if (session()->has('username')): ?>
                                    Welcome!
                                    <?php else: ?>
                            Friend!
                            <?php endif; ?>
                        </strong><span></span></a></h1>
            </div><!-- end of site_title -->

        </div>
    </div>


    <div id="templatemo_right_column">
        <div id="templatemo_main">
            @yield('content')
        </div>
    </div> <!-- end of main -->

    <div class="cleaner"></div>
</div>  <!-- end of right column -->

<div class="cleaner_h20"></div>

<div id="templatemo_footer">

    Copyright © 2048 <a href="#">Your Company Name</a> |
    <a href="http://www.iwebsitetemplate.com" target="_parent">Website Templates</a> by <a href="http://www.templatemo.com" target="_parent">Free CSS Templates</a>

</div>

<div class="cleaner"></div>
</div> <!-- end of warpper -->

</body>
</html>
