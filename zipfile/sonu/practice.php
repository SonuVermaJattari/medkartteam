<?php
  error_reporting(0);
    if (isset($_POST['submit'])) {

        $key=$_POST['key'];
        $value=$_POST['value'];

echo $length = count($key);
        for($i=0; $i<=count($key)-1; $i++){

            echo 'Kay : '.$key[$i];
            echo 'value : '.$value[$i]."<br>";

        }
    }

?>



    
<!--    <form class="form-horizontal" method="post" style="margin-left: 20px;  margin-right: -160px;" > 
      {{csrf_field()}} 
    <div ng-app="MyApp" ng-controller="MyController">
        <table cellpadding="0" cellspacing="0">
            <tr>
                <th>Name</th>
                <th>Country</th>
                <th></th>
            </tr>

            <tbody>
                <tr>
                    <td><input type="text" name="key[]" ng-model="Name" /></td>
                    <td><input type="text" name="value[]" ng-model="Country" /></td>
                    <td><button type="button" ng-hide="$last" ng-click="Add()" />Add More</button></td>
                </tr>
            </tbody>
            <tfoot ng-repeat="m in Customers">
                <tr>
                    <td><input name="key[]" type="text"  /></td>
                    <td><input name="value[]" type="text" " /></td>
                    <td><button type="button"  class="btn btn-danger" ng-click="Remove($index)"  />Cancel</button></td>
                    <td><button type="button" ng-show="$last" class="btn btn-primary" ng-click="Add()" />Add More</button></td>
                </tr>
            </tfoot>
        </table>
    </div>
    <input type="submit" name="submit">
</form> -->





<!-- 


<div ng-app="add-row" ng-controller="MainCtrl">
  <form name="setupNewGrid">
   <fieldset  ng-repeat="column in columns"> -->
 <!--      <input type="text" name="columnName" ng-model="column.name" name="" placeholder="Column Name" required>
     
   <select name="data_type" required> 
     <option value="">Data Type</option> 
     <option ng-repeat="type in dataType"  value="{{type.dataTypeName}}" ng-model="dataType.id">{{type.dataTypeName}}</option> 
    </select> --> 
<!-- 
     <input type="text" ng-model="column.dataFormat" name="" placeholder="Data Format" required>
     <input type="text" ng-model="column.excludedChar" name="" placeholder="Exculded Characters">

     <button class="remove"  ng-click="removeColumn($index)">x</button> 
   </fieldset>
   <button class="addfields" ng-click="addNewColumn()">Add Column</button>
  <button class="addfields" ng-click="setupNewGrid">Validate</button>
</form>    

</div> -->






    <!--
   http://www.sanwebe.com/2013/03/addremove-input-fields-dynamically-with-jquery
-->



    <h2 class="text-center">  Add Product Attribute </h2><br>
  
   <form  method="post" > 
      {{csrf_field()}} 
    <div ng-app="MyApp" ng-controller="MyController">
      <div class="container">
        <table class="table tabel-bordered table-hover">
            <tr>
                <th>Key Attribute</th>
                <th>Value Attribute</th>
                <th></th>
                <th>Action</th>
            </tr>


            <tbody ng-repeat="m in Customers">
                <tr>
                    <td><input name="key[]" ng-model="m.key" class="form-control" type="text"  /></td>
                    <td><input name="value[]" ng-model="m.value" class="form-control" type="text" " /></td>
                    <td><button type="button"  class="btn btn-danger"  ng-click="Remove($index)"  />Cancel</button></td>
                    <td><button type="button" ng-show="$last"  class="btn btn-primary"  ng-click="Add()" />Add More</button></td>
                </tr>
            </tbody>
        </table>
      </div>  
    </div>
    <input type="submit" name="submit">
</form>









<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/angularjs/1.3.9/angular.min.js"></script>
    <script type="text/javascript">
        // var app = angular.module('MyApp', [])
        // app.controller('MyController', function ($scope, $window) {
        //     $scope.Customers = [

        //         ];
 
        //     $scope.Add = function () {
        //         //Add the new item to the Array.
        //         var customer = {};
        //         customer.Name = $scope.Name;
        //         customer.Country = $scope.Country;
        //         $scope.Customers.push(customer);
        //     };
 
        //     $scope.Remove = function() {
        //         var lastItem = $scope.Customers.length-1;
        //         if(lastItem > -1){
        //         $scope.Customers.splice(lastItem);
        //         }
        //       };

        // });


// var app = angular.module('add-row', []);

//   app.controller('MainCtrl', function($scope) {
    
// //  $scope.dataType = ['type1', 'type2', 'type'];
//       $scope.dataType = [
//     {id: 1, colId:['col1', 'col4'], dataTypeName: 'Date'},
//     {id: 2, colId:['col2', 'col3'], dataTypeName: 'Alpha'},
//     {id: 3, colId:['col5', 'col6', 'col7', 'col8'], dataTypeName: 'List Value'}
//   ];
  
//  $scope.columns = [{colId: 'col1', name:'', dataType:[], dataFormat:'',  excludedChar:'', maxLength:'', isKeyField:false, isKeyRequired:false }];
  
//   $scope.addNewColumn = function() {
//     var newItemNo = $scope.columns.length+1;
//     $scope.columns.push({'colId':'col'+newItemNo});
//   };
    

//   $scope.removeColumn = function(index) {
//     // remove the row specified in index
//     $scope.columns.splice( index, 1);
//     // if no rows left in the array create a blank array
//     if ( $scope.columns.length() === 0 || $scope.columns.length() == null){
//       alert('no rec');
//       $scope.columns.push = [{"colId":"col1"}];
//     }
        
  
//   };


  
// });



        var app = angular.module('MyApp', [])
        app.controller('MyController', function ($scope, $window) {
            $scope.Customers = [ {key:'', value:''
                }];
 
            $scope.Add = function () {
                //Add the new item to the Array.
                var customer = {};
                customer.key = $scope.key;
                customer.value = $scope.value;
                $scope.Customers.push(customer);
            };
 
            $scope.Remove = function() {
                var lastItem = $scope.Customers.length-1;
                if(lastItem > -1){
                $scope.Customers.splice(lastItem);
                }
              };

        });

    </script>
