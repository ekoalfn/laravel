<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h2 style="text-align: center"> Book List</h2>

    <div style="display: flex; justify-content: center; margin-bottom: 10px">
        <form action="" method="GET">
            <input type="text" name="keyword">
            <input type="submit" value="submit">
        </form>
    </div>

    <table border="1" style="border-collapse:collapse; margin:auto">
        <thead>
            <tr>
                <th>No</th>
                <th>Title</th>
                <th>Genre</th>
                <th>Author</th>
                <th>Price</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($books as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->title }}</td>
                    <td>{{ $item->genre }}</td>
                    <td>{{ $item->author }}</td>
                    <td>{{ $item->price }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{-- {{ $books->links() }} --}}
</body>
</html>