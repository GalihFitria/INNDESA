<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Pengunjung</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <!-- ✅ Tambah FontAwesome biar icon mata muncul -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  
    <style>
    body {
    display: flex;
    justify-content: center;
    align-items: center;   /* ✅ ini yang bikin pas di tengah */
    height: 100vh;         /* ✅ penuh 1 layar */
    margin: 0;
    font-family: Arial, sans-serif;
    background-color: #f9f9f9;
    overflow: hidden;      /* ✅ biar nggak ada scroll */
    padding: 0;            /* ✅ buang padding biar nggak ngedorong ke bawah */
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

    .register-box {
        background: white;
        padding: 50px 80px;
        border-radius: 20px;
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
        width: 350px;
        max-height: 60vh;
        display: flex;
        flex-direction: column;
        overflow-y: auto;
        overflow-x: hidden;
    }

    .register-box img {
        width: 100px;
        margin: 0 auto 20px;
    }

    .register-box h2 {
        color: #1ca1e0;
        font-size: 24px;
        margin-bottom: 10px;
        text-align: center;
    }

    .register-box p {
        font-size: 14px;
        color: #555;
        margin-bottom: 20px;
        text-align: center;
    }

    .form-group {
        text-align: left;
        margin-bottom: 15px;
        position: relative; /* ✅ supaya icon bisa di kanan input */
    }

    label {
        display: block;
        margin-bottom: 6px;
        font-weight: bold;
    }

    input[type="text"],
    input[type="password"],
    input[type="email"],
    select {
        width: 100%;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 6px;
        font-size: 14px;
        box-sizing: border-box;
    }

    /* ✅ Tambah styling untuk icon mata */
    .toggle-password {
        position: absolute;
        right: 10px;
        top: 35px;
        cursor: pointer;
        color: #888;
    }

    .submit-btn {
        width: 100%;
        padding: 10px;
        background-color: #1ca1e0;
        border: none;
        color: white;
        font-weight: bold;
        border-radius: 6px;
        cursor: pointer;
        margin-top: 10px;
        font-size: 14px;
        box-sizing: border-box;
    }

    .login-link {
        display: block;
        margin-top: 10px;
        font-size: 14px;
        text-align: center;
    }

    .login-link a {
        color: #1ca1e0;
        text-decoration: none;
    }
    

     /* ✅ RESPONSIVE SUPER KECIL UNTUK HP */
@media (max-width: 768px) {
    body {
        display: flex;
        justify-content: center;
        align-items: center;
        padding: 0;
        margin: 0;
        height: 100vh;
        background-color: #f9f9f9;
        overflow: hidden;
    }

    .register-box {
        width: 60%;           /* ✅ Lebih kecil lagi */
        max-width: 400px;     /* ✅ Lebih ramping */
        padding: 20px 20px;    /* ✅ Lebih sempit */
        max-height: 45vh;
        overflow-y: auto;
        border-radius: 12px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
    }

    .register-box img {
        width: 40px;          /* ✅ Logo makin kecil */
        margin-bottom: 4px;
    }

    .register-box h2 {
        font-size: 14px;      /* ✅ Heading lebih kecil */
        margin-bottom: 4px;
    }

    .register-box p {
        font-size: 10px;
        margin-bottom: 8px;
    }

    label {
        font-size: 11px;
    }

    input[type="text"],
    input[type="password"],
    input[type="email"],
    select {
        font-size: 10px;      /* ✅ Input lebih kecil */
        padding: 6px 8px;
    }

    .submit-btn {
        font-size: 11px;
        padding: 5px;
    }

    .login-link {
        font-size: 10px;
    }
    

}
@media (max-width: 7568px) {
    .input-with-icon input {
        padding-right: 28px;
    }

   .input-with-icon {
    position: relative;
}

.input-with-icon input {
    width: 100%;
    padding-right: 35px; /* ✅ ruang buat icon mata */
    box-sizing: border-box;
}

.input-with-icon .toggle-password {
    position: absolute;
    right: 10px;
    top: 50%;
    transform: translateY(-50%);
    font-size: 14px;
    cursor: pointer;
    color: #888;
}



}

    </style>
</head>
<body>

    <div class="register-box">
        <img src="{{ asset('images/logo.png') }}" alt="Logo">
        <h2>REGISTER</h2>
        <p>Silakan isi data dengan benar!</p>

        {{-- Popup error --}}
        @if(session('error'))
        <script>
            alert("{{ session('error') }}");
        </script>
        @endif

        <form method="POST" action="{{ route('register.store') }}">
            @csrf

            <div class="form-group">
                <label>Pilih Kelompok</label>
                <select name="id_kelompok" required>
                    <option value="">-- Pilih Kelompok --</option>
                    @foreach($kelompok as $k)
                        <option value="{{ $k->id_kelompok }}">{{ $k->nama }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label>Nama Pengguna</label>
                <input type="text" name="username" value="">
            </div>

            <div class="form-group password-wrapper">
    <label>Kata Sandi</label>
    <div class="input-with-icon">
        <input type="password" id="password" name="password">
        <i class="fa-solid fa-eye toggle-password" onclick="togglePassword()" id="eyeIcon"></i>
    </div>
</div>


            <div class="form-group">
                <label>Nomor Telepon</label>
                <input type="text" name="no_telp" value="{{ old('no_telp') }}" required>
            </div>

            <div class="form-group">
                <label>Instagram</label>
                <input type="text" name="ig" value="{{ old('ig') }}">
            </div>

            <div class="form-group">
                <label>Facebook</label>
                <input type="text" name="facebook" value="{{ old('facebook') }}">
            </div>

            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" value="{{ old('email') }}">
            </div>

            <button type="submit" class="submit-btn">Sign Up</button>
          

            <div class="login-link">
                Sudah punya akun? <a href="{{ route('admin_login.index') }}">Login Sekarang</a>
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
