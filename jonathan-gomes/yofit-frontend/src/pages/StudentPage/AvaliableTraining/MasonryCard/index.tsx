import React from 'react'
import Masonry from 'react-masonry-css'
import MasonryCardItem from './MasonryCardItem';
import GymMasonryCard from './styles'

export interface ITrainingItem {
  training_name: string;
  training_uuid: string;
}

interface Props {
  trainings: ITrainingItem[];
}

const MasonryCard: React.FC<Props> = (props: Props) => {

  const breakpointColumnsObj = {
      default: 4,
      1100: 3,
      700: 2,
      500: 1
  };

  const listAvailableTrainings = props.trainings.map((training: ITrainingItem, index: number) =>
    <MasonryCardItem key={index} {...training} />
  );

  return (
    <GymMasonryCard>
        <Masonry
          breakpointCols={breakpointColumnsObj}
          className="my-masonry-grid"
          columnClassName="my-masonry-grid_column">
            {listAvailableTrainings}
        </Masonry>
    </GymMasonryCard>
  )
}

export default MasonryCard
