const sessionExercise = require('../models/SessionExercise');

module.exports = {
    create: async (req, res) => {
        try{

            let rtn = await sessionExercise.create({
                trainingId: req.body.trainingId,
                exerciseId: req.body.exerciseId,
                status: req.body.status
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