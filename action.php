<?php include("db_connect.php"); ?>

<?php 
session_start();

if(isset($_GET["logout"])){
    unset($_SESSION["member"]);
    unset($_SESSION["email"]);
    unset($_SESSION["rank"]);
    header("Location: login.php");
}

if(isset($_POST["login"])){
    
    if(isset($_SESSION["admin"])){
        unset($_SESSION["admin"]);
    }

    $query = "SELECT * FROM members WHERE email = '$_POST[email]' AND password = '$_POST[password]'";
    if($result = mysqli_query($dblink, $query)){
        if(mysqli_num_rows($result) > 0){
            $row = mysqli_fetch_array($result);
            $_SESSION["member"] = $row["username"];
            $_SESSION["email"] = $row["email"];
            $_SESSION["rank"] = $row["rank"];
            header("Location: index.php"); exit();
        }else{
            header("Location: login.php?fail=1"); exit();
        }
    }
}

if(isset($_POST["topup"])){

    $email = $_POST["email"];
    $amount = $_POST["amount"];

    // Insert member wallet
    $insertQuery = "INSERT INTO member_wallet (email,credits,status,entry_datetime) VALUE ('$email', '$amount', '1', now())";
    mysqli_query($dblink, $insertQuery) or die(mysqli_error($dblink));

    // Get sum credits
    $query = "SELECT SUM(credits) AS totalCredits FROM member_wallet WHERE email = '$email'";
    $result = mysqli_query($dblink, $query);
    $row = mysqli_fetch_array($result);

    // Check level up credits
    $rankQuery = "SELECT * FROM vip_rank WHERE levelup_credits <= '$row[totalCredits]' ORDER BY levelup_credits DESC LIMIT 1";
    $rankResult = mysqli_query($dblink, $rankQuery);
    if(mysqli_num_rows($rankResult) > 0){
        $rankRow = mysqli_fetch_array($rankResult);

        // Update member rank
        $updateMemberRank = "UPDATE members SET rank = '$rankRow[rank]' WHERE email = '$email'";
        mysqli_query($dblink, $updateMemberRank);

        $_SESSION["rank"] = $rankRow["rank"];
    }

    header("Location: index.php?topup=success"); exit();
}

if(isset($_POST["action"]) == "getItems"){
    $vip_rank = $_POST["rank"];
    echo roll_item($vip_rank);
}

function roll_item($vip_rank){
    include("db_connect.php");

    $itemRarityQuery = "SELECT * FROM vip_rank WHERE rank = '$vip_rank'";
    $itemRarityResult = mysqli_query($dblink, $itemRarityQuery);
    if(mysqli_num_rows($itemRarityResult) > 0){
        $itemRarityRow = mysqli_fetch_array($itemRarityResult);
        $itemRarityArr = explode(",",$itemRarityRow["item_rarity"]);
        $numItemRarity = count($itemRarityArr);
        $numCount = 0;
        $condition = "";

        foreach($itemRarityArr as $level){
            $numCount = $numCount + 1;
            $condition .= " item_rarity = '$level' ";
            if($numCount < $numItemRarity){
                $condition .= " OR ";
            }
        }

        $temp = array();
        $items = array();
        for ($x = 1; $x <= 100; $x++) {
            $itemQuery = "SELECT i.*, ir.color FROM items i LEFT JOIN item_rarity ir ON i.item_rarity = ir.level WHERE ($condition) AND i.status = '1' ORDER BY RAND() LIMIT 1";
            $itemResult = mysqli_query($dblink, $itemQuery);
            $itemRow = mysqli_fetch_array($itemResult);

            $temp["username"] = $_SESSION["member"];
            $temp["item_id"] = $itemRow["item_id"];
            $temp["item_rarity"] = $itemRow["item_rarity"];
            $temp["color"] = $itemRow["color"];
            $items[] = $temp;
        }

        $json = json_encode($items);
        return $json;
    }
}

?>