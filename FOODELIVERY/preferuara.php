<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TOP PRODUKTET</title>
        <style type="text/css">
            body{
                background-image: url("delivery1.jpg");
                background-repeat: no-repeat;
                height: 100%;
                background-size: cover;
            }
             h1{
                background-color: beige;
            }
        #topushqimet
        {
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        width: 800px;
        margin:0 auto;
        }
        #topushqimet img
        {
        max-width: 900px;
        height: 500px
        ;
        }
        button
        {
        width: 100px;
        height: 60px;
        font: 15pt;
        color: black;
        font-family: 'Courier New', Courier, monospace;
        }
        </style>
</head>
<body>
    <a href="HOMEPAGE.php"><img src="hajmpimlogo.png" width="400" height="100"></a>
    <div id="topushqimet">
<header>
    <h1>TOP PRODUKTET ME TE PREFERUARA </h1>
    <img name="preferuarat" id="preferuarat" />
    </header>
    <img class="preferuarat" src="2.jpg">
    <img class="preferuarat" src="3.jpg">
    <img class="preferuarat" src="4.jpg">
    <img class="preferuarat" src="5.jpg">
    <button class="w3-button w3-display-right" onclick="plus(+1)">Ushqimi tjeter</button>
    </div>
        <script>
        var slideIndex = 1;
    shfaqe(slideIndex);

    function plus(n) {
     shfaqe(slideIndex += n);
    }
        function shfaqe(n) {
        var i;
        var x = document.getElementsByClassName("preferuarat");
        if (n > x.length) {slideIndex = 1}
        if (n < 1) {slideIndex = x.length} ;
        for (i = 0; i < x.length; i++) {
        x[i].style.display = "none";
         }
        x[slideIndex-1].style.display = "block";
        }
        </script>
</body>
</html>