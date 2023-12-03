<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/globals.css">
    <link rel="stylesheet" href="styles/tournament.css">
    <link rel="stylesheet" href="styles/nav.css">
    <link rel="stylesheet" href="styles/queries.css">
    <title>Budowlanka Rivals - Szachy</title>
</head>
<body>
    <?php 
    require_once "nav.php";
    ?>
    <?php
        $tournamentID = $_GET['tournamentID'];
        
        $tournamentPath = "turnieje/$tournamentID";
        if(!$tournamentID || !file_exists($tournamentPath."/main.txt")){
            header("Location: index.php");
        }
        $filename = "$tournamentPath/statystyki.txt";
        $players = [];

        if (file_exists($filename)) {
            $file = fopen($filename, "r");

            if ($file) {
                $skipFirstLine = false;

                while (($line = fgets($file)) !== false) {
                    if ($skipFirstLine) {
                        $skipFirstLine = false;
                        continue;
                    }

                    $data = explode(";", $line);

                    $players[] = [
                        'miejsce' => $data[0],
                        'imieNazwisko' => $data[1],
                        'klasa' => $data[2],
                        'wygrane' => $data[3],
                        'przegrane' => $data[4],
                        'remisy' => $data[5],
                    ];
                }

                fclose($file);
            } else {
                echo "Nie udało się otworzyć pliku $file";
            }
        }

        usort($players, function($a, $b) {
            $miejsceA = (int)$a['miejsce'];
            $miejsceB = (int)$b['miejsce'];
        
            if ($miejsceA < $miejsceB) {
                return -1;
            } elseif ($miejsceA > $miejsceB) {
                return 1;
            } else {
                return 0;
            }
        });
        $fileContent;
        $rounds = [];
        $roundData = [];
        if(file_exists("$tournamentPath/partie.txt"))
        {
            $fileContent = file("$tournamentPath/partie.txt", FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
            foreach ($fileContent as $line) {
                    
                if (strpos($line, "//Runda") === 0) {                             
                    if (isset($roundData)) {
                        
                        $rounds[] = $roundData;
                    }
                    $roundData = [];
                } 
                else {
                    $parts = explode(';', $line);               
                    if (count($parts) === 4) {                           
                        $roundData[] = [
                            'player1' => $parts[0],
                            'player2' => $parts[1],
                            'result' => $parts[2],
                            'link' => $parts[3]
                        ];
                    }
                }   
                
            }
            if (isset($roundData)) {
                        
                $rounds[] = $roundData;
            }
            $roundData = [];
        }
        
                
                
        
        
    ?>
    <nav class="tournament__navigation">
            <div class="tournament__navigation__tab tournament__tab--active">Opis</div>
            <div class="tournament__navigation__tab">Zawodnicy</div>
            <div class="tournament__navigation__tab">Wyniki</div>
            <div class="tournament__navigation__tab">Partie</div>
            <div class="tournament__navigation__tab">Galeria</div>
    </nav>
    <div class="container">

        <div class="tournament__tab tournament__main ">
            <?php
            $mainFileLines = file("$tournamentPath/main.txt");
            
            $mainInfo = [];
            foreach($mainFileLines as $line)
            {
                if(strpos($line,'//')===0)
                {
                    continue;
                }
                array_push($mainInfo,$line);
            }
            if(file_exists("$tournamentPath/img/main.jpg"))
            {
                echo '<img src="'.$tournamentPath.'/img/main.jpg"/>';
            }
            ?>
             
            <p class="tournament__date"><?=$mainInfo[1]?></p>
            <h3 class="tournament__header"><?=$mainInfo[0]?></h3>
            <p class="tournament__description">
                <?=$mainInfo[3]?>
            </p>
        </div>
        <div class="tournament__tab tournament__players hidden">
            <h3 class="tournament__tab__title">Zawodnicy</h3>
            <?php
            if($players){
                echo '<div class="players__container">';
                foreach($players as $player)
                {
                    echo '
                    <div class="player__card">
                        <img src="'.$tournamentPath.'/img/zawodnicy/zawodnik_'.$player['miejsce'].'.jpg"/>
                        <h3 class="player__info">'.$player['imieNazwisko'].' '.$player['klasa'].'</h3>
                    </div>'; 
                }
                echo "</div>";
            }
            else{
                echo "<h4> Nie dodano żadnych zawodników</h4>";
            }
                
            ?>
            
        </div>
        <div class="tournament__tab hidden">
            <h3 class="tournament__tab__title">Zwycięzcy</h3>
            <?php
            if(!$players)
            {
                echo "<h4>Organizatorzy jeszcze nie opublikowali wyników</h4>";
            }
            else{
                echo "
                <div class='tournament__winners__container'>
                    <div class='winners__block__container'>
                        <svg xmlns='http://www.w3.org/2000/svg' height='1em' viewBox='0 0 576 512'><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d='M400 0H176c-26.5 0-48.1 21.8-47.1 48.2c.2 5.3 .4 10.6 .7 15.8H24C10.7 64 0 74.7 0 88c0 92.6 33.5 157 78.5 200.7c44.3 43.1 98.3 64.8 138.1 75.8c23.4 6.5 39.4 26 39.4 45.6c0 20.9-17 37.9-37.9 37.9H192c-17.7 0-32 14.3-32 32s14.3 32 32 32H384c17.7 0 32-14.3 32-32s-14.3-32-32-32H357.9C337 448 320 431 320 410.1c0-19.6 15.9-39.2 39.4-45.6c39.9-11 93.9-32.7 138.2-75.8C542.5 245 576 180.6 576 88c0-13.3-10.7-24-24-24H446.4c.3-5.2 .5-10.4 .7-15.8C448.1 21.8 426.5 0 400 0zM48.9 112h84.4c9.1 90.1 29.2 150.3 51.9 190.6c-24.9-11-50.8-26.5-73.2-48.3c-32-31.1-58-76-63-142.3zM464.1 254.3c-22.4 21.8-48.3 37.3-73.2 48.3c22.7-40.3 42.8-100.5 51.9-190.6h84.4c-5.1 66.3-31.1 111.2-63 142.3z'/></svg>
                        <div class='winners__block'>
                            <h4>".$players[1]['imieNazwisko']." ".$players[1]['klasa']."</h4>
                        </div>
                    </div>
                    <div class='winners__block__container'>
                        <svg xmlns='http://www.w3.org/2000/svg' height='1em' viewBox='0 0 576 512'><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d='M400 0H176c-26.5 0-48.1 21.8-47.1 48.2c.2 5.3 .4 10.6 .7 15.8H24C10.7 64 0 74.7 0 88c0 92.6 33.5 157 78.5 200.7c44.3 43.1 98.3 64.8 138.1 75.8c23.4 6.5 39.4 26 39.4 45.6c0 20.9-17 37.9-37.9 37.9H192c-17.7 0-32 14.3-32 32s14.3 32 32 32H384c17.7 0 32-14.3 32-32s-14.3-32-32-32H357.9C337 448 320 431 320 410.1c0-19.6 15.9-39.2 39.4-45.6c39.9-11 93.9-32.7 138.2-75.8C542.5 245 576 180.6 576 88c0-13.3-10.7-24-24-24H446.4c.3-5.2 .5-10.4 .7-15.8C448.1 21.8 426.5 0 400 0zM48.9 112h84.4c9.1 90.1 29.2 150.3 51.9 190.6c-24.9-11-50.8-26.5-73.2-48.3c-32-31.1-58-76-63-142.3zM464.1 254.3c-22.4 21.8-48.3 37.3-73.2 48.3c22.7-40.3 42.8-100.5 51.9-190.6h84.4c-5.1 66.3-31.1 111.2-63 142.3z'/></svg>
                        <div class='winners__block'>
                            <h4>".$players[0]['imieNazwisko']." ".$players[0]['klasa']."</h4>
                        </div>
                    </div>
                    <div class='winners__block__container'>
                        <svg xmlns='http://www.w3.org/2000/svg' height='1em' viewBox='0 0 576 512'><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d='M400 0H176c-26.5 0-48.1 21.8-47.1 48.2c.2 5.3 .4 10.6 .7 15.8H24C10.7 64 0 74.7 0 88c0 92.6 33.5 157 78.5 200.7c44.3 43.1 98.3 64.8 138.1 75.8c23.4 6.5 39.4 26 39.4 45.6c0 20.9-17 37.9-37.9 37.9H192c-17.7 0-32 14.3-32 32s14.3 32 32 32H384c17.7 0 32-14.3 32-32s-14.3-32-32-32H357.9C337 448 320 431 320 410.1c0-19.6 15.9-39.2 39.4-45.6c39.9-11 93.9-32.7 138.2-75.8C542.5 245 576 180.6 576 88c0-13.3-10.7-24-24-24H446.4c.3-5.2 .5-10.4 .7-15.8C448.1 21.8 426.5 0 400 0zM48.9 112h84.4c9.1 90.1 29.2 150.3 51.9 190.6c-24.9-11-50.8-26.5-73.2-48.3c-32-31.1-58-76-63-142.3zM464.1 254.3c-22.4 21.8-48.3 37.3-73.2 48.3c22.7-40.3 42.8-100.5 51.9-190.6h84.4c-5.1 66.3-31.1 111.2-63 142.3z'/></svg>
                        <div class='winners__block'>
                            <h4>".$players[2]['imieNazwisko']." ".$players[2]['klasa']."</h4>
                        </div>
                    </div>
                </div>";
            }
            ?>
            
            <h3 class="tournament__tab__title">Statystyki</h3>
            <table class="tournament__table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Imię i Nazwisko</th>
                        <th>Klasa</th>
                        <th>W</th>
                        <th>P</th>
                        <th>R</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                foreach ($players as $stat) {
                    echo "
                    <tr>
                        <td>{$stat['miejsce']}</td>
                        <td>{$stat['imieNazwisko']}</td>
                        <td>{$stat['klasa']}</td>
                        <td>{$stat['wygrane']}</td>
                        <td>{$stat['przegrane']}</td>
                        <td>{$stat['remisy']}</td>
                    </tr>";
                }
                ?>   
                </tbody>
            </table>
        </div>
        <div class="tournament__tab hidden">
            <h3 class="tournament__tab__title">Partie</h3>
            <?php
                if(!$rounds)
                {
                    echo "<h4>Organizatorzy nie opublikowali jeszcze żadnych zapisów partii</h4>";
                }
                for($i=1;$i<count($rounds);$i++)
                {
                    
                    $roundNumber = $i;
                    $round = $rounds[$i];
                    echo "<h4 class='round__number'>Runda $roundNumber</h4>";
                    echo "
                    <table class='tournament__table'>
                        <tbody>";
                    foreach($round as $match)
                    {
                        echo "<tr>";
                        if($match['result']==0)
                        {
                            echo "
                            <td class='match__col game__draw__col'> 
                            <div>
                                {$match['player1']}
                            </div>
                            
                            </td>
                            <td class='match__col game__draw__col'>
                                {$match['player2']} 
                            </td>
                            ";
                        }
                        else{
                            echo "
                            <td class='match__col game__winner__col'> 
                                <div>
                                <svg xmlns='http://www.w3.org/2000/svg' height='1em' viewBox='0 0 576 512'><path d='M309 106c11.4-7 19-19.7 19-34c0-22.1-17.9-40-40-40s-40 17.9-40 40c0 14.4 7.6 27 19 34L209.7 220.6c-9.1 18.2-32.7 23.4-48.6 10.7L72 160c5-6.7 8-15 8-24c0-22.1-17.9-40-40-40S0 113.9 0 136s17.9 40 40 40c.2 0 .5 0 .7 0L86.4 427.4c5.5 30.4 32 52.6 63 52.6H426.6c30.9 0 57.4-22.1 63-52.6L535.3 176c.2 0 .5 0 .7 0c22.1 0 40-17.9 40-40s-17.9-40-40-40s-40 17.9-40 40c0 9 3 17.3 8 24l-89.1 71.3c-15.9 12.7-39.5 7.5-48.6-10.7L309 106z'/></svg>
                                    {$match['player1']}
                                </div>
                                
                            </td>
                            <td class='match__col game__looser__col'>
                                {$match['player2']} 
                            </td>";
                        }

                        

                        echo"
                        <td> 
                                <a class='match__link' href='{$match['link']}' target='_blank'><svg xmlns='http://www.w3.org/2000/svg' height='1em' viewBox='0 0 448 512' class='chessboard__icon'><path d='M64 32C28.7 32 0 60.7 0 96V416c0 35.3 28.7 64 64 64H384c35.3 0 64-28.7 64-64V96c0-35.3-28.7-64-64-64H64zm64 64v64h64V96h64v64h64V96h64v64H320v64h64v64H320v64h64v64H320V352H256v64H192V352H128v64H64V352h64V288H64V224h64V160H64V96h64zm64 128h64V160H192v64zm0 64V224H128v64h64zm64 0H192v64h64V288zm0 0h64V224H256v64z'/></svg>
                                Zapis Partii </a>
                        </td>   
                        </tr>";
                    }
                    
                    echo "
                        </tbody>
                    </table>
                    ";
                }
            ?>
        </div>
        <div class="tournament__tab hidden">
            <h3 class="tournament__tab__title">Galeria</h3>
            
            <?php
                $folderPath = "$tournamentPath/img/galeria/";
                if(!file_exists($folderPath))
                {
                    echo "<h4>Nie dodano jeszcze żadnych zdjęć</h4>";
                }
                else{
                    echo '<div class="gallery__container">';
                    $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif', 'bmp'];
                    $files = [];
    
                    $dir = opendir($folderPath);
    
                    if ($dir) {
                        while (($file = readdir($dir)) !== false) {
                            $extension = pathinfo($file, PATHINFO_EXTENSION);
                            if (in_array(strtolower($extension), $allowedExtensions)) {
                                $files[] = $file;
                            }
                        }
                        closedir($dir);
    
                        usort($files, function ($a, $b) {
                            $aNum = (int)preg_replace('/\D/', '', $a);
                            $bNum = (int)preg_replace('/\D/', '', $b);
    
                            return $aNum - $bNum; 
                        });
                        foreach ($files as $file) {
                            echo "<img src='$folderPath$file' alt='$file'>";
                        }
                    }
                    echo "</div>";
                }
                
            ?>
            </div>
        </div>
    </div>
    <?php
        require_once "footer.php";
    ?>
    <script src="scripts/changeTournamentTab.js"></script>
</body>
</html>