<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h1>Bravo hai scritto il post: {{$post->title}}</h1>
    <p>
        Il testo è {{$post->body}}
    </p>
    <p>
        Le category sono: {{$post->category->name}}
    </p>
</body>
</html>