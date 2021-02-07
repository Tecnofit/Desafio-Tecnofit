import React, { useEffect, useState } from 'react'
import GymContainer from './styles'
import WelcomeYofit from './WelcomeYofit'
import MasonryCard from './MasonryCard'
import Typhography from '../../../components/Typhography'
import { getListTrainingsAvaliableByUserId } from '../../../api'

export interface ITrainingItem {
  training_name: string;
  training_uuid: string;
}

const AvaliableTraining = () => {
  const [avaliableTrainings, setAvaliableTranings] = useState<ITrainingItem[]>([]);

  useEffect(() => {
    (async function anyNameFunction() {
      const trainings: any = await getListTrainingsAvaliableByUserId();
      setAvaliableTranings(trainings);
    })();
  }, []);

  return (
    <GymContainer>
        <WelcomeYofit />
        
        <div style={{marginBottom: '1rem'}}>
          <Typhography>Treinos Disponíveis</Typhography>
        </div>
        
        <MasonryCard trainings={avaliableTrainings} />
    </GymContainer>
  )
}

export default AvaliableTraining
