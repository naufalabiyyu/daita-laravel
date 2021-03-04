@extends('layouts.auth')

@section('content')

    <main class="login-container-regis ">
        <div class="container" id="register">
            <div class="row page-login d-flex align-items-center justify-content-center">
                <div class="section-right col-12 col-md-5" data-aos="fade-up" data-aos-delay="300">
                    <div class="card">
                        <div class="card-body card-register">
                            <div class="text-center">
                                <img src="/images/Logo.svg" alt="" class="mb-4">
                            </div>
                            <form method="POST" action="{{ route('register') }}">
                                @csrf
                                <div class="form-group">
                                    <label>Full Name</label>
                                    <input id="name" 
                                    type="text" 
                                    
                                    onkeydown="preventNumberInput(event)" onkeyup="preventNumberInput(event)"
                                    v-model="name" 
                                    class="form-control @error('name') is-invalid @enderror" 
                                    name="name" 
                                    value="{{ old('name') }}" 
                                    required 
                                    autocomplete="name" 
                                    autofocus>

                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Email</label>
                                    <input id="email" 
                                    type="email" 
                                    v-model="email" 
                                    @change="checkEmail()"
                                    class="form-control @error('email') is-invalid @enderror" 
                                    :class="{ 'is-invalid' : this.email_unavailable }"
                                    name="email" 
                                    value="{{ old('email') }}" 
                                    required 
                                    autocomplete="email">

                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Password</label>
                                    <input id="password" 
                                    type="password" 
                                    class="form-control @error('password') is-invalid @enderror" 
                                    name="password" 
                                    required 
                                    autocomplete="new-password">

                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Konfirmasi Password</label>
                                    <input id="password-confirm" 
                                    type="password" 
                                    class="form-control @error('password_confirmation') is-invalid @enderror" 
                                    name="password_confirmation" 
                                    required 
                                    autocomplete="new-password">

                                    @error('password_confirmation')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Nomor Handphone</label>
                                    <input id = "phone_number"
                                    type="number" 
                                    class="form-control" 
                                    name="phone_number" 
                                    v-model="phone"
                                    required 
                                    autocomplete
                                    autofocus>

                                    
                                </div>
                                <button type="submit" 
                                class="btn btn-warning btn-login btn-block mt-4"
                                :disabled="this.email_unavailable">
                                Sign Up Now</button>
                                <a href="{{ route('login') }}" type="submit" class="btn btn-warning btn-register btn-block"> Back to Sign In 
                                </a>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
    </main>

<div class="container d-none">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">
                    
                        

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('addon-script')
    <script src="/vendor/vue/vue.js"></script>  
    <script src="https://unpkg.com/vue-toasted"></script>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <script>
        Vue.use(Toasted)
        var register = new Vue({
            el: '#register',
            mounted() {
                AOS.init();
                
            },
            methods: {
                checkEmail: function(){
                    var self = this;
                    axios.get('{{ route('api-register-check') }}', {
                        params: {
                            email: this.email
                        }
                    })
                        .then(function (response) {
                            
                            if(response.data == 'Available') {
                               self.$toasted.show(
                                    "Email bisa digunakan!", 
                                    {
                                    position: "top-center",
                                    className: "rounded",
                                    duration: 1000,
                                    }
                                );
                                self.email_unavailable = false;
                            } else {
                                self.$toasted.error(
                                    "Maaf, Email sudah terdaftar di sistem kami.", 
                                    {
                                    position: "top-center",
                                    className: "rounded",
                                    duration: 1000,
                                    }
                                );
                                self.email_unavailable = true;
                            }

                            // handle success
                            console.log(response);
                        });
                }
            },
            data() {
                return {
                    name: "User",
                    email: "User@daita.com",
                    phone: "62",
                    email_unavailable: false    
                }
            }, 
        });
    </script>
    <script>
    function preventNumberInput(e) {
      var keyCode = (e.keyCode ? e.keyCode : e.which);
      if (keyCode > 47 && keyCode < 58 || keyCode > 95 && keyCode < 107) {
        e.preventDefault();
      }
    }

    $(document).ready(function() {
      $('#text_field').keypress(function(e) {
        preventNumberInput(e);
      });
    })
  </script>
@endpush