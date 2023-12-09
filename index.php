<?php include("db_connect.php"); ?>
<html>
<head>
    <title>VIP Reward System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

    <?php session_start(); ?>

    <style>
        .navbar-nav li a{
            color: white;
            font-weight: 600;
        }

        .navbar-nav li a:hover{
            color: #90e0ef;
        }

        .navbar {
            --bs-navbar-toggler-icon-bg: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 30 30'%3e%3cpath stroke='rgba%28255, 255, 255, 0.55%29' stroke-linecap='round' stroke-miterlimit='10' stroke-width='2' d='M4 7h22M4 15h22M4 23h22'/%3e%3c/svg%3e")
        }

        .navbar-toggler:focus{
            box-shadow: none;
        }

        .navbar-toggler{
            border: 1px solid #eee;
        }

        .bio{ 
            font-size: 18px;
            font-weight: 700;
        }

        .item-block{
            border-radius: 12px;
            padding: 16px 0;
            font-weight: 700;
        }
    </style>

    <nav class="navbar navbar-expand-lg bg-primary">
        <div class="container">
            <a class="navbar-brand text-light" href="index.php"><strong>VIP Reward System</strong></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <ul class="navbar-nav">
                    <?php
                        if(isset($_SESSION["admin"])){
                            echo "<li class='nav-item text-light fw-bold' style='padding:8px'>";
                            echo "Hi, ".$_SESSION["admin"];
                            echo "</li>";
                            echo "<li class='nav-item'><a class='nav-link' href='panel/index.php'>Admin Dashboard</a>";
                            echo "<li class='nav-item'><a class='nav-link' href='panel/action.php?logout'>Sign Out</a>";
                        }else if(isset($_SESSION["member"])){
                            echo "<li class='nav-item text-light fw-bold' style='padding:8px'>";
                            echo "Hi, ".$_SESSION["member"];
                            echo "</li>";
                            echo "<li class='nav-item'><a class='nav-link' href='topup_credits.php'>Topup Credits</a>";
                            echo "<li class='nav-item'><a class='nav-link' href='action.php?logout'>Sign Out</a>";
                        }else{
                            echo "<li class='nav-item'><a class='nav-link' href='login.php'>Login</a>";
                        }
                    ?>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-5">
        <?php 
            if(isset($_SESSION["member"])){
                $rank = $_SESSION["rank"];

                // Get sum credits
                $query = "SELECT SUM(credits) AS totalCredits FROM member_wallet WHERE email = '$_SESSION[email]'";
                $result = mysqli_query($dblink, $query);
                $row = mysqli_fetch_array($result);
        ?>
                <p class="bio">
                    Rank: <?php echo $rank; ?>
                    <br>
                    Credits: <?php echo (!empty($row["totalCredits"])) ? $row["totalCredits"] : "0"; ?>
                </p>
                
                <hr>

                <?php
                    if($row["totalCredits"] < 100){
                        echo "<h4>Insufficient Credits. Please Topup minimum 100 credits to play Gacha Game.</h4>";
                    }else{ 
                ?>
                        <div class="text-center"><button class="btn btn-success" id="getItems">Get New Equipment Items</button></div>
                <?php
                    }
                ?>
                
                <br><br>

                <div id="itemsList" class="row">

                </div>
        <?php
            }else if(isset($_SESSION["admin"])){
                echo "<h4>Please login member account to play gacha game.</h4>";
            }else{
                echo "<h4>Please login to play gacha game.</h4>";
            }
        ?>

    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"></script>
    <script>
            $(document).ready(function() {
                $("#getItems").click(function(){
                    $.ajax({
                        url:"action.php",
                        type: "POST",
                        data: {
                            action: "getItems",
                            rank: "<?php echo $rank; ?>"
                        },
                        success:function(response){
                            // console.log(response);
                            response = JSON.parse(response);
                            var html = "";
                            if(response.length) {
                                $.each(response, function(key,value) {
                                    html += "<div class='col-3 text-center mb-4'>";
                                    html += "<div class='item-block' style='border: 2px solid " + value.color + "'>Item ID: " + value.item_id + "<br>Item Rarity: " + value.item_rarity + "</div>";
                                    html += "</div>";
                                });
                            }
                            $("#itemsList").html(html);
                        },
                        error: function(error) {
                            console.log(error);
                        }
                    });
                });
            })
        </script>

</body>
</html>