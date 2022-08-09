import React from 'react'
import { ResourceGuesser } from '@api-platform/admin'
import List from './List'
import Edit from './Edit'

const Questions = ({ ...props }) => (
  <ResourceGuesser
    {...props}
    name='questions'
    list={List}
    edit={Edit}
  />
)

export default Questions
