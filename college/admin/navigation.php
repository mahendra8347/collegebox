<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="admin_panal.php">College Box</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <a class="nav-link" href="admin_panal.php">Home <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Admin
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="add_helpers_admin.php">Add Helpers Admin</a>
                    <a class="dropdown-item" href="add_admin.php">Add Department Admin</a>
                    <a class="dropdown-item" href="edit_admin_record.php">Edit Admin Detail</a>
                </div>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    News
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="../news/genral/includenews.php">Include News</a>
                    <a class="dropdown-item" href="../news/genral/editnews.php">Edit News</a>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="show_complain.php">Show Complain</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">About</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Contact</a>
            </li>
        </ul>
        <form class="form-inline my-2 my-lg-0" action="logout.php" method="POST">
            <label style="color:white;" class="mr-4"><?php echo "Welcome,  " . $_SESSION['first_name'] ?></label>
            <button class="btn btn-outline-success my-2 my-sm-0 ml-5" type="submit" name="logout">Logout</button>
        </form>
    </div>
</nav>