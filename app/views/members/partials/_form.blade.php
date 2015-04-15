    <div class="form-group">
        {{ Form::label('first_name', 'First Name') }}
        {{ Form::text('first_name', null, array('class' => 'form-control', 'placeholder' => 'Enter First Name')) }}
        {{ $errors->first('first_name', '<span class="error">:message</span>')}}
    </div>
    <div class="form-group">
        {{ Form::label('last_name', 'Last Name') }}
        {{ Form::text('last_name', null, array('class' => 'form-control', 'placeholder' => 'Enter Last Name')) }}
        {{ $errors->first('last_name', '<span class="error">:message</span>')}}
    </div>
    <div class="form-group">
        {{ Form::label('email', 'Email') }}
        {{ Form::email('email', null, array('class' => 'form-control', 'placeholder' => 'Enter Email')) }}
        {{ $errors->first('email', '<span class="error">:message</span>')}}
    </div>
    <div class="form-group">
        {{ Form::label('password', 'Password') }}
        {{ Form::password('password', array('class' => 'form-control', 'placeholder' => 'Enter Password')) }}
        {{ $errors->first('password', '<span class="error">:message</span>')}}
    </div>
    <div class="form-group">
        {{ Form::label('confirm_password', 'Confirm Password') }}
        {{ Form::password('confirm_password', array('class' => 'form-control', 'placeholder' => 'Confirm Password')) }}
        {{ $errors->first('confirm_password', '<span class="error">:message</span>')}}
    </div>
    <div class="form-group">
        {{ Form::label('title', 'Title') }}
        {{ Form::text('title', null, array('class' => 'form-control', 'placeholder' => 'Enter Title')) }}
        {{ $errors->first('title', '<span class="error">:message</span>')}}
    </div>
    <div>
        {{ Form::submit(isset($buttonText) ? $buttonText : 'Sign Up', array('class' => 'btn btn-default form-control')) }}
        <a class='btn btn-danger' href={{ URL::previous() }}>Cancel</a>
    </div>

