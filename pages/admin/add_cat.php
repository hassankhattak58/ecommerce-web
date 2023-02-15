<link rel="stylesheet" href="../../assets/index.0ad1f376.css">
<link rel="stylesheet" href="style.css">
<?php
require("../../functions/con_inc.php");
require("../../functions/safe_value.php");

$cat_exits = "";
if (isset($_POST['cat_submitt'])) {
    $cat_name =  safe_value($con,$_POST['cat_title']);
    $sqli_check = mysqli_query($con, "SELECT * FROM `category` WHERE `name` = '$cat_name'");
    $num_row = mysqli_num_rows($sqli_check);
    if ($num_row == 1) {
        $cat_exits = "<span class='mt-4 text-left'>
        <h1 class='text-red-600 text-2xl'>*Catagory already Exist*</h1>
        </span>";
    } else {
        $sql = mysqli_query($con, "INSERT INTO `category` (`id`, `name`, `status`) VALUES (NULL, '$cat_name', '1'); ");
        header("location: dashboard.php");
        die();
    }
}
?>



<!-- dashboard header  Starts  -->
<div class="flex maindashboard">
    <!-- side Panel Start -->
    <?php require("../../components/adminsidepanel.php")  ?>
    <!-- side Panel Ends -->

    <div class="w-4/5 h-auto justify-center text-center" id="products">
        <div class="w-full bg-orange-600 h-14 py-3">
            <h1 class="text-3xl">Add Catagory</h1>
        </div>
        <div class="flex w-full justify-evenly mt-3 flex-wrap px-2">
            <form action="add_cat.php" method="POST" class="flex flex-col">
                <span class="mt-4">
                    <label for="catagory_name" class="text-2xl flex flex-col text-left leading-10"> Catgory Name
                        <input type="text" name="cat_title" id="cat_title" class="w-96 h-10 px-5 py-3">
                    </label>
                </span>
                <div class="inline" style="margin-top: 50px;">
                    <span class="mt-4">
                        <input type="submit" name="cat_submitt" class="px-7 py-4 text-2xl text-white bg-blue-600 hover:bg-blue-800 cursor-pointer transition-all">
                    </span>
                    <span class="mt-4 mx-2">
                        <a href="dashboard.php" class="px-7 py-4 text-2xl text-white bg-blue-600 hover:bg-blue-800 cursor-pointer transition-all">Go Back</a>
                    </span>
                </div>
                <?php echo $cat_exits; ?>
            </form>
        </div>
    </div>
</div>