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

$rowdelete = $_GET['row'];

while (isset($data['Name'][$rowdelete])) {
    unset($data['Name'][$rowdelete]);
    unset($data['BirthOfDate'][$rowdelete]);
    unset($data['Gender'][$rowdelete]);

    $write = fopen($file, 'w');
    foreach ($data['Name'] as $key => $name) {
        $rowData = "Name : " . $name . "\n";
        $rowData .= "BirthOfDate : " . $data['BirthOfDate'][$key] . "\n";
        $rowData .= "Gender : " . $data['Gender'][$key] . "\n";
        fwrite($write, $rowData);
        
    }
    fclose($write);
    header("Location: ClassData.php");
}
?>