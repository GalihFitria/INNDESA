<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lupa Password</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <style>
        * {
            box-sizing: border-box;
        }

        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
        }

        .reset-box {
            background: white;
            padding: 40px 50px;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            width: 500px;
            text-align: center;
        }

        .reset-box img {
            width: 90px;
            /* ukuran logo */
            margin-bottom: 15px;
        }

        .reset-box h2 {
            color: #1ca1e0;
            margin-bottom: 10px;
        }

        .form-control {
            margin: 0 auto;
            width: 100%;
        }

        input[type="email"],
        button {
            width: 100%;
            display: block;
            padding: 10px;
            border-radius: 6px;
            font-size: 14px;
        }

        input[type="email"] {
            margin-bottom: 12px;
            border: 1px solid #ccc;
        }

        button {
            background: #1ca1e0;
            border: none;
            color: white;
            font-weight: bold;
            cursor: pointer;
        }

        .back-link {
            display: block;
            margin-top: 10px;
            font-size: 13px;
            color: #1ca1e0;
            text-decoration: none;
            transition: color 0.2s;
        }

        .back-link:hover {
            color: #1178b3;
            text-decoration: underline;
        }

        @media (max-width: 768px) {
            .reset-box {
                transform: scale(0.85);
                transform-origin: center center;
                margin: 0 auto;
            }
        }

        @media (max-width: 480px) {
            .reset-box {
                transform: scale(0.7);
                transform-origin: center center;
                margin: 0 auto;
            }
        }
    </style>
</head>

<body>
    <div class="reset-box">
        {{-- ✅ Logo --}}
        <img src="{{ asset('images/logo.png') }}" alt="Logo">

        <h2>Lupa Kata Sandi</h2>
        <p>Masukkan Email Anda Untuk Kata Sandi</p>

        {{-- ✅ Notifikasi sukses --}}
        @if (session('status'))
        <div class="alert alert-success" id="alert-box">
            {{ session('status') }}
        </div>
        @endif

        {{-- ❌ Notifikasi error --}}
        @if ($errors->any())
        <div class="alert alert-error" id="alert-box">
            {{ $errors->first() }}
        </div>
        @endif

        <form method="POST" action="{{ route('lupa_password_email') }}">
            @csrf
            <div class="form-control">
                <input type="email" name="email" placeholder="Masukkan email" required>
            </div>
            <div class="form-control">
                <button type="submit">Kirim Link Reset</button>
            </div>
        </form>

        <a href="{{ url('/admin_login') }}" class="back-link">Kembali ke Login</a>
    </div>

    <script>
        // Auto hilangkan alert setelah 3 detik
        setTimeout(() => {
            const alertBox = document.getElementById('alert-box');
            if (alertBox) {
                alertBox.style.transition = 'opacity 0.5s';
                alertBox.style.opacity = '0';
                setTimeout(() => alertBox.remove(), 500);
            }
        }, 3000);
    </script>
</body>

</html>