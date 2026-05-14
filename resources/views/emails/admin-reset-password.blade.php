<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Your Password</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            font-family: 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
            background-color: #f0f4f8;
            color: #333333;
            line-height: 1.6;
        }
        .wrapper {
            max-width: 600px;
            margin: 40px auto;
            padding: 20px;
        }
        .card {
            background: #ffffff;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 4px 24px rgba(0, 0, 0, 0.08);
        }
        /* Header */
        .header {
            background: linear-gradient(135deg, #1a6b3c 0%, #2d9e5f 100%);
            padding: 40px 40px 32px;
            text-align: center;
        }
        .header .lock-icon {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 64px;
            height: 64px;
            background: rgba(255,255,255,0.15);
            border-radius: 50%;
            margin-bottom: 16px;
        }
        .header .lock-icon svg {
            width: 32px;
            height: 32px;
            fill: #ffffff;
        }
        .header h1 {
            color: #ffffff;
            font-size: 24px;
            font-weight: 700;
            letter-spacing: -0.3px;
            margin-bottom: 6px;
        }
        .header p {
            color: rgba(255, 255, 255, 0.8);
            font-size: 14px;
        }
        /* Body */
        .body {
            padding: 40px;
        }
        .greeting {
            font-size: 18px;
            font-weight: 600;
            color: #1a1a2e;
            margin-bottom: 16px;
        }
        .message {
            font-size: 15px;
            color: #555555;
            margin-bottom: 32px;
            line-height: 1.7;
        }
        /* Button */
        .btn-container {
            text-align: center;
            margin: 32px 0;
        }
        .btn-reset {
            display: inline-block;
            background: linear-gradient(135deg, #1a6b3c 0%, #2d9e5f 100%);
            color: #ffffff !important;
            text-decoration: none;
            padding: 16px 48px;
            border-radius: 50px;
            font-size: 16px;
            font-weight: 600;
            letter-spacing: 0.3px;
            box-shadow: 0 4px 16px rgba(26, 107, 60, 0.35);
            transition: all 0.2s;
        }
        /* Warning box */
        .warning-box {
            background: #fff8e1;
            border-left: 4px solid #ffc107;
            border-radius: 8px;
            padding: 16px 20px;
            margin: 28px 0;
            font-size: 13px;
            color: #7a5c00;
        }
        .warning-box strong {
            display: block;
            margin-bottom: 4px;
            font-size: 13px;
        }
        /* URL fallback */
        .url-fallback {
            background: #f8f9fa;
            border-radius: 8px;
            padding: 16px 20px;
            margin: 20px 0;
            word-break: break-all;
        }
        .url-fallback p {
            font-size: 12px;
            color: #888888;
            margin-bottom: 8px;
        }
        .url-fallback a {
            font-size: 12px;
            color: #1a6b3c;
            word-break: break-all;
        }
        /* Divider */
        .divider {
            height: 1px;
            background: #eef0f3;
            margin: 32px 0;
        }
        /* Footer */
        .footer {
            background: #f8f9fa;
            padding: 28px 40px;
            text-align: center;
            border-top: 1px solid #eef0f3;
        }
        .footer .site-name {
            font-size: 15px;
            font-weight: 700;
            color: #1a6b3c;
            margin-bottom: 6px;
        }
        .footer p {
            font-size: 12px;
            color: #aaaaaa;
            line-height: 1.6;
        }
        .footer .security-note {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            background: #e8f5ee;
            color: #1a6b3c;
            font-size: 11px;
            font-weight: 600;
            padding: 6px 14px;
            border-radius: 20px;
            margin-top: 12px;
        }
        /* Mobile Responsiveness */
        @media only screen and (max-width: 600px) {
            .wrapper {
                margin: 0 auto !important;
                padding: 10px !important;
            }
            .header {
                padding: 32px 20px !important;
            }
            .body {
                padding: 32px 20px !important;
            }
            .btn-reset {
                display: block !important;
                padding: 16px 12px !important;
                font-size: 15px !important;
            }
            .card {
                border-radius: 0 !important;
            }
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="card">

            {{-- Header --}}
            <div class="header">
                <div class="lock-icon">
                    <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path d="M18 10h-1V7a5 5 0 0 0-10 0v3H6a2 2 0 0 0-2 2v8a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2v-8a2 2 0 0 0-2-2zm-6 7a2 2 0 1 1 0-4 2 2 0 0 1 0 4zm3.1-7H8.9V7a3.1 3.1 0 0 1 6.2 0v3z"/>
                    </svg>
                </div>
                <h1>Password Reset Request</h1>
                <p>Dr. Yuvraj Jadeja — Admin Panel</p>
            </div>

            {{-- Body --}}
            <div class="body">
                <p class="greeting">Hello, {{ $userName }} 👋</p>

                <p class="message">
                    We received a request to reset the password for your admin account. 
                    Click the button below to create a new password. This link will expire in 
                    <strong>{{ $expiresIn }} minutes</strong>.
                </p>

                <div class="btn-container">
                    <a href="{{ $resetUrl }}" class="btn-reset">
                        🔐 &nbsp; Reset My Password
                    </a>
                </div>

                <div class="warning-box">
                    <strong>⚠️ Didn't request this?</strong>
                    If you did not request a password reset, no action is required. Your password will remain unchanged. However, if you suspect unauthorized access, please contact your system administrator immediately.
                </div>

                <div class="divider"></div>

                <div class="url-fallback">
                    <p>If the button above doesn't work, copy and paste this URL into your browser:</p>
                    <a href="{{ $resetUrl }}">{{ $resetUrl }}</a>
                </div>
            </div>

            {{-- Footer --}}
            <div class="footer">
                <div class="site-name">Dr. Yuvraj Jadeja</div>
                <p>
                    This is an automated security email from the admin panel.<br>
                    Please do not reply to this email.
                </p>
                <span class="security-note">
                    🔒 Secure &amp; Encrypted Connection
                </span>
            </div>

        </div>

        {{-- Bottom caption --}}
        <p style="text-align:center; font-size:11px; color:#aaaaaa; margin-top:20px;">
            © {{ date('Y') }} Dr. Yuvraj Jadeja. All rights reserved.
        </p>
    </div>
</body>
</html>
