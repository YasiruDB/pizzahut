<?php
// Connect to DB
$conn = mysqli_connect('localhost', 'yasiru', 'test123456789', 'pizza', 3313);
if (!$conn) {
    die('MySQL connection error: ' . mysqli_connect_error());
}

// Get pizza by ID
if (isset($_GET['id'])) {
    $id = mysqli_real_escape_string($conn, $_GET['id']);
    $sql = "SELECT * FROM addpizza WHERE id = $id";
    $result = mysqli_query($conn, $sql);
    $pizza = mysqli_fetch_assoc($result);

    if (!$pizza) {
        echo "Pizza not found!";
        exit;
    }
} else {
    echo "No ID provided!";
    exit;
}

// Handle update form submission
if (isset($_POST['submit'])) {
    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $ingredient = mysqli_real_escape_string($conn, $_POST['ingredient']);
    $update_id = mysqli_real_escape_string($conn, $_POST['id']);

    $update_sql = "UPDATE addpizza SET title = '$title', ingredient = '$ingredient' WHERE id = $update_id";
    if (mysqli_query($conn, $update_sql)) {
        header('Location: index.php'); // Go back to main page
        exit;
    } else {
        echo 'Update error: ' . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Update Pizza</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-yellow-100 font-poppins min-h-screen flex items-center justify-center">
    <form action="update.php?id=<?php echo $pizza['id']; ?>" method="POST" class="bg-white shadow-md p-6 rounded-lg w-96">
        <h2 class="text-2xl font-bold mb-4 text-center text-yellow-700">Update Pizza</h2>

        <label class="block mb-2 text-gray-700 font-semibold">Title:</label>
        <input type="text" name="title" value="<?php echo htmlspecialchars($pizza['title']); ?>" class="w-full px-3 py-2 border rounded mb-4" required>

        <label class="block mb-2 text-gray-700 font-semibold">Ingredients (comma separated):</label>
        <input type="text" name="ingredient" value="<?php echo htmlspecialchars($pizza['ingredient']); ?>" class="w-full px-3 py-2 border rounded mb-4" required>

        <input type="hidden" name="id" value="<?php echo $pizza['id']; ?>">

        <button type="submit" name="submit" class="w-full bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-2 px-4 rounded">
            Save Changes
        </button>
    </form>
</body>
</html>
