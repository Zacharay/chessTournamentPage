<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles/globals.css">
    <link rel="stylesheet" href="../styles/adminPanel.css">
    <title>Admin Panel</title>
    <style>
    body{
        height:100vh;
        background-color:#111;
        display:flex;
        justify-content:center;
        align-items:center;
    }
    </style>
</head>
<body>
    <?php
        $lines = file('config.txt',FILE_IGNORE_NEW_LINES);
        $config = array();
        foreach($lines as $line)
        {

            if(strpos($line,'//')===0 || trim($line) == ''){
                continue;
            }
            array_push($config,$line);
        }
        
        if($config[0]==0)
        {
            header('Location: index.php');
        }
    ?>
    <form method="POST" action="" class="admin__form">
        <label>Login<input type="text" name='login'/></label>
        <label>Hasło<input type="password" name='password'/></label>
        <button>Zaloguj</button>
    </form>
    <?php
        if(isset($_POST['login']))
        {
            $login=$_POST['login'];
            $password=$_POST['password'];
            if($config[1]!=$login || $config[2]!=$password)
            {
                header('Location: admin.php');
            }
            else if($config[1]==$login || $config[2]==$password)
            {
                session_start();
                $_SESSION['login'] = $login;
                header('Location: adminPanel.php');
            }
        }
    ?>
</body>
</html>