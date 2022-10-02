import React from 'react';

function TableHeader() {

  return (
    <thead>
        <tr>
            <th>Employee Name</th>
            <th>Shift Name</th>
            <th>Start Time</th>
            <th>End Time</th>
            <th>Check In</th>
            <th>Check Out</th>
            <th>Working Hours</th>
            <th>Total Working Hours</th>
        </tr>
    </thead>
  );
}

export default TableHeader;
