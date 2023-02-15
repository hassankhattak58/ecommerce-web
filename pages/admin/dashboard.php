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
        .bordermenus {
            border-bottom: 1px solid;
        }

        .homebg {
            background-color: rgb(251, 251, 251);
        }

        .maindashboard {
            background-color: #00ffe9;
        }

        .cardcolor {
            background-color: #ff23ef;
        }

        .lineheight {
            line-height: 128px;
        }

        .main_right {
            width: 80%;
        }

        @media (max-width:800px) {
            .main_right {
                width: 100%;
            }
        }
    </style>
    <link rel="stylesheet" href="../../assets/index.07349789.css">
    <?php

    require("../../functions/con_inc.php");
    $cat_fetch = mysqli_query($con, "SELECT * FROM `category`");
    ?>
</head>

<body>
    <!-- <div class="bg-white h-20 w-full flex align-middle">
            <div class="w-full h-14 justify-center flex hover:cursor-pointer hover:text-violet-600 duration-500"><img src="logo.png" alt="logo.MetroShoes" class="h-18 w-18 ml-10 pt-6"><h4 class="text-2xl pt-6 ml-2">MetroShoes</h4></div>
    </div> -->
    <!-- Nav bar Ends -->

    <!-- dashboard header  Starts  -->
    <div class="flex maindashboard">

        <!-- side Panel Start -->
        <?php include('../../components/adminsidepanel.php') ?>
        <!-- side Panel Ends -->

        <div class="h-auto justify-center text-center main_right" id="products">
            <div class="w-full bg-orange-600 h-14 py-3">
                <h1 class="text-3xl">DashBoard</h1>
            </div>
            <div class="flex w-full justify-evenly mt-3 flex-wrap px-2">
                <?php
                    $status = "";
                while ($row_cat_fetch = mysqli_fetch_assoc($cat_fetch)) {
                    if($row_cat_fetch['status'] == 1){
                        $status = "Active";
                    }
                    else{
                        $status = "Deactive";
                    }
                    echo ("
                        <div class='rounded-md w-64 h-52 mt-3 p-5 shadow hover:bg-blue-700 hover:text-black  duration-700 cardcolor'>
                            <div class='w-52'>
                                <a href='deactivate.php?id=$row_cat_fetch[id]'
                                    <h1 class='font-mono text-xl text-center lineheight cursor-pointer'>Status:$status</h1>
                                </a>
                            </div>
                            <a href='edit_cat.php?id=$row_cat_fetch[id]'>
                                <div class='relative bottom-0 cursor-pointer'>
                                    <h1 class='text-center text-6xl bottom-0 mt-7'>$row_cat_fetch[name]</h1>
                                </div>
                            </a>
                        </div>
                    ");
                }
                ?>
                <a href="add_cat.php">
                    <div class="rounded-md w-64 h-52 mt-3 p-5 shadow hover:bg-blue-700 hover:text-black cursor-pointer duration-700 cardcolor">
                        <div class="w-52 h-32"><i class="fa-solid fa-plus fa-8x"></i></div>
                        <div class="relative bottom-0">
                            <h1 class="text-center text-2xl bottom-0">Add Catagory</h1>
                        </div>
                    </div>
                </a>
                <a href="add_product.php">
                    <div class="rounded-md w-64 h-52 mt-3 p-5 shadow hover:bg-blue-700 hover:text-black cursor-pointer duration-700 cardcolor">
                        <div class="w-52 h-32"><i class="fa-solid fa-plus fa-8x"></i></div>
                        <div class="relative bottom-0">
                            <h1 class="text-center text-2xl bottom-0">Add Product</h1>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>

    <!-- dashboard header  Ends   -->


    <!-- footer Section -->
</body>

</html>