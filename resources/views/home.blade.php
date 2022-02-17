<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Products</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
</head>

<body>
    <div class="container mt-5">
        <table class="table table-bordered mb-4">
            <thead>
                <tr class="table-success">
                    <th scope="col">#</th>
                    <th scope="col">Product  name</th>
                    
                </tr>
            </thead>
            <tbody>
                @foreach($product as $data)
                <tr>
                    <th scope="row">{{ $data->id }}</th>
                    <td>{{ $data->product}}</td>
                    
                </tr>
                @endforeach
            </tbody>
        </table>

        {{-- Pagination --}}
        <div class="d-flex justify-content-center">
            {{-- {!! $product->links() !!} --}}

            {{-- {!! $product->appends(['sort' => 'department'])->links() !!} --}}

            {!! $product->appends(Request::all())->links() !!}
        </div>
    </div>
</body>

</html>
