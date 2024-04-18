<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Register</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="{{ asset('css/auth.css') }}" rel="stylesheet">  
    <link rel="icon" href="{{ asset('img/favicon.png') }}"/>
    <script src="https://kit.fontawesome.com/98e80d3b36.js" crossorigin="anonymous"></script>
  </head>
  <body>
    <div class="background-div">
        <div class="row">
            <div class="col-6 empty-column">
                <!-- 50% of the whole width but empty -->
            </div>
            <div class="col-6 filled-column d-flex flex-column align-items-center justify-content-center">
                <div style="width: 60%;">
                    <h2 class="mb-4 text-center">Buat Akun</h2>
                </div>
                <form action="/register" method="POST" style="width: 60%;" id="registerForm">
                    @csrf
                    <div class="form-row my-4">
                        <div class="form-floating">
                            <input type="text" name="nama" class="form-control @error('nama') is-invalid @enderror" id="inputNamaLengkap" required value="{{ old('nama') }}" placeholder="name">
                            <label for="inputNamaLengkap">Nama lengkap</label>
                            @error('nama')
                            <div class="invalid-tooltip">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-row my-4">
                        <div class="form-floating">
                            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" id="inputEmail" required value="{{ old('email') }}" placeholder="email">
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
                                <input 
                                name="password" 
                                type="password" 
                                value="" 
                                class="input form-control @error('password') is-invalid @enderror" 
                                id="inputPassword" 
                                aria-label="password" 
                                aria-describedby="basic-addon1"
                                placeholder="password"
                                required 
                                />
                                <label for="inputPassword">Password</label>
                                @error('password')
                                <div class="invalid-tooltip">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <span class="input-group-text" onclick="password_show_hide('inputPassword');">
                                <i class="fas fa-eye" id="show_eye_inputPassword"></i>
                                <i class="fas fa-eye-slash d-none" id="hide_eye_inputPassword"></i>
                            </span>
                        </div>
                    </div>
                    <div class="form-row my-4">
                        <div class="input-group">
                            <div class="form-floating">
                                <input 
                                name="password_confirmation" 
                                type="password" 
                                value="" 
                                class="input form-control @error('password') is-invalid @enderror" 
                                id="inputKonfirmasiPassword" 
                                aria-label="password" 
                                aria-describedby="basic-addon1" 
                                placeholder="confirm password"
                                required 
                                />
                                <label for="inputKonfirmasiPassword">Konfirmasi password</label>
                                @error('password')
                                <div class="invalid-tooltip">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <span class="input-group-text" onclick="password_show_hide('inputKonfirmasiPassword');">
                                <i class="fas fa-eye" id="show_eye_inputKonfirmasiPassword"></i>
                                <i class="fas fa-eye-slash d-none" id="hide_eye_inputKonfirmasiPassword"></i>
                            </span>
                        </div>
                    </div>
                    <div class="d-grid">
                        <button type="submit" class="button-36 btn-block" id="registerForm__submit">BUAT AKUN</button>
                    </div>
                    <div class="my-4 text-center">
                        <a href="{{ route('login') }}">Sudah punya akun? Login</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </body>
</html>