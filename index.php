<?php
// Connecting to the database
$conn = mysqli_connect('localhost', 'yasiru', 'test123456789', 'pizza', 3313);
if (!$conn) {
    echo 'MySQL connection error: ' . mysqli_connect_error();
    exit;
}

// Selecting all details from the addpizza table
$sql = 'SELECT title, ingredient, id FROM addpizza';
$result = mysqli_query($conn, $sql);

// Check for query errors
if (!$result) {
    echo 'Query error: ' . mysqli_error($conn);
    exit;
}

// Fetching all pizzas into an array
$pizzas = mysqli_fetch_all($result, MYSQLI_ASSOC);

// Free result and close the connection
mysqli_free_result($result);
mysqli_close($conn);

print_r($pizzas);
?>

<body class="font-poppins bg-green-300 min-h-screen">
    <div class="container mx-auto p-4">
        <?php include("header.php"); ?>

        <h1 class="text-3xl font-bold mb-6 text-center text-yellow-800">Our Pizzas</h1>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
            <?php foreach($pizzas as $pizza): ?>
                <div class="bg-white shadow-lg rounded-lg p-5 border border-gray-200">
                    <h2 class="text-xl font-semibold text-gray-800 mb-2">
                        <?php echo htmlspecialchars($pizza['title']); ?>
                    </h2>
                    <ul class="text-sm text-gray-700 list-disc list-inside">
                        <?php foreach(explode(',', $pizza['ingredient']) as $ing): ?>
                            <li><?php echo htmlspecialchars(trim($ing)); ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php endforeach; ?>
        </div>

        <?php include("footer.php"); ?>
    </div>
</body>
</html>
