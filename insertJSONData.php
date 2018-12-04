<?php
include_once 'db-connection.php';
?>
<?php
$counter=0;
if($_POST['functionname'] === 'insert'){
    $id=$counter;
    $name = htmlspecialchars($_POST['arguments'][0]);
    $photo = htmlspecialchars($_POST['arguments'][1]);
    $address = htmlspecialchars($_POST['arguments'][2]);
    $x = htmlspecialchars($_POST['arguments'][3]);
    $y = htmlspecialchars($_POST['arguments'][4]);
    $operator = htmlspecialchars($_POST['arguments'][5]);
    $com_date = htmlspecialchars($_POST['arguments'][6]);
    $descr = htmlspecialchars($_POST['arguments'][7]);
    $sys_pow = htmlspecialchars($_POST['arguments'][8]);
    $annual_prod = htmlspecialchars($_POST['arguments'][9]);
    $co2 = htmlspecialchars($_POST['arguments'][10]);
    $reimbu = htmlspecialchars($_POST['arguments'][11]);
    $solar_mod = htmlspecialchars($_POST['arguments'][12]);
    $azimuth = htmlspecialchars($_POST['arguments'][13]);
    $inclination = htmlspecialchars($_POST['arguments'][14]);
    $communication = htmlspecialchars($_POST['arguments'][15]);
    $inverter = htmlspecialchars($_POST['arguments'][16]);
    $sensors = htmlspecialchars($_POST['arguments'][17]);
    
    
    $sql = "INSERT INTO pv(Name, Photo, Address, X, Y, Operator, Commission_Date, Description, System_Power, 
        Annual_Production, CO2, Reimbursement, SolarP_Modules, Azimuth_Angle, Inclination_Angle, Communication, Inverter, Sensors)
                    VALUES('$name','$photo','$address','$x','$y','$operator','$com_date','$descr','$sys_pow','$annual_prod','$co2',"
            . "'$reimbu','$solar_mod','$azimuth','$inclination','$communication','$inverter','$sensors')";

if (!mysqli_query($conn, $sql)) {
    die('Error: ' . mysqli_error($conn));
}
$sql->close();
}
?>
