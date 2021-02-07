import React from 'react'
import Masonry from 'react-masonry-css'
import GymMasonryCard from './styles'
import Button from '../../../../components/Button'

const MasonryCard = () => {
    const breakpointColumnsObj = {
        default: 4,
        1100: 3,
        700: 2,
        500: 1
    };

  return (
    <GymMasonryCard>
        <Masonry
          breakpointCols={breakpointColumnsObj}
          className="my-masonry-grid"
          columnClassName="my-masonry-grid_column">
            <div>
              Peito, Ombro, Tríceps
              <div style={{marginTop: '1rem'}}>
                <Button primary>Selecionar</Button>
              </div>
            </div>
            <div>
              Costas, Trapézio, Bíceps
              <div style={{marginTop: '1rem'}}>
                <Button primary>Selecionar</Button>
              </div>
            </div>
            <div> 
              <span>Perna</span>
              <div style={{marginTop: '1rem'}}>
                <Button primary>Selecionar</Button>
              </div>
            </div>
        </Masonry>
    </GymMasonryCard>
  )
}

export default MasonryCard
