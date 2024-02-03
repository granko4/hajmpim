<?php

session_start();

class RestaurantPage
{
    private $showButtons;
    private $db;
    private $restaurants;

    public function __construct()
    {
        $this->showButtons = false;

        $this->connectToDatabase();

        if (isset($_SESSION["emri_perdoruesit"]) && $_SESSION["emri_perdoruesit"] == "granitadmin") {
            //ktu kam dasht me bo nese esht useri granitadmin mu bo show buttonat per add edhe remove po kam nje error nuk 
            //kam mujt me gjet se ku 
            $this->showButtons = true;
        } else {
            header("Location: Restaurantet.php");
            exit();
        }
        $this->loadRestaurants();
    }
    private function connectToDatabase()
    {
        $hostname = "localhost";
        $restaurants = "root";
        $password = "";
        $database = "userat";
 
        $this->db = new mysqli($hostname, $restaurants, $password, $database);

        if ($this->db->connect_error) {
            die("Connection failed: " . $this->db->connect_error);
        }
    }
    private function loadRestaurants()
    {
        //ktu po e bojm load restaurantet qe jane ne databaze paraprakisht
        $query = "SELECT * FROM restaurants";
        $result = $this->db->query($query);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $this->restaurants[] = $row;
            }
        } else {
            $this->restaurants = [];
        }
    }
    private function addRestaurant($emri, $adresa, $orari)
    {
        //po e shtojm te dhenat ne tabelen restaurants me vlera qe kemi bo input nalt
        $query = "INSERT INTO restaurants ( emri, adresa, orari) VALUES ('$emri', '$adresa', '$orari')";
        $this->db->query($query);

        //prap pasi ta shtojm me shfaqim edhe niher listen e restauranteve
        $this->loadRestaurants();
    }
    private function removeRestaurant($id)
    {
        //ktu per remove vetem id e restaurantit po bazohemi pasi eshte unike 
        $query = "DELETE FROM restaurants WHERE id = '$id'";
        $this->db->query($query);

        $this->loadRestaurants();
    }
    //ket pjes mendova ma mire do te ishte nese e nalim renderin e ketyre buttonave edhe useri normal nuk mundet me bo modifikime
    public function render()
    {
        if (isset($_POST['submit']) && $this->showButtons) {
            $emri = $_POST['restaurantName'];
            $adresa = $_POST['restaurantAddress'];
            $orari = $_POST['openingHours'];

            $this->addRestaurant($emri, $adresa, $orari);
        }
        if (isset($_POST['remove']) && $this->showButtons) {
            $idToRemove = $_POST['remove'];
            $this->removeRestaurant($idToRemove);
        }

        echo '<!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <link rel="stylesheet" href="punimi.css"/>
            <title>Document</title> 
        </head>
        <body style="background-color: beige;">
            <a href="HOMEPAGE.php"><img src="hajmpimlogo.png" width="400" height="100"></a>
            <hr>
            <h1 style="background-color: chocolate;"> Lista e Restauranteve dhe fast food-ave qe bashkpunojn me ne</h1>
            <hr>
            <style>
            * {
                margin: 10px;
            }
    
            .Restaurantet {
                text-align: center;
                width: 80%; /* Adjust the width according to your preference */
                margin: auto; /* Center the div */
                font-size: 18px; /* Adjust the font size */
            }
    
            .Restaurantet table {
                border-collapse: collapse;
                width: 100%;
            }
    
            .Restaurantet th, .Restaurantet td {
                border: 1px solid #ddd;
                padding: 8px;
                text-align: left;
            }
    
            .Restaurantet th {
                background-color: #f2f2f2;
            }
    
            footer {
                position: fixed;
                bottom: 0;
                width: 100%;
                text-align: center;
                padding: 4px;
                background-color: black;
                color: white;
            }
            </style>
            <div class="Restaurantet">';

        if ($this->showButtons) {
            echo '<form method="post">';
            echo '<label for="restaurantName">Emri i restaurantit</label>';
            echo '<input type="text" id="restaurantName" name="restaurantName" required>';
            echo '<label for="restaurantAddress">Adresa e restaurantit</label>';
            echo '<input type="text" id="restaurantAddress" name="restaurantAddress" required>';
            echo '<label for="openingHours">Orari i hapjes se restaurantit</label>';
            echo '<input type="time" id="openingHours" name="openingHours" required>';
            echo '<br>';
            echo '<input type="submit" name="submit" value="Shto restaurant">';
            echo '</form>';
            echo '<br>';
        }

        $this->renderRestaurantsTable();

        echo '</div>
            <footer> <h1>HAJMPIM! </h1>
                <p style="font-size: large;">Nese deshironi te bashkpunoni me ne na kontaktoni <br>
                    <hr>
                    Numri kontaktues<br>
                    +39349658688<br>
                    E-Mail<br>
                    hajmpimrestaurantet@gmail.com
                </p>
            </footer>
        </body>
        </html>';
    }

    private function renderRestaurantsTable()
    {
        echo '<form method="post">';
        echo '<table>';
        echo '<tr><th>Restaurant Name </th><th> Restaurant Address </th><th> Opening Hours </th></tr>';

        if ($this->showButtons) {
            echo '<th></th>';
        }

        echo '</tr>';

        foreach ($this->restaurants as $restaurant) {
            echo '<tr>';
            echo '<td>' . $restaurant['emri'] . '</td>';
            echo '<td>' . $restaurant['adresa'] . '</td>';
            echo '<td>' . $restaurant['orari'] . '</td>';

            if ($this->showButtons) {
                echo '<td>';
                echo '<button type="submit" name="remove" value="' . $restaurant['id'] . '">Fshije restaurantin</button>';
                echo '</td>';
            }   
            echo '</tr>';
        }
        echo '</table>';
        echo '</form>';
    }
}
$restaurantPage = new RestaurantPage();
$restaurantPage->render();
?>