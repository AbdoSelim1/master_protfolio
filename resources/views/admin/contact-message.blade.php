<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form</title>
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
            flex-wrap: wrap;
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
        }

        .message {
            line-height: 1.6;
            padding: 20px;
            border-radius: 20px;
            border: 1px solid #000;
        }
    </style>
</head>

<body>
    <h1>New Customer</h1>
    <div class="box container">
        <div class="head d-flex justify-content-between">
            <div class="name">{{ $mailData->full_name }}</div>
            <div class="mail">{{ $mailData->email }}</div>
        </div>

        <div class="body">
            <div class="text-center mt-2 fw-bold">Need To Send Message For You</div>
            <div class="message mt-2">
                <div class="text-center fw-bold">Message</div>
                <p>{{ $mailData->message }}</p>
            </div>
        </div>

        <div class="mt-1 foot text-center">
            Thank You {{ env('APP_NAME') }} For Reading My Message
        </div>

    </div>
</body>

</html>
