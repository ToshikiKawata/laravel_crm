<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    @if ($errors->any())
        <div class="error">
            <p>
                <b>{{ count($errors) }}件のエラーがあります。</b>
            </p>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <h1>郵便番号検索画面</h1>
    <form action={{ route('customers.search') }} method="GET">
        @method('GET')
        @csrf
        <p>
            <label for="name">郵便番号検索</label>
            <input type="text" name="zipcode" value="{{ old('zipcode') }}">
            <input type="submit" value="検索">
        </p>
        <p>
            <button onclick="location.href='/customers'">一覧へ戻る</button>
        </p>
</body>
</html>

