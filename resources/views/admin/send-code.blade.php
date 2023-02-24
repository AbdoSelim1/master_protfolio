<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Code Verification</title>

    <style>
        .contianer {
            background-color: #9f9999;
            padding: 10px;
            width: 90%;
            margin: 20px auto;

        }

        .contianer p {
            margin-top: 20px;
            line-height: 1.6
        }

        .contianer h2 {
            color: rgb(218, 118, 13);
        }

        .box {
            width: 200px;
            margin: 20px auto;
            padding: 10px;
            border-radius: 2px;
            background-color: #ffffff;
            color: rgb(218, 118, 13)
        }
    </style>
</head>

<body>
    <div class="contianer">
        <div class="title">
            <h2>Hello {{ $mailData->name }}</h2>
            <p>Please go to the code entry page and enter it</p>
        </div>
        <div class="box">
            {{ $mailData->code }}
        </div>
    </div>
</body>

</html>
