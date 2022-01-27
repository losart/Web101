<?php

if(isset($_POST["id"]) && !empty($_POST["id"])){

    require('src/php/conn.php');  


    $sql = "DELETE FROM user WHERE id = :id";
    
    if($stmt = $pdo->prepare($sql)){
       
        $stmt->bindParam(":id", $param_id);
        $param_id = trim($_POST["id"]);

        if($stmt->execute()){
            header("location: index.html");
            exit();
        } else{
            echo "Error, something went wrong.";
        }
    }
     
    unset($stmt);  
    unset($pdo);
} 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Delete Record</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .wrapper{
            width: 30rem;
            margin: 0 auto;
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="mt-5 mb-3">Delete User</h2>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        <div class="alert alert-primary">
                            <input type="hidden" name="id" value="<?php echo trim($_GET["id"]); ?>"/>
                            <p>Are you sure you want to delete this user?</p>
                            <p>
                                <input type="submit" value="Yes" class="btn btn-danger">
                                <a href="index.html" class="btn btn-secondary ml-2">No</a>
                            </p>
                        </div>
                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>