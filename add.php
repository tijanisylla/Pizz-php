<?php
include('config/db_connect.php');



// I'll use htmlspecialchars() to prevent XSS attacks (cross-site scripting) attacks from happening to my website. 
// XSS stands for cross-site scripting. It is a type of computer security vulnerability typically found in web applications. XSS enables attackers to inject client-side scripts into web pages viewed by other users.
// This function will convert special characters to HTML entities.
// Hackers can use <script> tags to inject malicious JavaScript code into your website.

$errors = array('email' => '', 'title' => '', 'ingredients' => '');
$email = $title = $ingredients = '';
if(isset($_POST['submit'])){
    // echo htmlspecialchars($_POST['email']);
    // echo htmlspecialchars($_POST['title']);
    // echo htmlspecialchars($_POST['ingredients']);

    // Validation
    if(empty($_POST['email'])){
       $errors['email'] = 'An email is required <br />';
    } else {
       $email =  htmlspecialchars($_POST['email']);
         if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
             $errors['email'] = 'Email must be a valid email address'; 
         }
    }

    if(empty($_POST['title'])){
        $errors['title'] = 'A title is required <br />';
    } else {
      $title = htmlspecialchars($_POST['title']);
        if(!preg_match('/^[a-zA-Z\s]+$/', $title)){
            $errors['title'] = 'Title must be letters and spaces only';
        }
    }

    if(empty($_POST['ingredients'])){
        $errors['ingredients'] = 'At least one ingredient is required <br />';
    } else {
        $ingredients = htmlspecialchars($_POST['ingredients']);
            if(!preg_match('/^([a-zA-Z\s]+)(,\s*[a-zA-Z\s]*)*$/', $ingredients)){
                $errors['ingredients'] = 'Ingredients must be a comma separated list';
            }
    }

    // If there are no errors, redirect to index.php
    if(array_filter($errors)){
    //    echo 'errors in the form';
    } else {
        // Post data to database
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $title = mysqli_real_escape_string($conn, $_POST['title']);
        $ingredients = mysqli_real_escape_string($conn, $_POST['ingredients']);

        // Create sql
        $sql = "INSERT INTO pizzas(title, email, ingredients) VALUES('$title', '$email', '$ingredients')";

        // Save to db and check
        if(mysqli_query($conn, $sql)){
            // Success
            header('Location: index.php');
        } else {
            // Error
            echo 'query error: ' . mysqli_error($conn);
        }
        // echo 'form is valid';
    }

}  // End of POST check
?>


<!DOCTYPE html>
<html lang="en">

<!-- Header -->
<?php include('templates/header.php'); ?>

<!-- Section -->
<section class="container grey-text">
    <h4 class="center">Add a Pizza</h4>
    <form action="add.php" method="POST" class="white">
        <label>Your Email:</label>
        <input type="text" name="email" value=" <?php echo htmlspecialchars($email) ?>">
        <!-- Error -->
        <div class="red-text"><?php echo $errors['email']; ?></div>
        <label>Pizza Title:</label>
        <input type="text" name="title" value="<?php echo htmlspecialchars($title) ?>">
        <!-- Error -->
        <div class="red-text"><?php echo $errors['title']; ?></div>
        <label>Ingredients (comma separated):</label>
        <input type="text" name="ingredients" value="<?php echo htmlspecialchars($ingredients) ?>">
        <!-- Error -->
        <div class="red-text"><?php echo $errors['ingredients']; ?></div>
        <div class="center">
            <input type="submit" name="submit" value="submit" class="btn brand z-depth-0">
        </div>
    </form>
</section>

<!-- Footer -->
<?php include('templates/footer.php'); ?>
</html>
