<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Plain Login Form</title>
    <link rel="stylesheet" href="{{ asset('css/login_style.css') }}">
</head>

<body>
    <section>
        <div class="signin">
            <div class="content">
                <h2>Sign Up</h2>
                <div class="form">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="inputBox">
                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" placeholder="enter name">
                            @error('name')
                            <div class="error-message">
                                <strong>{{ $message }}</strong>
                            </div>
                            @enderror
                        </div>

                        <div class="inputBox">
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="enter email address">
                            @error('email')
                            <div class="error-message">
                                <strong>{{ $message }}</strong>
                            </div>
                            @enderror
                        </div>

                        <div class="inputBox">
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" placeholder="create password">
                            @error('password')
                            <div class="error-message">
                                <strong>{{ $message }}</strong>
                            </div>
                            @enderror
                        </div>

                        <div class="inputBox">
                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password" placeholder="confirm password">
                        </div>

                        <div class="links">
                            <a href="/login">Already Signed Up?</a>
                            <a href="/login">SignIn</a>
                        </div>

                        <div class="inputBox">
                            <input type="submit" style="color:#ffffff" value="Register">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</body>

</html>