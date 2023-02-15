<link rel="stylesheet" href="../../assets/index.07349789.css">
<script src="https://kit.fontawesome.com/96af9e4e3e.js" crossorigin="anonymous"></script>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Fredoka:wght@300&family=Titillium+Web:wght@300&display=swap" rel="stylesheet">

<style>
    .ml10 {
        margin-left: 10px;
    }

    .input_checkbox {
        height: 18px;
        width: 18px;
    }

    @media (max-width: 1110px) {
        .product_res {
            flex-direction: column;
        }

        .resp_center {
            margin: auto;
            width: 100%;
            margin-left: 10px;
        }
    }
</style>

<!-- PHP Here -->
<?php
require("../../functions/con_inc.php");
require("../../functions/safe_value.php");

$id = safe_value($con, $_GET['id']);
$sqli = mysqli_query($con, "SELECT * FROM `products` WHERE id = '$id' ");
$row = mysqli_fetch_assoc($sqli);

$sqli_cat = mysqli_query($con, "SELECT * FROM `category`");

if (isset($_POST['update_edit_add'])) {
    $mrp = safe_value($con, $_POST['mrp']);
    $discount = safe_value($con, $_POST['discount']);
    $title = safe_value($con, $_POST['title']);
    $description = safe_value($con, $_POST['description']);
    $color = safe_value($con, $_POST['select_color']);
    $size = safe_value($con, $_POST['select_size']);
    $id = safe_value($con, $_GET['id']);
    $cat = safe_value($con, $_POST['select_cat']);
    // echo $cat;

    // Update Record
    $sqli_update = mysqli_query($con, "UPDATE `products` SET `description` =  '$description', `title` = '$title', `mrp` = '$mrp', `cat` = $cat, `discount` = '$discount', `color` = '$color', `size` = '$size' WHERE `products`.`id` = '$id' ");
    header("location: productlist.php");
}
?>
<!-- PHP Here -->


<!-- product page -->
<div class="justify-evenly pt-10 bg-gray-200 w-full px-8 pb-10">
    <form action="update.php?id=<?php echo $id ?>" class="w-full flex justify-around product_res h-auto" method="POST">
        <div class="w-[50%] resp_center">
            <img src="../../pics/01.png" alt="products" class="align-middle m-auto mt-[10%]" height="340px" width="340px">
        </div>
        <div class="w-[50%] px-10 resp_center">
            <div class="w-full mt-1">
                <span class="flex flex-col mt-2">
                    <label for="title" class="text-[20px]">Title</label>
                    <input type="text" value="<?php echo ($row['title']) ?>" id="title" class="p-2 text-xl focus:border-none" name="title">
                </span>
                <span class="flex flex-col mt-2">
                    <label for="description" class="text-[20px]">Description</label>
                    <textarea type="text" id="description" class="p-2 text-xl focus:border-none" rows="5" name="description"><?php echo ($row['description']) ?> </textarea>
                </span>
                <span class="flex flex-col mt-2">
                    <label for="mrp" class="text-[20px]">Price</label>
                    <input type="number" value="<?php echo ($row['mrp']) ?>" id="mrp" class="p-2 text-xl focus:border-none" name="mrp">
                </span>
                <span class="flex flex-col mt-2">
                    <label for="discount" class="text-[20px]">Discount</label>
                    <input type="number" value="<?php echo ($row['discount']) ?>" id="discount" class="p-2 text-xl focus:border-none" name="discount">
                </span>
                <span class="flex flex-col mt-2">
                    <label for="select_size" class="text-[20px]">Catagory</label>
                    <select name="select_cat" id="select_size" class="p-2 text-xl focus:border-none">
                        <?php
                        while ($row_cat = mysqli_fetch_assoc($sqli_cat)) {
                            echo ("<option value='$row_cat[id]'>$row_cat[name]</option>");
                        }
                        ?>
                    </select>

                </span>
                <span class=" mt-2">
                    <span class="flex flex-col mt-2">
                        <label for="select_color" class="text-[20px]">Color</label>
                        <select name="select_color" id="select_color" class="p-2 text-xl focus:border-none">
                            <?php
                            $fetch_color = mysqli_query($con, "SELECT * FROM `color_master`");
                            while ($color_row = mysqli_fetch_assoc($fetch_color)) {
                                echo ("<option value='$color_row[color_name]'>$color_row[color_name]</option>");
                            }
                            ?>
                        </select>
                    </span>
                </span>
                <span class=" mt-2">

                    <span class="flex flex-col mt-2">
                        <label for="select_size" class="text-[20px]">Color</label>
                        <select name="select_size" id="select_size" class="p-2 text-xl focus:border-none">
                            <?php
                            $fetch_size = mysqli_query($con, "SELECT * FROM `size_master`");
                            while ($size_row = mysqli_fetch_assoc($fetch_size)) {
                                echo ("<option value='$size_row[size_number]'>$size_row[size_number]</option>");
                            }
                            ?>
                        </select>
                    </span>
                </span>

            </div>
            <span class="resp_center">
                <input type="submit" name="update_edit_add" id="" value="Update/Edit/Add" class="text-[20px] py-2 p-4 bg-blue-600 hover:bg-blue-800 mt-7 cursor-pointer transition text-white">

            </span>
            <span class="resp_center ml10">
                <a href="productlist.php" name="update_cancel" id="" value="Update/Edit/Add" class="text-[20px] py-2 p-4 bg-blue-600 hover:bg-blue-800 mt-7 cursor-pointer transition text-white ">Cancel</a>
            </span>
        </div>
    </form>

</div>


<!-- footer Section -->


</body>

</html>