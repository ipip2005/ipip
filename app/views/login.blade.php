<div class="col-xs-12">
        {{ Form::open(array('url' => 'login')) }}
        <fieldset>
            <legend>Login</legend>
            {{ Form::label('username','Username') }}
            {{ Form::text('username',Input::old('username'),['placeholder'=>'Your account here']) }}
            {{ Form::label('password','Password') }}
            {{ Form::password('password',['placeholder'=>'Password here']) }}
            {{ Form::submit('Login',['class'=>'button tiny radius']) }}
        </fieldset>
        {{ Form::close() }}
        @if($errors->has())
            @foreach ($errors->all() as $message)
            	<div class="row margin-5">
                	<span class="btn-lg bg-warning">{{$message}}</span><br><br>
                </div>
            @endforeach
        @endif
        @if(Session::has('failure'))
            <span class="label alert round">{{Session::get('failure')}}</span>
        @endif
</div>

