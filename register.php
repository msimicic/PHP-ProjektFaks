<?php 

    if ($_POST['_action_'] == FALSE) {
        print'
            <h1 class="text-center mt-3">Registration Form</h1>
            <form class="registration-form mx-auto p-4 mb-5 mt-4" action="" method="POST" >
                <input type="hidden" id="_action_" name="_action_" value="TRUE">
                <div class="mb-3">
                    <label for="firstName" class="form-label">First Name *</label>
                    <input type="text" class="form-control" id="firstName" name="firstName" placeholder="Enter your first name..." autocomplete="off" required>
                </div>
                <div class="mb-3">
                    <label for="lastName" class="form-label">Last Name *</label>
                    <input type="text" class="form-control" id="lastName" name="lastName" placeholder="Enter your last name..." autocomplete="off" required>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email *</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email..." autocomplete="off" required>
                </div>
                <div class="mb-3">
                    <label for="username" class="form-label">Username * <small>(Min 5 and max 30 char)</small></label>
                    <input type="text" class="form-control" id="username" name="username" placeholder="Choose your username..." autocomplete="off" pattern=".{5,30}" required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password * <small>(Min 5 and max 30 char)</small></label>
                    <input type="password" class="form-control" id="password" name="password" placeholder="Choose your password..." autocomplete="off" pattern=".{5,30}" required>
                </div>
                <label for="country">Country *</label>
                <select class="form-select mb-3" name="country" id="country" required>
                    <option value="">Molimo odaberite:</option>';
                        $query  = "SELECT * FROM countries";
                        $result = @mysqli_query($MySQL, $query);
                        while($row = @mysqli_fetch_array($result)) {
                            print '<option value="' . $row['country_code'] . '">' . $row['country_name'] . '</option>';
                        }
                print'
                </select>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>';
    }
    else if ($_POST['_action_'] == TRUE) {
		
		$query  = "SELECT * FROM users";
		$query .= " WHERE email='" .  $_POST['email'] . "'";
		$query .= " OR username='" .  $_POST['username'] . "'";
		$result = @mysqli_query($MySQL, $query);
		
        if ($result) {
            $row = @mysqli_fetch_array($result, MYSQLI_ASSOC);

            if ($row) {
                // Postoji korisnik s istim emailom ili korisničkim imenom
                echo '<p class="p-2 registracijska-poruka">User with this email or username already exists!</p>';
		    }
            else {
                // Nema korisnika s istim emailom ili korisničkim imenom, možete izvršiti unos
                # password_hash https://secure.php.net/manual/en/function.password-hash.php
                # password_hash() stvara novi sažetak lozinke koristeći snažan jednosmjerni algoritam sažetka
                $pass_hash = password_hash($_POST['password'], PASSWORD_DEFAULT, ['cost' => 12]);
                
                $query  = "INSERT INTO users (first_name, last_name, email, username, password, country)";
                $query .= " VALUES ('" . $_POST['firstName'] . "', '" . $_POST['lastName'] . "', '" . $_POST['email'] . "', '" . $_POST['username'] . "', '" . $pass_hash . "', '" . $_POST['country'] . "')";
                
                $result = @mysqli_query($MySQL, $query);
                
                # ucfirst() — Prvo slovo stringa veliko
                # strtolower() - Svi znakovi u stringu malim slovima
                echo '<p class="p-2 registracijska-poruka">' . ucfirst(strtolower($_POST['firstName'])) . ' ' .  ucfirst(strtolower($_POST['lastName'])) . ', thank you for registration! </p>';
            }
        } else {
            // Greška pri izvršavanju upita
            echo '<p>Error fetching user data or user not found!</p>';
        }
	}

?>