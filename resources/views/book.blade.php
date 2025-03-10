<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Book List</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="{{ asset('vendor/smart-ads/js/smart-banner.min.js') }}"></script>
</head>
<body class="bg-light">
    <div class="container py-5">
        <h2 class="text-center mb-4">Book List</h2>
        
        <x-smart-ad-component slug="Gacor"/>
        
        <div class="row justify-content-center mb-4">
            <div class="col-md-6">
                <form action="" method="GET" class="d-flex gap-2">
                    <input type="text" name="keyword" class="form-control" placeholder="Search books...">
                    <button type="submit" class="btn btn-primary">Search</button>
                </form>
            </div>
        </div>

        <div class="table-responsive">
            <table class="table table-hover table-bordered">
                <thead class="table-dark">
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
                            <td>Rp {{ number_format($item->price, 0, ',', '.') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        {{-- {{ $books->links() }} --}}
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>