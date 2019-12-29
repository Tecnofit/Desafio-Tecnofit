<?php
namespace Tecno\Back\Api;

use Tecno\Lib\DB;

class StudentApi
{

    public static function saveStudent($params)
    {
        $db = new DB();
        $sql = "insert into student (student_name, birth_date, weight, height, email, fk_student_profile, fk_active_training)
            values (:name, :birth, :weight, :height, :email, :studentprofile, :activetraining)";
        
        $bind = [
            ':name' => $params['name'],
            ':birth' => $params['birth'],
            ':weight' => $params['weight'],
            ':height' => $params['height'],
            ':email' => $params['email'],
            ':studentprofile' => $params['profile'],
            ':activetraining' => !empty($params['activetraining']) ? $params['activetraining'] : null
        ];
        
        if (!empty($params['id'])) {
            $sql = "update student
                set 
                    student_name = :name,
                    birth_date = :birth,
                    weight = :weight,
                    height = :height,
                    email = :email,
                    fk_student_profile = :studentprofile,
                    fk_active_training = :activetraining
                where
                    id = :id
            ";

            $bind = array_merge($bind, [
                ':id' => $params['id']
            ]);
        }

        $stmt = $db->prepare($sql);
        $success = $stmt->execute($bind);

        if (!$success) {
            echo json_encode([
                'success' => false,
                'msg' => 'Failed to save a new student.'
            ]);
            exit;
        }

        echo json_encode([
            'success' => true,
            'msg' => 'Student saved successfully'
        ]);
        exit;
    }

    public static function getAllProfiles($params)
    {
        $jsonResponse = [];
        $db = new DB();
        $profiles = $db->query("select * from student_profile");
        
        foreach ($profiles as $profile) {
            $jsonResponse[] = $profile;
        }

        echo json_encode($jsonResponse);
        exit;
    }

    public static function getAllStudents($params)
    {
        $sql = "select
                    student.id,
                    student.student_name,
                    student.email,
                    student_profile.profile_desc,
                    training.training_name
                from
                    student
                inner join
                    student_profile on student_profile.id = student.fk_student_profile
                left join
                    training on training.id = student.fk_active_training";

        $db = new DB();
        $stmt = $db->prepare($sql);    
        $stmt->execute();

        echo json_encode($stmt->fetchAll());
        exit;
    }

    public static function getStudentById($params)
    {
        $db = new DB();
        $stmt = $db->prepare("select * from student where id = :id");
        $stmt->execute([
            ':id' => $params['id']
        ]);

        echo json_encode($stmt->fetchAll());
        exit;
    }

    public static function getStudentTraining($params)
    {
        $db = new DB();
        $sql = "
            select
                *,
                max(student_training.session_number) session_number
            from
                student_training
            inner join
                exercises_training on exercises_training.id = student_training.fk_exercise_training
            where
                fk_student = :studentid
            and
                fk_training = :trainingid;
        ";

        $stmt = $db->prepare($sql);
        $stmt->execute([
            ':studentid' => $params['studentid'],
            ':trainingid' => $params['trainingid']
        ]);

        echo json_encode($stmt->fetchAll());
        exit;
    }

    public static function deleteStudent($params)
    {
        $db = new DB();
        try {
            $stmt = $db->prepare('delete from student_training where fk_student = :id');
            $stmt->execute([
                ':id' => $params['studentid']
            ]);
            
            $stmt = $db->prepare('delete from student where id = :id');
            $stmt->execute([
                ':id' => $params['studentid']
            ]);
        } catch (\Exception $e) {
            echo $e->getMessage();
            echo json_encode([
                'success' => false,
                'msg' => 'Failed to delete a student.'
            ]);
            exit;
        }

        echo json_encode([
            'success' => true,
            'msg' => 'Student successfully deleted'
        ]);
        exit;
    }

    public static function completeTraining($exercisesCompleted)
    {
        $arrExercises = json_decode($exercisesCompleted['exercises_completed']);
        $db = new DB();

        try {
            foreach ($arrExercises as $exercise) {
                $sql = "insert into student_training (fk_student, fk_exercise_training, exercise_finished, session_number)
                values (:student, :exercise_training, :finished, :session)";
            
                $binds = [
                    ':student' => $exercise->studentid,
                    ':exercise_training' => $exercise->exercise_training,
                    ':finished' => $exercise->finished,
                    ':session' => $exercise->session,
                ];

                $stmt = $db->prepare($sql);
                $stmt->execute($binds);
            }

            if ($arrExercises[0]->session == $arrExercises[0]->totalSessions) {
                $sql = "update student set fk_active_training = null where id = :id";
                $binds = [
                    ':id' => $arrExercises[0]->studentid
                ];
                $stmt = $db->prepare($sql);
                $stmt->execute($binds);

                $sql = "update student_training set session_number = 0 where fk_student = :student";
                $binds = [
                    ':student' => $arrExercises[0]->studentid
                ];
                $stmt = $db->prepare($sql);
                $stmt->execute($binds);
            }
        } catch (\Exception $e) {
            echo json_encode([
                'success' => false,
                'msg' => 'Failed to register the training progress'
            ]);
            exit;
        }

        echo json_encode([
            'success' => true,
            'msg' => 'Training progress registered successfully'
        ]);
        exit;
    }
}
