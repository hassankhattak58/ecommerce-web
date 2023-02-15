<link rel="stylesheet" href="../../assets/index.0ad1f376.css">
<link rel="stylesheet" href="style.css">
<?php
$cat_exits = "";
require("../../functions/con_inc.php");
require("../../functions/safe_value.php");

$cat_id = safe_value($con, $_GET['id']);
$cat_fetch = mysqli_query($con, "SELECT * FROM `category` WHERE `id` = '$cat_id'");
$fetch_data = mysqli_fetch_assoc($cat_fetch);
if (isset($_POST['cat_update'])) {
    $cat_update_name = safe_value($con, $_POST['cat_title']);
    $update_err = mysqli_query($con, "SELECT * FROM `category` WHERE `name` = '$cat_update_name'");
    $num_row = mysqli_num_rows($update_err);
    if ($num_row == 1) {
        $cat_exits = "<span class='mt-4 text-left'>
        <h1 class='text-red-600 text-2xl'>*Catagory already Exist*</h1>
        </span>";
    } else {
        $cat_update = mysqli_query($con, "UPDATE `category` SET `name` = '$cat_update_name' WHERE `id` = '$cat_id'");
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
                <h1 class="text-3xl">Edit Catagory</h1>
            </div>
            <div class="flex w-full justify-evenly mt-3 flex-wrap px-2">
                <form action="edit_cat.php?id=<?php echo $fetch_data['id']; ?>" method="POST" class="flex flex-col">
                    <span class="mt-4">
                        <label for="catagory_name" class="text-2xl flex flex-col text-left leading-10"> Catgory Name
                            <input type="text" name="cat_title" id="cat_title" class="w-96 h-10 px-5 py-3" value="<?php echo $fetch_data['name']; ?>">
                        </label>
                    </span>
                    <?php echo $cat_exits; ?>
                    <div class="inline" style="margin-top: 50px;">
                        <span class="mt-4 mx-2">
                            <input type="submit" name="cat_update" value="Update" class="px-7 py-4 text-2xl text-white bg-blue-600 hover:bg-blue-800 cursor-pointer transition-all">
                        </span>

                        <span class="mt-4 mx-2">
                            <a href="dashboard.php" class="px-7 py-4 text-2xl text-white bg-blue-600 hover:bg-blue-800 cursor-pointer transition-all">Go Back</a>
                        </span>
                    </div>
                </form>
                <span class="mt-10 mx-2">
                    <button onclick="delete_cat()" class="px-7 py-4 text-2xl text-white bg-blue-600 hover:bg-blue-800 cursor-pointer transition-all">Delete Catagory</button>
                </span>
            </div>
        </div>
    </div>


    <div style="width:100%; height:100vh;" class="absolute top-[50%] left-[50%] confirm_overlay_popup bg-[#000000ad] z-30" id="parent_confirm_delete">
        <div class="bg-white w-[30rem] h-60 rounded-md  text-center confirm_overlay_popup top-[50%] left-[50%] relative" id="child_confirm_delete">
            <div class="justify-center m-auto relative top-[-44px] bg-white border-4 border-white rounded-full w-[120px] h-[120px]" id="img_delete">
                <img src="../../pics/delete.png" alt="delete_png" width="60px" height="60px" class="m-auto ">
            </div>
            <div class="mt-[-38px] pb-2 sm:mt-[-52px]">
                <h1 class="lg:text-4xl sm:text-3xl text-lg font-bold">Are you Sure?</h1>
                <h3 class="p-4">All product related to this Category will be Deleted Also.</h3>
            </div>
            <a href="delete_cat.php?id=<?php echo $fetch_data['id'] ?>" class="p-2 bg-red-700 text-white m-1 cursor-pointer hover:bg-red-500 rounded-sm duration-300">Confirm
                Delete</a>
            <button class="p-2 bg-green-700 text-white m-1 cursor-pointer hover:bg-green-500 rounded-sm duration-300" onclick="close_confirm_delete()">Cancel</button>
        </div>
    </div>

<script>

// Delete Ctegory Button Click
const parent_conf_div = document.getElementById("parent_confirm_delete");
const child_conf_div = document.getElementById("child_confirm_delete");
parent_conf_div.style.display = "none";
child_conf_div.style.display = "none";

function delete_cat() {
    parent_conf_div.style.display = "block";
    child_conf_div.style.display = "block";
    child_conf_div.classList.add("open_confirm_modal");
}

function close_confirm_delete(){
    parent_conf_div.style.display = "none";
    child_conf_div.style.display = "none";
    child_conf_div.classList.add("open_confirm_modal");
}

function delte_confirm_direct(){
    parent_conf_div.setAttribute("style", "display:block; position:absolute; width:100%; height:100%");
    child_conf_div.style.display = "block";
    child_conf_div.classList.add("open_confirm_modal");
}

</script>