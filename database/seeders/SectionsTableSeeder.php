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
