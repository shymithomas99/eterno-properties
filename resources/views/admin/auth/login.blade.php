<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta property="og:image" content="{{ asset('img/logo.png') }}">
    <meta property="og:site_name" content="">
    <title>Login | Admin | {{ config('app.name', 'Laravel') }}</title>
    <link
        href="https://fonts.googleapis.com/css2?family=Libre+Baskerville:ital,wght@0,400;0,700;1,400&family=Inter:wght@300;400;500;600&display=swap"
        rel="stylesheet">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('img/favicon-16x16.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('img/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="48x48" href="{{ asset('img/favicon-48x48.png') }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('img/apple-touch-icon.png') }}">
    <style>
        /* ── Reset & Page ─────────────────────────────────── */
        *,
        *::before,
        *::after {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            padding: 0;
            font-family: 'Inter', sans-serif;
        }

        .auth-wrapper {
            display: flex;
            min-height: 100vh;
            width: 100%;
        }

        /* ── Left Panel (Brand / Image) ───────────────────── */
        .auth-left {
            width: 50%;
            background: #8e734b;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            padding: 60px 55px;
            position: relative;
            overflow: hidden;
        }

        /* Decorative curved arcs */
        .auth-left::before {
            content: '';
            position: absolute;
            top: -120px;
            right: -180px;
            width: 520px;
            height: 520px;
            border: 1.5px solid rgba(255, 255, 255, 0.10);
            border-radius: 50%;
            pointer-events: none;
        }

        .auth-left::after {
            content: '';
            position: absolute;
            top: -60px;
            right: -120px;
            width: 400px;
            height: 400px;
            border: 1.5px solid rgba(255, 255, 255, 0.08);
            border-radius: 50%;
            pointer-events: none;
        }

        .auth-arc-3 {
            position: absolute;
            top: 0px;
            right: -60px;
            width: 280px;
            height: 280px;
            border: 1.5px solid rgba(255, 255, 255, 0.06);
            border-radius: 50%;
            pointer-events: none;
        }

        .auth-left-content {
            position: relative;
            z-index: 2;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            height: 100%;

        }

        .auth-logo-icon {
            margin-bottom: 26px;
        }

        .auth-hello {
            font-size: 26px;
            font-family: 'Libre Baskerville', serif;
            font-weight: 500;
            color: #fff;
            line-height: 1.5;
            margin: 0 0 28px 0;
            text-align: center;
        }

        .auth-desc {
            font-size: 16px;
            color: rgba(255, 255, 255, 0.82);
            line-height: 1.75;
            max-width: 552px;
            margin: 0;
            text-align: center;
        }

        .auth-copyright {
            position: relative;
            z-index: 2;
            font-size: 13px;
            color: rgba(255, 255, 255, 0.55);
            margin: 0;
            text-align: center;
        }

        /* ── Right Panel (Form) ───────────────────────────── */
        .auth-right {
            width: 50%;
            background: #ffffff;
            display: flex;
            flex-direction: column;
            justify-content: center;
            padding: clamp(80px, 12vw, 203px);
        }

        .auth-brand {
            font-size: 21px;
            font-weight: 700;
            color: #111;
            margin-bottom: 52px;
            letter-spacing: -0.3px;
        }

        .auth-welcome {
            font-size: 27px;
            font-weight: 700;
            color: #111;
            margin: 0 0 24px 0;
            letter-spacing: -0.5px;
        }

        .auth-subtext {
            font-size: 13.5px;
            color: #888;
            margin: 0 0 36px 0;
            line-height: 1.65;
        }

        .auth-subtext a {
            color: #111;
            font-weight: 600;
            text-decoration: underline;
        }

        .auth-subtext a:hover {
            color: #4f46e5;
        }

        /* ── Form Fields ──────────────────────────────────── */
        .auth-field {
            margin-bottom: 22px;
        }

        .auth-input {
            width: 100%;
            padding: 13px 0;
            border: none;
            border-bottom: 1.5px solid #ddd;
            font-size: 14.5px;
            color: #222;
            background: transparent;
            outline: none;
            transition: border-color 0.25s ease;
            border-radius: 0;
        }

        .auth-input::placeholder {
            color: #aaa;
        }

        .auth-input:focus {
            border-bottom-color: #8e734b;
        }

        .auth-input.is-invalid {
            border-bottom-color: #dc3545;
        }

        .auth-error {
            display: block;
            color: #dc3545;
            font-size: 12.5px;
            margin-top: 6px;
        }

        /* Remember-me row */
        .auth-remember-row {
            display: flex;
            align-items: center;
            gap: 8px;
            margin-bottom: 26px;
        }

        .auth-remember-row input[type="checkbox"] {
            width: 15px;
            height: 15px;
            accent-color: #8e734b;
            cursor: pointer;
            margin: 0;
        }

        .auth-remember-row label {
            font-size: 13.5px;
            color: #555;
            cursor: pointer;
            margin: 0;
            user-select: none;
        }

        /* ── Buttons ──────────────────────────────────────── */
        .btn-login {
            width: 100%;
            padding: 14px;
            background: #8e734b;
            color: #fff;
            border: none;
            border-radius: 8px;
            font-size: 15px;
            font-weight: 600;
            cursor: pointer;
            margin-bottom: 14px;
            transition: background 0.2s ease;
            letter-spacing: 0.2px;
        }

        .btn-login:hover {
            background: #333;
        }

        .btn-google {
            width: 100%;
            padding: 13px;
            background: #fff;
            color: #333;
            border: 1.5px solid #e0e0e0;
            border-radius: 8px;
            font-size: 14.5px;
            font-weight: 500;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            margin-bottom: 22px;
            transition: border-color 0.2s ease, background 0.2s ease;
        }

        .btn-google:hover {
            border-color: #bbb;
            background: #fafafa;
        }

        .btn-google svg {
            width: 19px;
            height: 19px;
            flex-shrink: 0;
        }

        /* Forgot password */
        .auth-forgot {
            text-align: center;
            font-size: 13.5px;
            color: #888;
        }

        .auth-forgot a {
            color: #111;
            font-weight: 700;
            text-decoration: underline;
            margin-left: 4px;
        }

        .auth-forgot a:hover {
            color: #4f46e5;
        }

        /* ── Responsive ───────────────────────────────────── */
        @media (max-width: 992px) {
            .auth-left {
                padding: 48px 40px;
            }

            .auth-right {
                padding: 48px 44px;
            }

            .auth-hello {
                margin: 0 0 13px 0;
            }

            .auth-logo-icon img {
                max-width: 150px;
            }

        }

        @media (max-width: 768px) {



            .auth-wrapper {
                flex-direction: column;
            }

            .auth-left,
            .auth-right {
                width: 100%;
            }

            .auth-left {
                padding: 44px 32px 36px;
                min-height: auto;
            }

            .auth-hello {
                font-size: 34px;
                margin-bottom: 18px;
            }

            .auth-logo-icon {
                font-size: 40px;
                margin-bottom: 24px;
            }

            .auth-desc {
                font-size: 14px;
                max-width: 100%;
            }

            .auth-right {
                padding: 36px 28px 44px;
            }

            .auth-brand {
                margin-bottom: 32px;
            }
        }

        @media (max-width: 480px) {
            .auth-left {
                padding: 32px 22px 28px;
            }

            .auth-right {
                padding: 28px 20px 36px;
            }

            .auth-hello {
                font-size: 28px;
            }

            .auth-welcome {
                font-size: 22px;
            }
        }
    </style>
</head>

<body>

    <div class="auth-wrapper">

        <!-- ══ LEFT PANEL ══════════════════════════════════ -->
        <div class="auth-left">
            <div class="auth-arc-3"></div>

            <div class="auth-left-content">
                <!-- Star / asterisk logo -->
                <span class="auth-logo-icon">
                    <img src="{{ asset('img/login-logo.png') }}" alt="">
                </span>

                <h1 class="auth-hello">An Invitation to a New World</h1>

                <p class="auth-desc">
                    Welcome to the Eterno Resort Admin Portal. Your central space to manage operations, guest
                    experiences, and resort services with ease.
                </p>
            </div>

            <p class="auth-copyright">© {{ date('Y') }} {{ config('app.name', 'Laravel') }}. All Rights Reserved.</p>
        </div>

        <!-- ══ RIGHT PANEL ═════════════════════════════════ -->
        <div class="auth-right">

            <h2 class="auth-welcome">Welcome Admin!</h2>

            <!-- Login form -->
            <form method="POST" action="{{ route('admin.login') }}">
                @csrf
                <!-- Email -->
                <div class="auth-field">
                    <input id="email" type="text" class="auth-input @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" placeholder="Email Address"
                        autocomplete="email" autofocus>
                    @error('email')
                        <span class="auth-error" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <!-- Password -->
                <div class="auth-field">
                    <input id="password" type="password" class="auth-input @error('password') is-invalid @enderror" name="password" placeholder="Password"
                        autocomplete="current-password">
                    @error('password')
                        <span class="auth-error" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <!-- Remember Me -->
                <div class="auth-remember-row">
                    <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                    <label for="remember">Remember Me</label>
                </div>

                <!-- Submit -->
                <button type="submit" class="btn-login">Login</button>
            </form>
        </div>

    </div>

</body>

</html>