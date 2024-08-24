<?php 
    session_start(); 
    require '../../config.php';
    require APP_BASE . 'account.php';
    if(!isset($_SESSION['account_type']) || !isset($_SESSION["login"]) || !isset($_SESSION["password"])) {
        http_response_code(301);
        exit;
    }
    if($_SESSION["account_type"] != "client") {
        http_response_code(303);
        exit;
    } 
?>

<div class="top" id="client-layout-top">
    <div class="wrap">
        <div class="left">
            <button onclick="onNavClick('/client/');"> <i class="bi bi-arrow-left" style="font-size: 1.5em;color:#333;"></i> </button>
        </div>
        <div class="right">
            <b style="padding:10px;">Notification</b>
        </div>
    </div>
</div>
<div class="midle">
    <div class="header">
        <h1 class="title">Notifications</h1>
    </div>
    <div class="main">

        <ul class="history">
            <?php 
                $sql = sprintf("SELECT * FROM `bank_notifications` WHERE `CustomerID`=%d OR `CustomerID`=0 ORDER BY ID DESC LIMIT 30;", ACCOUNT['ID']);
                $result = $conn->query($sql);
                if($result->num_rows > 0) {

                    while($row = $result->fetch_assoc()) {

                        $icon = '<span class="icon"><i style="font-size:2em;" class="bi bi-bell-fill"></i></span>';
                        $body = $row['Body'];
                        $date = ($row['CustomerID'] != 0)? date('M, d Y', strtotime($row['RecieveDate'])) : "";
                        echo '<li class="x">';
                        echo '<div class="left">'.$icon.'</div>';
                        echo '<div class="center">'.$body.'</div>';
                        echo '<div class="right"><b>Date:</b><br/>'.$date.'</div>';
                        echo '</li>';

                    }

                } else {
                    echo '<li class="no-history">Enpty</li>';
                }
            ?>
        </ul>

    </div>
</div>