angular.module('app.controllers')
.controller('ProjectShowController', ['$scope', 'Project', function($scope, Project) {
	$scope.project = Project.query();
}]);