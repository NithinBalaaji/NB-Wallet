<?php
require_once("connect_1.php");
session_start();
if(isset($_SESSION['username'])){
    $username=$_SESSION['username'];
     $query="select fullname from users where username='$username'";
    $result=mysqli_query($connect , $query);
    $row = mysqli_fetch_array($result);
    $name = $row['fullname'];
    }


else
    header('Location:login.php');

?>

<?


?>




<html>
<head>
    <title>NB Wallet</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css?family=Russo+One&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Khula:600|VT323&display=swap" rel="stylesheet">


    <style>



        h1 {
            font-family: 'Russo One', sans-serif;
            background: indigo;
            font-size: 40px;
            color: white;
            padding-top: 0px;
        }




        #form label{
            padding: auto;


        }

        #form input{
            padding: 20px;

            font-size: 25px;
        }

        nav{
            background: rebeccapurple;
            text-align: center;
            padding-top: 0px;
        }

        nav ul{
            margin: 0;
            padding:0;
            list-style: none;
        }

        nav li{
            display: inline-block;
            margin-left: 70px;

        }

        nav a{
            text-decoration: none;
            text-transform: uppercase;
            font-size: 20px;
            color: aqua;


        }

        nav a:hover{
            background-color: cornflowerblue;
        }



        body{
            background-image: url("https://cdn.24slides.com/templates/upload/templates-previews/v0fvgx02y69m27KrXEj87zkwMFNthuickY27llQ8.jpg");
            background-repeat: no-repeat;
            font-family: 'Khula', sans-serif;
        }

    </style>


</head>
<body>


<nav id="nav">
    <ul>
        <div class="name"><h1>NB Wallet</h1></div>
        <li><a href="index_1.php">Home</a></li>
        <li><?php echo '<a class="btn" href="create_1.php?username='.$username.'">New Expense</a>'; ?></li>
        <li><?php echo '<a class="btn" href="create_2.php?username='.$username.'">New Income</a>';?></li>
        <li><a href="logout.php">Logout</a></li>
    </ul>
</nav>


<div id="left" style="font-size: 25px;"><h3><?php echo "Welcome to NB Wallet: $name <br> You are Logged in. <br>  "?></h3></div>
<a style='font-size: 18px; color: indigo; '>Once you delete a transaction, click the home page to refresh.</a>
<br><br>

<?php
$query="select * from $username";
$result1=mysqli_query($connect, $query);

$balance=0;
while($row=mysqli_fetch_array($result1)){
    $balance= $balance+ $row['amount'];}

    echo"<a style='font-size: 22px; color: indigo; '>Current Balance is: $balance</a>";


?>

<h2><ol><?php

        $query="select * from $username";
        $result1=mysqli_query($connect, $query);

        echo'<a style="font-size: 20px;"><u>Past Transactions: </u></a>';
        echo"<br>";

        while($row=mysqli_fetch_array($result1)){

            echo "<a style='font-size: 15px;'><li>".$row['title']." <br> ".$row['description']."<br>  <b>".$row['amount']."</b></li></a>";
            echo  '<a1 style="font-size: 13px;"><a href="index_1.php?deleteItem='.$row['title'].'">Delete</a><br></a1>';
            echo"<br>";
        }


        if(isset($_GET['deleteItem']))
        {
            $dTitle=$_GET['deleteItem'];
            $dQuery="delete from $username where title='$dTitle'";
            $dRes=mysqli_query($connect , $dQuery);
        }


        ?>
    </ol></h2>





</body>




</html>
