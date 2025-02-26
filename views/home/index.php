<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $data['title'] ?? 'Halaman Utama'; ?></title>
</head>
<body>
    <h1><?= $data['title'] ?? 'Halaman Utama'; ?></h1>
    <p><?= $data['content'] ?? 'Selamat datang di aplikasi MVC PHP'; ?></p>
</body>
</html>
