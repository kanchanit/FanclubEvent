<?php

    include_once('functions.php');
    $fetchdata = new DB_con();
    $sql = $fetchdata->fetchonerecord(1112223334455);
    while($row = mysqli_fetch_array($sql)) {
        $sql1 = $fetchdata->selectLeader($row['NationalID']);
        while($row1 = mysqli_fetch_array($sql1)){
            $sql2 = $fetchdata->selectLocation($row1['PostNo']);
            while($row2 = mysqli_fetch_array($sql2)){
                $sql3 = $fetchdata->selectBank($row1['BankID']);
                while($row3 = mysqli_fetch_array($sql3)){

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Decoration Web</title>
        <link rel="stylesheet" href="style.css">

    </head>
    <body>
        <div>
            <div class="navbar">
                <a href="" class="logo">FANCLUB</a>
                <nav>
                    <ul>
                        <li><a href="">Home</a></li>
                        <li><a href="">Artist</a></li>
                        <li><a href="">Event</a></li>
                        <li><a href="">Profile</a></li>
                    </ul>
                </nav>
            </div>
            <hr>
            <div class="profile-card">
                <div class="card-header">
                    <div class="pic">
                        <?php echo '<img src="data:image/png;base64,'. base64_encode($row['Pic']).'" alt="Img">'; ?>
                    </div>
                    <div class="username"><?php echo '@', $row['Username']; ?></div>
                    <div class="name"><?php echo 'นาย', $row['Fname'], ' ', $row['Lname'] ;?></div>
                    <img src="image/location-icon.png" width="30px ">
                    <?php echo $row1['HouseNo'], ' ตำบล', $row2['subdistrict'], ' อำเภอ', $row2['district'], ' จังหวัด', $row2['province'], ' ', $row2['PostNo'], ' ประเทศ', $row1['Country']?>
                    <br>
                    <img src="image/schedule.png" width="30px">
                    <?php echo 'B-date: ', $row1['Bdate'];?>
                    <br>
                    <img src="image/male-icon.png" width="30px">
                    <?php echo 'เพศ', $row['Sex'];?>
                    <br>
                    <img src="image/bank-icon.png" width="30px">
                    <?php echo 'เลขบัญชี: ', $row3['BankID'], ' ธนาคาร', $row3['BankName'], ', ', $row3['BankNameAcc']; ?>
                </div>
            </div>
        </div>
    </body>
    <?php
                }
            }
        }
    }?>
</html>