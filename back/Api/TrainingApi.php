<?php
namespace Tecno\Back\Api;

use Tecno\Lib\DB;

class TrainingApi
{
    public static function getAllTraining($params)
    {
        $sql = "select
                    training.id,
                    training.training_name,
                    training.training_desc,
                    training.session_quantity,
                    training.resting_interval,
                    training_level.level_desc,
                    training.created_at,
                    student_profile.profile_desc
                from
                    training
                inner join
                    training_level on training_level.id = training.fk_level
                left join
                    student_profile on student_profile.id = training.fk_profile_sugestion";
        
        $db = new DB();
        $stmt = $db->prepare($sql);
        $stmt->execute();

        echo json_encode($stmt->fetchAll());
        exit;
    }

    public static function getAllLevels($params)
    {
        $jsonResponse = [];
        $db = new DB();
        $levels = $db->query("select * from training_level");
        
        foreach ($levels as $level) {
            $jsonResponse[] = $level;
        }

        echo json_encode($jsonResponse);
        exit;
    }

    public static function saveTraining($params)
    {
        $db = new DB();
        $sql = "INSERT INTO training (training_name, fk_level, training_desc, session_quantity, resting_interval, fk_profile_sugestion) 
            VALUES(:name, :level, :desc, :sessions, :resting, :fk_profile_sugestion)";

        $binds = [
            ':name' => $params['name'],
            ':level' => $params['level'],
            ':desc' => $params['desc'],
            'sessions' => $params['sessions'],
            ':resting' => $params['resting'],
            ':fk_profile_sugestion' => $params['sugested_for']
        ];

        if (!empty($params['id'])) {
            $sql = "update training
                set 
                    training_name = :name,
                    fk_level = :level,
                    training_desc = :desc,
                    session_quantity = :sessions,
                    resting_interval = :resting,
                    fk_profile_sugestion = :fk_profile_sugestion
                where
                    id = :id
            ";

            $binds = array_merge($binds, [
                ':id' => $params['id']
            ]);
        }

        try {
            $stmt = $db->prepare($sql);
            $stmt->execute($binds);

            $trainingId = $db->lastInsertId();
            
            $exercises = json_decode($params['exercises']);
            foreach ($exercises as $exercise) {
                $stmt = $db->prepare('INSERT INTO exercises_training (fk_training, fk_exercise, series, repetition) 
                VALUES(:training, :exercise, :series, :repetition)');

                $stmt->execute(array(
                    ':training' => $trainingId,
                    ':exercise' => $exercise->exercise,
                    ':series' => $exercise->series,
                    ':repetition' => $exercise->repetitions
                ));
            }

        } catch (\Exception $e) {
            echo $e->getMessage();
            echo json_encode([
                'success' => false,
                'msg' => 'Failed to save a training.'
            ]);
            exit;
        }

        echo json_encode([
            'success' => true,
            'msg' => 'Training saved successfully'
        ]);
        exit;
    }

    public static function getTrainingById($params)
    {
        $db = new DB();
        $stmt = $db->prepare("select * from training where id = :id");
        $stmt->execute([
            ':id' => $params['id']
        ]);

        echo json_encode($stmt->fetchAll());
        exit;
    }

    public static function getTrainingByStudent($params)
    {
        $db = new DB();
        $sql = "
            select
                training.*
            from
                training
            inner join
                student on student.fk_active_training = training.id
            where
                student.id = :id
        ";

        $stmt = $db->prepare($sql);
        $stmt->execute([
            ':id' => $params['studentid']
        ]);

        echo json_encode($stmt->fetchAll());
        exit;
    }

    public static function deleteTraining($params)
    {
        $db = new DB();
        try {
            $db->beginTransaction();

            $stmt = $db->prepare('select id from exercises_training where fk_training = :id');
            $stmt->execute([':id' => $params['trainingid']]);

            $exerciseTraining = $stmt->fetchAll()[0];

            $stmt = $db->prepare('delete from student_training where fk_exercise_training = :id');
            if (!$stmt->execute([':id' => $exerciseTraining['id']])) {
                throw new \Exception("Error to delete from student_training"); 
            }

            $stmt = $db->prepare('delete from exercises_training where fk_training = :id');
            if (!$stmt->execute([':id' => $params['trainingid']])) {
                throw new \Exception("Error to delete from exercises_training"); 
            }

            $stmt = $db->prepare('delete from training where id = :id');
            if (!$stmt->execute([':id' => $params['trainingid']])) {
                throw new \Exception("Error to delete from training"); 
            }
        } catch (\Exception $e) {
            $db->rollBack();

            echo json_encode([
                'success' => false,
                'msg' => $e->getMessage()
            ]);
            exit;
        }

        $db->commit();
        echo json_encode([
            'success' => true,
            'msg' => 'Training successfully deleted'
        ]);
        exit;
    }
}
