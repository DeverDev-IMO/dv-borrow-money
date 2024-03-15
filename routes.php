<?php
$actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
$uri_path = parse_url($actual_link, PHP_URL_PATH);
$uri_segments = explode('/', $uri_path);

if ($_SESSION['sess_accessrights'] === 'superadmin' or $_SESSION['sess_accessrights'] === 'admin') {
  switch ($uri_segments[2]) {
    case '':
      require __DIR__ . '/views/template/dashboard.php';
      break;
    case '/':
      require __DIR__ . '/views/template/dashboard.php';
      break;
    case 'dashboard':
      require __DIR__ . '/views/template/dashboard.php';
      break;

    case 'users':
      require __DIR__ . '/views/users/index.php';
      break;
    case 'usersform':
      require __DIR__ . '/views/users/form.php';
      break;
    case 'profile':
      require __DIR__ . '/views/profile/profile.php';
      break;
    case 'changepassword':
      require __DIR__ . '/views/profile/changepassword.php';
      break;
    case 'customer':
      require __DIR__ . '/views/customer/index.php';
      break;
    case 'customerform':
      require __DIR__ . '/views/customer/form.php';
      break;
    case 'setprename':
      require __DIR__ . '/views/set-prename/index.php';
      break;
    case 'setprename':
      require __DIR__ . '/views/set-prename/index.php';
      break;
    case 'setstatusmarry':
      require __DIR__ . '/views/set-statusmarry/index.php';
      break;
    case 'setstatusaddress':
      require __DIR__ . '/views/set-statusaddress/index.php';
      break;
    case 'setcohabiting':
      require __DIR__ . '/views/set-cohabiting/index.php';
      break;
    case 'setstatuswork':
      require __DIR__ . '/views/set-statuswork/index.php';
      break;
      // case 'contract':
      //   require __DIR__ . '/views/contract/index.php';
      //   break;
    case 'contract':
      require __DIR__ . '/views/contract/index.php';
      break;
    case 'contractform':
      require __DIR__ . '/views/contract/form.php';
      break;
    case 'setlinework':
      require __DIR__ . '/views/set-linework/index.php';
      break;
    case 'personnel':
      require __DIR__ . '/views/personnel/index.php';
      break;
    case 'documentcard':
      require __DIR__ . '/views/documentcard/index.php';
      break;
    case 'documentcopycard':
      require __DIR__ . '/views/documentcopycard/index.php';
      break;


    case 'reportsales':
      require __DIR__ . '/views/report/form_reportsales.php';
      break;
    case 'reportclosebalance':
      require __DIR__ . '/views/report/form_reportclosebalance.php';
      break;
    case 'reportcollect':
      require __DIR__ . '/views/report/form_reportcollect.php';
      break;
    case 'payments':
      require __DIR__ . '/views/payments/index.php';
      break;
    case 'paymentsform':
      require __DIR__ . '/views/payments/form.php';
      break;
    case 'reportdaily':
      require __DIR__ . '/views/report/form_reportdaily.php';
      break;

    case 'documenttaxinvoice':
      require __DIR__ . '/views/documenttaxinvoice/index.php';
      break;
    case 'closebalance':
      require __DIR__ . '/views/closebalance/index.php';
      break;
    case 'paymenthistory':
      require __DIR__ . '/views/paymenthistory/index.php';
      break;
    case 'paymenthistorydetail':
      require __DIR__ . '/views/paymenthistory/detail.php';
      break;
    case 'debtor':
      require __DIR__ . '/views/debtor/form_debtor.php';
      break;
    case 'contractcancel':
      require __DIR__ . '/views/contract/contractcancel.php';
      break;
    case 'summarizesales':
      require __DIR__ . '/views/excel_report/form_summarizesales.php';
      break;
    case 'summarizecollect':
      require __DIR__ . '/views/excel_report/form_summarizecollect.php';
      break;
    case 'summarizeclosebalance':
      require __DIR__ . '/views/excel_report/form_summarizeclosebalance.php';
      break;
    default:
      http_response_code(404);
      require __DIR__ . '/views/404.php';
      break;
  }
} else {
  /////
}
