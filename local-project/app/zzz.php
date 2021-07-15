<?php
session_start();
if (count($_POST) > 0) {
    if ($_SESSION['OTP'] == $_POST['otp']) {
        $message = "Veified Successfully !";
    } else {
        $message = "Invalid OTP!";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>OTP Verification</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--===============================================================================================-->
    <link rel="icon" type="image/png" href="images/icons/favicon.ico" />
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="css/util.css">
    <link rel="stylesheet" type="text/css" href="css/main.css">
    <!--===============================================================================================-->
</head>

<body>

    <div class="limiter">
        <div class="container-login100">
            <div class="wrap-login100">
                <div class="login100-pic js-tilt" data-tilt>
                    <img src="images/img-01.png" alt="IMG">
                </div>

                <form class="login100-form validate-form">
                    <span class="login100-form-title">
                        Member Signup
                    </span>

                    <div class="wrap-input100 validate-input" data-validate="Valid email is required: ex@abc.xyz">
                        <input class="input100" type="text" name="email" placeholder="Email">
                        <span class="focus-input100"></span>
                        <span class="symbol-input100">
                            <i class="fa fa-envelope" aria-hidden="true"></i>
                        </span>
                    </div>
                    <div class="wrap-input100 validate-input" data-validate="Valid Phone no is required: 9437730730">
                        <input class="input100" type="text" name="text" placeholder="Phone" id="phone">
                        <span class="focus-input100"></span>
                        <span class="symbol-input100">
                            <i class="fa fa-envelope" aria-hidden="true"></i>
                        </span>
                    </div>
                    <span style="text-align:right;padding-left:230px;padding-top:10px;" id="verify"><button type="button" style="padding:2px;" class="btn btn-primary">Verify</button></span>
                    <span id="verified" style="display:none;color:green;">Verified Successfully !</span>

                    <div class="wrap-input100 validate-input" data-validate="Password is required">
                        <input class="input100" type="password" name="pass" placeholder="Password">
                        <span class="focus-input100"></span>
                        <span class="symbol-input100">
                            <i class="fa fa-lock" aria-hidden="true"></i>
                        </span>
                    </div>

                    <div class="container-login100-form-btn">
                        <button class="login100-form-btn" id="Signup" disabled>
                            Signup
                        </button>
                    </div>



                    <div class="text-center p-t-136">
                        <a class="txt2" href="#">
                            Already Member
                            <i class="fa fa-long-arrow-right m-l-5" aria-hidden="true"></i>
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- The Modal -->
    <div class="modal fade" id="verifyModal" data-keyboard="false" data-backdrop="static" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">

                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Enter OTP</h4>
                    <button type="button" class="close" data-dismiss="modal">×</button>
                </div>

                <!-- Modal body -->
                <div class="modal-body">
                    <p id="resend_msg" style="text-align:center;color:green;"></p>
                    <p id="error_msg" style="text-align:center;color:green;"></p>

                    <div class="wrap-input100 validate-input" data-validate="Password is required">
                        <input class="input100" type="text" id="otp" name="otp" placeholder="OTP" maxlength="6">
                        <span class="focus-input100"></span>
                        <span class="symbol-input100">
                            <i class="fa fa-lock" aria-hidden="true"></i>
                        </span>
                    </div>

                    <div class="container-login100-form-btn">
                        <button class="login100-form-btn" id="otp_submit">
                            Submit
                        </button>
                    </div>
                    <div class="container-login100-form-btn">
                        <button class="login100-form-btn" id="otp_resend">
                            Resend
                        </button>
                    </div>



                </div>

                <!-- Modal footer -->


            </div>
        </div>
    </div>


    <!--===============================================================================================-->
    <script src="vendor/jquery/jquery-3.2.1.min.js"></script>
    <!--===============================================================================================-->
    <script src="vendor/bootstrap/js/popper.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.min.js"></script>
    <!--===============================================================================================-->
    <script src="vendor/select2/select2.min.js"></script>
    <!--===============================================================================================-->
    <script src="vendor/tilt/tilt.jquery.min.js"></script>
    <script>
        $('.js-tilt').tilt({
            scale: 1.1
        })
    </script>
    <!--===============================================================================================-->
    <script src="js/main.js"></script>
    <script>
        $("#verify").click(function() {
            if ($('#phone').val() != '') {
                $("#verifyModal").modal('show');
                $.ajax({
                    type: "POST",
                    url: "otp_process.php",
                    data: {
                        type: 1,
                        phone: $('#phone').val()
                    },
                    success: function(dataResult) {
                        /*var dataResult = JSON.parse(dataResult);*/
                        if (dataResult.statusCode == 200) {

                        }
                    }
                });
            } else {
                alert("Mobile number can not be blank !");
            }
        });
        $("#otp_submit").click(function() {
            $.ajax({
                type: "POST",
                url: "otp_process.php",
                data: {
                    type: 2,
                    otp: $('#otp').val()
                },
                success: function(dataResult) {
                    var dataResult = JSON.parse(dataResult);
                    if (dataResult.statusCode == 200) {
                        $("#verifyModal").modal('hide');
                        $("#verify").hide();
                        $("#verified").show();
                        $('#Signup').removeAttr("disabled");
                    } else {
                        alert("Invalid OTP");
                        $("#error_msg").html('Invalid OTP !');
                    }
                }
            });
        });
        $("#otp_resend").click(function() {
            $.ajax({
                type: "POST",
                url: "otp_process.php",
                data: {
                    type: 3,
                    phone: $('#phone').val()
                },
                success: function(dataResult) {
                    var dataResult = JSON.parse(dataResult);
                    if (dataResult.statusCode == 200) {
                        $("#resend_msg").html('OTP Resend Successfully !');
                    }
                }
            });
        });
    </script>
</body>

</html>