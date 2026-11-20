<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil - KopiPeteh</title>
    <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.3.1/css/all.min.css">
    @vite(['resources/css/styleadmin.css'])
</head>
<body>
    <div class="wrapper">
        <x-sidebar />

        <div class="content profile-content">
            <div class="form-card">
                <h3>Profil</h3>
                <form action="" method="POST">
                    <div class="input-group">
                        <div class="field">
                            <label for="name">Nama</label>
                            <input type="text" name="name" placeholder="Nama" required>
                        </div>
                        <div class="field">
                            <label for="username">Username</label>
                            <input type="text" name="username" placeholder="Username" required>
                        </div>
                    </div>
                    <div class="input-group">
                        <div class="field">
                            <label for="email">Email</label>
                            <input type="email" name="email" placeholder="Email" required>
                        </div>
                        <div class="field">
                            <label for="nomor_telpon">No. Telp</label>
                            <input type="text" name="nomor_telpon" placeholder="Telp" required>
                        </div>
                    </div>

                    <button type="submit" class="btn-profile">Simpan</button>
                </form>
            </div>

            <div class="form-card">
                <h3>Ganti Password</h3>
                <form action="" method="POST">
                    <div class="input-group">
                        <div class="field">
                            <label for="current_password">Password Baru</label>
                            <input type="password" name="current_password" placeholder="Masukkan password" required>
                        </div>
                        <div class="field">
                            <label for="new_password">Konfirmasi Password</label>
                            <input type="password" name="new_password" placeholder="Konfirmasi password" required>
                        </div>
                    </div>
                    
                    <button type="submit" class="btn-profile">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</body>