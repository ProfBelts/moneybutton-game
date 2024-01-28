<?php

session_start();

// $_SESSION = array();

if(isset($_SESSION['start_game']) && $_SESSION["start_game"] === TRUE) {
    

} else {
    $_SESSION["start_game"] = FALSE;
    $_SESSION["money"] = 500;
    $_SESSION["message"] = array();
}

// var_dump($_SESSION);

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel = "stylesheet" href = "styles.css">
</head>
<body>
    <div class = "container">
    <header> 
<?php   ?>
        <h2>Your Money: <?=$_SESSION["money"] ?></h2> 
        <form method= "post" action="process.php"> 

        <!-- If session start_game is true the value is Start Game -->
<?php
    $start_game = $_SESSION["start_game"] === FALSE ? "start" : "reset";
?>
            <input type="hidden" name="action" value="start_game">
            <input id=<?=$start_game?> type = "submit" value = <?= $_SESSION["start_game"] === FALSE ? "Start Game" : "Reset Game" ?>>
        </form>
    </header>

    <main> 
    <?php 
    $risks = array("Low Risk" => "by -25 up to 100", "Moderate Risk" => "by -100 up to 1000", "High Risk" => "by -500 up to 2500", "Severe Risk" => "by -3000 up to 5000");
    $risk_values = array("Low Risk" => "bet_low", "Moderate Risk" => "bet_moderate", "High Risk" => "bet_high", "Severe Risk" => "bet_severe");
    
    foreach($risks as $risk_level => $risk_description) 
    { 
        $bet_name = $risk_values[$risk_level];
    ?>

        <div class="box"> 
            <h3><?= $risk_level ?></h3>
            <form method="POST" action="process.php"> 
                <input type="hidden" name="action" value="bet_button">
                <input class="btn-bet" type="submit" name="<?= $bet_name ?>" value="Bet">
            </form>
            <p><?= $risk_description ?></p>
        </div>    
<?php   } ?>





    </main>

    <section class="message">
    <h2>Game Host:</h2>
    <div class="log">
        <?php
        foreach (array_chunk($_SESSION["message"], 2) as $messageChunk) {
            // Extract message and boolean from the chunk
            list($message, $resultFlag) = $messageChunk;

            // Set the color based on the result flag
            $color = $resultFlag ? "red" : "green";
        ?>
            <p style="color: <?= $color ?>;"><?= $message ?></p>
        <?php
        }
        ?>
    </div>
</section>


    
    </div>




    


</body>
</html>