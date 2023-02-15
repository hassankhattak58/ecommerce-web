<!DOCTYPE html>
<html lang="en" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="PERDEV | Perfect Developer">
    <meta name="title" content="MertroShoes">
    <meta name="description" content="A easy and accessable shoes store in Pakistan Kohat">
    <meta name="keywords" content="shoes,store,online,ecommerce, online sote, shoes, kohat">
    <script src="https://kit.fontawesome.com/96af9e4e3e.js" crossorigin="anonymous"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Fredoka:wght@300&family=Titillium+Web:wght@300&display=swap" rel="stylesheet">
    <title>MetroShoes</title>
    <style>
        .text_break {
            line-break: anywhere;
        }
        .line_break_desc{
            line-break: anywhere;
            padding: 0px 20px
        }

        .resp_center {
            width: 50%;
            padding: 10px 0px;
        }

        @media (max-width:825px) {
            .product_res {
                flex-direction: column;
            }

            .resp_center {
                margin: auto;
                width: 100%;
                padding: 0px;
            }

            .selectdivcneter {
                justify-content: center;
                text-align: center;
            }

            .product_resposinve {
                width: 100%;
                padding: 0px;
            }

            .description {
                padding-top: 0px;
                margin-top: 0px;
            }

        }
    </style>
    <link rel="stylesheet" href="../../assets/index.07349789.css">
</head>

<body>


    <!-- Navbar Start  -->
    <?php include_once("../../components/header.php") ?>
    <!-- Nav bar Ends -->


    <!-- product page -->


    <?php
    include_once("../../functions/con_inc.php");
    include_once("../../functions/safe_value.php");
    $id = safe_value($con,$_GET['id']);
    $cat_id = safe_value($con,$_GET['cat']);
    $query = "SELECT * FROM `products` WHERE `id` = $id";
    $mysql = mysqli_query($con, $query);
    $cat = mysqli_query($con, "SELECT * FROM `category` WHERE id = '$cat_id'");
    $cat_name = mysqli_fetch_assoc($cat);

    while ($row = mysqli_fetch_assoc($mysql)) {
        echo (" 
            <div class='justify-evenly pt-10 bg-gray-200 w-full px-8'>
                <div class='w-full flex justify-around product_res h-auto'>
                    <div class='w-[50%] resp_center'>
                        <img src='$row[imgfile]' alt='products' class='align-middle m-auto mt-[10%]' height='340px'
                            width='340px'>
                    </div>    
                    <div class='h-[350px] resp_center product_resposinve'>
                    <h1 class='text-left font-thin text-xl'>Cat:$cat_name[name]</h1>
                    <div>
                        <h1 class='text-left font-thin text-3xl text_break mt-4'>$row[title]</h1>
                    </div>
                    <div class='flex h-7 px-3 '>
                        <h1 class='text-xl text-red-600 w-fit leading-7'>Rs.$row[mrp]</h1>
                        <h1 class='text-md text-[#b8b8b8] w-fit pl-5 decoration-slice leading-7'>$row[discount]%Off</h1>
                    </div>
                    <div class='px-3 w-full  border-2 border-black mt-4'>
                        <div class='mt-2'><h1 class='text-xl'>Avaible Color: $row[color] </h1></div>
                    </div>
                    <div class='px-3 w-full border-2 border-black mt-1 mt-4'>
                        <div class='mt-2'><h1 class='text-xl'>Avaible Size: $row[size]</h1></div>
                    </div>
                </div>
                </div>
                <div class='mt-10 pb-5 pt-6 description'>
                <h1 class='text-xl font-bold'>Description:</h1>
                <p class='line_break_desc'>$row[description]</p>
                </div>
            </div>");
    }

    ?>


     <!-- footer Section -->
     <?php include("../../components/footer.php") ?>
    <!-- Footer Ends -->


</body>

</html>