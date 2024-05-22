<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
</head>

<body>
    <div class="container">
        <h1> Welcome, {{ Auth::user()->name }}</h1>
    </div>
    <form action="/logout" method="POST">
        @csrf
        <button name="submit" type="submit" class="btn btn-danger">Logout</button>
    </form>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous">
    </script>
    <table class="table table-sm">
        <thead>
            <tr>
                <th>id</th>
                <th>Name</th>
                <th>Type</th>
                <th>City</th>
                <th>Address</th>
                <th>Phone</th>
            </tr>
        </thead>
        <tbody>
            @foreach($data as $row)
            <tr>
                <td>{{ $row->id }}</td>
                <td>{{ $row->name }}</td>
                <td>{{ $row->brewery_type }}</td>
                <td>{{ $row->city }}</td>
                <td>{{ $row->address_1 }}</td>
                <td>{{ $row->phone }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>