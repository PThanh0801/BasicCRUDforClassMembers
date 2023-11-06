<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

</head>
<body>
<?php
$fp = fopen("save_file.txt", "r");

if (!$fp) {
    echo "File cannot be opened";
    exit;
}
                                                                                                                                                                                                                                                                                                                                                       
// a bit of styling...
echo <<<EOF
<style>
table, td, th {
  table-layout: fixed;
  margin : auto;
  width: 60%;
  border-collapse: collapse;
    border: 1px solid;
  border: 2px solid black;
  border: 1px solid;
  text-align: left;
  background : #E3E4FA;
}
</style>
EOF;

$count = 0;
$cols = 3; // the number of data items per row
echo '<table>'; // open table
echo '<tr><th>Student Name</th><th>Gender</th><th>Date of Birth</th></tr>';
echo '<tr>';
while(!feof($fp))
{
    
    if($count < $cols) {
        file_put_contents('save_file.txt', implode(PHP_EOL, file('save_file.txt', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES)));
        $info = trim(fgets($fp));
        echo "<td>$info</td>"; // render data item
        $count++;
    } else {
        $count = 0; // reset counter
        echo '</tr><tr>'; // close current row, start new row
    }
}
echo "</tr></table>";
fclose($fp);
?>
</body>
</html>
