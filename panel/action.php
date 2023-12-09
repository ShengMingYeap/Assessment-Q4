<?php include("../db_connect.php"); ?>

<?php 
session_start();

if(isset($_GET["logout"])){
    unset($_SESSION["admin"]);
    header("Location: login.php");
}

if(isset($_POST["login"])){

    if(isset($_SESSION["member"])){
        unset($_SESSION["member"]);
        unset($_SESSION["email"]);
        unset($_SESSION["rank"]);
    }

    $admin_password = hash('sha256', $_POST["password"]);
    $query = "SELECT * FROM admin WHERE email = '$_POST[email]' AND password = '$admin_password'";
    if($result = mysqli_query($dblink, $query)){
        if(mysqli_num_rows($result) > 0){
            $row = mysqli_fetch_array($result);
            $_SESSION["admin"] = $row["username"];
            header("Location: index.php"); exit();
        }else{
            header("Location: login.php?fail=1"); exit();
        }
    }
}

if(isset($_POST["addVIPRank"])){
    $rank = $_POST["rank"];
    $levelupCredits = $_POST["levelup_credits"];
    $itemRarity = implode(",", $_POST["item_rarity"]);

    $query = "SELECT * FROM vip_rank WHERE rank = '$rank'";
    if($result = mysqli_query($dblink, $query)){
        if(mysqli_num_rows($result) > 0){
            header("Location: vip-rank.php?fail=1");
        }else{
            $insertQuery = "INSERT INTO vip_rank (rank,item_rarity,levelup_credits) VALUE ('$rank', '$itemRarity', '$levelupCredits')";
            mysqli_query($dblink, $insertQuery) or die(mysqli_error($dblink));

            header("Location: vip-rank.php?success=1");
        }
    }
}

if(isset($_POST["addItemRarity"])){
    $itemRarity = $_POST["level"];
    $color = $_POST["color"];

    $query = "SELECT * FROM item_rarity WHERE level = '$itemRarity'";
    if($result = mysqli_query($dblink, $query)){
        if(mysqli_num_rows($result) > 0){
            header("Location: item_rarity.php?fail=1");
        }else{
            $insertQuery = "INSERT INTO item_rarity (level,color) VALUE ('$itemRarity','$color')";
            mysqli_query($dblink, $insertQuery) or die(mysqli_error($dblink));

            header("Location: item_rarity.php?success=1");
        }
    }
}

?>