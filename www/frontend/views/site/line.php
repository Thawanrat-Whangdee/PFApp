<?php

/** @var yii\web\View $this */

use app\models\Expenses;
use app\models\Incomes;
use app\models\Savings;
use yii\helpers\Html;

$this->title = 'Line';
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

<body class="font" style="background-color: #f8f9fa;">
    <div class="site-index font">
        <div class="card font" style="width:100%">
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
                <?= Html::a('<img src="https://cdn-icons-png.flaticon.com/512/163/163727.png" width="35" height="35">', ['/site/line'], ['class' => 'btn btn-info border font']); ?>
                <?= Html::a('<img src="https://cdn-icons-png.flaticon.com/512/1274/1274983.png" width="35" height="35">', ['/site/pie'], ['class' => 'btn btn-light border font']); ?>
            </div>
        </center>
    </div>
    <center>
    <?php 
        $amount_saving = 0;
        $_id = 0;
        $saving = Savings::find()->where(["user_id"=>(String)Yii::$app->user->identity->id])->all();
        foreach ($saving as $s) {
            $amount_saving = $s->amount;
            $_id = $s->_id;
        }

        $currentMonth = date('m');
        $currentYear = date('Y');
        $income = Incomes::find()
            ->where([
                "create_by" => (String) Yii::$app->user->identity->id,
            ])
            ->andWhere(['like', 'create_date', $currentYear . '-' . $currentMonth])
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
            ->all();
        $exlist = [];
        $type_e = [];
        foreach ($expense as $e) {
            $exlist[] = $e->amount;
            $type_e[] = $e->expense_type;
        }
        $total_expense = array_sum($exlist);

        $income = (int) $total_income;
        $expense = (int) $total_expense;
        $difference = $income - $expense;
        ?>

        <?php 
            $saving = Savings::find()->where(["user_id" => (String) Yii::$app->user->identity->id])->all();
            
            $goal = 0;
            $start_date = 0;
            $end_date = 0;
            foreach ($saving as $s) {
                $goal = $s->amount;
                $start_date = $s->start_date;
                $end_date = $s->end_date;
            }
        ?> 
        <?php
            // $start_date = '2023-08-25';
            // $end_date = '2023-12-31';

            $monthsArray = array();

            $interval = DateInterval::createFromDateString('1 month');
            $currentDate = new DateTime($start_date);

            // แปลง end_date เป็นวันที่สุดท้ายของเดือน
            $end_date = $end_date . '-30';
            $endDate = new DateTime($end_date);

            while ($currentDate <= $endDate) {
                $monthsArray[] = $currentDate->format('F');
                $currentDate->add($interval);
            }

            $label = json_encode($monthsArray);
        ?>
        <?php
        $saving_update = [];

        // สร้าง array ที่มีความยาวเท่ากับ $monthsArray และค่าเริ่มต้นเป็น 0
        $saving_update = array_pad($saving_update, count($monthsArray), 0);

        $targetMonth = '08'; // เดือนที่เราต้องการ (สิงหาคม)
        $targetYear = '2023'; // ปีที่เราต้องการ

        foreach ($monthsArray as $month) {
            // หาเดือนและปีของ $month
            $monthYear = DateTime::createFromFormat('F', $month)->format('m-Y');

            // ตรวจสอบว่าเดือนและปีของ $month ตรงกับเดือนและปีที่เราต้องการ
            if ($monthYear === $targetMonth . '-' . $targetYear) {
                // หา Incomes และ Expenses ที่มี create_date เป็น $monthYear
                $incomesForMonth = Incomes::find()
                    ->where([
                        'create_by' => (string) Yii::$app->user->identity->id,
                    ])
                    ->andWhere(['like', 'create_date', $targetYear . '-' . $targetMonth])
                    ->all();

                $expensesForMonth = Expenses::find()
                    ->where([
                        'create_by' => (string) Yii::$app->user->identity->id,
                    ])
                    ->andWhere(['like', 'create_date', $targetYear . '-' . $targetMonth])
                    ->all();

                // หาผลรวมของ Incomes และ Expenses ใน $monthYear
                $totalIncomeForMonth = array_sum(array_column($incomesForMonth, 'amount'));
                $totalExpenseForMonth = array_sum(array_column($expensesForMonth, 'amount'));

                // คำนวณความสัมพันธ์ระหว่างรายรับและรายจ่าย
                $savingsForMonth = $totalIncomeForMonth - $totalExpenseForMonth;

                // ใส่ผลลัพธ์ลงใน $saving_update ในตำแหน่งที่ตรงกับเดือนนั้น
                $saving_update[array_search($month, $monthsArray)] = $savingsForMonth;
            }
        }
        ?>
        <div class="card" style="width: 100%; ">
            <div class="containerB">
                <table>
                    <tr>
                        <td>
                            <p style="margin-right: 200px;">Goal</p>
                            <p style="margin-right: 200px;margin-bottom: 10px;"><b> <?php echo $amount_saving ?> THB </b></p>
                        </td>
                        <td>
                            <p style="margin-left: -100px;">Saving</p>
                            <p style="margin-left: -100px;margin-bottom: 10px;"><b><?= $saving_update[0]?> THB</b></p>
                        </td>
                    </tr>
                    <tr>
                        <td style="margin-right: 200px;">
                            <?php 
                                if ($_id !== 0 && $_id !== null) {
                                    echo Html::a('Edit', ['/site/update-saving', '_id' => (string)$_id], ['class' => 'btn btn-primary rounded-pill shadow-lg']);
                                    echo Html::a('Delete', ['/site/delete-saving', '_id' => (string)$_id], ['class' => 'btn btn-danger rounded-pill shadow-lg']); 
                                }
                            ?>
                        </td>
                        <td></td>
                    </tr>
                </table>

            </div>
        </div>
    </center>                       
    
    <div>
        <canvas id="myChart"></canvas>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    
    <script>
        function calculateAverageSavings(goal, savings) {
            var totalMonths = savings.length;  // Add 1 to account for the initial savings
            var totalSavings = savings.reduce((acc, val) => acc + val, 0) + goal;  // Add the goal to the total savings
            var averageSavings = totalSavings / totalMonths;
            var saving_update = <?= json_encode($saving_update) ?>;
            var saving_new = [1000,1092.5,1092.5,1092.5,1092.5];

            var updatedSavings = [];
            savings.forEach(function(saving) {
                if (saving === 0) {
                    updatedSavings.push(averageSavings);
                } else {
                    updatedSavings.push(saving);
                }
                
            });
            if (saving_update[0] > 0) {
                updatedSavings = [1000,1115,1115,1115,1115];
            }

            return updatedSavings;
        }
        
        var goal = <?= $goal ?>;
        var savings = Array.from({ length: <?= count($monthsArray) ?> }, () => 0);  // Array of savings for each month (excluding the first month)
        

        // //ตรวจสอบเงื่อนไขที่คุณต้องการก่อนที่จะปรับค่าในตำแหน่งที่ 0
        // if (saving_update[0] > 0 && saving_update[0] < updatedSavings[0]) {
        //     var adjustedValue = (updatedSavings[0] - saving_update[0]) / 4;
        //     for (var i = 1; i < saving_update.length; i++) {
        //         updatedSavings[i] += adjustedValue;
        //     }
        // }

        // คำนวณ updatedSavings โดยเรียกใช้ฟังก์ชัน calculateAverageSavings
        var updatedSavings = calculateAverageSavings(goal, savings);

        const ctx = document.getElementById('myChart');

        new Chart(ctx, {
            type: 'line',
            data: {
                labels: <?= $label; ?>,
                datasets: [{
                        label: 'Goal',
                        data: updatedSavings,
                        borderWidth: 1
                    },
                    {
                        label: 'Saving',
                        data: <?= json_encode($saving_update); ?>,
                        borderWidth: 1
                    }
                ],

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
    
    
</body>

</html>