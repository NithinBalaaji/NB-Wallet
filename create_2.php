<?php
require_once("connect_1.php");
session_start();
if(isset($_SESSION['username']))
{
    if(isset($_GET['username'])){
        if($_GET['username']!=$_SESSION['username'])
        { echo "Sorry! You are not allowed to Enter!"; header('Location:index.php'); }
        else
        {
            $username=$_SESSION['username'];

        }
    }
    else
        header('Location:index.php');
}
else
    header('Location:login.php');


?>

<html>
<head>
    <title>New Income</title>
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


<div align="center" id="h2"><h2>New Income? Congrats boi.</h2></div>
<div id="body1">
    <form method="POST">
        <div align="center">Income in the form of: <input type="text" name="title" required></div>
        <div align="center">Description: &nbsp; &nbsp; &nbsp; &nbsp;<input type="text" name="desc" required></div>
        <div align="center">Income in Rupees: <input type="number" name="income" required></div>
        <br>
        <div align="center"><input id="submit" type="submit" name="submit" value="Add Income" style="font-size: 18px; color: #000; background-color: gainsboro;  "></div>

        <?php
        if(isset($_POST['submit']))
        {


            $username = $_GET['username'];

            $desc = $_POST['desc'];
            $title = $_POST['title'];
            $income = $_POST['income'];


            $query0 = "create table if not exists $username(id varchar(250) NOT NULL primary key, title varchar(1000), description varchar(20) , amount varchar (20000) , ty varchar(250) )";
            $r = mysqli_query($connect, $query0);

            $query01 = "select * from $username";
            $res01 = mysqli_query($connect, $query01);
            $count = mysqli_num_rows($res01);

            $count = $count + 1;

            $id = $username . $count;

            $query1 = "insert into $username (id, title , description,amount, ty ) values ( '$id', '$title' , '$desc','$income' , 'income')";
            $res1 = mysqli_query($connect, $query1);


            if (!$res01 || !$res1 || !$r) {
                echo mysqli_error($connect);
            }

            echo '<div align="center" style="font-size: 17px; color: black;"><br><br>Income Registered Successfully </div>';

        }
        ?>

    </form>
</div>
</body>
</html>
