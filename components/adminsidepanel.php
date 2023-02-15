<style>
    .headercolor {
        background-color: rgb(22, 22, 22);
        color: rgb(124, 124, 124);
        height: 100vh;
        left: 0;
        width: 20%;
    }

    .burger {
        display: none;
        left: 40px;
        z-index: 1;
    }

    .fixed_left {
        width: 20%;
    }

    .burg_line {
        transition: 0.5s;
    }

    .active {
        background-color: #000;
        color: #fff;
        transition: 0.23;
    }

    @media (max-width:800px) {
        .fixed_left {
            position: absolute;
            width: 100%;
            top: -100%;
            transition: 0.5s cubic-bezier(0.19, 1, 0.22, 1);
        }

        .headercolor {
            width: 100%;
            z-index: 1;
        }

        .burger {
            display: block;
            z-index: 3;
        }
    }
</style>
<?php
require_once("../../functions/con_inc.php");
session_start();
if (isset($_SESSION['loggedin']) == true && $_SESSION['status'] == '1') {
} else {
    header("location: non_verified.php");
}


$pagename =  basename($_SERVER['PHP_SELF']);

?>
<!-- burger line  -->
<div class="burger mb-2  absolute top-[15px] cursor-pointer" id="burger_dashbord">
    <div class="burg_line h-1 w-9 bg-white m-1 rounded-full bur_1  relative"></div>
    <div class="burg_line h-1 w-9 bg-white m-1 rounded-full bur_2  relative"></div>
    <div class="burg_line h-1 w-9 bg-white m-1 rounded-full bur_3 relative"></div>
</div>


<!-- side panel  -->
<div class="h-screen fixed_left" id="burger_side">
    <div class="headercolor fixed">
        <div class="justify-center w-full h-14 bg-orange-600 text-white py-3 border-r-2">
            <h1 class="text-center align-middle font-semibold md:text-2xl text-lg">Admin Panel</h1>
        </div>
        <div class="w-full">
            <ul class="ml-3 w-4/5 m-auto">
                <a href="dashboard.php" class="pl-1">
                    <li class="pt-3 hover:bg-black hover:text-white duration-300 cursor-pointer bordermenus <?php echo ($pagename == "dashboard.php") ? "active" : ""; ?>">DashBoard</li>
                </a>
                <a href="productlist.php" class="pl-1">
                    <li class="pt-3 hover:bg-black hover:text-white duration-300 cursor-pointer bordermenus <?php echo ($pagename == "productlist.php") ? "active" : ""; ?>">All Product</li>
                </a>
                <a href="adminlist.php" class="pl-1">
                    <li class="pt-3 hover:bg-black hover:text-white duration-300 cursor-pointer bordermenus <?php echo ($pagename == "adminlist.php") ? "active" : ""; ?>">Admins List</li>
                </a>
                <a href="color_master.php" class="pl-1">
                    <li class="pt-3 hover:bg-black hover:text-white duration-300 cursor-pointer bordermenus <?php echo ($pagename == "color_master.php") ? "active" : ""; ?>">Color Master</li>
                </a>
                <a href="size_master.php" class="pl-1">
                    <li class="pt-3 hover:bg-black hover:text-white duration-300 cursor-pointer bordermenus <?php echo ($pagename == "size_master.php") ? "active" : ""; ?>">Size Master</li>
                </a>
                <a href="setting.php" class="pl-1">
                    <li class="pt-3 hover:bg-black hover:text-white duration-300 cursor-pointer bordermenus <?php echo ($pagename == "setting.php") ? "active" : ""; ?>">Site Setting</li>
                </a>
                <a href="frontbaner.php" class="pl-1">
                    <li class="pt-3 hover:bg-black hover:text-white duration-300 cursor-pointer bordermenus <?php echo ($pagename == "frontbaner.php") ? "active" : ""; ?>">Front Section Setting</li>
                </a>
                <a href="inbox.php" class="pl-1">
                    <li class="pt-3 hover:bg-black hover:text-white duration-300 cursor-pointer bordermenus <?php echo ($pagename == "inbox.php") ? "active" : ""; ?>">Inbox</li>
                </a>
                <a href="profile.php?username=<?php echo $_SESSION['username']; ?>" class="pl-1">
                    <li class="mt-10 hover:bg-black hover:text-white duration-300 cursor-pointer bordermenus <?php echo ($pagename == "profile.php") ? "active" : ""; ?>">Welcome <?php echo $_SESSION['username']; ?></li>
                </a>
                <a href="logout.php" class="pl-1">
                    <li class="pt-3 hover:bg-black hover:text-white duration-300 cursor-pointer bordermenus">Logout</li>
                </a>
                <a href="registration_status.php" class="pl-1">
                    <li class="pt-3 hover:bg-black hover:text-white duration-300 cursor-pointer bordermenus">
                        <?php 
                        $check_status = mysqli_query($con, "SELECT * FROM `registration_status` WHERE `id` = 1");
                        $row = mysqli_fetch_assoc($check_status);
                        if($row['status'] == 1){
                            echo "Disable Registration";
                            }else{
                                echo "Enable Registration";
                            }
                        ?>
                    </li>
                </a>
            </ul>
        </div>
    </div>
</div>


<!-- scripts  -->
<script>
    window.onload = function() {
        //    for HamBurger
        const burger = document.querySelector("#burger_dashbord");
        const sidebar = document.querySelector("#burger_side");
        const line1 = document.querySelector(".bur_1");
        const line2 = document.querySelector(".bur_2");
        const line3 = document.querySelector(".bur_3");
        sidebar.style.top = "-100%";
        burger.addEventListener("click", function() {
            if (sidebar.style.top == "-100%") {
                sidebar.style.top = "0%";
                line2.setAttribute("style", "right:20px; width:0px");
                line1.setAttribute("style", "transform:rotate(45deg); top:5px;");
                line3.setAttribute("style", "transform:rotate(-45deg); top:-9px;");
            } else {
                sidebar.style.top = "-100%"
                line2.setAttribute("style", "right:0px; width:36px");
                line1.setAttribute("style", "transform:rotate(0deg);");
                line3.setAttribute("style", "transform:rotate(0deg); top:0px;");

            }
        })
    }
</script>
<!-- scripts -->