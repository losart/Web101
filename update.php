<?php
require('src/php/conn.php');
 

$idnumber = $firstname = $lastname = $gender = $bday = $program = $yearlevel = "";
$idnumber_err = $firstname_err = $lastname_err = $gender_err = $bday_err = $program_err = $yearlevel_err = "";
 
if(isset($_POST["id"]) && !empty($_POST["id"])){
    $id = $_POST["id"];
    

    $input_idnumber = ($_POST["idnumber"]);
    if(empty($input_idnumber)){
        $idnumber_err = "Please enter a idnumber.";
     }else{
        $idnumber = $input_idnumber;
    }
    

    $input_firstname = ($_POST["firstname"]);
    if(empty($input_firstname)){
        $firstname_err = "Please enter firstname.";     
    } else{
        $firstname = $input_firstname;
    }
    

    $input_lastname = ($_POST["lastname"]);
    if(empty($input_lastname)){
        $lastname_err = "Please enter the lastname.";     
    } else{
        $lastname = $input_lastname;
    }

    $input_gender = ($_POST["gender"]);{
        $gender = $input_gender;
    }

    $input_bday = ($_POST["bday"]);
    if(empty($input_bday)){
        $bday_err = "Please enter your birthday.";     
    }  else{
        $bday = $input_bday;
    }
    
    $input_program = ($_POST["program"]);
    if(empty($input_program)){
        $program_err = "Please enter your program.";     
    }  else{
        $program = $input_program;
    }

    $input_yearlevel = ($_POST["yearlevel"]);
    if(empty($input_yearlevel)){
        $yearlevel_err = "Please enter your yearlevel.";     
    }  else{
        $yearlevel = $input_yearlevel;
    }


    if(empty($idnumber_err) && empty($firstname_err) && empty($lastname_err) && empty($gender_err) && empty($bday_err) && empty($program_err) && empty($yearlevel_err)){

        $sql = "UPDATE user SET idnumber=:idnumber, firstname=:firstname, lastname=:lastname, gender=:gender, bday=:bday, program=:program, yearlevel=:yearlevel WHERE id=:id";
 
        if($stmt = $pdo->prepare($sql)){
            $stmt->bindParam(":idnumber", $param_idnumber);
            $stmt->bindParam(":firstname", $param_firstname);
            $stmt->bindParam(":lastname", $param_lastname);
            $stmt->bindParam(":gender", $param_gender);
            $stmt->bindParam(":bday", $param_bday);
            $stmt->bindParam(":program", $param_program);
            $stmt->bindParam(":yearlevel", $param_yearlevel);
            $stmt->bindParam(":id", $param_id);
  
            $param_idnumber = $idnumber;
            $param_firstname = $firstname;
            $param_lastname = $lastname;
            $param_gender = $gender;
            $param_bday = $bday;
            $param_program = $program;
            $param_yearlevel = $yearlevel;
            $param_id = $id;
            
            if($stmt->execute()){
                header("location: index.html");
                exit();
            } else{
                echo "Error, something went wrong.";
            }
        }
         
        unset($stmt);
    }
    
    unset($pdo);
} else{
    if(isset($_GET["id"]) && !empty($_GET["id"])){
        $id =  ($_GET["id"]);
        $sql = "SELECT * FROM user WHERE id = :id";
        if($stmt = $pdo->prepare($sql)){

            $stmt->bindParam(":id", $param_id);
            $param_id = $id;
            if($stmt->execute()){
                if($stmt->rowCount() == 1){
                    $row = $stmt->fetch(PDO::FETCH_ASSOC);
                    $idnumber = $row["idnumber"];
                    $firstname = $row["firstname"];
                    $lastname = $row["lastname"];
                    $gender = $row["gender"];
                    $bday = $row["bday"];
                    $program = $row["program"];
                    $yearlevel = $row["yearlevel"];

                } else{
                    echo "URL doesn't contain valid id.";
                    exit();
                }
                
            } else{
                echo "Error, something went wrong.";
            }
        }
        
        unset($stmt);
        unset($pdo);
    }  else{
        echo "URL doesn't contain id parameter.";
        exit();
    }
}
?>
 
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Update Record</title>
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
                    <h2 class="mt-5">Update User</h2>
                    <form action="<?php echo htmlspecialchars(basename($_SERVER['REQUEST_URI'])); ?>" method="post">

                        <div class="form-group">
                            <label>ID Number</label>
                            <input type="text" name="idnumber" class="form-control <?php echo (!empty($idnumber_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $idnumber; ?>">
                            <span class="invalid-feedback"><?php echo $idnumber_err;?></span>
                        </div>

                        <div class="form-group">
                            <label>Firstname</label>
                            <textarea name="firstname" class="form-control <?php echo (!empty($firstname_err)) ? 'is-invalid' : ''; ?>"><?php echo $firstname; ?></textarea>
                            <span class="invalid-feedback"><?php echo $firstname_err;?></span>
                        </div>

                        <div class="form-group">
                            <label>Lastname</label>
                            <input type="text" name="lastname" class="form-control <?php echo (!empty($lastname_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $lastname; ?>">
                            <span class="invalid-feedback"><?php echo $lastname_err;?></span>
                        </div>

                        <div class="form-group">
                            <label>Gender</label>
                            <input type="text" name="gender" class="form-control <?php echo (!empty($gender_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $gender; ?>">
                            <span class="invalid-feedback"><?php echo $gender_err;?></span>
                        </div>

                        <div class="form-group">
                            <label>Birthday</label>
                            <input type="text" name="bday" class="form-control <?php echo (!empty($bday_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $bday; ?>">
                            <span class="invalid-feedback"><?php echo $bday_err;?></span>
                        </div>

                        <div class="form-group">
                            <label>Program</label>
                            <input type="text" name="program" class="form-control <?php echo (!empty($program_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $program; ?>">
                            <span class="invalid-feedback"><?php echo $program_err;?></span>
                        </div>

                        <div class="form-group">
                            <label>Year level</label>
                            <input type="text" name="yearlevel" class="form-control <?php echo (!empty($yearlevel_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $yearlevel; ?>">
                            <span class="invalid-feedback"><?php echo $yearlevel_err;?></span>
                        </div>

                        <input type="hidden" name="id" value="<?php echo $id; ?>"/>
                        <input type="submit" class="btn btn-primary" value="Submit">
                        <a href="index.html" class="btn btn-secondary">Cancel</a>
                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>