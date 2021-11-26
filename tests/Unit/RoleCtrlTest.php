<?php

namespace Tests\Unit;

use Tests\TestCase;

class RoleCtrlTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */

    public function test_is_admin_view_users()
    {
        $admin = $this->getLoggedAdmin();

        $response = $this->getApi('/api/users', $admin['token']);
        $response->assertStatus(200);
    }

    public function test_is_admin_view_roles()
    {
        $admin = $this->getLoggedAdmin();

        $response = $this->getApi('/api/roles', $admin['token']);
        $response->assertStatus(200);
    }

    public function test_is_admin_edit_users_roles()
    {
        $admin = $this->getLoggedAdmin();
        $data = ['role_id' => 1];
        $response = $this->putApi('/api/users/1', $data, $admin['token']);
        $response->assertStatus(200);
    }
}
