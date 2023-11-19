<?php
if(isset($_POST['tournament__name'])&&isset($_GET['tournamentID']))
{
    $tournamentID = $_GET['tournamentID'];
    
    $mainInfoPath = "../turnieje/$tournamentID/main.txt";

    $tournamentName = $_POST['tournament__name'];
    $tournamentDate = $_POST['tournament__date'];
    $tournamentShow = $_POST['show_on_page']=='on'?1:0;
    $tournamentDescription = $_POST['tournament__description'];
    $tournamentDescription = trim(preg_replace('/\s\s+/', ' ', $tournamentDescription));

    $mainContent = "//Nazwa Turnieju\n$tournamentName\n//Data turnieju\n$tournamentDate\n//czy pokazać na stronie\n$tournamentShow\n//Opis\n$tournamentDescription";
    
    
    file_put_contents($mainInfoPath,$mainContent);
    header("Location: adminTournament.php?tournamentID=$tournamentID");
}
?>
