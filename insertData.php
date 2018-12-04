<?php

include_once 'db-connection.php';
?>
<?php

header("Location: index.php");
$sql = "INSERT INTO pv(Name, Photo, Address, X, Y, Operator, Commission_Date, Description, System_Power, 
        Annual_Production, CO2, Reimbursement, SolarP_Modules, Azimuth_Angle, Inclination_Angle, Communication, Inverter, Sensors)
                    VALUES('$_POST[name]', '$_POST[photo]', '$_POST[address]', '1.3456', '4.32008', '$_POST[operator]', '$_POST[com_date]', "
        . "'$_POST[descr]', '$_POST[sys_power]', '$_POST[annual_prod]', '$_POST[co2]', '$_POST[reimbur]', '$_POST[sp_mod]', '$_POST[azimuth]', "
        . "'$_POST[inclination]', '$_POST[communication]', '$_POST[inverter]', '$_POST[sensors]')";
//mysqli_query($conn, $sql);


if (!mysqli_query($conn, $sql)) {
    die('Error: ' . mysqli_error($conn));
}
?>
