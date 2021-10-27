<?php

namespace Database\Seeders;

use Faker\Factory;
use App\Models\User;
use App\Models\Mentor;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;



class MentorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $f = Factory::create();
        


        $data = User::where('role_id',3)->get('id');
        $array_users_id = json_decode(json_encode($data), true);
        $dataT= [];
        foreach($array_users_id as $d){
            $da=$d['id'];
            array_push($dataT, $da);
        }
        $arr = $dataT;
        for($i = 1; $i <= count($arr);){
            if(empty($dataT)) $dataT = $arr; 
            $selected = array_rand($dataT, 1);  
            
            $m = new Mentor();
            // $m->group_id = rand(1,4);
            $m->user_id = $dataT[$selected];
            $m->city = $f->city;
            $m->skype = $f->userName;
            
            $m->save();
            
            unset($dataT[$selected]); 
            $i++;
        
        
        
        
        }
        
    }
}
