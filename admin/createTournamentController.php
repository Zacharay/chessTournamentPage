<?php
    if(isset($_POST['tournament__name']))
    {
        $tournamentCount = count(scandir('../turnieje'))-2;
        $newTournamentId = $tournamentCount<9?'0'.$tournamentCount+1:$tournamentCount+1;
       
        $tournamentFolderPath = "../turnieje/$newTournamentId";
    
        if(!file_exists($tournamentFolderPath))
        {
            mkdir($tournamentFolderPath,'0777',true);    
            $tournamentName = $_POST['tournament__name'];
            $tournamentDate = $_POST['tournament__date'];
            $tournamentDescription = $_POST['tournament__description'];
            $mainContent = "//Nazwa Turnieju\n$tournamentName\n//Data turnieju\n$tournamentDate\n//czy pokazać na stronie\n0\n//Opis\n$tournamentDescription";
    
            file_put_contents("$tournamentFolderPath/main.txt",$mainContent);
    
            echo "Folder created successfully.<br>";
            header('Location: adminPanel.php');
        } 
        else 
        {
            echo "Folder  already exists.<br>";
        }
    }
?>