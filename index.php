<?php
if (!session_id()) session_start();
error_reporting(E_ALL ^ E_NOTICE);
date_default_timezone_set('Asia/Bangkok');
include_once 'connect/conDB.php';
include_once 'core/functions.php';
// include_once 'core/routestext.php';
include_once 'model/Home.class.php';
include_once 'model/Users.class.php';
include_once 'model/Profile.class.php';
include_once 'model/Customer.class.php';
include_once 'model/Setprename.class.php';
include_once 'model/Setstatusmarry.class.php';
include_once 'model/Setstatusaddress.class.php';
include_once 'model/Setcohabiting.class.php';
include_once 'model/Setstatuswork.class.php';
include_once 'model/Setlinework.class.php';
include_once 'model/Personnel.class.php';

include_once 'model/Contract.class.php';
include_once 'model/Documentcard.class.php';
include_once 'model/Documentcopycard.class.php';

include_once 'model/ShowReport.class.php';
include_once 'model/Payments.class.php';
include_once 'model/PaymentHistory.class.php';
include_once 'model/Closebalance.class.php';
// include_once 'model/Dashboard.class.php'

include_once 'model/ExcelReport.class.php';

if (isset($_SESSION["sess_id"]) != '') {
  require("views/template/header.php");
  // require("views/menu/admin_menu.php");
  // require("views/template/topnavigation.php");
  require("views/menu/" . $_SESSION['sess_accessrights'] . "_menu.php");
  require("routes.php");
  require("views/template/footer.php");
} else {

  require("views/login/index.php");
}
