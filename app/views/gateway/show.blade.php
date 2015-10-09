<!DOCTYPE html>
<html>
<head>
    <title>Gateway</title>
    <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css">
</head>
<body>
<div class="container">


    
<h1>Showing {{ $gateway['gateway_name'] }} Gateway</h1>

    <div class="jumbotron text-center">
        <h2>{{ $gateway['gateway_name'] }}</h2>
        <p>
            <strong>Company Name:</strong> {{ $gateway['company_name'] }}<br>
            <strong>Method:</strong> {{ $gateway['method'] }}<br>
            <strong>Url:</strong> {{ $gateway['base_url'] }}<br>
            <strong>Mobile:</strong> {{ $gateway['mobile'] }}<br>
            <strong>Credits:</strong> {{ $gateway['gateway_credits'] }}<br>
            <strong>Sender:</strong> {{ $gateway['sender'] }}<br>
            <strong>Username:</strong> {{ $gateway['username'] }}<br>
            <strong>Password:</strong> {{ $gateway['password'] }}<br>
            <strong>Additional Params:</strong> {{ $gateway['additional_params'] }}<br>
            <strong>Delivery Url:</strong> {{ $gateway['delivery_base_url'] }}<br>
            <strong>Uid:</strong> {{ $gateway['uid'] }}<br>
            <strong>Message  Id:</strong> {{ $gateway['message_id'] }}<br>
            <strong>Message:</strong> {{ $gateway['message'] }}<br>
            <strong>Api Key:</strong> {{ $gateway['api_key'] }}<br>
            <strong>Company Mobile:</strong> {{ $gateway['company_mobile'] }}
        </p>
    </div>

</div>
</body>
</html>