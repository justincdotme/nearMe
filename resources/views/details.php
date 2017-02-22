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
        <div class="col-xs-10 col-md-8 col-md-offset-1 text-center">
            <div class="col-xs-2 text-right">
                <i class="fa fa-arrow-circle-left back-button" aria-hidden="true"></i>
            </div>
            <div class="col-xs-10">
                <h1>1234 Any St</h1>
            </div>
        </div>
    </div>
</header>
<div class="row-fluid details" id="body">
    <div class="col-xs-12 col-md-8 col-md-offset-2 text-center">
        <div class="panel panel-default" id="full-detail-panel">
            <div class="panel-body">
                <div class="row">
                    <div class="col-xs-6">
                        <div class="panel panel-default">
                            <div class="panel-body">
                                <h2 class="">Location Details</h2>
                                <dl class="detail-list">
                                    <dt>Address</dt>
                                    <dd>1234 Any St Vancouver, WA 98686</dd>
                                    <dt>Name</dt>
                                    <dd>-</dd>
                                    <dt>Distance</dt>
                                    <dd>2.2 miles</dd>
                                    <dt>Lat</dt>
                                    <dd>45.720387t</dd>
                                    <dt>Lng</dt>
                                    <dd>-122.648554</dd>
                                    <dt>Connections</dt>
                                    <dd>-</dd>
                                </dl>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-6">
                        <div class="panel panel-default">
                            <div class="panel-body">
                                <img src="http://placehold.it/380x208">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-6">
                        <div class="panel panel-default">
                            <div class="panel-body">
                                <h2 class="">Charging Details</h2>
                                <dl class="detail-list">
                                    <dt>Level</dt>
                                    <dd>Level2, Level 3</dd>
                                    <dt>Amps</dt>
                                    <dd>16</dd>
                                    <dt>Voltage</dt>
                                    <dd>230</dd>
                                    <dt>kW</dt>
                                    <dd>3</dd>
                                    <dt>Fast Charge</dt>
                                    <dd>Yes</dd> <!-- Icon here -->
                                    <dt>Connections</dt>
                                    <dd>4</dd>
                                </dl>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-6">
                        <div class="panel panel-default">
                            <div class="panel-body">
                                <h2 class="">Operator Details</h2>
                                <dl class="detail-list">
                                    <dt>Name</dt>
                                    <dd>Foobarz Inc.</dd>
                                    <dt>Website</dt>
                                    <dd>https://foobar.com</dd>
                                    <dt>Phone</dt>
                                    <dd>123-456-7890</dd>
                                    <dt>Email</dt>
                                    <dd>barbaz@foo.com</dd>
                                </dl>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-6 col-xs-offset-3">
                        <button type="button" class="btn btn-default view-map">Open in Map</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="/assets/js/dist/vendor.js"></script>
<script src="/assets/js/dist/app.js"></script>
</body>
</html>