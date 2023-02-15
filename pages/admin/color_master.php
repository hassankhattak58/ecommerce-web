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

    <?php
    require_once("../../functions/con_inc.php");
    require_once("../../functions/safe_value.php");
    if (isset($_POST['cat_submit'])) {
        $color_name = safe_value($con, $_POST['color_name']);
        $query_add = mysqli_query($con, "INSERT INTO `color_master` (`id`, `color_name`) VALUES (NULL, '$color_name')");
    }


    ?>


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
                <h1 class="text-3xl">Color Master</h1>
            </div>
            <div class="flex flex-row">
                <table class='text-left border-2 bg-white w-[30%] text-xl'>
                    <tr class='bg-green-500'>
                        <th class='py-2 border-[#000] border-2 w-[40px]'>S.no.</th>
                        <th class='py-2 border-[#000] border-2 w-[210px]'>Color Name</th>
                    </tr>
                    <?php
                    $sqlquery = "SELECT * FROM `color_master`";
                    $result = mysqli_query($con, $sqlquery);
                    $counter = 0;
                    while ($row = mysqli_fetch_assoc($result)) {
                        $counter += 1;
                        echo ("
                    <tr class='p-1 bg-[#fff] border-2 border-[#000]'>
                    <td class='py-2 border-[#000] border-2'>$counter</td>
                    <td class='py-2 border-[#000] border-2'>$row[color_name] <span style='float:right; padding: 0px 10px; cursor:pointer;'><button onclick='confirmdelete(this)' id='$row[id]' style='text-decoration:underline;'>Delete</button></span></td>
                    </tr>
                ");
                    }
                    ?>
                </table>

                <div class="w-[70%] h-auto" style="padding: 18px 70px;">
                    <form method="POST" action="color_master.php">
                        <span class="mt-4">
                            <label for="catagory_name" class="text-2xl flex flex-col text-left leading-10">Color Name
                                <input type="text" name="color_name" id="cat_title" class="w-96 h-10 px-5 py-3 pl-3" required>
                            </label>
                        </span>
                        <div class="inline" style="margin-top: 10px; float: left;">
                            <span class="">
                                <input type="submit" name="cat_submit" class="px-7 py-4 text-2xl text-white bg-blue-600 hover:bg-blue-800 cursor-pointer transition-all" style="height: 60px;width: 140px;" value="Add Color">
                            </span>
                        </div>

                    </form>
                </div>
            </div>






            <!-- Modal Section Start Here -->
            <!-- Confirmation Modal for Deletion -->
            <div style="width:100%; height:100vh;" class="absolute top-[50%] left-[50%] confirm_overlay_popup bg-[#000000ad] z-30" id="parent_confirm_delete">
                <div class="bg-white w-[30rem] h-60 rounded-md   confirm_overlay_popup top-[50%] left-[50%] relative" id="child_confirm_delete">
                    <div class="justify-center m-auto relative top-[-44px] bg-white border-4 border-white rounded-full w-[120px] h-[120px]" id="img_delete">
                        <img src="../../pics/delete.png" alt="delete_png" width="60px" height="60px" class="m-auto ">
                    </div>
                    <div class="mt-[-38px] pb-2 sm:mt-[-52px]">
                        <h1 class="lg:text-4xl sm:text-3xl text-lg font-bold">Are you Sure?</h1>
                        <h3 class="p-4">From All product this color attribute will be deleted.</h3>
                    </div>
                    <button class="p-2 bg-red-700 text-white m-1 cursor-pointer hover:bg-red-500 rounded-sm duration-300 retruning_back_id" onclick="delete_color(this)">Confirm
                        Delete</button>
                    <button class="p-2 bg-green-700 text-white m-1 cursor-pointer hover:bg-green-500 rounded-sm duration-300" onclick="close_confirm_delete()">Cancel</button>
                </div>
            </div>



        </div>
    </div>

    <!-- dashboard header  Ends   -->

    <!-- footer Section -->

    <!-- scripts -->
    <script>
        // Delete Product Button Click
        const parent_conf_div = document.getElementById("parent_confirm_delete");
        const child_conf_div = document.getElementById("child_confirm_delete");
        const ancher_tag_id = document.getElementsByClassName("retruning_back_id");
        parent_conf_div.style.display = "none";
        child_conf_div.style.display = "none";
        var color_id = document.getElementsByClassName("return_id");
        var confirm_id = "";


        function confirmdelete(button) {
            parent_conf_div.style.display = "block";
            child_conf_div.style.display = "block";
            child_conf_div.classList.add("open_confirm_modal");
            confirm_id = button.id;
            ancher_tag_id.id = confirm_id;
        }

        function close_confirm_delete() {
            parent_conf_div.style.display = "none";
            child_conf_div.style.display = "none";
            child_conf_div.classList.add("open_confirm_modal");
        }

        function delte_confirm_direct() {
            parent_conf_div.setAttribute("style", "display:block; position:absolute; width:100%; height:100%");
            child_conf_div.style.display = "block";
            child_conf_div.classList.add("open_confirm_modal");
        }






        function delete_color(button) {
            window.location = "delete_color.php?master=color&id=" + confirm_id;
        }
    </script>

    <!-- scripts -->
</body>

</html>