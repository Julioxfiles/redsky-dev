<!-- resources/views/home.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Josefin+Sans:wght@300;400&family=Raleway:wght@200;400&family=Cormorant+Garamond:wght@300;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo asset('css/main.css'); ?>">
    <link rel="stylesheet" href="<?php echo asset('css/bible.css'); ?>">
</head>
<body class="bg-light d-flex align-items-center justify-content-center vh-100">

  <div class="short-container">

    <div class="bible-block">
        <p class="bible-verse">
        "Todo lo puedo en aquel que me fortalece."
        </p>

        <span class="bible-reference">
        Filipenses 4:13
        </span>

        <p class="bible-explanation">
        A través de la fe, podemos enfrentar cualquier dificultad con fortaleza.
        </p>
    </div>
  </div>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
