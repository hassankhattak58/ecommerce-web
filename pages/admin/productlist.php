<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <link rel="stylesheet" href="style.css">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <script src="https://kit.fontawesome.com/96af9e4e3e.js" crossorigin="anonymous"></script> -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Anek+Latin:wght@300&family=Fredoka:wght@300&family=Titillium+Web:wght@300&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Fredoka:wght@300&family=Titillium+Web:wght@300&display=swap" rel="stylesheet">
    <title>MetroShoes</title>
    <script type="module" crossorigin src="../../assets/productlist.d712c67e.js"></script>
    <link rel="modulepreload" href="../../assets/modulepreload-polyfill.b7f2da20.js">
    <link rel="stylesheet" href="../../assets/index.07349789.css">
</head>
<body>
    <!-- <div class="bg-white h-20 w-full flex align-middle">
            <div class="w-full h-14 justify-center flex hover:cursor-pointer hover:text-violet-600 duration-500"><img src="logo.png" alt="logo.MetroShoes" class="h-18 w-18 ml-10 pt-6"><h4 class="text-2xl pt-6 ml-2">MetroShoes</h4></div>
    </div> -->
    <!-- Nav bar Ends -->
    <!-- dashboard header  Starts  -->
    <div class="flex maindashboard">
        <!-- side panel start  -->
        <?php include('../../components/adminsidepanel.php') ?>
        <!-- side panel start  --> 
        <!-- Setting Section -->
        <div class="h-auto justify-center text-center product_list_container" id="products">
            <div class="w-full bg-orange-600 h-14 py-3"> 
                <h1 class="text-3xl">Product List <a href="add_product.php" class="text-xl ml-10 underline_add"> Add Product</a></h1>
            </div>
            <table class='text-left border-2 m-auto bg-white w-full'>

                <tr class='bg-green-500'>
                    <th class='py-2 w-auto border-[#000] border-2'>S.no.</th>
                    <th class='py-2 border-[#000] border-2 w-[110px]'>Prodcut Pic</th>
                    <th class='py-2 w-[350px] border-[#000] border-2'>Name</th>
                    <th class='py-2 w-auto border-[#000] border-2'>Price(Rs.)</th>
                    <th class='py-2 w-auto border-[#000] border-2'>Catagory</th>
                    <th class='py-2 w-[300px] border-[#000] border-2'>Action</th>
                </tr>
            <?php
            include_once("../../functions/con_inc.php");
            $sqlquery = "SELECT * FROM `products`";
            $result = mysqli_query($con, $sqlquery);
            $pro_del_id = "";
            while ($row = mysqli_fetch_assoc($result)) {
                $cat_id = $row['cat'];
                $qury_cat = mysqli_query($con,"SELECT `name` FROM `category` WHERE id = '$cat_id'");
                $cat_name = mysqli_fetch_assoc($qury_cat);
                $pro_del_id = $row['id'];
                echo ("
                    <tr class='p-1 bg-[#fff] border-2 border-[#000]'>
                    <td class='py-2 border-[#000] border-2'>$row[id]</td>
                    <td class='py-2 border-[#000] border-2'><img src='../public/$row[imgfile]' alt='prodcutpic' width='90px'
                            height='70px'></td>
                    <td class='py-2 border-[#000] border-2'> " . substr($row['title'], 0, 20) . "... </td>
                    <td class='py-2 border-[#000] border-2'>Rs.$row[mrp]</td>
                    <td class='py-2 border-[#000] border-2'>$cat_name[name]</td>
                    <td class='py-2 flex flex-wrap justify-evenly  h-full'>
                    <a href='update.php?id=$row[id]' class='p-2 bg-blue-700 text-white m-1 cursor-pointer hover:bg-blue-500 rounded-sm duration-300'>Update</a>
                    <button 
                            class='p-2 bg-blue-700 text-white m-1 cursor-pointer hover:bg-blue-500 rounded-sm duration-300' onclick='delte_confirm_direct()'>Delete</button>
                    </td>
                    </tr>
                ");
            }
            ?>
               </table>

            <!-- Modal Section Start Here -->
            
            <!-- Confirmation Modal for Deletion -->
            <div class="w-[550px] h-[450px] absolute top-[50%] left-[50%] confirm_overlay_popup bg-[#000000ad] z-30" id="parent_confirm_delete">
                <div class="bg-white w-[30rem] h-60 rounded-md   confirm_overlay_popup top-[50%] left-[50%] relative" id="child_confirm_delete">
                    <div class="justify-center m-auto relative top-[-44px] bg-white border-4 border-white rounded-full w-[120px] h-[120px]" id="img_delete">
                        <img src="../../pics/delete.png" alt="delete_png" width="60px" height="60px" class="m-auto ">
                    </div>
                    <div class="mt-[-38px] pb-2 sm:mt-[-52px]">
                        <h1 class="lg:text-4xl sm:text-3xl text-lg font-bold">Confirm Delete?</h1>
                        <h3 class="">Click Confirm Delete to Delete the Product or Cancel to Cencel
                            Deletion
                            Process</h3>
                    </div>
                    <a href="delete_product.php?id=<?php echo $pro_del_id ?>" class="p-2 bg-red-700 text-white m-1 cursor-pointer hover:bg-red-500 rounded-sm duration-300">Confirm
                        Delete</a>
                    <button class="p-2 bg-green-700 text-white m-1 cursor-pointer hover:bg-green-500 rounded-sm duration-300" onclick="close_confirm_delete()">Cancel</button>
                </div>
            </div>



        </div>
    </div>

    <!-- dashboard header  Ends   -->

    <!-- footer Section -->

    <!-- scripts -->
    <script src="./productlist.js"></script>
    <!-- scripts -->
</body>

</html>
