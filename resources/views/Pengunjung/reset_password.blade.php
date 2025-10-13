<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
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
        padding: 40px 40px; /* <-- padding dikurangi */
        border-radius: 10px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        width: 300px; /* <-- lebar dikecilkan dari 350px */
        text-align: center;
    }

        /* Form dan ukuran field & button */
        .reset-box form {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .reset-box input[type="email"],
.reset-box input[type="password"],
.reset-box input[type="text"],
.reset-box button {
    width: 100%; /* semua sama persis */
}



        .reset-box h2 {
            color: #1ca1e0;
            margin-bottom: 20px;
        }

        input[type="email"],
input[type="password"],
input[type="text"] {
    width: 100%;
    padding: 10px;
    margin-bottom: 15px;
    border: 1px solid #ccc;
    border-radius: 6px;
    font-family: inherit; /* biar font tetap sama */
    height: 40px; /* samain tinggi */
    box-sizing: border-box;
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

        /* Hilangkan tombol show password bawaan browser */
input::-ms-reveal,
input::-ms-clear {
    display: none !important;
}
input::-webkit-credentials-auto-fill-button,
input::-webkit-password-toggle-button {
    display: none !important;
}

        /* Tambahan untuk icon toggle */
        .password-wrapper {
    position: relative;
    width: 100%; /* samain dengan tombol */
    margin-bottom: 15px;
}

.password-wrapper input {
    width: 100%;
    padding-right: 40px; /* ruang buat icon */
    margin-bottom: 0;
    box-sizing: border-box; /* penting biar lebar tetap sama */
}
.password-wrapper input[type="text"],
.password-wrapper input[type="password"] {
    font-family: inherit; /* biar font sama */
    height: 40px; /* samain tinggi */
    line-height: normal;
}

        .toggle-password {
    position: absolute;
    right: 10px;
    top: 50%;
    transform: translateY(-50%);
    font-size: 16px;
    color: #666;
    cursor: pointer;
    pointer-events: all;
}


        button {
            display: block;
            width: 80%;
            margin: 0 auto;
            padding: 10px;
            background: #1ca1e0;
            border: none;
            color: white;
            border-radius: 6px;
            font-weight: bold;
            cursor: pointer;
        }

        .alert-error {
            background-color: #ffe5e5;
            color: #e63946;
            padding: 8px;
            border-radius: 6px;
            margin-bottom: 10px;
            font-size: 0.9em;
            text-align: left;
        }

        .alert-success {
            background-color: #d4edda;
            color: #155724;
            padding: 8px;
            border-radius: 6px;
            margin-bottom: 10px;
            font-size: 0.9em;
            text-align: center;
        }


        /* ✅ Responsive untuk layar kecil */
@media (max-width: 480px) {
    body {
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .reset-box {
        transform: scale(0.8); /* bisa atur 0.7 - 0.9 sesuai selera */
        transform-origin: center center;
        margin: 0 auto;
    }
}

    </style>
</head>
<body>
    <div class="reset-box">
           <img src="{{ asset('images/logo.png') }}" alt="Logo" style="width:80px; margin-bottom:15px;">
        <h2>Reset Password</h2>
        <p>Masukkan kata sandi baru Anda</p>

        {{-- Notifikasi sukses --}}
        @if (session('status'))
            <div id="alert-box" class="alert-success">
                {{ session('status') }}
            </div>
        @endif

        {{-- Notifikasi error --}}
        @if ($errors->any())
            <div id="alert-box" class="alert-error">
                <ul style="list-style: none; padding-left: 0; margin: 0;">
                    @foreach ($errors->all() as $error)
                        <li>• {{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
       
        <form method="POST" action="{{ route('password.update') }}">
            @csrf
            <input type="hidden" name="token" value="{{ $token }}">

            <div class="password-wrapper">
    <input type="email" name="email" placeholder="Masukkan email" value="{{ old('email') }}" required>
</div>

<div class="password-wrapper">
    <input type="password" name="password" id="password" placeholder="Kata sandi baru" required>
    <i class="fa-solid fa-eye toggle-password" onclick="togglePassword('password', this)"></i>
</div>

<div class="password-wrapper">
    <input type="password" name="password_confirmation" id="password_confirmation" placeholder="Konfirmasi kata sandi" required>
    <i class="fa-solid fa-eye toggle-password" onclick="togglePassword('password_confirmation', this)"></i>
</div>


            <button type="submit">Reset Password</button>
        </form>
    </div>

    <script>
        function togglePassword(id, icon) {
            const input = document.getElementById(id);
            if (input.type === "password") {
                input.type = "text";
                icon.classList.remove("fa-eye");
                icon.classList.add("fa-eye-slash");
            } else {
                input.type = "password";
                icon.classList.remove("fa-eye-slash");
                icon.classList.add("fa-eye");
            }
        }

        // Auto-hide notifikasi setelah 5 detik
        setTimeout(() => {
            const alertBox = document.getElementById('alert-box');
            if (alertBox) {
                alertBox.style.transition = "opacity 0.5s ease";
                alertBox.style.opacity = "0";
                setTimeout(() => alertBox.remove(), 500);
            }
        }, 5000);
    </script>
</body>
</html>
