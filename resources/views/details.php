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
            <div class="col-xs-3 text-right">
                <a href="/">
                    <i class="fa fa-arrow-circle-left back-button" aria-hidden="true"></i>
                </a>
            </div>
            <div class="col-xs-9">
                <h1 id="detail-name">1234 Any St</h1>
            </div>
        </div>
    </div>
</header>
<div class="row-fluid">
    <div class="col-xs-12 col-md-8 col-md-offset-2 text-center">
        <h1>Location Details For 1234 Any St</h1>
    </div>
</div>
<div class="row-fluid details" id="body">
    <div class="col-xs-12 col-md-8 col-md-offset-2">
        <div class="row detail-row">
            <div class="col-sm-6 col-lg-4">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <h2 class="text-center">Charging Details</h2>
                        <table class="detail-list">
                            <tr>
                                <td>Level(s)</td>
                                <td>2, 3</td>
                            </tr>
                            <tr>
                                <td>Amps</td>
                                <td>16</td>
                            </tr>
                            <tr>
                                <td>Voltage</td>
                                <td>230</td>
                            </tr>
                            <tr>
                                <td>kW</td>
                                <td>3</td>
                            </tr>
                            <tr>
                                <td>Fast Charge</td>
                                <td>Yes</td> <!-- Icon here -->
                            </tr>
                            <tr>
                                <td>Connections</td>
                                <td>4</td>
                            </tr>
                        </table>
                        <div class="hidden-lg">
                            <h2 class="text-center">Operator Details</h2>
                            <table class="detail-list">
                                <tr>
                                    <td>Name</td>
                                    <td>Foobarz Inc.</td>
                                </tr>
                                <tr>
                                    <td>Website</td>
                                    <td>https://foobar.com</td>
                                </tr>
                                <tr>
                                    <td>Phone</td>
                                    <td>123-456-7890</td>
                                </tr>
                                <tr>
                                    <td>Email</td>
                                    <td>barbaz@foo.com</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 hidden-xs hidden-sm hidden-md">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <h2 class="text-center">Operator Details</h2>
                        <table class="detail-list">
                            <tr>
                                <td>Name</td>
                                <td>Foobarz Inc.</td>
                            </tr>
                            <tr>
                                <td>Website</td>
                                <td>https://foobar.com</td>
                            </tr>
                            <tr>
                                <td>Phone</td>
                                <td>123-456-7890</td>
                            </tr>
                            <tr>
                                <td>Email</td>
                                <td>barbaz@foo.com</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-lg-4">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <h2 class="text-center">Location Details</h2>
                        <table class="detail-list">
                            <tr>
                                <td>Address</td>
                                <td>1234 Any St Vancouver, WA 98686</td>
                            </tr>
                            <tr>
                                <td>Name</td>
                                <td>-</td>
                            </tr>
                            <tr>
                                <td>Distance</td>
                                <td>2.2 miles</td>
                            </tr>
                            <tr>
                                <td>Lat</td>
                                <td>45.720387</td>
                            </tr>
                            <tr>
                                <td>Lng</td>
                                <td>-122.648554</td>
                            </tr>
                        </table>
                        <button type="button" id="view-map" class="btn btn-default view-map">Open in Map Application</button>
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