<?php
require __DIR__ . '/../include/lib.php';
parameter_must_exist('id');
$id = $_GET['id'];
$q = $db->prepare("SELECT * FROM `pembelian_tiket` where id = :id");
$q->execute([
    'id' => $_GET['id']
]);
$data = $q->fetch();

$q = $db->prepare("UPDATE `pembelian_tiket` SET `status` = 'paid' WHERE `id` = :id");
$q->execute([
    'id' => $_GET['id']
]);
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head id="Head1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <meta http-equiv="refresh" content="5; url=../invoice?id=<?= $_GET['id'] ?>&success=true">
    <link href="./s/bootstrap.min.css" rel="stylesheet" />
    <script src="./s/jquery-3.4.1.min.js" type="7fb14af9140579c19c52ff4e-text/javascript"></script>
    <link href="https://fonts.googleapis.com/css?family=Oxygen|PT+Sans|Quicksand" rel="stylesheet" />
    <link rel="stylesheet" href="./s/font-awesome.min.css" />
    <link href="./s/styleNotification.css" rel="stylesheet" />
    <title>
        Notification
    </title>
    <style>
        body{
            background: url("./s/background.svg") no-repeat fixed center center/cover;
        }
    </style>
</head>
<body id="bodyContainer" onload="f1()">

    <div class="container h-100">
        <div class="row justify-content-center align-items-center h-100">
            <form method="post" action="/invoice?id=<?= $_GET['id'] ?>" id="cc_form" role="form" class="cc_form" style="width: 100%;">

                <div class="main-header shadow-sm" style="width: 100%;">
                    <div class="row">
                        <div class="col-12 col-sm-12 text-center">
   
                        </div>
                    </div>
                </div>

                <div class="col-12 col-sm-12 main-content">
                    <div class="load" id="load">
                        <div style="display:none;" id="loader"></div>
                    </div>

                    <div id="success" class="warp-clas h-100">
                        <div class="main-detail shadow-sm">
                            <div class="row dtl_l" style="padding-left:25px; padding-right:25px;">
                                <div class="col-12 col-sm-12 text-center" style="padding:0px;">
                                    <span><i class="fa fa-check-circle-o" style="font-size: 70px; color: #00b300;"></i></span>
                                </div>
                            </div>
                            <div class="row sc">
                                <div class="col-12 col-sm-12 text-center">
                                    <span>SUCCESS</span>
                                    <p style="margin-bottom: 0px;">You have successfully transferred</p>
                                </div>
                            </div>
                        </div>
                        <div class="payment-category shadow-sm">
                            <div class="row rinc">
                                <div class="col-5 col-sm-6 text-left" style="padding-right: 0px;padding-top:4px">
                                    <label style="margin-bottom:2.2px">Invoice Number</label>
                                    <br />
                                    <span><?= $_GET['id'] ?? '1' ?></span>
                                </div>
                                <div class="col-7 col-sm-6 text-right" style="padding-left: 0px; padding-top: 5px;">
                                    <span class="rp_l">Rp</span>
                                    <span class="amount_l" style="font-size: 23px;"><?= $data['total'] ?></span>
                                </div>
                            </div>
                            <hr style="margin-top:20px; margin-bottom: 0px; border-top: 1px solid rgba(0, 67, 255, 0.1);" />
                            <br />
                            <div class="row" style="padding-top:0.2px">
                                <div class="col-12 col-sm-12 text-center">
                                    <p><b>Transaksi Berhasil,</b> Terimakasih atas kepercayaan anda telah bertransaksi di <b><?= $app_name ?? '-' ?>.</b></p>
                                    <br />
                                    <p>Anda akan dialihkan kembali ke halaman pembayaran secara otomatis dalam 5 detik.</p>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="main-footer">
                    <div class="row bayar">
                        <div class="col-12 col-sm-12 text-center" style="padding: 0px;">
                            <input type="submit" name="" value="KEMBALI" class="btn btn-block shadow" style="font-size:18px; letter-spacing:0.7px;" />
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <script language="javascript" type="7fb14af9140579c19c52ff4e-text/javascript">
        var tmp;

        function f1() {
            tmp = setInterval(countdown, 1000);
        }
        var timeLeft = 10;

        function countdown() {

            if (timeLeft === 0) {
                //clearTimeout(timerId);
                document.getElementById("submitbutton").click();
                timeLeft--;
                clearInterval(tmp);
            } else {
                //document.getElementById("fsec").style.display = "block";

                if (document.getElementById('success') != null) {
                    document.getElementById('ssec').innerHTML = timeLeft;
                } else {
                    document.getElementById('fsec').innerHTML = timeLeft;
                }
                timeLeft--;
            }
        }
    </script>
    <script type="7fb14af9140579c19c52ff4e-text/javascript">
        if (window.history.replaceState) {
            window.history.replaceState(null, null, window.location.href);
        }
    </script>
    <script src="./s/Notification.js" type="7fb14af9140579c19c52ff4e-text/javascript"></script>
    <script src="./s/bootstrap.min.js" type="7fb14af9140579c19c52ff4e-text/javascript"></script>
</body>
</html>