<?php include("header.php"); ?>

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
                <th scope="col">Status</th>
                <th scope="col">Join Date</th>
            </tr>
        </thead>
        <tbody>
            <?php
                $query = "SELECT m.*, SUM(mw.credits) AS credits FROM members m LEFT JOIN member_wallet mw ON m.email = mw.email GROUP BY m.email";
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
                                <td><?php echo ($row["status"] == "1") ? 'Active' : 'Inactive';?></td>
                                <td><?php echo $row["entry_datetime"]; ?></td>
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

<?php include("footer.php"); ?>