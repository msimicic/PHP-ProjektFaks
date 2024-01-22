<div class="container contact-container my-5">
    <div class="col-5 contact-form">
        <h2 class="ps-4">Contact Form</h2>
        <form class="p-4 mb-5" action="" method="POST">
            <input type="hidden" id="_action_" name="_action_" value="TRUE">
            <div class="mb-3">
                <label for="first-name" class="form-label">First Name</label>
                <input type="text" class="form-control" id="first-name" name="firstName" autocomplete="off" required>
            </div>
            <div class="mb-3">
                <label for="last-name" class="form-label">Last name</label>
                <input type="text" class="form-control" id="last-name" name="lastName" autocomplete="off" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" autocomplete="off" required>
            </div>
            <div class="mb-3">
                <label for="message" class="form-label">Message</label>
                <textarea id="message" class="form-control" name="message" autocomplete="off" rows="4" cols="50"></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
      </form>
    </div>
    <div>
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2781.949586251333!2d15.95504447525186!3d45.79223771149321!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x4765d69191862317%3A0x98974e3d39e37b54!2sSavska%20cesta%20137%2C%2010000%2C%20Zagreb!5e0!3m2!1shr!2shr!4v1705877192331!5m2!1shr!2shr" width="500" height="500" style="border:1px solid #b5b5b5; border-radius:20px;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
    </div>
</div>

<?php
    if ($_POST['_action_'] == "TRUE") {
        $query  = "INSERT INTO `contacts` (`first_name`, `last_name`, `email`, `subject`) VALUES ('" . $_POST['firstName'] . "', '" . $_POST['lastName'] ."', '" . $_POST['email'] ."', '". $_POST['message'] ."')"; 
        $result = @mysqli_query($MySQL, $query);
    }
?>