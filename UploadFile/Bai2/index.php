<?php
    //connect database
    $server = "localhost";
    $user = "root";
    $pwd = "";
    $dbName = "imagemanagement";
    $db = new mysqli($server, $user, $pwd, $dbName);

    if(isset($_FILES["fileToUpload"])){
        $target_dir = "images/";
        $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
        $uploadOk = 1;
        // strtolower: convert string to lowercase
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

        // Check if image file is a actual image or fake image
        if(isset($_POST["submit"])) {
            $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
            if($check !== false) {
                echo "File is an image - " . $check["mime"] . ".";
                $uploadOk = 1;
                $name = $_FILES["fileToUpload"]["name"];
                $sql = "INSERT INTO `images`(`link`) VALUES ("."'"."images/".$name."'".")";
                $db->query($sql);
            }else {
                echo "File is not an image.";
                $uploadOk = 0;
            }
        }

    // Check if file already exists
        if (file_exists($target_file)) {
            echo "Sorry, file already exists.";
            $uploadOk = 0;
        }

    // Check file size
        if ($_FILES["fileToUpload"]["size"] > 500000) {
            echo "Sorry, your file is too large.";
            $uploadOk = 0;
        }

    // Allow certain file formats
        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
            && $imageFileType != "gif" ) {
            echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
        }
        if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
        } else {
            if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
                echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
                $sql="insert into image values(null,'". basename( $_FILES["fileToUpload"]["name"]) ."');" ;
                $db->query($sql); 
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        } 
    }
    
    $sql2 = "SELECT * FROM images";
    $result = $db->query($sql2)->fetch_all();
?>
<!DOCTYPE html>
<html>
<head>
    <title></title>
</head>
<body>
    <form action="" method="post" enctype="multipart/form-data">
        <!-- multipart/form-data: ma hoa file thanh nhi phan -->
        <input type="file" name="fileToUpload" id="fileToUpload">
        <input type="submit" name="submit" value="Upload">
    </form>
    <form action="display.php" method="get" enctype="multipart/form-data">
        <button name="view">My Photos</button>
    </form>
</body>
</html>