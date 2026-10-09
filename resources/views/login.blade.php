<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | KopiPeteh</title>
    <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    @vite(['resources/css/login.css'])
</head>
<body>
    <main class="login-container">
        <div class="login-image">
            <div class="image-caption">
                <h1>
                    “START YOUR DAY
                </h1>
                <h1>
                    WITH COFFEE"
                </h1>
            </div>
        </div>

        <div class="login-form-section">
            <div class="login-content">

                <div class="logo">
                    <img
                        src="{{ asset('images/logo1.png') }}"
                        alt="KopiPeteh Logo">
                </div>

                <div class="welcome">
                    <h2>Welcome Back!</h2>
                    <p>Login to continue your KopiPeteh experience.</p>
                </div>

                <form action="{{ route('login') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label>Username</label>

                        <div class="input-box">
                            <input
                                type="text"
                                name="username"
                                value="{{ old('username') }}"
                                placeholder="Enter username..."
                                autofocus>

                            <i class="fa-solid fa-user"></i>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Password</label>

                        <div class="input-box">
                            <input
                                type="password"
                                name="password"
                                placeholder="Enter password...">

                            <i class="fa-solid fa-lock"></i>
                        </div>
                    </div>

                    @if ($errors->any())
                        <div style="color: red; font-size: 12px;">
                            <span>{{ $errors->first() }}</span>
                        </div>
                    @endif

                    <button type="submit" class="login-btn">
                        Login
                    </button>
                </form>
            </div>
        </div>
    </main>
</body>
</html>