<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Registration</title>
</head>
<body>

    {{ Form::open(array('url' => 'sendsms')) }}

        <p>To Numbers :</p>

        <p>{{ Form::text('numbers') }}</p>

        <p>Sender Id :</p>

        <p>{{ Form::select('sender_id', array('id' => 'CODEPIX')); }}</p>

        <p>Message :</p>

        <p>{{ Form::textarea('message') }}</p>

        <p>Signature:</p>

        <p>{{ Form::text('signature') }}</p>

        <p>{{ Form::submit('Submit') }}</p>

    {{ Form::close() }}

</body>
</html>