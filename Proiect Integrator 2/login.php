﻿<!DOCTYPE html>

<html>
<head>
    <link rel="stylesheet" href="./css/login.css" />
    <title>Creaza cont</title>
</head>
<body>
    <div id="sign">
        <h2>Log In</h2>

        <?php
            if (isset($_POST['SubmitButton_log'])) {
                    if (session_id() == '') {
                        //session has not started
                        session_start();
                    }
            
                $a = 0;
                
                if (empty($_POST['user']))
                    $a = 1;
                if (empty($_POST['pass']))
                    $a = 1;
                
                $usern = $_POST['user'];
                $parolaa = $_POST['pass'];
                
                
                if ($a == 0) {
                    $servername = "localhost";
                    $username = "root";
                    $password = "";
                    $dbname = "bddrumetii";
                
                    $conn = mysqli_connect($servername, $username, $password, $dbname);
                
                    if (!$conn) {
                        die("Eroare la conectare: " . mysqli_connect_error());
                    }
                    $sql = "Select * 
                    FROM utilizatori
                    Where utilizatori.Username='$usern'";
                    $result = mysqli_query($conn, $sql);
                

                    if (mysqli_num_rows($result) == 1) {
                        $row = mysqli_fetch_assoc($result);
                
                        if ($row['Parola'] == $parolaa) {  
                                session_start();
                                $_SESSION['id'] = $row['ID'];
                                if($row['Admin']==0){
                                    header('Location:home.php?user=' . $row['ID']);
                                }else{
                                    header('Location:admin.php');
                                }
                        } else {
                            echo '
                                        <script type="text/javascript">
                                            window.onload = function () {
                                                alert("Parola gresita!");
                                            
                                            }</script>';
                                            
                        }
                    } else {
                        echo '<script type="text/javascript">
                                window.onload = function () {
                                alert("Cont inexistent, reintroduceti datele!");
                            }</script>';
                    }
                }
                
                mysqli_close($conn);
            }
        ?>
        <form method="POST" >
            <input type="text" placeholder="Nume Utilizator.." name="user" required />
            <input type="password" placeholder="Parola.." name="pass" required />
            <input type="submit" value="Log in" name="SubmitButton_log" />
            <input type="button" value="Return to 1st page" onclick="window.location.href='index.html'" />
        </form>
    </div>


</body>
</html>