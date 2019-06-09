<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Create new project</title>
</head>
<body>
<form action="/projects" method="post">
    @csrf
    <div>
        <label for="title">Title:</label>
        <input id="title" name="title" type="text" required>
    </div>
    <div>
        <label for="description">Description:</label>
        <input id="description" name="description" type="text" required>
    </div>
    <button type="submit">Create</button>
</form>
</body>
</html>