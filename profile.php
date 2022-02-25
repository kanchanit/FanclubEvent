<?php

    include_once('functions.php');

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Profile</title>

    <!-- <link rel="stylesheet" href="style.css"> -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/css/bootstrap.min.css" integrity="sha384-r4NyP46KrjDleawBgD5tp8Y7UzmLA05oM1iAEQ17CSuDqnUK2+k9luXQOfXJCJ4I" crossorigin="anonymous">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container-fluid">
        <a class="navbar-brand" href="#">FANCLUB</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#main_nav"  aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="main_nav">
            <ul class="navbar-nav">
                <li class="nav-item active"> <a class="nav-link" href="#">หน้าหลัก </a> </li>
                <li class="nav-item"><a class="nav-link" href="#"> ศิลปิน </a></li>
                <li class="nav-item"><a class="nav-link" href="#"> กิจกรรม </a></li>
                <li class="nav-item"><a class="nav-link" href="profile.php"> ข้อมูลส่วนตัว </a></li>
            </ul>
        </div>
        </div>
    </nav>

    <div class="bg-gradient">
        GRADIENT
    </div>
    <div class="container">
    <h1 class="mt-5">Profile</h1>
    <hr>
    <table id="mytable" class="table table-bordered table-striped">
        <thead>
        </thead>

        <tbody>
            <?php 
                $fetchdata = new DB_con();
                $sql = $fetchdata->fetchonerecord(1112223334455);
                while($row = mysqli_fetch_array($sql)) {
            ?>
            <div class="container">
                <?php echo '<img src="data:image/png;base64,'. base64_encode($row['Pic']).'" alt="Img" style="width: 300px; hight: 300px">'; ?>
            </div>
            
            <br><br>
            <tr>
                <th>ระดับสมาชิก: </th>
                <td><?php 
                        if($row['userType'] == 'leader'){
                            echo 'ผู้นำกิจกรรม';
                        }
                        else{
                            echo 'สมาชิก';
                        }
                    ?></td>
            </tr>
            <tr>
                <th>หมายเลขบัตรประชาชน: </th>
                <td><?php echo $row['NationalID'];?></td>
            </tr>
            <tr>
                <th>ชื่อ-นามสกุล: </th>
                <td><?php echo $row['Title_name'],' ', $row['Fname'],' ', $row['Lname']; ?></td>
            </tr>
            <tr>
                <th>เพศ: </th>
                <td><?php echo $row['Sex']?></td>
            </tr>
            <?php
                $sql1 = $fetchdata->selectLeader(1112223334455);
                while($row1 = mysqli_fetch_array($sql1)){
            ?>   
            <tr>
                <th>วันที่เกิด: </th>
                <td><?php echo $row1['Bdate']; ?></td>
            </tr>
            <tr>
                <th>ที่อยู่: </th>
                <?php 
                    $sql2 = $fetchdata->selectLocation($row1['PostNo']);
                    while($row2 = mysqli_fetch_array($sql2)){
                ?>
                <td><?php echo $row1['HouseNo'], ' ต.', $row2['subdistrict'], ' อ.', $row2['district'], ' จ.', $row2['province'], ' ', $row2['PostNo'], ' ประเทศ', $row1['Country'];?></td>
                <?php
                    }
                ?>
            </tr>
            <tr>
                <th>บัญชีธนาคาร: </th>
                <?php
                    $sql2 = $fetchdata->selectBank($row1['BankID']);
                    while($row2 = mysqli_fetch_array($sql2)){
                    ?>
                    <td><?php echo 'เลขบัญชี ', $row2['BankID'], ' ', $row2['BankName'], ' ', $row2['BankNameAcc'];?></td>
                    <?php
                        }
                    ?>
            </tr>
            <tr>
                <th>E-mail</th>
                <td><?php echo $row['email'];?></td>
            </tr>
            <tr>
                <th>เบอร์โทรศัพท์:</th>
                <td><?php echo $row['Tel'];?></td>
            </tr>
            <tr>
                <th>ศิลปินที่ดูแล:</th>
                <td><?php echo $row1['Artist'];?></td>
            </tr>
            <tr>
                <th>Username: </th>
                <td><?php echo '@', $row['Username'];?></td>
            </tr>
            <?php 
                }
            ?>
            <?php 

                }
            ?>
        </tbody>
    </table>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/js/bootstrap.min.js" integrity="sha384-oesi62hOLfzrys4LxRF63OJCXdXDipiYWBnvTl9Y9/TRlw5xlKIEHpNyvvDShgf/" crossorigin="anonymous"></script>
</body>
</html>