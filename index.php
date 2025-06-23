<?php
// Connecting to the database
$conn = mysqli_connect('localhost', 'yasiru', 'test123456789', 'pizza', 3313);
if (!$conn) {
    echo 'MySQL connection error: ' . mysqli_connect_error();
    exit;
}

// Get all pizzas
$sql = 'SELECT title, ingredient, id FROM addpizza';
$result = mysqli_query($conn, $sql);
if (!$result) {
    echo 'Query error: ' . mysqli_error($conn);
    exit;
}
$pizzas = mysqli_fetch_all($result, MYSQLI_ASSOC);
mysqli_free_result($result);
mysqli_close($conn);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Pizza List</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="font-poppins bg-green-300 min-h-screen">
    <div class="container mx-auto p-4">
        <?php include("header.php"); ?>

        <h1 class="text-3xl font-bold mb-6 text-center text-yellow-800">Our Pizzas</h1>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
            <?php foreach($pizzas as $pizza): ?>
                <div class="pizza-card bg-white shadow-lg rounded-lg p-5 border border-gray-200" id="pizza-<?php echo $pizza['id']; ?>">
                    <h2 class="text-xl font-semibold text-gray-800 mb-2">
                        <?php echo htmlspecialchars($pizza['title']); ?>
                    </h2>
                    <ul class="text-sm text-gray-700 list-disc list-inside mb-4">
                        <?php foreach(explode(',', $pizza['ingredient']) as $ing): ?>
                            <li><?php echo htmlspecialchars(trim($ing)); ?></li>
                        <?php endforeach; ?>
                    </ul>

                    <div class="flex space-x-4">
                        <!-- Update Button -->
                        <a href="update.php?id=<?php echo $pizza['id']; ?>" 
                           class="bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-2 px-4 rounded inline-block text-center">
                           Update
                        </a>

                        <!-- Delete Button (AJAX) -->
                        <button 
                            onclick="deletePizza(<?php echo $pizza['id']; ?>)" 
                            class="bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-4 rounded">
                            Delete
                        </button>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <?php include("footer.php"); ?>
    </div>

    <script>
        function deletePizza(id) {
            if (!confirm('Are you sure you want to delete this pizza?')) return;

            fetch('delete.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                body: 'id=' + encodeURIComponent(id)
            })
            .then(response => response.text())
            .then(data => {
                if (data.trim() === 'success') {
                    const card = document.getElementById('pizza-' + id);
                    if (card) card.remove();
                } else {
                    alert('Delete failed: ' + data);
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('An error occurred while deleting.');
            });
        }
    </script>
</body>
</html>
