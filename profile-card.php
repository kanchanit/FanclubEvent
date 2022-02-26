<?php

    include_once('functions.php');

    session_start();

    if ($_SESSION['id'] == "") {
        header("location: login.php");
    } else {

    $fetchdata = new DB_con();
    $user = new Member();
    $leader = new Leader();
    $location = new Leader_location();
    $bank = new Bank();

    $sql = $user->getUserInfo($_SESSION['id']);
    while($row = mysqli_fetch_array($sql)) {

?>

<html>
    <head>
        <title>Profile Card</title>
        <link rel="stylesheet" href="color.css">
        <!-- Google Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700,900&display=swap" rel="stylesheet">
        <!-- Bootstrap CSS -->
        <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css'>
        <!-- Font Awesome CSS -->
        <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/css/all.min.css'>
    </head>
    <body>
        <header>
            <center><a href="#" class="logo">FANCLUB</a></center>
            <ul>
                <li><a href="#">Home</a></li>
                <li><a href="#">Artist</a></li>
                <li><a href="#">Event</a></li>
                <li><a href="#" class="active" >Profile</a></li>
            </ul>
        </header>
        <section>
            <div>
                <img src="image/cloud.png" id="clouds">
            </div>
            <div class="student-profile py-4">
                <div class="container">
                    <div class="row">
                    <div class="col-lg-4">
                        <div class="card shadow-sm">
                            <div class="card-header bg-transparent text-center">
                                <?php echo '<img class="profile_img" src="data:image/png;base64,'. base64_encode($row['Pic']).'" alt="student dp">'; ?>
                                <h3><?php echo '@', $row['Username']; ?></h3>
                            </div>
                            <div class="card-body">
                                <p class="mb-0"><strong class="pr-1">ระดับสมาชิก:</strong>
                                    <?php 
                                        if($row['userType'] == 'leader'){
                                            echo 'ผู้นำกิจกรรม';
                                        }
                                        else{
                                            echo 'สมาชิกทั่วไป';
                                        } 
                                    ?>
                                </p>
                                <p class="mb-0"><strong class="pr-1">หมายเลขบัตรประชาชน:</strong><?php echo $row['NationalID'];?></p>
                                <p class="mb-0"><strong class="pr-1">ชื่อ-นามสกุล: </strong><?php echo $row['Title_name'], $row['Fname'], ' ', $row['Lname'] ;?></p>
                                <?php
                                if($row['userType'] == 'leader'){
                                    $sql1 = $leader->getLeaderInfo($row['NationalID']);
                                    while($row1 = mysqli_fetch_array($sql1)){
                                ?>
                                <p class="mb-0"><strong class="pr-1">วันเดือนปีเกิด:</strong><?php echo $row1['Bdate'];?></p>
                                <p class="mb-0"><strong class="pr-1">เพศ:</strong><?php echo $row['Sex'];?></p>
                                <p class="mb-0"><strong class="pr-1">ศิลปินที่ดูแล:</strong><?php echo $row1['Artist'];?></p>
                                <?php
                                    }
                                }                            
                                ?>
                            </div>   
                        </div>
                        <div class="box">
                            <a href="#change-profile" class="button">Change your profile</a>
                        </div>
                        <div class="box">
                            <a href="logout.php" class="button">Logout</a>
                        </div>
                    </div>
                    <div class="col-lg-8">
                        <div class="card shadow-sm">
                            <div class="card-header bg-transparent border-0">
                                <h3 class="mb-0"><i class="far fa-clone pr-1"></i>ข้อมูลติดต่อ</h3>
                            </div>
                        <div class="card-body pt-0">
                            <table class="table table-bordered">
                            <?php
                                if($row['userType'] == 'leader'){
                                    $sql1 = $leader->getLeaderInfo($row['NationalID']);
                                    while($row1 = mysqli_fetch_array($sql1)){
                                        $sql2 = $location->getLocation($row1['PostNo']);
                                        while($row2 = mysqli_fetch_array($sql2)){
                            ?>
                            <tr>
                                <th width="30%">เลขที่</th>
                                <td width="2%">:</td>
                                <td><?php echo $row1['HouseNo'];?></td>
                            </tr>
                            <tr>
                                <th width="30%">ตำบล</th>
                                <td width="2%">:</td>
                                <td><?php echo $row2['subdistrict']; ?></td>
                            </tr>
                            <tr>
                                <th width="30%">อำเภอ</th>
                                <td width="2%">:</td>
                                <td><?php echo $row2['district']; ?></td>
                            </tr>
                            <tr>
                                <th width="30%">จังหวัด</th>
                                <td width="2%">:</td>
                                <td><?php echo $row2['province']; ?></td>
                            </tr>
                            <tr>
                                <th width="30%">รหัสไปรษณีย์</th>
                                <td width="2%">:</td>
                                <td><?php echo $row2['PostNo']; ?></td>
                            </tr>
                            <tr>
                                <th width="30%">ประเทศ</th>
                                <td width="2%">:</td>
                                <td><?php echo $row1['Country']; ?></td>
                            </tr>
                            <?php
                                        }
                                    }
                                }
                            ?>
                            <tr>
                                <th width="30%">E-mail</th>
                                <td width="2%">:</td>
                                <td><?php echo $row['email']; ?></td>
                            </tr>
                            <tr>
                                <th width="30%">เบอร์โทรศัพท์</th>
                                <td width="2%">:</td>
                                <td><?php echo $row['Tel']; ?></td>
                            </tr>
                            </table>
                        </div>
                    </div>
                    <?php
                        if($row['userType'] == 'leader'){
                            $sql1 = $leader->getLeaderInfo($row['NationalID']);
                                while($row1 = mysqli_fetch_array($sql1)){
                                $sql3 = $bank->getBank($row1['BankID']);
                                    while($row3 = mysqli_fetch_array($sql3)){
                    ?>
                    <div style="height: 26px"></div>
                    <div class="card shadow-sm">
                        <div class="card-header bg-transparent border-0">
                            <h3 class="mb-0"><i class="far fa-clone pr-1"></i>ข้อมูลธนาคาร</h3>
                        </div>
                        <div class="card-body pt-0">
                            <table class="table table-bordered">
                            <tr>
                                <th width="30%">เลขบัญชี</th>
                                <td width="2%">:</td>
                                <td><?php echo $row3['BankID'];?></td>
                            </tr>
                            <tr>
                                <th width="30%">ธนาคาร</th>
                                <td width="2%">:</td>
                                <td><?php echo $row3['BankName']; ?></td>
                            </tr>
                            <tr>
                                <th width="30%">ชื่อบัญชี</th>
                                <td width="2%">:</td>
                                <td><?php echo $row3['BankNameAcc']; ?></td>
                            </tr>
                            </table>
                        </div>
                        </div>
                    </div>
                    <?php
                                }
                            }
                        }
                    ?>
                    </div>
                </div>
            </div>
        </section>
    </body>
    <?php
            
    }
}?>
</html>