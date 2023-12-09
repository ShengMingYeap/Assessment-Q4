<?php include("db_connect.php"); ?>

<html>
    <head>
        <title>Login</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
        <link href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    </head>

    <body>
        <div class="container mt-5" style="max-width:800px;">
            <h3>Login</h3>
            <br>
            <form action="action.php" method="POST">
                <div class="mb-3">
                    <label for="InputEmail1" class="form-label">Email address</label>
                    <input type="email" name="email" class="form-control" id="InputEmail1">
                </div>
                <div class="mb-3">
                    <label for="InputPassword" class="form-label">Password</label>
                    <input type="password" name="password" class="form-control" id="InputPassword">
                </div>
                <button type="submit" name="login" class="btn btn-primary">Submit</button>
            </form>
        </div>

        <br><hr><br>

        <div class="container mt-5">
            <h3>Members Listing</h3>
            <br>

            <table id="datatables" class="table table-striped" style="width:100%">
                <thead>
                    <tr>
                        <th scope="col">No.</th>
                        <th scope="col">Username</th>
                        <th scope="col">Email</th>
                        <th scope="col">Password</th>
                        <th scope="col">Credits</th>
                        <th scope="col">Rank</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                    $query = "SELECT m.*, SUM(mw.credits) AS credits FROM members m LEFT JOIN member_wallet mw ON m.email = mw.email WHERE m.status = '1' GROUP BY m.email";
                    if($result = mysqli_query($dblink, $query)){
                        if(mysqli_num_rows($result) > 0){
                            $i = 1;
                            while($row = mysqli_fetch_array($result)){
                ?>
                                <tr>
                                    <td><?php echo $i; ?></td>
                                    <td><?php echo $row["username"]; ?></td>
                                    <td><?php echo $row["email"]; ?></td>
                                    <td><?php echo $row["password"]; ?></td>
                                    <td><?php echo (!empty($row["credits"])) ? $row["credits"] : "0"; ?></td>
                                    <td><?php echo $row["rank"]; ?></td>
                                </tr>
                <?php
                            $i++;
                            }
                        }
                    }
                ?>
                </tbody>
            </table>
        </div>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#datatables').DataTable();
        });
    </script>

    </body>
</html>