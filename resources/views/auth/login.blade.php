<!doctype html>
<html lang="en"> 
<head> 
    <meta charset="UTF-8"> 
    <title>Login Form</title> 
    <link rel="stylesheet" href="{{ asset('css/login_style.css') }}"> 
</head> 
<body>
    <section> 
        <div class="signin"> 
            <div class="content"> 
                <h2>Sign In</h2> 
                <div class="form"> 
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="inputBox"> 
                            <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="Username" autofocus>
                            @error('email')
                            <div class="error-message">
                                <strong>{{ $message }}</strong>
                            </div>
                            @enderror
                        </div> 
                        <div class="inputBox"> 
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="Password">
                            @error('password')
                            <div class="error-message">
                                <strong>{{ $message }}</strong>
                            </div>
                            @enderror
                        </div> 
                        <div class="links"> 
                            <a href="password/reset">Forgot Password</a> 
                            <a href="/register">Signup</a> 
                        </div> 
                        <div class="inputBox"> 
                            <input type="submit" style="color:#ffffff" value="Login"> 
                        </div> 
                    </form>
                </div> 
            </div> 
        </div> 
    </section>
</body>
</html>
