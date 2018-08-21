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
                $scope.tempUserData = {};
                $('.formData').slideUp();
                $scope.messageSuccess();
            }else{
                $scope.messageError(response.msg);
            }
        });
    };
    $scope.addModel = function(){
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
              //$scope.userForm.$setPristine();
              $scope.tempUserData = {};
              $scope.messageSuccess(response.msg);
          }else{
              $scope.messageError(response.msg);
          }
      });
    };

    /*// function to add user data
    $scope.addUser = function(){
        $scope.saveUser('add');
    };

    // function to edit user data
    $scope.editUser = function(user){
        $scope.tempUserData = {
            id:user.id,
            name:user.name,
            email:user.email,
            phone:user.phone,
            created:user.created
        };
        $scope.index = $scope.users.indexOf(user);
        $('.formData').slideDown();
    };

    // function to update user data
    $scope.updateUser = function(){
        $scope.saveUser('edit');
    };

    // function to delete user data from the database
    $scope.deleteUser = function(user){
        var conf = confirm('Are you sure to delete the user?');
        if(conf === true){
            var data = $.param({
                'id': user.id,
                'type':'delete'
            });
            var config = {
                headers : {
                    'Content-Type': 'application/x-www-form-urlencoded;charset=utf-8;'
                }
            };
            $http.post("action.php",data,config).success(function(response){
                if(response.status == 'OK'){
                    var index = $scope.users.indexOf(user);
                    $scope.users.splice(index,1);
                    $scope.messageSuccess(response.msg);
                }else{
                    $scope.messageError(response.msg);
                }
            });
        }
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
    };*/
});
