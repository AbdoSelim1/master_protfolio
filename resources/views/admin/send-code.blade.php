<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ env('APP_NAME') }}</title>
    <style>
        body {
            background-color: #1e1e28;
            color: #fff;
            font-family: Arial, Helvetica, sans-serif;
        }

        h1 {
            text-align: center;
            color: #ffc107;
        }

        .d-flex {
            display: flex;
        }

        .fw-bold {
            font-weight: 900;
        }

        .mt-2 {
            margin-top: 2rem;
        }

        .mt-1 {
            margin-top: 1.6rem;
        }

        .justify-content-between {
            justify-content: space-between;
        }

        .text-center {
            text-align: center;
        }

        .container {
            width: 80%;
            margin: 0 auto;
        }

        .box {
            background-color: #fff;
            color: #000;
            border-radius: 20px;
            padding: 2rem;
        }

        .head {
            color: #1e1e28;
            font-weight: 900;
            margin-right: 10px;
            padding: 20px;
            background-color: #ffc107;
            border-radius: 20px;
        }

        p {
            margin-top: 1.3rem;
            line-height: 2;
        }

        .message {
            line-height: 1.6;
            padding: 20px;
            border-radius: 20px;
            border: 1px solid #000;
        }

        span.code {
            padding: 10px 20px;
            background-color: blanchedalmond;
            border-radius: 20px;
        }
    </style>
</head>

<body>
    <h1>Forget Password</h1>
    <div class="box container">
        <div class="text-center fw-bold head">You Can Change Your Password</div>
        <div class="body">
            <div class="message mt-2">
                <p>Dear <span class="fw-bold">{{ $mailData->name }}</span>, You Can Use This Code: <span
                        class="code">{{ $mailData->code }}</span> to
                    Forget Your Password To Change Your Current Password, You Can Login Now Before Change Your Password
                </p>
            </div>
        </div>

        <div class="mt-1 foot text-center">
            Thank You {{ $mailData->name }}
        </div>

    </div>
</body>

</html>
