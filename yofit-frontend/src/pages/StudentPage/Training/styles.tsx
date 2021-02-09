import React from 'react'
import styled from 'styled-components'

const Container = styled.div`
  display: flex;
  flex-direction: column;

  .training {
      font-size: 36px;
      margin-top: .5rem;
      color: #585858;
      text-transform: uppercase;
  }

  .activity {
    font-size: 36px;
    margin-top: .5rem;
    color: #585858;
    word-break: break-all;
}

  .divider {
      border-top: 1px solid #EEEEEE;
  }

  .actions {
    display: flex;
    justify-content: space-between;
    color: grey;
    align-items: center;
  }
`

const GymContainer: React.FC = (props) => {
  return <Container {...props}>{props.children}</Container>
}

export default GymContainer
