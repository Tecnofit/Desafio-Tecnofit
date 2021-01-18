const Training = require('../models/Training');

module.exports = {
    create: async (req, res) => {
        try{

            let rtn = await Training.create({
                user_id: req.body.user_id,
                name: req.body.name,
                status: 'inactive'
            })

            return res.json(rtn)

        }catch (err){
            return res.status(400).json({
                error: 'Error on create user.',
                message: err.message
            });
        }
    },
    find: async (req, res) => {
        try{

            if(!req.params.training){
                return res.status(400).send({
                    error: 'Training is required',
                    message: err.message
                });
            }

            let training = req.params.training;


            const tr = await Training.findOne({
                '_id': training
            });

            if(!tr){
                return res.status(400).json({
                    error: 'Training don\'t exists'
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

            if(!req.params.training){
                return res.status(400).send({
                    error: 'Training is required'
                });
            }

            let dbTraining = await Training.findOne({
                '_id': new Object(req.params.training)
            });

            if(!dbTraining){
                return res.status(400).json({
                    error: 'Training don\'t exists'
                });
            }

            //get user
            let userTrainingactive = await Training.findOne({
                'user_id': new Object(dbTraining.user_id),
                'status': 'active'
            });

            return res.status(400).json(userTrainingactive);


            //verify if user have an active training
            if(userTrainingactive > 0 && (typeof req.body.status !== 'undefined' && req.body.status === 'active')){
                return res.status(400).json({
                    error: 'Current user already have an active training'
                });
            }

            let data = { 
                name: (typeof req.body.name !== 'undefined' && req.body.name != dbTraining.name) ? req.body.name : dbTraining.name,
                status: (typeof req.body.status !== 'undefined' && req.body.status != dbTraining.status) ? req.body.status : dbTraining.status
            };

            await Training.updateOne({'_id': dbTraining._id} , data);

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

            if(!req.params.training){
                return res.status(400).send({
                    error: 'Training is required'
                });
            }

            let training = req.params.training;

            let dbTraining = await Training.findOne({
                '_id': new Object(training)
            });

            if(!dbTraining){
                return res.status(400).json({
                    error: 'Training don\'t exists'
                });
            }

            const trn = await Training.remove({ 
                '_id': dbTraining._id
            });

            return res.send('Training ' + dbTraining._id + ' deleted!');
        } catch (err) {
            return res.status(400).send({
                error: 'Delete failed.',
                message: err.message
            });
        }
    },
}