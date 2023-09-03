<?php

/** @var yii\web\View $this */

use yii\helpers\Html;

$this->title = 'PFMS';
?>
<!DOCTYPE html>

<head>
    <script src="https://kit.fontawesome.com/c3c7a2a31a.js" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css2?family=Balsamiq+Sans&family=Hind+Siliguri:wght@300&family=Nunito&family=Open+Sans&family=Sarabun:wght@200&display=swap" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        body {
            font-family: 'Balsamiq Sans', cursive;
        }

        .btn-custom {
            background-color: #00CCCC;
            color: white;
            border-radius: 30px;
            width: 70%;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            /* เพิ่มเงาให้กับปุ่ม */
            border: 0px solid green;
            /* สีของขอบของปุ่ม */
        }

        .circle-image {
            width: 80px;
            /* กำหนดความกว้างของรูป */
            height: 40px;
            /* กำหนดความสูงของรูป */
            border-radius: 50%;
            /* กำหนดรัศมีของมุมให้เป็นครึ่งของความกว้างเพื่อทำให้เป็นวงกลม */
            overflow: hidden;
            /* กำหนดให้เปิดการตัดเอาขอบนอกของรูปที่เกินละเอียดของรูปออกไป */
        }
    </style>
</head>


<!-- <body style="background-color: #41DBC6;background-size: cover;background-position: center;"> -->
<body style="background-image: url('https://img.freepik.com/premium-photo/abstract-blurred-gradient-background-multi-color-mint-green-tiffany-blue-turquoise-color-background-banner-template_335640-3642.jpg?w=360');background-size: cover;background-position: center;">
    
    <div class="site-index">
        <div style="color: #0B0B45; text-align:center;">
            <br />
            <center>
                <table style="width:100%; text-align:center;">
                    <tr>
                        <td style="padding-top:100px;">
                            <img src="../assets/pics/logo1.jpg" style="height: 80px;" class="circle-image">
                        </td>
                    </tr>
                    <tr>
                        <td> 
                            <div style="font-size: 11px;color:white;padding-top:10px;padding-bottom:50%;">
                                    Let us help you balance your finances.
                            </div>
                        </td>
                    </tr>
                </table>
                
            </center>
            <?php if (Yii::$app->user->isGuest): ?>
                <?= Html::a('Create an account', ['site/signup'], ['class' => 'btn btn-success btn-rounded btn-custom', 'style' => 'margin-top: 60px;']) ?>
                <div style="color: #0ececec; margin-top: 10px;">Already have an account? <?= Html::a('Login', ['site/login'], ['class' => 'profile-link','style' => 'color:green;']) ?></div>
            <?php else: ?>
                <?= Html::a('Go to overview page >>', ['site/overview'], ['class' => 'profile-link', 'style'=>'color:white;']) ?>
            <?php endif; ?>
                

        </div>
        <div class="body-content">


        </div>
    </div>
</body>

</html>