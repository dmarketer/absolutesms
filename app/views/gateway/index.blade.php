<!-- app/views/nerds/index.blade.php -->

<!DOCTYPE html>
<html>
<head>
    <title>Gateways List</title>
    <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css">
</head>
<body>
<div class="container">


<h1>All the Gateways</h1>

<!-- will be used to show any messages -->
@if (Session::has('message'))
    <div class="alert alert-info">{{ Session::get('message') }}</div>
@endif

<table class="table table-striped table-bordered">
    <thead>
        <tr>
            <td>ID</td>
            <td>Gateway Name</td>
            <td>Company Name</td>
            <td>Email</td>
            <td>Mobile</td>
            <td>Method</td>
            <td>Gateway url</td>
            <td>Credits</td>
            <td>Actions</td>
        </tr>
    </thead>
    <tbody>
    @foreach($gateway as $key => $value)
        <tr>
            <td>{{ $value->id }}</td>
            <td>{{ $value->gateway_name }}</td>
            <td>{{ $value->company_name }}</td>
            <td>{{ $value->company_email }}</td>
            <td>{{ $value->company_mobile }}</td>
            <td>{{ $value->method }}</td>
            <td>{{ $value->base_url }}</td>
            <td>{{ $value->gateway_credits }}</td>
            

            <!-- we will also add show, edit, and delete buttons -->
            <td>

                <!-- delete the nerd (uses the destroy method DESTROY /nerds/{id} -->
                <!-- we will add this later since its a little more complicated than the other two buttons -->

                <!-- show the nerd (uses the show method found at GET /nerds/{id} -->
                <a class="btn btn-small btn-success" href="{{ URL::to('gateway/' . $value->id) }}">Show this Nerd</a>

                <!-- edit this nerd (uses the edit method found at GET /nerds/{id}/edit -->
                <a class="btn btn-small btn-info" href="{{ URL::to('gateway/' . $value->id . '/edit') }}">Edit this Nerd</a>

            </td>
        </tr>
    @endforeach
    </tbody>
</table>

</div>
</body>
</html>