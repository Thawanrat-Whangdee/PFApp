<?php

/** @var yii\web\View $this */

use app\models\Expenses;
use app\models\Savings;
use yii\helpers\Html;

$this->title = 'Pie';
?>

<!DOCTYPE html>

<head>
    <link href="https://fonts.googleapis.com/css2?family=Balsamiq+Sans&family=Hind+Siliguri:wght@300&family=Nunito&family=Open+Sans&family=Sarabun:wght@200&display=swap" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        body {
            font-family: 'Balsamiq Sans', cursive;
        }

        .border {
            border-radius: 10rem;
        }

        .card {
            box-shadow: 3px 3px 10px rgba(0, 0, 0, 0.2);
            width: 40%;
            margin: 2rem auto;
            height: 560;
            border-radius: 30px;
        }

        .font {
            font-size: 14px;
        }
    </style>
    <script src="https://kit.fontawesome.com/c3c7a2a31a.js" crossorigin="anonymous"></script>
</head>

<body style="background-color: #f8f9fa;">
    <div class="site-index font">
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
            <h5 style="margin-top: 5px; margin-bottom: 10px;">Summary</h5>
            <div style="margin-top: 15px; margin-bottom:10px;">
                <?= Html::a('<img src="https://cdn-icons-png.flaticon.com/512/126/126762.png" width="35" height="35">', ['/site/bar'], ['class' => 'btn btn-light border font']); ?>
                <?= Html::a('<img src="https://cdn-icons-png.flaticon.com/512/163/163727.png" width="35" height="35">', ['/site/line'], ['class' => 'btn btn-light border font']); ?>
                <?= Html::a('<img src="https://cdn-icons-png.flaticon.com/512/1274/1274983.png" width="35" height="35">', ['/site/pie'], ['class' => 'btn btn-info border font']); ?>
            </div>
        </center>
    </div>


    <div>
        <canvas id="myChart"></canvas>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <?php 
    $currentMonth = date('m');
    $currentYear = date('Y');
    $expense = Expenses::find()
    ->where([
        "create_by" => (String) Yii::$app->user->identity->id,
    ])
    ->andWhere(['like', 'create_date', $currentYear . '-' . $currentMonth])
    ->all();

    $total_expense = 0;
    $total_save = 0;

    $expense_amount = [];
    foreach ($expense as $e) {
        $expense_amount[] = $e->amount;
    }
    $total_expense = array_sum($expense_amount);

    $saving = Savings::find()->where(["user_id"=>(String)Yii::$app->user->identity->id])->all();
    $save_amount = [];
    foreach ($saving as $s) {
        $save_amount[] = $s->amount;
    }
    $total_save = array_sum($save_amount);

    $total = 0;
    $expense_percentage = 0;
    $saving_percentage = 0;
    $total = $total_expense + $total_save;
    if ($total_expense != 0) {
        $expense_percentage = ($total_expense / $total) * 100;
        $saving_percentage = ($total_save / $total) * 100;
    }
    
    ?>

    <script>
        const ctx = document.getElementById('myChart');

        new Chart(ctx, {
            type: 'pie',
            data: {
                labels: ['Saving', 'Expense'],
                datasets: [{
                    label: 'percent',
                    data: [<?= $saving_percentage ?>, <?= $expense_percentage ?>],
                    borderWidth: 1
                }]
            }
        });
    </script>
</body>

</html>