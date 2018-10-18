<?php

namespace app\controllers;

use Yii;
use yii\data\SqlDataProvider;

class ReportsController extends \yii\web\Controller {
    
    
    public function actionIndex() {
        $totalUnpaidInstallment = Yii::$app->db->createCommand("SELECT SUM(installment.total) FROM installment JOIN customers ON installment.customer_id = customers.id WHERE installment.is_made_payment = 0 AND customers.status =1");
        $totalDueInstallment = Yii::$app->db->createCommand("SELECT SUM(installment.total) FROM installment JOIN customers ON installment.customer_id = customers.id WHERE installment.is_made_payment = 0 AND customers.status =1 AND installment.date < LAST_DAY(CURDATE())");
        return $this->render('index', [
                    'totalUnpaidInstallment' => $totalUnpaidInstallment->queryScalar(),
                    'totalDueInstallment' => $totalDueInstallment->queryScalar(),
        ]);
    }

    public function actionMonthlyInstallment() {

        $monthly_installment = "SELECT SUM(installment.total) AS SUM ,YEAR(installment.date) AS YEAR, MONTH(installment.date) AS MONTH FROM installment JOIN customers ON installment.customer_id = customers.id WHERE installment.is_made_payment = 0 AND customers.status = 1 GROUP BY YEAR(installment.date), MONTH(installment.date)";
        $count = count(Yii::$app->db->createCommand($monthly_installment)->queryAll());
        $monthly_installment_dataProvider = new SqlDataProvider([
            'sql' => $monthly_installment,
            'totalCount' => $count,
        ]);
        return $this->render('monthly_installment', [
                    'monthly_installment' => $monthly_installment_dataProvider,
        ]);
    }
    
    public function actionMonthlyInstallmentBeerUser() {
        $monthly_installment_monthly_beer_user = "SELECT SUM(installment.total) AS SUM ,YEAR(installment.date) AS YEAR, MONTH(installment.date) AS MONTH, customers.name AS NAME FROM installment 
                                JOIN customers 
                                ON customers.id = installment.customer_id
                                WHERE installment.is_made_payment = 0
                                AND customers.`status` =1
                                GROUP BY YEAR(installment.date), MONTH(installment.date),customers.id";
        $count = count(Yii::$app->db->createCommand($monthly_installment_monthly_beer_user)->queryAll());
        $monthly_installment_beer_user_dataProvider = new SqlDataProvider([
            'sql' => $monthly_installment_monthly_beer_user,
            'totalCount' => $count,
        ]);
        return $this->render('monthly_installment_monthly_beer_user', [
                    'monthly_installment_monthly_beer_user' => $monthly_installment_beer_user_dataProvider,
        ]);
    }
    
    public function actionDueInstallment() {
        $due_installment = "SELECT * FROM installment
                            JOIN customers on customers.id =installment.customer_id
                            WHERE installment.is_made_payment = 0 AND installment.date < LAST_DAY(CURDATE())
                            AND customers.status = 1
                            GROUP BY customers.id";
        $count = count(Yii::$app->db->createCommand($due_installment)->queryAll());
        $due_installment_dataProvider = new SqlDataProvider([
            'sql' => $due_installment,
            'totalCount' => $count,
        ]);
        return $this->render('due_installment', [
                    'due_installment' => $due_installment_dataProvider,
        ]);
    }

}
