<?php

namespace App\Http\Controllers;

use App\Helpers\UserHelpers;
use App\Models\ModuleModel;
use App\Models\ModulePermission;
use App\Models\Roles;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\File;
use Illuminate\Validation\ValidationException;

class AdminModulesController extends Controller
{
    public function getIndex()
    {
        $modules_data = ModuleModel::with(['createdBy', 'updatedBy'])->get();
        $data['modules'] = $modules_data;
        $data['roles'] = Roles::all();

        return view('pages.admin_modules', $data);
    }

    public function postSave(Request $request)
    {
        $affected = ModuleModel::firstOrCreate([
            'icon' => $request->input('micon'),
            'module_name' => $request->input('mname'),
            'route' => strtolower($request->input('mname')),
            'status' => 1,
            'created_by' => UserHelpers::myId(),
            'updated_by' => UserHelpers::myId(),
            'created_at' => now(),
        ]);

        if ($affected) {
            $modules_data = ModuleModel::with(['createdBy', 'updatedBy'])->get();

            foreach ($modules_data as $row) {
                $row->created_date = Carbon::parse($row->created_at)->format('Y-m-d H:i:s');
                $row->updated_date = Carbon::parse($row->updated_at)->format('Y-m-d H:i:s');
                $row->createdBy = $row->createdBy->firstname .''. $row->createdBy->middlename .''. $row->createdBy->lastname; 
                $row->updatedBy = $row->updatedBy->firstname .''. $row->updatedBy->middlename .''. $row->updatedBy->lastname; 
            }

            $this->generateModuleFiles($request->input('mname'), $request->input('micon'));
            $this->addRoute($request->input('mname'));
            
            return response()->json(['success' => true, 'data' => $modules_data, 'message' => 'Module saved successfully.']);
        } else {
            return response()->json(['error' => true, 'message' => 'Module failed to add']);
        }
    }

    public function postPermission(Request $request)
    {
        try {
            $request->validate([
                'module_id' => 'required',
                'module_permission' => 'required',
            ]);
        } catch (ValidationException $e) {
            return response()->json(['error' => true, 'messages' => $e->validator->errors()], 422);
        }
    
        $roles_permissions = $request->input('module_permission');
        $successCount = 0;
    
        if ($roles_permissions = 'all') {
            $roles_permissions = Roles::pluck('id')->toArray();
        } elseif (!is_array($roles_permissions)) {
            return response()->json(['error' => true, 'message' => 'Invalid permission data format.'], 422);
        }
    
        foreach ($roles_permissions as $per_permission) {
            $setted = ModulePermission::firstOrCreate([
                'module_id' => $request->input('module_id'),
                'role_id' => $per_permission,
                'created_by' => UserHelpers::myId(),
                'updated_by' => UserHelpers::myId(),
            ]);
    
            if ($setted) {
                $successCount++;
            }
        }
    
        if ($successCount > 0) {
            return response()->json(['success' => true, 'message' => "$successCount module permissions set successfully."]);
        } else {
            return response()->json(['error' => true, 'message' => 'Failed to set permissions.']);
        }
    }    

    protected function generateModuleFiles($moduleName, $icon)
    {
        $controllerPath = app_path("Http/Controllers/{$moduleName}Controller.php");
        $viewPath = resource_path("views/pages/$moduleName.blade.php");

        if (File::exists($controllerPath)) {
            return response()->json(['error' => true, 'message' => 'Controller already exists']);
        }

        if (File::exists($viewPath)) {
            return response()->json(['error' => true, 'message' => 'Blade file already exists']);
        }

        $controllerContent = "<?php\n\nnamespace App\Http\Controllers;\n\nuse Illuminate\Http\Request;\n\nclass {$moduleName}Controller extends Controller\n{\n public function index()\n {\n return view('pages.$moduleName');\n }\n}";
        File::put($controllerPath, $controllerContent);

        $viewContent = '
            @include("components.head")
            @include("components.navbars")

            <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">

            @include("components.topbar")

            <div class="container-fluid py-4">

            <div class="alert alert-dismissible fade show d-none" role="alert" id="dynamicAlert">
                <span class="alert-icon text-light"><i class="fas" id="alertIcon"></i></span>
                <span class="alert-text text-light" id="alertMessage"></span>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

                <div class="card">
                    <div class="card-header pb-0 mb-0">
                    <div class="d-flex justify-content-between">
                        <h6> <i class="' . $icon . '"></i> ' . $moduleName . '</h6>
                    </div>
                    </div>
                    <div class="card-body px-0 pt-0 pb-2 mt-0">

                    </div>
                </div>
            </div>
            </main>

            @include("components.modal")
            @include("components.footer")';

        File::ensureDirectoryExists(dirname($viewPath));
        File::put($viewPath, $viewContent);
    }

    protected function addRoute($moduleName)
    {
        $routePath = base_path('routes/web.php');
        $controllerName = "{$moduleName}Controller";
        $useStatement = "use App\\Http\\Controllers\\{$controllerName};";
        $newRoute = "Route::get('admin/$moduleName', [{$controllerName}::class, 'index'])->name('" . strtolower($moduleName) . "');";
        $routeContent = File::get($routePath);

        if (strpos($routeContent, $newRoute) !== false) {
            return response()->json(['error' => true, 'message' => 'Route already exists']);
        }

        if (strpos($routeContent, $useStatement) === false) {
            $firstUsePosition = strpos($routeContent, 'use ');
            if ($firstUsePosition !== false) {
                $routeContent = substr($routeContent, 0, $firstUsePosition) . $useStatement . "\n" . substr($routeContent, $firstUsePosition);
            } else {
                $routeContent = "<?php\n" . $useStatement . "\n" . $routeContent;
            }
            File::put($routePath, $routeContent);
        }

        File::append($routePath, "\n" . $newRoute);
    }
}
