<?php

namespace Tests;

use App\Models\Mentor;
use App\Models\User;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    protected function getAdmin()
    {
        return User::where('role_id', 1)->first();
    }

    public function getLoggedAdmin()
    {
        $admin = $this->getAdmin();
        return $this->login($admin->email);
    }

    protected function getRecruiter()
    {
        return User::where('role_id', 2)->first();
    }

    protected function getLoggedRecruiter()
    {
        $recruiter = $this->getRecruiter();

        return $this->login($recruiter->email);
    }

    protected function getMentor()
    {
        return Mentor::with('user')->orderByRaw("RAND()")->first();
    }

    protected function getLoggedMentor()
    {
        $mentor = $this->getMentor();

        return $this->login($mentor->user->email);
    }

    protected function login($data)
    {
        return $this->post('/api/login', [
            'email' => $data,
            'password' => 'password',
        ]);
    }

    protected function logout($data)
    {
        return $this->post('/api/logout' . $user['id']);
    }

    public function getApi($url, $header)
    {
        return $this->withHeaders([
            'Authorization' => 'Bearer ' . $header,
        ])->get($url);
    }

    public function postApi($url, $data, $header)
    {
        return $this->withHeaders([
            'Authorization' => 'Bearer ' . $header,
        ])->post($url, $data);
    }

    public function putApi($url, $data, $header)
    {
        return $this->withHeaders([
            'Authorization' => 'Bearer ' . $header,
        ])->put($url, $data);
    }

    public function deleteApi($url, $header)
    {
        return $this->withHeaders([
            'Authorization' => 'Bearer ' . $header,
        ])->delete($url);
    }
}
