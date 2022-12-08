<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Tytuł</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel='stylesheet' type='text/css' media='screen' href='style.css'>
</head>
<body>
    <div class="wyszukaj">
        <div class="titleD">
            <h1>Biuro podróży<br />Buhcix</h1>
        </div>
        <form action="wyszukaj.php" method="post">
        <div class="dane">
            Gdzie?
        </br>   
            <input type="text" name="gdzie">

            Cena min.
        </br>   
            <input type="range" name="min" class="slider" oninput="this.nextElementSibling.value = this.value" style="margin-bottom: 5px"  max="3000" value="0">
            <output>MIN</output>
        </br>
            

            Cena max.
        </br>   
            <input type="range" name="max" class="slider" oninput="this.nextElementSibling.value = this.value" style="margin-bottom: 5px" max="3000"
            value="9999">
            <output>MAX</output>
        </br>

            <input type="submit" value="Wyszukaj" id="wys">
        </form>
        </div>
    </div>
    <div class="container">
        <div class="title">Nasze wycieczki</div>
        <div class="wycieczki">
<?php 
$min = $_POST['min'];
$max = $_POST['max'];
$gdzie = $_POST['gdzie'];
     
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "wycieczki";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
die("Connection failed: " . $conn->connect_error);
}
if ($gdzie = "") {
    $sql = "SELECT zdjecie, cel, cena from wycieczki where cena BETWEEN $min and $max;";
}
else
{
    $sql = "SELECT zdjecie, cel, cena from wycieczki where cena BETWEEN $min and $max and cel like '%$gdzie%';";
}
$result = $conn->query($sql);

if ($result->num_rows > 0) {
// output data of each row
while($row = $result->fetch_assoc()) {
    $zdjecie = $row['zdjecie'];
    $cel = $row['cel'];
    $cena = $row['cena'];
    echo "<div class=\"wycieczka\" style=\"background-image:url($zdjecie.jpg); \"><p>$cel, $cena</p></div>";
}
} else {
echo "ERORR";
}
?>
</div>
    </div>
</body>
</html>