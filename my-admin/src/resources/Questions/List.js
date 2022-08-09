import React from 'react'
import { ListGuesser, FieldGuesser } from '@api-platform/admin'
import { Pagination } from 'react-admin'

const PostPagination = props => <Pagination rowsPerPageOptions={[10, 25, 50, 100, 250]} {...props} />;

const List = ({ ...props }) => (
  <ListGuesser {...props} perPage={250} pagination={<PostPagination />} sort={{ field: 'id', order: 'DESC' }}>
    <FieldGuesser source={'id'} />
    <FieldGuesser source={'name'} />
  </ListGuesser>
)

export default List
