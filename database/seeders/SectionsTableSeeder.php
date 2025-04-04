<?php

namespace Database\Seeders;

use App\Models\Section;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SectionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Dashboards 1 - 2
        Section::updateOrCreate(['id' => 1], ['name' => 'admin_dashboard', 'caption' => 'dashboard']);
        Section::updateOrCreate(['id' => 2], ['name' => 'admin_dashboard_show', 'section_group_id' => 1, 'caption' => "dashboard_page"]);

        // Roles 3 - 7
        Section::updateOrCreate(['id' => 3], ['name' => 'admin_roles', 'caption' => 'admin_roles']);
        Section::updateOrCreate(['id' => 4], ['name' => 'show_admin_roles', 'section_group_id' => 3, 'caption' => 'show_admin_roles']);
        Section::updateOrCreate(['id' => 5], ['name' => 'create_admin_roles', 'section_group_id' => 3, 'caption' => 'create_admin_roles']);
        Section::updateOrCreate(['id' => 6], ['name' => 'edit_admin_roles', 'section_group_id' => 3, 'caption' => 'edit_admin_roles']);
        Section::updateOrCreate(['id' => 7], ['name' => 'update_admin_roles', 'section_group_id' => 3, 'caption' => 'update_admin_roles']);
        Section::updateOrCreate(['id' => 8], ['name' => 'delete_admin_roles', 'section_group_id' => 3, 'caption' => 'delete_admin_roles']);

        // Users Management 9 - 15
        Section::updateOrCreate(['id' => 9], ['name' => 'user_management', 'caption' => 'user_management']);
        Section::updateOrCreate(['id' => 10], ['name' => 'all_users', 'section_group_id' => 9, 'caption' => 'show_all_users']);
        Section::updateOrCreate(['id' => 11], ['name' => 'change_users_role', 'section_group_id' => 9, 'caption' => 'change_users_role']);
        Section::updateOrCreate(['id' => 12], ['name' => 'change_users_status', 'section_group_id' => 9, 'caption' => 'change_users_status']);
        Section::updateOrCreate(['id' => 13], ['name' => 'delete_user', 'section_group_id' => 9, 'caption' => 'delete_user']);
        Section::updateOrCreate(['id' => 14], ['name' => 'edit_user', 'section_group_id' => 9, 'caption' => 'edit_user']);
        Section::updateOrCreate(['id' => 15], ['name' => 'create_user', 'section_group_id' => 9, 'caption' => 'create_user']);
 
        // Categories 16 - 20
        Section::updateOrCreate(['id' => 16], ['name' => 'categories', 'caption' => 'categories']);
        Section::updateOrCreate(['id' => 17], ['name' => 'all_categories', 'section_group_id' => 16, 'caption' => 'show_all_categories']); 
        Section::updateOrCreate(['id' => 18], ['name' => 'delete_category', 'section_group_id' => 16, 'caption' => 'delete_category']);
        Section::updateOrCreate(['id' => 19], ['name' => 'edit_category', 'section_group_id' => 16, 'caption' => 'edit_category']);
        Section::updateOrCreate(['id' => 20], ['name' => 'create_category', 'section_group_id' => 16, 'caption' => 'create_category']);
 
        // Users Management 21 - 25
        Section::updateOrCreate(['id' => 21], ['name' => 'departments', 'caption' => 'departments']);
        Section::updateOrCreate(['id' => 22], ['name' => 'all_departments', 'section_group_id' => 21, 'caption' => 'show_all_departments']); 
        Section::updateOrCreate(['id' => 23], ['name' => 'delete_department', 'section_group_id' => 21, 'caption' => 'delete_department']);
        Section::updateOrCreate(['id' => 24], ['name' => 'edit_department', 'section_group_id' => 21, 'caption' => 'edit_department']);
        Section::updateOrCreate(['id' => 25], ['name' => 'create_department', 'section_group_id' => 21, 'caption' => 'create_department']);
 
        // Branches Management 26 - 30
        Section::updateOrCreate(['id' => 26], ['name' => 'branches', 'caption' => 'branches']);
        Section::updateOrCreate(['id' => 27], ['name' => 'all_branches', 'section_group_id' => 26, 'caption' => 'show_all_branches']); 
        Section::updateOrCreate(['id' => 28], ['name' => 'delete_branch', 'section_group_id' => 26, 'caption' => 'delete_branch']);
        Section::updateOrCreate(['id' => 29], ['name' => 'edit_branch', 'section_group_id' => 26, 'caption' => 'edit_branch']);
        Section::updateOrCreate(['id' => 30], ['name' => 'create_branch', 'section_group_id' => 26, 'caption' => 'create_branch']);
 
 
        // Company Management 31 - 3
        Section::updateOrCreate(['id' => 31], ['name' => 'companies', 'caption' => 'companies']);
        Section::updateOrCreate(['id' => 32], ['name' => 'all_companies', 'section_group_id' => 31, 'caption' => 'show_all_companies']); 
        Section::updateOrCreate(['id' => 33], ['name' => 'delete_company', 'section_group_id' => 31, 'caption' => 'delete_company']);
        Section::updateOrCreate(['id' => 34], ['name' => 'edit_company', 'section_group_id' => 31, 'caption' => 'edit_company']);
        Section::updateOrCreate(['id' => 35], ['name' => 'create_company', 'section_group_id' => 31, 'caption' => 'create_company']);
 
        /* Run Panel Sections */
        $this->runPanelSections();
    }
    private function runPanelSections()
    {

        // // Organization Instructors 1 - 9
        // $this->createPanelSection(['id' => 1], ['name' => 'panel_organization_instructors', 'caption' => 'Organization Instructors']);
        // $this->createPanelSection(['id' => 2], ['name' => 'panel_organization_instructors_lists', 'section_group_id' => 1, 'caption' => 'Lists']);
        // $this->createPanelSection(['id' => 3], ['name' => 'panel_organization_instructors_create', 'section_group_id' => 1, 'caption' => 'Create']);
        // $this->createPanelSection(['id' => 4], ['name' => 'panel_organization_instructors_edit', 'section_group_id' => 1, 'caption' => 'Edit']);
        // $this->createPanelSection(['id' => 5], ['name' => 'panel_organization_instructors_delete', 'section_group_id' => 1, 'caption' => 'Delete']);


    }

    private function createPanelSection($arr1, $arr2)
    {
        $prefixId = 100000;
        $arr2['type'] = "panel";

        if (!empty($arr2['section_group_id'])) {
            $arr2['section_group_id'] = $prefixId + $arr2['section_group_id'];
        }

        Section::updateOrCreate([
            'id' => $prefixId + $arr1['id'],
        ], $arr2);
    }
}
