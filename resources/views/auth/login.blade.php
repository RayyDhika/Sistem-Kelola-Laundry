<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <style>

        body{
            background: linear-gradient(to right, #89BCF6, #278CFF);
        }

        .login-card{
            width: 310px;
            height: 450px;
            border: 3px solid #1a4fbf;
            margin-top: 20px;
        }

        .nowrap-text{
            white-space: nowrap;
            font-size: 12px;
        }

        .form-label{
            margin-bottom: 2px !important;
            font-size: 13px;
            color: #1a4fbf;
        }

        .input-group{
            flex-wrap: nowrap !important;
        }

        .input-group-text{
            background: white !important;
            border: 1.5px solid #65aaf8 !important;
        }

        .input-group-text:first-child{
            border-right: none !important;
        }

        .form-control{
            border-top: 1.5px solid #65aaf8 !important;
            border-bottom: 1.5px solid #65aaf8 !important;
            border-left: 1.5px solid #65aaf8 !important;
            border-right: 1.5px solid #65aaf8 !important;
            box-shadow: none !important;
            color: #1a4fbf;
        }

        .form-control:focus{
            box-shadow: none !important;
        }

        .eye-btn{
            border-left: none !important;
            cursor: pointer;
        }

        input::placeholder{
            color: #1a4fbf !important;
            font-size: 12px;
        }

    </style>
</head>

<body class="d-flex justify-content-center align-items-start pt-5 vh-100">

<div class="card shadow-lg p-4 text-center bg-white rounded-4 login-card">

    <!-- LOGO -->
    <div class="mb-2">
        <img src="{{ asset('images/logo.png') }}" width="80">
    </div>

    <h3 class="mt-2 text-primary fw-semibold mb-1">
        BubbleBliss
    </h3>

    <p class="small text-primary nowrap-text m-0 mb-2">
        Selamat Datang!! Login Untuk Melanjutkan
    </p>

    <!-- ERROR -->
    @if(session('error'))
        <div class="alert alert-danger py-1 mb-2">
            {{ session('error') }}
        </div>
    @endif

    <form method="POST" action="/login">
        @csrf

        <!-- EMAIL -->
        <div class="mb-2 text-start">

            <label class="form-label">
                Email
            </label>

            <div class="input-group">

                <span class="input-group-text">
                    <i class="fa fa-user text-primary"></i>
                </span>

                <input type="email"
                       name="email"
                       class="form-control"
                       placeholder="Masukan Email">

            </div>

        </div>

        <!-- PASSWORD -->
        <div class="mb-2 text-start">

            <label class="form-label">
                Password
            </label>

            <div class="input-group">

                <span class="input-group-text">
                    <i class="fa fa-lock text-primary"></i>
                </span>

                <input type="password"
                       id="password"
                       name="password"
                       class="form-control"
                       placeholder="Masukan Password">

                <span class="input-group-text eye-btn"
                      onclick="togglePassword()">

                    <i id="eyeIcon"
                       class="fa fa-eye text-primary"></i>

                </span>

            </div>

        </div>

        <!-- BUTTON -->
        <button class="btn btn-primary w-100 fw-bold mt-4">
            LOGIN
        </button>

    </form>

</div>

<script>

function togglePassword(){

    let input = document.getElementById("password");
    let icon = document.getElementById("eyeIcon");

    if(input.type === "password"){

        input.type = "text";

        icon.classList.remove("fa-eye");
        icon.classList.add("fa-eye-slash");

    }else{

        input.type = "password";

        icon.classList.remove("fa-eye-slash");
        icon.classList.add("fa-eye");
    }

}

</script>

</body>
</html>