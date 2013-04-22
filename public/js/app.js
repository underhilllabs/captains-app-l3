app = angular.module('CptnCounter',["ngResource"]);
this.CaptainCtrl = function ($scope, $http, $location) {
  $scope.addCap = {};
  $scope.getCaptains = function() {
    $http({
      method: 'JSONP',
      // angularJS subs in its own call for JSON_CALLBACK
      url: '/api/captains?callback=JSON_CALLBACK'
    }).
    success(function(data) {
      $scope.captains = data;
      console.log(data);
      $scope.error = '';
    }).
    error(function(data, status) {
      $scope.error = 'Error: ' + status;
      console.log($scope.error);
      //console.log(data);
    });
  };
  $scope.getCaptains();

  $scope.inc = function(idx) {
    idx = parseInt(idx);
    votes = parseInt($scope.captains[idx].votes);
    $scope.captains[idx].votes = votes + 1;
    console.log("captain is " + $scope.captains[idx].name);
    $http.put('/api/captain/' + idx, $scope.captains[idx]).
      success(function(data) {
        console.log("Success: " + data);
        $location.url('/');
      }).
      error(function(data,error) {
        console.log("error data: " + data);
        console.log("ERROR: " + status)
      });
  }
  $scope.addCaptain = function() {
    $scope.addCap.idx = $scope.captains.length;
    $scope.addCap.votes = 1;
    cappy ={"name": $scope.addCap.name,"imgUrl": $scope.addCap.imgUrl, "source": $scope.addCap.source, "votes":  $scope.addCap.votes, "idx": $scope.addCap.idx};
    $scope.captains.push(cappy);
    console.log("cappy -> "+cappy);
    $http.post('/api/captain', cappy).
      success(function(data) {
        $location.path('/');
      }).
      error(function(data,status) {
        console.log("error data: " + data);
        console.log("ERROR: " + status)
      });
    $scope.addCap.cptName = "";
    $scope.addCap.cptUrl = "";
    $scope.addCap.cptSource = "";
    $scope.addCap.idx = "";
    $scope.addCap.votes = "";
  }
};

