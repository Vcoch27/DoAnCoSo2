<style>
    :root {
        --primary-color: #4EA685;
        --secondary-color: #57B894;
        --black: #000000;
        --white: #ffffff;
        --gray: #efefef;
        --gray-2: #757575;

        --facebook-color: #4267B2;
        --google-color: #DB4437;
        --twitter-color: #1DA1F2;
        --insta-color: #E1306C;
    }

    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600&display=swap');

    * {
        font-family: 'Poppins', sans-serif;
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    html,
    body {
        height: 100vh;
        overflow: hidden;
    }

    .container {
        position: relative;
        min-height: 100vh;
        overflow: hidden;
    }

    .row {
        display: flex;
        flex-wrap: wrap;
        height: 100vh;
    }

    .col {
        width: 50%;
    }

    .align-items-center {
        display: flex;
        align-items: center;
        justify-content: center;
        text-align: center;
    }

    .form-wrapper {
        width: 100%;
        max-width: 28rem;
    }

    .form {
        padding: 1rem;
        background-color: var(--white);
        border-radius: 1.5rem;
        width: 100%;
        box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;
        transform: scale(0);
        transition: .5s ease-in-out;
        transition-delay: 1s;
    }

    .input-group {
        position: relative;
        width: 100%;
        margin: 1rem 0;
    }

    .input-group i {
        position: absolute;
        top: 50%;
        left: 1rem;
        transform: translateY(-50%);
        font-size: 1.4rem;
        color: var(--gray-2);
    }

    .input-group input {
        width: 100%;
        padding: 1rem 3rem;
        font-size: 1rem;
        background-color: var(--gray);
        border-radius: .5rem;
        border: 0.125rem solid var(--white);
        outline: none;
    }

    .input-group input:focus {
        border: 0.125rem solid var(--primary-color);
    }

    .form button {
        cursor: pointer;
        width: 100%;
        padding: .6rem 0;
        border-radius: .5rem;
        border: none;
        background-color: var(--primary-color);
        color: var(--white);
        font-size: 1.2rem;
        outline: none;
        margin-bottom: 10px;
    }

    .form p {
        margin: 1rem 0;
        font-size: .7rem;
    }

    .flex-col {
        flex-direction: column;
    }

    .social-list {
        margin: 2rem 0;
        padding: 1rem;
        border-radius: 1.5rem;
        width: 100%;
        box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;
        transform: scale(0);
        transition: .5s ease-in-out;
        transition-delay: 1.2s;
    }

    .social-list>div {
        color: var(--white);
        margin: 0 .5rem;
        padding: .7rem;
        cursor: pointer;
        border-radius: .5rem;
        cursor: pointer;
        transform: scale(0);
        transition: .5s ease-in-out;
    }

    .social-list>div:nth-child(1) {
        transition-delay: 1.4s;
    }

    .social-list>div:nth-child(2) {
        transition-delay: 1.6s;
    }

    .social-list>div:nth-child(3) {
        transition-delay: 1.8s;
    }

    .social-list>div:nth-child(4) {
        transition-delay: 2s;
    }

    .social-list>div>i {
        font-size: 1.5rem;
        transition: .4s ease-in-out;
    }

    .social-list>div:hover i {
        transform: scale(1.5);
    }

    .facebook-bg {
        background-color: var(--facebook-color);
    }

    .google-bg {
        background-color: var(--google-color);
    }

    .twitter-bg {
        background-color: var(--twitter-color);
    }

    .insta-bg {
        background-color: var(--insta-color);
    }

    .pointer {
        cursor: pointer;
    }

    .container.sign-in .form.sign-in,
    .container.sign-in .social-list.sign-in,
    .container.sign-in .social-list.sign-in>div,
    .container.sign-up .form.sign-up,
    .container.sign-up .social-list.sign-up,
    .container.sign-up .social-list.sign-up>div {
        transform: scale(1);
    }

    .content-row {
        position: absolute;
        top: 0;
        left: 0;
        pointer-events: none;
        z-index: 6;
        width: 100%;
    }

    .text {
        margin: 4rem;
        color: var(--white);
    }

    .text h2 {
        font-size: 3.5rem;
        font-weight: 800;
        margin: 2rem 0;
        transition: 1s ease-in-out;
    }

    .text p {
        font-weight: 600;
        transition: 1s ease-in-out;
        transition-delay: .2s;
    }

    .img img {
        width: 30vw;
        transition: 1s ease-in-out;
        transition-delay: .4s;
    }

    .text.sign-in h2,
    .text.sign-in p,
    .img.sign-in img {
        transform: translateX(-250%);
    }

    .text.sign-up h2,
    .text.sign-up p,
    .img.sign-up img {
        transform: translateX(250%);
    }

    .container.sign-in .text.sign-in h2,
    .container.sign-in .text.sign-in p,
    .container.sign-in .img.sign-in img,
    .container.sign-up .text.sign-up h2,
    .container.sign-up .text.sign-up p,
    .container.sign-up .img.sign-up img {
        transform: translateX(0);
    }

    /* BACKGROUND */

    .container::before {
        content: "";
        position: absolute;
        top: 0;
        right: 0;
        height: 100vh;
        width: 300vw;
        transform: translate(35%, 0);
        background-image: linear-gradient(-45deg, var(--primary-color) 0%, var(--secondary-color) 100%);
        transition: 1s ease-in-out;
        z-index: 6;
        box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;
        border-bottom-right-radius: max(50vw, 50vh);
        border-top-left-radius: max(50vw, 50vh);
    }

    .container.sign-in::before {
        transform: translate(0, 0);
        right: 50%;
    }

    .container.sign-up::before {
        transform: translate(100%, 0);
        right: 50%;
    }

    /* RESPONSIVE */

    @media only screen and (max-width: 425px) {

        .container::before,
        .container.sign-in::before,
        .container.sign-up::before {
            height: 100vh;
            border-bottom-right-radius: 0;
            border-top-left-radius: 0;
            z-index: 0;
            transform: none;
            right: 0;
        }

        /* .container.sign-in .col.sign-up {
        transform: translateY(100%);
    } */

        .container.sign-in .col.sign-in,
        .container.sign-up .col.sign-up {
            transform: translateY(0);
        }

        .content-row {
            align-items: flex-start !important;
        }

        .content-row .col {
            transform: translateY(0);
            background-color: unset;
        }

        .col {
            width: 100%;
            position: absolute;
            padding: 2rem;
            background-color: var(--white);
            border-top-left-radius: 2rem;
            border-top-right-radius: 2rem;
            transform: translateY(100%);
            transition: 1s ease-in-out;
        }

        .row {
            align-items: flex-end;
            justify-content: flex-end;
        }

        .form,
        .social-list {
            box-shadow: none;
            margin: 0;
            padding: 0;
        }

        .text {
            margin: 0;
        }

        .text p {
            display: none;
        }

        .text h2 {
            margin: .5rem;
            font-size: 2rem;
        }
    }
</style>
<div id="container" class="container">
    @if(session('alert'))
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        Swal.fire({
            title: 'Notice',
            text: @json(session('alert')),
            icon: 'warning',
            confirmButtonText: 'OK'
        });
    </script>
    @endif






    <!-- FORM SECTION -->
    <div class="row">
        <!-- SIGN UP -->
        <div class="col align-items-center flex-col sign-up">
            <div class="form-wrapper align-items-center">
                <div class="form sign-up">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf
                        <div class="input-group">
                            <label for="name">
                                <i class="fa-regular fa-user"></i>
                            </label>
                            <input id="name" name="name" value="{{ old('name') }}" autofocus autocomplete="name" type="text" placeholder="Name">
                            @error('name')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="input-group">
                            <label for="email">
                                <i class="fa-solid fa-envelope"></i>
                            </label>
                            <input type="email" name="email" id="email" value="{{ old('email') }}" autocomplete="username" placeholder="Email">
                            @error('email')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="input-group">
                            <label for="password">
                                <i class="fa-solid fa-lock"></i>
                            </label>
                            <input id="password" name="password" type="password" autocomplete="new-password" placeholder="Password">
                            @error('password')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="input-group">
                            <label for="password_confirmation">
                                <i class="fa-solid fa-lock"></i>
                            </label>
                            <input id="password_confirmation" name="password_confirmation" type="password" autocomplete="new-password" placeholder="Confirm password">
                            @error('password_confirmation')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <button type="submit">Sign up</button>

                        <p>
                            <span>Already have an account?</span>
                            <b onclick="toggle()" class="pointer">Sign in here</b>
                        </p>
                    </form>


                </div>
            </div>

        </div>
        <!-- END SIGN UP -->
        <!-- SIGN IN -->
        <div class="col align-items-center flex-col sign-in">
            <div class="form-wrapper align-items-center">
                <div class="form sign-in">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="input-group">
                            <label for="email">
                                <i class="fa-solid fa-envelope"></i>

                            </label>
                            <input type="email" id="email" placeholder="Email" name="email" autocomplete="username">
                        </div>
                        <div class="input-group">
                            <label for="password">
                                <i class="fa-solid fa-lock"></i>
                            </label>
                            <input id="password" type="password" placeholder="Password" name="password"
                                autocomplete="current-password">
                        </div>
                        <button type="submit">
                            Sign in
                        </button>
                        @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}" style="color: gray; text-decoration: none; font-size: 14px; font-weight: bold; margin: 10px 0;">
                            Forgot password?
                        </a>
                        @endif

                        <hr style="margin: 10px 0;">
                        <button type="button" class="login-with-google-btn" onclick="window.location.href='{{ route('google-auth') }}'">
                            <i class="fa-brands fa-google"></i> Continue with <strong>Google</strong>
                        </button>

                        <p>
                            <span>
                                Don't have an account?
                            </span>
                            <b onclick="toggle()" class="pointer">
                                Sign up here
                            </b>
                        </p>
                    </form>
                </div>
            </div>
            <div class="form-wrapper">

            </div>
        </div>
        <!-- END SIGN IN -->
    </div>
    <!-- END FORM SECTION -->
    <!-- CONTENT SECTION -->
    <div class="row content-row">
        <!-- SIGN IN CONTENT -->
        <div class="col align-items-center flex-col">
            <div class="text sign-in">
                <h2>
                    Welcome
                </h2>

            </div>
            <div class="img sign-in">

            </div>
        </div>
        <!-- END SIGN IN CONTENT -->
        <!-- SIGN UP CONTENT -->
        <div class="col align-items-center flex-col">
            <div class="img sign-up">

            </div>
            <div class="text sign-up">
                <h2>
                    Join with us
                </h2>

            </div>
        </div>
        <!-- END SIGN UP CONTENT -->
    </div>
    <!-- END CONTENT SECTION -->
</div>
<script>
    let container = document.getElementById('container');

    toggle = () => {
        container.classList.toggle('sign-in');
        container.classList.toggle('sign-up');
    };

    setTimeout(() => {
        container.classList.add('sign-in');
    }, 200);

    // Pass the PHP $flag variable into JavaScript
    let $flag = @json($flag ?? 'login'); // Default to 'login' if not set
    console.log("Check flag:", $flag);
</script>