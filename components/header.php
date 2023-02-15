<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        .ham_burger {
            display: none;
        }

        .drop_anchor a:hover,
        .dropdown:hover .dropbtn {
            background-color: red;
        }

        .dropdown {
            display: inline-block;
        }

        .dropdown-content {
            display: none;
            position: absolute;
            background-color: #f9f9f9;
            min-width: 160px;
            box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
            z-index: 1;
        }

        .dropdown-content a {
            color: black;
            padding: 0px 10px;
            text-decoration: none;
            display: block;
            text-align: left;
        }

        .dropdown-content a:hover {
            background-color: #f1f1f1;
        }

        .dropdown:hover .dropdown-content {
            display: block;
        }

        ::-webkit-scrollbar {
            width: 20px;
        }

        /* Track */
        ::-webkit-scrollbar-track {
            background: #f1f1f1;
        }

        /* Handle */
        ::-webkit-scrollbar-thumb {
            background: #888;
        }

        /* Handle on hover */
        ::-webkit-scrollbar-thumb:hover {
            background: #555;
        }

        @media (max-width:890px) {
            .nav_menu {
                width: 100%;
                background-color: aquamarine;
                position: absolute;
                top: 80px;
                height: 85vh;
                left: -100%;
                transition: 0.4s ease-in-out;
            }

            .nav_menu ul {
                flex-direction: column;
            }

            .dropdown-content {
                right: 124px;
                top: 166px;
            }


            .nav_menu ul li {
                margin-top: 10px;
                text-align: center;
                background: none;
            }

            .nav_logo {
                width: 100%;
                justify-content: center;
            }

            .ham_burger {
                display: block;
            }
        }
    </style>
</head>

<body>

    <?php

    require_once("../../functions/con_inc.php");
    $sqli = mysqli_query($con, "SELECT * FROM `sitesetting`");
    $data = mysqli_fetch_assoc($sqli);
    ?>
    <div class="bg-white h-20 w-full flex align-middle">
        <div class="h-full w-[30%] justify-center flex hover:cursor-pointer hover:text-violet-600 duration-500 nav_logo">
            <div class="">
                <img src="../public/<?php echo $data['img'] ?>" alt="logo.MetroShoes" height="75px" width="75px" class="mt-1">
            </div>
            <div class="h-full ">
                <h4 class="text-2xl leading-[80px]"><?php echo $data['webname'] ?></h4>
            </div>
        </div>
        <div class="justify-end w-[70%] nav_menu leading-[80px]" id="nav_menuid">
            <ul class="flex decoration-black justify-end mr-5">
                <li>
                    <a href="index.php" class="mr-5 p-4 bg-slate-100 font-popins font-family: 'Titillium Web', sans-serif;  hover:bg-black hover:cursor-pointer hover:translate-y-1 duration-500 hover:text-white">Home</a>
                </li>
                <li class="dropdown">
                    <a href="javascript:void(0)" class="dropbtn mr-5 p-4 bg-slate-100 font-popins font-family: 'Titillium Web', sans-serif;  hover:bg-black hover:cursor-pointer hover:translate-y-1 duration-500 hover:text-white">Catagories <i class="fa-solid fa-caret-down"></i></a>
                    <div class="dropdown-content">
                        <?php
                        $sqli = mysqli_query($con, "SELECT * FROM `category` WHERE `status` = 1");
                        while ($row_cat = mysqli_fetch_assoc($sqli)) {
                            echo ("<a href='index.php?cat=$row_cat[id]' class='drop_anchor'>$row_cat[name]</a>");
                        }
                        ?>
                    </div>
                </li>
                <li>
                    <a href="#map_visit" class="mr-5 p-4 bg-slate-100 font-popins font-family: 'Titillium Web', sans-serif;  hover:bg-black hover:cursor-pointer hover:translate-y-1 duration-500 hover:text-white">Visit Shop</a>
                </li>
                <li>
                    <a href="#contact_us" class="mr-5 p-4 bg-slate-100 font-popins font-family: 'Titillium Web', sans-serif;  hover:bg-black hover:cursor-pointer hover:translate-y-1 duration-500 hover:text-white">Contact Us</a>
                </li>
            </ul>
        </div>

        <div class="ham_burger m-auto mr-11 cursor-pointer" id="hamburger">
            <div class="w-11 h-1 mt-1 bg-black rounded-md" id="line1"></div>
            <div class="w-11 h-1 mt-1 bg-black rounded-md" id="line2"></div>
            <div class="w-11 h-1 mt-1 bg-black rounded-md" id="line3"></div>
        </div>
        <script>
            const menu = document.getElementById("hamburger");
            const bar = document.getElementById("nav_menuid");
            const line1 = document.getElementById("line1");
            const line2 = document.getElementById("line2");
            const line3 = document.getElementById("line3");




            menu.addEventListener("click", function() {
                if (bar.style.left == "0%") {
                    bar.style.left = "-100%";
                    line2.setAttribute("style", "right:0px; width:2.75rem;transition:0.4s;");
                    line1.setAttribute("style", "transform:rotate(0deg);transition:0.4s;");
                    line3.setAttribute("style", "transform:rotate(0deg); top:0px;transition:0.4s;");

                } else {
                    bar.style.left = "0%";
                    line2.setAttribute("style", "right:20px; width:0px; transition:0.4s;");
                    line1.setAttribute("style", "transform:rotate(45deg); top:8px;transition:0.4s; ");
                    line3.setAttribute("style", "transform:rotate(-45deg); top:-11px; position:relative;transition:0.4s;");
                }

            })
        </script>
    </div>

</body>

</html>