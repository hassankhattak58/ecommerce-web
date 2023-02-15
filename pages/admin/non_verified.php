<link rel="stylesheet" href="style.css">
<link rel="stylesheet" href="../../assets/index.07349789.css">

<!-- PHP Code  -->
<style>
    body {
        background-color: #00000075;
    }

    .position_user {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        min-height: 500px;
        min-width: 700px;
        background-color: #14ffc4;
    }

    .child {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        height: 100%;
        width: 100%;
        padding: 20px;
    }

    .go_back {
        margin-left: 40px;
        padding: 10px;
    }
</style>
<?php
require("../../functions/con_inc.php");
require("../../functions/safe_value.php");

session_start();

if (isset($_SESSION['loggedin']) == true) {
    if ($_SESSION['status'] == 1) {
        header("location: ./dashboard.php");
    } else {
    }
} else {
    header("location: ../log&sign/login.php");
    exit;
}

$username = $_SESSION['username'];
$sql = mysqli_query($con, "SELECT * FROM `admins` WHERE `uname` = '$username'");
$data = mysqli_fetch_assoc($sql);
?>


<!-- PHP Code  -->



<div class="flex maindashboard">
    <!-- side panel start  -->

    <!-- side panel Ends  -->
    <div class="h-auto justify-center text-center product_list_container" id="products">
        <div class="position_user">
            <div class="child">
                <h1 style="text-align:center;" class="text-2xl">Confirm Email Address Before Conteneuing. Thanks!</h1><br>
                <h4 style="text-align:left; color:black;" id="upper_text">Code Sent Successfuly, Check your junk and Spam folder</h4>
                <div class="flex">
                    <input name="otp" id="number" class="px-1 py-2 w-96" placeholder="Enter 4 Digit Code">
                    <button id="verify_code" class="py-2 px-3 bg-blue-600 text-white font-sans text-lg hover:bg-blue-700 cursor-pointer rounded-sm duration-500 ml-10" onclick="verfiy_otp()">Verify Code</button>
                </div>
                <h2 style="color:red;" class=" text-2xl text-left" id="invalid">Please Enter Valid OTP</h2>
                <div class="flex mt-10">
                    <button onclick="send_btn()" class="py-2 px-3 bg-blue-600 text-white font-sans text-lg hover:bg-blue-700 cursor-pointer rounded-sm duration-500" id="snd_cde">Send Code</button>
                    <a href="delete_admin.php?id=<?php echo $data['id']?>" class="py-2 px-3 bg-blue-600 text-white font-sans text-lg hover:bg-blue-700 cursor-pointer rounded-sm duration-500 go_back">Delete Account</a>
                    <a href="logout.php" class="py-2 px-3 bg-blue-600 text-white font-sans text-lg hover:bg-blue-700 cursor-pointer rounded-sm duration-500 go_back">Logout</a>
                </div>
            </div>
        </div>
    </div>
</div>




<!-- scripts -->
<script>
    const btn_otp_verify = document.getElementById('verify_code');
    const send_code = document.getElementById('snd_cde');
    const text_up = document.getElementById('upper_text');
    var inp_otp = document.getElementById('number');
    const invalidotp = document.getElementById('invalid');


    btn_otp_verify.style.display = "none";
    invalidotp.style.display = "none";
    text_up.style.display = "none";

    function send_btn() {
        btn_otp_verify.style.display = "block";
        send_code.innerText = "Please Wait...";
        const xhttp = new XMLHttpRequest();
        xhttp.open("POST", "otp_send.php");
        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhttp.onload = function() {
            if (this.status === 200) {
                // console.log(this.responseText); // For Debugging Purpose
                text_up.style.display = "block";
                send_code.style.opacity = "0.6";
                send_code.innerText = "Code Sent Succefully";
                send_code.disabled = true;
            } else {
                alert("Please try again later, There is something Wrong.")
            }
        }
        xhttp.send("gmail=<?php echo $data['gaddress']; ?>");
    }

    function verfiy_otp() {
        btn_otp_verify.innerText = "Verifying...";
        const xhttp = new XMLHttpRequest();
        xhttp.open("POST", "verify_otp.php");
        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhttp.onload = function() {
            if (this.status === 200) {
                if (this.responseText == "verified") {
                    btn_otp_verify.innerText = "Verified";
                    invalidotp.style.display = "none";
                    window.location = "./dashboard.php";

                } else {
                    invalidotp.style.display = "block";
                    btn_otp_verify.innerText = "Verify Code";
                }

            } else {
                alert("Please try again later, Error Occured.")
            }
        }
        xhttp.send("otp=" + inp_otp.value);
    }
</script>


<!-- scripts -->
</body>

</html>