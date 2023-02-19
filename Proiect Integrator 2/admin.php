<!DOCTYPE html>
<?php
session_start();

$pid = $_SESSION['id'];

?>
<html>

<head>
    <title></title>
    <link href='https://fonts.googleapis.com/css?family=Lobster' rel='stylesheet'>
    <link rel="stylesheet" href="./css/home.css" />
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>

<body>
        <nav class="navbar  navbar-expand-lg navbar-light bg-light">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-center" id="navbarNavAltMarkup">
                <div class="navbar-nav">
                <a class="nav-item nav-link" href="index.html">Log out</a>
                </div>
            </div>
    </nav>
        

   


    <div class="panel-info" style="max-width:50%; margin-left:20%;">
    <form  method="POST">
        <div class="form-group">
        <label>Ziua:</label>
        <input class="form-control" type="date" name="datafiltru"/> 
        </div>



        <div class="form-group">
        <label>Traseu:</label>
        <select class="form-control" name="traseufiltru">
            <option value="Sinaia - Cabana Padina">Sinaia - Cabana Padina</option>
            <option value="Busteni - Cascada Urlatoare">Busteni - Cascada Urlatoare</option>
            <option value="Poiana Tapului - Rasnov">Poiana Tapului - Rasnov</option>
        </select>
        </div>

    <input type="submit" class="btn btn-primary" value="Filtreaza" name="filtruBtn"/>
    </form>
    <br><br>

    <?php
    if (isset($_POST['filtruBtn'])) {
        $a = 1;

        if (!empty($_POST['datafiltru']) && !empty($_POST['traseufiltru']))
            {
                $a = 0;
                $data = $_POST['datafiltru'];
                $traseu = $_POST['traseufiltru'];
            }

        if($a==1){
            echo '<script type="text/javascript">
            window.onload = function () {
            alert("Completati cel putin 1 camp pentru filtrare!");
            }</script>';
        }else{
            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "bddrumetii";
        
            $conn = mysqli_connect($servername, $username, $password, $dbname);
        
            if (!$conn) {
                die("Eroare la conectare: " . mysqli_connect_error());
            }
    
            $sql = "Select C.ID,C.NumeTraseu, C.NumarPersoane, C.DataRezervare, C.Ora,C.Telefon, U.Username from comenzi C
            inner join utilizatori U
            on U.ID=C.ID_user 
            Where C.NumeTraseu like '$traseu' and C.DataRezervare like '$data'";

            $result = $conn->query($sql);

            


            if ($result->num_rows > 0) {

                if($traseu == "Sinaia - Cabana Padina"){
                    echo '<img src="https://www.biciclop.eu/wp/wp-content/uploads/Retezat.jpg" width="400px" height="400px" style="margin-left:20%;">';
                }else if($traseu == "Busteni - Cascada Urlatoare"){
                    echo '<img src="https://static4.libertatea.ro/wp-content/uploads/2020/05/trasee-montane-usoare-de-facut-in-romania.jpg" width="400px" height="400px" style="margin-left:20%;">';
                }else if($traseu == "Poiana Tapului - Rasnov"){
                    echo '<img src="https://blog.eximtur.ro/wp-content/uploads/cheile-nerei-beusnita-national-park-vaioaga-waterfall-in-cheile-nerei-beusnita-national-park-600x400.jpg" width="400px" height="400px" style="margin-left:20%;">';

                }

                echo '<table class="table">
                <thead>
                    <tr>
                    <th scope="col">#</th>
                    <th scope="col">Traseul ales</th>
                    <th scope="col">Data rezervare</th>
                    <th scope="col">Numarul de persoane</th>
                    <th scope="col">Ora rezervarii</th>
                    <th scope="col">Telefon</th>
                    <th scope="col">Utilizatorul care a rezervat</th>
                    </tr>
                </thead>
                <tbody>';
                while($row = $result->fetch_assoc()) {
   
                    echo "<tr>";
                    echo '<th scope="row">'.$row['ID'].'</th>';
                    echo "<td>".$row["NumeTraseu"]."</td>";
                    echo "<td>".$row["NumarPersoane"]."</td>";
                    echo "<td>".$row["DataRezervare"]."</td>";
                    echo "<td>".$row["Ora"]."</td>";
                    echo "<td>".$row["Telefon"]."</td>";
                    echo "<td>".$row["Username"]."</td>";
                    echo "</tr>";

                }

                echo '</tbody>
                </table>';
            }
    
        }
    


    }

?>



    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>

    <script src="./javascript/jquery-3.6.0.min.js"></script>
    <script src="./javascript/home.js"></script>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
 
    </script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</body>

</html>