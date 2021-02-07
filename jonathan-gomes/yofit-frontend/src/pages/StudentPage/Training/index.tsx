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
  const [activityIndex, setActivityIndex] = useState(0);

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

  const onPriorActivity = () => {
    console.log("PRIOR INDEX");
    const priorIndex = activityIndex -1;
    const totalActivities = enabledTraining?.activities.length;
    
    setActivityIndex(
      // @ts-ignore
      priorIndex === -1 ? (totalActivities - 1) : activityIndex -1
    );

    setActivity(enabledTraining?.activities[activityIndex]);
  }

  const onNextActivity = () => {
    console.log("NEXT INDEX");

    const nextIndex = activityIndex + 1;
    const totalActivities = enabledTraining?.activities.length;

    setActivityIndex(
      nextIndex === totalActivities ? 0 : activityIndex + 1
    );

    setActivity(enabledTraining?.activities[activityIndex]);
  }

  return (
    <GymContainer>
        <Typhography> Treino </Typhography>
        
        <span className='training'> {enabledTraining?.training_name}  </span>

        <hr className='divider' style={{marginTop: '1rem', marginBottom: '1rem'}} />

        <div style={{display: 'flex', justifyContent: 'space-between', alignItems: 'center'}}>
          <Typhography> Excercício </Typhography>
          
          <div>
            <span onClick={onPriorActivity} style={{cursor: 'pointer'}}>{'< voltar'}</span>
            {' '}
            <span onClick={onNextActivity} style={{cursor: 'pointer'}}>{'próximo >'}</span>
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
