import Shift from "./Shift";
import Attendance from "./Attandece";

export default interface Schedule {
    id: number,
    shift: Shift,
    attendance: Attendance
}
  