<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <form action="/form" method="post">
        <input type="text" name="name">
        <input type="hidden" name="_token" value="{{csrf_token()}}">
        <button type="submit">Submit</button>
    </form>
</body>

</html>