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
    <h1>顧客一覧</h1>
    <table border="1">
        <tr>
            <th>顧客ID</th>
            <th>名前</th>
            <th>メールアドレス</th>
            <th>郵便番号</th>
            <th>住所</th>
            <th>電話番号</th>
        </tr>
        @foreach ($customers as $customer)
            <tr>
                <td><a href="{{ route('customers.show', $customer) }}">{{ $customer->id }}</a></td>
                <td>{{ $customer->name }}</td>
                <td>{{ $customer->email }}</td>
                <td>{{ $customer->zipcode }}</td>
                <td>{{ $customer->address }}</td>
                <td>{{ $customer->phone }}</td>
            </tr>
        @endforeach
    </table>
    <button type="button" onclick="location.href='{{ route('customers.search') }}'">新規作成</button>
</body>
</html>
