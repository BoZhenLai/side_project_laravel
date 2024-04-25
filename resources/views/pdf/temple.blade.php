<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>
    <table align="center">
        <tr>
            <td width="100%" style="font-family:'HanSerifTC';font-size:16pt" align="center">{{ $article['title'] }}</td>
        </tr>
    </table>
    <table border="1" align="center" width="100%">
        <tr>
            <td width="10%" style="font-family:'HanSerifTC';">作者：</td>
            <td width="90%" style="font-family:'HanSerifTC';">{{ $article->user['name'] }}</td>
        </tr>
        <tr>
            <td width="10%" height="50%" style="font-family:'HanSerifTC';">內容：</td>
            <td width="90%" height="50%" style="font-family:'HanSerifTC';">{{ $article['content'] }}</td>
        </tr>
    </table>
</body>

</html>
