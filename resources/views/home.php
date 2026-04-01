<!-- resources/views/home.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo asset('css/main.css'); ?>">
</head>
<?php
    use App\Http\Controllers\AbstractFactoryController;
    $theme =  new AbstractFactoryController();
    $theme->darkTheme();
    //$theme->lightTheme();
?>
<body class="<?= $theme->name ?>">
   <h3 class="<?= $theme->name ?>">Abstract Factory</h3>
 <!-- Bootstrap JS -->
 <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>