<?php

// array for JSON response
$response = array();

// HueBulbInfo 라는 POST값이 있으면 입력을 진행
// HueBulbInfo는 1과 0 둘중에 하나의 값만 들어온다.
// 만약 HueBulbInfo가 1이면 on
// HueBulbInfo가 0이면 off가 입력되어진다.
// 자동으로 $_POST['HueBulbInfo']를 통째로 Mysql에 넣으면 된다.
if (isset($_POST['HueBulbInfo'])) {

    // include db connect class
    require_once 'db_connect.php';

    // connecting to db	
    $db = new DB_CONNECT();
    mysql_query("set names 'utf8'");
  	
	$result = mysql_query("INSERT INTO StatisticsEnergyUsage(is_on_off) VALUES(".$_POST['HueBulbInfo']);
	// INSERT INTO 테이블명(컬럼명) VALUE(컬럼값); // POST말고 다른 방식으로 값을 받아도 된다.
	
    // check if row inserted or not
    if ($result) {
        // successfully inserted into database
        $response["success"] = 1;
        $response["message"] = "Values successfully input";
        
        // echoing JSON response
        echo json_encode($response);
    } else {
        // failed to insert row
        $response["success"] = 0;
        $response["message"] = "Oops! An error occurred.";
 
        // echoing JSON response
        echo json_encode($response);
    }
} else {
    // required field is missing
    $response["success"] = 0;
    $response["message"] = "Required field(s) is missing";
 
    // echoing JSON response
    echo json_encode($response);
}

?>
