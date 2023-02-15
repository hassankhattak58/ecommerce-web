<link rel="stylesheet" href="./style.css">
<link rel="modulepreload" href="../../assets/modulepreload-polyfill.b7f2da20.js">
<link rel="stylesheet" href="../../assets/index.07349789.css">

<?php
$error = "";
require_once("../../functions/con_inc.php");
if (isset($_POST['updte_site_setting'])) {
    require("../../functions/safe_value.php");
    $heading = safe_value($con, $_POST['heading']);
    $text = safe_value($con, $_POST['text']);
    $btn = safe_value($con, $_POST['btn']);
    $btnlink = safe_value($con, $_POST['btnlink']);
    if ($_FILES['fileToUpload']['name'] == "") {
        $query = mysqli_query($con, "UPDATE `frontpage` SET `heading` = '$heading', `text` = '$text', `btn` = '$btn', `btnlink` = '$btnlink' WHERE `id` = '1'");
        if ($query) {
            $error = '<div class="nojs-alert">
                    <input type="checkbox" class="alert-flag" id="alert-id-0" aria-label="toggle alert alert">
                    <div class="alert-content">
                        <div>
                            <h1>Site setting Sucessffully Updated</h1>
                        </div>
                    </div>
                    <label for="alert-id-0" role="button" class="alert-close" aria-label="Close Alert">
                        <svg width="24" height="24" role="button" arial-label="close alert">
                            <line x1="0" x2="24" y1="0" y2="24" stroke="black" stroke-width="5" />
                            <line x1="24" x2="0" y1="0" y2="24" stroke="black" stroke-width="5" />
                        </svg>
                    </label>
                </div>';
        } else {
            $error = '<div class="nojs-alert">
                    <input type="checkbox" class="alert-flag" id="alert-id-0" aria-label="toggle alert alert">
                    <div class="alert-content">
                        <div>
                            <h1>Error Occured. Please Try again later</h1>
                        </div>
                    </div>
                    <label for="alert-id-0" role="button" class="alert-close" aria-label="Close Alert">
                        <svg width="24" height="24" role="button" arial-label="close alert">
                            <line x1="0" x2="24" y1="0" y2="24" stroke="black" stroke-width="5" />
                            <line x1="24" x2="0" y1="0" y2="24" stroke="black" stroke-width="5" />
                        </svg>
                    </label>
                </div>';
        }
    } else {
        $target_dir = "../public/photos/";
        $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        // Check Image 
        $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
        if ($check !== false) {
            // echo "File is an image - " . $check["mime"] . ".";
            $uploadOk = 1;
        } else {
            echo "File is not an image.";
            $uploadOk = 0;
        }
        if ($_FILES["fileToUpload"]["size"] > 1000000) {
            echo "Sorry, your image size is too large,Compress it and try again.";
            $uploadOk = 0;
        }
        if (
            $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
            && $imageFileType != "gif"
        ) {
            echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            $uploadOk = 0;
        }
        if ($uploadOk == 0) {
            echo "Try again";
            // if everything is ok, try to upload file
        } else {
            if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
                $query = mysqli_query($con, "UPDATE `frontpage` SET `heading` = '$heading', `text` = '$text', `btn` = '$btn', `btnlink` = '$btnlink',  `heropic` = '$target_file' WHERE `id` = '1'");
                if ($query) {
                    $error = '<div class="nojs-alert">
                        <input type="checkbox" class="alert-flag" id="alert-id-0" aria-label="toggle alert alert">
                        <div class="alert-content">
                            <div>
                                <h1>Site setting Sucessffully Updated</h1>
                            </div>
                        </div>
                        <label for="alert-id-0" role="button" class="alert-close" aria-label="Close Alert">
                            <svg width="24" height="24" role="button" arial-label="close alert">
                                <line x1="0" x2="24" y1="0" y2="24" stroke="black" stroke-width="5" />
                                <line x1="24" x2="0" y1="0" y2="24" stroke="black" stroke-width="5" />
                            </svg>
                        </label>
                    </div>';
                } else {
                    $error = '<div class="nojs-alert">
                        <input type="checkbox" class="alert-flag" id="alert-id-0" aria-label="toggle alert alert">
                        <div class="alert-content">
                            <div>
                                <h1>Error Occured. Please Try again later</h1>
                            </div>
                        </div>
                        <label for="alert-id-0" role="button" class="alert-close" aria-label="Close Alert">
                            <svg width="24" height="24" role="button" arial-label="close alert">
                                <line x1="0" x2="24" y1="0" y2="24" stroke="black" stroke-width="5" />
                                <line x1="24" x2="0" y1="0" y2="24" stroke="black" stroke-width="5" />
                            </svg>
                        </label>
                    </div>';
                }
            } else {
                echo "Sorry, there was an error your file.";
            }
        }
    }
}






?>







<!-- dashboard header  Starts  -->
<div class="flex maindashboard">
    <!-- side panel start  -->
    <?php include('../../components/adminsidepanel.php') ?>
    <!-- side panel start  -->


    <!-- Setting Section -->

    <div class="h-auto justify-center text-center main_right" id="products">
        <div class="w-full bg-orange-600 h-14 py-3">
            <h1 class="text-3xl">Site Setting</h1>
        </div>
        <?php
        echo   $error;
        $fetch_sql = mysqli_query($con, "SELECT * FROM `frontpage` WHERE `id` = '1'");
        $row = mysqli_fetch_assoc($fetch_sql); ?>
        <div class="flex main_flex_box pb-3">
            <div>
                <form action="frontbaner.php" class="" method="POST" enctype="multipart/form-data">
                    <div class="flex m-2">
                        <label for="sitename" class="leading-[44px] w-36 text-left">Heading:</label>
                        <input type="text" name="heading" id="heading" class="px-1 py-2 w-96" value="<?php echo $row['heading'] ?>">
                    </div>
                    <div class="flex m-2">
                        <label for="fb" class="leading-[44px] w-36 text-left">Text:</label>
                        <textarea name="text" id="text" cols="49" rows="10" value="" class="px-1 py-2"><?php echo $row['text'] ?></textarea>
                    </div>
                    <div class="flex m-2">
                        <label for="sitename" class="leading-[44px] w-36 text-left">Button Name:</label>
                        <input type="text" name="btn" id="heading" class="px-1 py-2 w-96" value="<?php echo $row['btn'] ?>">
                    </div>
                    <div class="flex m-2">
                        <label for="sitename" class="leading-[44px] w-36 text-left">Button Link:</label>
                        <input type="text" name="btnlink" id="heading" class="px-1 py-2 w-96" value="<?php echo $row['btnlink'] ?>">
                    </div>
                    <div class="flex flex-col h-fit w-fit fit_width m-auto">
                        <div class="w-[150px] h-[150px] border-2 text-center m-auto p-1" id="inputimg">
                            <img src="<?php echo $row['heropic'] ?>" alt="Image Preview" class="w-full h-full imgpreivew">
                        </div>
                        <input type="file" id="file" alt="logo" class="px-1 py-2 hidden" name="fileToUpload" value="<?php echo $row['heropic'] ?>">
                        <label for="file" class="m-auto my-2 cursor-pointer leading-[44px] w-fit text-center bg-white px-3">Upload Image</label>
                    </div>
                    <div class="mt-10">
                        <input type="submit" value="Update" name="updte_site_setting" onclick="confirm_setting_update()" class="py-2 px-3 bg-blue-600 text-white font-sans text-lg hover:bg-blue-700 cursor-pointer rounded-sm duration-500" style="font-size:25px; width: 50%; padding: 19px 18px;">
                    </div>
                </form>
            </div>

        </div>

    </div>
</div>
<!-- dashboard header  Ends   -->


<!-- footer Section -->


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

</body>

</html>