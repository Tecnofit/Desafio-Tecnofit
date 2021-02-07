import React from 'react'
import styled from 'styled-components'

const Container = styled.div`
  .my-masonry-grid {
    display: flex;
    margin-left: -30px;
    width: auto;
  }
  .my-masonry-grid_column {
    padding-left: 30px;
    background-clip: padding-box;
  }
   
  .my-masonry-grid_column > div {
    background: #EEEEEE;
    margin-bottom: 30px;
    border-radius: 16px;
    padding: 1rem;
  }
`

const GymMasonryCard: React.FC = (props) => {
  return <Container {...props}>{props.children}</Container>
}

export default GymMasonryCard
