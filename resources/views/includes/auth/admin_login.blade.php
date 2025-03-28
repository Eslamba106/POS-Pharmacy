<div class="form-group">
    <input id="email" type="text" style="font-size: 20px"
        class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
        name="email" value="{{ old('email') }}" required autofocus
        placeholder="{{ __('login.enter_your_email_or_username') }}">
    @if ($errors->has('email'))
        <span class="invalid-feedback" role="alert">
            <strong>{{ $errors->first('email') }}</strong>
        </span>
    @endif
</div>
<div class="form-group">
    <input id="password" type="password" style="font-size: 20px"
        class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}"
        name="password" required placeholder="{{ __('login.enter_your_password') }}">
    @if ($errors->has('password'))
        <span class="invalid-feedback" role="alert">
            <strong>{{ $errors->first('password') }}</strong>
        </span>
    @endif
</div>
 
<button type="submit" class="btn btn-primary btn-lg btn-block">
    {{ __('login.login') }}
</button>