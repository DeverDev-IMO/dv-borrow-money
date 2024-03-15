<?php 
$debtortype = $_REQUEST['debtortype'];
switch ($debtortype) {
    case 'debtortype1':
        // echo 'debtortype1';
        require '../../views/report/debtortype1.php';
    break;
    case 'debtortype2':
        require '../../views/report/debtortype2.php';
    break;
    case 'debtortype3':
        require '../../views/report/debtortype3.php';
    break;
    case 'debtortype4':
        require '../../views/report/debtortype4.php';
    break;
    case 'debtortype5':
        require '../../views/report/debtortype5.php';
    break;
    case 'debtortype6':
        require '../../views/report/debtortype6.php';
    break;
  }

?>