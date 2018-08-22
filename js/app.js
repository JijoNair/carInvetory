// define application
angular.module("carInv", [])
.controller("carInvController", function($scope,$http){
    $scope.cars = [];
    $scope.tempcarData = {};
    // function to get records from the database
    $scope.getRecords = function(){
        $http.get('scripts/action.php', {
            params:{
                'type':'view'
            }
        }).then(function(response){
            console.log(response.data);
            if(response.data.status == 'OK'){
                $scope.cars = response.data.records;
                $scope.mfgdatas = response.data.mfgRecords;
            }
        });
    };
    $scope.addMfg = function(){
        $scope.saveMfg();
    };



   // function to insert or update user data to the database
    $scope.saveMfg = function(){
        if($('#in_MfgName').val=="") false;
        else
        var data = $.param({
            'data':$scope.mfgData,
            'type': 'addMfg'
        });
        var config = {
            headers : {
                'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
            }
        };
        $http.post("scripts/action.php", data, config).then(function(response){
            if(response.status == 'OK'){
                    $scope.mfgData.push({
                        name:response.data.name,
                    });
                //$scope.userForm.$setPristine();
                location.reload();
            }else{
                $scope.messageError(response.msg);
            }
        });
    };
    $scope.addModel = function(){
        if(($('#in_ModelNumber').val()=="") || ($('#in_ModelYear').val() =="") || ($('#in_ModelYear').val()=="")) false;
        else
      var modelData = $.param({
          'modelData':$scope.modelData,
          'type': 'addModel'
      });

      var modelConfig = {
        headers : {
            'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
        }
      };

      $http.post("scripts/action.php", modelData, modelConfig).then(function(response){
          if(response.status == 'OK'){
                  $scope.modelData.push({
                      mfg_name: response.modelData.ModelMfg,
                      model_name:response.modelData.name,
                      model_color: response.modelData.color,
                      model_year: response.modelData.year,
                      model_number: response.modelData.number,
                      model_notes: response.modelData.notes,
                  });
                  location.reload();
              //$scope.userForm.$setPristine();
              $scope.tempUserData = {};
              $scope.messageSuccess(response.msg);
          }else{
              $scope.messageError(response.msg);
          }
      });
    };

    // function to display success message
    $scope.messageSuccess = function(msg){
        $('.alert-success > p').html(msg);
        $('.alert-success').show();
        $('.alert-success').delay(5000).slideUp(function(){
            $('.alert-success > p').html('');
        });
    };

    // function to display error message
    $scope.messageError = function(msg){
        $('.alert-danger > p').html(msg);
        $('.alert-danger').show();
        $('.alert-danger').delay(5000).slideUp(function(){
            $('.alert-danger > p').html('');
        });
    };

    //function to fetch the view of model
    $scope.viewpopup = function(modelid){
        $('#view_model').modal({
            blurring: true
          }).modal('show');
        $http.get('scripts/action.php', {
            params:{
                'type':'viewCarDetail',
                'modelid': modelid,
            }
        }).then(function(response){
           
            if(response.data.status == 'OK'){
                $scope.carsdetails = response.data.records;
                console.log($scope.carsdetails);
            }
        });
            
    };

    $scope.sellcar =function(modelid){
        $http.get('scripts/action.php', {
            params:{
                'type':'sellCar',
                'modelid': modelid,
            }
        }).then(function(response){
            location.reload();
            if(response.data.status == 'OK'){
                
            }
        });
    }
});
