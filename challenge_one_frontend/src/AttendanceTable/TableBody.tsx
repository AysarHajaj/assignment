import React from 'react';
import Employee from '../Interfaces/Employee';
import Schedule from '../Interfaces/Schedule';

function TableBody({data}: {data: Array<Employee>}) {
  
  const getScheduleCells = (schedule: Schedule) => <React.Fragment key={schedule.id}>
  <td>{schedule.shift.name}</td>
  <td>{schedule.shift.start_time}</td>
  <td>{schedule.shift.end_time}</td>
  <td>{schedule.attendance.check_in}</td>
  <td>{schedule.attendance.check_out}</td>
  <td>{schedule.attendance.working_hours}</td>
</React.Fragment>

const getEmployeeSchedules = (schedules: Schedule[], fromIndex: number) =>{
  const result = [];
  for(let index= fromIndex; index < schedules.length; index++){
    result.push(<tr key={index}>{getScheduleCells(schedules[index])}</tr>);
  }
  return result;
}

  return (
    <div></div>
  );
}

export default TableBody;
