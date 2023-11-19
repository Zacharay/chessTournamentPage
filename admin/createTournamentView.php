<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles/globals.css"/>
    <link rel="stylesheet" href="../styles/adminPanel.css"/>
    <title>Document</title>
    <style>
        body{
            height:100vh;
            background-color:#111;
            display:flex;
            justify-content:center;
            align-items:center;
        }
        textarea{
            resize:none;
            font-size:1.6rem;
        }
    </style>
</head>
<body>
    <form action="createTournamentController.php" method="POST" class="admin__form">
        <label>Nazwa turnieju <input type="text" name='tournament__name'/></label>
        <label>Data turnieju <input type="date" name='tournament__date'/></label>
        <label>Opis <textarea name="tournament__description" cols="30" rows="10"></textarea></label>
        <button>Utwórz</button>
    </form>
</body>
</html>