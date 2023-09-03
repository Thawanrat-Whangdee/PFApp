<?php

/** @var yii\web\View $this */

use app\models\Expenses;
use app\models\Incomes;
use app\models\Pocket;
use app\models\Types;
use yii\helpers\Html;
use yii\mongodb\Query;

$this->title = 'Chart';
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
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

</head>

<body style="background-color: #f8f9fa; font-size: 14px;">
    <div class="site-index" >
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
                <?= Html::a('<img src="https://cdn-icons-png.flaticon.com/512/126/126762.png" width="35" height="35">', ['/site/bar'], ['class' => 'btn btn-info border font']); ?>
                <?= Html::a('<img src="https://cdn-icons-png.flaticon.com/512/163/163727.png" width="35" height="35">', ['/site/line'], ['class' => 'btn btn-light border font']); ?>
                <?= Html::a('<img src="https://cdn-icons-png.flaticon.com/512/1274/1274983.png" width="35" height="35">', ['/site/pie'], ['class' => 'btn btn-light border font']); ?>
            </div>
        </center>

    </div>

 
    <div style="margin-top:15px; margin-bottom:20px;">
        <canvas id="myChart"></canvas>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <?php 
    $currentMonth = date('m');
    $currentYear = date('Y');
    $income = Incomes::find()
    ->where([
        "create_by" => (String) Yii::$app->user->identity->id,
    ])
    ->andWhere(['like', 'create_date', $currentYear . '-' . $currentMonth])
    ->andFilterWhere(['!=', 'create_date', '2023-09-01']) // ไม่เท่ากับวันที่ 1 เดือน 9 ปี 2023
    ->all();
    $inlist = [];
    $type_i = [];
    foreach ($income as $i) {
        $inlist[] = $i->amount;
        $type_i[] = $i->income_type;
    }
    $total_income = array_sum($inlist);

    $expense = Expenses::find()
    ->where([
        "create_by" => (String) Yii::$app->user->identity->id,
    ])
    ->andWhere(['like', 'create_date', $currentYear . '-' . $currentMonth])
    ->andFilterWhere(['!=', 'create_date', '2023-09-01']) // ไม่เท่ากับวันที่ 1 เดือน 9 ปี 2023
    ->all();
    $exlist = [];
    $type_e = [];
    foreach ($expense as $e) {
        $exlist[] = $e->amount;
        $type_e[] = $e->expense_type;
    }
    $total_expense = array_sum($exlist);
    ?>

    <script>
        const ctx = document.getElementById('myChart');

        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Incomes', 'Expenses'], // กำหนดชื่อแท่งของกราฟ
                datasets: [
                    {
                        label: 'Amount',
                        data: [<?= $total_income; ?>, <?= $total_expense; ?>], // กำหนดค่าข้อมูลรายรับและรายจ่าย
                        backgroundColor: ['rgba(75, 192, 192, 0.2)', 'rgba(255, 99, 132, 0.2)'], // กำหนดสีพื้นหลังของแท่ง
                        borderColor: ['rgba(75, 192, 192, 1)', 'rgba(255, 99, 132, 1)'], // กำหนดสีเส้นขอบของแท่ง
                        borderWidth: 1
                    }
                ]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>

    <!-- ------------------------------------------------------------------------------------------------------------- -->

    <div>
        <canvas id="myChart1"></canvas>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <?php 
        $type = Pocket::find()
        ->where([
            "create_by" => (String) Yii::$app->user->identity->id,
        ])
        ->andWhere(['like', 'create_date', $currentYear . '-' . $currentMonth])
        ->andFilterWhere(['!=', 'create_date', '2023-09-01']) // ไม่เท่ากับวันที่ 1 เดือน 9 ปี 2023
        ->all();

        $type_label = [];
        $type_data = [];
        $pocket_type = [];
        foreach ($type as $v) {
            $type_label[] = $v->pocket_name;
            $type_data[] = $v->ratio;
            $pocket_type[] = $v->expense_type;
        }
        
        $expenseData = [];
        $expenses = Expenses::find()
        ->where([
            "create_by" => (String) Yii::$app->user->identity->id,
        ])
        ->andWhere(['like', 'create_date', $currentYear . '-' . $currentMonth])
        ->andFilterWhere(['!=', 'create_date', '2023-09-01']) // ไม่เท่ากับวันที่ 1 เดือน 9 ปี 2023
        ->all();
        foreach ($expenses as $expense) {
            $expenseData[$expense->expense_type][] = (float) $expense->amount;
        }
        $totalAmount = [];
        foreach ($pocket_type as $type) {
            $totalAmount[] = array_sum($expenseData[$type] ?? []);
            
        }
        $label = json_encode($type_label);
        $data = json_encode($totalAmount);
    ?>

    <script>
        const ctx1 = document.getElementById('myChart1');

        new Chart(ctx1, {
            type: 'bar',
            data: {
                labels: <?= $label; ?>,
                datasets: [{
                    label: 'Total expense of each pocket',
                    data: <?= $data; ?>,
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
    <!-- ------------------------------------------------------------------------------------------------------- -->
    <div>
        <canvas id="myChart2"></canvas>
    </div>

    <?php 
        $ex = Expenses::find()
        ->where([
            "create_by" => (String) Yii::$app->user->identity->id,
        ])
        ->andWhere(['like', 'create_date', $currentYear . '-' . $currentMonth])
        ->andFilterWhere(['!=', 'create_date', '2023-09-01']) // ไม่เท่ากับวันที่ 1 เดือน 9 ปี 2023
        ->all();

        $type_data = [];
        $pocket_type = [];
        foreach ($ex as $v) {
            $type_data[] = $v->amount;
            $pocket_type[] = $v->expense_type;
        }
        
        $expenseData = [];
        $expenses = Expenses::find()
        ->where([
            "create_by" => (String) Yii::$app->user->identity->id,
        ])
        ->andWhere(['like', 'create_date', $currentYear . '-' . $currentMonth])
        ->andFilterWhere(['!=', 'create_date', '2023-09-01']) // ไม่เท่ากับวันที่ 1 เดือน 9 ปี 2023
        ->all();
        foreach ($expenses as $expense) {
            $expenseData[$expense->expense_type][] = (float) $expense->amount;
        }
        
        $totalAmount = [];
        foreach ($expenseData as $type => $amounts) {
            $totalAmount[$type] = array_sum($amounts);
        }
        
        $label_ex = json_encode(array_keys($totalAmount)); // ใช้ array_keys เพื่อให้ได้ array ของ expense_type
        $data_ex = json_encode(array_values($totalAmount)); // ใช้ array_values เพื่อให้ได้ array ของยอดรวม
    ?>
    <script>
        const ctx2 = document.getElementById('myChart2');

        new Chart(ctx2, {
            type: 'bar',
            data: {
                labels: <?= $label_ex; ?>,
                datasets: [{
                    label: 'Total expense of each type',
                    data: <?= $data_ex; ?>,
                    borderWidth: 1
                }]
            },
            options: {
                indexAxis: 'y',
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
    
</body>

</html>