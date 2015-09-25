<?php

namespace CodeProject\Http\Middleware;

use CodeProject\Services\ProjectService;

use Closure;

class CheckProjectPermission
{

    /**
     * @var ProjectService
     */
    private $service;

    public function __construct(ProjectService $service)
    {
        $this->service = $service;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $projectId = $request->route('id') ? $request->route('id') : $request->route('project');

        if ($this->service->checkProjectPermissions($projectId) == false) {
            return ['error' => 'E preciso ser membro do projecto'];
        }

        return $next($request);
    }
}
