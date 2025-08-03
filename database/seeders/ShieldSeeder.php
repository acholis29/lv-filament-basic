<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use BezhanSalleh\FilamentShield\Support\Utils;
use Spatie\Permission\PermissionRegistrar;

class ShieldSeeder extends Seeder
{
    public function run(): void
    {
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        $rolesWithPermissions = '[{"name":"super_admin","guard_name":"web","permissions":["view_department","view_any_department","create_department","update_department","delete_department","delete_any_department","view_employee","view_any_employee","create_employee","update_employee","delete_employee","delete_any_employee","view_ms::city","view_any_ms::city","create_ms::city","update_ms::city","delete_ms::city","delete_any_ms::city","view_ms::country","view_any_ms::country","create_ms::country","update_ms::country","delete_ms::country","delete_any_ms::country","view_ms::state","view_any_ms::state","create_ms::state","update_ms::state","delete_ms::state","delete_any_ms::state","view_msbranch","view_any_msbranch","create_msbranch","update_msbranch","delete_msbranch","delete_any_msbranch","view_msmarital","view_any_msmarital","create_msmarital","update_msmarital","delete_msmarital","delete_any_msmarital","view_msreligion","view_any_msreligion","create_msreligion","update_msreligion","delete_msreligion","delete_any_msreligion","view_role","view_any_role","create_role","update_role","delete_role","delete_any_role","view_subdepartment","view_any_subdepartment","create_subdepartment","update_subdepartment","delete_subdepartment","delete_any_subdepartment","view_user","view_any_user","create_user","update_user","delete_user","delete_any_user"]},{"name":"panel_user","guard_name":"web","permissions":[]},{"name":"pos_user","guard_name":"web","permissions":[]},{"name":"reservation","guard_name":"web","permissions":[]}]';
        $directPermissions = '[]';

        static::makeRolesWithPermissions($rolesWithPermissions);
        static::makeDirectPermissions($directPermissions);

        $this->command->info('Shield Seeding Completed.');
    }

    protected static function makeRolesWithPermissions(string $rolesWithPermissions): void
    {
        if (! blank($rolePlusPermissions = json_decode($rolesWithPermissions, true))) {
            /** @var Model $roleModel */
            $roleModel = Utils::getRoleModel();
            /** @var Model $permissionModel */
            $permissionModel = Utils::getPermissionModel();

            foreach ($rolePlusPermissions as $rolePlusPermission) {
                $role = $roleModel::firstOrCreate([
                    'name' => $rolePlusPermission['name'],
                    'guard_name' => $rolePlusPermission['guard_name'],
                ]);

                if (! blank($rolePlusPermission['permissions'])) {
                    $permissionModels = collect($rolePlusPermission['permissions'])
                        ->map(fn ($permission) => $permissionModel::firstOrCreate([
                            'name' => $permission,
                            'guard_name' => $rolePlusPermission['guard_name'],
                        ]))
                        ->all();

                    $role->syncPermissions($permissionModels);
                }
            }
        }
    }

    public static function makeDirectPermissions(string $directPermissions): void
    {
        if (! blank($permissions = json_decode($directPermissions, true))) {
            /** @var Model $permissionModel */
            $permissionModel = Utils::getPermissionModel();

            foreach ($permissions as $permission) {
                if ($permissionModel::whereName($permission)->doesntExist()) {
                    $permissionModel::create([
                        'name' => $permission['name'],
                        'guard_name' => $permission['guard_name'],
                    ]);
                }
            }
        }
    }
}
