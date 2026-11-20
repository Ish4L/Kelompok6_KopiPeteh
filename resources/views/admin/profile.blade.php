<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil - KopiPeteh</title>
    <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.3.1/css/all.min.css">
    <!-- @vite(['resources/css/app.css']) -->
    @vite(['resources/css/styleadmin.css'])
</head>
<body>
    <div class="wrapper">
        <x-sidebar />

        <div class="content profile-content">
            
            <div class="identity-card">
                <h3>Profil</h3>
                <form action="" method="POST">
                    <div class="form-group">
                        <div class="field">
                            <label for="name">Nama</label>
                            <input type="text" id="name" name="name" value="" required>
                        </div>
                        <div class="field">
                            <label for="username">Username</label>
                            <input type="text" id="username" name="username" value="" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="field">
                            <label for="email">Email</label>
                            <input type="email" id="email" name="email" value="" required>
                        </div>
                        <div class="field">
                            <label for="nomor_telpon">No. Telp</label>
                            <input type="text" id="nomor_telpon" name="nomor_telpon" value="" required>
                        </div>
                    </div>

                    <button type="submit" class="btn-profile">Simpan</button>
                </form>
            </div>

            <div class="password-card">
                <h3>Ubah Password</h3>
                <form action="" method="POST">
                    <div class="form-group">
                        <div class="field">
                            <label for="current_password">Password Baru</label>
                            <input type="password" id="current_password" name="current_password" placeholder="Masukkan password" required>
                        </div>
                        <div class="field">
                            <label for="new_password">Konfirmasi Password</label>
                            <input type="password" id="new_password" name="new_password" placeholder="Konfirmasi password" required>
                        </div>
                    </div>
                    
                    <button type="submit" class="btn-profile">Ubah</button>
                </form>
            </div>
        </div>