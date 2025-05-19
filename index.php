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
                    <h2 class="fw-bold mb-4">Login</h2>
                    <form action="add.php" method="post" onsubmit="return validateForm()">
                        <div class="mb-3">
                            <label for="email" class="form-label"><i class="bi bi-person-circle"></i> Email</label>
                            <input type="email" id="email" class="form-control" name="email" placeholder="Masukkan Email">
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label"><i class="bi bi-lock-fill"></i> Password</label>
                            <input type="password" id="password" class="form-control" name="password" placeholder="Masukkan Password">
                        </div>
                        <div class="d-flex justify-content-center">
                            <button type="submit" name="masuk" class="btn">Masuk</button>
                        </div>
                        <p class="text-center text-muted mt-3">
                            Belum memiliki akun? <a href="regis.php">Register</a>
                        </p>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        function validateForm() {
            var email = document.getElementById("email").value;
            var password = document.getElementById("password").value;

            if (email.trim() === "" || password.trim() === "") {
                alert("Email dan Password tidak boleh kosong!");
                return false;
            }
            return true;
        }
    </script>
</body>

</html>