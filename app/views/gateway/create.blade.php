<!-- app/views/nerds/create.blade.php -->

<!DOCTYPE html>
<html>
    <head>
        <title>Gateway Creation</title>
        <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css">
    </head>
    <body>
        <div class="container">

            <h1>Create Gateway</h1>

            <!-- if there are creation errors, they will show here -->
            {{ HTML::ul($errors->all()) }}

            {{ Form::open(array('url' => 'gateway/create')) }}

            <div class="form-group">
                {{ Form::label('gateway_name', 'Gateway Name') }}
                {{ Form::text('gateway_name', Input::old('gateway_name'), array('class' => 'form-control')) }}
            </div>

            <div class="form-group">
                {{ Form::label('method', 'Method') }}
                {{ Form::text('method', Input::old('method'), array('class' => 'form-control')) }}
            </div>

            <div class="form-group">
                {{ Form::label('gateway_url', 'Gateway Url') }}
                {{ Form::text('base_url', Input::old('base_url'), array('class' => 'form-control')) }}
            </div>

            <div class="form-group">
                {{ Form::label('api_key', 'API Key') }}
                {{ Form::text('api_key', Input::old('api_key'), array('class' => 'form-control')) }}
            </div>

            <div class="form-group">
                {{ Form::label('user name', 'User Name') }}
                {{ Form::text('username', Input::old('username'), array('class' => 'form-control')) }}
            </div>

            <div class="form-group">
                {{ Form::label('password', 'Password') }}
                {{ Form::password('password', Input::old('password'), array('class' => 'form-control')) }}
            </div>
            
            <div class="form-group">
                {{ Form::label('api_required', 'Required For Gateway') }}
                {{ Form::select('api_required',array(''=>'Select' ,'0'=>'Username / Password','1'=>'Api Key'), Input::old('api_required'), array('class' => 'form-control')) }}
            </div>
            
            <div class="form-group">
                {{ Form::label('mobile', 'Mobile') }}
                {{ Form::text('mobile', Input::old('mobile'), array('class' => 'form-control')) }}
            </div>

            <div class="form-group">
                {{ Form::label('sender', 'Sender') }}
                {{ Form::text('sender', Input::old('sender'), array('class' => 'form-control')) }}
            </div>

            <div class="form-group">
                {{ Form::label('message', 'Message') }}
                {{ Form::text('message', Input::old('message'), array('class' => 'form-control')) }}
            </div>

            <div class="form-group">
                {{ Form::label('additional parms', 'Additional Params') }}
                {{ Form::text('additional_params', Input::old('additional_params'), array('class' => 'form-control')) }}
            </div>

            <div class="form-group">
                {{ Form::label('credits', 'Credits') }}
                {{ Form::text('gateway_credits', Input::old('gateway_credits'), array('class' => 'form-control')) }}
            </div>
            
            <h1><small>Personal Information:</small></h1>
            
            <div class="form-group">
                {{ Form::label('comapny_name', 'Company Name') }}
                {{ Form::text('company_name', Input::old('company_name'), array('class' => 'form-control')) }}
            </div>

            <div class="form-group">
                {{ Form::label('contact_person', 'Contact Person') }}
                {{ Form::text('contact_person', Input::old('contact_person'), array('class' => 'form-control')) }}
            </div>

            <div class="form-group">
                {{ Form::label('comapny_mobile', 'Company Mobile') }}
                {{ Form::text('company_mobile', Input::old('company_mobile'), array('class' => 'form-control')) }}
            </div>

            <div class="form-group">
                {{ Form::label('company_email', 'Company Email') }}
                {{ Form::email('company_email', Input::old('company_email'), array('class' => 'form-control')) }}
            </div>

            <h1><small>Gateway Delivery Information:</small></h1>

            <div class="form-group">
                {{ Form::label('delivery_url', 'Delivery Url') }}
                {{ Form::text('delivery_base_url', Input::old('delivery_base_url'), array('class' => 'form-control')) }}
            </div>

            <div class="form-group">
                {{ Form::label('Uid', 'UID') }}
                {{ Form::text('uid', Input::old('uid'), array('class' => 'form-control')) }}
            </div>

            <div class="form-group">
                {{ Form::label('message_id', 'Message Id') }}
                {{ Form::text('message_id', Input::old('message_id'), array('class' => 'form-control')) }}
            </div>
            
            <div class="form-group">
                {{ Form::label('api_key', ' Delivery API Key') }}
                {{ Form::text('delivery_api_key', Input::old('delivery_api_key'), array('class' => 'form-control')) }}
            </div>

            <div class="form-group">
                {{ Form::label('delivery_user name', 'Delivery User Name') }}
                {{ Form::text('delivery_username', Input::old('delivery_username'), array('class' => 'form-control')) }}
            </div>

            <div class="form-group">
                {{ Form::label('delivery_password', 'Password') }}
                {{ Form::password('delivery_password', Input::old('delivery_password'), array('class' => 'form-control')) }}
            </div>
            
            <div class="form-group">
                {{ Form::label('delivery_api_required', 'Required For Delivery') }}
                {{ Form::select('delivery_api_required',array(''=>'Select' ,'0'=>'Username / Password','1'=>'Api Key'), Input::old('delivery_api_required'), array('class' => 'form-control')) }}
            </div>

            {{ Form::submit('Save', array('class' => 'btn btn-primary')) }}

            {{ Form::close() }}

        </div>
    </body>
</html>