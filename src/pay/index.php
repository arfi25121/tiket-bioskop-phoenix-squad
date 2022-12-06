<?php
require __DIR__ . '/../include/lib.php';
parameter_must_exist('id');
$id = $_GET['id'];
$q = $db->prepare("SELECT * FROM `pembelian_tiket` where id = :id");
$q->execute([
    'id' => $_GET['id']
]);
$data = $q->fetch();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head id="Head1">
    <meta http-equiv="refresh" content="6; url=./success?id=<?= $_GET['id'] ?>">
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <link href="./s/bootstrap.min.css" rel="stylesheet" />
    <script src="./s/jquery-3.4.1.min.js" type="a01eb6b4a277eb213e0c664c-text/javascript"></script>
    <link href="https://fonts.googleapis.com/css?family=Oxygen|PT+Sans|Quicksand" rel="stylesheet" />
    <link rel="stylesheet" href="./s/font-awesome.min.css" />
    <link href="./styleQRIS.css" rel="stylesheet" />
    <title>Payment #<?= $_GET['id'] ?></title>
    <style>
        .qr-code img {
            text-align: center;
            width: 200px;
        }
    </style>
</head>

<body id="bodyContainer" style="background-image:url(bg.jpg);">

    <div class="container h-100">
        <div class="row justify-content-center align-items-center h-100">
            <form method="post" action="./TopUpQrisPaymentPage.aspx?reference=SPQZ26UGUOYCXZQEL" id="Form1" class="cc_form" style="width: 100%;">
                <div class="aspNetHidden">
                    <input type="hidden" name="__VIEWSTATEGENERATOR" id="__VIEWSTATEGENERATOR" value="56973D42" />
                    <input type="hidden" name="__EVENTVALIDATION" id="__EVENTVALIDATION" value="/wEdAAOK93CTDVtOa8HjuXUKukAA1bB5ykFd7osjnh+G/wLqfb8N2LnyL92xDpoudgkhQGazeDtsY8KTmA4S5hBdG+kllsduHg==" />
                </div>

                <div class="main-header shadow-sm" style="width: 100%;">
                    <div class="row">
                        <div class="col-7 col-sm-8 text-left" style="padding-right: 0px; display: inherit;">
                            <a id="back" href="javascript:__doPostBack(&#39;back&#39;,&#39;&#39;)"><span class="fa fa-chevron-left" style="padding-right: 0px; padding-top:8px;"></span></a>
                            <img src="./s/divider.png" class="img-fluid" style="margin-left: 15px; width: 6px; height: 41px;">
                            <h4 class="overtext"><span id="labelMerchantName" style="color: #003366!important;font-size:16px;"> </span></h4>
                        </div>
                        <div class="col-5 col-sm-4">
                            <img id="bankLogo" class="img-fluid float-right" src="./1-shopeepay-bag-text.png" alt="Logo Bank" style="width:70px;margin-top: 7px; " /></label>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-12 main-content">
                    <div class="load" id="Div1">
                        <div style="display:none;" id="Div2"></div>
                    </div>
                    <div class="warp-clas h-100 text-center">
                        <div class="main-detail shadow-sm">
                            <div class="row dtl_l shadow-sm" style="padding-left:20px; padding-right:20px;">
                                <div class="col-8 col-sm-7 text-left" style="padding:0px;">
                                    <span class="rp_l">Rp</span>
                                    <span class="amount_l"><span id="LabelAmountPay" class="pgname"><?= $data['total'] ?></span></span>
                                </div>
                                <div class="col-4 col-sm-5 text-right" style="margin-top: 10px; padding:0px;">
                                    <a href="#" data-toggle="modal">
                                        <p class="jumlah_l">Show Detail<i class="fa fa-caret-right" style="margin-left:4px;"></i></p>
                                    </a>
                                </div>
                            </div>
                        </div>

                        <div class="mid-content shadow-sm">
                            <div class="pay">
                                <div class="row pay1 text-right" style="display:none;">
                                    <div class="col-12 col-sm-12" style="padding-right: 10px;">
                                        <a href="#ModalHowtopay" data-toggle="modal"><span class="jumlah_l">Cara
                                                Pembayaran <i class="fa fa-question-circle"></i></span></a>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <img style="width:80px;" src="./qris-standard.png" />
                            </div>
                            <div class="qr-code my-2" style="display:flex; flex-direction:row; align-items:center; justify-content:center;width:100%" id="qrcode"></div>

                            <div style="display:flex; flex-direction:row; align-items:center; justify-content:center;">
                                <span>NMID:&nbsp;</span>
                                <span id="NmidField"><?php echo hash('md5', $_GET['id']); ?></span>
                            </div>
                            <img src="./bg-client-01.png" class="img-fluid mx-auto d-block shadow-sm" width="300px;" style="margin-top: 10px;">
                        </div>
                        <div class="secured-payment-1">
                            <div class="row sec1">
                                <div class="col-3  col-sm-5" style="padding: 0px;">
                                    <p style="float: left; font-size: 12px; margin-top: 5px; margin-bottom: 8px; color: #cccccc;">
                                        Verified By OJK</p>
                                </div>
                                <div class="col-9 col-sm-7 text-right" style="padding: 0px; display: inline-block;
                            margin-bottom: 0px; padding-top: 5px">
                                    <label>
                                        &copy;
                                        <label id="year"></label>
                                        <a href="#" onclick="if (!window.__cfRLUnblockHandlers) return false; newtab()" data-cf-modified-a01eb6b4a277eb213e0c664c-="">Duitku.com</a> All rights
                                        reserved.</label>
                                </div>
                            </div>
                            <ul>
                                <li><a href="#">
                                        <div class="pci">
                                        </div>
                                    </a></li>
                                <li><a href="#">
                                        <div class="tuv">
                                        </div>
                                    </a></li>
                            </ul>
                        </div>

                    </div>

                </div>
                <div class="main-footer">
                    <div class="row bayar">
                        <div class="col-12 col-sm-12 text-center" style="padding: 0px;">
                            <input type="submit" name="btnReset" value="BACK TO MERCHANT" id="btnReset" class="btn btn-block shadow" />
                        </div>
                    </div>
                </div>
        </div>
        </form>
    </div>

    <script src="/static/js/qrcode.min.js"></script>
    <script>
        // alert(8)
        var qrcode = new QRCode(document.getElementById("qrcode"), {
            width: 100,
            height: 100
        });
        qrcode.makeCode("<?php echo hash('md5', $_GET['id']); ?>");
    </script>
    <script src="./s/bootstrap.min.js" type="a01eb6b4a277eb213e0c664c-text/javascript"></script>
    <script src="./s/rocket-loader.min.js" data-cf-settings="a01eb6b4a277eb213e0c664c-|49" defer=""></script>
</body>

</html>
<script type="a01eb6b4a277eb213e0c664c-text/javascript">
    var time = new Date();
    var year = time.getFullYear();
    document.getElementById("year").innerHTML = year;
</script>