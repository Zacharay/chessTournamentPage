<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles/globals.css">
    <link rel="stylesheet" href="../styles/adminPanel.css">

    <title>Document</title>
</head>
<body>
    <?php

    session_start();
    if(!isset($_SESSION['login']))
    {
        header('Location: admin.php');
    }

    $tournaments = scandir('../turnieje');
    
    ?>
    <h1 class="heading__primary">Turnieje</h1>
    <div class="container admin__tournament__container">
        <?php 
        foreach($tournaments as $tournamentNr)
        {
            if($tournamentNr =='.' || $tournamentNr =='..')continue;

            $path = "../turnieje/$tournamentNr/main.txt";
            $tournamentInfo = file($path,FILE_IGNORE_NEW_LINES);

            echo "        
            <a class='admin__tournament' href='adminTournament.php?tournamentID=$tournamentNr'>
                $tournamentNr. $tournamentInfo[1]
            </a>";
        }
        ?>
        <a class="admin__tournament" href="createTournamentView.php">
            Utwórz nowy turniej 
            <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 448 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M256 80c0-17.7-14.3-32-32-32s-32 14.3-32 32V224H48c-17.7 0-32 14.3-32 32s14.3 32 32 32H192V432c0 17.7 14.3 32 32 32s32-14.3 32-32V288H400c17.7 0 32-14.3 32-32s-14.3-32-32-32H256V80z"/></svg>
        </a>
    </div>
</body>
</html>