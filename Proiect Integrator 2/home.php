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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <style>

html,body{
            min-height: 100vh;
            min-width: 100vw;
        }
        .parent{
            height: 100vh;
        }
        .parent>.row{
            display: flex;
            align-items: center;
            height: 100%;
        }
        .col img{
            height:100px;
            width: 100%;
            cursor: pointer;
            transition: transform 1s;
            object-fit: cover;
        }
        .col label{
            overflow: hidden;
            position: relative;
        }
        .imgbgchk:checked + label>.tick_container{
            opacity: 1;
        }
/*         aNIMATION */
        .imgbgchk:checked + label>img{
            transform: scale(1.25);
            opacity: 0.3;
        }
        .tick_container {
            transition: .5s ease;
            opacity: 0;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            -ms-transform: translate(-50%, -50%);
            cursor: pointer;
            text-align: center;
        }
        .tick {
            background-color: #4CAF50;
            color: white;
            font-size: 16px;
            padding: 6px 12px;
            height: 40px;
            width: 40px;
            border-radius: 100%;
        }
</style>
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
        

<?php
 if (isset($_POST['create'])) {
    $a = 0;
                
    if (empty($_POST['imgbackground']))
        $a = 1;
    if (empty($_POST['date']))
        $a = 1;
    if (empty($_POST['time']))
        $a = 1;
    if (empty($_POST['number']))
        $a = 1;
    if (empty($_POST['tlf']))
        $a = 1;

    if($a==1){
        echo '<script type="text/javascript">
        window.onload = function () {
        alert("Completati toate campurile pentru a putea face o rezervare!");
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

        $traseu=$_POST['imgbackground'];
        $data=$_POST['date'];
        $ora=$_POST['time'];
        $nrPers=$_POST['number'];
        $telefon=$_POST['tlf'];


        $sql = "INSERT INTO comenzi(NumeTraseu,NumarPersoane,DataRezervare,Ora,Telefon,ID_user) 
            VALUES ('$traseu',$nrPers,'$data','$ora','$telefon',$pid)";
            
        if(mysqli_query($conn,$sql))
        echo '
        <script type="text/javascript">
            window.onload = function () {
                alert("Rezervare confirmata!");
            }</script>';
        else
        echo '
        <script type="text/javascript">
            window.onload = function () {
                alert("S-a produs o eroare, va rugam reincercati mai tarziu!");
            }</script>';

    }




 }
?>


    <div class="container" style="margin-top:70px;" id="adaugareP">
            <h2 style="text-align:center;">Rezervati un traseu cu ghid:</h2><br>
            <form method="POST">
                <div class="row">
                    <label>Selectati traseul:</label>
                <div class='col text-center'>
                    <input type="radio" name="imgbackground" id="img1" class="d-none imgbgchk" value="Sinaia - Cabana Padina">
                    <label for="img1">
                        <img src="https://www.biciclop.eu/wp/wp-content/uploads/Retezat.jpg" alt="Image 1" style="width:100%; height:100%;">
                        <div class="tick_container">
                        <div class="tick"><i class="fa fa-check"></i></div>
                       
                        </div>
                        </label>
                        <h5>Sinaia - Cabana Padina</h5>
                    </div>
                    <div class='col text-center'>
                    <input type="radio" name="imgbackground" id="img2" class="d-none imgbgchk" value="Busteni - Cascada Urlatoare">
                    <label for="img2">
                        <img src="https://static4.libertatea.ro/wp-content/uploads/2020/05/trasee-montane-usoare-de-facut-in-romania.jpg" alt="Image 2" style="width:100%; height:100%;">
                        <div class="tick_container">
                        <div class="tick"><i class="fa fa-check"></i></div>
                        </div>
                    </label>
                    <h5>Busteni - Cascada Urlatoare</h5>
                    </div>
                    <div class='col text-center'>
                    <input type="radio" name="imgbackground" id="img3" class="d-none imgbgchk" value="Poiana Tapului - Rasnov">
                    <label for="img3">
                        <img src="https://blog.eximtur.ro/wp-content/uploads/cheile-nerei-beusnita-national-park-vaioaga-waterfall-in-cheile-nerei-beusnita-national-park-600x400.jpg" alt="Image 3" style="width:100%; height:100%;">
                        <div class="tick_container">
                        <div class="tick"><i class="fa fa-check"></i></div>
                        </div>
                    </label>
                    <h5>Poiana Tapului - Rasnov</h5>
                    </div>
                </div>
                <div class="form-group">
                    <label for="name">Data prezenta:</label>
                    <input class="form-control" id="date" name="date" placeholder="MM/DD/YYY" type="date"/>
                </div>
                <div class="form-group">
                    <label for="name">Ora prezenta:</label>
                    <input class="form-control" id="date" name="time" placeholder="time" type="time"/>
                </div>
                <div class="form-group">
                    <label for="name">Numar persoane:</label>
                    <input class="form-control" id="number" name="number" placeholder="Numarul de persoane" type="number"/>
                </div>    
                <div class="form-group">
                    <label for="name">Numar de telefon:</label>
                    <input class="form-control" id="tlf" name="tlf" placeholder="Numarul de telefon pentru confirmare"/>
                </div> 
            </br>
<div >
<button type="submit" class="btn btn-primary" name="create" style="margin-left:40%">Rezerva un tur</button>

    </div>
            </form>
    </div>


    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>

    <script src="./javascript/jquery-3.6.0.min.js"></script>
    <script src="./javascript/home.js"></script>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
 
    </script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</body>

</html>