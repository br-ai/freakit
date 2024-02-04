<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/MaterialDesign-Webfont/7.2.96/css/materialdesignicons.min.css" integrity="sha512-LX0YV/MWBEn2dwXCYgQHrpa9HJkwB+S+bnBpifSOTO1No27TqNMKYoAn6ff2FBh03THAzAiiCwQ+aPX+/Qt/Ow==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="style.css" rel="stylesheet">
    <link rel="icon" href="../icon.png" sizes="180x180">
</head>
<body>

    <div class="navbar">
        <div class="nav_logo">
            <img src="../freakit.png" alt="logo" title="logo"/>
        </div>

        <div class="nav_link">
            

            <div class="nav_link_item">
                <i class="fa fa-info" aria-hidden="true"></i> Aide
            </div>

            <div class="nav_link_item">
                <i class="fa fa-th-list" aria-hidden="true"></i> Confidentialité
            </div>
            
            <div class="nav_link_item">
                <i class="fa fa-cog" aria-hidden="true"></i> parametres
            </div>
        </div>

        <div class="nav_search">
            <div class="search-container">
            <form id="searchForm" action="searchUser.php" method="post">
                <input type="text" name="search_input" class="search-input" placeholder="chercher utilisateur" onkeydown="submitForm(event)">
            </form>

            <script>
                function submitForm(event) {
                    if (event.key === "Enter") {
                        event.preventDefault(); // Empêche le comportement par défaut (envoi du formulaire)
                        document.getElementById("searchForm").submit(); // Soumet le formulaire
                    }
                }
            </script>
              </div>
              
        </div>

        <div class="burger_icon" id="burger_icon">
            
            <svg xmlns="http://www.w3.org/2000/svg" height="24" fill="#0d90c3" viewBox="0 -960 960 960" width="24"><path d="M120-240v-80h720v80H120Zm0-200v-80h720v80H120Zm0-200v-80h720v80H120Z"/></svg>
            <div class="dropdow">
                <div class="nav_link_item">Aide</div>
                <div class="nav_link_item">Confidentialité</div>
                <div class="nav_link_item">parametres</div>
            </div>
        </div>
        

    </div>