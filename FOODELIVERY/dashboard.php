
<?php
session_start();

//ktu po shikon nese esht useri granitadmin me vazhdu me lidh me databaze por nuk kam pas sukses 
if (isset($_SESSION["emri_perdoruesit"]) && $_SESSION["emri_perdoruesit"] == "granitadmin") {
    header("Location: dashboard.php");
    exit();
}

//ktu e lidha edhe niher me database se me include("lidhja.php") nuk e terheke tdhanat
$host = "localhost";
$perdoruesit = "root";
$password = "";
$vt = "userat";

$lidhja = mysqli_connect($host, $perdoruesit, $password, $vt);
mysqli_set_charset($lidhja, "UTF8");

if (!$lidhja) {
    die("Connection failed: " . mysqli_connect_error());
}


$query = "SELECT * FROM perdoruesit";
$result = mysqli_query($lidhja, $query);

if (!$result) {
    die("Error in SQL query: " . mysqli_error($lidhja));
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User List</title>
</head>
<body>

<h2>User List</h2>

<?php
if (mysqli_num_rows($result) > 0) {
    echo '<table border="1">';
    echo '<tr><th>ID</th><th>Username</th><th>Email</th><th>Address</th><th>Login Time</th></tr>';

    while ($user = mysqli_fetch_assoc($result)) {
        echo '<tr>';
        echo '<td>' . $user['id'] . '</td>';
        echo '<td>' . $user['username'] . '</td>';
        echo '<td>' . $user['email'] . '</td>';
        echo '<td>' . $user['adresa'] . '</td>';
        echo '<td>' . $user['login_time'] . '</td>';
        echo '</tr>';
    }

    echo '</table>';
} else {
    echo "No users found";
}

mysqli_close($lidhja);
?>

</body>
</html>
