const router = require('express').Router();

const User = require('./controllers/UserController');
const Training = require('./controllers/TrainingController');
const Exercise = require('./controllers/ExerciseController');
const TrainingExercises = require('./controllers/TrainingExercisesController');
const SessionExercise = require('./controllers/SessionExerciseController');

router.get('/', (req, res) => {
    return res.send('Tecnofit Dev Test');
})

// User
router.post('/users', User.create);
router.get('/users/:email', User.find);
router.put('/users/:email', User.update);
router.delete('/users/:email', User.delete);

// Training
router.post('/trainings', Training.create);
router.get('/trainings/:training', Training.find);
router.put('/trainings/:training', Training.update);
router.delete('/trainings/:training', Training.delete);

// Exercise
router.post('/exercises', Exercise.create);
router.get('/exercises/:exercise', Exercise.find);
router.put('/exercises/:exercise', Exercise.update);
router.delete('/exercises/:exercise', Exercise.delete);

// Training Exercises
router.post('/training/exercises', TrainingExercises.create);

// Session Exercise
router.post('/session/exercise', SessionExercise.create);

module.exports = router;