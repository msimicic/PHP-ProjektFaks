<?php 

    # Start session
    session_start();

    include ("dbconn.php");

    if(isset($_GET['menu'])) { $menu   = (int)$_GET['menu']; }

    if(!isset($_POST['_action_']))  { $_POST['_action_'] = FALSE;  }

    if (!isset($menu)) { $menu = 1; }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>ExploreNow</title>
    <link type="image/png" sizes="16x16" rel="icon" href="images/airplane-favicon.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
</head>
<body>
    <header>
        <div <?php if ($menu > 1) {print 'class=""'; } else {print 'class="hero-image"'; } ?>></div>
        <?php include("menu.php"); ?>
    </header>
    <main class="main-container">
        <?php 
            if(!isset($_GET['edit'])) {
                #Home
                if (!isset($menu) || $menu == 1) { include("home.php"); }
                
                #About
                else if ($menu == 2) { include("about.php"); }
    
                #Destinations
                else if ($menu == 3) { include("destinations.php"); }

                #Contact
                else if ($menu == 4) { include("contact.php"); }
    
                #Register
                else if ($menu == 5) { include("register.php"); }
    
                #Login
                else if ($menu == 6) { include("login.php"); }
    
                #Admin
                else if ($menu == 7) { include("admin.php"); }
            } else {
                 include("edit.php");
            }

        ?>
    </main>
    <footer class="footer-container">
        <div class="d-flex align-items-center">
            <a href="https://www.instagram.com/">
                <img style="height:20px; padding-right:5px;" src="https://nomadik.travel/wp-content/themes/nomadik/img/contact-instagram.svg" alt="Instagram">
            </a>
            <a href="https://www.facebook.com/">
                <img style="height:20px; padding-right:5px;" src="https://nomadik.travel/wp-content/themes/nomadik/img/contact-facebook.svg" alt="Facebook">
            </a>
        </div>
        <p>Copyright &copy; <?php print date("Y") ?>. Matej Šimičić.</p>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>