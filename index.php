<?php
include_once 'db-connection.php';
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset='utf-8'>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>PV System Annotation</title>
        <link rel="stylesheet" href="leaflet.css" />
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <style type="text/css">
            #map { width: 700px; height: 433px; }
            .fullscreen-icon { background-image: url(icon-fullscreen.png); }
            /* one selector per rule as explained here : http://www.sitepoint.com/html5-full-screen-api/ */
            #map:-webkit-full-screen { width: 100% !important; height: 100% !important; z-index: 99999; }
            #map:-ms-fullscreen { width: 100% !important; height: 100% !important; z-index: 99999; }
            #map:full-screen { width: 100% !important; height: 100% !important; z-index: 99999; }
            #map:fullscreen { width: 100% !important; height: 100% !important; z-index: 99999; }
            .leaflet-pseudo-fullscreen { position: fixed !important; width: 100% !important; height: 100% !important; top: 0px !important; left: 0px !important; z-index: 99999; }
        </style>
        <script src='leaflet.js'></script>
        <script src="Control.FullScreen.js"></script>
        <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js"></script>
        <style>
            body {
                padding: 0;
                margin: 0;
            }
            html, body, #map {
                height: 100%;
                width: 100%;
            }
            #addDataJson{
                display: block;
                position: fixed;
                bottom: 0px;
                left: 0px;
                z-index: 10000;
            }
        </style>
    <body>
        <div id = "map"></div>
        <!--width: 700px; height: 433px;-->
        <!-- Modal -->
        <div class="modal fade" id="myModal" role="dialog">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Update PV System Info</h4>
                    </div>
                    <div class="modal-body">
                        <!-- Material input -->

                        <div class="md-form">
                            <label for="form1">Name</label>
                            <input type="text" id="form1" name="name" class="form-control">
                            <label for="form1">Photo</label>
                            <input type="text" id="form1" name="photo" class="form-control">
                            <label for="form1">Address</label>
                            <input type="text" id="form1" name="address" class="form-control">
                            <label for="form1">Operator</label>
                            <input type="text" id="form1" name="operator" class="form-control">
                            <label for="form1">Commission Date</label>
                            <input type="date" id="form1" name="com_date" class="form-control">
                            <label for="form1">Description</label>
                            <input type="text" id="form1" name="descr" class="form-control">
                            <label for="form1">System Power(kWp)</label>
                            <input type="text" id="form1" name="sys_power" class="form-control">
                            <label for="form1">Annual Production(kWh)</label>
                            <input type="text" id="form1" name="annual_prod" class="form-control">
                            <label for="form1">CO2 Avoided(tons per annum)</label>
                            <input type="text" id="form1" name="co2" class="form-control">
                            <label for="form1">Reimbursement(euro)</label>
                            <input type="text" id="form1" name="reimbur" class="form-control">
                            <label for="form1">Solar Panel Modules</label>
                            <input type="text" id="form1" name="sp_mod" class="form-control">
                            <label for="form1">Azimuth Angle</label>
                            <input type="text" id="form1" name="azimuth" class="form-control">
                            <label for="form1">Inclination Angle</label>
                            <input type="text" id="form1" name="inclination" class="form-control">
                            <label for="form1">Communication</label>
                            <input type="text" id="form1" name="communication" class="form-control">
                            <label for="form1">Inverter</label>
                            <input type="text" id="form1" name="inverter" class="form-control">
                            <label for="form1">Sensors</label>
                            <input type="text" id="form1" name="sensors" class="form-control">
                        </div>
                    </div>
                    <div class="modal-footer d-flex justify-content-center">
                        <center><button class="btn btn-default">Update</button></center>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
        <div class="modal fade" id="myModal2" role="dialog">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Create new PV System</h4>
                    </div>
                    <div class="modal-body">
                        <!-- Material input -->
                        <form action="insertData.php" method="post" id="formCreate">
                            <div class="md-form">
                                <label for="form1">Name</label>
                                <input type="text" id="form1" name="name" class="form-control">
                                <label for="form1">Photo</label>
                                <input type="text" id="form1" name="photo" class="form-control">
                                <input type="hidden" id="form1" name="x" class="form-control">
                                <input type="hidden" id="form1" name="y" class="form-control">
                                <label for="form1">Address</label>
                                <input type="hidden" id="form1" name="address" class="form-control">
                                <label for="form1">Operator</label>
                                <input type="text" id="form1" name="operator" class="form-control">
                                <label for="form1">Commission Date</label>
                                <input type="date" id="form1" name="com_date" class="form-control">
                                <label for="form1">Description</label>
                                <input type="text" id="form1" name="descr" class="form-control">
                                <label for="form1">System Power(kWp)</label>
                                <input type="text" id="form1" name="sys_power" class="form-control">
                                <label for="form1">Annual Production(kWh)</label>
                                <input type="text" id="form1" name="annual_prod" class="form-control">
                                <label for="form1">CO2 Avoided(tons per annum)</label>
                                <input type="text" id="form1" name="co2" class="form-control">
                                <label for="form1">Reimbursement(euro)</label>
                                <input type="text" id="form1" name="reimbur" class="form-control">
                                <label for="form1">Solar Panel Modules</label>
                                <input type="text" id="form1" name="sp_mod" class="form-control">
                                <label for="form1">Azimuth Angle</label>
                                <input type="text" id="form1" name="azimuth" class="form-control">
                                <label for="form1">Inclination Angle</label>
                                <input type="text" id="form1" name="inclination" class="form-control">
                                <label for="form1">Communication</label>
                                <input type="text" id="form1" name="communication" class="form-control">
                                <label for="form1">Inverter</label>
                                <input type="text" id="form1" name="inverter" class="form-control">
                                <label for="form1">Sensors</label>
                                <input type="text" id="form1" name="sensors" class="form-control">
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer d-flex justify-content-center">
                        <center><button class="btn btn-default" type="submit" form="formCreate" value="Submit">Submit</button></center>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>

        <script>
            var base = new L.TileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                maxZoom: 19,
                attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
            });
            var update_btn = "<button type=\"button\" class=\"btn btn-info btn-lg\" data-toggle=\"modal\" data-target=\"#myModal\">Edit</button>";
            var delete_btn = "<button type=\"button\" class=\"btn btn-info btn-lg\">Delete</button>";
            var create_btn = "<button type=\"button\" class=\"btn btn-info btn-lg\" data-toggle=\"modal\" data-target=\"#myModal2\">Yes</button>";
            var close_btn = "<button type=\"button\" class=\"btn btn-info btn-lg\" id=\"marker-no-button\">No</button>";

            var map = new L.Map('map', {
                layers: [base],
                center: new L.LatLng(35.1600, 33.3770),
                zoom: 7,
                fullscreenControl: true,
                fullscreenControlOptions: {
                    title: "Enter fullscreen mode",
                    titleCancel: "Exit fullscreen mode"
                }
            });
            // detect fullscreen toggling
            map.on('enterFullscreen', function () {
                if (window.console)
                    window.console.log('enterFullscreen');
            });
            map.on('exitFullscreen', function () {
                if (window.console)
                    window.console.log('exitFullscreen');
            });
        </script>
        <button id="addDataJson">JSON FILE</button>
        <script>
            $("#addDataJson").click(function () {
                $.getJSON('SunnyCY.json', function (data) {
                    $.each(data.info, function (i, f) {
                        jQuery.ajax({
                            type: "POST",
                            url: 'insertJSONData.php',
                            dataType: 'json',
                            data: {functionname: 'insert', arguments: [f.Name, f.Photo, f.Address, f.X, f.Y, f.Operator, f.Commission_Date, f.Description,
                                    f.System_Power, f.Annual_Production, f.CO2, f.Reimbursement, f.Solar_Panel_Modules, f.Azimuth_Angle, f.Inclination_Angle,
                                    f.Communication, f.Inverter, f.Sensors]},

                            success: function (obj, textstatus) {
                                if (!('error' in obj)) {
                                    yourVariable = obj.result;
                                } else {
                                    console.log(obj.error);
                                }
                            }
                        });
                        //marker creation
                        if (f.Operator === null) {
                            f.Operator = "-";
                        }
                        if (f.Photo === null) {
                            f.Photo = "-";
                        }
                        if (f.Address === null) {
                            f.Address = "-";
                        }
                        if (f.Name === null) {
                            f.Name = "-";
                        }
                        if (f.Commission_Date === null) {
                            f.Commission_Date = "-";
                        }
                        if (f.Description === null) {
                            f.Description = "-";
                        }
                        if (f.System_Power === null) {
                            f.System_Power = "-";
                        }
                        if (f.Annual_Production === null) {
                            f.Annual_Production = "-";
                        }
                        if (f.CO2 === null) {
                            f.CO2 = "-";
                        }
                        if (f.Reimbursement === null) {
                            f.Reimbursement = "-";
                        }
                        if (f.Solar_Panel_Modules === null) {
                            f.Solar_Panel_Modules = "-";
                        }
                        if (f.Azimuth_Angle === null) {
                            f.Azimuth_Angle = "-";
                        }
                        if (f.Inclination_Angle === null) {
                            f.Inclination_Angle = "-";
                        }
                        if (f.Communication === null) {
                            f.Communication = "-";
                        }
                        if (f.Inverter === null) {
                            f.Inverter = "-";
                        }
                        if (f.Sensors === null) {
                            f.Sensors = "-";
                        }


                        var marker = L.marker([f.X, f.Y]).bindPopup("<center><img src=\" " + f.Photo + "\" /> </center>" + "<br/><strong>Name:</strong> " + f.Name + "<br/><strong>Location:</strong> " + f.Address + "(" + f.X + "° N ," + f.Y + "° E)" + "<br/><strong>Operator:</strong> "
                                + f.Operator + "<br/><strong>Commission Date:</strong> " + f.Commission_Date + "<br/><strong>Description:</strong> " + f.Description + "<br/><strong>System Power:</strong> " + f.System_Power
                                + "<br/><strong>Annual Production:</strong> " + f.Annual_Production + "<br/><strong>CO2 Avoided:</strong> " + f.CO2 + "<br/><strong>Reimbursement:</strong> " + f.Reimbursement
                                + "<br/><strong>Solar Panel Modules:</strong> " + f.Solar_Panel_Modules + "<br/><strong>Azimuth Angle:</strong> " + f.Azimuth_Angle + "<br/><strong>Inclination Angle:</strong> "
                                + f.Inclination_Angle + "<br/><strong>Communication:</strong> " + f.Communication + "<br/><strong>Inverter:</strong> " + f.Inverter + "<br/><strong>Sensors:</strong> " + f.Sensors + "<br/>" + "<center>" + update_btn + "    " + delete_btn + "</center>").addTo(map);
                        marker.on('click', function (e) {
                            this.openPopup();
                        });
                    });
                });
                map.on('click', addMarker);
            });


            function onCreatePopupOpen() {
                var tempMarker = this;
                // To remove marker on click of delete button in the popup of marker
                $("#marker-no-button").click(function () {
                    map.removeLayer(tempMarker);
                });
            }

            function addMarker(e) {
                var newMarker = new L.marker(e.latlng).bindPopup("<center><p> Create new PV System?</p>" + create_btn + "    " + close_btn + "</center>").addTo(map);
                newMarker.on("popupopen", onCreatePopupOpen);
                newMarker.openPopup();
            }
        </script>
        <?php
        $result = mysqli_query($conn, "SELECT ID, Name, Photo, Address, X, Y, Operator, Commission_Date, Description, System_Power, 
        Annual_Production, CO2, Reimbursement, SolarP_Modules, Azimuth_Angle, Inclination_Angle, Communication, Inverter, Sensors
                FROM pv");
        $row = mysqli_fetch_assoc($result);
        $i = 0;
        while ($row != null):
            ?>
            <script>
                var i = parseInt(<?php echo JSON_encode($i); ?>);
                var x = parseFloat(<?php echo JSON_encode($row['X']); ?>);
                var y = parseFloat(<?php echo JSON_encode($row['Y']); ?>);
                var photo =<?php echo JSON_encode($row['Photo']); ?>;
                var id =<?php echo JSON_encode($row['ID']); ?>;
                var name =<?php echo JSON_encode($row['Name']); ?>;
                var operator =<?php echo JSON_encode($row['Operator']); ?>;
                var date =<?php echo JSON_encode($row['Commission_Date']); ?>;
                var addr =<?php echo JSON_encode($row['Address']); ?>;
                var power =<?php echo JSON_encode($row['System_Power']); ?>;
                var production =<?php echo JSON_encode($row['Annual_Production']); ?>;
                var co2 =<?php echo JSON_encode($row['CO2']); ?>;
                var reim =<?php echo JSON_encode($row['Reimbursement']); ?>;
                var spmod =<?php echo JSON_encode($row['SolarP_Modules']); ?>;
                var azimuth =<?php echo JSON_encode($row['Azimuth_Angle']); ?>;
                var inclination =<?php echo JSON_encode($row['Inclination_Angle']); ?>;
                var comm =<?php echo JSON_encode($row['Communication']); ?>;
                var inverter =<?php echo JSON_encode($row['Inverter']); ?>;
                var sensors =<?php echo JSON_encode($row['Sensors']); ?>;
                var description =<?php echo JSON_encode($row['Description']); ?>;
                var marker = L.marker([x, y]);
                map.addLayer(marker);
                marker.bindPopup("<center><img src=\" " + photo + "\" /> </center>" + "<br/><strong>Name:</strong> " + name + "<br/><strong>Location:</strong> " + addr + "(" + f.X + "° N ," + f.Y + "° E)" + "<br/><strong>Operator:</strong> "
                        + operator + "<br/><strong>Commission Date:</strong> " + date + "<br/><strong>Description:</strong> " + description + "<br/><strong>System Power:</strong> " + power
                        + "<br/><strong>Annual Production:</strong> " + production + "<br/><strong>CO2 Avoided:</strong> " + co2 + "<br/><strong>Reimbursement:</strong> " + reim
                        + "<br/><strong>Solar Panel Modules:</strong> " + spmod + "<br/><strong>Azimuth Angle:</strong> " + azimuth + "<br/><strong>Inclination Angle:</strong> "
                        + inclination + "<br/><strong>Communication:</strong> " + comm + "<br/><strong>Inverter:</strong> " + inverter + "<br/><strong>Sensors:</strong> " + sensors + "<br/>" + "<center>" + update_btn + "    " + delete_btn + "</center>").addTo(map);
                marker.on('click', function (e) {
                    this.openPopup();
                });
            </script>
            <?php
            $i++;
            $row = mysqli_fetch_assoc($result);
        endwhile;
        ?>

    </body>
</html>