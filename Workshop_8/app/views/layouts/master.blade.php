<!DOCTYPE html>
<html>
<head>
    <title>Student CRUD</title>

    <style>
        body { font-family: Arial; background: #f2f2f2; padding: 20px; }
        .container { background: white; padding: 20px; border-radius: 8px; width: 80%; margin: auto; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { padding: 10px; border: 1px solid #ddd; }
        a { text-decoration: none; padding: 8px 12px; border-radius: 4px; }
        .btn-add { background: green; color: white; }
        .btn-edit { background: blue; color: white; }
        .btn-delete { background: red; color: white; }
    </style>

</head>
<body>

<div class="container">
    @yield('content')
</div>

</body>
</html>
