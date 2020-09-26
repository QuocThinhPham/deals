<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<style>
    img {
        width: 200px;
    }

</style>

<body>
    <table border="1" cellspacing="0" cellpadding="5px 10px">
        <thead>
            <tr>
                <td>ID</td>
                <td>Name</td>
                <td>Price</td>
                <td>Rate</td>
                <td>Image</td>
                <td>created at</td>
                <td>updated at</td>
            </tr>
        </thead>
        <tbody>
            @foreach ($items as $product)
                @php
                $id = $product->id;
                $name = $product->name;
                $price = $product->price;
                $rate =$product->rating;
                $image = $product->image;
                $link = $product->link;
                $type = $product->type;
                $created = $product->created;
                $updated = $product->updated;
                @endphp
                <tr>
                    <td>{{ $id }}</td>
                    <td><a href="{{ 'https://www.thegioididong.com' . $link }}" target="_blank">{{ $name }}</a></td>
                    <td>{{ number_format($price, 0, ',', '.') }}đ</td>
                    <td>{{ $rate }}</td>
                    <td>
                        <img src="{{ $image }}" alt="{{ $name }}" />
                    </td>
                    <td>{{ $created }}</td>
                    <td>{{ $updated }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
