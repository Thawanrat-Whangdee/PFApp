<?php

/** @var yii\web\View $this */

use app\models\Savings;
use yii\helpers\Html;

$this->title = 'Calculator';
?>

<!DOCTYPE html>

<head>
    <link href="https://fonts.googleapis.com/css2?family=Balsamiq+Sans&family=Hind+Siliguri:wght@300&family=Nunito&family=Open+Sans&family=Sarabun:wght@200&display=swap" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        body {
            font-family: 'Balsamiq Sans', cursive;
        }

        .card {
            box-shadow: 3px 3px 10px rgba(0, 0, 0, 0.2);
            width: 40%;
            margin: 2rem auto;
            height: 560;
            border-radius: 30px;
        }

        .card:hover {
            box-shadow: 0 8px 16px 0 rgba(0, 0, 0, 0.2);
        }

        .containerB {
            width: 100%;
            padding-right: 15px;
            padding-left: 15px;
            margin-right: auto;
            margin-left: auto;
            margin-bottom: 20px;
            margin-top: 10px;
        }

        .cartTotal {
            width: 150px;
            height: 560;
            border-radius: 10px;
            text-align: center;
        }

        p {
            margin-top: 0;
            margin-bottom: 0rem;
        }

        .border {
            border-radius: 10rem;
        }

        .font {
            font-size: 14px;
        }
    </style>
    <script src="https://kit.fontawesome.com/c3c7a2a31a.js" crossorigin="anonymous"></script>
</head>

<body style="background-color: #f8f9fa; font-size: 14px;">
    <div class="site-index">
        <div class="card" style="width:100%">
            <div style="margin-top:10px; margin-bottom:10px;">
                <center>
                    <table style="border:1; width:80%; text-align:center;">
                        <tr>
                            <th>
                                <?= Html::a('<img src="https://cdn-icons-png.flaticon.com/512/3237/3237857.png" width="38" height="38">', ['/site/overview']); ?>
                            </th>
                            <th>
                                <?= Html::a('<img src="https://cdn-icons-png.flaticon.com/512/3143/3143636.png" width="32" height="32">', ['/site/calendar']); ?>
                            </th>
                            <th>
                                <?= Html::a('<img src="https://cdn-icons-png.flaticon.com/512/2331/2331785.png" width="35" height="35">', ['/site/limit']); ?>
                            </th>
                            <th>
                                <?= Html::a('<img src="https://cdn-icons-png.flaticon.com/512/4301/4301717.png" width="35" height="35">', ['/site/bar']); ?>
                            </th>
                        </tr>
                        <tr>
                            <td>Overview</td>
                            <td>Calendar</td>
                            <td>Limits</td>
                            <td>Analyze</td>
                        </tr>
                    </table>
                </center>
            </div>
        </div>
        <center>
            <div style="margin-top: 15px; margin-bottom:10px;">
                <?= Html::a('Finance', ['/site/bar'], ['class' => 'btn btn-light border font']); ?>
                <?= Html::a('Saving', ['/site/line'], ['class' => 'btn btn-light border font']); ?>
                <?= Html::a('Percentage', ['/site/pie'], ['class' => 'btn btn-light border font']); ?>
                <?= Html::a('Calculator', ['/site/calculator'], ['class' => 'btn btn-info border font']); ?>
            </div>
            <br>

            <?php 
                $amount_saving = 0;
                $_id = 0;
                $saving = Savings::find()->where(["user_id"=>(String)Yii::$app->user->identity->id])->all();
                foreach ($saving as $s) {
                    $amount_saving = $s->amount;
                    $_id = $s->_id;
                }
            ?>
            <div class="card" style="width: 100%; ">
                <div class="containerB">
                    <p style="margin-right: 200px;">Saving</p>
                    <h4 style="margin-bottom: 20px;"><b>0 THB</b></h4>
                    <table>
                        <tr>
                            <th>
                                <div class="cartTotal" style="background-color: #020035; color:white; ">
                                    <p>Goal</p>
                                    <p> <?php echo $amount_saving ?> THB </p>
                                </div>
                            </th>
                            <th>
                                <div style="margin-left: 5px;">
                                    <div class="cartTotal" style="background-color: #020035; color:white;">
                                        <p>Current savings</p>
                                        <p>0 THB</p>
                                    </div>
                                </div>
                            </th>
                        </tr>
                    </table>

                </div>
            </div>
            <?php 
                if ($_id !== 0 && $_id !== null) {
                    echo Html::a('Edit', ['/site/update-saving', '_id' => (string)$_id], ['class' => 'btn btn-primary rounded-pill shadow-lg']);
                    echo Html::a('Delete', ['/site/delete-saving', '_id' => (string)$_id], ['class' => 'btn btn-danger rounded-pill shadow-lg']); 
                }
            ?>
        </center>
    </div>
</body>

</html>