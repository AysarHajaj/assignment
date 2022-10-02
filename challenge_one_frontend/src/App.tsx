import React, {useEffect, useState} from 'react';
import './App.css';
import Table from './AttendanceTable/Table';

function App() {
  const [data, setData] = useState([]);
  const [loading, setLoading] = useState(false);
  useEffect(() => {
    setLoading(true);
    fetch(`http://127.0.0.1:8000/api/test`).then((res) => {
      return res.json();
    }).then((resData) => {
      setData(resData);
      setLoading(false);
    })
  }, []);
  return (
    <div className="App">
      {loading && <div>Loading...</div>}
      <Table  data={data}/>
    </div>
  );
}

export default App;
