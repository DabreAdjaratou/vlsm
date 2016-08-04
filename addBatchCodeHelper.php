<?php
ob_start();
include('./includes/MysqliDb.php');
include('header.php');

$tableName1="batch_details";
$tableName2="vl_request_form";
try {
        $data=array('batch_code'=>$_POST['batchCode']);
        $db->insert($tableName1,$data);
        $lastId = $db->getInsertId();
        if($lastId!=0 && $lastId!=''){
            for($j=0;$j<=count($_POST['sampleCode']);$j++){
                $treamentId = $_POST['sampleCode'][$j];
                $value = array('batch_id'=>$lastId);
                $db=$db->where('treament_id',$treamentId);
                $db->update($tableName2,$value); 
            }
            $_SESSION['alertMsg']="Batch code added successfully";
            header("location:batchcode.php");
        }
} catch (Exception $exc) {
    error_log($exc->getMessage());
    error_log($exc->getTraceAsString());
}