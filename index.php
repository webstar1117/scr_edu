<?php
include 'main.php';
$error = '';
if (isset($_SESSION['loggedin'])) {
    header('Location: home.php');
    exit;
}
if (isset($_POST['policy_id'], $_POST['phone'])) {
    $stmt = $pdo->prepare('SELECT * FROM status_report WHERE contract_id = ?');
    $stmt->execute([ $_POST['policy_id'] ]);
    $acc = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($acc) {
        if ($acc['payer_phone_cell'] == $_POST['phone']) {
            $code = mt_rand(100000, 999999);
            $_SESSION['verification_code'] = $code;
            $_SESSION['policy_id'] = $_POST['policy_id'];
            $message = urlencode('Your verification code is ' . $code);
            $to = urlencode($_POST['phone']);
            $api_key = '';

            $user = 'SanlamUganda';
            $pass = 'S@nlamUg@nda1';

            //file_get_contents("https://platform.clickatell.com/messages/http/send?apiKey=$api_key&to=$to&content=$message");
            file_get_contents("https://api.clickatell.com/http/sendmsg?user=$user&password=$pass&api_id=3654463&to=$to&text=$message");
        } else {
            $error = 'Incorrect mobile number!';
        }
    } else {
        $error = 'Policy number doesn\'t exist!';
    }
}
if (isset($_POST['code']) && isset($_SESSION['verification_code'])) {
    if ($_SESSION['verification_code'] == $_POST['code']) {
        $_SESSION['loggedin'] = TRUE;
        header('Location: home.php');
        exit;
    } else {
        $error = 'Invalid code!';
    }
}
?>
<!doctype html>
<html lang="en">
<head>
    <title>Sign in</title>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <!-- <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"> -->
    <meta http-equiv="X-UA-Compatible" content="IE=9; IE=8; IE=5; IE=Edge">
    <meta name="viewport" content="width=1,initial-scale=1,maximum-scale=1,minimum-scale=1,user-scalable=no">
    <base >
        <meta name="description" content="Sanlam Sign in Page">
        <meta property="og:title" content="Sanlam Sign in">
        <meta property="og:url" content="index.html">
        <meta property="og:type" content="website">
        <meta property="og:description" content="Access your combined portfolio of Sanlam products">
        <meta property="og:image" content="wssecure/img/Whatsapp.jpg">
        <meta property="og:image:secure_url" content="wssecure/img/Whatsapp.jpg">
        <meta property="og:image:type" content="image/jpeg">
        <meta name="page-type" content="login">
        <title>Sign in</title>
        <link rel="shortcut icon" href="wssecure/img/favicon.ico" type="image/x-icon">
<link href="wssecure/css/base-d04b38b7f2a3d8afad76.css" rel="stylesheet"><link href="wssecure/css/login-d04b38b7f2a3d8afad76.css" rel="stylesheet"></head>
<body>
<nav class="navbar navbar-expand-lg navbar-light">
    <a class="navbar-brand" href="#">
        <div class="logo"></div>
    </a>
</nav>
            <main>

<div class="container container--login">
    <div class="row">
      <div class="col-sm-10 col-md-8 col-lg-6 mx-auto">
<div class="card login-card">
    <div class="card-body">
        <?php if (!isset($_SESSION['verification_code'])): ?>
        <section class="login-card_heading">
            <nav class="login-nav">
                <section class="login-nav_heading">
                    <strong class="">Sign In</strong>
                </section>
                <ul class="login-nav_items">
                    <li>
                        <a href="email-signin.php">Email Sign in</a>
                    </li>
                </ul>
            </nav>
        </section>
        <section class="login-card_content">
                <form class="form" name="frmMain" id="frmMain" method="post" action="">
                    <div class="form-group">
                        <input class="form-control" id="policy_id" type="text" name="policy_id" size="15" placeholder="Policy ID" tabindex="1" required>
                        <label for="policy_id">Policy ID</label>

                    </div>

                    <div class="form-group">
                        <input class="form-control" type="tel" id="phone" name="phone" autocomplete="off" size="15" placeholder="+256XXXXXXXXX" tabindex="2" required>
                        <label for="phone">Phone Number</label>

                    </div>

                    <p id="displayText"><?=$error?></p>

                    <section class="button-container">
                            <button class="btn btn-primary btn_rounded" type="submit">
                                Sign In
                            </button>
                    </section>
                </form>
        </section>
        <?php else: ?>
            <section class="login-card_heading">
                <nav class="login-nav">
                    <section class="login-nav_heading">
                        <strong class="">Enter the SMS Verification Code</strong>
                    </section>
                </nav>
            </section>
            <section class="login-card_content">
                    <form class="form" name="frmMain" id="frmMain" method="post" action="">
                        <div class="form-group">
                            <input class="form-control" id="code" type="text" name="code" size="15" placeholder="Verification Code" tabindex="1" required>
                            <label for="code">Verification Code</label>
                        </div>

                        <p id="displayText">
                            <?=$error?>
                        </p>

                        <section class="button-container">
                                <button class="btn btn-primary btn_rounded" type="submit">
                                    Verify
                                </button>
                                <a class="btn btn-primary btn_rounded btn-warning" href="logout.php">Cancel</a>
                        </section>
                    </form>
            </section>
        <?php endif; ?>

    </div>
</div>                </div>
    </div>
</div>        </main>
<footer class="page-footer">
    <div class="row page-footer_row">
        <section class="col-md-4 col-xl-3 order-2 order-md-0 page-footer_logo-container">
            <div class="logo"></div>
        </section>
        <section class="col-md-4 col-xl-6 order-1 page-footer_copyright-container">
            <p class="text-left text-md-center page-footer_copyright-text">
                Copyright © 2020 All rights reserved.<br>
                Sanlam Life Insurance Uganda Limited is a Licensed Financial Services Provider and Life Insurance
                Provider.
            </p>
        </section>
        <section class="col-md-4 col-xl-3 order-0 order-md-2 page-footer_help-container">
            <div class="page-footer_help-icon">
                <div class="phone-icon_border--blue">
                    <div class="phone-icon"></div>
                </div>
            </div>
            <div class="page-footer_help-text-container">
                <p class="page-footer_help-text"><span class="text-nowrap">Need help?</span> <span class="text-nowrap">+256 417 726 526 </span></p>
                <p class="page-footer_help-text--subtext"><span class="text-nowrap">Monday - Friday</span> <span class="text-nowrap">08:00 - 16:30</span></p>
            </div>
        </section>
    </div>
</footer>

<!-- Mirrored from cp.sanlam.co.za/ by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 10 Oct 2020 06:51:51 GMT -->
</html>
