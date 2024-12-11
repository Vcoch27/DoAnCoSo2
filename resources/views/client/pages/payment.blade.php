<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <form action="{{ route('premium.pay') }}" method="post">
        @csrf
        <button type="submit">
            Thanh toán Zalo Pay
        </button>
    </form>

</body>

</html>