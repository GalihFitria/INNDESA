<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
     <link rel="icon" type="image/png" href="{{ asset('images/logo.png') }}">
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
        
/* ✅ PRELOADER */
        #preloader {
            position: fixed;
            top: 0; left: 0;
            width: 100%; height: 100%;
            background: rgba(255, 255, 255, 255);
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 9999;
            transition: opacity 0.5s ease;
        }
        #preloader.fade-out {
            opacity: 0;
            pointer-events: none;
        }
        .logo-loading {
            width: 120px;
            animation: spin 2s linear infinite;
        }
        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
        .alert-success {
    background-color: #d4edda;
    color: #155724;
    border: 1px solid #c3e6cb;
    padding: 10px 12px;
    border-radius: 6px;
    font-size: 0.9em;
    margin-bottom: 15px;
}
.alert-error {
    background-color: #f8d7da;
    color: #721c24;
    border: 1px solid #f5c6cb;
    padding: 10px 12px;
    border-radius: 6px;
    font-size: 0.9em;
    margin-bottom: 15px;
}



    </style>
</head>

<body>
    <!-- ✅ PRELOADER -->
    <div id="preloader">
        <img src="{{ asset('images/logo.png') }}" alt="Logo Website" class="logo-loading">
    </div>
    <script>
        window.addEventListener("load", function() {
            let preloader = document.getElementById("preloader");
            preloader.classList.add("fade-out");
            setTimeout(() => preloader.style.display = "none", 500);
        });
    </script>
    <div class="reset-box">
        {{-- ✅ Logo --}}
        <img src="{{ asset('images/logo.png') }}" alt="Logo">

        <h2>Lupa Kata Sandi</h2>
        <p>Masukkan Email Anda Untuk Ubah Kata Sandi</p>

        {{-- ✅ Notifikasi sukses --}}
@if (session('status'))
    <div class="alert-success" id="alert-box">
        {{ session('status') }}
    </div>
@endif


        {{-- ❌ Notifikasi error --}}
@if ($errors->any())
    <div class="alert-error" id="alert-box">
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