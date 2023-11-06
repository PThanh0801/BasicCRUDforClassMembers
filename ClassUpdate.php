<?php
$rowcount = $_GET['row']; 
$error = "";
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $file = 'formdata.txt';
    $rows = file($file);

    // while(empty($rows[$rowcount * 3] = 'Name : ' . $_POST['name'] . "\n") || !preg_match("/^[\p{L} ]+$/u", ($rows[$rowcount * 3] = 'Name : ' . $_POST['name'] . "\n")));
    // {
    //     $error = "Please fill in your name or fix your name properly ";
    // }
    // if (empty($_POST['name']) || empty($_POST['birthdate'])) {
    //     $error = "Please don't leave the fields all blank";
    // } else
    if(!preg_match("/^[\p{L} ]+$/u", $_POST['name'])) {
        $error = "Please update a proper name";
    } else {
        $rows[$rowcount*3+0] = 'Name : ' . $_POST['name'] . "\n";
        $rows[$rowcount*3+1] = 'BirthOfDate : ' . $_POST['birthdate'] . "\n";
        $rows[$rowcount*3+2] = 'Gender : ' . $_POST['gender'] . "\n";

        file_put_contents($file, implode("", $rows));
        
        header("Location: ClassData.php");
        exit;
    }
}

$file = 'formdata.txt';
$lines = file($file);

$name = trim(str_replace('Name :', '', $lines[$rowcount*3+0]));
$birthdate = trim(str_replace('BirthOfDate :', '', $lines[$rowcount*3+1]));
$gender = trim(str_replace('Gender :', '', $lines[$rowcount*3+2]));
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Update Data</title>
</head> 
<body>
    <div class="container">
        <h1>UPDATE DATA</h1>
        <form method="POST" action="">
            <div class="form-g">
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" value="<?php echo $name; ?>" required>
            </div>
            <div class="form-g">
                <label for="birthdate">BirthOfDate:</label>
                <input type="date" id="birthdate" name="birthdate" value="<?php echo $birthdate; ?>" required>
            </div>
            <div class="form-g">
                <label for="gender">Gender:</label>
                    <input type="radio" name="gender" value="male" <?php echo ($gender === 'male' ? 'checked' : ''); ?>>Male
                    <input type="radio" name="gender" value="female" <?php echo ($gender === 'female' ? 'checked' : ''); ?>>Female
                    <input type="radio" name="gender" value="other"<?php echo ($gender === 'other' ? 'checked' : ''); ?>>Other
            </div>
            <button class="button" type="submit" value ="submit">
                Update
            </button>
            <p class="error">
                <span>
                    <?php echo $error; ?>
                </span>
            </p>
        </form>
    </div>
</body>
</html>