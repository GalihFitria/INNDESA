@component('mail::message')
{{-- ✅ Logo INNDESA --}}
<img src="{{ asset('images/logo.png') }}" alt="INNDESA" style="max-width: 180px; margin: 20px auto; display:block;">

{{-- ✅ Greeting --}}
# Halo!

{{-- ✅ Pesan Utama --}}
Anda menerima email ini karena kami menerima permintaan untuk **mengatur ulang kata sandi** akun Anda.

{{-- ✅ Tombol Reset Password (Center) --}}
<div style="text-align: center; margin: 20px 0;">
    @component('mail::button', ['url' => $actionUrl, 'color' => 'success'])
    Atur Ulang Kata Sandi
    @endcomponent
</div>

{{-- ✅ Catatan Expire --}}
Tautan ini akan kedaluwarsa dalam **{{ config('auth.passwords.'.config('auth.defaults.passwords').'.expire') }} menit**.

Jika Anda tidak meminta pengaturan ulang kata sandi, abaikan email ini.

{{-- ✅ Penutup --}}
Terima kasih,<br>
**INNDESA**
@endcomponent
