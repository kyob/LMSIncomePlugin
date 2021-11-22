<?php

function getFirstYear() {
    global $LMS, $SMARTY, $SESSION;
    $db = LMSDB::getInstance();

    $firstYear = $db->GetOne('SELECT MIN( TIME ) FROM cash');
    return $firstYear;
}

function MonthlyIncome($year, $month) {
    global $LMS, $SMARTY, $SESSION;
    $db = LMSDB::getInstance();

    $income = $db->GetAll('SELECT SUM(value) AS suma, EXTRACT(DAY FROM to_timestamp(time)) AS day
                         FROM cash
                         WHERE importid IS NOT NULL AND value>0 AND EXTRACT(YEAR FROM to_timestamp(time))=' . $year . ' AND EXTRACT(MONTH FROM to_timestamp(time))=' . $month . '
                         GROUP BY EXTRACT(DAY FROM to_timestamp(time))
                         ORDER BY day
    ');
    return $income;
}

function IncomePerMonth($only_year) {
    global $LMS, $SMARTY, $SESSION;
    $db = LMSDB::getInstance();

    $income = $db->GetAll('SELECT EXTRACT(MONTH FROM to_timestamp(time)) AS month, SUM(value) AS suma FROM cash WHERE importid IS NOT NULL AND value>0 AND EXTRACT(YEAR FROM to_timestamp(time))=' . $only_year . ' GROUP BY EXTRACT(MONTH FROM to_timestamp(time)) ORDER BY month');
    return $income;
}

if ($_GET['year'] > 0 AND $_GET['month'] > 0) {
    $SMARTY->assign('income', MonthlyIncome($_GET['year'], $_GET['month']));
} elseif ($_GET['only_year'] > 2000) {
    $SMARTY->assign('IncomePerMonth', IncomePerMonth($_GET['only_year']));
} else {
    $SMARTY->assign('income', 0);
}

$SMARTY->assign('firstYear', date("Y", getFirstYear()));
$SMARTY->assign('currentYear', date("Y", time()));
$SMARTY->display('income.html');
?>