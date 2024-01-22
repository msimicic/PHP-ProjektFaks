<nav class="navbar navbar-expand-lg">
    <div class="container-fluid">
        <div class="navbar-brand">
            <div>ExploreNow</div>
        </div>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link" href="index.php?menu=1">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="index.php?menu=2">About</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="index.php?menu=3">Destinations</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="index.php?menu=4">Contact</a>
                </li>
                <?php 
                    if (!isset($_SESSION['user']['valid']) || $_SESSION['user']['valid'] == 'false') {
                        print'
                            <li class="nav-item">
                                <a class="nav-link" href="index.php?menu=5">Register</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="index.php?menu=6">Login</a>
                            </li>
                        ';
                    }
                    else if ($_SESSION['user']['valid'] == 'true') {
                        if($_SESSION['user']['isAdmin'] == 1) {
                            print '
                                <li class="nav-item">
                                    <a class="nav-link" href="index.php?menu=7">Admin</a>
                                </li>';
                        }
                        else {
                            print '
                                <li class="nav-item">
                                    <a class="nav-link" href="index.php?menu=7">User</a>
                                </li>';
                        }
                        print'<li class="nav-item">
                                <a class="nav-link" href="signout.php">Sign Out</a>
                            </li>
                        ';
                    }
                ?>
            </ul>
        </div>
    </div>
</nav>