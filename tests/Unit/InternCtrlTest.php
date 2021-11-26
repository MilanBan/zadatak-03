<?php

namespace Tests\Unit;

use Illuminate\Http\UploadedFile;
use Tests\TestCase;

class InternCtrlTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_interns_index()
    {
        $loggedUser = $this->getLoggedMentor();
        $response = $this->getApi('/api/interns', $loggedUser['token']);
        $response->assertStatus(200);
    }

    public function test_intern_create()
    {
        $loggedUser = $this->getLoggedMentor();
        $data = [
            'id' => 51,
            'group_id' => 1,
            'firstName' => 'Jova',
            'lastName' => 'Jovic',
            'city' => 'Novi Sad',
            'address' => 'bl.123',
            'email' => 'meil.meil@mail.com',
            'telephone' => '+1242141412',
            'cv' => UploadedFile::fake()->create('cv.pdf', 7000),
            'github' => 'http://www.git.com',

        ];
        $response = $this->postApi('/api/interns/create', $data, $loggedUser['token']);
        $response->assertStatus(201);
    }

    public function test_intern_update()
    {
        $loggedUser = $this->getLoggedMentor();
        $data = [
            'group_id' => 2,
            'firstName' => 'Jova1',
            'lastName' => 'Jovic1',
            'city' => 'Novi Sad1',
            'address' => 'bl.1231',
            'email' => 'meil.meil@mail.com1',
            'telephone' => '+12421414112',
            'cv' => UploadedFile::fake()->create('cv1.pdf', 7000),
            'github' => 'http://www.git.com1',

        ];
        $response = $this->postApi('/api/interns/51', $data, $loggedUser['token']);
        $response->assertStatus(200);
    }

    public function test_intern_show()
    {
        $loggedUser = $this->getLoggedMentor();
        $response = $this->getApi('/api/interns/51', $loggedUser['token']);
        $response->assertStatus(200);
    }

    public function test_intern_delete()
    {
        $loggedUser = $this->getLoggedMentor();
        $response = $this->deleteApi('/api/interns/51', $loggedUser['token']);
        $response->assertStatus(200);
    }
}
