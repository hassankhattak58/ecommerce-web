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
        .signbg {
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

        .send_otp {
            background-color: blue;
            color: #fff;
            padding: 8px 17px;
            font-weight: bold;
        }

        .sign_bg {
            background: url(../../pics/back.png);
            background-position: center;
            background-size: cover;
            background-repeat: no-repeat;
        }

        .click_here {
            color: blue;
        }

        .sign_btn {
            background-color: black;
        }

        .show_pass {
            position: relative;
            right: 38px;
            top: 9px;
            cursor: pointer;
            width: 30px;
            height: 30px;
        }

        .msg_pass {
            padding-left: 10px;
            color: red;
            padding-top: 5px;
        }

        .otp_pass {
            padding-left: 10px;
            color: red;
            font-size: 15px;
        }

        input::-webkit-outer-spin-button,
        input::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        /* #otp{
            text-decoration: none;
        } */
    </style>
    <?php
    require_once("../../functions/con_inc.php");
    require_once("../../functions/safe_value.php");


    $exits_err = "";
    $pass_err = "";
    $err_unk = "";
    $loading = "";

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if (isset($_POST['signupbtn'])) {
            $username = safe_value($con, $_POST['uname'] );
            $mail =  safe_value($con,$_POST['mail']);
            $num = safe_value($con,$_POST['num']);
            $password = safe_value($con,$_POST['pass']);
            $cpassword = safe_value($con,$_POST['cpass']);
            $mysqliexiest = "SELECT * FROM `admins` WHERE `uname` ='$username'";
            $existrowcheck = mysqli_query($con, $mysqliexiest);
            $rowconsit = mysqli_num_rows($existrowcheck);
            if ($rowconsit == 1) {
                $exits_err = "<span class='mt-4 text-left'>
                <h1 class='text-red-600 text-xl pt-2 px-2'>Username Exist. Try with another one.</h1>
                </span>";
            } else {
                $passhash = password_hash($password, PASSWORD_DEFAULT);
                $insert = "INSERT INTO `metroshoes`.`admins`(`id`, `uname`, `gaddress` ,`phoneno`,`status`,`passcde`, `date`) VALUES ('[value-1]','$username','$mail','$num',  0 , '$passhash',current_timestamp())";
                $query = mysqli_query($con, $insert);
                if ($query) {
                    header("location: login.php");
                } else {
                    $err_unk = "<span class='mt-4 text-left'>
                        <h1 class='text-green-600 text-xl pt-2 px-2'>Error Occured.</h1>
                        </span>";
                    header("location: signup.php");
                }
            }
        }
    }


    ?>
    <link rel="stylesheet" href="../../assets/index.07349789.css">
</head>

<body>
    <div class="w-full h-screen sign_bg">
        <div class="w-full h-24 justify-center text-white flex hover:cursor-pointer hover:text-black duration-500">
            <span class="flex">
                <img src="../../pics/logo.png" alt="logo.MetroShoes" class="h-24 w-24  pt-6">
                <h4 class="text-2xl pt-10 ml-2">MetroShoes</h4>
            </span>
        </div>
        <div class="w-fit h-auto m-auto mt-7 signbg py-7">
            <div class="">
                <h1 class="text-center font-bold text-2xl font-serif">Register as Admin</h1>
            </div>
            <form action="signup.php" class="" method="POST" onsubmit="return validateform()">
                <div class="flex m-auto justify-evenly flex-wrap">
                    <input type="username" name="uname" id="uname" placeholder="User Name" required class="w-72 ml-2 px-2 p-1 bg-transparent mx-2 my-1 inputlogin">
                    <input type="Gmail" name="mail" id="mail" placeholder="Gmail Address" required class="w-72 ml-2 px-2 p-1 bg-transparent mx-2 my-1 inputlogin">
                </div>
                <div class="flex m-auto justify-center flex-wrap">
                    <input type="number" name="num" id="num_inp" placeholder="Enter Phone Number" required class="w-50 ml-2 px-2 p-1 bg-transparent mx-2 my-1 inputlogin">
                </div>
                <div class="flex m-auto justify-evenly flex-wrap">
                    <input type="password" name="pass" id="pass" placeholder="Password" required class="w-72 ml-2 px-2 p-1 bg-transparent mx-2 my-1 inputlogin">
                    <input type="password" name="cpass" id="cpass" placeholder="Confrim Password" required class="w-72 ml-2 px-2 p-1 bg-transparent mx-2 my-1 inputlogin">
                    <div class="show_pass" onclick="show_pass()"><i class="fa-solid" id="icon_eye"></i></div>
                </div>
                <div class="msg_pass"></div>
                <?php echo $exits_err;
                echo $pass_err;
                echo $err_unk; ?>
                <div class="flex m-auto justify-evenly">
                    <input type="submit" value="Sign Up" id="sub_check" name="signupbtn" class="p-2 text-xl mt-1 duration-500 text-black cursor-pointer hover:bg-slate-200 w-44 sign_btn">
                </div>
            </form>
            <div class="pl-4">
                <p>Registered? <a href="login.php" class="click_here">Click here</a> to Login</p>
            </div>
        </div>




    </div>


    <script>
        // Show Password 
        let pass = document.getElementById('pass');
        let cpass = document.getElementById('cpass');
        const check = document.querySelector('#sub_check');
        const icon = document.getElementById('icon_eye');
        const msg_pass = document.querySelector('.msg_pass');
        let username = document.getElementById('uname');
        let num = document.getElementById('num');
        icon.classList.add("fa-eye");

        function show_pass() {
            if (pass.type == "text" &&
                cpass.type == "text") {
                pass.type = "password";
                cpass.type = "password";
                icon.classList.add("fa-eye");
                icon.classList.remove("fa-eye-slash");
            } else {
                pass.type = "text";
                cpass.type = "text";
                icon.classList.add("fa-eye-slash");
                icon.classList.remove("fa-eye");
            }
        }

        // Password Length Check
        function validateform() {
            if (username.value.length <= 4) {
                msg_pass.innerHTML = "User name must have atleast three characters";
                return false;
            }
            if (num.value.length == 11) {
            }
            else{
                msg_pass.innerHTML = "Please Enter Correct Mobile Number";
                return false;
            }
            if (pass.value.length <= 7) {
                msg_pass.innerHTML = "Password must be atleast than 7 characters";
                return false;
            }
            var numbers = /[0-9]/g;
            if (pass.value.match(numbers)) {
                msg_pass.innerHTML = "";
            } else {
                msg_pass.innerHTML = "Password must contain 1 number"
                return false;
            }
            var alpha = /[A-Z]/g;
            if (pass.value.match(alpha)) {
                msg_pass.innerHTML = "";
            } else {
                msg_pass.innerHTML = "Password must contain one capital letter";
                return false;
            }

            if (pass.value != cpass.value) {
                msg_pass.innerHTML = "Password does not match";
                return false;
            }
            msg_pass.innerHTML = `<span class='mt-4 text-left'>
                                <h1 class='text-green-600 text-xl pt-2 px-2'>Please Wait.....</h1>
                                </span>`;
        }
        
    </script>
</body>

</html>