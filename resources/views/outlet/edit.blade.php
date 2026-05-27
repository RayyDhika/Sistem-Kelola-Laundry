<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Outlet - BubbleBliss</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Hammersmith+One&display=swap" rel="stylesheet">
    <style>
        body { background: #e5f0ff; margin: 0; font-family: 'Hammersmith One', sans-serif; color: #0650d1; }
        .topbar { display: flex; position: sticky; top: 0; z-index: 1050; }
        .logo-header { width: 240px; height: 70px; background: #1a4fbf !important; color: white; display: flex; align-items: center; gap: 10px; padding: 15px; }
        .header-right { flex: 1; height: 70px; background: white; padding: 0 15px; display: flex; justify-content: space-between; align-items: center; box-shadow: 0 3px 5px rgba(53, 119, 243, 0.2); }
        .sidebar { width: 240px; position: fixed; top: 70px; left: 0; bottom: 0; background: linear-gradient(#2f80ed, #56ccf2); padding: 15px; z-index: 999; }
        .sidebar a { text-decoration: none; color: white; display: block; padding: 12px 15px; border-radius: 8px; margin-bottom: 5px; }
        .main {
            margin-left: 240px;
            padding: 25px;
            min-height: calc(100vh - 70px);

            display: flex;
            justify-content: center;
            align-items: flex-start;
}
        .card-custom {
            border: 2px solid #c7d7ff;
            border-radius: 15px;
            background: white;
            box-shadow: 0 3px 10px rgba(53, 119, 243, 0.15);
            padding: 30px;
            width: 650px;
        }
        .form-label-blue { color: #60a5fa; font-weight: normal; }
        .btn-update { background: #0649ca; color: white; border-radius: 8px; padding: 10px 30px; border: none; font-weight: bold; }
        .form-control{
            height:48px;
            border-radius:10px;
            font-family: Arial, Helvetica, sans-serif !important;
        }

        textarea.form-control{
            height:auto;
        }
    </style>
</head>
<body>

<div class="topbar">
    <div class="logo-header"><img src="{{ asset('images/logoputih.png') }}" width="45"><span>BubbleBliss</span></div>
    <div class="header-right">
        <div class="px-3"><h4>EDIT OUTLET</h4></div>
    </div>
</div>

<div class="sidebar">
    <a href="{{ route('dashboard') }}"><i class="fa fa-home me-2"></i> Beranda</a>
    <a href="{{ route('outlet.index') }}" class="bg-white bg-opacity-25"><i class="fa fa-shop me-2"></i> Data Outlet</a>
</div>

<div class="main d-flex justify-content-center">
    <div class="card-custom p-4" style="max-width: 650px;">
        <form action="{{ route('outlet.update', $outlet->id) }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class="mb-3">
                <label class="form-label form-label-blue">
                    Nama Outlet
                </label>

                <input type="text"
                       name="nama"
                       class="form-control"
                       value="{{ $outlet->nama }}"
                       required>
            </div>

            <div class="mb-3">
                <label class="form-label form-label-blue">
                    Alamat
                </label>

                <textarea name="alamat"
                          class="form-control"
                          rows="3"
                          required>{{ $outlet->alamat }}</textarea>
            </div>

            <div class="mb-3">
                <label class="form-label form-label-blue">
                    No. Telepon
                </label>

                <input type="text"
                       name="tlp"
                       class="form-control"
                       value="{{ $outlet->tlp }}"
                       required>
            </div>

            <div class="d-flex justify-content-end gap-2 mt-4">

                <a href="{{ route('outlet.index') }}"
                   class="btn btn-secondary px-4 fw-bold"
                   style="border-radius:10px;">

                    BATAL
                </a>

                <button type="submit"
                    class="btn btn-primary px-4 fw-bold"
                    style="
                        background:#3577f3;
                        border:none;
                        border-radius:10px;
                    ">

                 SIMPAN
             </button>

            </div>
        </form>
    </div>
</div>

</body>
</html>