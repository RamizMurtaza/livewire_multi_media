<?php

namespace Database\Seeders;

use Database\Seeders\Approval\ApprovalTypeSeeder;
use Database\Seeders\ApprovalStatus\ApprovalStatusSeeder;
use Database\Seeders\Department\DepartmentSeeder;
use Database\Seeders\Designation\DesignationSeeder;
use Database\Seeders\Inventory\InventoryBrandSeeder;
use Database\Seeders\Inventory\InventoryCategorySeeder;
use Database\Seeders\Inventory\InventoryOptionSeeder;
use Database\Seeders\Inventory\InventoryOptionValueSeeder;
use Database\Seeders\Inventory\InventoryShopSeeder;
use Database\Seeders\Inventory\InventoryStatusSeeder;
use Database\Seeders\Inventory\InventoryTypeSeeder;
use Database\Seeders\Inventory\InventoryWarehouseSeeder;
use Database\Seeders\Media\MediaTypeSeeder;
use Database\Seeders\RequestType\RequestTypeSeeder;
use Database\Seeders\Role\RoleSeeder;
use Database\Seeders\ShiftTime\ShiftTimeSeeder;
use Database\Seeders\Team\TeamSeeder;
use Database\Seeders\User\UserSeeder;
use Database\Seeders\User\UserTeamSeeder;
use Database\Seeders\UserApprovalRequest\UserApprovalRequestSeeder;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder{

    public function run(){

        $this->call([

            MediaTypeSeeder::class,
        ]);
    }

}
