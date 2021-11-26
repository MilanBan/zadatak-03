<?php

namespace Tests\Unit;

use App\Models\Mentor;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class GroupCtrlTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_group_index()
    {
        $loggedUser = $this->getLoggedMentor();
        $response = $this->getApi('/api/groups', $loggedUser['token']);
        $response->assertStatus(200);
    }

    public function test_group_show()
    {
        $loggedUser = $this->getLoggedMentor();
        $response = $this->getApi('/api/groups/1', $loggedUser['token']);
        $response->assertStatus(200);
    }

    public function test_admin_create_group()
    {
        $loggedUser = $this->getLoggedAdmin();
        $data = [
            'name' => 'testGroupA',
        ];
        $response = $this->postApi('/api/groups/create', $data, $loggedUser['token']);
        $response->assertStatus(201);
    }

    public function test_recruiter_create_group()
    {
        $loggedUser = $this->getLoggedRecruiter();
        $data = [
            'name' => 'testGroupR',
        ];
        $response = $this->postApi('/api/groups/create', $data, $loggedUser['token']);
        $response->assertStatus(201);
    }

    public function test_mentor_cant_create_group()
    {
        $loggedUser = $this->getLoggedMentor();
        $data = [
            'name' => 'testGroupM',
        ];
        $response = $this->postApi('/api/groups/create', $data, $loggedUser['token']);
        $response->assertStatus(403);
    }

    public function test_update_group()
    {
        $loggedUser = $this->getLoggedMentor();
        $data = [
            'name' => 'updated name',
        ];
        $response = $this->putApi('/api/groups/1', $data, $loggedUser['token']);
        $response->assertStatus(200);
    }

    public function test_admin_delete_group()
    {
        DB::table('groups')->insert([
            'name' => 'testGroup',
            'id' => 21,
        ]);
        $loggedUser = $this->getLoggedAdmin();

        $response = $this->deleteApi('/api/groups/21', $loggedUser['token']);
        $response->assertStatus(200);
    }

    public function test_recruiter_delete_group()
    {
        DB::table('groups')->insert([
            'name' => 'testGroup',
            'id' => 22,
        ]);
        $loggedUser = $this->getLoggedRecruiter();

        $response = $this->deleteApi('/api/groups/22', $loggedUser['token']);
        $response->assertStatus(200);
    }

    public function test_mentor_cant_delete_group()
    {
        $loggedUser = $this->getLoggedMentor();

        $response = $this->deleteApi('/api/groups/1', $loggedUser['token']);
        $response->assertStatus(403);
    }

    public function test_change_active_status_of_assignment_in_group()
    {
        DB::table('assignment_group')->insert([
            'assignment_id' => 1,
            'group_id' => 1,
        ]);
        $loggedUser = $this->getLoggedMentor();
        $data['id'] = '1';
        $response = $this->putApi('/api/groups/1/1/active', $data, $loggedUser['token']);
        $response->assertStatus(202);
    }

    public function test_mentor_create_review_for_assignment_from_group()
    {
        $loggedUser = $this->getLoggedMentor();
        $mentor = Mentor::where('user_id', $loggedUser['user']['id'])->first();
        DB::table('assignments')->insert([
            'name' => 'testAssignment',
            'description' => 'blah blah',
            'id' => 51,
        ]);
        DB::table('groups')->insert([
            'name' => 'testGroupAssignment',
            'id' => 21,
        ]);
        DB::table('assignment_group')->insert([
            'assignment_id' => 51,
            'group_id' => 21,
        ]);
        DB::table('group_mentor')->insert([
            'group_id' => 21,
            'mentor_id' => $mentor->id,
        ]);
        $review = DB::table('reviews')->insert([
            'assignment_id' => 51,
            'mentor_id' => $mentor->id,
            'intern_id' => 1,
            'mark' => '8',
            'pros' => 'jojojo',
            'cons' => 'kokok',
        ]);
        $this->assertTrue($review);
    }

    public function test_delete_review()
    {
        DB::table('reviews')->delete(41);
        $this->assertDatabaseMissing('reviews', ['id' => 41]);
    }

}
