<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles/globals.css">
    <link rel="stylesheet" href="../styles/adminPanel.css">
    <link rel="stylesheet" href="../styles/nav.css">
    <title>Edit Tournament</title>
    <style>
    body{
        height:100vh;
        background-color:#111;
        display:flex;
        align-items:center;
    }
    textarea{
        resize:none;
    }
    </style>
</head>
<body>
    <?php
    $tournamentID = $_GET['tournamentID'];

    $tournamentPath = "../turnieje/$tournamentID";

    if(!file_exists($tournamentPath))header('Location: adminPanel.php');
    $mainLines = file("$tournamentPath/main.txt");
    $mainInfo = [];
    
    foreach($mainLines as $line)
    {
        if(strpos($line,'//')===0)
        {
            continue;
        }

        
        array_push($mainInfo,$line);
    }
    ?>
    <nav class="admin__nav">
        <div class="secondary__nav__tab admin__nav__tab secondary__nav__tab--active">Główne</div>
        <div class="secondary__nav__tab admin__nav__tab">Wyniki</div>
        <div class="secondary__nav__tab admin__nav__tab">Partie</div>
        <div class="secondary__nav__tab admin__nav__tab">Galeria</div>
    </nav>
    <div class="secondary__nav__container">
        <form method="post" class="admin__form" action="editMainInfo.php?tournamentID=<?=$tournamentID?>">
            <label>Nazwa turnieju <input type="text" name='tournament__name' value="<?=$mainInfo[0]?>" /></label>
            <label>Data turnieju <input type="date" name='tournament__date' value="<?php echo date('Y-m-d',strtotime($mainInfo[1])) ?>"/></label>
            
            <label>Opis <textarea name="tournament__description" cols="30" rows="10"><?=$mainInfo[3]?></textarea></label>
            <label class="label--checkbox"> <input type="checkbox" name="show_on_page" id="" 
            <?php
                if($mainInfo[2]==1)echo 'checked'
            ?>/>Pokaż na stronie</label>
            <button>Zapisz</button>
        </form>
    </div>
    <div class="secondary__nav__container hidden">
        <table class="admin__table">
            <thead>
                <tr>
                    <th>Miejsce</th>
                    <th>Imie Nazwisko</th>
                    <th>Klasa</th>
                    <th>Wygrane</th>
                    <th>Przegrane</th>
                    <th>Remisy</th>
                    <th>Operacje</th>
                </tr>
                
            </thead>
            <tbody>
                <tr>
                    <?php
                    if(file_exists($tournamentPath.'/statystyki.txt')){
                        $stats = file($tournamentPath.'/statystyki.txt');
                        foreach($stats as $stat)
                        {
                            $parts = explode(";",$stat);
                            echo "<tr>";
                            echo "<td>$parts[0]</td>";
                            echo "<td>$parts[1]</td>";
                            echo "<td>$parts[2]</td>";
                            echo "<td>$parts[3]</td>";
                            echo "<td>$parts[4]</td>";
                            echo "<td>$parts[5]</td>";
                            echo "
                            <td class='admin__table__operations'>
                                <div class='hidden'>Edytuj</div>
                                <div class='hidden'>Usuń</div>
                                <div>Zapisz</div>
                            </td>";
                            echo "</tr>";
                        }
                        echo "
                        <tr class='admin__table__create__row'>
                            <td><input name='miejsce' placeholder='Miejsce' type='number' /></td>
                            <td><input name='imienazwisko' placeholder='Imie i Nazwisko'type='text' /></td>
                            <td><input name='klasa' placeholder='Klasa' type='text' /></td>
                            <td><input name='wygrane' placeholder='Wygrane' type='number' /></td>
                            <td><input name='przegrane' placeholder='Przegrane' type='number' /></td>
                            <td><input name='remisy' placeholder='Remisy' type='number' /></td>
                            <td><button>Dodaj</button></td>
                        </tr>";
                    }
                    ?>
                </tr>
            </tbody>
        </table>
    </div>
    <div class="secondary__nav__container hidden">
        Partie
    </div>
    <div class="secondary__nav__container hidden">
        Zdjęcia
    </div>


    <script src="../scripts/adminChangeTournament.js"></script>
</body>
</html>