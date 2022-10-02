import Shift from "./Shift";
import Attendance from "./Attendance";

export default interface Schedule {
    id: number,
    shift: Shift,
    attendance: Attendance
}
  