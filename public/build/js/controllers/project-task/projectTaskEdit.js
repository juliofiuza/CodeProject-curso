angular.module('app.controllers')
.controller('ProjectTaskEditController', 
	['$scope', '$location', '$routeParams', 'ProjectTask', 'appConfig',
	function($scope, $location, $routeParams, ProjectTask, appConfig) {
	$scope.projectTask = ProjectTask.get({
		id: $routeParams.id,
		idTask: $routeParams.idTask
	});
	
	$scope.status = appConfig.projectTask.status;
	
	$scope.start_date = {
		status: {
			opened: false
		}
	};

	$scope.due_date = {
		status: {
			opened: false
		}
	};

	$scope.openStart = function($event) {
		$scope.start_date.status.opened = true;
	};

	$scope.openDue = function($event) {
		$scope.due_date.status.opened = true;
	};

	$scope.save = function() {
		if ($scope.form.$valid) {
			ProjectTask.update({id: $routeParams.id, idTask: $scope.projectTask.id}, $scope.projectTask, function() {
				$location.path('/project/' + $routeParams.id + '/tasks');
			});
		}
	}
}]);