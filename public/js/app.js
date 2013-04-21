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
    console.log("index is " + idx + " int is " + parseInt(idx));
    idx = parseInt(idx);
    $scope.captains[idx].votes += 1;
    $http.put('/api/captain/' + idx, $scope.captains[idx]).
      success(function(data) {
        $location.url('/');
      });
  }
  $scope.addCaptain = function() {
    $scope.addCap.idx = $scope.captains.length;
    $scope.addCap.votes = 1;
    console.log($scope.addCap);

    $scope.captains.push({"name": $scope.addCap.cptName,"image": $scope.addCap.cptUrl, "source": $scope.addCap.cptSource, "votes":  $scope.addCap.votes, "idx": $scope.addCap.idx});
    $http.post('/api/captain', $scope.addCap).
      success(function(data) {
        $location.path('/');
      }).
      error(function(data,status) {
        console.log("ERROR: " + status)
      });
    $scope.addCap.cptName = "";
    $scope.addCap.cptUrl = "";
    $scope.addCap.cptSource = "";
    $scope.addCap.idx = "";
    $scope.addCap.votes = "";
  }
};

