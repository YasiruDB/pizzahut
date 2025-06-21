<?php
// Connecting to the database
$conn = mysqli_connect('localhost', 'yasiru', 'test123456789', 'pizza', 3313);

if (!$conn) {
    echo 'MySQL connection error: ' . mysqli_connect_error();
    exit;
}

// Initialize variables
$email = $title = $ingredient = "";
$errors = [];

if (isset($_POST['submit'])) {
    // Validate email
    if (empty($_POST['email'])) {
        $errors[] = 'Email is required!';
    } else {
        $email = mysqli_real_escape_string($conn, $_POST['email']);
    }

    // Validate title
    if (empty($_POST['title'])) {
        $errors[] = 'Title is required!';
    } else {
        $title = mysqli_real_escape_string($conn, $_POST['title']);
    }

    // Validate ingredient
    if (empty($_POST['ingredient'])) {
        $errors[] = 'Ingredient is required!';
    } else {
        $ingredient = mysqli_real_escape_string($conn, $_POST['ingredient']);
    }

    // If no errors, insert into database
    if (empty($errors)) {
        $sql = "INSERT INTO addpizza(email, title, ingredient) VALUES('$email', '$title', '$ingredient')";
        if (mysqli_query($conn, $sql)) {
            echo "<p class='text-green-600 text-center'>Pizza added successfully!</p>";
            // Clear fields
            $email = $title = $ingredient = "";
        } else {
            echo "<p class='text-red-600 text-center'>Database error: " . mysqli_error($conn) . "</p>";
        }
    }
} // ✅ This was missing
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Pizza</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>

    <!-- Header Section -->
    <header class="bg-gray-800 text-white py-4">
        <div class="flex justify-center">
            <img src="images/logo.jpg" alt="logo.jpg" class="h-24 rounded">
        </div>
    </header>

    <!-- Navigation -->
    <div class="container header bg-[#d62939] px-[20px] py-[12px] font-serif flex justify-between">
        <a href="addPizza.php" class="text-center text-2xl text-white">Pizza Mart</a>
        <a href="index.php" class="bg-black hover:bg-white hover:text-black py-1 px-3 text-white">Add Pizza</a>
    </div>

    <!-- Show errors if any -->
    <div class="text-center text-red-600 mt-4">
        <?php
        if (!empty($errors)) {
            foreach ($errors as $error) {
                echo "<p>$error</p>";
            }
        }
        ?>
    </div>

    <!-- Form Section -->
    <div class="form p-[20px] md:px-[200px]">
        <h4 class="text-4xl font-serif text-center py-[20px]">Add a Pizza</h4>
        <form class="bg-red-300 border border-sm p-[40px] flex flex-col px-[60px] md:px-[100px]" action="addpizza.php" method="post">
            <label for="email">Your Email</label>
            <input required class="p-1 mb-2 bg-white border rounded border-black" type="email" name="email" id="email" value="<?php echo htmlspecialchars($email); ?>">

            <label for="title">Pizza Type</label>
            <input required class="p-1 mb-2 bg-white border rounded border-black" type="text" name="title" id="title" value="<?php echo htmlspecialchars($title); ?>">

            <label for="ingredient">Ingredient</label>
            <input required class="p-1 mb-2 bg-white border rounded border-black" type="text" name="ingredient" id="ingredient" value="<?php echo htmlspecialchars($ingredient); ?>">

            <input type="submit" name="submit" value="Submit" class="bg-green-500 hover:bg-red-500 text-white py-1 px-3 mt-1">
        </form>
    </div>

</body>
</html>
