import React from 'react'
import { postStudentTraining } from '../../../../../api';
import Button from '../../../../../components/Button'

export interface ITrainingItem {
    training_name: string;
    training_uuid: string;
}

const MasonryCardItem: React.FC<ITrainingItem> = (props: ITrainingItem) => {

  const handleEnrolTraining = async () => {
    await postStudentTraining(props.training_uuid);
    window.location.href = '';
  }

  return (
    <div>
        {props.training_name}
        <div style={{marginTop: '1rem'}}>
            <Button primary onClick={handleEnrolTraining}>Selecionar</Button>
        </div>
    </div>
  )
}

export default MasonryCardItem
