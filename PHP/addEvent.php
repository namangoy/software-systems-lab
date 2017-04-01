<?php
    require_once('connect.php');

    $response = array();
    $response["success"] = false;

    if (isset($_POST["event_name"]) && trim($_POST["event_name"]) != "" && isset($_POST["user_id"]) && trim($_POST["user_id"]) != ""  && isset($_POST["category_id"]) && trim($_POST["category_id"]) != "" && isset($_POST["usertype_id"]) && trim($_POST["usertype_id"]) != "" && isset($_POST["venue"]) && trim($_POST["venue"]) != "" && isset($_POST["time"]) && trim($_POST["time"]) != "" && isset($_POST["details"]) && trim($_POST["details"]) != "" ){

	    $event_name = trim($_POST["event_name"]);
	    $user_id = trim($_POST["user_id"]);    
	    $category_id = trim($_POST["category_id"]);
	    $usertype_id = trim($_POST["usertype_id"]);
	    $venue = trim($_POST["venue"]);
	    $eventtime = trim($_POST["time"]);
	    $details = trim($_POST["details"]);
	    
	    
	    
	    function registerEvent() {
	        global $connect, $event_name, $user_id, $category_id, $usertype_id, $venue, $eventtime, $details;

	        $statement = mysqli_prepare($connect, "INSERT INTO events (name, user_id, category_id, usertype_id, venue, time, details) VALUES (?, ?, ?, ?, ?, ?, ?)");
	        mysqli_stmt_bind_param($statement, "siiisss", $event_name, $user_id, $category_id, $usertype_id, $venue ,$eventtime, $details);
	        if (mysqli_stmt_execute($statement)){
	            mysqli_stmt_close($statement);
	            return true;
	        }
	        mysqli_stmt_close($statement);
	        return false;
	        
	    }
	    function eventAvailable() {
	        return true;
	    }
	    
	    if (eventAvailable()){
	        if(registerEvent()){
	            $response["success"] = true;    
	        }          
	    }
    }
    echo json_encode($response);
    mysqli_close($connect);
    $_POST = array();
?>
