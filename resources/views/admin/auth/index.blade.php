<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>Kaiadmin - Bootstrap 5 Admin Dashboard</title>
    <meta content="width=device-width, initial-scale=1.0, shrink-to-fit=no" name="viewport" />
    <link rel="icon" href="{{asset('admin_assets/img/kaiadmin/favicon.ico')}}" type="image/x-icon" />

    <!-- Fonts and icons -->
    <script src="{{asset('admin_assets/js/plugin/webfont/webfont.min.js')}}"></script>
    <script>
        WebFont.load({
            google: {
                families: ["Public Sans:300,400,500,600,700"]
            },
            custom: {
                families: [
                    "Font Awesome 5 Solid",
                    "Font Awesome 5 Regular",
                    "Font Awesome 5 Brands",
                    "simple-line-icons",
                ],
                urls: ["{{asset('admin_assets/css/fonts.min.css')}}"],
            },
            active: function () {
                sessionStorage.fonts = true;
            },
        });

    </script>

    <link rel="stylesheet" href="{{asset('admin_assets/css/bootstrap.min.css')}}" />
    <link rel="stylesheet" href="{{asset('admin_assets/css/plugins.min.css')}}" />
    <link rel="stylesheet" href="{{asset('admin_assets/css/kaiadmin.min.css')}}" />
    <link rel="stylesheet" href="{{asset('admin_assets/css/demo.css')}}" />
</head>

<body>
    <div class="container d-flex justify-content-center align-items-center" style="min-height: 100vh;">
    <div class="col-md-4">
        <div class="card">
            <div class="card-header text-center">
                <h4>LOGIN</h4>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('auth.store') }}">
                    @csrf
                    <div class="mb-3">
                        <label for="email" class="form-label">Email address</label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" required autofocus>
                        @error('email')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" required>
                        @error('password')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary w-100 mt-2">Login</button>
                </form>
            </div>
            <div class="card-footer text-center mb-3 mt-4 pt-3">
               &copy; Dewata Creative | All reserved - {{\Carbon\Carbon::now()->format('Y')}}
            </div>
        </div>
    </div>
</div>
</body>

</html>
