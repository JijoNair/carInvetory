<!DOCTYPE html>
<html>
 <head>
  <title>Car Inventory v1.0</title>
  
  <link rel="stylesheet" href="semantic/dist/semantic.css">
 </head>
        <body ng-app="carInv">
        <div ng-controller="carInvController" ng-init="getRecords()">
        <div  class="ui red segment" >
        <div class="ui horizontal segments">
            <div class="ui segment">
            <div class="ui large buttons">
                    <button class="ui button" id="btn_addMfg">Add Manufacturer</button>
                      <div class="or"></div>
                    <button class="ui button" id="btn_addModel">Add Model</button>
                </div>
            </div>

  </div>
        <table class="ui celled table">
  <thead>
    <tr>
        <th>Sr #</th>
        <th>Manufacturer</th>
        <th>Model Name</th>
        <th>Model Number</th>
        <th>Action</th>
    </tr>
  </thead>
  <tbody>
  <tr ng-repeat="car in cars">
      <td>{{$index + 1}}</td>
      <td>{{car.mfgname}}</td>
      <td>{{car.model_name}}</td>
      <td>{{car.model_number}}</td>
      <td class="selectable">
      <i class="file link icon" data-title="Using click events"  data-content="Add users to your feed" ng-click="viewpopup(car.model_id)"></i>
      </td>
    </tr>
    
  </tbody>
</table>
</div>


<!-- modal for adding manufacturer -->

<div class="ui modal" id="md_addMfg">
  <i class="close icon"></i>
  <div class="header">
   Add Manufacturer
  </div>
    <div class="description ui segment">
      <div class="ui header">This will add a manufacturer for your car inventory</div>
      <div class="ui segment">
      <form class="ui form" id="fm_mfgadd">
  <div class="field">
    <label>Manufacturer Name</label>
    <input type="text" name="in_MfgName" placeholder="Name" id="in_MfgName" ng-model="mfgData.name">
  </div>
  <button class="ui button" type="submit" ng-click="addMfg()">Submit</button>
</form>
</div>
    </div>
</div>

<!--modal for adding a car model -->
<div class="ui modal" id="md_addModel">
  <i class="close icon"></i>
  <div class="header">
   Add Manufacturer
  </div>
    <div class="description ui segment">
      <div class="ui header">This wil add a car model for your car inventory</div>
      <div class="ui segment">
      <form class="ui form" id="frm_addModel">
      <div class="fields">
      <div class="field">
          <label>Select Manufacturer</label>
        <select class="ui selection dropdown" name="in_ModelMfg" ng-model="modelData.ModelMfg">
          <option value="">Select Manufacturer</option>
          <option value="{{mfgdata.mfg_id}}" ng-repeat="mfgdata in mfgdatas">{{mfgdata.mfg_name}}</option>
        </select>
    </div>
  <div class="field">
    <label>Model Name</label>
    <input type="text" name="in_ModelName" placeholder="Name" id="in_ModelName" ng-model="modelData.name">
  </div>
  </div>
  <div class="fields">
    <div class="field">
        <label>Model Color</label>
        <input type="text" name="in_ModelColor" placeholder="Color" id="in_ModelColor" ng-model="modelData.color">
    </div>

    <div class="field">
        <label>Model Year</label>
        <input type="text" name="in_ModelYear" placeholder="Year" id="in_ModelYear" ng-model="modelData.year">
    </div>

  </div>
  <div class="fields">
    <div class="field">
        <label>Model Number</label>
        <input type="text" name="in_ModelNumber" placeholder="Number" id="in_ModelNumber" ng-model="modelData.number">
    </div>

    <div class="field">
        <label>Notes</label>
        <input type="text" name="in_ModelNotes" placeholder="Notes if any" id="in_ModelNotes" ng-model="modelData.notes">
    </div>
  </div>
  <div class="fields">
    <div class="field">
        <label>Pictures</label>

    </div>
  </div>
  <div class="fields">
    <div class="field">
        <button class="ui button" type="submit" ng-click="addModel()">Add Model</button>
    </div>
  </div>
</form>
</div>
    </div>
</div>


<!-- view modal  -->


<div class="ui basic small modal" id="view_model">
  <i class="close icon"></i>
  <div class="header">
  {{carsdetails[0].mfgname}}'s
  </div>
    <div class="description ui segment">
      <div class="ui header"></div>
      <div class="ui segment">
      <form class="ui form">
  <div class="field">
  </div>
  <div class="ui card  field">
  <div class="ui slide masked reveal image">
    <img src="/images/avatar/large/jenny.jpg" class="visible content">
    <img src="/images/avatar/large/elliot.jpg" class="hidden content">
  </div>
  <div class="content">
    <a class="header">{{carsdetails[0].model_name}}</a>
    <div class="meta">
    <b> Model Year:</b> <span class="date">{{carsdetails[0].model_year}}</span><br/>
     <b>Color: </b><span class="date">{{carsdetails[0].model_color}}</span><br/>
      <b>Model Number:</b><span class="date">{{carsdetails[0].model_number}}</span><br/>
    </div>
  </div>
  <div class="extra content">
    <a>
      <i class="file icon"></i> Notes:
      {{carsdetails[0].notes}}

    </a>
  </div>
  
</div>
</form>
</div>

</div>
<div class="actions">
    <div class="ui black deny button">
close
    </div>
    <div class="ui positive right labeled icon button" ng-click="sellcar(carsdetails[0].model_id)">
Sell this Car!!
      <i class="checkmark icon"></i>
    </div>
  </div>
</div>
</div>
<script src="js/jQuery.js"></script>
  <script src="js/angular.js"></script>
  <script src="js/app.js"></script>
  <script src="semantic/dist/semantic.js"></script>
 <script src="js/style.js"></script>
</body>
</html>
