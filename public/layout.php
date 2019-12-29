<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="resources/css/main.css" />
    <link rel="stylesheet" href="resources/css/modal.css" />
    <title>TecnoTest</title>
</head>
<body>
    <div class="flex-container">
        <header class="flex-container main-header">
            <h1>Tecno</h1>
            <div><img src="resources/images/home.png" alt="Home" title="Home" class="icon home" onclick="window.location.href = '/'"></div>
        </header>
        <?php echo $content; ?>
    </div>

    <div class="modal flex-container">
    </div>
    <script type="module" src="resources/js/lib/modal/modal.js"></script>
</body>
</html>
