<!DOCTYPE html>
<html>
<head>

</head>
<body>

<?php
$q = intval($_GET['q']);

$con = mysqli_connect('localhost','root','','dbecnewdeal');
if (!$con) {
    die('Could not connect: ' . mysqli_error($con));
}

$sql="SELECT * FROM tbl_subcategory WHERE Category_ID = '".$q."'";
$result = mysqli_query($con,$sql);

while($row = mysqli_fetch_array($result)) {
    
    echo "<input type='radio' name='radio_sc' value='{$row['SCat_ID']}' tabindex='5'>" . $row['SubCategory_Name'] . "</a><br>";
    
}
mysqli_close($con);
?>

</body>
</html>