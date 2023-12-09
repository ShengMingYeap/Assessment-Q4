<?php include("header.php"); ?>

<div class="container mt-5">
    <h3>Add VIP Rank</h3>
    <br>
    <form action="action.php" method="POST">
        <?php 
            if(isset($_GET["success"])){
                if($_GET["success"] == 1){
                    echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>Successfully Add Rank <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button></div>";
                }
            }
            if(isset($_GET["fail"])){
                if($_GET["fail"] == 1){
                    echo "<div class='alert alert-warning alert-dismissible fade show' role='alert'>Fail to Add Rank <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button></div>";
                }
            }
        ?>
        <div class="mb-3">
            <label for="InputRank" class="form-label">VIP Rank</label>
            <input type="text" name="rank" class="form-control" id="InputRank" required>
        </div>
        <div class="mb-3">
            <label for="InputItemRarity" class="form-label">Item Rarity <span style="font-size:14px">(Allow Multiple Select)</span></label>
            <select class="form-select" name="item_rarity[]" id="InputItemRarity" style="width:300px;" multiple>
                <?php
                    $itemRarityQuery = "SELECT level FROM item_rarity";
                    if($itemRarityResult = mysqli_query($dblink, $itemRarityQuery)){
                        if(mysqli_num_rows($itemRarityResult) > 0){
                            $x = 1;
                            while($itemRarityRow = mysqli_fetch_array($itemRarityResult)){
                ?>
                            <option value="<?php echo $itemRarityRow["level"]; ?>" <?php echo ($x == 1) ? 'selected': '';?>><?php echo $itemRarityRow["level"]; ?></option>
                <?php 
                            $x++;
                            }
                        }
                    }
                ?>
            </select>
        </div>
        <div class="mb-3">
            <label for="InputLevelUp" class="form-label">Level Up (Credits)</label>
            <input type="number" name="levelup_credits" class="form-control" id="InputLevelUp" min="1" required>
        </div>
        <button type="submit" name="addVIPRank" class="btn btn-primary">Submit</button>
    </form>

    <br><hr><br>

    <h3>VIP Rank Listing</h3>
    <br>
    <?php
    $query = "SELECT * FROM vip_rank ORDER BY rank ASC";
    if($result = mysqli_query($dblink, $query)){
        if(mysqli_num_rows($result) > 0){
    ?>
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">No.</th>
                        <th scope="col">Rank</th>
                        <th scope="col">Item Rarity</th>
                        <th scope="col">Level Up (Credits)</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1; ?>
                    <?php while($row = mysqli_fetch_array($result)){ ?>
                        <tr>
                            <td><?php echo $i; ?></td>
                            <td><?php echo $row["rank"]; ?></td>                                
                            <td>
                                <?php 
                                    foreach(explode(",",$row["item_rarity"]) as $level){
                                        echo "<span class='badge bg-primary ms-1 me-1'>$level</span>";
                                    }
                                ?>
                            </td>
                            <td><?php echo intval($row["levelup_credits"]); ?></td>
                        </tr>
                    <?php $i++; } ?>
                </tbody>
            </table>
            <br><br>
        <?php }else{
            echo "<div class='alert alert-danger text-center'>No record found.</div>";
        }
    }
    ?>
</div>

<?php include("footer.php"); ?>