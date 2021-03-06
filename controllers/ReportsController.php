<?php

namespace app\controllers;

use Yii;
use yii\data\SqlDataProvider;

class ReportsController extends \yii\web\Controller {

    public function actionIndex() {
        $totalUnpaidInstallment = Yii::$app->db->createCommand("SELECT SUM(installment.total) FROM installment JOIN customers ON installment.customer_id = customers.id WHERE installment.is_made_payment = 0 AND customers.status =1");
        $totalDueInstallment = Yii::$app->db->createCommand("SELECT SUM(installment.total) FROM installment JOIN customers ON installment.customer_id = customers.id WHERE installment.is_made_payment = 0 AND customers.status =1 AND installment.date < LAST_DAY(CURDATE())");
        $totalPaidInstallment = Yii::$app->db->createCommand("SELECT SUM(installment.total) FROM installment WHERE installment.is_made_payment = 1");
        $totalInstallment = Yii::$app->db->createCommand("SELECT SUM(installment.total) FROM installment");
        return $this->render('index', [
                    'totalUnpaidInstallment' => $totalUnpaidInstallment->queryScalar(),
                    'totalDueInstallment' => $totalDueInstallment->queryScalar(),
                    'totalPaidInstallment' => $totalPaidInstallment->queryScalar(),
                    'totalInstallment' => $totalInstallment->queryScalar(),
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
        $due_installment = "SELECT * , SUM(installment.total) as total_sum,COUNT(installment.id) as total_installment FROM installment
                            JOIN customers on customers.id =installment.customer_id
                            WHERE installment.is_made_payment = 0 AND installment.date < CURDATE()
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

    public function actionThisMonthInstallments($date = null) {
        if ($date == null) {
            $date = date("Y-m-d");
        }
        $this_month_installments = "SELECT * FROM installment JOIN customers on customers.id =installment.customer_id WHERE installment.is_made_payment = 0 AND customers.status = 1 AND (installment.date between DATE_FORMAT('".$date."','%Y-%m-01') AND LAST_DAY('".$date."')) GROUP BY customers.id";
        $count = count(Yii::$app->db->createCommand($this_month_installments)->queryAll());
        $this_month_installments_dataProvider = new SqlDataProvider([
            'sql' => $this_month_installments,
            'totalCount' => $count,
        ]);
        return $this->render('this_month_installments', [
                    'this_month_installments' => $this_month_installments_dataProvider,
        ]);
    }

}
