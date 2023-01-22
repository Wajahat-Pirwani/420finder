<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Coming Soon</title>
    <style>
        .mobile{
            display: none;
        }
        @media only screen and (max-width: 600px) {
            .mobile{
                display: block;
            }
            .desktop{
                display: none;
            }
        }
    </style>
</head>
<body style="margin: 0px">
<img class="desktop"  style="width: 100%; height: 100vh; padding: 0px" src="{{asset('img.jpg')}}" alt="">
<img class="mobile"  style="width: 100%; height: 100vh; padding: 0px" src="{{asset('420finder_massemail_landingpage_mobile.jpg')}}" alt="">

</body>
</html>
