<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <title>商品一覧</title>
</head>

<body>
    <h1>商品一覧</h1>

    @foreach ($items as $item)
        <p>{{ $item->name }}</p>
    @endforeach
</body>

</html>