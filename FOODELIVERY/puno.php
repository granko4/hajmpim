<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dergo PDF</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f4;
            text-align: center;
            margin: 20px;
        }

        h2 {
            color: #333;
        }

        #uploadContainer {
            max-width: 400px;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        label {
            display: block;
            margin: 15px 0;
            color: #555;
        }

        input[type="file"] {
            display: none;
        }

        .custom-file-upload {
            background-color: #4caf50;
            color: #fff;
            border: none;
            padding: 10px 15px;
            border-radius: 5px;
            cursor: pointer;
        }

        button {
            background-color: #3498db;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            
        }
    </style>
</head>
<body>
    <a href="HOMEPAGE.php"><img src="hajmpimlogo.png" class="llogo" width="400" height="200"></a>
    <div id="uploadContainer">
    <h2>Bashkpunoni me ne . </h2>

    <?php
    
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $uploadDir = 'uploads/';
        $uploadFile = $uploadDir . basename($_FILES['pdfFile']['name']);

        if (move_uploaded_file($_FILES['pdfFile']['tmp_name'], $uploadFile)) {
            
            $hostname = "localhost";
            $db_user = "root";
            $db_password = "";
            $database = "test";

            try {
                $pdo = new PDO("mysql:host=$hostname;dbname=$database", $db_user, $db_password);

                $fileName = $_FILES['pdfFile']['name'];
                $fileData = file_get_contents($uploadFile);

                $stmt = $pdo->prepare("INSERT INTO pdf_files (file_name, file_data) VALUES (:file_name, :file_data)");
                $stmt->bindParam(':file_name', $fileName);
                $stmt->bindParam(':file_data', $fileData, PDO::PARAM_LOB);

                if ($stmt->execute()) {
                    echo '<p>PDF file uploaded and saved to the database successfully.</p>';
                } else {
                    echo '<p>Error saving PDF file to the database.</p>';
                }
            } catch (PDOException $e) {
                echo '<p>Error connecting to the database: ' . $e->getMessage() . '</p>';
            }
        } else {
            echo '<p>Error uploading PDF file.</p>';
        }
    }
    ?>

    <form action="puno.php" method="post" enctype="multipart/form-data">
        <label for="textInput">Nese deshironi te beheni delivery ose <br>
        ose keni restaurant deshironi te filloni shitjen e produkteve na dergoni ne pdf file <br>
        te gjitha informacionet e nevojshme.</label>
        <label for="pdfFile">Choose a PDF file:</label>
        <label class="custom-file-upload">
        <input type="file" name="pdfFile" id="pdfFile" accept=".pdf" required>
                Browse File
         </label>
        <br>
        <button type="submit">Upload PDF</button>

    </form>
    
</body>
</html>