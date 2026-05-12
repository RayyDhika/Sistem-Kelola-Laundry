<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <style>
        body {
            height: 100vh;
            background: linear-gradient(to right, #3a8dde, #5aa3ff);
        }

        .login-card {
            border-radius: 15px;
            border: 3px solid #1a4fbf;
        }

        .form-control:focus {
            border-color: #1a4fbf;
            box-shadow: 0 0 5px rgba(26,79,191,0.3);
        }

        .btn-primary {
            background-color: #1a4fbf;
            border: none;
        }

        .btn-primary:hover {
            background-color: #153c94;
        }

        .text-blue {
            color: #1a4fbf;
        }

        .text-lightblue {
            color: #278CFF;
        }
    </style>
</head>

<body class="d-flex justify-content-center align-items-center">

<div class="card login-card shadow p-4 text-center" style="width: 300px;">

    <div class="mb-2">
        <i class="fa-solid fa-right-to-bracket fa-2x text-blue"></i>
    </div>

    <h4 class="text-blue">LOGIN</h4>
    <p class="small text-lightblue">Selamat Datang!! Login Untuk Melanjutkan</p>

    @if(session('error'))
        <div class="alert alert-danger py-1">
            {{ session('error') }}
        </div>
    @endif

    <form method="POST" action="/login">
        @csrf

        <!-- Email -->
        <div class="mb-3 text-start">
            <label class="form-label text-lightblue fw-bold">Email :</label>
            <div class="input-group">
                <span class="input-group-text bg-white">
                    <i class="fa-solid fa-user text-lightblue"></i>
                </span>
                <input type="text" name="email" class="form-control" placeholder="Masukan Email">
            </div>
        </div>

        <!-- Password -->
        <div class="mb-3 text-start">
            <label class="form-label text-lightblue fw-bold">Password :</label>
            <div class="input-group">
                <span class="input-group-text bg-white">
                    <i class="fa-solid fa-lock text-lightblue"></i>
                </span>
                <input type="password" id="password" name="password" class="form-control" placeholder="Masukan Password">
                <span class="input-group-text bg-white" onclick="togglePassword(this)" style="cursor:pointer;">
                    <i class="fa-solid fa-eye text-lightblue"></i>
                </span>
            </div>
        </div>

        <button class="btn btn-primary w-100 fw-bold">LOGIN</button>
    </form>

</div>

<script>
function togglePassword(el) {
    var input = document.getElementById("password");
    var icon = el.querySelector("i");

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
</script>

</body>
</html>