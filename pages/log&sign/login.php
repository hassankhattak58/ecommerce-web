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
        .text_click {
            color: blue;
        }

        .loginbg {
            background: #fff;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
        }

        .inputlogin {
            background: #f0f0f0;
            border: 1px solid #f0f0f0;
            border-radius: 14px;
        }

        .screen_img {
            background: url(../../pics/back.png);
            background-position: center;
            background-size: cover;
            background-repeat: no-repeat;
        }

        .show_pass {
            position: relative;
            left: 89%;
            top: -36px;
            cursor: pointer;
            width: 30px;
            height: 30px;
        }
    </style>
    <link rel="stylesheet" href="../../assets/index.07349789.css">

    <?php
    require_once("../../functions/safe_value.php");

    $errorlogin = "";
    $usernotregiterederr = "";

    require("../../functions/con_inc.php");
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if (isset($_POST['login'])) {
            $username = safe_value($con, $_POST['uname']);
            $password = safe_value($con, $_POST['pass']);
            // $select = "SELECT * FROM `admins` WHERE `uname` = '$username' AND `passcde` = '$verfypass'";
            $select = "SELECT * FROM `admins` WHERE `uname`='$username'";
            $query = mysqli_query($con, $select);
            $loginsucess = mysqli_num_rows($query);
            if ($loginsucess == 1) {
                $fetchrow = mysqli_fetch_assoc($query);
                if (password_verify($password, $fetchrow['passcde'])) {
                    session_start();
                    $_SESSION['loggedin'] = true;
                    $_SESSION['username'] = $username;
                    $_SESSION['status'] = $fetchrow['status'];
                    header("location: ../admin/dashboard.php");
                } else {
                    $errorlogin = "<span class='mt-4 text-left'>
                <h1 class='text-red-600 text-xl pt-2 px-2'>Wrong Password.</h1>
                </span>";
                }
            } else {
                $usernotregiterederr = "<span class='mt-4 text-left'>
                <h1 class='text-red-600 text-xl pt-2 px-2'>User not Registered.</h1>
                </span>";
            }
        }
    }
    ?>
</head>

<body>
    <div class="w-full h-screen screen_img">
        <div class="w-full h-24 justify-center text-white flex hover:cursor-pointer hover:text-black duration-500">
            <span class="flex">
                <img src="../../pics/logo.png" alt="logo.MetroShoes" class="h-24 w-24  pt-6">
                <h4 class="text-2xl pt-10 ml-2">MetroShoes</h4>
            </span>
        </div>
        <div class="w-96 h-auto m-auto mt-7 loginbg py-7">
            <div class="">
                <h1 class="text-center font-bold text-2xl font-serif">Login as Admin</h1>
                <a href="signup.php" class="pl-4">Register</a>
            </div>
            <form action="login.php" class="flex flex-col p-4" method="POST">
                <input type="username" name="uname" id="uname" placeholder="User Name" required class="p-3 text-xl bg-transparent mt-4 inputlogin">
                <input name="pass" type="password" id="pass" placeholder="Password" required class="p-3 text-xl bg-transparent mt-4 inputlogin">
                <div class="show_pass" onclick="show_pass()"><i class="fa-solid" id="icon_eye"></i></div>
                <?php echo $errorlogin;
                echo $usernotregiterederr; ?>
                <input type="submit" value="Login" name="login" class="p-3 text-xl duration-500 bg-white text-black cursor-pointer hover:bg-slate-200 mt-4">
            </form>

            <div class="pl-4">
                <?php
                $check_status = mysqli_query($con, "SELECT * FROM `registration_status` WHERE `id` = 1");
                $row = mysqli_fetch_assoc($check_status);
                if ($row['status'] == 1) {
                    echo ("<p>Are you New? <a href='signup.php' class='text_click'>Click here</a> to Register</p>");
                } else {
                }
                ?>
                
            </div>
        </div>
    </div>

    <script>
        let pass = document.getElementById('pass');
        const icon = document.getElementById('icon_eye');

        icon.classList.add("fa-eye");

        function show_pass() {
            if (pass.type == "text") {
                pass.type = "password";
                icon.classList.add("fa-eye");
                icon.classList.remove("fa-eye-slash");
            } else {
                pass.type = "text";
                icon.classList.add("fa-eye-slash");
                icon.classList.remove("fa-eye");
            }

        }
    </script>




</body>

</html>