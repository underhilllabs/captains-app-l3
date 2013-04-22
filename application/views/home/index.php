<!doctype html>
<html ng-app="CptnCounter">
  <head>
    <title>Vote for your Favorite Sci-Fi Starship Captain</title>
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.0.6/angular.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.0.6/angular-resource.min.js"></script>
    <script src="js/app.js"></script>
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/app.css">
  </head>
<body>
<div id="captains" ng-controller="CaptainCtrl" class="span12">
<h1>Vote for your favorite Sci-Fi Captain</h1>
<div class="span7">
    Search <input type=text ng-model="query">
    <div class="cptn-div" ng-repeat="captain in captains | filter:query | orderBy:'-votes'">
      <h3>{{captain.name}}</h3>
      <p>{{captain.source}}</p>
      <span>
      <img ng-src="{{captain.image}}" width="100" class="img-rounded">
			<button ng-click="inc(captain.idx)" class="btn btn-primary voteButton">{{captain.votes}}</button>
      </span>
    </div>
</div>
<div id="newCaptainForm" class="span4">
	<h3 id="form-header">Add A New Contendeh!</h3>
	<form ng-submit="addCaptain()">
		Name:<br> <input type=text ng-model="addCap.name"><br>
		Image URL:<br> <input type=text ng-model="addCap.imgUrl"><br>
		book/movie source:<br> <input type=text ng-model="addCap.source"><br>
    <input type=submit value="Add Captain!">
	</form>
</div>

</div>
</body>
</html>

