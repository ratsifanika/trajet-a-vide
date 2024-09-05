@extends("layouts.app")

@section("content")
  <div class="container">
    <div class="row justify-content-center">
        <div class="col col-md-8">
            <div class="card">
                <div class="card-header">{{__("Login")}}</div>
                <div class="card-body">
                    <form class="form" method="POST" action="{{route('login')}}">
                        @csrf
                        <div class="form-group row">
                            <label for="email" class="col-md-4">Email</label>
                            <div class="col-md-6">
                                <input type="email" id="email" class="form-control @error('email') is-invalid @enderror" 
                                name="email" value="{{old('email')}}" required autofocus autocomplete="email">
                                @error('email')
                                    <div class="invalid-feedback" role="alert">
                                        <strong>{{$message}}</strong>
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group row mt-3">
                                <label class="col col-md-4" for="password">{{__('Password')}}</label>
                                <div class="col col-md-6">
                                    <input id="password" type="password" class="form-control" name="password" 
                                    @error('password') is-invalid @enderror required>
                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row mt-3">
                                <div class="col-md-6 offset-md-4">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                        <label class="form-check-label" for="remember">
                                            {{ __('Remember Me') }}
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group row mt-3 mb-0">
                                <div class="col-md-8 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Login') }}
                                    </button>

                                    @if (Route::has('password.request'))
                                        <a class="btn btn-link" href="{{ route('password.request') }}">
                                            {{ __('Forgot Your Password?') }}
                                        </a>
                                    @endif
                                </div>
                            </div>

                        </div>
                        <div class=""></div>
                    </form>
                </div>
            </div>
        </div>
    </div>
  </div>
@endsection