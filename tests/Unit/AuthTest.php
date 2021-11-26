<?php

namespace Tests\Unit;

use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;

class AuthTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */

    public function test_admin_login()
    {
        $admin = $this->getLoggedAdmin();
        $admin->assertJson(fn(AssertableJson $json) =>
            $json->hasAll('user', 'token')
        );
    }

    public function test_mentor_login()
    {
        $mentor = $this->getLoggedMentor();
        $mentor->assertJson(fn(AssertableJson $json) =>
            $json->hasAll('user', 'token')
        );
    }

    public function test_recruiter_login()
    {
        $recruiter = $this->getLoggedRecruiter();
        $recruiter->assertJson(fn(AssertableJson $json) =>
            $json->hasAll('user', 'token')
        );
    }
}
