import React from 'react'
import Button from '../../../../../components/Button'

export interface ITrainingItem {
    training_name: string;
    training_uuid: string;
}

const MasonryCardItem: React.FC<ITrainingItem> = (props: ITrainingItem) => {
  return (
    <div>
        {props.training_name}
        <div style={{marginTop: '1rem'}}>
            <Button primary>Selecionar</Button>
        </div>
    </div>
  )
}

export default MasonryCardItem
