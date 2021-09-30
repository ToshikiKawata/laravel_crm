<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
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
    <h1>新規登録画面</h1>
    <form action="{{ route('customers.store') }}" method="POST">
        @csrf
        <div>
            <label for="name">名前</label>
            <input type="text" name="name" id="name" value="{{ old('name',) }}">
        </div>
        <div>
            <label for="email">メールアドレス</label>
            <input type="email" name="email" id="email" value="{{ old('email') }}">
        </div>
        <div>
            <label for="zipcode">郵便番号</label>
            <input type="text" name="zipcode" id="zipcode" required value="{{ old('zipcode', $zipcode) }}">
        </div>
        <div>
            <label for="address">住所</label>
            <textarea name="address" id="address">{{ $address }}</textarea>
        </div>
        <div>
            <label for="phone">電話番号</label>
            <input type="text" name="phone" id="phone" value="{{ old('phone') }}">
        </div>
        <div>
            <input type="submit" value="登録">
        </div>
    </form>
    <button type="button" onclick="location.href='{{ route('customers.create') }}'">郵便番号検索に戻る</button>
    <button type="button" onclick="location.href='{{ route('customers.index') }}'">一覧へ戻る</button>
</body>

</html>
