<!DOCTYPE html>
<html lang="en">
    <head>
      <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>

        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width,initial-scale=1.0">
    </head>


     <!-- Header Section -->
  <header class="bg-gray-800 text-white py-4">
    <div class="flex justify-center">
      <img src="images/logo.jpg" alt="logo.jpg" class="h-24 rounded">
    </div>
  </header>

  <body>

  <div class="container header bg-[#d62939] px-[20px] py-[12px] font-serif flex justify-between">
        <a href="addPizza.php" class="text-center text-2xl text-decoration-none  text-white" > Pizza Mart </a>
        <a href="index.php" class="bg-black hover:bg-white hover:text-black py-1 px-3 text-decoration-none  text-white">Add Pizza</a>
    </div> 

    <?php

     if(isset($_POST['submit'])) {

if(empty($_POST['email'])) {
  echo 'Email is Required! <br/>';
} else {
  echo $_POST['email'];
}
if(empty($_POST['title'])) {
  echo 'title is Required! <br/>';
} else {
  echo $_POST['title'];
}
if(empty($_POST['ingredient'])) {
  echo 'ingredient is Required! <br/>';
} else {
  echo $_POST['ingredient'];
}
     }

     ?>

    <div class="form p-[20px] md:px-[200px]">
      <h4 class="text-4xl font-serif text-center py-[20px]">Add a Pizza</h4>
      <form class="bg-red-300 border border-sm p-[40px] flex flex-col px-[60px] md:px-[100px] poppins-medium" action="addpizza.php" method="post">
        <label for="">your Email</label>
        <input required class="p-1 mb-2 bg-white border rounded-none border-black-600 "type="email" name="email">
        <label for="">Pizza Type</label>
        <input required class="p-1 mb-2 bg-white border rounded-none border-black-600"type="text" name="title">
        <label for="">Ingredient</lable>
        <input required class="p-1 mb-2 bg-white border rounded-none border-black-600"type="text" name="ingredient">
        <input type="Submit" name="Submit" Value="submit" class="bg-green-500 hover:bg-red-500 text-black-200 py-1 px-3 mt-1">
      </form>

    </div>

</body>

        </form>
        </html>