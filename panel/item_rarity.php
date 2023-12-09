<?php include("header.php"); ?>

<style>
    .minicolors-theme-default .minicolors-input{
        height: 28px;
    }
    .minicolors-theme-default.minicolors{
        display: block;
    }
</style>

<div class="container mt-5">
    <h3>Add Item Rarity</h3>
    <br>
    <form action="action.php" method="POST">
        <?php 
            if(isset($_GET["success"])){
                if($_GET["success"] == 1){
                    echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>Successfully Add Item Rarity <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button></div>";
                }
            }
            if(isset($_GET["fail"])){
                if($_GET["fail"] == 1){
                    echo "<div class='alert alert-warning alert-dismissible fade show' role='alert'>Fail to Add Item Rarity <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button></div>";
                }
            }
        ?>
        <div class="mb-3">
            <label for="InputItemRarity" class="form-label">Item Rarity</label>
            <input type="number" name="level" class="form-control" id="InputItemRarity" min="1" required>
        </div>
        <div class="mb-3">
            <label for="InputColor" class="form-label">Color</label>
            <input type="text" name="color" class="form-control colorpicker" id="InputColor" required>
        </div>
        <button type="submit" name="addItemRarity" class="btn btn-primary">Submit</button>
    </form>

    <br><br>

    <h3>Item Rarity Listing</h3>
    <br>
    <?php
    $query = "SELECT * FROM item_rarity ORDER BY level ASC";
    if($result = mysqli_query($dblink, $query)){
        if(mysqli_num_rows($result) > 0){
    ?>
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Item Rarity</th>
                        <th scope="col">Color</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while($row = mysqli_fetch_array($result)){ ?>
                        <tr>
                            <td><?php echo $row["level"]; ?></td>
                            <td><div style="width:40px;height:40px;background-color:<?php echo $row['color'];?>"></div> <div><?php echo $row["color"];?></div></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        <?php }else{
            echo "<div class='alert alert-danger text-center'>No record found.</div>";
        }
    }
    ?>

    <br><br>

</div>

<?php include("footer.php"); ?>