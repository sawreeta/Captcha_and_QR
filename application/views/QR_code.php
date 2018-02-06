<!DOCTYPE html>
<html>
    <head>
        <title>Google Authenticator</title>
        <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
        <style type="text/css">
            *{margin:0;padding:0}
            body{color:#FEFEFE;background:#4A4E4F;font-family:'Open Sans', sans-serif;font-size:16px;line-height:2}
            h1{color:#F15841;font-size:30px}
            h2{color:#30B257;font-size:20px}
            a{color:#9DA08D}
            .container{width:80%;margin:100px auto;text-align:center}
            .qrcode{padding:10px;background:#fff;width:200px;height:200px;margin:20px auto;line-height:0;box-shadow:0 0 10px rgba(0,0,0,0.75)}
            form{width:250px;margin:20px auto}
            input{border:1px solid #000;font-size:20px;padding:5px 10px;text-align:center;width:128px;float:left}
            button{font-size:20px;padding:5px 0;float:right;width:100px;border:0;background:#000000;color:#fff;cursor:pointer}
            .error{background:#F15841;color:#fff;margin:20px auto;padding:5px;text-align:center;width:240px}
            .success{background:#30B257;color:#fff;margin:20px auto;padding:5px;text-align:center;width:240px}
        </style>
    </head>
    <body>
        <div class="container">
                <h1>Google Authentication</h1>
                <h2>a. Scan this QRCode with your smarphone</h2>
                <p>
                    Use Google Authenticator for mobile
                    <a href="https://play.google.com/store/apps/details?id=com.google.android.apps.authenticator2" target="_blank">Android</a>
                    or
                    <a href="https://itunes.apple.com/fr/app/google-authenticator/id388497605" target="_blank">iPhone</a>
                </p>
                <div class="qrcode"><img src="<?php echo $qrCodeUrl;?>" alt=""/></div>
                <h2>b. Copy/paste vérification code</h2>
                <form method="post" action="">
                <input placeholder="secretKey" type="hidden" name="secret" value="<?php echo $secret; ?>"/>
                    <input placeholder="code" type="text" name="code" maxlength="6"/>
                    <input type="submit" value="Signin"/>
                    <div style="clear:both"></div>
                </form>
                <span class="error"><?php echo $success;?></span>
        </div>
    </body>
</html>