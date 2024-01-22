<div class="container col-4 edit-container">
	<?php 
    $MySQL = mysqli_connect("localhost","root","","phpprojekt") or die('Error connecting to MySQL server.');

    if (isset($_GET['edit']) && $_SERVER['REQUEST_METHOD'] != 'POST') {
        $query  = "SELECT first_name, last_name, country FROM users WHERE id=" . (int)$_GET['edit'];
        $result = @mysqli_query($MySQL, $query);
        $row = @mysqli_fetch_array($result);

        print"<h2 class='mt-3'>Edit ". $row['first_name'] ." ". $row['last_name'] ."</h2>";
        print'<a href="index.php?menu=7" class="btn btn-light">BACK</a>
            <form class="mb-3" method="POST" id="MyForm">
                <div class="form-group mb-2">
                    <label for="first-name">First name:*</label>
                    <input type="text" id="first-name" class="form-control" value="' . $row['first_name'] . '" name="firstName" autocomplete="off" required placeholder="First name">
                </div>
                <div class="form-group mb-2">
                    <label for="last-name">Last name:*</label>
                    <input type="text" id="last-name" class="form-control" value="' . $row['last_name'] . '" name="lastName" autocomplete="off" required placeholder="Last name">
                </div>
                <div class="form-group mb-2">
                    <label for="country">Country:*</label>
                    <select id="country" name="countryCode" class="form-select form-select-lg">
                        <option>Please choose</option>';
                        $query2  = "SELECT country_code, country_name FROM countries";
                        $result2 = @mysqli_query($MySQL, $query2);
                        while($row2 = @mysqli_fetch_array($result2)) {
                            print '<option '. ($row2['country_code'] == $row['country'] ? 'selected' : '') .' value="' . $row2['country_code'] . '">' . $row2['country_name'] . '</option>';
                        }
                    print '
                    </select>
                </div>
                <div class="form-group">
                    <input type="submit" value="Pošalji" class="btn btn-primary">
                </div>
            </form>';
    } else {
        $queryUpdate  = "UPDATE users SET first_name='" . $_POST['firstName'] ."', last_name='" . $_POST['lastName'] ."', country='" . $_POST['countryCode'] ."' WHERE id=" . (int)$_GET['edit']; 
        $resultUpdate = @mysqli_query($MySQL, $queryUpdate);

        $query  = "SELECT * FROM users";
        $query .= " LEFT JOIN countries ON users.country = countries.country_code WHERE users.id=" . (int)$_GET['edit']."";
        $result = @mysqli_query($MySQL, $query);
        while($row = @mysqli_fetch_array($result)) {
            print "<p class='mt-3'><a href=index.php?edit=". $row[0] ."><i class='bi bi-pencil'></i></a> " . $row['first_name'] . " <span style='color:green'>" . $row['last_name'] . "</span>" . ($row['country'] != '' ? " (" . $row['country'] . ")" : "" ) . "</p>";
        }

        print '<p class="alert alert-warning">Podaci su uspješno izmjenjeni!</p>';
    }
	   
	?>
</div>