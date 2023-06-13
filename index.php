<?php

// Include config/db_connect.php
include('config/db_connect.php');

// Write query for all pizzas
$sql = 'SELECT title, ingredients, id FROM pizzas ORDER BY created_at';

// Make query and get result
$result = mysqli_query($conn, $sql);

// Fetch the resulting rows as an array
$pizzas = mysqli_fetch_all($result, MYSQLI_ASSOC);

// Free result from memory
mysqli_free_result($result);

// Close connection
mysqli_close($conn);


// Convert Ingredients string to array
explode(',', $pizzas[0]['ingredients']); // Convert string to array
?>

<!DOCTYPE html>
<html lang="en">

<!-- Header -->
<?php include('templates/header.php'); ?>

<!-- Body -->

<h4 class="center grey-text">Pizzas!</h4>
<div class="container">
    <div class="row">
        <?php foreach($pizzas as $pizza): ?>
            <div class="col s6 md3">
                <div class="card z-depth-0">
              
                    <!-- Image -->
                    <img src="  http://www.clker.com/cliparts/T/e/0/h/I/2/pizza.svg.med.png" 
                    class="pizza" alt="Pizzas">
                    <div class="card-content center">
                        <h6><?php echo htmlspecialchars($pizza['title']); ?></h6>
                        <div>
                            <ul>
                                <?php foreach(explode(',', $pizza['ingredients']) as $ing): ?>
                                    <li><?php echo htmlspecialchars($ing); ?></li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    </div>
                    <div class="card-action right-align">
                        <!-- Eeach Pizza -->
                        <a href="details.php?id=<?php echo $pizza['id']?>" class="brand-text">More Info</a>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>

        <!-- Check How many pizzas -->
        <!-- <?php if(count($pizzas) >= 3): ?>
            <p>There are 3 or more pizzas</p>
        <?php else: ?>
            <p>There are less than 3 pizzas</p>
        <?php endif; ?> -->
    </div>

<!-- Footer -->
<?php include('templates/footer.php'); ?>
</html>


