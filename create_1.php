<?php
require_once("connect_1.php");
session_start();
if(isset($_SESSION['username']))
{
    if(isset($_GET['username'])) {
        if ($_GET['username'] != $_SESSION['username']) {
            echo "Sorry! You are not allowed to Enter!";
            header('Location:index.php');
        }

        else{
            $username=$_SESSION['username'];
        }


    }

    else
        header('Location:index_1.php');
}
else
    header('Location:login.php');


?>

<html>
<head>
    <title>New Expense</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css?family=Russo+One&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Khula:600|VT323&display=swap" rel="stylesheet">


    <style>



        h1 {
            font-family: 'Russo One', sans-serif;

            font-size: 40px;
            color: white;
            padding-top: 0px;
        }

        h2{
            background-color: antiquewhite;
        }

        form {
            padding: auto;
            font-size: 20px;


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



<div align="center" id="h2"><h2>New Expense? Note it down.</h2></div>
<div id="body1">
    <form method="POST">
        <div align="center">Expense due to: <input type="text" name="title" required></div>
        <div align="center">Description (if any): &nbsp; &nbsp; &nbsp; &nbsp;<input type="text" name="desc" required></div>
        <div align="center">Cost in Rupees: <input type="number" name="cost" required></div>
        <br>
        <div align="center"><input id="submit" type="submit" name="submit" value="Add Expense" style="font-size: 18px; color: #000; background-color: gainsboro;  "></div>

        <?php

        $username=$_SESSION['username'];
            if(isset($_POST['submit']))
            {

              $query = "select * from $username";
                $result1 = mysqli_query($connect, $query);

                $balance = 0;
                while ($row = mysqli_fetch_array($result1)) {
                    $balance = $balance + $row['amount'];
                }

                if ($balance < $_POST['cost']) {
                    echo " Sorry! You dont have enough money in your wallet! ";
                    header("index_1.php",3);}
               else {
                   $username = $_GET['username'];
                   $desc = $_POST['desc'];
                   $title = $_POST['title'];
                   $cost = $_POST['cost'];
                   $cost = -$cost;

                   $query0 = "create table if not exists $username(id varchar(250) NOT NULL primary key, title varchar(1000), description varchar(20) , amount varchar (20000) , ty varchar(250) )";
                   $r = mysqli_query($connect, $query0);

                   $query01 = "select * from $username";
                   $res01 = mysqli_query($connect, $query01);
                   $count = mysqli_num_rows($res01);

                   $count = $count + 1;

                   $id = $username . $count;

                   $query1 = "insert into $username (id, title , description,amount, ty ) values ( '$id', '$title' , '$desc','$cost' , 'expense')";
                   $res1 = mysqli_query($connect, $query1);


                   if (!$res01 || !$res1 || !$r) {
                       echo mysqli_error($connect);
                   }

                   echo '<div align="center" style="font-size: 17px; color: black;"><br><br>Expense Registered Successfully </div>';


               }
            }
?>




    </form>
</div>
</body>
</html>
