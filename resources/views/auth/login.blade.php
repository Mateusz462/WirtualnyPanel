@extends('layouts.app')


@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body p-0">
                    <!-- Nested Row within Card Body -->
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="p-5">
                                <p class="text-center">
                                    <!-- <img class="d-block mx-auto mb-4" src="https://getbootstrap.com/docs/5.0/assets/brand/bootstrap-logo.svg" alt="" width="72" height="57"> -->
                                    <img class="mx-auto element" src="https://getbootstrap.com/docs/5.0/assets/brand/bootstrap-logo.svg" style="width: 125px">
                                </p>
                                <div class="text-center">
                                    <h1 class="h4 mb-4">Zaloguj się do panelu!</h1>
                                </div>
                                <form method="POST" action="{{ route('login') }}">
                                    @csrf
                                    <div class="form-group mb-3">
                                        <label for="email" class="form-label">Login</label>
                                        <input type="email" class="form-control @error('email') is-invalid @enderror form-control-user" value="{{ old('email') }}" autocomplete="email" placeholder="Login" name="email">
                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="password" class="form-label">Hasło</label>
                                        <input type="password" class="form-control @error('password') is-invalid @enderror form-control-user" placeholder="Hasło" name="password">
                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <!-- 2 column grid layout for inline styling -->
                                    <div class="row mb-4">
                                        <div class="col d-flex justify-content-center">
                                            <!-- Checkbox -->
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                                
                                                <label class="form-check-label" for="remember">Zapamiętaj mnie</label>
                                            </div>
                                        </div>

                                        <div class="col">
                                            <!-- Simple link -->
                                            @if (Route::has('password.request'))
                                                <a class="" href="{{ route('password.request') }}">
                                                Nie pamiętasz hasła?
                                                </a>
                                            @endif
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-primary btn-user btn-block">Zaloguj Się</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('javascript')
    <script>
        function scrollToContentWrapper() {
            // $('html, body').animate({ scrollTop: $('.content-wrapper').offset().top}, 600, 'linear');
            const contentWrapper = document.querySelector('.content-wrapper');
            if (contentWrapper) {
                const currentPosition = contentWrapper.scrollTop;
                const targetPosition = currentPosition + 500;
                contentWrapper.scrollTo({
                    top: targetPosition,
                    behavior: 'linear'
                });
            }
        }
        window.addEventListener('DOMContentLoaded', scrollToContentWrapper);
        window.addEventListener('resize', scrollToContentWrapper);

        
    </script>
@endsection