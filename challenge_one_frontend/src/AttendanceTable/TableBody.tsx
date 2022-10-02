import React from 'react';
import Employee from '../Interfaces/Employee';
import Schedule from '../Interfaces/Schedule';

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

function TableBody({data}: {data: Array<Employee>}) {
  
  return (
    <tbody>
      {data.map((employee) => {
        return (
          <React.Fragment key={employee.employee_id}>
            <tr key={employee.employee_id}>
              <td rowSpan={employee.schedules.length}>
                {employee.employee_name}
              </td>
              {employee.schedules.length && getScheduleCells(employee.schedules[0])}
              <td rowSpan={employee.schedules.length}>
                {employee.total_working_hours}
              </td>
            </tr>
          {employee.schedules.length > 1 && getEmployeeSchedules(employee.schedules, 1)}
          </React.Fragment>
        )
      })}
    </tbody>
  );
}

export default TableBody;
