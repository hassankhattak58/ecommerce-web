<link rel="stylesheet" href="./style.css">
<link rel="modulepreload" href="../../assets/modulepreload-polyfill.b7f2da20.js">
<link rel="stylesheet" href="../../assets/index.07349789.css">

<?php
$error = "";
require_once("../../functions/con_inc.php");
require_once("../../functions/safe_value.php");

if (isset($_POST['updte_site_setting'])) {
    $web = safe_value($con, $_POST['sitename']);
    $twitter = safe_value($con, $_POST['twitter']);
    $insta = safe_value($con, $_POST['instagram']);
    $facebook = safe_value($con, $_POST['fb']);
    $map = safe_value($con, $_POST['map']);
    $num = safe_value($con, $_POST['number']);
    if ($_FILES['fileToUpload']['name'] == "") {
        $query = mysqli_query($con, "UPDATE `sitesetting` SET `webname` = '$web', `facebook` = '$facebook', `mobile` = '$num', `twitter` = '$twitter',  `insta` = '$insta' , `gmap` = '$map' WHERE `id` = '1'");
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
                $query = mysqli_query($con, "UPDATE `sitesetting` SET `webname` = '$web',  `img` = '$target_file', `facebook` = '$facebook', `mobile` = '$num', `twitter` = '$twitter',  `insta` = '$insta' , `gmap` = '$map' WHERE `id` = '1'");
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
        $fetch_sql = mysqli_query($con, "SELECT * FROM `sitesetting` WHERE `id` = '1'");
        $row = mysqli_fetch_assoc($fetch_sql); ?>
        <div class="flex main_flex_box pb-3">
            <div>
                <form action="setting.php" class="" method="POST" enctype="multipart/form-data">
                    <div class="flex m-2">
                        <label for="sitename" class="leading-[44px] w-36 text-left">Website Name:</label>
                        <input type="text" name="sitename" id="name" class="px-1 py-2 w-96" value="<?php echo $row['webname'] ?>">
                    </div>

                    <div class="flex m-2">
                        <label for="fb" class="leading-[44px] w-36 text-left">Facebook Link</label>
                        <input type="text" name="fb" id="fb" class="px-1 py-2 w-96" value="<?php echo $row['facebook'] ?>">
                    </div>
                    <div class="flex m-2">
                        <label for="number" class="leading-[44px] w-36 text-left">Mobile Nubmer</label>
                        <input type="tel" name="number" id="number" class="px-1 py-2 w-96" value="<?php echo $row['mobile'] ?>">
                    </div>
                    <div class="flex m-2">
                        <label for="twitter" class="leading-[44px] w-36 text-left">Twitter Link</label>
                        <input type="text" name="twitter" id="twitter" class="px-1 py-2 w-96" value="<?php echo $row['twitter'] ?>">
                    </div>
                    <div class="flex m-2">
                        <label for="instagram" class="leading-[44px] w-36 text-left">Instagram Link</label>
                        <input type="text" name="instagram" id="instagram" class="px-1 py-2 w-96" value="<?php echo $row['insta'] ?>">
                    </div>
                    <div class="flex m-2">
                        <label for="map" class="leading-[44px] w-36 text-left">Google Map Link</label>
                        <input type="url" name="map" id="map" class="px-1 py-2 w-96" value="<?php echo $row['gmap'] ?>">
                    </div>
                    <div class="flex flex-col h-fit w-fit fit_width m-auto">
                        <div class="w-[150px] h-[150px] border-2 text-center m-auto p-1" id="inputimg">
                            <img src="<?php echo $row['img'] ?>" alt="Image Preview" class="w-full h-full imgpreivew">
                        </div>
                        <input type="file" id="file" alt="logo" class="px-1 py-2 hidden" name="fileToUpload" value="<?php echo $row['img'] ?>">
                        <label for="file" class="m-auto my-2 cursor-pointer leading-[44px] w-fit text-center bg-white px-3">Upload Logo</label>
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