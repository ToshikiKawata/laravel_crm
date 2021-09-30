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
            @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
    <h1>編集画面</h1>
    <form action="/customers/{{ $customer->id }}" method="post">
        @method('PATCH')
        @csrf
        <div>
            <label for="name">名前</label>
            <input type="text" name="name" value="{{ old('name', $customer->name) }}">
        </div>
        <div>
            <label for="email">メールアドレス</label>
            <input type="text" name="email" value="{{ old('email', $customer->email) }}">
        </div>
        <div>
            <label for="postcode">郵便番号</label>
            <input type="number" name="postcode" value="{{ old('postcode', $customer->postcode) }}">
        </div>
        <div>
            <label for="address">住所</label>
            <textarea name="address" id="" cols="30" rows="10">{{ old('address', $customer->address) }}</textarea>
        </div>
        <div>
            <label for="phoneNumber">電話番号</label>
            <input type="number" name="phoneNumber" value="{{ old('phoneNumber', $customer->phoneNumber) }}">
        </div>
    
        <div>
            <input type="submit" value="更新">
        </div>
        <div>
            <button type="button" onclick="location.href='{{ route('customers.show', $customer->id) }}'">戻る</button>
        </div>
    </form>
</body>
</html>
