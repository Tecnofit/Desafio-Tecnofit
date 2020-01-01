<?php

namespace App\Http\Controllers\Application;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Student;
use App\Http\Controllers\API\API_ExerciseController;

class StudentController extends Controller
{
    public function __construct(API_ExerciseController $exerciceService) {
        $this->exerciceService = $exerciceService;
    
    }
    public function index()
    {
        // return view('alunos.index');

        $exercices = $this->exerciceService->getExercices();

        echo "passou";
        echo $exercices;

        // $temp = file_get_contents($url);
        // echo $temp;

        // $obj = json_decode($temp, true);
        // echo "3";
        // foreach($obj as $o) {
        //     echo $o['name'];
        // }
        
        
        // echo 'asdfffff';
        // $ch = curl_init();
        // curl_setopt($ch, CURLOPT_HEADER, 0);
        // curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); //Set curl to return the data instead of printing it to the browser.
        // curl_setopt($ch, CURLOPT_URL, 'http://127.0.0.1:8000/api/exercises');
        // curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        // $data = curl_exec($ch);
        // curl_close($ch);
        // echo $data;
    }
}
