<?php 

    include_once('functions.php');

    if (isset($_GET['del'])) {
        $userid = $_GET['del'];
        $deletedata = new DB_con();
        $sql = $deletedata->delete($NationalID);

        if ($sql) {
            echo "<script>alert('Record Deleted Successfully!');</script>";
            echo "<script>window.location.href='profile.php'</script>";
        }
    }

?>