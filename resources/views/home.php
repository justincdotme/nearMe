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
<header>
    <div class="row-fluid" id="top-bar">
        <div class="col-xs-12 col-md-8 col-md-offset-2 text-center">
            <div class="input-group input-group-lg">
                <input type="text" class="form-control" placeholder="Address">
                <span class="input-group-btn">
                    <button class="btn btn-default" id="search-button" type="button">
                        <i class="fa fa-search" aria-hidden="true"></i>
                    </button>
                </span>
            </div>
        </div>
    </div>
</header>
<div class="row-fluid" id="body">
    <div class="col-xs-12 col-md-8 col-md-offset-2 text-center">
        <div id="map-container">
        </div>
    </div>
</div>
<div class="row-fluid" id="results">
    <div class="col-xs-12 col-md-8 col-md-offset-2">
        <div class="row">
            <div class="col-xs-12 col-md-6">
                <div class="panel panel-default panel-result-preview">
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-lg-9 col-md-8 col-xs-12">
                                <h3>Station Name</h3>
                                <span class="street-address">
                                    1234 Any St <br>
                                    Cityville, DC 20001
                                </span>
                            </div>
                            <div class="col-lg-3 col-md-4 hidden-xs hidden-sm">
                                <img class="img-responsive" src="http://placehold.it/115x99">
                            </div>
                        </div>
                        <div class="row quick-info">
                            <div class="col-xs-12 col-sm-10 col-sm-offset-1 col-md-12 col-md-offset-0">
                                <div class="row">
                                    <div class="col-xs-4">
                                        <i class="fa fa-bolt" aria-hidden="true"></i>
                                        <span>Level 2</span>
                                    </div>
                                    <div class="col-xs-4 text-center">
                                        <i class="fa fa-unlock" aria-hidden="true"></i>
                                        <span>Public</span>
                                    </div>
                                    <div class="col-xs-4 text-right">
                                        <i class="fa fa-map-marker" aria-hidden="true"></i>
                                        <span>1.2 mi.</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12">
                                <button type="button" class="btn btn-default view-details" onclick="window.location.href = '/details'">View Details</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-md-6">
                <div class="panel panel-default panel-result-preview">
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-lg-9 col-md-8 col-xs-12">
                                <h3>1234 Any St</h3>
                                <span class="street-address">
                                    1234 Any St <br>
                                    Cityville, DC 20001
                                </span>
                            </div>
                            <div class="col-lg-3 col-md-4 hidden-xs hidden-sm">
                                <img class="img-responsive" src="http://placehold.it/115x99">
                            </div>
                        </div>
                        <div class="row quick-info">
                            <div class="col-xs-12 col-sm-10 col-sm-offset-1 col-md-12 col-md-offset-0">
                                <div class="row">
                                    <div class="col-xs-4">
                                        <i class="fa fa-bolt" aria-hidden="true"></i>
                                        <span>Level 2</span>
                                    </div>
                                    <div class="col-xs-4 text-center">
                                        <i class="fa fa-unlock" aria-hidden="true"></i>
                                        <span>Public</span>
                                    </div>
                                    <div class="col-xs-4 text-right">
                                        <i class="fa fa-map-marker" aria-hidden="true"></i>
                                        <span>1.2 mi.</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12">
                                <button type="button" class="btn btn-default view-details" onclick="window.location.href = '/details'">View Details</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-md-6">
                <div class="panel panel-default panel-result-preview">
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-lg-9 col-md-8 col-xs-12">
                                <h3>1234 Any St</h3>
                                <span class="street-address">
                                    1234 Any St <br>
                                    Cityville, DC 20001
                                </span>
                            </div>
                            <div class="col-lg-3 col-md-4 hidden-xs hidden-sm">
                                <img class="img-responsive" src="http://placehold.it/115x99">
                            </div>
                        </div>
                        <div class="row quick-info">
                            <div class="col-xs-12 col-sm-10 col-sm-offset-1 col-md-12 col-md-offset-0">
                                <div class="row">
                                    <div class="col-xs-4">
                                        <i class="fa fa-bolt" aria-hidden="true"></i>
                                        <span>Level 2</span>
                                    </div>
                                    <div class="col-xs-4 text-center">
                                        <i class="fa fa-unlock" aria-hidden="true"></i>
                                        <span>Public</span>
                                    </div>
                                    <div class="col-xs-4 text-right">
                                        <i class="fa fa-map-marker" aria-hidden="true"></i>
                                        <span>1.2 mi.</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12">
                                <button type="button" class="btn btn-default view-details" onclick="window.location.href = '/details'">View Details</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-md-6">
                <div class="panel panel-default panel-result-preview">
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-lg-9 col-md-8 col-xs-12">
                                <h3>Station Name</h3>
                                <span class="street-address">
                                    1234 Any St <br>
                                    Cityville, DC 20001
                                </span>
                            </div>
                            <div class="col-lg-3 col-md-4 hidden-xs hidden-sm">
                                <img class="img-responsive" src="http://placehold.it/115x99">
                            </div>
                        </div>
                        <div class="row quick-info">
                            <div class="col-xs-12 col-sm-10 col-sm-offset-1 col-md-12 col-md-offset-0">
                                <div class="row">
                                    <div class="col-xs-4">
                                        <i class="fa fa-bolt" aria-hidden="true"></i>
                                        <span>Level 2</span>
                                    </div>
                                    <div class="col-xs-4 text-center">
                                        <i class="fa fa-unlock" aria-hidden="true"></i>
                                        <span>Public</span>
                                    </div>
                                    <div class="col-xs-4 text-right">
                                        <i class="fa fa-map-marker" aria-hidden="true"></i>
                                        <span>1.2 mi.</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12">
                                <button type="button" class="btn btn-default view-details" onclick="window.location.href = '/details'">View Details</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    function showZoo() {
        var nationalZoo = {
            lat: 38.89829066332753,
            lng: -77.03690404999998
        };

        var map = new google.maps.Map(document.getElementById('map-container'), {
            zoom: 12,
            center: nationalZoo
        });

        new google.maps.Marker({
            position: nationalZoo,
            map: map
        });
    }
</script>
<script async defer
        src="https://maps.googleapis.com/maps/api/js?key=<?= $gMapApiKey; ?>&callback=showZoo">
</script>
<script src="/assets/js/dist/vendor.js"></script>
<script src="/assets/js/dist/app.js"></script>
</body>
</html>