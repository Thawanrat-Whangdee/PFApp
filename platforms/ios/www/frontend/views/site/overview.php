<?php

use app\models\Carry;
use app\models\Expenses;
/** @var yii\web\View $this */

use app\models\Incomes;
use app\models\Pocket;
use app\models\Savings;
use app\models\Typesexpense;
use phpDocumentor\Reflection\Types\String_;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\grid\GridView;
use yii\helpers\Url;
use app\models\Limit;
use yii\mongodb\Query;
use yii\bootstrap\Modal;
use yii\web\JsExpression;


$this->title = 'Overview';

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
        }

        .cartTotal {
            width: 150px;
            height: 560;
            border-radius: 10px;
            text-align: center;
            background-color: #0d6efd;
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

<?php $form = ActiveForm::begin(); ?>

<?php 
    $saving = Savings::find()->where(["user_id" => (String) Yii::$app->user->identity->id])->all();
    $goal = 0;
    foreach ($saving as $s) {
        $goal = $s->amount;
    }
    
    $currentDate = date('j');
    // if ($currentDate === '1') {
    //     // กำหนด JavaScript สำหรับแสดงกล่องข้อความและดำเนินการ
    //     $js = new JsExpression("
    //         const result = window.confirm('Will you take last month\'s balance into this month\'s income?');
    //         if (result) {
    //             // ถ้าผู้ใช้ตอบ OK
    //             const url = '" . Url::to(['site/create-carry']) . "';
    //             const data = {
    //                 status: 'yes',
    //                 date: '" . date('Y-m-d') . "',
    //             };
    //             // ส่งคำร้องข้อมูลด้วย AJAX
    //             $.post(url, data, function(response) {
    //                 // ทำอะไรก็ตามหลังจากดำเนินการเสร็จสิ้น
    //                 alert('Balance has been carried.');
    //             });
    //         }
    //     ");

    //     // ใส่ JavaScript ลงใน View
    //     $this->registerJs($js);
    // }
?>
<body style="background-color: #f8f9fa; font-size: 14px;">
    <div class="card" style="width: 100%; margin-top:2px;background-size: cover; background-image: url('https://img.freepik.com/free-vector/gradient-background-green-tones_23-2148395299.jpg');">
        <div class="containerB">
            <div style="font-size: 14px; margin-right: 20px; margin-top: 15px; color:#2F4F4F; ">
                <table style="width:100%; margin-bottom:20px;">
                    <tr>
                        <td>
                            <?php 
                                echo (String)Yii::$app->user->identity->username;
                            ?>
                        </td>
                        <th></th>
                        <th style="text-align: right;">
                            <?= Html::a('<i class="fa-solid fa-plus" style="color:white; font-size: 1em;" data-toggle="modal" data-target="#exampleModalCenter"></i>'); ?>
                            <?= Html::a('<i class="fa-solid fa-th-list" style="color:white; font-size: 1.4em;" data-toggle="modal" data-target="#exampleModalCenter"></i>'); ?>
                            
                        </th>
                        <th>
                            
                        </th>
                    </tr>
                    
                </table>
                <p style="color:black;"><b>Balance</b></p>
                <h4><b> 
                    <?php 
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
                            ->andFilterWhere(['!=', 'create_date', '2023-09-01']) // ไม่เท่ากับวันที่ 1 เดือน 9 ปี 2023
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

                        // กำหนดสีของตัวเลขเมื่อมีค่าติดลบ
                        $color = $difference < 0 ? 'red' : 'black';

                        echo '<div style="color: ' . $color . ';">';
                        echo $difference;
                        // echo '0';
                        echo '</div>';

                        if ($total_expense > $total_income) {
                            Yii::$app->session->setFlash('danger', 'Your expenses are already more than your income.Please add income.');
                        }
                    ?>
                </b></h4>

                <table style="width:110%">
                    <tr>
                        <td>Amount Income (baht) </td>
                        <th></th>
                        <th>
                            <?php
                                echo $total_income;
                                // echo '0';
                            ?>
                        </th>
                    </tr>
                    <tr>
                        <td>Amount Expenses (baht)</td>
                        <td></td>
                        <th>
                            <?php 
                                echo $total_expense;
                                // echo '0';
                            ?>
                        </th>
                    </tr>
                    <tr style="text-align: center;margin-top: 20px;"> 
                        
                    </tr>
                </table>
                
                <div style="text-align: center;margin-top: 10px;">
                    <table style="width:110%">
                        <tr>
                            <td>
                                <?= Html::a('<i class="fa-solid fa-plus" style="color:white; font-size: 1em; margin-top: 10px;"></i>', ['expenses/create']); ?>
                                <?= Html::a('<img src="https://cdn-icons-png.flaticon.com/512/3728/3728793.png" width="35" height="35">', ['expenses/create']); ?>
                                <p style="color:white;">Expense</p>
                            </td>
                            <td>__________</td>
                            <td style="text-align: center;">
                            <?= Html::a('<i class="fa-solid fa-plus" style="color:white; font-size: 1em; margin-top: 10px;"></i>', ['incomes/create']); ?>
                                <?= Html::a('<img src="https://cdn-icons-png.flaticon.com/512/272/272531.png" width="35" height="35">', ['incomes/create']); ?>
                                <p style="color:white;">Income</p>
                            </td>
                        </tr>
                    </table> 
                    
                </div>
                <div style="text-align:center;">Saving goal : <b><?= $goal ?> </b></div>
            </div>
        </div>
    </div>

    <div class="card" style="width:100%;margin-top:-20px;">
        <div style="margin-top:10px; margin-bottom:10px;">
            <center>
                <table style="border:1; width:80%; text-align:center;">
                    <tr>
                        <th>
                            <?= Html::a('<img src="https://cdn-icons-png.flaticon.com/512/214/214362.png" width="35" height="35">', ['/site/pocketlist']); ?>
                        </th>
                        <th>
                            <?= Html::a('<img src="https://cdn-icons-png.flaticon.com/512/3143/3143636.png" width="32" height="32">', ['/site/calendar']); ?>
                        </th>
                        <th>
                            <?= Html::a('<img src="https://cdn-icons-png.flaticon.com/512/2331/2331785.png" width="35" height="35">', ['/site/limit']); ?>
                        </th>
                        <th>
                            <?= Html::a('<img src="https://cdn-icons-png.flaticon.com/512/4301/4301717.png" width="35" height="35">', ['/site/line']); ?>
                        </th>
                    </tr>
                    
                    <tr>
                        <td>Pocket</td>
                        <td>Calendar</td>
                        <td>Limits</td>
                        <td>Analyze</td>
                    </tr>
                </table>
            </center>
        </div>
    </div>

    <div class=" card" style="width: 100%; margin-top:-15px;">
        <div class="container">
            <?php 

            $total_expense = 0;
            $expense = Expenses::find()->where([
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

            $lilist = 0;
            $_id = 0;
            $limit = Limit::find()->where(["create_by"=>(String)Yii::$app->user->identity->id])->all();
            foreach ($limit as $l) {
                $lilist = $l->amount;
                $_id = $l->_id;
            }
            
            $total_expense_str = number_format($total_expense, 2); // แปลงตัวเลขเป็นสตริงที่มีทศนิยม 2 ตำแหน่ง
            $exceed_limit = $total_expense > $lilist; // เช็คว่าค่ารายจ่ายมากกว่า Limit หรือไม่

            
            ?>
            <table style="width:90%">
                <tr>
                    <th style="padding-top: 10px; padding-left:10px;">
                        <font size="2.5" class="body">Recently Expenses</font>
                    </th>
                    <th></th>
                    <th style="text-align:right;">
                        <?= Html::a('<i class="fa fa-chevron-right" style="margin-top:10px;"></i>', ['/site/expense']); ?>
                    </th>
                </tr>
                <tr>
                    <td style="padding-top: 10px; padding-left:10px;">
                        <?php echo implode("<br>", array_slice(array_reverse((array)$type_e), 0, 4)) ?>
                    </td>
                    <th></th>
                    <th style="text-align: right;">
                        <?php echo implode("<br>", array_slice(array_reverse((array)$exlist), 0, 4)) ?>
                    </th>
                </tr>
            </table>
            <br>
        </div>
    </div>
    
    <div class=" card" style="width: 100%;margin-top:-15px;">
        <div class="container">
        <?php
         $pocket = Pocket::find()->where([
            "user_id" => (String) Yii::$app->user->identity->id,
        ])
        ->andWhere(['like', 'create_date', $currentYear . '-' . $currentMonth])
        ->andFilterWhere(['!=', 'create_date', '2023-09-01']) // ไม่เท่ากับวันที่ 1 เดือน 9 ปี 2023
        ->all();
         $pocket_amount = [];
         $pocket_type = [];
         $pocket_ratio = [];
         $pocket_name = [];
         foreach ($pocket as $p) {
             $pocket_ratio[] = $p->ratio;
             $pocket_amount[] = $p->ratio;
             $pocket_type[] = $p->expense_type;
             $pocket_name[] = $p->pocket_name;
         }
        $expenseData = [];
        $expenses = Expenses::find()->where([
            "create_by" => (String) Yii::$app->user->identity->id,
        ])
        ->andWhere(['like', 'create_date', $currentYear . '-' . $currentMonth])
        ->all();
        foreach ($expenses as $expense) {
            $expenseData[$expense->expense_type][] = (float) $expense->amount;
        }

        

        // ตรวจสอบค่าใน $pocket_amount ว่ามีคีย์ที่เกี่ยวข้องกับ $pocket_type หรือไม่ ถ้าไม่มีให้กำหนดค่าเริ่มต้นเป็น 0
        $pocket_amount = array_combine($pocket_type, array_pad([], count($pocket_type), 0));

        // แสดงผลลัพธ์ในตาราง "Your Pocket"
        echo '<table style="width:90%">';
        echo '<tr>';
        echo '<th style="padding-top: 10px; padding-left:10px;">';
        echo '<font size="2.5" class="body">Your Pocket</font>';
        echo '</th>';
        echo '<th style="padding-top: 10px; padding-left:100px;">';
        echo '<font size="2.5" class="body">spent</font>';
        echo '</th>';
        echo '<th></th>';
        echo '</tr>';
        echo '<tr>';
        echo '<td style="padding-top: 10px; padding-left:5px;">';
        echo implode("<br>", $pocket_name);
        echo '</td>';
        echo '<td style="text-align: right;">';
        foreach ($pocket_type as $type) {
            $totalAmount = array_sum($expenseData[$type] ?? []);
            echo $totalAmount . '   /' . '<br>';
        }
        echo '</td>';
        echo '<td>';
        echo '</td>';
        echo '<td style="text-align: right;">';
        echo implode("<br>", $pocket_ratio);
        echo '</td>';
        echo '</tr>';
        echo '</table>';

    ?>
            <br>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content" style="background-color: #f8f9fa; border-radius: 20px;">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Menu</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <table>
                    <tr>
                        <td>
                            <div class="card" style="width:70%;margin-left:50px">
                                <div style="margin-top:10px; margin-bottom:10px;">
                                    <center>
                                        <table style="border:1; width:80%; text-align:center;">
                                            <tr>
                                                <th>
                                                    <?= Html::a('<img src="https://icons-for-free.com/iconfiles/png/512/bank+coins+finance+money+saving+icon-1320167737485417486.png" width="45" height="45">', ['savings/create']); ?>
                                                </th>
                                            </tr>
                                            
                                            <tr>
                                                <td>Add Savings</td>
                                            </tr>
                                        </table>
                                    </center>
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="card" style="width:70%;margin-right:70px;">
                                <div style="margin-top:10px; margin-bottom:10px;">
                                    <center>
                                        <table style="border:1; width:80%; text-align:center;">
                                            <tr>
                                                <th>
                                                    <?= Html::a('<img src="https://cdn-icons-png.flaticon.com/512/1600/1600349.png" width="45" height="45">', ['limit/create']); ?>
                                                </th>
                                            </tr>
                                            
                                            <tr>
                                                <td>Add Limit</td>
                                            </tr>
                                        </table>
                                    </center>
                                </div>
                            </div>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>




</body>

</html>
<?php ActiveForm::end(); ?>