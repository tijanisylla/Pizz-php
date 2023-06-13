<?php
include('config/db_connect.php');


// Delete pizza
if (isset($_POST['delete'])) {
    $id_to_delete = mysqli_real_escape_string($conn, $_POST['id_to_delete']);

    $sql = "DELETE FROM pizzas WHERE id = $id_to_delete";

    if (mysqli_query($conn, $sql)) {
        // Success
        header('Location: index.php');
    } else {
        // Failure
        echo 'query error: ' . mysqli_error($conn);
    }
}


// Check GET request id parameter
if (isset($_GET['id'])) {
    // isset means if it is set or not (if it exists or not).
    $id = mysqli_real_escape_string($conn, $_GET['id']);

    // Make sql
    $sql = "SELECT * FROM pizzas WHERE id = $id";

    // Get the query result
    $result = mysqli_query($conn, $sql);

    // Fetch result in array format
    $pizza = mysqli_fetch_assoc($result);

    mysqli_free_result($result);
    mysqli_close($conn);
}


?>

<!DOCTYPE html>
<html lang="en">

<?php include('templates/header.php'); ?>



<?php if ($pizza) : ?>
    <div class="container center">
        <h4><?php echo htmlspecialchars($pizza['title']); ?></h4>
        <p>Created by: <?php echo htmlspecialchars($pizza['email']); ?></p>
        <p><?php echo date($pizza['created_at']); ?></p>
        <h5>Ingredients:</h5>
        <p><?php echo htmlspecialchars($pizza['ingredients']); ?></p>

        <!-- Delete form -->
        <form action="details.php" method="POST">
            <input type="hidden" name="id_to_delete" value="<?php echo $pizza['id']; ?>">
            <input type="submit" name="delete" value="Delete" class="btn brand z-depth-0">
        </form>
    </div>

<?php else : ?>
    <h5>No such pizza exists!</h5>
<?php endif; ?>


<?php include('templates/footer.php'); ?>