import React from 'react';
import TableHeader from './TableHeader';
import TableBody from './TableBody';
import Employee from '../Interfaces/Employee';

function Table({data}: {data: Array<Employee>}) {
  
  return (
    <table>
      <TableHeader />
      <TableBody data={data} />
    </table>
  );
}

export default Table;
