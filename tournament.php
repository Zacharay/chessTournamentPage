<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/globals.css">
    <link rel="stylesheet" href="styles/tournament.css">
    <title>Document</title>
</head>
<body>
    <?php 
    require_once "nav.php";
    ?>
    <?php
        $filename = "dane/Turniej2023/statystyki.txt";
        $stats = [];

        if (file_exists($filename)) {
            $file = fopen($filename, "r");

            if ($file) {
                $skipFirstLine = true;

                while (($line = fgets($file)) !== false) {
                    if ($skipFirstLine) {
                        $skipFirstLine = false;
                        continue;
                    }

                    $data = explode(";", $line);

                    $stats[] = [
                        'miejsce' => $data[1],
                        'imieNazwisko' => $data[2],
                        'klasa' => $data[3],
                        'pkt' => $data[4],
                        'wygrane' => $data[5],
                        'przegrane' => $data[6],
                        'remisy' => $data[7],
                        'mecze' => $data[8]
                    ];
                }

                fclose($file);
            } else {
                echo "Failed to open the file.";
            }
        } else {
            echo "File does not exist.";
        }

        // Sort the array by 'miejsce'
        usort($stats, function($a, $b) {
            return strcmp($a['miejsce'], $b['miejsce']);
        });
    ?>
    <nav class="tournament__navigation">
            <div class="tournament__navigation__tab tournament__tab--active">Opis</div>
            <div class="tournament__navigation__tab">Zawodnicy</div>
            <div class="tournament__navigation__tab">Wyniki</div>
            <div class="tournament__navigation__tab">Partie</div>
            <div class="tournament__navigation__tab">Galeria</div>
    </nav>
    <div class="container">

        <div class="tournament__tab tournament__main tournament__content--hidden">
            
            <img src="img/turnieje/main.jpg"/> 
            <p class="tournament__date">27-12-2023</p>
            <h3 class="tournament__header">Budowlanka Rivals 2023</h3>
            <p class="tournament__description">
                Lorem ipsum, dolor sit amet consectetur adipisicing elit. Assumenda expedita illum debitis totam possimus! Tempore voluptates amet ipsum aut qui! Ipsa libero, doloremque ab culpa voluptatum quia voluptatibus sequi nemo, aperiam earum voluptas in vitae alias maxime blanditiis asperiores voluptates! Pariatur magnam tempora similique dolores excepturi quam distinctio! Temporibus deserunt molestiae repellendus assumenda libero esse! Ipsum commodi quam eos aliquid? Ut quia id similique assumenda recusandae quasi est vitae voluptatibus?
            </p>
        </div>
        <div class="tournament__tab tournament__players tournament__content--hidden">
            <h3 class="tournament__tab__title">Zawodnicy</h3>
            <div class="players__container">
                <div class="player__card">
                    <img src="img/placeholder_player.jpg"/>
                    <h3 class="player__info">Mateusz Bartczak 5i5</h3>
                </div>
            </div>
        </div>
        <div class="tournament__tab ">
            <h3 class="tournament__tab__title">Zwycięzcy</h3>
            <div class="tournament__winners__container">
                <div class="winners__block__container">
                    <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 576 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M400 0H176c-26.5 0-48.1 21.8-47.1 48.2c.2 5.3 .4 10.6 .7 15.8H24C10.7 64 0 74.7 0 88c0 92.6 33.5 157 78.5 200.7c44.3 43.1 98.3 64.8 138.1 75.8c23.4 6.5 39.4 26 39.4 45.6c0 20.9-17 37.9-37.9 37.9H192c-17.7 0-32 14.3-32 32s14.3 32 32 32H384c17.7 0 32-14.3 32-32s-14.3-32-32-32H357.9C337 448 320 431 320 410.1c0-19.6 15.9-39.2 39.4-45.6c39.9-11 93.9-32.7 138.2-75.8C542.5 245 576 180.6 576 88c0-13.3-10.7-24-24-24H446.4c.3-5.2 .5-10.4 .7-15.8C448.1 21.8 426.5 0 400 0zM48.9 112h84.4c9.1 90.1 29.2 150.3 51.9 190.6c-24.9-11-50.8-26.5-73.2-48.3c-32-31.1-58-76-63-142.3zM464.1 254.3c-22.4 21.8-48.3 37.3-73.2 48.3c22.7-40.3 42.8-100.5 51.9-190.6h84.4c-5.1 66.3-31.1 111.2-63 142.3z"/></svg>
                    <div class="winners__block">
                        <h4><?=$stats[1]['imieNazwisko']?> <?=$stats[1]['klasa']?></h4>
                    </div>
                </div>
                <div class="winners__block__container">
                    <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 576 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M400 0H176c-26.5 0-48.1 21.8-47.1 48.2c.2 5.3 .4 10.6 .7 15.8H24C10.7 64 0 74.7 0 88c0 92.6 33.5 157 78.5 200.7c44.3 43.1 98.3 64.8 138.1 75.8c23.4 6.5 39.4 26 39.4 45.6c0 20.9-17 37.9-37.9 37.9H192c-17.7 0-32 14.3-32 32s14.3 32 32 32H384c17.7 0 32-14.3 32-32s-14.3-32-32-32H357.9C337 448 320 431 320 410.1c0-19.6 15.9-39.2 39.4-45.6c39.9-11 93.9-32.7 138.2-75.8C542.5 245 576 180.6 576 88c0-13.3-10.7-24-24-24H446.4c.3-5.2 .5-10.4 .7-15.8C448.1 21.8 426.5 0 400 0zM48.9 112h84.4c9.1 90.1 29.2 150.3 51.9 190.6c-24.9-11-50.8-26.5-73.2-48.3c-32-31.1-58-76-63-142.3zM464.1 254.3c-22.4 21.8-48.3 37.3-73.2 48.3c22.7-40.3 42.8-100.5 51.9-190.6h84.4c-5.1 66.3-31.1 111.2-63 142.3z"/></svg>
                    <div class="winners__block">
                        <h4><?=$stats[0]['imieNazwisko']?> <?=$stats[0]['klasa']?></h4>
                    </div>
                </div>
                <div class="winners__block__container">
                    <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 576 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M400 0H176c-26.5 0-48.1 21.8-47.1 48.2c.2 5.3 .4 10.6 .7 15.8H24C10.7 64 0 74.7 0 88c0 92.6 33.5 157 78.5 200.7c44.3 43.1 98.3 64.8 138.1 75.8c23.4 6.5 39.4 26 39.4 45.6c0 20.9-17 37.9-37.9 37.9H192c-17.7 0-32 14.3-32 32s14.3 32 32 32H384c17.7 0 32-14.3 32-32s-14.3-32-32-32H357.9C337 448 320 431 320 410.1c0-19.6 15.9-39.2 39.4-45.6c39.9-11 93.9-32.7 138.2-75.8C542.5 245 576 180.6 576 88c0-13.3-10.7-24-24-24H446.4c.3-5.2 .5-10.4 .7-15.8C448.1 21.8 426.5 0 400 0zM48.9 112h84.4c9.1 90.1 29.2 150.3 51.9 190.6c-24.9-11-50.8-26.5-73.2-48.3c-32-31.1-58-76-63-142.3zM464.1 254.3c-22.4 21.8-48.3 37.3-73.2 48.3c22.7-40.3 42.8-100.5 51.9-190.6h84.4c-5.1 66.3-31.1 111.2-63 142.3z"/></svg>
                    <div class="winners__block">
                        <h4><?=$stats[2]['imieNazwisko']?> <?=$stats[2]['klasa']?></h4>
                    </div>
                </div>
            </div>
            <h3 class="tournament__tab__title">Statystyki</h3>
            <table class="tournament__table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Imię i Nazwisko</th>
                        <th>Klasa</th>
                        <th>Pkt.</th>
                        <th>W</th>
                        <th>P</th>
                        <th>R</th>
                        <th>Mecze</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                foreach ($stats as $stat) {
                    echo "
                    <tr>
                        <td>{$stat['miejsce']}</td>
                        <td>{$stat['imieNazwisko']}</td>
                        <td>{$stat['klasa']}</td>
                        <td>{$stat['pkt']}</td>
                        <td>{$stat['wygrane']}</td>
                        <td>{$stat['przegrane']}</td>
                        <td>{$stat['remisy']}</td>
                        <td>{$stat['mecze']}</td>
                    </tr>";
                }
                ?>
                    
                    
                </tbody>
            </table>
        </div>
        <div class="tournament__tab tournament__content--hidden">
            <h3 class="tournament__tab__title">Partie</h3>
            <h3>Etap szkolny</h3>
        </div>
        <div class="tournament__tab tournament__content--hidden">
            <h3 class="tournament__tab__title">Galeria</h3>
        </div>
    </div>
    <script src="scripts/changeTournamentTab.js"></script>
</body>
</html>