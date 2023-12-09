<?php include("header.php"); ?>

<div class="container mt-5">
    <h3>Items Listing</h3>
    <br>

    <table id="datatables" class="table table-striped" style="width:100%">
        <thead>
            <tr>
                <th scope="col">No.</th>
                <th scope="col">Item ID</th>
                <th scope="col">Item Rarity</th>
                <th scope="col">Status</th>
            </tr>
        </thead>
        <tbody>
            <?php
                $query = "SELECT * FROM items";
                if($result = mysqli_query($dblink, $query)){
                    if(mysqli_num_rows($result) > 0){
                        $i = 1;
                        while($row = mysqli_fetch_array($result)){
            ?>
                            <tr>
                                <td><?php echo $i; ?></td>
                                <td><?php echo $row["item_id"]; ?></td>
                                <td><?php echo $row["item_rarity"]; ?></td>
                                <td><?php echo ($row["status"] == "1") ? 'Active' : 'Inactive';?></td>
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