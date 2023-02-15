<link rel="stylesheet" href="../../assets/index.07349789.css">

<style>
    .menu_right {
        width: 80%;
    }

    .bordermenus {
        border-bottom: 1px solid;
    }

    .homebg {
        background-color: rgb(251, 251, 251);
    }

    .maindashboard {
        background-color: #00ffe9;
    }

    .cardcolor {
        background-color: #ff23ef;
    }

    .lineheight {
        line-height: 128px;
    }

    .table_width {
        width: 100%;
    }

    @media (max-width:920px) {
        .main_flex_box {
            flex-direction: column-reverse;

        }

        .fit_width {
            width: 100%;
        }
    }

    @media (max-width:800px) {
        .menu_right {
            width: 100%;
        }
    }
</style>



<!-- dashboard header  Starts  -->
<div class="flex maindashboard">
    <!-- side panel start  -->
    <?php include('../../components/adminsidepanel.php') ?>
    <!-- side panel start  -->

    <!-- Setting Section -->

    <div class="menu_right h-auto justify-center text-center" id="products">
        <div class="w-full bg-orange-600 h-14 py-3">
            <h1 class="text-3xl">Admin List</h1>
        </div>
        <table class="text-left border-[#000] border-2 m-auto bg-white table_width">
            <tr class="bg-green-500">
                <th class="py-2 w-[80px] border-[#ddd] border-2">S.no.</th>
                <th class="py-2 w-[250px] border-[#ddd] border-2">Name</th>
                <th class="py-2 w-[250px] border-[#ddd] border-2">Mobile Number</th>
                <th class="py-2 w-[400px] border-[#ddd] border-2">Gmail Add.</th>
                <th class="py-2 w-[250px] border-[#ddd] border-2">Status</th>
                <th class="py-2 w-[150px] border-[#ddd] border-2">Delete User</th>

            </tr>
            <?php
            require_once("../../functions/con_inc.php");
            $select = "SELECT * FROM `metroshoes`.`admins`";
            $sno = 0;
            $status = "";
            $query = mysqli_query($con, $select);
            while ($row = mysqli_fetch_assoc($query)) {
                if ($row['status'] == 1) {
                    $status = "Verfied";
                } else {
                    $status = "Unverified";
                };
                $sno += 1;
                echo ("<tr class=p-1 bg-[#ddd]'>
                    <td class='py-2 w-[80px] border-[#ddd] border-2'>$sno</td>
                    <td class='py-2 w-[250px] border-[#ddd] border-2'>$row[uname]</td>
                    <td class='py-2 w-[250px] border-[#ddd] border-2'>$row[phoneno]</td>
                    <td class='py-2 w-[400px] border-[#ddd] border-2'>$row[gaddress]</td>
                    <td class='py-2 w-[400px] border-[#ddd] border-2'>$status</td>
                    <td class='py-2 w-[400px] border-[#ddd] border-2'>
                    <a href='delete_user.php?id=$row[id]' class='py-2 px-3 bg-blue-600 text-white font-sans text-lg hover:bg-blue-700 cursor-pointer rounded-sm duration-500 delete'>Delete User</a>
                    </td>
                    </tr>");
            }
            ?>
        </table>
    </div>














</div>

<!-- dashboard header  Ends   -->