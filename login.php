<?php


  if ($_POST['_action_'] == FALSE) {
    print'
      <h1 class="text-center mt-3">Login Form</h1>
      <form class="login-form mx-auto p-4 mb-5 mt-4" action="" method="POST">
        <input type="hidden" id="_action_" name="_action_" value="TRUE">
        <div class="mb-3">
          <label for="username" class="form-label">Username</label>
          <input type="text" class="form-control" id="username" name="username" placeholder="Enter an username..." pattern=".{5,30}" autocomplete="off" required>
        </div>
        <div class="mb-3">
          <label for="password" class="form-label">Password</label>
          <input type="password" class="form-control" id="password" name="password" placeholder="Enter a password..." pattern=".{5,30}" autocomplete="off" required>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
      </form>
    ';
  }
  else if ($_POST['_action_'] == "TRUE") {

    $query  = "SELECT * FROM users";
    $query .= " WHERE username='" .  $_POST['username'] . "'";
    $result = @mysqli_query($MySQL, $query);

    if ($result) {
        $row = @mysqli_fetch_array($result, MYSQLI_ASSOC);

        #U password_verify funkciju prvi parametar ide tekst koji usporedujemo, a drugi parametar hash tog teksta
        if ($row && password_verify($_POST['password'], $row['password'])) {
            $_SESSION['user']['valid'] = 'true';
            $_SESSION['user']['id'] = $row['id'];
            $_SESSION['user']['firstName'] = $row['first_name'];
            $_SESSION['user']['lastName'] = $row['last_name'];
            $_SESSION['user']['isAdmin'] = $row['is_admin'];
            $_SESSION['message'] = '<p>Dobrodošli, ' . $_SESSION['user']['firstName'] . ' ' . $_SESSION['user']['lastName'] . '</p>';
            header("Location: index.php?menu=7");
        } else {
            unset($_SESSION['user']);
            $_SESSION['message'] = '<p>You entered wrong username or password!</p>';
            header("Location: index.php?menu=6");
        }
    } else {
        // Greška pri izvršavanju upita za provjeru korisničkog imena
        echo '<p>Greška pri dohvaćanju podataka o korisniku ili korisnik nije pronađen!</p>';
    }
  }
?>
