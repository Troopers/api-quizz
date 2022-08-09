import React from 'react'
import { EditGuesser, InputGuesser } from '@api-platform/admin'

const Edit = ({ ...props }) => (
  <EditGuesser {...props}>
    <InputGuesser source={'name'} />
  </EditGuesser>
)

export default Edit
