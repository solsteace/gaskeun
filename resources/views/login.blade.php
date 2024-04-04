<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>login</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    
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
                    <h2 class="my-4 text-center">Selamat Datang Kembali, Masuk ke Akun Anda</h2>
                </div>
                <form style="width: 60%;" id="loginForm">
                    <div class="form-row my-4">
                        <div class="form-floating">
                            <input type="email" class="form-control" id="inputEmail" required placeholder="email">
                            <label for="inputEmail">Alamat email</label>
                        </div>
                        <div class="entry__warning" id="warning__inputEmail"></div>
                    </div>
                    <div class="form-row my-4">
                        <div class="input-group">
                            <div class="form-floating">
                                <input 
                                name="password" 
                                type="password" 
                                value="" 
                                class="input form-control" 
                                id="inputPassword" 
                                aria-label="password" 
                                aria-describedby="basic-addon1"
                                minlength="8"
                                required
                                placeholder="password"
                                />
                                <label for="inputPassword">Password</label>
                            </div>
                            <span class="input-group-text" onclick="password_show_hide('inputPassword');">
                                <i class="fas fa-eye" id="show_eye_inputPassword"></i>
                                <i class="fas fa-eye-slash d-none" id="hide_eye_inputPassword"></i>
                            </span>
                        </div>
                        <div class="entry__warning" id="warning__inputPassword"></div>
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
    <script src="{{ asset('js/login.js') }}"></script>
  </body>
</html>