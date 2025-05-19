<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Citra Kosmetik</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    <link href="assets/css/login.css" rel="stylesheet">
</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-4 left-panel">
                <img src="assets/img/logo.png" alt="Citra Kosmetik">
            </div>
            <div class="col-md-6 right-panel">
                <div class="container">
                    <h2 class="fw-bold mb-4">Registrasi</h2>
                    <form name="login-form" action="add.php" method="post" class="login-form" onsubmit="return validateForm()">
                        <div class="mb-3">
                        <label class="form-label" for="nama"> <i class="bi bi-person-circle"></i> Nama Lengkap</label>
                        <input type="nama" id="nama" class="form-control" name="nama" autocomplete="off" placeholder="Masukkan Nama Lengkap" />
                        </div>
                        <div class="mb-3">
                        <label class="form-label" for="email"> <i class="bi bi-person-circle"></i> Email</label>
                <input type="email" id="email" class="form-control" name="email" autocomplete="off" placeholder="Masukkan Email" />
                        </div>
                        <div class="mb-3">
                        <label class="form-label" for="password"><i class="bi bi-chat-left-dots-fill"></i> Password</label>
                        <input type="password" id="password" class="form-control" name="password" autocomplete="off" placeholder="Masukkan Password" />
                        <div class="d-flex justify-content-center">
                            <button type="submit" name="regis" class="btn">Buat Akun</button>
                        </div>
                        <p class="text-center text-muted mt-3">
                            Sudah memiliki akun? <a href="index.php">Log In</a>
                        </p>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        function validateForm() {
            var nama = document.getElementById("nama").value;
            var email = document.getElementById("email").value;
            var password = document.getElementById("password").value;

            if (nama.trim() === "" || email.trim() === "" || password.trim() === "") {
                alert("Kolom tidak boleh kosong!");
                return false;
            }
            return true;
        }
    </script>
</body>

</html>