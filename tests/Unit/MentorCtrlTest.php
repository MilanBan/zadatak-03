<?php

namespace Tests\Unit;

use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class MentorCtrlTest extends TestCase
{
    public $data = [
        'firstName' => 'test',
        'lastName' => 'testic',
        'email' => 'tesst@tuet.com',
        'password' => 'password',
        'password_confirmation' => 'password',
        'role_id' => 3,
        'city' => 'testCity',
        'skype' => 'skypeTest',
    ];
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_mentor_index()
    {
        $loggedUser = $this->getLoggedMentor();
        $response = $this->getApi('/api/mentors', $loggedUser['token']);
        $response->assertStatus(200);
    }

    public function test_mentor_show()
    {
        $loggedUser = $this->getLoggedMentor();
        $response = $this->getApi('/api/mentors/1', $loggedUser['token']);
        $response->assertStatus(200);
    }

    public function test_mentor_cant_create_mentor()
    {
        $loggedUser = $this->getLoggedMentor();

        $response = $this->postApi('/api/mentors/create', $this->data, $loggedUser['token']);
        $response->assertStatus(403);
    }

    public function test_admin_create_mentor()
    {
        $loggedUser = $this->getLoggedAdmin();
        $this->data['email'] = 'test@test1.com';
        $response = $this->postApi('/api/mentors/create', $this->data, $loggedUser['token']);
        $response->assertStatus(201);
    }

    public function test_recruiter_create_mentor()
    {
        $loggedUser = $this->getLoggedRecruiter();
        $this->data['email'] = 'test@test2.com';
        $response = $this->postApi('/api/mentors/create', $this->data, $loggedUser['token']);
        $response->assertStatus(201);
    }

    public function test_recruiter_update_mentor()
    {
        $loggedUser = $this->getLoggedRecruiter();
        $data['city'] = 'testCity2';
        $response = $this->putApi('/api/mentors/1', $data, $loggedUser['token']);
        $response->assertStatus(200);
    }

    public function test_admin_update_mentor()
    {
        $loggedUser = $this->getLoggedAdmin();
        $data['city'] = 'testCity2';
        $response = $this->putApi('/api/mentors/1', $data, $loggedUser['token']);
        $response->assertStatus(200);
    }

    public function test_mentor_update_mentor()
    {
        $loggedUser = $this->getLoggedMentor();
        $data['city'] = 'testCity2';
        $response = $this->putApi('/api/mentors/1', $data, $loggedUser['token']);
        $response->assertStatus(200);
    }

    public function test_admin_add_mentor_to_group()
    {
        DB::table('groups')->insert([
            'name' => 'testGroup',
            'id' => 10,
        ]);
        $loggedUser = $this->getLoggedAdmin();
        $data['city'] = 'testCity2';
        $response = $this->putApi('/api/mentors/1/10/add', $data, $loggedUser['token']);
        $response->assertStatus(200);
    }

    public function test_recruiter_add_mentor_to_group()
    {
        DB::table('groups')->insert([
            'name' => 'testGroup',
            'id' => 11,
        ]);
        $loggedUser = $this->getLoggedRecruiter();
        $data['city'] = 'testCity2';
        $response = $this->putApi('/api/mentors/2/11/add', $data, $loggedUser['token']);
        $response->assertStatus(200);
    }

    public function test_mentor_cant_add_mentor_to_group()
    {
        DB::table('groups')->insert([
            'name' => 'testGroup',
            'id' => 13,
        ]);
        $loggedUser = $this->getLoggedMentor();
        $data['city'] = 'testCity2';
        $response = $this->putApi('/api/mentors/3/13/add', $data, $loggedUser['token']);
        $response->assertStatus(403);
    }

    public function test_mentor_cant_delete_mentor()
    {
        $loggedUser = $this->getLoggedMentor();
        $response = $this->deleteApi('/api/mentors/10/', $loggedUser['token']);
        $response->assertStatus(403);
    }

    public function test_admin_delete_mentor()
    {
        $loggedUser = $this->getLoggedAdmin();
        $response = $this->deleteApi('/api/mentors/7/', $loggedUser['token']);
        $response->assertStatus(200);
    }

    public function test_recruiter_delete_mentor()
    {
        $loggedUser = $this->getLoggedRecruiter();
        $response = $this->deleteApi('/api/mentors/8/', $loggedUser['token']);
        $response->assertStatus(200);
    }
}
