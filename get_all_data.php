<?php
 // array for JSON response
$response = array();
 
// include db connect class
require_once 'db_connect.php';
 
// connecting to db
$db = new DB_CONNECT();
 
// get all HueBulbInfo from StatisticsEnergyUsage table
$result = mysql_query("SELECT * FROM StatisticsEnergyUsage") or die(mysql_error());
 
// check for empty result
if (mysql_num_rows($result) > 0) {
    // looping through all results
    $response["data"] = array();
 
    while ($row = mysql_fetch_array($result)) {
        // temp user array
        $HueBulbInfo = array();
        $HueBulbInfo["id"] = $row["id"];
        $HueBulbInfo["time"] = $row["time"];
        $HueBulbInfo["is_on_off"] = $row["is_on_off"];
 
        // push single product into final response array
        array_push($response["data"], $HueBulbInfo);
    }
    // success
    $response["success"] = 1;
 
    // echoing JSON response
    echo json_encode($response);
} else {
    // no products found
    $response["success"] = 0;
    $response["message"] = "No data found";
 
    // echo no users JSON
    echo json_encode($response);
}
?>
