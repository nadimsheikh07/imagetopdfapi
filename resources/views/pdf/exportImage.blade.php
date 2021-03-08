<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body style="padding: 0;margin:0;">
    @foreach($images as $image)
    <img style="padding: 0;margin:0;width:100%;height:100%;" height="100%" width="100%" src="{{ $image }}" />
    @endforeach
</body>

</html>