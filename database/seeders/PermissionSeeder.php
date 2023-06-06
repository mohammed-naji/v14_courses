<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{

    private $permissions = [
        'add_category' => 'Add new Category',
        'show_categories' => 'Show all categories',
        'edit_category' => 'Edit Category',
        'delete_category' => 'Delete Category',
        'add_course' => 'Add new Course',
        'show_courses' => 'Show all Courses',
        'edit_course' => 'Edit Course',
        'delete_course' => 'Delete Course'
    ];

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach($this->permissions as $code => $name) {
            Permission::create([
                'name' => $name,
                'code' => $code
            ]);
        }

    }
}
