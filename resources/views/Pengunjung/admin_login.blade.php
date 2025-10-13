<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <meta charset="UTF-8">
      <link rel="icon" type="image/png" href="{{ asset('images/logo.png') }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <style>
        body {
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
    margin: 0;
    font-family: "Segoe UI", Arial, sans-serif;
    background: #ffffff; /* ✅ balik ke putih */
    padding: 0 10px;
    box-sizing: border-box;
}


    .login-box {
        background: white;
        padding: 40px 35px;
        border-radius: 20px; /* ✅ lebih rounded */
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.08);
        text-align: center;
        width: 360px;
        max-width: 100%;
        transition: transform 0.2s ease, box-shadow 0.2s ease;
    }

    /* .login-box:hover {
        transform: translateY(-3px);
        box-shadow: 0 12px 30px rgba(0, 0, 0, 0.12);
    } */

    .login-box img {
    width: 90px;
    margin-bottom: 15px;
    object-fit: contain;
    display: block;
    margin-left: auto;
    margin-right: auto;
}


    .login-box h2 {
        color: #1ca1e0;
        font-size: 26px;
        font-weight: bold;
        margin-bottom: 5px;
    }

    .login-box p {
        font-size: 14px;
        color: #555;
        margin-bottom: 25px;
    }

    .form-group {
        margin-bottom: 20px;
        text-align: left;
    }

    .form-label {
        font-weight: 600;
        font-size: 14px;
        margin-bottom: 5px;
        display: block;
    }

    .form-group input {
        width: 100%;
        padding: 12px 14px;
        border: 1px solid #ddd;
        border-radius: 10px; /* ✅ lebih soft */
        font-size: 14px;
        box-sizing: border-box;
        transition: border-color 0.2s, box-shadow 0.2s;
    }

    .form-group input:focus {
        border-color: #1ca1e0;
        box-shadow: 0 0 6px rgba(28, 161, 224, 0.3);
        outline: none;
    }

    .password-wrapper {
        position: relative;
    }

    .password-wrapper input {
        padding-right: 40px;
    }

    .toggle-password {
        position: absolute;
        right: 12px;
        top: 50%;
        transform: translateY(-50%);
        font-size: 16px;
        color: #777;
        cursor: pointer;
        transition: color 0.2s;
    }

    .toggle-password:hover {
        color: #1ca1e0;
    }

    .forgot-container {
        text-align: right;
        margin-top: 5px;
    }
    /* Hilangkan icon mata bawaan browser */
        input[type="password"]::-ms-reveal,
        input[type="password"]::-ms-clear {
            display: none;
        }
        input[type="password"]::-webkit-credentials-auto-fill-button,
        input[type="password"]::-webkit-password-toggle-button {
            display: none !important;
        }

    .forgot-link {
        font-size: 12px;
        color: #e63946;
        text-decoration: none;
    }

    .forgot-link:hover {
        text-decoration: underline;
    }

    .login-btn {
        width: 100%;
        padding: 12px;
        background: linear-gradient(135deg, #1ca1e0, #0077b6);
        border: none;
        color: white;
        font-weight: bold;
        font-size: 15px;
        border-radius: 12px;
        cursor: pointer;
        transition: background 0.3s ease, transform 0.1s ease;
    }

    .login-btn:hover {
        background: linear-gradient(135deg, #1d9ed6, #006494);
        transform: translateY(-1px);
    }

    .register-link {
        margin-top: 15px;
        font-size: 14px;
    }

    .register-link a {
        color: #1ca1e0;
        font-weight: 600;
        text-decoration: none;
    }
        .forgot-link:hover { text-decoration: underline; }

        /* ✅ RESPONSIVE UNTUK MOBILE & TABLET */
        /* ✅ Extra kecil untuk HP layar mungil */
  /* Default tetap seperti desktop kamu sekarang */

/* ✅ Responsive untuk layar kecil */
@media (max-width: 480px) {
    body {
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .login-box {
        transform: scale(0.7); /* atur kecilnya di sini (0.5 - 0.8 sesuai selera) */
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

    <div class="login-box">
        <img src="{{ asset('images/logo.png') }}" alt="Logo">
        <h2>LOGIN</h2>
        <p>Masukkan nama pengguna dan<br>kata sandi yang benar!</p>

        <form action="{{ route('admin_login.store') }}" method="POST">
            @csrf

            {{-- ✅ Notifikasi error / success --}}
            @if ($errors->any())
                <div style="background:#ffe6e6;color:#d8000c;padding:10px;margin-bottom:15px;border-radius:6px;">
                    @foreach ($errors->all() as $error)
                        <div>{{ $error }}</div>
                    @endforeach
                </div>
            @endif

            @if (session('success'))
                <div style="background:#e6ffed;color:#2f855a;padding:10px;margin-bottom:15px;border-radius:6px;">
                    {{ session('success') }}
                </div>
            @endif

            
            <div class="form-group">
                <label for="username" class="form-label">Nama Pengguna</label>
                <input type="text" id="username" name="username" required>
            </div>

            <div class="form-group">
                <label for="password" class="form-label">Kata Sandi</label>
                <div class="password-wrapper">
                    <input type="password" id="password" name="password" required>
                    <i class="fa-solid fa-eye toggle-password" onclick="togglePassword()" id="eyeIcon"></i>
                </div>
                <div class="forgot-container">
                    <a href="{{ route('lupa_password_form') }}" class="forgot-link">Lupa kata sandi?</a>
                </div>
            </div>

            <button type="submit" class="login-btn">Login</button>

            <div class="register-link">
                Belum punya akun? <a href="{{ route('register.create') }}">Daftar Sekarang</a>
            </div>
            <div class="register-link">
                <a href="{{ url('/') }}">Kembali ke Beranda</a>
            </div>
        </form>
    </div>

    <script>
        function togglePassword() {
            const input = document.getElementById("password");
            const eyeIcon = document.getElementById("eyeIcon");

            if (input.type === "password") {
                input.type = "text";
                eyeIcon.classList.remove("fa-eye");
                eyeIcon.classList.add("fa-eye-slash");
            } else {
                input.type = "password";
                eyeIcon.classList.remove("fa-eye-slash");
                eyeIcon.classList.add("fa-eye");
            }
        }
    </script>
</body>
</html>
