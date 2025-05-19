<?php
include('koneksi.php');

if (isset($_POST['regis'])) {
    $nama = $_POST['nama'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    if (empty($nama) || empty($email) || empty($password)) {
        echo "<script>
                alert('Semua kolom harus diisi!');
                window.location.href = 'regis.php';
            </script>";
    } else {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            echo "Format email tidak valid. Pastikan email mengandung '@'.";
        } else if (strlen($password) < 8) {
            echo "<script>
                        window.onload = function() {
                            alert('Password harus memiliki minimal 8 karakter.');
                            window.location.href = 'regis.php';
                        };
                      </script>";
        } else {
            $email_check_sql = "SELECT * FROM tbl_admin WHERE email = ?";
            $stmt = $koneksi->prepare($email_check_sql);
            $stmt->bind_param("s", $email);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                echo "<script>
                        window.onload = function() {
                            alert('Email sudah terdaftar.');
                            window.location.href = 'regis.php';
                        };
                      </script>";
            } else {
                $sql = "INSERT INTO tbl_admin (nama, email, password) VALUES (?, ?, ?)";
                $stmt = $koneksi->prepare($sql);
                $stmt->bind_param("sss", $nama, $email, $password);

                if ($stmt->execute()) {
                    echo "Admin baru berhasil didaftarkan.";
                    header("Location: admin/index.php");
                } else {
                    echo "Error: " . $stmt->error;
                }
            }
        }
    }
}


if (isset($_POST['masuk'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    if (empty($email) || empty($password)) {
        echo "<script>
              alert('Semua kolom harus diisi!');
              window.location.href = 'index.php';
          </script>";
    } else {
        $email = mysqli_real_escape_string($koneksi, $email);

        $sql = "SELECT * FROM tbl_admin WHERE email='$email'";
        $result = $koneksi->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();

            if ($password === $row['password']) {
                $_SESSION['nama'] = $row['nama'];
                $_SESSION['email'] = $row['email'];
                header("Location: admin/index.php");
                exit;
            } else {
                echo "<script>
                window.onload = function() {
                    alert('Password tidak valid.');
                    window.location.href = 'index.php';
                };
              </script>";
            }
        } else {
            echo "<script>
            window.onload = function() {
                alert('Username tidak ditemukan.');
                window.location.href = 'index.php';
            };
          </script>";
        }
    }
}
