<?php
/*
 * DB Class
 */
class DB {
    /*
    deployment credentials
    private $dbHost     = 'localhost';
    private $dbUsername = 'id6868709_root';
    private $dbPassword = 'jijoforu';
    private $dbName     = 'id6868709_car_inventory';
    public $db;
    */

    // Database credentials
    private $dbHost     = 'localhost';
    private $dbUsername = 'root';
    private $dbPassword = '';
    private $dbName     = 'car_inventory';
    public $db;

    /*
     * Connect to the database and return db connecction
     */
    public function __construct(){
        if(!isset($this->db)){
            // Connect to the database
            try{
                $conn = new PDO("mysql:host=".$this->dbHost.";dbname=".$this->dbName, $this->dbUsername, $this->dbPassword);
                $conn -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $this->db = $conn;
            }catch(PDOException $e){
                die("Failed to connect with MySQL: " . $e->getMessage());
            }
        }
    }
    /*
     * Returns rows from the database based on the conditions
    */
    public function getDetails(){
        $getDetails = "select mfgd.mfg_name as mfgname,modd.* from model_details modd join manufacturer_details mfgd on modd.mfg_id = mfgd.mfg_id where modd.model_isSold = 0 order by modd.model_name asc";
        $query      = $this->db->prepare($getDetails);
        $query->execute();
        if($query->rowCount() > 0){
            $data = $query->fetchAll(PDO::FETCH_ASSOC);
        }
        return !empty($data)?$data:false;
    }

    public function getMfg(){

        $getMfg = "select * from manufacturer_details order by mfg_name asc";
        $queryMfg =  $this->db->prepare($getMfg);
        $queryMfg->execute();
        if($queryMfg->rowCount() > 0){
            $dataMfg = $queryMfg->fetchAll(PDO::FETCH_ASSOC);
        }
        return !empty($dataMfg)?$dataMfg:false;
    }

    public function insertMfg($data){
            if(!empty($data) && isset($data)){
            $columnString = implode(',', array_keys($data));
            $valueString = implode(',', array_values($data));
            $insertMfg = "insert into manufacturer_details(mfg_name)values('".$valueString."')";
            $insertQuery = $this->db->prepare($insertMfg);
            $insertQuery->execute();
            if($insertQuery){
                return $data;
            }else{
                return false;
            }
            }
    }


  public function insertModel($modelData){
    if(isset($modelData) && !empty($modelData)){
      /* this code was to check for the count, but here theres a confusion hence commented the code */
      // $validateNameQuery = "select * from model_details where model_name = '".$modelData['modelName']."' and mfg_id = ".$modelData['modelMfg']."";
      // $queryValidate =  $this->db->prepare($validateNameQuery);
      // $queryValidate->execute();
      // if($queryMfg->rowCount() > 0){
      //   print_r('yes');
      // }else {
      //   $insertModel = "insert into model_details(mfg_id,model_name,model_color,model_year,model_number,notes,model_isSold) values(".$modelData['modelMfg'].",'".$modelData['modelName']."','".$modelData['modelColor']."','".$modelData['modelYear']."','".$modelData['modelNumber']."','".$modelData['modelNotes']."',0)";
      //   $insertQuery = $this->db->prepare($insertModel);
      //   $insertQuery->execute();
      // }
      $insertModel = "insert into model_details(mfg_id,model_name,model_color,model_year,model_number,notes,model_isSold) values(".$modelData['modelMfg'].",'".$modelData['modelName']."','".$modelData['modelColor']."','".$modelData['modelYear']."','".$modelData['modelNumber']."','".$modelData['modelNotes']."',0)";
      $insertQuery = $this->db->prepare($insertModel);
      $insertQuery->execute();
    if($insertModel){
        return $modelData;
    }else{
        return false;
    }
    }
  }

  public function getCarViewDetails($modelid){
      if(isset($modelid) && !empty($modelid)){
            $getcardetails= "select mfgd.mfg_name as mfgname,modd.* from model_details modd  join manufacturer_details mfgd on modd.mfg_id = mfgd.mfg_id and modd.model_id=".$modelid."  order by modd.model_name asc";
            $query      = $this->db->prepare($getcardetails);
        $query->execute();
        if($query->rowCount() > 0){
            $data = $query->fetchAll(PDO::FETCH_ASSOC);
        }
        return !empty($data)?$data:false;
        }
  }
  public function sellcar($modelid){
      if(isset($modelid) && !empty($modelid)){
          $updatecarsell = "update model_details set model_isSold = 1 where model_id = ".$modelid."";
          $query = $this->db->prepare($updatecarsell);
          $query->execute();
          
      }
      }
}

?>
