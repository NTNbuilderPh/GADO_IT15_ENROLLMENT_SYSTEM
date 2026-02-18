<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | UM Academic Portal</title>
    
    <!-- UM Branding Assets -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        body {
            background: linear-gradient(135deg, var(--um-maroon) 0%, var(--um-maroon-dark) 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            margin: 0;
            overflow: hidden;
        }

        .login-container {
            background: white;
            width: 100%;
            max-width: 400px;
            padding: 40px;
            border-radius: 12px;
            box-shadow: 0 15px 35px rgba(0,0,0,0.3);
            text-align: center;
        }

        .um-logo {
            font-size: 3rem;
            color: var(--um-maroon);
            margin-bottom: 10px;
        }

        .login-header h2 {
            margin: 0;
            color: #333;
            font-weight: 800;
            letter-spacing: -1px;
        }

        .login-header p {
            color: #777;
            font-size: 0.9rem;
            margin-bottom: 30px;
        }

        .form-group {
            text-align: left;
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            font-size: 0.75rem;
            font-weight: bold;
            color: #555;
            margin-bottom: 8px;
            text-transform: uppercase;
        }

        .input-wrapper {
            position: relative;
        }

        .input-wrapper i {
            position: absolute;
            left: 12px;
            top: 50%;
            transform: translateY(-50%);
            color: #aaa;
        }

        .form-control {
            width: 100%;
            padding: 12px 12px 12px 40px;
            border: 1px solid #ddd;
            border-radius: 6px;
            font-size: 1rem;
            box-sizing: border-box;
            transition: var(--transition);
        }

        .form-control:focus {
            border-color: var(--um-maroon);
            outline: none;
            box-shadow: 0 0 0 3px rgba(128, 0, 0, 0.1);
        }

        .btn-block {
            width: 100%;
            margin-top: 10px;
            padding: 14px;
            font-size: 1rem;
            letter-spacing: 1px;
        }

        .onboarding-footer {
            margin-top: 25px;
            padding-top: 20px;
            border-top: 1px solid #eee;
            font-size: 0.8rem;
            color: #888;
        }

        .error-msg {
            background: #fff5f5;
            color: #c53030;
            padding: 10px;
            border-radius: 4px;
            font-size: 0.8rem;
            margin-bottom: 20px;
            border: 1px solid #feb2b2;
        }
    </style>
</head>
<body>

    <div class="login-container">
        <div class="um-logo">
            <i class="fas fa-university"></i>
        </div>
        
        <div class="login-header">
            <h2>Academic Portal</h2>
            <p>UM Tagum Campus Onboarding</p>
        </div>

        @if($errors->any())
            <div class="error-msg">
                <i class="fas fa-exclamation-circle"></i> {{ $errors->first() }}
            </div>
        @endif

        <form action="/login" method="POST">
            @csrf
            <div class="form-group">
                <label>Student Number or Email</label>
                <div class="input-wrapper">
                    <i class="fas fa-user"></i>
                    <input type="text" name="login_id" class="form-control" placeholder="e.g. 123456" required autofocus>
                </div>
            </div>

            <div class="form-group">
                <label>Password</label>
                <div class="input-wrapper">
                    <i class="fas fa-lock"></i>
                    <input type="password" name="password" class="form-control" placeholder="••••••••" required>
                </div>
            </div>

            <button type="submit" class="btn-login btn-block">
                SIGN IN <i class="fas fa-arrow-right" style="margin-left: 8px;"></i>
            </button>
        </form>

        <div class="onboarding-footer">
            <p><i class="fas fa-shield-alt"></i> SIS Integrated & Secure Payment Ready</p>
            <a href="#" style="color: var(--um-maroon); text-decoration: none; font-weight: bold;">Forgot Password?</a>
        </div>
    </div>

</body>
</html>
