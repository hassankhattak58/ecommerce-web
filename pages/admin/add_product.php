<link rel="stylesheet" href="../../assets/index.07349789.css">
<script src="https://kit.fontawesome.com/96af9e4e3e.js" crossorigin="anonymous"></script>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Fredoka:wght@300&family=Titillium+Web:wght@300&display=swap" rel="stylesheet">

<style>
    .ml10 {
        margin-left: 10px;
    }

    .div_selling {
        background-color: #fff;
        height: 42px;
        width: 100%;
    }

    .input_checkbox {
        height: 18px;
        width: 18px;
    }

    .input_mrp_none {
        display: none;
    }

    input::-webkit-outer-spin-button,
    input::-webkit-inner-spin-button {
        -webkit-appearance: none;
        margin: 0;
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


$sqli_cat = mysqli_query($con, "SELECT * FROM `category`");

if (isset($_POST['add_product'])) {
    $description = safe_value($con, $_POST['description']);
    $title = safe_value($con, $_POST['title']);
    $mrp = safe_value($con, $_POST['mrp']);
    $discount = safe_value($con, $_POST['discount']);
    $cat = safe_value($con, $_POST['select_cat']);
    $color = safe_value($con, $_POST['select_color']);
    $size = safe_value($con, $_POST['select_size']);
    $cat_status_query = mysqli_query($con, "SELECT * FROM  `category` WHERE `id` = '$cat'");
    $cat_status_fetch = mysqli_fetch_assoc($cat_status_query);
    $cat_status = $cat_status_fetch['status'];
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


    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo "Try again";
        // if everything is ok, try to upload file
    } else {
        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
            $sqli_update = mysqli_query($con, "INSERT INTO `products` (`id`, `title`, `description`, `imgfile`, `rating`, `discount`, `color`, `size`, `mrp`, `cat`, `cat_status`) VALUES  (NULL, '$title', '$description', '$target_file' ,  '2', '$discount', '$color', '$size', '$mrp', '$cat', '$cat_status')");
            header("location: productlist.php");
            echo $cat_status;
            echo "The file " . htmlspecialchars(basename($_FILES["fileToUpload"]["name"])) . " has been uploaded.";
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }



    // Add Record

}
?>
<!-- PHP Here -->


<!-- product page -->
<div class="justify-evenly pt-10 bg-gray-200 w-full px-8 pb-10">
    <form action="add_product.php" class="w-full flex justify-around product_res h-auto" method="POST" enctype="multipart/form-data">
        <div class="w-[50%] resp_center">
            <h3 class="text-2xl" id="selec_text">Select Image</h3>
            <div id="inputimg">
                <img src="" alt="Image Preview" class="hidden imgpreivew" height="600px" width="450px">
            </div>
            <input type="file" id="file" required name="fileToUpload" value="Chose Image">
        </div>
        <div class="w-[50%] px-10 resp_center">
            <div class="w-full mt-1">
                <span class="flex flex-col mt-2">
                    <label for="title" class="text-[20px]">Title</label>
                    <input type="text" value="" id="title" class="p-2 text-xl focus:border-none" name="title" required>
                </span>
                <span class="flex flex-col mt-2">
                    <label for="description" class="text-[20px]">Description</label>
                    <textarea type="text" id="description" class="p-2 text-xl focus:border-none" rows="5" required name="description"></textarea>
                </span>
                <span class="flex flex-row">
                    <span class="flex flex-col mt-2">
                        <label for="mrp" class="text-[20px]">Price</label>
                        <input type="number" value="" id="price" class="p-2 text-xl focus:border-none" name="price" required>
                    </span>
                    <span class="flex flex-col mt-2 ml-2">
                        <label for="mrp" class="text-[20px]">Discount</label>
                        <input type="number" value="" id="discount" max="100" onchange="discountcalulate(this.value)" class="p-2 text-xl focus:border-none" name="discount" required>
                    </span>
                </span>
                <span class="flex flex-col mt-2">
                    <label for="discount" class="text-[20px]">Selling Price</label>
                    <div id="sellingprice" class="p-2 text-xl div_selling"></div>
                    <input type="number" id="mrp" name="mrp" name="discount" required class="input_mrp_none">
                </span>
                <span class="flex flex-col mt-2">
                    <label for="select_cat" class="text-[20px]">Catagory</label>
                    <select name="select_cat" id="select_cat" class="p-2 text-xl focus:border-none">
                        <?php
                        while ($row_cat = mysqli_fetch_assoc($sqli_cat)) {
                            echo ("<option value='$row_cat[id]'>$row_cat[name]</option>");
                        }
                        ?>
                    </select>

                </span>
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

            </div>
            <span class="resp_center">
                <input type="submit" name="add_product" id="" value="Add Product" class="text-[20px] py-2 p-4 bg-blue-600 hover:bg-blue-800 mt-7 cursor-pointer transition text-white">

            </span>
            <span class="resp_center ml10">
                <a href="productlist.php" name="update_cancel" id="" value="Update/Edit/Add" class="text-[20px] py-2 p-4 bg-blue-600 hover:bg-blue-800 mt-7 cursor-pointer transition text-white ">Cancel</a>
            </span>
        </div>
    </form>

</div>


<!-- footer Section -->

<script>
    // for Image preview
    const inpfile = document.getElementById("file");
    const previewcontainer = document.getElementById("inputimg");
    const previewimg = document.querySelector(".imgpreivew");
    const text = document.getElementById("selec_text");
    const price = document.getElementById("price");
    const discount = document.getElementById("discount");
    const sellingprice = document.getElementById("sellingprice");
    const mrp = document.getElementById("mrp");


    function discountcalulate(value) {
        if (discount.value > 100 || discount.value < 0) {
            alert("The Discount Value must be Between 0 and 100")
        } else {
            if (price.value == "") {

            } else {
                var x = discount.value / 100 * price.value;
                let z = Math.round(price.value - x)
                sellingprice.innerText = z;
                mrp.value = z;

            }
        }





    }
    inpfile.addEventListener("change", function() {
        const file = this.files[0];
        if (file) {
            const reader = new FileReader();
            previewimg.style.display = "block";
            text.style.display = "none";
            reader.addEventListener("load", function() {
                previewimg.setAttribute("src", this.result);
            })
            reader.readAsDataURL(file);
        }
        // console.log(file); // For Debugging Purpose
    })
</script>
</body>

</html>