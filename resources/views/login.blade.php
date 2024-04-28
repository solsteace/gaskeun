<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="{{ asset('css/auth.css') }}" rel="stylesheet">
    <link rel="icon" href="{{ asset('img/favicon.png') }}" />
    <script src="https://kit.fontawesome.com/98e80d3b36.js" crossorigin="anonymous"></script>
</head>

<body>
    <div class="background-div">
        <div class="row">
            <div class="col-6 empty-column">
                <!-- 50% of the whole width but empty -->
            </div>
            <div class="col-6 filled-column d-flex flex-column align-items-center justify-content-center">
            <img src="{{ asset('img/logo-navbar.png') }}" alt="Image" class="mb-4" style="width: 300px; height: auto;">
                @if(session()->has('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endif

                @if(session()->has('loginError'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('loginError') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endif

                <div style="width: 60%;">
                    <h2 class="my-4 text-center">Selamat Datang Kembali, Masuk ke Akun Anda</h2>
                </div>

                <form action="/login" method="POST" style="width: 60%;" id="loginForm">
                    @csrf
                    <div class="form-row my-4">
                        <div class="form-floating">
                            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" id="inputEmail" required autofocus value="{{ old('email') }}" placeholder="email">
                            <label for="inputEmail">Alamat email</label>
                            @error('email')
                            <div class="invalid-tooltip">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-row my-4">
                        <div class="input-group">
                            <div class="form-floating">
                                <input name="password" type="password" value="" class="input form-control" id="inputPassword" aria-label="password" aria-describedby="basic-addon1" required placeholder="password" />
                                <label for="inputPassword">Password</label>
                            </div>
                            <span class="input-group-text" onclick="password_show_hide('inputPassword');">
                                <i class="fas fa-eye" id="show_eye_inputPassword"></i>
                                <i class="fas fa-eye-slash d-none" id="hide_eye_inputPassword"></i>
                            </span>
                        </div>
                    </div>
                    <div class="d-grid">
                        <button type="submit" class="button-36 btn-block" id="loginForm__submit">MASUK</button>
                    </div>
                    <div class="my-4 text-center">
                        <a href="{{ route('register') }}">Belum punya akun? Register</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script>
        function password_show_hide(elmId) {
            var x = document.getElementById(elmId);
            var show_eye = document.getElementById(`show_eye_${elmId}`);
            var hide_eye = document.getElementById(`hide_eye_${elmId}`);
            hide_eye.classList.remove("d-none");
            if (x.type === "password") {
                x.type = "text";
                show_eye.style.display = "none";
                hide_eye.style.display = "block";
            } else {
                x.type = "password";
                show_eye.style.display = "block";
                hide_eye.style.display = "none";
            }
        }
    </script>
</body>

</html>