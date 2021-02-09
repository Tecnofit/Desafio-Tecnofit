import React from 'react'
import styled, { css } from 'styled-components'
import IButton from './types'

const BaseButton = styled.button`
  display: inline-flex;
  font-family: 'Raleway';
  font-weight: 400;
  white-space: nowrap;
  cursor: pointer;
  transition: all 0.3s cubic-bezier(0.645, 0.045, 0.355, 1);
  user-select: none;
  touch-action: manipulation;
  border-radius: 2px;
  border: solid 1px transparent;
  text-shadow: 0 -1px 0 rgba(0, 0, 0, 0.12);
  box-shadow: 0 2px 0 rgba(0, 0, 0, 0.045);
  pointer-events: visible;
  width: 100%;
  justify-content: center;
  align-items: center;

  &[disabled] {
    color: #dadada;
    cursor: not-allowed;
    pointer-events: none;
    opacity: 0.5;
  }

  &:hover {
    background-color: #a1a0bf;
  }

  ${(props: IButton) =>
    props.primary &&
    css`
      background: #3057E4!important;
      border-color: #3057E4!important;
      color: #fff;
      font-size: 1rem;
      padding: 5px;
    `}

  ${(props: IButton) =>
    props.bigger &&
    css`
      font-size: 1.5rem;
      padding: 1.25rem 2rem;
    `}
`

const Wrapper = styled(BaseButton)`
  background: #3057E4;
  border-color: #3057E4;
  color: #fff;
`

const GymButton: React.FC<IButton> = (props) => {
  return <Wrapper {...props}>{props.children}</Wrapper>
}

export default GymButton
