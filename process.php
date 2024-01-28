<?php 
session_start();
date_default_timezone_set('Asia/Manila'); // Set the timezone to Philippines
$currentTimestamp = date('m/d/Y g:iA');

function result($risk) {
    $stakes = array("low_risk" => rand(-25, 100), "moderate_risk" => rand(-100, 500), "high_risk" => rand(-500, 2500), "severe_risk" => rand(-3000, 5000));
    
    $draw = $stakes[$risk];

    return $draw;
}


if(isset($_POST["action"]) && $_POST["action"] === "start_game") {
    
    // 
    if($_SESSION["start_game"] === FALSE) {
        $_SESSION["start_game"] = TRUE;
        // $_SESSION["message"] = "Hello";
        $_SESSION["money"] = 500;
    
    
    } else {
        $_SESSION["start_game"] = FALSE;
    }
    header("Location: index.php");
    exit(); 
}

if (isset($_POST["action"]) && $_POST["action"] === "bet_button") {
    if ($_POST["bet_low"] === "Bet") {    

        $low_result = result("low_risk");
        $loss_low = ($low_result > 0) ? FALSE : TRUE;
        $bet_message = $currentTimestamp . " You pushed Low Risk. Value is " . $low_result . " Your current money now is " . ($_SESSION["money"] += $low_result);
        array_push($_SESSION["message"], $bet_message, $loss_low);
            
    }

    if ($_POST["bet_moderate"] === "Bet") {    
        $moderate_result = result("moderate_risk");
        $moderate_loss = ($moderate_result > 0) ? FALSE : TRUE;
        $bet_message = $currentTimestamp . " You pushed Moderate Risk. Value is " . $moderate_result . " Your current money now is " . ($_SESSION["money"] += $moderate_result);
        array_push($_SESSION["message"], $bet_message, $moderate_loss);
    }


    if ($_POST["bet_high"] === "Bet") {    
        $high_result = result("high_risk");
        $high_loss = ($high_result > 0) ? FALSE : TRUE;
        $bet_message = $currentTimestamp . " You pushed High Risk. Value is " . $high_result . " Your current money now is " . ($_SESSION["money"] += $high_result);
        array_push($_SESSION["message"], $bet_message, $high_loss);
    }

    if ($_POST["bet_severe"] === "Bet") {    
        $severe_result = result("severe_risk");
        $severe_loss = ($severe_result > 0) ? FALSE : TRUE;
        $bet_message = $currentTimestamp . " You pushed Severe Risk. Value is " . $severe_result . " Your current money now is " . ($_SESSION["money"] += $severe_result);
        array_push($_SESSION["message"], $bet_message, $severe_loss);
    }


    header("Location: index.php");
    exit(); 
}
?>
