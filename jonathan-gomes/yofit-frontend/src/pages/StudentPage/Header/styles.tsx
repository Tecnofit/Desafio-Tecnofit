import React from 'react'
import styled from 'styled-components'

const BaseHeader = styled.header`
  display: flex;
  height: 70px;
  padding: 0 1.5rem;
  align-items: center;
  border-bottom: solid 1px #EEEEEE;
  justify-content: space-between;
`

const GymHeader: React.FC = (props) => {
  return <BaseHeader {...props}>{props.children}</BaseHeader>
}

export default GymHeader
