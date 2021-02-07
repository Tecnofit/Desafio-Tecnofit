import React, { useEffect, useState } from 'react'
import { getEnabledTrainingByUserId, patchChangeStatusStudentTrainingProgress } from '../../../api';
import Typhography from '../../../components/Typhography'
import GymContainer from './styles'

export interface IActivity {
  activity_uuid: string;
  activity_name: string;
  status: string;
}

export interface IEnabledTraining {
  training_uuid: string;
  training_name: string;
  activities: IActivity[]
}

const Training = () => {
  const [enabledTraining, setEnabledTraining] = useState<IEnabledTraining>();
  const [activity, setActivity] = useState<IActivity>();

  useEffect(() => {
    (async function searcherTraining() {
      const training: any = await getEnabledTrainingByUserId();
      setEnabledTraining(training);

      if (training.activities.length > 0) {
        setActivity(training.activities[0]);
      }
    })();
  }, []);

  const onStatusChanged = async (event: React.ChangeEvent<HTMLInputElement | HTMLTextAreaElement | HTMLSelectElement>) => {
    event.persist();
    const { value } = event.target;

    // @ts-ignore
    let newActivity: IActivity = {...activity, ...{status: value}};
    setActivity(newActivity);

    // @ts-ignore
    await patchChangeStatusStudentTrainingProgress(enabledTraining?.training_uuid, activity?.activity_uuid);
  }

  return (
    <GymContainer>
        <Typhography> Treino </Typhography>
        
        <span className='training'> {enabledTraining?.training_name}  </span>

        <hr className='divider' style={{marginTop: '1rem', marginBottom: '1rem'}} />

        <div style={{display: 'flex', justifyContent: 'space-between', alignItems: 'center'}}>
          <Typhography> Excercício </Typhography>
          
          <div>
            <span>{'< voltar'}</span>
            {' '}
            <span>{'próximo >'}</span>
          </div>
        </div>

        <span className='activity'>{activity?.activity_name}</span>

        <hr className='divider' style={{marginTop: '1rem', marginBottom: '1rem'}} />

        <div className='actions'>
            <input type="radio" name="status" value="NOT_STARTED" checked={activity?.status == 'NOT_STARTED'} onChange={onStatusChanged} />
            Não iniciei

            <input type="radio" name="status" value="IN_PROGRESS" checked={activity?.status == 'IN_PROGRESS'} onChange={onStatusChanged} />
            Fazendo

            <input type="radio" name="status" value="COMPLETED" checked={activity?.status == 'COMPLETED'} onChange={onStatusChanged} />
            Ok

            <input type="radio" name="status" value="SKIPPED" checked={activity?.status == 'SKIPPED'} onChange={onStatusChanged} />
            Pulo
        </div>

        <hr className='divider' style={{marginTop: '1rem', marginBottom: '1rem'}} />

    </GymContainer>
  )
}

export default Training
