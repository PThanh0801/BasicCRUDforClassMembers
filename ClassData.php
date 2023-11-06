<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="data.css">
    <title>Show Data</title>
</head> 
<body>
    <?php
    $file = 'formdata.txt';
    $read = fopen($file, 'r');
    $data = array();
    while (($line = fgets($read)) !== false) {
        $line = trim($line);
        if (!empty($line)) {
            list($field, $value) = explode(' : ', $line);
            $data[$field][] = $value;
        }
    }
    fclose($read);
    ?>
    <div class="containter">
        <table>
            <thead>
            <tr>
                <th>Name</th>
                <th>BirthOfDate</th>
                <th>Gender</th>
                <th>Update</th>
                <th>Delete</th>
            </tr>
            </thead>
            <tbody>
                <?php 
                foreach ($data['Name'] as $key => $name) {
                    echo '<tr>';
                    echo '<td>' . $name . '</td>';
                    echo '<td>' . $data['BirthOfDate'][$key] . '</td>';
                    echo '<td>' . $data['Gender'][$key] . '</td>';
                    echo '<td><a href="ClassUpdate.php?row=' . $key . '">Update</a></td>';
                    echo '<td><a href="ClassDelete.php?row=' . $key . '" onclick="return confirm(\'Are you sure you want to delete this row?\')">Delete</a></td>';
                    echo '</tr>';
                }
                ?>
            </tbody>
        </table>
        <div class="buttons">
            <form method="GET" action="ClassForm.php">
                <button class="btn-hover color" type="submit">Return to input form</button>
            </form>
        </div>
    </div>
</body>
</html>