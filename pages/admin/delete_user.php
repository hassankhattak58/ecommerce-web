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
} else {
    header("location: ../log&sign/login.php");
    exit;
}
?>


<!-- PHP Code  -->



<div class="flex maindashboard">
    <!-- side panel start  -->

    <!-- side panel Ends  -->
    <div class="h-auto justify-center text-center product_list_container" id="products">
        <div class="position_user">
            <div class="child">
                <h1 style="text-align:center;" class="text-2xl">Confirm that its Super Admin.we will send email with OPT to super admin.</h1><br>
                <h4 style="text-align:left; color:black;" id="upper_text">Code Sent Successfuly, Check your junk and Spam folder</h4>
                <div class="flex">
                    <input name="otp" id="number" class="px-1 py-2 w-96" placeholder="Enter 4 Digit Code">
                    <button id="verify_code" class="py-2 px-3 bg-blue-600 text-white font-sans text-lg hover:bg-blue-700 cursor-pointer rounded-sm duration-500 ml-10" onclick="verfiy_otp()">Verify Code</button>
                </div>
                <h2 style="color:red;" class=" text-2xl text-left" id="invalid">Please Enter Valid OTP</h2>
                <div class="flex mt-10">
                    <button onclick="send_btn()" class="py-2 px-3 bg-blue-600 text-white font-sans text-lg hover:bg-blue-700 cursor-pointer rounded-sm duration-500" id="snd_cde">Send Code</button>
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
        xhttp.open("GET", "otp_del_admin_send.php", true);
        xhttp.onload = function() {
            if (this.status === 200) {
                console.log(this.responseText); //For Debugging Purpose
                if (this.responseText == 'error') {
                    alert("Please try again later, There is something Wrong.")
                } else {
                    text_up.style.display = "block";
                    send_code.style.opacity = "0.6";
                    send_code.innerText = "Code Sent Succefully";
                    send_code.disabled = true;
                }
            } else {
                alert("Please try again later, There is something Wrong.")
            }
        }
        xhttp.send();
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
                    window.location = "delete_admin.php?id=<?php echo safe_value($con, $_GET['id']); ?>";
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