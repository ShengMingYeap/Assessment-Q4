<?php include("db_connect.php"); ?>

<?php
    session_start();
?>

<html>
    <head>
        <title>Topup Credits</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    </head>

    <body>

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

        <?php if(!isset($_SESSION["member"])){ ?>

            <div class="container text-center mt-5" style="max-width:800px;">
                <h3>Please login to continue topup.</h3>
            </div>

        <?php } else { ?>

        <div class="container mt-5" style="max-width:800px;">
            <p>
                Accumulate top up 100 Credits VIP1.<br>
                Accumulate top up 300 Credits VIP2.<br>
                Accumulate top up 500 Credits VIP3.<br>
                Accumulate top up 800 Credits VIP4.<br>
                Accumulate top up 1000 Credits VIP5.
            </p>

            <br>

            <h3>Topup Credits</h3>
            <br>
            <form action="action.php" method="POST">
                <input type="hidden" name="email" value="<?php echo $_SESSION['email'];?>">
                <div class="mb-3">
                    <label for="InputAmount" class="form-label">Amount</label>
                    <input type="number" name="amount" min="1" class="form-control" id="InputAmount" required>
                </div>
                <div class="row">
                    <div class="w-auto">
                        <div class="btn btn-success" id="amount-50">50</div>
                    </div>
                    <div class="w-auto">
                        <div class="btn btn-success" id="amount-100">100</div>
                    </div>
                    <div class="w-auto">
                        <div class="btn btn-success" id="amount-200">200</div>
                    </div>
                    <div class="w-auto">
                        <div class="btn btn-success" id="amount-300">300</div>
                    </div>
                    <div class="w-auto">
                        <div class="btn btn-success" id="amount-500">500</div>
                    </div>
                </div>
                <br>
                <button type="submit" name="topup" class="btn btn-primary">Submit</button>
            </form>
        </div>

        <?php } ?>

        <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"></script>
        <script>
            $("#amount-50").click(function(event) { 
                $('#InputAmount').val(50); 
            }); 
            $("#amount-100").click(function(event) { 
                $('#InputAmount').val(100); 
            }); 
            $("#amount-200").click(function(event) { 
                $('#InputAmount').val(200); 
            }); 
            $("#amount-300").click(function(event) { 
                $('#InputAmount').val(300); 
            }); 
            $("#amount-500").click(function(event) { 
                $('#InputAmount').val(500); 
            }); 
        </script>

    </body>
</html>