<?php
namespace Tecno\Back\Api;

use Tecno\Lib\DB;
use Tecno\Exception\ExerciseHasActiveTrainingException;

class ExerciseApi
{
    public static function saveExercise($params)
    {
        $db = new DB();
        $sql = "INSERT INTO exercise (exercise_name, exercise_desc) VALUES(:name, :desc)";

        $binds = array(
            ':name' => $params['name'],
            ':desc' => $params['desc']
        );

        if (!empty($params['id'])) {
            $sql = "update exercise
                set 
                    exercise_name = :name,
                    exercise_desc = :desc
                where
                    id = :id
            ";

            $binds = array_merge($binds, [
                ':id' => $params['id']
            ]);
        }

        $stmt = $db->prepare($sql);
        $success = $stmt->execute($binds);

        if (!$success) {
            echo json_encode([
                'success' => false,
                'msg' => 'Failed to save a new exercise.'
            ]);
            exit;
        }
        echo json_encode([
            'success' => true,
            'msg' => 'Exercise saved successfully'
        ]);
        exit;
    }

    public function getAllExercises()
    {
        $jsonResponse = [];
        $db = new DB();
        $exercises = $db->query("select * from exercise");
        
        foreach ($exercises as $exercise) {
            $jsonResponse[] = $exercise;
        }

        echo json_encode($jsonResponse);
        exit;
    }

    public static function getExerciseById($params)
    {
        $db = new DB();
        $stmt = $db->prepare("select * from exercise where id = :id");
        $stmt->execute([
            ':id' => $params['id']
        ]);

        echo json_encode($stmt->fetchAll());
        exit;
    }

    public static function getExerciseByTraining($params)
    {
        $db = new DB();
        $sql = "
            select
                exercises_training.id as exercise_training,
                exercises_training.series,
                exercises_training.repetition,
                exercise.*
            from
                exercises_training
            inner join
                exercise on exercise.id = exercises_training.fk_exercise
            where fk_training = :idtraining
        ";
        $stmt = $db->prepare($sql);
        $stmt->execute([
            ':idtraining' => $params['trainingid']
        ]);

        echo json_encode($stmt->fetchAll());
        exit;
    }

    public static function deleteExercise($params)
    {
        $db = new DB();
        $sql = "
            select 
                count(training.id) qt
            from
                exercises_training
            inner join
                training on training.id = exercises_training.fk_training
                    and training.training_active = 1
            where
                fk_exercise = :exerciseid
        ";
        $binds = [
            ':exerciseid' => $params['exerciseid']
        ];

        $stmt = $db->prepare($sql);
        $stmt->execute($binds);


        $qtActiveTraining = $stmt->fetch()['qt'];

        if ($qtActiveTraining < 1) {
            try {
                $stmt = $db->prepare('delete from exercises_training where fk_exercise = :id');
                $stmt->execute([
                    ':id' => $params['exerciseid']
                ]);
                $stmt = $db->prepare('delete from exercise where id = :id');
                $stmt->execute([
                    ':id' => $params['exerciseid']
                ]);
            } catch (\Exception $e) {
                echo json_encode([
                    'success' => false,
                    'msg' => 'Failed to delete a exercise.'
                ]);
                exit;
            }

            echo json_encode([
                'success' => true,
                'msg' => 'Exercise successfully deleted'
            ]);
            exit;
        }

        echo json_encode([
            'success' => false,
            'msg' => 'The exercise is present in some active training'
        ]);
        exit;
    }
}
