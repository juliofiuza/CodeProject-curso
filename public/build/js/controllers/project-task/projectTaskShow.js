angular.module('app.controllers')
.controller('ProjectTaskShowController', ['$scope', 'ProjectTask', function($scope, ProjectTask) {
	$scope.projectTask = ProjectTask.query();
}]);