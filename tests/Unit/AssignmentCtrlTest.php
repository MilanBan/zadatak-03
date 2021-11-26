<?php

namespace Tests\Unit;

use Tests\TestCase;

class AssignmentCtrlTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_assignment_create()
    {
        $loggedUser = $this->getLoggedMentor();
        $data = [
            'name' => 'Assignment-21',
            'description' => 'Test assignment',
        ];
        $response = $this->postApi('/api/assignments/create', $data, $loggedUser['token']);
        $response->assertStatus(201);
    }

    public function test_assignment_update()
    {
        $loggedUser = $this->getLoggedMentor();
        $data = [
            'name' => 'Assignment-21-edited',
            'description' => 'Test assignment updated',
        ];
        $response = $this->putApi('/api/assignments/21', $data, $loggedUser['token']);
        $response->assertStatus(200);
    }

    public function test_assignments_index()
    {
        $loggedUser = $this->getLoggedMentor();

        $response = $this->getApi('/api/assignments', $loggedUser['token']);
        $response->assertStatus(200);
    }

    public function test_assignment_show()
    {
        $loggedUser = $this->getLoggedMentor();

        $response = $this->getApi('/api/assignments/21', $loggedUser['token']);
        $response->assertStatus(200);
    }

    public function test_assignment_assign_or_clone_to_group()
    {
        $loggedUser = $this->getLoggedMentor();
        $data = ['1' => '1'];
        $response = $this->postApi('/api/assignments/21/1/add', $data, $loggedUser['token']);
        $response->assertStatus(200);
    }

    public function test_assignment_remove_from_group()
    {
        $loggedUser = $this->getLoggedMentor();

        $response = $this->deleteApi('/api/assignments/21/1/remove', $loggedUser['token']);
        $response->assertStatus(200);
    }

}
