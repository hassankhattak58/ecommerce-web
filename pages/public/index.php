<!DOCTYPE html>
<html lang="en" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/96af9e4e3e.js" crossorigin="anonymous"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Fredoka:wght@300&family=Titillium+Web:wght@300&display=swap" rel="stylesheet">
    <title>MetroShoes</title>
    <style>
        .mapwidth {
            width: 800px;
            height: 400px;

        }

        .ifrmae_style {
            width: 100%;
            height: 100%;
        }

        .img_prod {
            height: 16rem;
            width: 19rem;
        }

        #map_visit {
            height: 500px;
        }

        .main-border {
            border-radius: 0% 0% 35% 35%;
        }

        .product-shadow:hover {
            box-shadow: 10px 11px 7px 4px #deddd9;
            transform: translatey(-10px);
            transform: translatex(-10px);
        }

        .div_product {
            height: 21rem;
            width: 20rem;

        }

        /* Media Querires */
        @media (max-width:1024px) {
            .home_col {
                flex-direction: column-reverse;

            }

            .upper_div {
                margin: auto;
                width: 45%;
            }

            .lower_div {
                margin: auto;
                width: 100%;
            }

            .btn_home {
                margin: auto;
            }
        }

        @media (max-width:900px) {
            #map_visit {
                height: 300px;
            }

            .mapwidth {
                width: 300px;
                height: 300px;

            }
        }
    </style>
    <link rel="stylesheet" href="../..//assets/index.07349789.css">
</head>

<body>

    <!-- Nav Bar Start -->
    <?php include("../../components/header.php") ?>
    <!-- Nav Bar Ends -->
    <?php
    $fetch_sql = mysqli_query($con, "SELECT * FROM `frontpage` WHERE `id` = '1'");
    $row = mysqli_fetch_assoc($fetch_sql);
    ?>
    <!-- Hero Section Start here -->
    <div class="w-full bg-[#d6ff00] main-border">
        <div class="p-16 flex home_col">
            <div class="lg:w-3/4 w-full lg:p-0 p-5 h-auto lower_div">
                <h1 class="text-2xl font-semibold lg:text-4xl"><?php echo $row['heading'] ?></h1>
                <p class="pt-3 pb-3 text-xl lg:text-lg"><?php echo $row['text'] ?></p>
                <div class="w-fit h-fit pt-7 btn_home"><a href="<?php echo $row['btnlink'] ?>" class="px-10  lg:py-3 py-2 font-sans[Fredoka] bg-red-600 text-white text-lg rounded-3xl w-auto  hover:bg-red-500 hover:m-3 duration-500"><?php echo $row['btn'] ?></a></div>
            </div>
            <div class="w-3/12 upper_div">
                <img src="<?php echo $row['heropic'] ?>" alt="pic">
            </div>
        </div>
    </div>
    <!-- Hero Section Ends here -->

    <!-- Select By Category  -->
    <?php
    if (!empty($_GET)) {
        require("../../functions/con_inc.php");
        require("../../functions/safe_value.php");
        $cat_id = safe_value($con,$_GET['cat']);
        $sqli_cat_name = mysqli_query($con, "SELECT `name` FROM `category` WHERE `id` = '$cat_id'");
        $cat_name_dispaly = mysqli_fetch_assoc($sqli_cat_name);
        $sqli = mysqli_query($con, "SELECT * FROM `category` WHERE `id` = '$cat_id' AND `status` = 1");
        $cat_data = mysqli_fetch_assoc($sqli);
        if (mysqli_num_rows($sqli) > 0) {
            $products = "SELECT * FROM `products` WHERE `cat` = '$cat_id'";
            $result = mysqli_query($con, $products);
            echo '<div class="w-full h-auto pt-16 justify-center text-center" id="products">
        <div>
            <h1 class="text-3xl"> ' . $cat_data['name'] . '</h1>
        </div>
        <div class="flex w-full justify-evenly mt-10 px-11 flex-wrap">
         ';
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    echo ("<div class='product-shadow shado hover:text-black duration-700 mt-2 border-2 border-black div_product'>
                <a href='products.php?id=$row[id]&&cat=$row[cat]'>
                    <div><img src='$row[imgfile]' alt='product' class='img_prod justify-center m-auto p-2'></div>
                    <div class='child_des'>
                        <h1 class='text-left text-3xl leading-10 pl-3'> " . substr($row['title'], 0, 16) . "... </h1>
                        <div class='flex h-7 px-3'>
                            <h1 class='text-xl text-red-600 w-fit leading-10'>Rs.$row[mrp] </h1>
                            <h1 class='text-md text-[#b8b8b8] w-fit pl-5 decoration-slice leading-7'>$row[discount]% off
                            </h1>
                        </div>
                    </div>
                </a>
            </div>");
                }
            } else {
                echo "<h3 class='text-2xl'>Oh Sory! No Product in this catagory.</h3>";
            }
        } else {
            echo "<div class='mt-10'>
                <h1 class='text-3xl text-center'> $cat_name_dispaly[name] </h1>
            </div>
            <h3 class='text-2xl text-center'>Oh Sory! This catagory is currently deactivated by Admin.</h3>";
        }
    }

    ?>
    </div>
    </div>
















    <!-- Products -->
    <?php include_once("../../functions/con_inc.php")   ?>
    <div class="w-full h-auto pt-16 justify-center text-center" id="products">
        <div>
            <h1 class="text-3xl">New Arrival</h1>
        </div>
        <div class="flex w-full justify-evenly mt-10 px-11 flex-wrap">
            <?php

            $products = "SELECT * FROM `products` WHERE `cat_status` = 1 ORDER BY timestamp desc limit 8";
            $result = mysqli_query($con, $products);
            if (mysqli_num_rows($result) >= 0) {
                while ($row = mysqli_fetch_assoc($result))
                    echo ("<div class='product-shadow shado hover:text-black duration-700 mt-2 border-2 border-black div_product'>
                <a href='products.php?id=$row[id]&&cat=$row[cat]'>
                    <div><img src='$row[imgfile]' alt='product' class='img_prod justify-center m-auto p-2'></div>
                    <div class='child_des'>
                        <h1 class='text-left text-3xl leading-10 pl-3'> " . substr($row['title'], 0, 16) . "... </h1>
                        <div class='flex h-7 px-3'>
                            <h1 class='text-xl text-red-600 w-fit leading-10'>Rs.$row[mrp] </h1>
                            <h1 class='text-md text-[#b8b8b8] w-fit pl-5 decoration-slice leading-7'>$row[discount]% off
                            </h1>
                        </div>
                    </div>
                </a>
            </div>");
            };
            ?>
        </div>
    </div>



    <!-- Visit Shop -->
    <div class="mt-14" id="map_visit">
        <div class="m-auto h-11 w-full">
            <h1 class="text-center text-4xl font-extrabold">We are Here</h1>
        </div>
        <div class="mapwidth m-auto ">
            <?php
            $fetch_sql = mysqli_query($con, "SELECT * FROM `sitesetting` WHERE `id` = '1'");
            $row = mysqli_fetch_assoc($fetch_sql);
            ?>
            <!-- <iframe class="m-auto ifrmae_style" src="<?php echo $row['gmap'] ?>"></iframe> -->
        </div>
    </div>

    <!-- Contact -->
    <div class="w-full h-auto pb-10" id="contact_us">
        <div class="w-full">
            <h1 class="text-center text-2xl font-semibold mt-10">Leave Message</h1>
        </div>
        <div class="w-full h-auto m-auto">
            <div class="w-3/4 justify-center m-auto">
                <div class="w-full m-auto text-center mt-3 flex flex-col" id="form_hide">
                    <!-- <input type="name" placeholder="Name" class="p-1 border-2 rounded-sm m-1"> -->
                    <input type="gmail" placeholder="Gmail Add" class="p-1 border-2 rounded-sm m-1" required id="gmail">
                    <input type="text" placeholder="Subject" class="p-1 border-2 rounded-sm m-1" required id="subject">
                    <textarea type="textarea" placeholder="Message" class="p-1 border-2 rounded-sm m-1" rows="6" cols="50" required id="msg"></textarea>
                    <div id="error">
                    <h1 style="text-align: left; font-size: 20px; color:red;">Please Fill The Fields.</h1>
                    </div>
                    <button onclick="send_btn()" class="mt-2 w-full rounded-md bg-pink-400 text-center p-2 font-semibold text-xl duration-700 hover:bg-violet-600 cursor-pointer" id="btn_clicked">Send Message</button>
                </div>
                <div id="show_div" style="margin-top: 20px;">
                    <h1 style="text-align: center; font-size: 30px;">Message Sent Successfully<br> Thanks You!</h1>
                </div>
              
            </div>
        </div>
    </div>



    <!-- footer Section -->
    <?php include("../../components/footer.php") ?>
    <!-- Footer Ends -->

    <script>

        const show_div = document.getElementById("show_div");
        const hide = document.getElementById('form_hide');
        const error = document.getElementById('error');


        show_div.style.display = "none";
        error.style.display = "none";

        function send_btn() {

           

            let title = document.getElementById('subject').value;
            let msg = document.getElementById('msg').value;
            let gmail = document.getElementById('gmail').value;
            if(title == "" && msg == "" && gmail == ""){
                error.style.display = "block";
            }else{
            const xhttp = new XMLHttpRequest();
            xhttp.open("POST", "send_msg.php");
            xhttp.onload = function() {
                if (this.status === 200) {
                    // console.log(this.responseText); // For Debugging Purpose
                    if (this.responseText == "sent") {
                        show_div.style.display = "block";
                        hide.style.display = "none";

                    } else {
                        alert("Error Occured Please try again later.")
                    }
                } else {
                    alert("Please try again later, There is something Wrong.")
                }
            }
            xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhttp.send("gmail=" + msg + "&msg=" + msg + "&sub=" + title);
        }
        }
    </script>

</body>

</html>