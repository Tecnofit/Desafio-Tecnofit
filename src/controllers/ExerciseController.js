const Exercise = require('../models/Exercise');
const TrainingExercises = require('../models/TrainingExercises');
const Training = require('../models/Training');

module.exports = {
    create: async (req, res) => {
        try{

            let rtn = await Exercise.create({
                name: req.body.name,
                description: req.body.description
            })

            return res.json(rtn)

        }catch (err){
            return res.status(400).json({
                error: 'Error on create exercise.',
                message: err.message
            });
        }
    },
    find: async (req, res) => {
        try{

            if(!req.params.exercise){
                return res.status(400).send({
                    error: 'exercise is required',
                    message: err.message
                });
            }

            let exercise = req.params.exercise;


            const tr = await Exercise.findOne({
                '_id': exercise
            });

            if(!tr){
                return res.status(400).json({
                    error: 'exercise don\'t exists'
                });
            }
            
            return res.json(tr);
        } catch (err) {
            return res.status(400).send({
                error: 'Find failed.',
                message: err.message
            });
        }
    },
    update: async (req, res) => {
        try{

            if(!req.params.exercise){
                return res.status(400).send({
                    error: 'exercise is required'
                });
            }

            let dbExercise = await Exercise.findOne({
                '_id': new Object(req.params.exercise)
            });

            if(!dbExercise){
                return res.status(400).json({
                    error: 'Exercise don\'t exists'
                });
            }

            let data = { 
                name: (typeof req.body.name !== 'undefined' && req.body.name != dbExercise.name) ? req.body.name : dbExercise.name,
                description: (typeof req.body.description !== 'undefined' && req.body.description != dbExercise.description) ? req.body.description : dbExercise.description,
            };

            await Exercise.updateOne({'_id': dbExercise._id} , data);

            return res.json(data);
        } catch (err) {
            return res.status(400).send({
                error: 'Update failed.',
                message: err.message
            });
        }
    },
    delete: async (req, res) => {
        try{

            if(!req.params.exercise){
                return res.status(400).send({
                    error: 'exercise is required'
                });
            }

            let exercise = req.params.exercise;

            let dbExercise = await Exercise.findOne({
                '_id': new Object(exercise)
            });

            if(!dbExercise){
                return res.status(400).json({
                    error: 'exercise don\'t exists'
                });
            }



            //check if has active training related            
            //get all training exercises relations
            let trainingExercises = await TrainingExercises.find({
                'exerciseId': new Object(req.params.exercise)
            });

            //foreach training check if status is active            
            for([i, te] of trainingExercises.entries()){

                let training = await Training.find({
                    '_id': new Object(te.trainingId)
                });
                
                if(training[0].status === 'active'){
                    return res.status(400).json({
                        error: 'You can\'t remove exercise from an active training'
                    });
                }
            }

            const trn = await Exercise.remove({ 
                '_id': dbExercise._id
            });

            return res.send('exercise ' + dbExercise._id + ' deleted!');
        } catch (err) {
            return res.status(400).send({
                error: 'Delete failed.',
                message: err.message
            });
        }
    },
}