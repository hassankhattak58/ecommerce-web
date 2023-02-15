<meta name="viewport" content="width=device-width, initial-scale=1.0">  

<?php
require_once("../../functions/con_inc.php");
$fetch_sql = mysqli_query($con, "SELECT * FROM `sitesetting` WHERE `id` = '1'");
$row = mysqli_fetch_assoc($fetch_sql);
?>


<div class="w-full h-52 bg-fuchsia-600 mt-14">
    <div class="p-16 m-auto pb-0">
        <div class="flex justify-evenly w-40 m-auto">
            <a href="<?php echo $row['facebook'] ?>" target="_blank" class="hover:translate-y-3 duration-300"><i class="fa-brands fa-facebook fa-2xl"></i></a>
            <a href="<?php echo $row['insta'] ?>" target="_blank" class="hover:translate-y-3 duration-300"><i class="fa-brands fa-instagram fa-2xl"></i></a>
            <a href="<?php echo $row['twitter'] ?>" target="_blank" class="hover:translate-y-3 duration-300"><i class="fa-brands fa-twitter fa-2xl"></i></a>
        </div>
        <div class="mt-11">
            <h1 class="text-center text-xl">Thanks for Visiting our Webstie</h1>
            <p class="text-center">All Right Reserved @2022</p>
        </div>
    </div>
</div>
<div class="w-full bg-violet-600 font-bold text-white hover:text-black duration-500"><a href="#">
        <h1 class="text-center">Powered By: PERDEV | Perfect Developer</h1>
    </a></div>