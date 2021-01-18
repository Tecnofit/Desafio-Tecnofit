const trainingExercises = require('../models/TrainingExercises');

module.exports = {
    create: async (req, res) => {
        try{

            let rtn = await trainingExercises.create({
                trainingId: req.body.trainingId,
                exerciseId: req.body.exerciseId,
                sessions: req.body.sessions
            })

            return res.json(rtn)

        }catch (err){
            return res.status(400).json({
                error: 'Error on create relation.',
                message: err.message
            });
        }
    }
}