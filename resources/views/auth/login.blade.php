<!DOCTYPE html>
<html lang="en">
<head>
    <style>
        input::placeholder {
            color: #1a4fbf !important;
            opacity: 1;
            font-size: 12px;
        }

        .nowrap-text {
            white-space: nowrap;
            font-size: 12px;
        }

        /* INPUT STYLE */
        .form-control {
            background-color: #ffffff !important;
            border: 1.5px solid #65aaf8 !important;
            box-shadow: none !important;
            color: #1a4fbf;
        }

        .form-control:focus {
            border-color: #65aaf8 !important;
            box-shadow: 0 0 4px rgba(101,170,248,0.35) !important;
        }

        .input-group-text {
            background-color: #ffffff !important;
            border: 1.5px solid #65aaf8 !important;
        }

        .eye-btn {
            background: #ffffff !important;
            border: none !important;
        }

        #eyeIcon {
            color: #1a4fbf;
        }

        .form-label {
            margin-bottom: 2px !important;
            font-size: 13px;
        }
    </style>

    <meta charset="UTF-8">
    <title>Login</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>

<body style="background: linear-gradient(to right, #89BCF6, #278CFF);" 
      class="d-flex justify-content-center align-items-start pt-5 vh-100">

<!-- CARD -->
<div class="card shadow-lg p-4 text-center bg-white rounded-4"
     style="width: 310px; height: 450px; border: 3px solid #1a4fbf; margin-top: 20px;">

    <!-- LOGO -->
    <div class="mb-2">
        <img src="{{ asset('images/logo.png') }}" alt="Logo" width="80">
    </div>

    <h3 class="mt-2 text-primary fw-semibold mb-1">BubbleBliss</h3>

    <p class="small text-primary nowrap-text m-0 mb-2">
        Selamat Datang!! Login Untuk Melanjutkan
    </p>

    <!-- NOTIFIKASI ERROR -->
    @if(session('error'))
        <div class="alert alert-danger py-1 mb-2">
            {{ session('error') }}
        </div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger py-1 mb-2">
            @if($errors->has('email'))
                Email wajib diisi
            @elseif($errors->has('password'))
                Password wajib diisi!
            @else
                {{ $errors->first() }}
            @endif
        </div>
    @endif

    <!-- FORM -->
    <form method="POST" action="/login">
        @csrf

        <!-- EMAIL -->
        <div class="mb-1 text-start">
            <label class="form-label text-primary">Email</label>
            <div class="input-group">
                <span class="input-group-text">
                    <i class="fa fa-user text-primary"></i>
                </span>
                <input type="email" name="email" class="form-control" placeholder="Masukan Email">
            </div>
        </div>

        <!-- PASSWORD -->
        <div class="mb-2 text-start">
            <label class="form-label text-primary">Password</label>
            <div class="input-group">
                <span class="input-group-text">
                    <i class="fa fa-lock text-primary"></i>
                </span>

                <input type="password" id="password" name="password" class="form-control" placeholder="Masukan Password">

                <span class="input-group-text eye-btn" onclick="togglePassword()" style="cursor:pointer">
                    <i class="fa fa-eye" id="eyeIcon"></i>
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
function togglePassword() {
    let input = document.getElementById("password");
    let icon = document.getElementById("eyeIcon");

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