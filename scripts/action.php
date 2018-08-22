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
              echo json_encode($data);
            break;
            case "viewCarDetail":
            if(!empty($_REQUEST['modelid'])){
                $modeldetails = $db->getCarViewDetails($_REQUEST['modelid']);
               
            if($modeldetails){
                $cardata['records'] = $db->getCarViewDetails($_REQUEST['modelid']);
                $cardata['status'] = 'OK';
            }else{
                $cardata['records'] = array();
                $cardata['status'] = 'ERR';
            }

            }
            echo json_encode($cardata);
            break;
        
        case "sellCar":
            if(!empty($_REQUEST['modelid'])){
                $updatecar = $db->sellcar($_REQUEST['modelid']);
                if($updatecar){
                    $updatecarstatus['status'] = 'OK';
                }else{
                    $updatecarstatus['status'] = 'ERR';
                }
            }
            break;
        default:
            echo '{"status":"INVALID"}';
    }
}
?>
