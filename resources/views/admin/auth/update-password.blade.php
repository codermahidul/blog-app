<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>Forgot Password &mdash; Stisla</title>

  <!-- General CSS Files -->
  <link rel="stylesheet" href="{{ asset('admin/assets/modules/bootstrap/css/bootstrap.min.css') }}">
  <link rel="stylesheet" href="{{ asset('admin/assets/modules/fontawesome/css/all.min.css') }}">

  <!-- CSS Libraries -->

  <!-- Template CSS -->
  <link rel="stylesheet" href="{{ asset('admin/assets/css/style.css') }}">
  <link rel="stylesheet" href="{{ asset('admin/assets/css/components.css') }}">
<!-- Start GA -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-94034622-3"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-94034622-3');
</script>
<!-- /END GA --></head>

<body>
  <div id="app">
    <section class="section">
        <div class="container mt-5">
          <div class="row">
            <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">
              <div class="login-brand">
                <img src="{{ asset('admin') }}/assets/img/stisla-fill.svg" alt="logo" width="100" class="shadow-light rounded-circle">
              </div>
  
              <div class="card card-primary">
                <div class="card-header"><h4>{{ __('Reset Password') }}</h4></div>
  
                <div class="card-body">
                  <p class="text-muted">{{ __('We will send a link to reset your password.') }}</p>
                  <form method="POST" action="{{ route('admin.update-password') }}">
                    @csrf
                    <div class="form-group">
                      <label for="email">{{ __('Email') }}</label>
                      <input id="email" type="email" class="form-control" name="email" tabindex="1" required autofocus value="{{ $email }}">
                      @error('email')
                          <code>{{ $message }}</code>
                      @enderror
                      <input type="hidden" name="token" value="{{ $token }}">
                    </div>
                    
                    <div class="form-group">
                      <label for="password">{{ __('New Password') }}</label>
                      <input id="password" type="password" class="form-control pwstrength" data-indicator="pwindicator" name="password" tabindex="2" required>
                      <div id="pwindicator" class="pwindicator">
  
                        <div class="bar"></div>
                        <div class="label"></div>
                        </div>
                        @error('password')
                            <code>{{ $message }}</code>
                        @enderror
                    </div>
  
                    <div class="form-group">
                      <label for="password-confirm">{{ __('Confirm Password') }}</label>
                      <input id="password-confirm" type="password" class="form-control" name="password_confirmation" tabindex="2" required>
                        @error('password_confirmation')
                             <code>{{ $message }}</code>
                        @enderror
                    </div>
  
                    <div class="form-group">
                      <button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="4">
                        {{ __('Update Password') }}
                      </button>
                    </div>
                  </form>
                </div>
              </div>
              <div class="simple-footer">
                {{ __('Copyright') }} &copy; {{ env('APP_NAME') }} <?php echo date("Y"); ?>
            </div>
            </div>
          </div>
        </div>
      </section>
  </div>

  <!-- General JS Scripts -->
  <script src="{{ asset('admin/assets/modules/jquery.min.js') }}"></script>
  <script src="{{ asset('admin/assets/modules/popper.js') }}"></script>
  <script src="{{ asset('admin/assets/modules/tooltip.js') }}"></script>
  <script src="{{ asset('admin/assets/modules/bootstrap/js/bootstrap.min.js') }}"></script>
  <script src="{{ asset('admin/assets/modules/nicescroll/jquery.nicescroll.min.js') }}"></script>
  <script src="{{ asset('admin/assets/modules/moment.min.js') }}"></script>
  <script src="{{ asset('admin/assets/js/stisla.js') }}"></script>
  
  <!-- JS Libraies -->

  <!-- Page Specific JS File -->
  
  <!-- Template JS File -->
  <script src="{{ asset('admin/assets/js/scripts.js') }}"></script>
  <script src="{{ asset('admin/assets/js/custom.js') }}"></script>
</body>
</html>