<?php
require_once 'connection.php';
$db = new DB();
if(isset($_REQUEST['type']) && !empty($_REQUEST['type'])){
    $type = $_REQUEST['type'];
    switch($type){
        case "view":
            $records = $db->getDetails();
            if($records){
                $data['records'] = $db->getDetails();
                $data['mfgRecords'] = $db->getMfg();
                $data['status'] = 'OK';
            }else{
                $data['records'] = array();
                $data['status'] = 'ERR';
            }
            echo json_encode($data);
            break;
        case "addMfg":
            if(!empty($_POST['data'])){
                $mfgData = array(
                    'name' => $_POST['data']['name'],
                );
                $insert = $db->insertMfg($mfgData);
                if($insert){
                    $data['data'] = $insert;
                    $data['status'] = 'OK';
                    $data['msg'] = 'User data has been added successfully.';
                }else{
                    $data['status'] = 'ERR';
                    $data['msg'] = 'Some problem occurred, please try again.';
                }
            }else{
                $data['status'] = 'ERR';
                $data['msg'] = 'Some problem occurred, please try again.';
            }
            echo json_encode($data);
            break;
            case "addModel":
            if(!empty($_POST['modelData'])){
                $modelData = array(
                    'modelMfg' => $_POST['modelData']['ModelMfg'],
                    'modelName' => $_POST['modelData']['name'],
                    'modelColor' => $_POST['modelData']['color'],
                    'modelYear' => $_POST['modelData']['year'],
                    'modelNumber' => $_POST['modelData']['number'],
                    'modelNotes' => $_POST['modelData']['notes'],
                );
                  $insertModel = $db->insertModel($modelData);
                  if($insertModel){
                      $data['dataModel'] = $insertModel;
                      $data['status'] = 'OK';
                      $data['msg'] = 'Model added successfully.';
                  }else{
                      $data['status'] = 'ERR';
                      $data['msg'] = 'Some problem occurred, please try again.';
                  }
              }else{
                  $data['status'] = 'ERR';
                  $data['msg'] = 'Some problem occurred, please try again.';
              }
            break;
        /*
        case "sold":
            if(!empty($_POST['id'])){
                $condition = array('id' => $_POST['id']);
                $delete = $db->delete($tblName,$condition);
                if($delete){
                    $data['status'] = 'OK';
                    $data['msg'] = 'User data has been deleted successfully.';
                }else{
                    $data['status'] = 'ERR';
                    $data['msg'] = 'Some problem occurred, please try again.';
                }
            }else{
                $data['status'] = 'ERR';
                $data['msg'] = 'Some problem occurred, please try again.';
            }
            echo json_encode($data);
            break;
        default:
            echo '{"status":"INVALID"}';*/
    }
}
?>
