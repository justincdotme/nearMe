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
            <div v-show="noStationsFound" id="station-list-empty">
                <h1>No Stations Found</h1>
            </div>
            <transition name="fade">
                <div class="col-xs-12 col-md-8 col-md-offset-2 text-center" v-if="shouldShowResults">
                    <gmap-map :center="location" :zoom="12">
                        <gmap-marker v-for="m in markers" :position="m.position"></gmap-marker>
                    </gmap-map>
                </div>
            </transition>
            <transition name="fade">
                <div class="row-fluid" id="station-list" v-if="shouldShowResults">
                    <div class="col-xs-12 col-md-8 col-md-offset-2">
                        <div class="row">
                            <div v-for="station in stationList">
                                <station-preview :station="station"></station-preview>
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