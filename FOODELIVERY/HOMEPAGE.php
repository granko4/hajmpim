<?php

class FoodItem
{
    private $imagePath;
    private $caption;
    private $price;

    public function __construct($imagePath, $caption,$price)
    {
        $this->imagePath = $imagePath;
        $this->caption = $caption;
        $this->price = $price;
    }

    public function render()
    {
        echo '<div class="item">';
        echo '<img src="' . $this->imagePath . '">';
        echo '<span class="caption">' . $this->caption . '</span>';
        echo '<span class="price">$' . $this->price . '</span>';
        echo '<button type="button" class="order-btn" data-image="' . $this->imagePath . '" data-caption="' . $this->caption . '" data-price="' . $this->price . '">Shto porosi</button>';
        echo '</div>';
    }
    public function getPrice()
    {
        return $this->price;
    }
}

class FoodItemsContainer
{
    private $foodItems;

    public function __construct()       
    {
        $this->foodItems = [
            new FoodItem('hamburger.jpg', "Hamburger",2.5),
            new FoodItem('pizza.jpg', "Pica",3),
            new FoodItem('1.jpg', "Mish te bardh",5),
            new FoodItem('2.jpg', "Oferta e drekes",6),
            new FoodItem('3.jpg', "Oferta e mengjesit",4),
            new FoodItem('3jpg.jpg', "File pule",3),
            new FoodItem('4.jpg', "Mish i bardh me sos",4),
            new FoodItem('4jpg.jpg', "Pjate me peme,perime",2),
            new FoodItem('5.jpg', "Mish ne skare",8),
            new FoodItem('5jpg.jpg', "Pide",3),
            new FoodItem('6.jpg', "Ramstek",14),
            new FoodItem('6jpg.jpg', "Lahmaxhun",3),
            new FoodItem('7.jpg', "Toma Hawk",18),
            new FoodItem('7jpg.jpg', "Adana durum",2),
            new FoodItem('8.jpg', "Biftek",13),
            new FoodItem('8jpg.jpg', "Kunefe",4),
            new FoodItem('9.jpg', "Qofte ne stick",3),
            new FoodItem('9jpg.jpg', "Tullumba",1),
            new FoodItem('10jpg.jpg', "Embelsire",1),
            new FoodItem('11.jpg', "Sallate me veze",2),
            new FoodItem('11jpg.jpg', "Llokuma",1),
            new FoodItem('12.jpg', "Supe me patate",1),
            new FoodItem('12jpg.jpg', "Qyfte tradicionale",3),
            new FoodItem('13.jpg', "Sallate",2),
            new FoodItem('13jpg.jpg', "Pite",1),
            new FoodItem('fli.jpg', "Fli",1),
            new FoodItem('pasta.jpg', "Pasta",3),
            new FoodItem('rr.jpg', "Supe",2),
            new FoodItem('trileqe.jpg', "Trileqe",1),
            new FoodItem('r.jpg', "Qyfte me sos",1),
            
        ];
    }

    public function render()
    {
        echo '<div class="ushqimet">';
        
        foreach ($this->foodItems as $foodItem) {
            $foodItem->render();
        }

        echo '</div>';
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet"  href="punimi.css"/>
    <title>HAJMPIM</title>
    <style>
        #shopping-cart {
            position: fixed;
            top: 10px;
            right: 10px;
            background-color: #f8f8f8;
            padding: 10px;
            border: 1px solid #ddd;
        }
        
        div.item{
            vertical-align: top;
            display: inline-block;
            text-align: center;
            width: 120px;
        }
        img{
            width: 100px;
            height: 200px;
            background-color: beige;
        }
        .caption{
            display: block;
        }
        footer{
            display: block;
            text-align: center;
            padding: 4px;
            background-color: black;
            color: white;
        }
        .shopping-cart {
            float: right;
            margin-right: 20px;
            text-align: left;

        }
        #shopping-cart div.item {
            width: 80px; 
        }
        #shopping-cart img {
            width: 60px; 
            height: 120px; 
        }
    body {
        margin: 0;
        padding: 0;
        font-family: Arial, sans-serif;
    }

    .header {
        background-color: #333;
        color: white;
        padding: 10px;
        text-align: center;
    }

    .logo {
        max-width: 100%;
        height: auto;
    }

    .container {
        background-color: #555;
        overflow: hidden;
    }

    .container a {
        float: left;
        display: block;
        color: white;
        text-align: center;
        padding: 14px 16px;
        text-decoration: none;
    }
    
    .ushqimet{
        padding:5%;
    }

    </style>
</head>
<body>
    <div class="hajmpim"> 
        <a href="loginform.php"><img src="login.png" width="200" height="100"></a>
        <a href="HOMEPAGE.php"><img src="hajmpimlogo.png" class="llogo" width="400" height="200"></a> 
        <a href="logout.php"><img src="logout.png" width="200" height="100"></a>
    </div>   
        </div>
    <div class="container">
        <a href="Restaurantet.php"> <div class="flexbox-item" id="Restaurantet">Restaurantet</div></a>
        <a href="Delivery.php"><div class="flexbox-item" id="Delivery">Dergesa</div></a>
        <a href="preferuara.php"><div class="flexbox-item" id="preferuara">Ushqimet te preferuara</div></a>     
        <a href="puno.php"><div class="flexbox-item" id="puno">Bashkohu me ne !</div></a>     

    </div>
    <div class="ushqimet">
        <?php
        $foodItemsContainer = new FoodItemsContainer();
        $foodItemsContainer->render();
        ?>
        <div id="shopping-cart"></div>
        <div id="total-cost">Pagesa totale: $0.00</div>
        <button id="porosite-btn">Porosite</button>
        <button id="clear-cart-btn">Fshije porosine</button>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const orderButtons = document.querySelectorAll('.order-btn');
            const shoppingCart = document.getElementById('shopping-cart');
            let totalCost = 0;

        orderButtons.forEach(function (button) {
            button.addEventListener('click', function () {
                const image = this.getAttribute('data-image');
                const caption = this.getAttribute('data-caption');
                const price = parseFloat(this.getAttribute('data-price'));

                const cartItem = document.createElement('div');
                cartItem.innerHTML = '<img src="' + image + '"> <span>' + caption + ' - $' + price + '</span>';
                shoppingCart.appendChild(cartItem);

                totalCost += price;
                document.getElementById('total-cost').innerText = 'Total Cost: $' + totalCost.toFixed(2);
            });
        });
    
        const clearCartButton = document.getElementById('clear-cart-btn');
            clearCartButton.addEventListener('click', function () {
                
                shoppingCart.innerHTML = '';
                document.getElementById('total-cost').innerText = 'Total Cost: $0.00';
        });
    });

    </script>
    
    <!-- edhe ktu njejt eshte kodi i vjeter prej fazes pare qe e kam shenu ne html  -->

    <!-- <div class="ushqimet">
        <div class="item">
    <img src="C:\Users\rebra\Desktop\FOODELIVERY\hamburger.jpg">
    <span class="caption">Hamburger</span>
        </div>
    <div class="item">
    <img src="C:\Users\rebra\Desktop\FOODELIVERY\pizza.jpg">
    <span class="caption">Pica</span>
        </div>
        <div class="item">
    <img src="C:\Users\rebra\Desktop\FOODELIVERY\pasta.jpg">
    <span class="caption">Pasta</span>
        </div>
        <div class="item">
    <img src="C:\Users\rebra\Desktop\FOODELIVERY\R.jpg">
    <span class="caption">Qyfte</span>
        </div>
        <div class="item">
    <img src="C:\Users\rebra\Desktop\FOODELIVERY\rr.jpg">
    <span class="caption">Supe</span>
        </div>
        <div class="item">
    <img src="C:\Users\rebra\Desktop\FOODELIVERY\oip.jpg">
    <span class="caption">Dyner</span>
        </div>
        <div class="item">
    <img src="C:\Users\rebra\Desktop\FOODELIVERY\3jpg.jpg">
    <span class="caption">Peshk Somun</span>
        </div>
        <div class="item">
    <img src="C:\Users\rebra\Desktop\FOODELIVERY\4jpg.jpg">
    <span class="caption">Kombinim fruta te terura</span>
        </div>
        <div class="item">
    <img src="C:\Users\rebra\Desktop\FOODELIVERY\5jpg.jpg">
    <span class="caption">Pide</span>
        </div>
        <div class="item">
    <img src="C:\Users\rebra\Desktop\FOODELIVERY\6jpg.jpg">
    <span class="caption">Lahmaxhun</span>
        </div>
        <div class="item">
    <img src="C:\Users\rebra\Desktop\FOODELIVERY\7jpg.jpg">
    <span class="caption">Adana kebap</span>
        </div>
        <div class="item">
    <img src="C:\Users\rebra\Desktop\FOODELIVERY\8jpg.jpg">
    <span class="caption">Kunefe</span>
        </div>
        <div class="item">
    <img src="C:\Users\rebra\Desktop\FOODELIVERY\9jpg.jpg">
    <span class="caption">Tullumba</span>
        </div>
        <div class="item">
    <img src="C:\Users\rebra\Desktop\FOODELIVERY\10jpg.jpg">
    <span class="caption">Embelsira</span>
        </div>
        <div class="item">
    <img src="C:\Users\rebra\Desktop\FOODELIVERY\11jpg.jpg">
    <span class="caption">Llokuma</span>
        </div>
        <div class="item">
    <img src="C:\Users\rebra\Desktop\FOODELIVERY\12jpg.jpg">
    <span class="caption"> Qebapa tradicionale</span>
        </div>
        <div class="item">
    <img src="C:\Users\rebra\Desktop\FOODELIVERY\13jpg.jpg">
    <span class="caption">Pite me spinaq</span>
        </div>
        <div class="item">
    <img src="C:\Users\rebra\Desktop\FOODELIVERY\trileqe.jpg" >
    <span class="caption">Trileqe</span>
        </div>
        <div class="item">
    <img src="C:\Users\rebra\Desktop\FOODELIVERY\fli.jpg" >
    <span class="caption">Fli</span>
        </div>
    <div class="item">
    <img src="C:\Users\rebra\Desktop\FOODELIVERY\1.jpg" >
    <span class="caption">Kofsh pule</span>
         </div>
    <div class="item">
    <img src="C:\Users\rebra\Desktop\FOODELIVERY\2.jpg" >
    <span class="caption">Mish bardh ne tave</span>
         </div>
    <div class="item">
    <img src="C:\Users\rebra\Desktop\FOODELIVERY\3.jpg" >
     <span class="caption">Mengjesi 2persona</span>
        </div>
    <div class="item">
    <img src="C:\Users\rebra\Desktop\FOODELIVERY\4.jpg" >
    <span class="caption">KFC KOFSHA</span>
         </div>
    <div class="item">
    <img src="C:\Users\rebra\Desktop\FOODELIVERY\5.jpg" >
    <span class="caption">Mish specialitet</span>
        </div>
    <div class="item">
    <img src="C:\Users\rebra\Desktop\FOODELIVERY\6.jpg" >
    <span class="caption">Bifter</span>
         </div>
    <div class="item">
    <img src="C:\Users\rebra\Desktop\FOODELIVERY\7.jpg" >
    <span class="caption">Toma Hawk</span>
        </div>
    <div class="item">
    <img src="C:\Users\rebra\Desktop\FOODELIVERY\8.jpg" >
     <span class="caption">Biftek Extre</span>
        </div>
    <div class="item">
    <img src="C:\Users\rebra\Desktop\FOODELIVERY\9.jpg" >
    <span class="caption">Aperatif</span>
        </div>
    <div class="item">
    <img src="C:\Users\rebra\Desktop\FOODELIVERY\11.jpg" >
    <span class="caption">Sallad Vegjetariane</span>
        </div>
    <div class="item">
    <img src="C:\Users\rebra\Desktop\FOODELIVERY\12.jpg" >
         <span class="caption">Gjell me patate</span>
     </div>
    <div class="item">
    <img src="C:\Users\rebra\Desktop\FOODELIVERY\13.jpg" >
         <span class="caption">Sallad me fruta deti</span>
     </div>
    </div>
    <hr> -->
    <footer> <H1>HAJMPIM! </H1>
        <P style="font-size: large;">Ne pjesen e siperme mund ta gjeni ushqimet e preferuara<br>
        Numri kontaktues:+39349658688</P>

    </footer>
</body>
</html>