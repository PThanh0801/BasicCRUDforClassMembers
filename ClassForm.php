<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ClassFormInput</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php
    $name = $birthdate = $gender= "";
    $error = "";
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (empty($_POST["name"]) || empty($_POST["birthdate"]) || empty($_POST["gender"]))
        {
                $error = "Please fill in all the fields";
        }
        else{
            $name = ($_POST["name"]);
            // $birthdate ($_POST["birthdate"]);
            if (!preg_match("/^[\p{L} ]+$/u", $name))
            {
                $error = "Please enter a valid name";
            }
            // elseif (preg_match('/^(\d{2})-(\d{2})-(\d{4})$/', $birthdate))
            // {
            //     $error = "Please enter a proper date of birth";
            // }
            else{
                extract($_REQUEST);
                $file = fopen("formdata.txt","a");
                fwrite($file,"Name : ");
                fwrite($file,$name."\n");
                $birthdate = ($_POST["birthdate"]);
                $gender = ($_POST["gender"]);
                $datevalid = explode('-', $birthdate);
                $year = $datevalid[0];
                if ($year > 2023)
                {
                    $error = "Your year must be bellow 2023";
                }
                else{
                    fwrite($file,"BirthOfDate : ");
                    fwrite($file,$birthdate."\n");
                    fwrite($file,"Gender : ");
                    fwrite($file,$gender."\n");
                    fclose($file);
                    header("Location: ClassData.php");
                    exit();
                }
            }
            } 
        }
    ?>
    <div class="container">
        <form method="POST" action="<?php echo ($_SERVER["PHP_SELF"]);?>"> 
            <h1>Class Form Input</h1>
            <div class="form-g">
                <label for="name">Name</label>
                <input type="text" name="name">
            </div>
            <div class="form-g">
                <label for="birthdate">BirthDate</label>
                <input type="date" name="birthdate">
            </div>
            <div class="form-g">
                <label for="gender">Gender</label>
                <br><br>
                <input type="radio" name="gender" value="female">Female
                <input type="radio" name="gender" value="male">Male
                <input type="radio" name="gender" value="other">Other
            </div>
            <button class="button" type="submit" value ="submit">
                Submit
            </button>
            <br>
            <br>       
            <p class="error">
                <span>
                    <?php echo $error ?>
                </span>
            </p>   
        </form>
    </div>
</body>
</html>

