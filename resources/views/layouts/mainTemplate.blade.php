<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Endurance Riders Of Alberta</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@200;600&display=swap" rel="stylesheet">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
        <?php
            // $doc = new DOMDocument;
            // libxml_use_internal_errors(true);
            // $doc->loadHTML($header_footer);
            // libxml_use_internal_errors(false);
            // $xpath = new DOMXPath($doc);
            // $result = $xpath->query('//head');
            // foreach ($result as $item) {
            //     echo $doc->saveHTML($item);
            // }
        ?>
        <style>
            #primary-menu>li.menu-item .sub-menu{
                display:none;
            }
            #primary-menu>li.menu-item:hover .sub-menu{
                display:block;
            }
            .submenu-with-border .sub-menu .menu-link{
                border-width: 0px;
            }
        </style>
        @yield('css')
    </head>
    <body>

        <?php
            // $doc = new DOMDocument;
            // libxml_use_internal_errors(true);
            // $doc->loadHTML($header_footer);
            // libxml_use_internal_errors(false);
            // $xpath = new DOMXPath($doc);
            // $result = $xpath->query('//header');
            // foreach ($result as $item) {
            //     echo $doc->saveHTML($item);
            // }
        ?>

        <div class="elementor-section elementor-section-boxed" id="ride_section">
            <div class="elementor-container">
                @if (Route::has('login'))
                    <div class="links">
                        <div class="nav-list">
                            <ul>
                                <li><a href="/rides">Overview</a></li>
                                <li><a href="/rides/riders">Riders</a></li>
                                <li><a href="/rides/horses">Horses</a></li>
                                <li><a href="/rides/events">Events</a></li>
                            </ul>
                        </div>
                        <div class="auth-actions">
                        @auth
                            <a href="{{ url('/dashboard') }}">Dashboard</a>
                            <a href="javascript:logout();">Logout</a>
                        @else
                            <a href="{{ route('login') }}">Login</a>

                            @if (Route::has('register'))
                                <a href="{{ route('register') }}">Register</a>
                            @endif
                        @endauth
                        </div>
                    </div>
                @endif

                <div class="content">
                    <div class="title m-b-md">
                        <ul id="linklist">
                            <li class="riders"><a href="/rides/riders">Riders</a></li>
                            <li class="horses"><a href="/rides/horses">Horses</a></li>
                            <li class="events"><a href="/rides/events">Events</a></li>
                        </ul>
                    </div>
                    @yield('content')
                </div>
            </div>
        </div>

        <?php
            // $doc = new DOMDocument;
            // libxml_use_internal_errors(true);
            // $doc->loadHTML($header_footer);
            // libxml_use_internal_errors(false);
            // $xpath = new DOMXPath($doc);
            // $result = $xpath->query('//footer');
            // foreach ($result as $item) {
            //     echo $doc->saveHTML($item);
            // }
        ?>
        <form action="{{ route('logout') }}" method="POST" id = "logout_form">
            @csrf
        </form>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script>
            function logout(){
               $('#logout_form').submit();
            }
        </script>
        <!--<script type="text/template" id="tmpl-elementor-templates-modal__header"></script>-->


<link rel='stylesheet' id='elementor-post-980-css'  href='http://www.enduranceridersofalberta.ca/wp-content/uploads/elementor/css/post-980.css?ver=1616641348' media='all' />
<script src='http://www.enduranceridersofalberta.ca/wp-includes/js/jquery/ui/core.min.js?ver=1.12.1' id='jquery-ui-core-js'></script>
<script src='http://www.enduranceridersofalberta.ca/wp-includes/js/jquery/ui/datepicker.min.js?ver=1.12.1' id='jquery-ui-datepicker-js'></script>
<script src='http://www.enduranceridersofalberta.ca/wp-content/plugins/modern-events-calendar-lite/assets/js/jquery.typewatch.js?ver=5.17.6' id='mec-typekit-script-js'></script>
<script src='http://www.enduranceridersofalberta.ca/wp-content/plugins/modern-events-calendar-lite/assets/packages/featherlight/featherlight.js?ver=5.17.6' id='mec-featherlight-script-js'></script>
<script src='http://www.enduranceridersofalberta.ca/wp-content/plugins/modern-events-calendar-lite/assets/packages/select2/select2.full.min.js?ver=5.17.6' id='mec-select2-script-js'></script>
<script src='http://www.enduranceridersofalberta.ca/wp-content/plugins/modern-events-calendar-lite/assets/packages/tooltip/tooltip.js?ver=5.17.6' id='mec-tooltip-script-js'></script>
<script src='http://www.enduranceridersofalberta.ca/wp-content/plugins/modern-events-calendar-lite/assets/packages/lity/lity.min.js?ver=5.17.6' id='mec-lity-script-js'></script>
<script src='http://www.enduranceridersofalberta.ca/wp-content/plugins/modern-events-calendar-lite/assets/packages/colorbrightness/colorbrightness.min.js?ver=5.17.6' id='mec-colorbrightness-script-js'></script>
<script src='http://www.enduranceridersofalberta.ca/wp-content/plugins/modern-events-calendar-lite/assets/packages/owl-carousel/owl.carousel.min.js?ver=5.17.6' id='mec-owl-carousel-script-js'></script>
<script id='astra-theme-js-js-extra'>
var astra = {"break_point":"921","isRtl":""};
</script>
<script src='http://www.enduranceridersofalberta.ca/wp-content/themes/astra/assets/js/minified/style.min.js?ver=2.6.2' id='astra-theme-js-js'></script>
<script src='http://www.enduranceridersofalberta.ca/wp-includes/js/jquery/ui/mouse.min.js?ver=1.12.1' id='jquery-ui-mouse-js'></script>
<script src='http://www.enduranceridersofalberta.ca/wp-includes/js/jquery/ui/draggable.min.js?ver=1.12.1' id='jquery-ui-draggable-js'></script>
<script src='http://www.enduranceridersofalberta.ca/wp-includes/js/underscore.min.js?ver=1.8.3' id='underscore-js'></script>
<script src='http://www.enduranceridersofalberta.ca/wp-includes/js/backbone.min.js?ver=1.4.0' id='backbone-js'></script>
<script src='http://www.enduranceridersofalberta.ca/wp-content/plugins/elementor/assets/lib/backbone/backbone.marionette.min.js?ver=2.4.5' id='backbone-marionette-js'></script>
<script src='http://www.enduranceridersofalberta.ca/wp-content/plugins/elementor/assets/lib/backbone/backbone.radio.min.js?ver=1.0.4' id='backbone-radio-js'></script>
<script src='http://www.enduranceridersofalberta.ca/wp-content/plugins/elementor/assets/js/common-modules.min.js?ver=3.0.14' id='elementor-common-modules-js'></script>
<script src='http://www.enduranceridersofalberta.ca/wp-content/plugins/elementor/assets/lib/dialog/dialog.min.js?ver=4.8.1' id='elementor-dialog-js'></script>
<script src='http://www.enduranceridersofalberta.ca/wp-includes/js/api-request.min.js?ver=5.7' id='wp-api-request-js'></script>
<script id='elementor-common-js-before'>
var elementorCommonConfig = {"version":"3.0.14","isRTL":false,"isDebug":false,"isElementorDebug":false,"activeModules":["ajax","finder","connect"],"urls":{"assets":"http:\/\/www.enduranceridersofalberta.ca\/wp-content\/plugins\/elementor\/assets\/","rest":"http:\/\/www.enduranceridersofalberta.ca\/wp-json\/"},"ajax":{"url":"http:\/\/www.enduranceridersofalberta.ca\/wp-admin\/admin-ajax.php","nonce":"b4dbc97fd5"},"finder":{"data":{"edit":{"title":"Edit","dynamic":true,"name":"edit"},"general":{"title":"General","dynamic":false,"items":{"saved-templates":{"title":"Saved Templates","icon":"library-save","url":"http:\/\/www.enduranceridersofalberta.ca\/wp-admin\/edit.php?post_type=elementor_library&tabs_group=library","keywords":["template","section","page","library"]},"system-info":{"title":"System Info","icon":"info-circle-o","url":"http:\/\/www.enduranceridersofalberta.ca\/wp-admin\/admin.php?page=elementor-system-info","keywords":["system","info","environment","elementor"]},"role-manager":{"title":"Role Manager","icon":"person","url":"http:\/\/www.enduranceridersofalberta.ca\/wp-admin\/admin.php?page=elementor-role-manager","keywords":["role","manager","user","elementor"]},"knowledge-base":{"title":"Knowledge Base","url":"http:\/\/www.enduranceridersofalberta.ca\/wp-admin\/admin.php?page=go_knowledge_base_site","keywords":["help","knowledge","docs","elementor"]},"popups":{"title":"Popups","icon":"library-save","url":"http:\/\/www.enduranceridersofalberta.ca\/wp-admin\/edit.php?post_type=elementor_library&tabs_group=popup&elementor_library_type=popup","keywords":["template","popup","library"]},"theme-builder":{"title":"Theme Builder","icon":"library-save","url":"http:\/\/www.enduranceridersofalberta.ca\/wp-admin\/admin.php?page=elementor-app&ver=3.0.14#\/site-editor","keywords":["template","header","footer","single","archive","search","404","library"]}},"name":"general"},"create":{"title":"Create","dynamic":false,"items":{"post":{"title":"Add New Post","icon":"plus-circle-o","url":"http:\/\/www.enduranceridersofalberta.ca\/wp-admin\/edit.php?action=elementor_new_post&post_type=post&_wpnonce=5ad4c5e2c6","keywords":["post","page","template","new","create"]},"page":{"title":"Add New Page","icon":"plus-circle-o","url":"http:\/\/www.enduranceridersofalberta.ca\/wp-admin\/edit.php?action=elementor_new_post&post_type=page&_wpnonce=5ad4c5e2c6","keywords":["post","page","template","new","create"]},"elementor_library":{"title":"Add New Template","icon":"plus-circle-o","url":"http:\/\/www.enduranceridersofalberta.ca\/wp-admin\/edit.php?post_type=elementor_library#add_new","keywords":["post","page","template","new","create"]},"popups":{"title":"Add New Popup","icon":"plus-circle-o","url":"http:\/\/www.enduranceridersofalberta.ca\/wp-admin\/edit.php?post_type=elementor_library&tabs_group=popup&elementor_library_type=popup#add_new","keywords":["template","theme","popup","new","create"]},"theme-template":{"title":"Add New Theme Template","icon":"plus-circle-o","url":"http:\/\/www.enduranceridersofalberta.ca\/wp-admin\/edit.php?post_type=elementor_library&tabs_group=theme#add_new","keywords":["template","theme","new","create"]}},"name":"create"},"site":{"title":"Site","dynamic":false,"items":{"homepage":{"title":"Homepage","url":"http:\/\/www.enduranceridersofalberta.ca","icon":"home-heart","keywords":["home","page"]},"wordpress-dashboard":{"title":"Dashboard","icon":"dashboard","url":"http:\/\/www.enduranceridersofalberta.ca\/wp-admin\/","keywords":["dashboard","wordpress"]},"wordpress-menus":{"title":"Menus","icon":"wordpress","url":"http:\/\/www.enduranceridersofalberta.ca\/wp-admin\/nav-menus.php","keywords":["menu","wordpress"]},"wordpress-themes":{"title":"Themes","icon":"wordpress","url":"http:\/\/www.enduranceridersofalberta.ca\/wp-admin\/themes.php","keywords":["themes","wordpress"]},"wordpress-customizer":{"title":"Customizer","icon":"wordpress","url":"http:\/\/www.enduranceridersofalberta.ca\/wp-admin\/customize.php","keywords":["customizer","wordpress"]},"wordpress-plugins":{"title":"Plugins","icon":"wordpress","url":"http:\/\/www.enduranceridersofalberta.ca\/wp-admin\/plugins.php","keywords":["plugins","wordpress"]},"wordpress-users":{"title":"Users","icon":"wordpress","url":"http:\/\/www.enduranceridersofalberta.ca\/wp-admin\/users.php","keywords":["users","profile","wordpress"]}},"name":"site"},"settings":{"title":"Settings","dynamic":false,"items":{"general-settings":{"title":"General Settings","url":"http:\/\/www.enduranceridersofalberta.ca\/wp-admin\/admin.php?page=elementor","keywords":["general","settings","elementor"]},"advanced":{"title":"Advanced","url":"http:\/\/www.enduranceridersofalberta.ca\/wp-admin\/admin.php?page=elementor#tab-advanced","keywords":["advanced","settings","elementor"]},"custom-fonts":{"title":"Custom Fonts","icon":"typography","url":"http:\/\/www.enduranceridersofalberta.ca\/wp-admin\/edit.php?post_type=elementor_font","keywords":["custom","fonts","elementor"]},"custom-icons":{"title":"Custom Icons","icon":"favorite","url":"http:\/\/www.enduranceridersofalberta.ca\/wp-admin\/edit.php?post_type=elementor_icons","keywords":["custom","icons","elementor"]}},"name":"settings"},"tools":{"title":"Tools","dynamic":false,"items":{"tools":{"title":"Tools","icon":"tools","url":"http:\/\/www.enduranceridersofalberta.ca\/wp-admin\/admin.php?page=elementor-tools","keywords":["tools","regenerate css","safe mode","debug bar","sync library","elementor"]},"replace-url":{"title":"Replace URL","icon":"tools","url":"http:\/\/www.enduranceridersofalberta.ca\/wp-admin\/admin.php?page=elementor-tools#tab-replace_url","keywords":["tools","replace url","domain","elementor"]},"version-control":{"title":"Version Control","icon":"time-line","url":"http:\/\/www.enduranceridersofalberta.ca\/wp-admin\/admin.php?page=elementor-tools#tab-versions","keywords":["tools","version","control","rollback","beta","elementor"]},"maintenance-mode":{"title":"Maintenance Mode","icon":"tools","url":"http:\/\/www.enduranceridersofalberta.ca\/wp-admin\/admin.php?page=elementor-tools#tab-maintenance_mode","keywords":["tools","maintenance","coming soon","elementor"]}},"name":"tools"}},"i18n":{"finder":"Finder"}},"connect":[]};
</script>
<script src='http://www.enduranceridersofalberta.ca/wp-content/plugins/elementor/assets/js/common.min.js?ver=3.0.14' id='elementor-common-js'></script>
<script id='elementor-app-loader-js-before'>
var elementorAppConfig = {"menu_url":"http:\/\/www.enduranceridersofalberta.ca\/wp-admin\/admin.php?page=elementor-app&ver=3.0.14#\/site-editor","assets_url":"http:\/\/www.enduranceridersofalberta.ca\/wp-content\/plugins\/elementor\/assets\/","return_url":"http:\/\/www.enduranceridersofalberta.ca\/rides\/","site-editor":[]};
</script>
<script src='http://www.enduranceridersofalberta.ca/wp-content/plugins/elementor/assets/js/app-loader.min.js?ver=3.0.14' id='elementor-app-loader-js'></script>
<script src='http://www.enduranceridersofalberta.ca/wp-includes/js/wp-embed.min.js?ver=5.7' id='wp-embed-js'></script>
<script src='http://www.enduranceridersofalberta.ca/wp-includes/js/imagesloaded.min.js?ver=4.1.4' id='imagesloaded-js'></script>
<script src='http://www.enduranceridersofalberta.ca/wp-content/plugins/elementor-pro/assets/lib/smartmenus/jquery.smartmenus.min.js?ver=1.0.1' id='smartmenus-js'></script>
<script src='http://www.enduranceridersofalberta.ca/wp-content/plugins/elementor/assets/js/frontend-modules.min.js?ver=3.0.14' id='elementor-frontend-modules-js'></script>
<script src='http://www.enduranceridersofalberta.ca/wp-content/plugins/elementor-pro/assets/lib/sticky/jquery.sticky.min.js?ver=3.0.8' id='elementor-sticky-js'></script>
<script id='elementor-pro-frontend-js-before'>
var ElementorProFrontendConfig = {"ajaxurl":"http:\/\/www.enduranceridersofalberta.ca\/wp-admin\/admin-ajax.php","nonce":"7eee9ca66c","i18n":{"toc_no_headings_found":"No headings were found on this page."},"shareButtonsNetworks":{"facebook":{"title":"Facebook","has_counter":true},"twitter":{"title":"Twitter"},"google":{"title":"Google+","has_counter":true},"linkedin":{"title":"LinkedIn","has_counter":true},"pinterest":{"title":"Pinterest","has_counter":true},"reddit":{"title":"Reddit","has_counter":true},"vk":{"title":"VK","has_counter":true},"odnoklassniki":{"title":"OK","has_counter":true},"tumblr":{"title":"Tumblr"},"digg":{"title":"Digg"},"skype":{"title":"Skype"},"stumbleupon":{"title":"StumbleUpon","has_counter":true},"mix":{"title":"Mix"},"telegram":{"title":"Telegram"},"pocket":{"title":"Pocket","has_counter":true},"xing":{"title":"XING","has_counter":true},"whatsapp":{"title":"WhatsApp"},"email":{"title":"Email"},"print":{"title":"Print"}},"facebook_sdk":{"lang":"en","app_id":""},"lottie":{"defaultAnimationUrl":"http:\/\/www.enduranceridersofalberta.ca\/wp-content\/plugins\/elementor-pro\/modules\/lottie\/assets\/animations\/default.json"}};
</script>
<script src='http://www.enduranceridersofalberta.ca/wp-content/plugins/elementor-pro/assets/js/frontend.min.js?ver=3.0.8' id='elementor-pro-frontend-js'></script>
<script src='http://www.enduranceridersofalberta.ca/wp-content/plugins/elementor/assets/lib/waypoints/waypoints.min.js?ver=4.0.2' id='elementor-waypoints-js'></script>
<script src='http://www.enduranceridersofalberta.ca/wp-content/plugins/elementor/assets/lib/swiper/swiper.min.js?ver=5.3.6' id='swiper-js'></script>
<script src='http://www.enduranceridersofalberta.ca/wp-content/plugins/elementor/assets/lib/share-link/share-link.min.js?ver=3.0.14' id='share-link-js'></script>
<script id='elementor-frontend-js-before'>
var elementorFrontendConfig = {"environmentMode":{"edit":false,"wpPreview":false},"i18n":{"shareOnFacebook":"Share on Facebook","shareOnTwitter":"Share on Twitter","pinIt":"Pin it","download":"Download","downloadImage":"Download image","fullscreen":"Fullscreen","zoom":"Zoom","share":"Share","playVideo":"Play Video","previous":"Previous","next":"Next","close":"Close"},"is_rtl":false,"breakpoints":{"xs":0,"sm":480,"md":768,"lg":1025,"xl":1440,"xxl":1600},"version":"3.0.14","is_static":false,"legacyMode":{"elementWrappers":true},"urls":{"assets":"http:\/\/www.enduranceridersofalberta.ca\/wp-content\/plugins\/elementor\/assets\/"},"settings":{"page":[],"editorPreferences":[]},"kit":{"global_image_lightbox":"yes","lightbox_enable_counter":"yes","lightbox_enable_fullscreen":"yes","lightbox_enable_zoom":"yes","lightbox_enable_share":"yes","lightbox_title_src":"title","lightbox_description_src":"description"},"post":{"id":8,"title":"Endurance%20Riders%20Of%20Alberta%20%E2%80%93%20Getting%20Started","excerpt":"","featuredImage":false},"user":{"roles":["administrator"]}};
</script>
<script src='http://www.enduranceridersofalberta.ca/wp-content/plugins/elementor/assets/js/frontend.min.js?ver=3.0.14' id='elementor-frontend-js'></script>
<script id='elementor-admin-bar-js-before'>
var elementorAdminBarConfig = {"elementor_edit_page":{"id":"elementor_edit_page","title":"Edit with Elementor","href":"http:\/\/www.enduranceridersofalberta.ca\/wp-admin\/post.php?post=8&action=elementor","children":{"980":{"id":"elementor_edit_doc_980","title":"header","sub_title":"Header","href":"http:\/\/www.enduranceridersofalberta.ca\/wp-admin\/post.php?post=980&action=elementor"},"981":{"id":"elementor_app_site_editor","title":"Open Theme Builder","href":"http:\/\/www.enduranceridersofalberta.ca\/wp-admin\/admin.php?page=elementor-app&ver=3.0.14#\/site-editor","class":"elementor-app-link"}}}};
</script>
<script src='http://www.enduranceridersofalberta.ca/wp-content/plugins/elementor/assets/js/elementor-admin-bar.min.js?ver=3.0.14' id='elementor-admin-bar-js'></script>
<script src='http://www.enduranceridersofalberta.ca/wp-includes/js/hoverintent-js.min.js?ver=2.2.1' id='hoverintent-js-js'></script>
    </body>
</html>
