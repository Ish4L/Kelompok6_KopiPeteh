<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil - KopiPeteh</title>
    <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.3.1/css/all.min.css">
    @vite(['resources/css/styleadmin.css', 'resources/js/app.js'])
</head>
<body>
    <div class="wrapper">
        <x-sidebar />

        <div class="content profile-content">
            <form action="{{ route('profile.update') }}" method="POST" class="form-card">
                @csrf
                @method('PUT')
                <h3>Profil</h3>
                <div class="input-box">
                    <div class="field">
                        <label>Nama</label>
                        <input type="text" name="name" value="{{ old('name', $admin->name) }}" placeholder="Masukkan nama">
                    </div>
                    <div class="field">
                        <label>Username</label>
                        <input type="text" name="username" value="{{ old('username', $admin->username) }}" placeholder="Masukkan username">
                    </div>
                </div>
                <div class="input-box">
                    <div class="field">
                        <label>Email</label>
                        <input type="email" name="email" value="{{ old('email', $admin->email) }}" placeholder="Masukkan email">
                    </div>
                    <div class="field">
                        <label>No. Telp</label>
                        <input type="text" name="phone" value="{{ old('phone', $admin->phone) }}" placeholder="Masukkan No. telepon">
                    </div>
                </div>

                <div style="display: flex; align-items:center; gap: 10px;">
                    <button type="submit" class="btn-profile" onclick="return confirm('Konfirmasi ubah profil?')">Simpan</button>
                    @if (session('success_profile'))
                        <span style="color: lime; font-size: 12px">{{ session('success_profile') }}</span>
                    @elseif ($errors->profile->any())
                        <span style="color: red; font-size: 12px;">{{ $errors->profile->first() }}</span>
                    @endif
                </div>
            </form>

            <form action="{{ route('profile.password') }}" method="POST" class="form-card">
                @csrf
                @method('PUT')
                <h3>Ganti Password</h3>
                <div class="input-box">
                    <div class="field">
                        <label>Password Baru</label>
                        <div class="input-box">
                            <input type="password" name="password" id="password" placeholder="Masukkan password">
                            <button type="button" class="toggle-password" onclick="togglePassword('password', this)">
                                <i class="icon-eye fa-solid fa-eye"></i>
                                <i class="icon-eye-off fa-solid fa-eye-slash" style="display: none;"></i>
                            </button>
                        </div>
                    </div>
                    <div class="field">
                        <label>Konfirmasi Password</label>
                        <div class="input-box">
                            <input type="password" name="password_confirmation" id="password_confirmation" placeholder="Konfirmasi password">
                            <button type="button" class="toggle-password" onclick="togglePassword('password_confirmation', this)">
                                <i class="icon-eye fa-solid fa-eye"></i>
                                <i class="icon-eye-off fa-solid fa-eye-slash"style="display: none;"></i>
                            </button>
                        </div>
                    </div>
                </div>
                
                <div style="display: flex; align-items:center; gap: 10px;">
                    <button type="submit" class="btn-profile" onclick="return confirm('Konfirmasi ubah password?')">Simpan</button>
                    @if (session('success_password'))
                        <div style="color: lime; font-size: 12px">{{ session('success_password') }}</div>
                    @elseif ($errors->password->any())
                        <span style="color: red; font-size: 12px;">{{ $errors->password->first() }}</span>
                    @endif
                </div>
            </form>
        </div>
    </div>
</body>