<?php

function getFirstYear()
{
    $db = LMSDB::getInstance();
    $firstYear = $db->GetOne('SELECT MIN( TIME ) FROM cash');
    return $firstYear;
}

function MonthlyIncome($year, $month)
{
    $db = LMSDB::getInstance();
    $income = $db->GetAll('SELECT SUM(value) AS suma, DAY(FROM_UNIXTIME(time)) as day FROM cash WHERE value>0 AND YEAR(FROM_UNIXTIME(time))=' . $year . ' AND MONTH(FROM_UNIXTIME(time))=' . $month . ' GROUP BY DAY(FROM_UNIXTIME(time))');
    return $income;
}

function IncomePerMonth($only_year)
{
    $db = LMSDB::getInstance();
    $income = $db->GetAll('SELECT MONTH(FROM_UNIXTIME(time)) as month, SUM(value) AS suma FROM cash WHERE value>0 AND YEAR(FROM_UNIXTIME(time))=' . $only_year . ' GROUP BY month(FROM_UNIXTIME(time))');
    return $income;
}

if ($_GET['year'] > 0 and $_GET['month'] > 0) {
    $SMARTY->assign('income', MonthlyIncome($_GET['year'], $_GET['month']));
} elseif ($_GET['only_year'] > 0) {
    $SMARTY->assign('IncomePerMonth', IncomePerMonth($_GET['only_year']));
} else {
    $SMARTY->assign('income', 0);
}

$SMARTY->assign('firstYear', date("Y", getFirstYear()));
$SMARTY->assign('currentYear', date("Y", time()));
$SMARTY->display('incomesummary.html');
