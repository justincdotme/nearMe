<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>nearMe - Locate EV Charging Stations Near You!</title>
    <link rel="stylesheet"
          href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"
          integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u"
          crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/5ca4280619.css">
    <link href="/assets/css/dist/app.css" rel="stylesheet">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <link rel="apple-touch-icon" sizes="57x57" href="/assets/favicon/apple-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="60x60" href="/assets/favicon/apple-icon-60x60.png">
    <link rel="apple-touch-icon" sizes="72x72" href="/assets/favicon/apple-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="76x76" href="/assets/favicon/apple-icon-76x76.png">
    <link rel="apple-touch-icon" sizes="114x114" href="/assets/favicon/apple-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="120x120" href="/assets/favicon/apple-icon-120x120.png">
    <link rel="apple-touch-icon" sizes="144x144" href="/assets/favicon/apple-icon-144x144.png">
    <link rel="apple-touch-icon" sizes="152x152" href="/assets/favicon/apple-icon-152x152.png">
    <link rel="apple-touch-icon" sizes="180x180" href="/assets/favicon/apple-icon-180x180.png">
    <link rel="icon" type="image/png" sizes="192x192"  href="/assets/favicon/android-icon-192x192.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/assets/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="96x96" href="/assets/favicon/favicon-96x96.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/assets/favicon/favicon-16x16.png">
    <link rel="manifest" href="/assets/favicon/manifest.json">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="/assets/favicon/ms-icon-144x144.png">
    <meta name="theme-color" content="#ffffff">
</head>
<body id="page-top" class="index">
    <div id="app" v-cloak>
        <header>
            <div class="row-fluid" id="top-bar">
                <div class="col-xs-12 col-md-8 col-md-offset-2 text-center">
                    <search-bar></search-bar>
                </div>
            </div>
        </header>
        <div class="row-fluid" id="body">
            <transition name="fade">
                <h1 v-if="state.shouldShowStationDetail" id="detail-name" class="text-center">
                    {{ getCurrentStationName() }}
                </h1>
            </transition>
            <transition name="fade">
                <div class="col-xs-12 col-md-8 col-md-offset-2 text-center" v-if="state.shouldShowMap">
                    <gmap-map :center="location.coords" :zoom="12">
                        <gmap-marker v-for="m in stations.markers" :position="m.position"></gmap-marker>
                    </gmap-map>
                </div>
            </transition>
            <station-detail></station-detail>
            <transition name="fade">
                <div class="row-fluid">
                    <div class="col-xs-12 col-md-8 col-md-offset-2">
                        <div class="row">
                            <loading-icon></loading-icon>
                            <station-previews></station-previews>
                            <div v-show="state.noStationsFound" id="station-list-empty">
                                <h1 class="text-center">No Charging Stations Found</h1>
                            </div>
                            <div v-show="state.noLocation">
                                <h1 class="text-center">Unable to Obtain Geolocation</h1>
                                <h2 class="text-center error-subhead">Please enter an address to search by.</h2>
                            </div>
                            <div v-show="state.hasFatalError">
                                <h1 class="text-center">We're Sorry, An error has occurred. </h1>
                                <h2 class="text-center error-subhead">Please try again or refresh the page.</h2>
                            </div>
                        </div>
                    </div>
                </div>
            </transition>
        </div>
    </div>
<script>
    window.googleMapsKey = "<?= $gMapApiKey; ?>";
</script>
<script src="/assets/js/dist/vendor.js"></script>
<script src="/assets/js/dist/app.js"></script>
</body>
</html>