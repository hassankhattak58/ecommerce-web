
<link rel="stylesheet" href="./style.css">
<link rel="modulepreload" href="../../assets/modulepreload-polyfill.b7f2da20.js">
<link rel="stylesheet" href="../../assets/index.07349789.css">
<style>
    /* Prfiile Secti0oon  */

    .delete {
        position: absolute;
        bottom: 50px;
        left: 500px;
    }
</style>




<!-- dashboard header  Starts  -->
<div class="flex maindashboard">
    <!-- side panel start  -->
    <?php include('../../components/adminsidepanel.php') ?>
    <!-- side panel start  -->
    <!-- Profile Section -->
    <?php
    require_once("../../functions/con_inc.php");
    require_once("../../functions/safe_value.php");

    $oldname = safe_value($con,$_GET['username']);
    $select = "SELECT * FROM `metroshoes`.`admins` WHERE `uname` = '$oldname'";
    $query = mysqli_query($con, $select);
    $row = mysqli_fetch_assoc($query);
    ?>

    <div class="h-auto justify-center text-center main_right" id="products">
        <div class="w-full bg-orange-600 h-14 py-3">
            <h1 class="text-3xl">Profile Setting</h1>
        </div>

        <div class="flex main_flex_box pb-3 mt-10">
            <div>
                <form action="./profile_script.php?username=<?php echo $row['uname'] ?>" class="" method="POST">
                    <div class="flex m-2">
                        <label for="sitename" class="leading-[44px] w-36 text-left">User Name:</label>
                        <input type="text" name="uname" id="name" class="px-1 py-2 w-96" value="<?php echo $row['uname'] ?>">
                    </div>

                    <div class="flex m-2">
                        <label for="fb" class="leading-[44px] w-36 text-left">Gmail Address</label>
                        <input type="text" name="gmail" id="fb" class="px-1 py-2 w-96" value="<?php echo $row['gaddress'] ?>">
                    </div>
                    <div class="flex m-2">
                        <label for="number" class="leading-[44px] w-36 text-left">Mobile Nubmer</label>
                        <input type="tel" name="phone" id="number" class="px-1 py-2 w-96" value="<?php echo $row['phoneno'] ?>">
                    </div>
                    <div class="ml-10">
                        <input type="submit" value="Update Profile" name="update_profile" class="py-2 px-3 bg-blue-600 text-white font-sans text-lg hover:bg-blue-700 cursor-pointer rounded-sm duration-500">
                        <input type="submit" value="Delete Profile" name="delete_profile" class="py-2 px-3 bg-blue-600 text-white font-sans text-lg hover:bg-blue-700 cursor-pointer rounded-sm duration-500 delete">

                    </div>
                </form>
            </div>
            <div class="flex flex-col h-fit w-fit fit_width">
                <div class="w-[150px] h-[150px] border-2 text-center m-auto p-1" id="inputimg">
                    <img src="" alt="Image Preview" class="w-full h-full hidden imgpreivew">
                </div>
                <input type="file" id="file" src="*" alt="logo" class="px-1 py-2 hidden" accept="image/*">
                <label for="file" class="m-auto my-2 cursor-pointer leading-[44px] w-fit text-center bg-white px-3">Upload Photo</label>
            </div>
        </div>
    </div>

</div>
</div>
<!-- dashboard header  Ends   -->





<!-- scripts -->
<script>
    // for logo preview
    const inpfile = document.getElementById("file");
    const previewcontainer = document.getElementById("inputimg");
    const previewimg = document.querySelector(".imgpreivew");
    inpfile.addEventListener("change", function() {
        const file = this.files[0];
        if (file) {
            const reader = new FileReader();
            previewimg.style.display = "block";
            reader.addEventListener("load", function() {
                previewimg.setAttribute("src", this.result);
            })
            reader.readAsDataURL(file);
        }
        // console.log(file); // For Debugging Purpose
    })



    const alert = document.querySelector(".nojs-alert");
    const closeBtn = alert.querySelector(".alert-flag");
    if (closeBtn.checked) {
        alert.remove();
    } else {
        closeBtn.addEventListener("change", () => {
            alert.remove();
        });
    }
</script>

<!-- scripts -->