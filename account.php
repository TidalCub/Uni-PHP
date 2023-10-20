<!DOCTYPE html>
<html lang="en">
<head>
    <?php require "views/shared/_head.php" ?>
</head>
<body>
    <?php require "views/shared/_header.php" ?>
    <?php 
        require "database/query.php";
        $result = get_user($_SESSION["user"]);
        while($row = $result->fetch_assoc()){
            echo $row["email"];
        }
    ?>
</body>

</html>
