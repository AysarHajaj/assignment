import Schedule from "./Schedule";

export default interface Employee {
    employee_id: number,
    employee_name: string,
    total_working_hours: number,
    schedules: Array<Schedule>
}