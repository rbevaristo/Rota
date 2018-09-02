//
class ScheduleManager {
    constructor() {
            //constants
            this.daysName = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];
            this.monthsName = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
            this.dateFormat = "MM/DD/YYYY";
            ScheduleManager.daysName = this.daysName;
            ScheduleManager.monthsName = this.monthsName;
            ScheduleManager.dateFormat = this.dateFormat;
            ScheduleManager.Instance = this;
            //data
            this.roles = []; // Role class
            this.employeeId = 0;
            this.roleId = 0;
            this.lockedPast = false;
            this.employees = []; // Employee class
            this.currentDate = new DateCalc(Date.now());
            this.currentDate.setStartOfDay();
            this.ui = null;
            this.dbsettings = null;
            this.dbcriteria = null;
            this.dbemploys = null;
            this.dbshifts = null;
            this.dbrequiredshifts = null;
            this.dbposition_ids = null;
            this.dbshifts_ids = null;
            //this.updateScheduleHistory();
            //
            console.log("Loaded Scheduler.");
            //
        }
        //
    static info(t) {
            console.log(t);
        }
        //
    static toNum(ss) {
            return Number(ss.substring(0, 2)) * 60 + Number(ss.substring(3, 5));
        }
        //
    getFN(f) {
            for (var i = 0; i < this.employees.length; i++) {
                if (this.employees[i].fname == f) {
                    return this.employees[i];
                }
            }
        }
        //
    toJSON() {
            var tab = {
                employeeId: this.employeeId,
                roleId: this.roleId,
                employees: [],
                lockedPast: this.lockedPast,
                roles: [],
            };
            if (this.ui && this.ui.currentRoleView) {
                tab.v = this.ui.currentRoleView;
            }
            for (var i = 0; i < this.employees.length; i++) {
                var emp = this.employees[i];
                tab.employees.push({
                    id: emp.id,
                    trueId: emp.trueId,
                    fname: emp.fname,
                    lname: emp.lname,
                    active: emp.active,
                    role: emp.role,
                    preferredDayoff: emp.preferredDayoff,
                    assignments: emp.assignments,
                    Age: emp.Age,
                    Gender: emp.Gender
                });
            }
            for (var i = 0; i < this.roles.length; i++) {
                var role = this.roles[i];
                var gens = [];
                for (var ii = 0; ii < role.generations.length; ii++) {
                    var g = role.generations[ii];
                    var sd = [];
                    for (var iii = 0; iii < g.scheduledDays.length; iii++) {
                        sd.push(g.scheduledDays[iii].id);
                    }
                    var em = [];
                    for (var iii = 0; iii < g.employees.length; iii++) {
                        em.push(g.employees[iii].id);
                    }
                    gens.push({
                        days: g.days,
                        employees: em,
                        id: g.id,
                        locked: g.locked,
                        scheduledDays: sd,
                        startDate: g.startDate
                    });
                }
                //
                var scheduledDays = [];
                for (var ii = 0; ii < role.scheduledDays.length; ii++) {
                    var d = role.scheduledDays[ii];
                    var shifts = [];
                    for (var i2 = 0; i2 < d.shifts.length; i2++) {
                        var s = d.shifts[i2];
                        var assigned = [];
                        for (var ie = 0; ie < s.assigned.length; ie++) {
                            assigned.push(s.assigned[ie].id);
                        }
                        shifts.push({
                            assigned: assigned,
                            dateWrap: s.dateWrap.id,
                            start: s.start,
                            end: s.end,
                            id: s.id,
                            minAssign: s.minAssign,
                            maxAssign: s.maxAssign,
                            shift: s.shift ? s.shift.id : null
                        });
                    }
                    scheduledDays.push({
                        date: d.date,
                        dayN: d.dayN,
                        id: d.id,
                        month: d.month,
                        roleId: d.roleId,
                        shiftId: d.shiftId,
                        year: d.year,
                        shifts: shifts
                    });
                }
                //
                var shs = [];
                for (var ix = 0; ix < role.shifts.length; ix++) {
                    var shd = role.shifts[ix];
                    shs.push({
                        id: shd.id,
                        start: shd.start,
                        end: shd.end,
                        defaultMinAssign: shd.defaultMinAssign,
                        defaultMaxAssign: shd.defaultMaxAssign
                    });
                }
                tab.roles.push({
                    id: role.id,
                    dayId: role.dayId,
                    generationId: role.generationId,
                    shiftDataId: role.shiftDataId,
                    name: role.name,
                    shifts: shs,
                    scheduledDays: scheduledDays,
                    disabledDays: role.disabledDays,
                    generations: gens,
                    shiftType: role.shiftType
                });
            }
            var jsonstring = JSON.stringify(tab);
            console.log("json string length:" + jsonstring.length);
            var compressed = LZString.compressToBase64(jsonstring);
            console.log("compressed length : " + compressed.length);
            return compressed;
        }
        //==========================================================================================================================================================================
        //==========================================================================================================================================================================
        //==========================================================================================================================================================================
        //==========================================================================================================================================================================
    loadJSON(str) {
            var str2 = LZString.decompressFromBase64(str);
            var tab = JSON.parse(str2);
            this.employeeId = 0;
            this.roleId = 0;

            this.employees = [];
            this.latestjson = tab;
            for (var i = 0; i < tab.employees.length; i++) {
                var emp2 = tab.employees[i];
                var emp = this.addEmployee(emp2.fname, emp2.lname, emp2.role);
                emp.id = emp2.id;
                emp.trueId = emp2.trueId;
                emp.active = emp2.active;
                emp.preferredDayoff = emp2.preferredDayoff;
                emp.assignments = emp2.assignments;
                emp.Age = emp2.Age;
                emp.Gender = emp2.Gender;
            }

            this.roles = [];
            for (var i = 0; i < tab.roles.length; i++) {
                var role2 = tab.roles[i];
                var role = this.addRole(role2.name);
                role.shifts = []; //role2.shifts; // 
                for (var ii in role2.shifts) {
                    //role.addShift(role2.shifts[ii].start,role2.shifts[ii].end,role2.shifts[ii].defaultMinAssign,role2.shifts[ii].defaultMaxAssign);
                    var sa2 = role2.shifts[ii];
                    var sa = new ShiftData(sa2.start, sa2.end);
                    sa.id = sa2.id;
                    sa.defaultMaxAssign = sa2.defaultMaxAssign;
                    sa.defaultMinAssign = sa2.defaultMinAssign;
                    role.shifts.push(sa);
                }



                role.scheduledDays = []; //
                for (var i2 = 0; i2 < role2.scheduledDays.length; i2++) {
                    var sd2 = role2.scheduledDays[i2];
                    var sd = new ScheduledDay(role, sd2.month, sd2.date, sd2.year, sd2.dayN);
                    sd.id = sd2.id;
                    sd.roleId = sd2.roleId;
                    sd.shiftId = sd2.shiftId;
                    var ss = [];
                    for (var ii2 = 0; ii2 < sd2.shifts.length; ii2++) {
                        var sh2 = sd2.shifts[ii2];
                        var sh = new Shift(sd, sh2.shift != null ? role.getShiftDataById(sh2.shift) : null);
                        sh.start = sh2.start;
                        sh.end = sh2.end;
                        sh.id = sh2.id;
                        sh.minAssign = sh2.minAssign;
                        sh.maxAssign = sh2.maxAssign;
                        sh.assigned = [];
                        for (var i3 = 0; i3 < sh2.assigned.length; i3++) {
                            sh.assigned.push(this.getEmpById(sh2.assigned[i3]));
                        }
                        ss.push(sh);
                    }
                    sd.shifts = ss;
                    role.scheduledDays.push(sd);
                }

                role.generations = []; // 
                for (var i2 = 0; i2 < role2.generations.length; i2++) {
                    var g = role2.generations[i2];
                    var gen = new SchedGeneration(g.startDate, g.days, role);
                    gen.id = g.id;
                    gen.locked = g.locked;
                    //
                    gen.scheduledDays = [];
                    for (var i3 = 0; i3 < g.scheduledDays.length; i3++) {
                        gen.scheduledDays.push(role.getScheduledDayById(g.scheduledDays[i3]));
                    }
                    gen.employees = [];
                    for (var i3 = 0; i3 < g.employees.length; i3++) {
                        gen.employees.push(this.getEmpById(g.employees[i3]));
                    }
                    role.generations.push(gen);
                    //
                    role.id = role2.id;
                    role.dayId = role2.dayId;
                    role.generationId = role2.generationId;
                }

                role.disabledDays = role2.disabledDays;
                role.shiftType = role2.shiftType;
                role.shiftDataId = role2.shiftDataId;
            }

            this.employeeId = tab.employeeId;
            this.roleId = tab.employeeId;
            this.lockedPast = tab.lockedPast;
            this.applyDB();
            if (tab.v != null && typeof tab.v == "string") {
                this.ui.changeRoleView(tab.v);
            } else if (tab.v == null && this.roles.length >= 0) {
                this.ui.changeRoleView(this.roles[0].name);
            }
            console.log("loaded");
        }
        //		
        //
        //
        //
    injectDB(dbemploys, dbshifts, dbrequiredshifts, dbsettings, dbcriteria, dbposition_ids, dbshift_ids) {
            this.dbemploys = dbemploys;
            this.dbshifts = dbshifts;
            this.dbrequiredshifts = dbrequiredshifts;
            this.dbsettings = dbsettings;
            this.dbcriteria = dbcriteria;
            this.dbposition_ids = dbposition_ids
            this.dbshift_ids = dbshift_ids
            this.applyDB();
        }
        //
    applyDB() {
            this.lockedPast = this.dbsettings.schedlock == 1 ? true : false;
            for (var i = 0; i < this.roles.length; i++) {
                var role = this.roles[i];
                role.dayoffSetting = this.dbsettings.dayoff;
				//
				role.disabledDays = [];
				for (var x=0;x<7;x++){
					role.disabledDays.push(Number(this.dbsettings.scheddayoff.substring(x,x+1)));
				}
				//
                var ii = null;
                //role.shifts = []; // ?
                for (var s = 0; s < role.shifts.length; s++) {
                    role.shifts[s].active = false;
                }
                //
                for (var i2 = 0; i2 < this.dbposition_ids.length; i2++) {
                    if (this.dbposition_ids[i2].name == role.name) {
                        ii = this.dbposition_ids[i2].id;
                        break;
                    }
                }
                for (var i2 = 0; i2 < this.dbrequiredshifts.length; i2++) {
                    var st = this.dbrequiredshifts[i2];
                    if (st.position_id == ii) {
                        var sh = null;
                        for (var i3 = 0; i3 < this.dbshift_ids.length; i3++) {
                            if (this.dbshift_ids[i3].id == st.shift_id) {
                                sh = this.dbshift_ids[i3];
                                break;
                            }
                        }
                        if (sh) {
                            console.log("lol");
                            role.addShift(sh.start.substring(0, 5), sh.end.substring(0, 5), st.min, st.max);
                        } else {
                            console.log("?? applydb shift unknown");
                        }
                    }
                }
			}
			for (var i=0;i<this.employees.length;i++){
				this.employees[i].active = false;
			}
            for (var index = 0; index < this.dbemploys.length; index++) {
                var trueEmp = this.dbemploys[index];
                var fnd = scheduler.getEmpByTrueId(trueEmp.id);
                var emp = fnd ? fnd : scheduler.addEmployee(trueEmp.firstname, trueEmp.lastname, trueEmp.position);
                emp.trueId = trueEmp.id;
                emp.fname = trueEmp.firstname;
                emp.lname = trueEmp.lastname;
				emp.role = trueEmp.position;
				emp.active = true;
                emp.preferredDayoff = trueEmp.preferred_dayoff != null ? trueEmp.preferred_dayoff.indexOf("1") : -1;
                emp.preferredShift = trueEmp.preferred_shift != null ? Number(trueEmp.preferred_shift) : -1;
                emp.preferredRest = trueEmp.preferred_rest != null ? trueEmp.preferred_rest : 8;
            }
        }
        //
    updateScheduleHistory() {
            for (var i = 0; i < this.roles.length; i++) {
                this.roles[i].updateScheduleHistory(this.currentDate.Year, this.currentDate.Month, this.currentDate.Date);
            }
        }
        //
    addEmployee(fname, lname, rool) {
            var emp = new Employee(this.employeeId);
            emp.fname = fname;
            emp.lname = lname;
            emp.role = rool;
            if (this.getRole(rool) == null) {
                this.addRole(rool);
            }
            this.employeeId = this.employeeId + 1;
            this.employees.push(emp);
            return emp;
        }
        //
    addRole(name) {
            /*if (slots<0) {
            	ScheduleManager.info("Role slots cannot be negative.");
            	return null;
            }*/
            for (var i = 0; i < this.roles.length; i++) {
                if (this.roles[i].name.toLowerCase() == name.toLowerCase()) {
                    ScheduleManager.info("There is already a role named '" + name + "'.");
                    return this.roles[i];
                }
            }
            var role = new Role();
            role.name = name;
            role.id = this.roleId;
            this.roleId = this.roleId + 1;
            this.roles.push(role);
            return role;
        }
        //
    getRole(name) {
            for (var i = 0; i < this.roles.length; i++) {
                if (this.roles[i].name.toLowerCase() == name.toLowerCase()) {
                    return this.roles[i];
                }
            }
            return null;
        }
        //
    loadScheduledDayFrame(from, times) {
            var times = times != null ? times : 1;
            for (var i = 0; i < this.roles.length; i++) {
                this.roles[i].loadScheduledDayFrame(from, times);
            }
        }
        //
    getEmpById(id) {
            for (var i = 0; i < this.employees.length; i++) {
                if (this.employees[i].id == id) {
                    return this.employees[i];
                }
            }
            return null;
        }
        //
    getEmpByTrueId(id) {
            for (var i = 0; i < this.employees.length; i++) {
                if (this.employees[i].trueId == id) {
                    return this.employees[i];
                }
            }
            return null;
        }
        //
}
//
class Employee {
    constructor(id) {
            this.id = id
            this.trueId = null;
            this.fname = null;
            this.lname = null;
            this.active = 1; //1 true 0 false
            this.role = null;
            this.timeAvoidance = [];
            this.assignments = []; // [0,0] roleid0 shiftid0
            this.Age = 0;
            this.Gender = null;
            this.criteriaPriority = 1; //
            this.preferredDayoff = -1; // 0-6
            this.preferredRest = 8;
            this.preferredShift = -1 //id
        }
        //
    assignShift(shift) {
            this.assignments.push([shift.dateWrap.roleId, shift.dateWrap.id, shift.id]);
        }
        //
    getTotalHoursWorked() {
            var hrs = 0;
            for (var i = this.assignments.length - 1; i >= 0; i--) {
                hrs = hrs + this.getShiftById(this.assignments[i][0], this.assignments[i][1], this.assignments[i][2]).Hours;
            }
            return hrs;
        }
        //
    get LNcFN() {
            return this.lname + ", " + this.fname;
        }
        //
    getShiftById(rId, dayId, shiftId) {
            var role = null;
            var sc = ScheduleManager.Instance;
            for (var i = 0; i < sc.roles.length; i++) {
                if (sc.roles[i].id == rId) {
                    role = sc.roles[i];
                    break;
                }
            }
            if (role == null) {
                console.log("role null error.");
                return null;
            }
            var day = null;
            for (var i = role.scheduledDays.length - 1; i >= 0; i--) {
                if (role.scheduledDays[i].id == dayId) {
                    day = role.scheduledDays[i];
                    break;
                }
            }
            if (day == null) {
                console.log("day null error.");
                return null;
            }
            var shift = null;
            for (var i = day.shifts.length - 1; i >= 0; i--) {
                if (day.shifts[i].id == shiftId) {
                    shift = day.shifts[i];
                    break;
                }
            }
            if (shift == null) {
                console.log("day null error.");
                return null;
            }
            return shift;
        }
        //
}
//
class DateCalc {
    constructor(d) {
        this.t = d != null ? d : 0;
    }
    static resetDay(t) {
        //return (new Date(t)).getTime();
        return (t - (t % 86400000));
    }
    static getTimeYMD(y, m, d) {
        return this.resetDay((new Date(y, m, d, 0, 0, 0, 0)).getTime());
    }
    static getDaysInMonth(y, m) {
        var isLeap = (y % 4 == 0) ? true : false;
        var ds = [31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31];
        var dd = ((isLeap && m == 1) ? 29 : ds[m]);
        return dd;
    }
    static isEndOfMonthYMD(y, m, d) {
        var days = DateCalc.getDaysInMonth(y, m);
        return (days == d) ? true : false;
    }
    static isPastMDY(m, d, y, tt) {
        var t = DateCalc.resetDay(tt ? tt : (new Date()).getTime());
        var day = DateCalc.getTimeYMD(y, m, d);
        return t > day ? -1 : (t < day ? 1 : 0);
    }
    setStartOfDay() {
        this.t = DateCalc.resetDay(this.t);
    }
    nextDay() {
        this.t = this.t + 86400000;
    }
    skipDays(i) {
        this.t = this.t + 86400000 * i;
    }
    nextWeek() {
        this.t = this.t + 86400000 * 7;
    }
    setToDate() {
        this.t = 0;
    }
    get FullDate() {
        var d = ((this.t != 0) ? (new Date(this.t)) : (new Date()));
        return d;
    }
    get Month() {
        return this.FullDate.getMonth();
    }
    get Date() {
        return this.FullDate.getDate();
    }
    get Day() {
        return this.FullDate.getDay();
    }
    get Year() {
        return this.FullDate.getFullYear();
    }
    get Hour() {
        return this.FullDate.getHours();
    }
    get Minutes() {
        return this.FullDate.getMinutes();
    }
    get Seconds() {
        return this.FullDate.getSeconds();
    }
    setDateMMDDYYYY(m, d, y) {
        this.t = DateCalc.getTimeYMD(y, m, d);
    }
    toArrayMMDDYYY() {
        return [this.Month, this.Date, this.Year, this.Day];
    }
    daysBetween(date) {
        var t2 = date.t;
        return (Math.abs(t2 - this.t) / 86400000);
    }
    getDateAfterDays(d) {
        return new DateCalc(this.t + d * 86400000);
    }
    get MMDDYYY() {
        return ScheduleManager.monthsName[this.Month] + " " + this.Date + ", " + this.Year + "<br>" + ScheduleManager.daysName[this.Day];
    }
}
//
class SchedGeneration {
    constructor(startDate, days, role) {
        this.id = 0;
        this.startDate = startDate
        this.days = days;
        this.role = role;
        this.locked = false;
        this.scheduledDays = [];
        this.employees = [];
        this.data = null;
    }
    init(emps, results) {
            var data = this.role.assignShifts(this.startDate, this.days, null, emps, results);
            this.data = data;
            if (!data.success) {
                console.log("the big sad");
                return data;
            }
            this.scheduledDays = data.scheduledDays;
            this.employees = data.employees;
            return data;
        }
        //
    revertAssign() {
            for (var i = 0; i < this.data.results.assigns.length; i++) {
                var emp = this.data.results.assigns[i].emp;
                var shift = this.data.results.assigns[i].shift;
                shift.deleteAssign(shift.assigned.indexOf(emp));
                //
            }
        }
        //
    reAssign() {
            for (var i = 0; i < this.data.results.assigns.length; i++) {
                var emp = this.data.results.assigns[i].emp;
                var shift = this.data.results.assigns[i].shift;
                this.role.assignEmp(emp, shift);
                //
            }
        }
        //
    getEmpShiftByDay(emp, d) {
            var sd = this.scheduledDays[d];
            var day = [];
            for (var s = 0; s < sd.shifts.length; s++) {
                var sh = sd.shifts[s];
                if (sh.assigned.indexOf(emp) >= 0) {
                    day.push(sh.nameString);
                }
            }
            return day;
        }
        //
    getEmpShifts(emp) {
            var days = [];
            for (var d = 0; d < this.scheduledDays.length; d++) {
                days.push(this.getEmpShiftByDay(emp, d));
            }
            return days;
        }
        //
    swapShift(emp1, emp2, d, ss1, ss2) {
            var shifts1 = ss1 ? ss1 : this.getEmpShifts(emp1);
            var shifts2 = ss2 ? ss2 : this.getEmpShifts(emp2);
            var sd = this.scheduledDays[d];
            var sh1 = shifts1;
            var sh2 = shifts2;
            var e1 = emp1;
            var e2 = emp2;
            for (var x = 0; x < 2; x++) {
                if (x == 1) {
                    sh1 = shifts2;
                    sh2 = shifts1;
                    e1 = emp2;
                    e2 = emp1;
                }
                for (var s = 0; s < sh1[d].length; s++) {
                    var sh = sd.getShiftByString(sh1[d][s]);
                    sh.deleteAssign(sh.assigned.indexOf(e1));
                }
                for (var s = 0; s < sh2[d].length; s++) {
                    var sh = sd.getShiftByString(sh2[d][s]);
                    sh.assignEmp(e1);
                    e1.assignShift(sh);
                }
            }
        }
        //
    swapSchedGeneration(emp1, emp2) {
            var shifts1 = this.getEmpShifts(emp1);
            var shifts2 = this.getEmpShifts(emp2);
            for (var d = 0; d < this.scheduledDays.length; d++) {
                this.swapShift(emp1, emp2, d, shifts1, shifts2);
            }
        }
        //
    findScheduleYMD(yy, mm, dd, schedules) {
        var schedules = this.scheduledDays;
        //var d = (new DateCalc(DateCalc.getTimeYMD(yy,mm,dd)+86400000)).toArrayMMDDYYY();
        for (var i = 0; i < schedules.length; i++) {
            if (schedules[i].month == mm && schedules[i].date == dd && schedules[i].year == yy) {
                return schedules[i];
            }
        }
        return null;
    }
}
//
class Role {
    constructor() {
            this.id = 0;
            this.dayId = 0;
            this.generationId = 1;
            this.shiftDataId = 0;
            this.name = null;
            this.shifts = [];
            this.scheduledDays = [];
            this.disabledDays = []; // eg. if [0], there will be 0 allocations on sundays
            this.generations = [];
            this.shiftType = "Normal"; //
            this.shuffleGenerate = 0; // untouched
            this.criteriaGenerate = 0; //untouhced
            this.criteriaLikely = 0.5;
            this.dayoffSetting = 1; // 0 off 1 on    DB
            this.maxdayoff = 1; // DB
            this.defaultHrsDist = 8;
            this.ptScoring = {
                priop: 1.25, // percent 
                prio: 0.5, // plus
                dayoff: 10, // points
                shift: 3, // points
                rest: 0.25 // points?
            };
        }
        //
    loadResultArray(shiftsUsed, totalShiftsMin, totalShiftsMax, ptneed) {
            return {
                missing: [],
                assigns: [],
                scheduledDays: null,
                employees: [],
                success: true,
                badshifts: 0,
                okshifts: 0,
                points: 0,
                pointsneed: 0,
                hitdayoff: 0,
                hitshift: 0,
                hitrest: 0,
                pointsneed: ptneed,
                hitdayoffs: [],
                hitshifts: [],
                missshifts: [],
                shiftsUsed: shiftsUsed,
                totalShiftsMin: totalShiftsMin,
                totalShiftsMax: totalShiftsMax
            };
        }
        //
    generate(startDate, days, oldVal) { // y,m,d
            var reps = this.shuffleGenerate == 1 ? 2048 * 1 : 1;
            var minBad = 99999;
            var points = 0;
            var results = null;
            var emps = this.findEmployees();
            var gen = new SchedGeneration(startDate, days, this);
            if (this.criteriaGenerate == 1) {
                this.sortCriteria(emps);
                this.shiftsPrefer(emps, this);
            }
            // = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = =
            var dayOffs = 1;
            var shiftDays = days - dayOffs;
            var shiftsUsed = shiftDays * emps.length;
            var totalShifts = this.getTotalShiftMinMax();
            var totalShiftsMin = totalShifts.min * days;
            var totalShiftsMax = totalShifts.max * days;
            var pointsNeeded = this.getPointsNeed(emps, shiftDays, dayOffs);
            var results = this.loadResultArray(shiftsUsed, totalShiftsMin, totalShiftsMax, pointsNeeded);
            if (totalShiftsMin == 0 && totalShiftsMax == 0) {
                console.log("zero !!");
                var res = {
                    scheduledDays: null,
                    employees: emps,
                    results: results,
                    success: results.success,
                    msg: "There are no shifts.<br>Go to Scheduler Settings to add shifts."
                };
                console.log(res);
                return res;
            }
            if (results.shiftsUsed > totalShiftsMax) {
                if (!confirm("Some shifts exceed maximum number of required employees.\nBypass this constraint? (Not recommended)")) {
                    results.success = false;
                    console.log("max !!");
                    return {
                        scheduledDays: null,
                        employees: emps,
                        results: results,
                        success: results.success,
                        msg: "Failed<br>Exceeded Max Shift Slots<br>Min: " + results.totalShiftsMin + " Max: " + results.totalShiftsMax +
                            "\nUsed:" + results.shiftsUsed + "<br>Add more shift slots(max) to solve this issue."
                    };
                }
            } else if (results.shiftsUsed < totalShiftsMin) {
                if (!confirm("Some shifts do not meet minimum number of required employees.\nBypass this constraint? (Only recommended for high positions)")) {
                    results.success = false;
                    console.log("min !!");
                    var res = {
                        scheduledDays: null,
                        employees: emps,
                        results: results,
                        success: results.success,
                        msg: "Failed<br>Exceeded Min Shift Slots<br>Min: " + results.totalShiftsMin + " Max: " + results.totalShiftsMax +
                            "\nUsed:" + results.shiftsUsed + "<br>Lessen shift slots(min) to solve this issue."
                    };
                    console.log(res);
                    return res;
                }
            }
            // = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = =
            var tic = (new Date()).getTime();
            var i = 0;
            //
            for (i = 0; i < reps; i++) {
                tic++;
                var resultsx = this.loadResultArray(shiftsUsed, totalShiftsMin, totalShiftsMax, pointsNeeded);
                Math.seedrandom("" + tic);
                gen.id = this.generationId;
                var results2 = gen.init(emps, resultsx);
                gen.revertAssign();
                if (minBad > 0 && minBad > results2.results.badshifts) {
                    results = results2;
                    minBad = results.results.badshifts;
                    points = results.results.points;
                }
                if (minBad == 0 && this.criteriaGenerate == 1 && results2.results.badshifts == 0 && results2.results.points > points) {
                    results = results2;
                    points = results.results.points;
                }
                if (minBad == 0) {
                    //console.log("["+i+"] score : "+points+" / "+(results.results.pointsneed)+" "+Math.floor(points/results.results.pointsneed*100)+"% ("+results2.results.points+")");
                    if (this.criteriaGenerate != 1 || points >= results.results.pointsneed * 1) {
                        console.log("BREEKKK " + points + "/" + results.results.pointsneed);
                        break;
                    }
                }
            }
            gen.data = results;
            gen.reAssign();
            if (results.success) {
                this.generationId = this.generationId + 1;
                console.log("repets " + i + " / " + reps);
                console.log("THE BADSHIFTS : " + minBad)
                if (this.criteriaGenerate == 1) {
                    console.log("Percent : " + Math.floor(points / results.results.pointsneed * 100) + "%");
                }
                console.log(gen.data.results);
                this.generations.push(gen);
            }
            return results;
        }
        //
    setdayoffpre() {
            var emps = ScheduleManager.Instance.employees;
            var n = 1;
            for (var i = 0; i < emps.length; i++) {
                if (emps[i].role == this.name) {
                    emps[i].preferredDayoff = n;
                    n++;
                    if (n == 7) {
                        n = 0;
                    }
                }
            }
        }
        //
    setdayoffpre2(n) {
            var emps = ScheduleManager.Instance.employees;
            for (var i = 0; i < emps.length; i++) {
                if (emps[i].role == this.name) {
                    emps[i].preferredDayoff = n;
                }
            }
        }
        //
    shiftsPrefer(emps, role) {
            for (var i = 0; i < emps.length; i++) {
                role.preferredShiftTranslate(emps[i], role);
            }
        }
		//
	getDayoffSingle(){
		for (var i=0;i<7;i++){
			if (this.disabledDays[i]==1){
				return i;
			}
		}
		return null;
	}
    sortCriteria(emps) {
            var criteria = ScheduleManager.Instance.dbcriteria;
            if (criteria.age == 0 && criteria.gender == 0 && criteria.name == 0) {
                return;
            }
            emps.sort(function(a, b) {
                var age = null;
                if (criteria.age == 1) {
                    if (a.Age == null && b.Age == null) {
                        age = 0;
                    } else if (a.Age == null) {
                        age = 1;
                    } else if (b.Age == null) {
                        age = -1;
                    } else if ((a.Age >= criteria.age_value && b.Age >= criteria.age_value) || (a.Age < criteria.age_value && b.Age < criteria.age_value)) {
                        age = (criteria.gender == 0 && criteria.name == 0) ? ((a.Age < b.Age) ? 1 : ((a.Age > b.Age) ? -1 : 0)) : 0;
                    } else {
                        age = (b.Age >= criteria.age_value) ? 1 : ((a.Age >= criteria.age_value) ? -1 : 0);
                    }
                }

                var gender = null;
                var gender1 = criteria.gender_value == 0 ? "Female" : "Male"
                var gender2 = criteria.gender_value == 1 ? "Female" : "Male"
                if (criteria.gender == 1) {
                    if (a.Gender == null && b.Gender == null) {
                        gender = 0;
                    } else if (a.Gender == null) {
                        gender = 1;
                    } else if (b.Gender == null) {
                        gender = -1;
                    } else {
                        gender = (a.Gender == gender1 && b.Gender == gender2) ? 1 : ((a.Gender == gender2 && b.Gender == gender1) ? -1 : 0);
                    }
                }

                var name = null;
                var nameI = criteria.name_value == 0 ? "fname" : "lname";
                if (criteria.name == 1) {
                    name = (a[nameI].toLowerCase() > b[nameI].toLowerCase()) ? 1 : ((a[nameI].toLowerCase() < b[nameI].toLowerCase()) ? -1 : 0);
                }

                if (age == 1 || age == -1) {
                    return age;
                } else {
                    if (gender == 1 || gender == -1) {
                        return gender;
                    } else {
                        if (name == 1 || name == -1) {
                            return name;
                        } else {
                            return 0;
                        }
                    }
                }
            });
            for (var i = 0; i < emps.length; i++) {
                emps[i].criteriaPriority = emps.length - i - 1;
            }
            //emps.sort(function(a,b){ return (a.criteriaPriority ) });
            return emps;
        }
        //
    getShiftByString(str) {
            for (var i = 0; i < this.shifts.length; i++) {
                if (this.shifts[i].nameString == str) {
                    return this.shifts[i];
                }
            }
            return null;
        }
        //
    getGenerationGroupYMD(yy, mm, dd) {
            for (var g = 0; g < this.generations.length; g++) {
                var found = this.generations[g].findScheduleYMD(yy, mm, dd);
                if (found) {
                    return this.generations[g];
                }
            }
            return null;
        }
        //
    CloneSchedule(y, m, d, nd, ogen) {
            var scheduledDays = ogen.scheduledDays;
            var days = scheduledDays.length;
            /*
            this.scheduledDays=null;
            */
            var startDateT = DateCalc.getTimeYMD(y, m, d) + 86400000;
            var dist = startDateT - DateCalc.getTimeYMD(scheduledDays[0].year, scheduledDays[0].month, scheduledDays[0].date);
            var gen = new SchedGeneration([m, d, y, nd], days, this);
            gen.scheduledDays = [];
            gen.id = this.generationId;
            this.generationId = this.generationId + 1;
            this.generations.push(gen);
            for (var e = 0; e < ogen.employees.length; e++) {
                gen.employees.push(ogen.employees[e]);
            }
            for (var ii = 0; ii < scheduledDays.length; ii++) {
                var osD = scheduledDays[ii];
                var newdate = new DateCalc(DateCalc.getTimeYMD(osD.year, osD.month, osD.date) + dist);
                var sD = new ScheduledDay(this, newdate.Month, newdate.Date, newdate.Year, newdate.Day);
                for (var s = 0; s < osD.shifts.length; s++) {
                    var osh = osD.shifts[s];
                    var sh = new Shift(sD, osh.shift);
                    sD.shifts.push(sh);
                    for (var i = 0; i < osh.assigned.length; i++) {
                        this.assignEmp(osh.assigned[i], sh);
                    }
                }
                this.scheduledDays.push(sD);
                gen.scheduledDays.push(sD);
            }
            /*
            var date = new DateCalc(fromT);
            date.setStartOfDay();
            for (var i=0;i<days;i++){
            	this.deleteScheduledDay(date.t);
            	var day = new ScheduledDay(this,date.Month,date.Date,date.Year,date.Day);
            	for (var s=0;s<this.shifts.length;s++){
            		var shift = new Shift(day,this.shifts[s]);
            		day.shifts.push(shift);
            	}
            	this.scheduledDays.push(day);
            	if (days==1){
            		singleDay = day;
            	}
            	date.nextDay();
            }
            return singleDay;
            */
            console.log(ogen);
        }
        //
    DeleteGeneration(gen) {
            //console.log("gl",this.generations.length);
            //console.log("sdl",this.scheduledDays.length);
            for (var i = 0; i < gen.scheduledDays.length; i++) {
                var sD = gen.scheduledDays[i];
                for (var i2 = 0; i2 < sD.shifts.length; i2++) {
                    var sh = sD.shifts[i2];
                    while (sh.assigned.length > 0) {
                        sh.deleteAssign(0);
                    }
                }
                this.scheduledDays.splice(this.scheduledDays.indexOf(sD), 1);
            }
            this.generations.splice(this.generations.indexOf(gen), 1);
            //console.log("gl2",this.generations.length);
            //console.log("sdl2",this.scheduledDays.length);
        }
        //
    getStartToEndAMPM(start, end) {
            var sth = Number(start.substring(0, 2));
            var stm = Number(start.substring(3, 5));
            var enh = Number(end.substring(0, 2));
            var enm = Number(end.substring(3, 5));
            var st1 = (sth < 13 ? sth : sth - 12);
            var en1 = (enh < 13 ? enh : enh - 12);
            var st = (st1 == 0 ? 12 : st1) + (stm == 0 ? "" : (":" + (stm < 10 ? "0" : "") + stm)) + "" + (sth < 12 ? "AM" : "PM");
            var en = (en1 == 0 ? 12 : en1) + (enm == 0 ? "" : (":" + (enm < 10 ? "0" : "") + enm)) + "" + (enh < 12 ? "AM" : "PM");
            return st + " - " + en;
        }
        //
    getShiftDataById(id) {
            for (var i = 0; i < this.shifts.length; i++) {
                if (this.shifts[i].id == id) {
                    return this.shifts[i];
                }
            }
        }
        //
    getTable(from, to) {
            var emps = this.findEmployees(from, to,true);
            var date = new DateCalc();
            date.setDateMMDDYYYY(from[0], from[1], from[2]);
            var date2 = new DateCalc();
            date2.setDateMMDDYYYY(to[0], to[1], to[2]);
            var ds = date.daysBetween(date2);
            var days = [];
            for (var d = 0; d < ds; d++) {
                var exist = false;
                for (var s = this.scheduledDays.length - 1; s >= 0; s--) {
                    if (this.scheduledDays[s].getTime() == date.t) {
                        exist = true;
                        days.push(this.scheduledDays[s]);
                        break;
                    }
                }
                date.nextDay();
                if (!exist) {
                    days.push({ notexist: true, month: date.Month, date: date.Date, year: date.Year, day: date.Day, dayN: date.Day, mmddyyy: date.MMDDYYY });
                }
            }
            var tab = [];
            for (var e = 0; e < emps.length; e++) {
                var emp = emps[e];
                var empSched = [];
                for (var d = 0; d < ds; d++) {
                    empSched.push(this.isEmpAssignedInThisDay(emp, days[d])); //days[d]);
                }
                tab.push(empSched);
            }
            return { rows: emps, columns: days, data: tab };
        }
        //
    isEmpAssignedInThisDay(emp, dateWrap) {
            var assigns = [];
            if (dateWrap == 0) {
                return assigns;
            }
            //this.assignments.push([shift.dateWrap.roleId,shift.dateWrap.id,shift.id]);
            for (var i = emp.assignments.length - 1; i >= 0; i--) {
                var as = emp.assignments[i];
                if (as[0] == dateWrap.roleId && as[1] == dateWrap.id) {
                    assigns.push([as[0], as[1], as[2]]);
                }
            }
            return assigns;
        }
        //
    getScheduledDayById(dayId) {
            for (var i = this.scheduledDays.length - 1; i >= 0; i--) {
                var day = this.scheduledDays[i];
                if (day.id == dayId) {
                    return day;
                }
            }
        }
        //
    getShiftById(dayId, shiftId) {
            for (var i = this.scheduledDays.length - 1; i >= 0; i--) {
                var day = this.scheduledDays[i];
                if (day.id == dayId) {
                    for (var s = 0; s < day.shifts.length; s++) {
                        if (day.shifts[s].id == shiftId) {
                            return day.shifts[s];
                        }
                    }
                }
            }
            return null;
        }
        //   1        31
        //        27     34
    empHasShift(e, from, to) {
            if (!from || !to) {
                return false;
            }
            var date1 = new DateCalc();
            date1.setDateMMDDYYYY(from[0], from[1], from[2]);
            var date2 = new DateCalc();
            date2.setDateMMDDYYYY(to[0], to[1], to[2]);
            var date = new DateCalc();
            for (var i = 0; i < this.scheduledDays.length; i++) {
                var sd = this.scheduledDays[i];
                date.setDateMMDDYYYY(sd.month, sd.date, sd.year);
                if (date1.t <= date.t && date2.t >= date.t && sd.findEmpShift(e) >= 0) {
                    return true;
                }
            }
        }
        //
    findEmployees(from, to, evenInactive) {
            var emps = ScheduleManager.Instance.employees;
            var picks = [];
            for (var i = 0; i < emps.length; i++) {
                var e = emps[i];
                if ((e.active || (evenInactive && this.empHasShift(e, from, to))) && ((e.role && e.role.toLowerCase() == this.name.toLowerCase()) || this.empHasShift(e, from, to))) {
                    picks.push(e);
                }
            }
            //picks.sort(function(a,b) {return (a.pxreferenceLevel < b.pxreferenceLevel) ? 1 : ((b.pxreferenceLevel < a.pxreferenceLevel) ? -1 : 0);} ); 
            return picks;
        }
        //
    findScheduleYMD(yy, mm, dd, schedules, ex) {
            var schedules = this.scheduledDays;
            var d = (new DateCalc(DateCalc.getTimeYMD(yy, mm, dd) + 86400000 + 86400000 * (ex != null ? ex : 0))).toArrayMMDDYYY();
            for (var i = 0; i < schedules.length; i++) {
                if (schedules[i].month == d[0] && schedules[i].date == d[1] && schedules[i].year == d[2]) {
                    return schedules[i];
                }
            }
            return null;
        }
        //
    isScheduleClear(yy, mm, dd, days) {
            var schedules = this.scheduledDays;
            for (var da = 0; da < days; da++) {
                var sc = this.findScheduleYMD(yy, mm, dd, schedules, da);
                if (sc) { return sc; }
            }
            return null;
        }
        //
    getMinDayArray(arr) {
            var n = arr[0];
            var ii = 0;
            var iis = [0];
            for (var i = 1; i < arr.length; i++) {
                if (n > arr[i]) {
                    iis = [i];
                    n = arr[i];
                    ii = i;
                } else if (n == arr[i]) {
                    iis.push(i);
                }
            }
            var ix = Math.floor(Math.random() * iis.length)
            ii = iis[ix];
            return ii;
        }
        //
    getMinDayoff(arr) {
            var n = null;
            var ii = -1;
            var iis = null;
            for (var i = 0; i < arr.length; i++) {
                if (!this.disabledDays.includes(i)) {
                    if (ii == -1) {
                        n = arr[i];
                        ii = i;
                        iis = [i];
                    } else {
                        if (n > arr[i]) {
                            iis = [i];
                            n = arr[i];
                            ii = i;
                        } else if (n == arr[i]) {
                            iis.push(i);
                        }
                    }
                }
            }
            if (iis.length > 0) {
                var ix = Math.floor(Math.random() * iis.length)
                ii = iis[ix];
                return ii;
            } else {
                console.log("cant find min day off, expect error");
                return -1;
            }
        }
        //
    assignShifts(mdy, ds, dos, emps, results) {
            var yy = mdy[2];
            var mm = mdy[0];
            var dd = mdy[1];
            var days = ds;
            var schedules = [];
            var freshDays = [];
            var dt = DateCalc.getTimeYMD(yy, mm, dd);
            var dateStart = new DateCalc(dt);
            //
            results.schedules = schedules;
            //

            //Get Scheduled Days
            var sdays = this.scheduledDays.length - 1
            for (var ii = 0; ii < days; ii++) {
                var found = false;
                for (var d = sdays; d >= 0; d--) {
                    var day = this.scheduledDays[d];
                    if (day.getTime() == dateStart.t) {
                        schedules.push(day);
                        found = true;
                        break;
                    }
                }
                dateStart.nextDay();
                if (!found) {
                    var newDay = this.loadScheduledDayFrame(dateStart.t, 1, 1);
                    schedules.push(newDay);
                    freshDays.push(newDay);
                }
            }
            for (var i = 0; i < schedules.length; i++) {
                this.setScheduledDayDefaultShifts(schedules[i]);
            }
            //
            if (this.shiftType == "Normal") {
                this.fillShiftsNormal(emps, days, schedules, results);
            }
            //
            return { scheduledDays: schedules, employees: emps, results: results, success: results.success };
        }
        //
    getPointsNeed(emps, workingDays, dayOffs) {
            var pts = 0;
            var ptScoring = this.ptScoring;
            for (var i = 0; i < emps.length; i++) {
                var e = emps[i];
                var pri = ptScoring.prio + (e.criteriaPriority * ptScoring.priop)
                pts += ptScoring.dayoff * pri * dayOffs;
                pts += ptScoring.shift * pri * workingDays;
                pts += ptScoring.rest * pri * workingDays;
            }
            return pts;
        }
        //
    getTotalShiftMinMax() {
            var mi = 0;
            var ma = 0;
            for (var i = 0; i < this.shifts.length; i++) {
                if (this.shifts[i].active) {
                    mi = mi + this.shifts[i].defaultMinAssign;
                    ma = ma + this.shifts[i].defaultMaxAssign;
                }
            }
            return { min: mi, max: ma };
        }
        //
    SortAccording(emps, sd) {
            var ems = [];
            for (var i = sd.shifts.length - 1; i >= 0; i--) {
                for (var a = 0; a < sd.shifts[i].assigned.length; a++) {
                    var emp = sd.shifts[i].assigned[a];
                    if (ems.indexOf(emp) == -1 && emps.indexOf(emp) != -1) {
                        ems.push(emp);
                    }
                }
            }
            //fill missing
            for (var i = 0; i < emps.length; i++) {
                if (ems.indexOf(emps[i]) == -1) {
                    ems.push(emps[i]);
                }
            }
            //console.log(ems);
            //console.log("REEEEEEEEEEEEE "+ems[0].fname,ems.length);
            return ems;
        }
        //
    fillShiftsNormal(emps, days, schedules, results) {
            //
            var ptScoring = this.ptScoring;
            var oemps = emps.slice(0);
            //assign employees to shifts
            var dayoffs = [0, 0, 0, 0, 0, 0, 0];
            var maxdayoff = Math.floor((emps.length + 6) / 7); // this.maxdayoff
            //
            //
            for (var i = 0; i < emps.length; i++) {
				var emp = emps[i];
				var dayoffSingle = this.getDayoffSingle();
				if (dayoffSingle != null){
					emp.dayoffPickTemp = dayoffSingle;
					dayoffs[emp.dayoffPickTemp]++;	
					// dayoff pts 1
					results.points += ptScoring.dayoff * (ptScoring.prio + (emp.criteriaPriority * ptScoring.priop));
					results.hitdayoff++;
					results.hitdayoffs.push(emp.fname);
				}
				else{
					if ((this.criteriaGenerate != 1 || Math.random() >= this.criteriaLikely) && emp.preferredDayoff != null && emp.preferredDayoff >= 0 &&
						dayoffs[emp.preferredDayoff] < maxdayoff && this.dayoffSetting == 1) { // && !this.disabledDays.includes(emp.preferredDayoff)
						emp.dayoffPickTemp = emp.preferredDayoff;
						dayoffs[emp.dayoffPickTemp]++;
						if (this.criteriaGenerate == 1) {
							// dayoff pts 2
							results.points += ptScoring.dayoff * (ptScoring.prio + (emp.criteriaPriority * ptScoring.priop));
							results.hitdayoff++;
							results.hitdayoffs.push(emp.fname + " -a" + emp.dayoffPickTemp);
						}
					} else {
						emp.dayoffPickTemp = this.getMinDayoff(dayoffs);
						//console.log("failed to satisfy "+emp.fname+" "+emp.lname+"'s "+emp.preferredDayoff+" dayoff. changed to "+emp.dayoffPickTemp);
						if (this.criteriaGenerate == 1 && (emp.preferredDayoff == -1 || emp.dayoffPickTemp == emp.preferredDayoff)) {
							// dayoff pts 3
							results.points += ptScoring.dayoff * (ptScoring.prio + (emp.criteriaPriority * ptScoring.priop));
							results.hitdayoff++;
							results.hitdayoffs.push(emp.fname);
						}
						dayoffs[emp.dayoffPickTemp]++;
					}
				}
            }
            //
            for (var d = 0; d < days; d++) {
                //
                var scheduledDay = schedules[d];
                var theDay = scheduledDay.dayN;
                var scheduleYesterday = scheduledDay.nextDays(-1, this.scheduledDays);
                var shiftY = null;
                if (this.shuffleGenerate != 1) {
                    if (scheduleYesterday) {
                        //console.log("Date : "+scheduledDay.date);
                        emps = this.SortAccording(oemps, scheduleYesterday);
                    } else {
                        emps = oemps.slice(0);
                    }
                }
                if (this.shuffleGenerate == 1) {
                    if (this.criteriaGenerate == 1 && Math.random() > this.criteriaLikely) {
                        emps.sort(function(a, b) { return (a.criteriaPriority < b.criteriaPriority) ? 1 : ((a.criteriaPriority > b.criteriaPriority) ? -1 : 0) });
                    } else {
                        emps = this.shuffleArray(emps);
                    }
                }
                //
                for (var i = 0; i < emps.length; i++) {
                    var emp = emps[i];
                    var dayoff = emp.dayoffPickTemp;
                    //
                    if (scheduleYesterday) {
                        var shiftIY = scheduleYesterday.findEmpShift(emp);
                        shiftY = shiftIY >= 0 ? scheduleYesterday.shifts[shiftIY] : null;
                    }
                    var fixrest = true;
                    if (dayoff != theDay) { // !this.disabledDays.includes(theDay) && 
                        var shiftI = this.getBestShiftSlot(scheduledDay.shifts, fixrest != null ? shiftY : null, d, emp, results, i);
                        if (shiftI == null) {
                            //console.log(emp.fname+" NO MORE VACANCY "+ScheduleManager.daysName[theDay]);
                            results.missing.push({ emp: emp, scheduledDay: scheduledDay });
                        } else {
                            var shift = scheduledDay.shifts[shiftI];
                            if (this.criteriaGenerate == 1) {
                                var preferred = this.isPreferredShift(emp.preferredShift, shift);
                                if (emp.preferredShift == -1 || preferred) {
                                    results.points += ptScoring.shift * (ptScoring.prio + (emp.criteriaPriority * ptScoring.priop))
                                    results.hitshift++;
                                }
                                if (preferred) {
                                    results.hitshifts.push(emp.fname + " " + shiftI + " " + ScheduleManager.daysName[theDay]);
                                } else {
                                    results.missshifts.push(emp.fname + " " + shiftI + " " + ScheduleManager.daysName[theDay]);
                                }
                            }
                            this.assignEmp(emp, shift);
                            //console.log(emps[i].fname,":",shift.StartToEndAMPM,"   before:",shiftY?shiftY.StartToEndAMPM:"?");
                            results.assigns.push({ emp: emp, shift: shift })
                        }
                    }
                    if (this.disabledDays.includes(theDay) || dayoff == theDay) {
                        //console.log(emp.fname+"'s Day Off : "+ScheduleManager.daysName[theDay]);
                    }
                }
            }
        }
        //
    isPreferredShift(id, shift) {
            var str = null;
            var s = ScheduleManager.Instance.dbshifts;
            for (var i = 0; i < s.length; i++) {
                if (s[i].id == id) {
                    str = s[i].start.substring(0, 5) + s[i].end.substring(0, 5);
                    return (str == (shift.start + shift.end));
                    break;
                }
            }
        }
        //
    preferredShiftTranslate(emp, role) {
            var role = this;
            var id = emp.preferredShift;
            if (id == -1) {
                emp.tempPreferredShift = -1;
                return;
            }
            var s = ScheduleManager.Instance.dbshifts;
            for (var i = 0; i < s.length; i++) {
                if (s[i].id == id) {
                    var shiftD = role.getShiftByString(s[i].start.substring(0, 5) + s[i].end.substring(0, 5));
                    emp.tempPreferredShift = role.shifts.indexOf(shiftD); // could be bugged if custom shift from shiftData
                    break;
                }
            }
        }
        //
    getBestShiftSlot(shifts, shiftY, d, emp, results, empI) {
            var ss = [];
            var minAssign = 10000000;
            var ptScoring = this.ptScoring;
            for (var r = 0; r < 2; r++) { //first with min , second with none
                if (r == 0) {
                    for (var i = 0; i < shifts.length; i++) {
                        if (shifts[i].assigned.length < minAssign && shifts[i].assigned.length < shifts[i].maxAssign) {
                            minAssign = shifts[i].assigned.length;
                        }
                    }
                }
                for (var i = 0; i < shifts.length; i++) {
                    if (shifts[i].assigned.length <= minAssign && shifts[i].assigned.length < shifts[i].maxAssign) {
                        ss.push({ i: i, shift: shifts[i] })
                    }
                }
                ss.sort(function(a, b) { return (a.shift.assigned.length > b.shift.assigned.length) ? 1 : ((b.shift.assigned.length > a.shift.assigned.length) ? -1 : 0); });
                var choose = 0;
                var chosens = [];
                if (shiftY) {
                    for (var i = 0; i < ss.length; i++) {
                        var sh = ss[i].shift;
                        var dist = sh.HoursBetweenShift(shiftY);
                        if (sh.assigned.length < sh.maxAssign && (dist >= emp.preferredRest || dist >= this.defaultHrsDist)) { //emp.shiftDistHrs){
                            chosens.push({ i: i, dist: dist });
                        }
                    }
                    chosens.sort(function(a, b) { return (a.dist > b.dist) ? 1 : ((b.dist > a.dist) ? -1 : 0); });
                    var ii = 0; //Math.floor((chosens.length)/2);
                    if (this.criteriaGenerate == 1 && emp.tempPreferredShift != -1 && Math.random() > this.criteriaLikely) {
                        for (var i = 0; i < chosens.length; i++) {
                            if (emp.tempPreferredShift == chosens[i].i) {
                                ii = i; // lol
                                break;
                            }
                        }
                    }
                    if (chosens.length == 0 && r == 1) {
                        results.badshifts++;
                    }
                    /*
                    console.log("--- ")
                    console.log("ss : ",ss);
                    console.log("chosens : ",chosens);
                    console.log("dist("+ss.length+">"+chosens.length+")","["+empI+"]"+emp.fname,(chosens[ii]!=null)?chosens[ii].dist:"empty");
                    */
                    if (chosens[ii] != null) {
                        results.okshifts++;
                        choose = chosens[ii].i;
                        if (this.criteriaGenerate == 1 && (emp.preferredRest <= chosens[ii].dist)) {
                            results.points += ptScoring.rest * (ptScoring.prio + (emp.criteriaPriority * ptScoring.priop));
                            results.hitrest++;
                        }
                    } else {
                        minAssign = 10000000;
                        continue; // try again with no min target
                    }
                } else {
                    results.okshifts++;
                    if (this.criteriaGenerate == 1) {
                        results.points += ptScoring.rest * (ptScoring.prio + (emp.criteriaPriority * ptScoring.priop));
                        results.hitrest++;
                    }
                }
                if (ss[choose] == null) {
                    return null; // totally nothing
                }
                return ss[choose].i;
            }
        }
        //
    getAvailableShift(shifts) {
            for (var i = 0; i < shifts.length; i++) {
                if (shifts[i].hasVacant()) {
                    return i;
                }
            }
            return -1;
        }
        //
    shuffleArray(array) {
            var currentIndex = array.length,
                temporaryValue, randomIndex;

            // While there remain elements to shuffle...
            while (0 !== currentIndex) {

                // Pick a remaining element...
                randomIndex = Math.floor(Math.random() * currentIndex);
                currentIndex -= 1;

                // And swap it with the current element.
                temporaryValue = array[currentIndex];
                array[currentIndex] = array[randomIndex];
                array[randomIndex] = temporaryValue;
            }

            return array;
        }
        //
    assignEmp(emp, shift) {
            //this.assignments = []; // [0,0] roleid0 shiftid0
            shift.assignEmp(emp);
            emp.assignShift(shift);
        }
        //
    loadScheduledDayFrame(fromT, times, oneday) { // load empty shift sched
            var times = times != null ? times : 1;
            //test 1 week worth
            var days = 0;
            if (oneday) {
                days = 1;
            }
            var singleDay = null;
            var date = new DateCalc(fromT);
            date.setStartOfDay();
            for (var i = 0; i < days; i++) {
                this.deleteScheduledDay(date.t);
                var day = new ScheduledDay(this, date.Month, date.Date, date.Year, date.Day);
                this.scheduledDays.push(day);
                if (days == 1) {
                    singleDay = day;
                }
                date.nextDay();
            }
            return singleDay;
        }
        //
    setScheduledDayDefaultShifts(day) {
            for (var s = 0; s < this.shifts.length; s++) {
                if (this.shifts[s].active && !day.shiftExists(this.shifts[s])) {
                    var shift = new Shift(day, this.shifts[s]);
                    day.shifts.push(shift);
                }
            }
        }
        //
    deleteScheduledDay(t) {
            for (var d = this.scheduledDays.length - 1; d >= 0; d--) {
                if (this.scheduledDays[d].getTime() + 86400000 == t) {
                    this.scheduledDays.splice(d, 1);
                    break;
                }
            }
        }
        //
    getDailySchedule(d) {
            var d = d != null ? d : 0;
            /*
            if ((d+1)*this.shifts.length > this.schedules.length){
            	ScheduleManager.info("Daily schedule not yet loaded.");
            }*/
            var date = new DateCalc(scheduler.currentDate.t);
            date.skipDays(d);
            var yyyy = date.Year;
            var mm = date.Month;
            var dd = date.Date;
            var scheds = [];
            for (var i = this.scheduledDays.length - 1; i >= 0; i--) {
                var day = this.scheduledDays[i];
                if (day.year == yyyy && day.month == mm && day.date == dd) {
                    return day;
                }
            }
        }
        //
    findDailyScheduleYMD(y, m, d) {
            for (var i = this.scheduledDays.length - 1; i >= 0; i--) {
                var day = this.scheduledDays[i];
                if (day.year == y && day.month == m && day.date == d) {
                    return day;
                }
            }
            return null;
        }
        //
    disableDay(d) {
            if (!this.disabledDays.includes(d)) {
                this.disabledDays.push(d);
                ScheduleManager.info("Disabled " + ScheduleManager.daysName[d] + " on " + this.name + ".");
            }
        }
        //
    addShift(start, end, min, max) {
            if (start.length != 5 || end.length != 5) {
                ScheduleManager.info("Format mismatch.");
                return;
            }
            var s1 = Number(start.substring(0, 2));
            var s2 = Number(start.substring(3, 5));
            var e1 = Number(end.substring(0, 2));
            var e2 = Number(end.substring(3, 5));
            if (s1 > 24 || e1 > 24 || s2 > 60 || e2 > 60) {
                ScheduleManager.info("Format mismatch.");
                return;
            }
            for (var i = 0; i < this.shifts.length; i++) {
                var st = this.shifts[i];
                if (st.start == start && st.end == end) {
                    //console.log("shift copy detected");
                    if (min && max) {
                        st.defaultMinAssign = min;
                        st.defaultMaxAssign = max;
                        st.active = true;
                    }
                    return;
                }
            }
            /*
            // OVERLAP FEATURE ??
            for (var i=0;i<this.shifts.length;i++) {
            	var s1b = Number(this.shifts[i].start.substring(0,2));
            	var s2b = Number(this.shifts[i].start.substring(3,5));
            	var e1b = Number(this.shifts[i].end.substring(0,2));
            	var e2b = Number(this.shifts[i].end.substring(3,5));
            	var start1 = (s1*60)+s2;
            	var end1 = (e1*60)+e2;
            	var start2 = (s1b*60)+s2b;
            	var end2 = (e1b*60)+e2b;
            	var a = (start1 - end2);
            	var b = (start2 - end1);
            	if (start1>end1)
            		a = -a
            	if (a * b > 0){
            		//consolae.log(start,end,this.shifts[i].start,this.shifts[i].end);
            		ScheduleManager.info("Shift overlaps other shift.");
            		return;
            	}
            }
            */
            var theShift = new ShiftData(start, end); //{start:start,end:end};
            theShift.id = this.shiftDataId;
            this.shiftDataId = this.shiftDataId + 1;
            if (min && max) {
                theShift.defaultMinAssign = min;
                theShift.defaultMaxAssign = max;
                theShift.active = true;
            }
            this.shifts.push(theShift)
                //sort shift (morning shift first etc)
            var sortedSched = [];
            while (this.shifts.length > 0) {
                var ii = -1;
                var n = 24 * 60 + 1;
                for (var i = 0; i < this.shifts.length; i++) {
                    var nu = ScheduleManager.toNum(this.shifts[i].start);
                    if (nu < n) {
                        n = nu;
                        ii = i;
                    }
                }
                sortedSched.push(this.shifts[ii]);
                this.shifts.splice(ii, 1);
            }
            this.shifts = sortedSched;
            return theShift;
        }
        //
}
//
class ShiftData {
    constructor(start, end) {
            this.id = 0;
            this.start = start;
            this.end = end;
            this.defaultMinAssign = 0;
            this.defaultMaxAssign = 0;
        }
        //
    getRangePercent() {
            var rn = { l: 0, r: 0, len: 0 };
            var s = ScheduleManager.toNum(this.start);
            var e = ScheduleManager.toNum(this.end);
            var m = 1440;
            if (s > e) {
                e = e + m; // ??
            }
            rn.l = s / m;
            rn.r = e / m;
            rn.len = (e - s) / m;
            return rn;
        }
        //
    get nameString() {
        return this.start + this.end;
    }
}
//
class ScheduledDay {
    constructor(role, m, d, y, dn) {
            this.id = role.dayId;
            role.dayId = role.dayId + 1;
            this.roleId = role.id;
            this.shiftId = 0;
            this.month = m
            this.date = d;
            this.year = y;
            this.dayN = dn;
            this.shifts = [];
        }
        //
    insertShift(start, end, min, max) {
            //assuming its new 
            var shift = new Shift(this, null);
            shift.start = start;
            shift.end = end;
            shift.minAssign = min;
            shift.maxAssign = max;
            var n1 = Number(start.substring(0, 2)) + Number(start.substring(3, 5)) * 60;
            for (var i = 0; i < this.shifts.length; i++) {
                var s = this.shifts[i].start;
                var n2 = Number(s.substring(0, 2)) + Number(s.substring(3, 5)) * 60;
                if (n1 < n2) {
                    this.shifts.splice(i, 0, shift);
                    return shift;
                }
            }
            this.shifts.push(shift);
            return shift;
        }
        //
    shiftExists(shift) {
            for (var i = 0; i < this.shifts.length; i++) {
                if (this.shifts[i].start + this.shifts[i].end == shift.start + shift.end) {
                    return true;
                }
            }
            return false;
        }
        //
    shiftExists2(start, end) {
            for (var i = 0; i < this.shifts.length; i++) {
                if (this.shifts[i].start + this.shifts[i].end == start + end) {
                    return this.shifts[i];
                }
            }
            return null;
        }
        //
    getShiftByString(str) {
            for (var i = 0; i < this.shifts.length; i++) {
                if (this.shifts[i].nameString == str) {
                    return this.shifts[i];
                }
            }
            return null;
        }
        //
    nextDays(ds, schedules) {
            var asd = "";
            var d = (new DateCalc(DateCalc.getTimeYMD(this.year, this.month, this.date) + 86400000 + 86400000 * ds)).toArrayMMDDYYY();
            asd = d[0] + "/" + d[1] + "/" + d[2];
            var aa = this.month + "/" + this.date + "/" + this.year + " <- before : " + asd;
            for (var i = 0; i < schedules.length; i++) {
                if (schedules[i].month == d[0] && schedules[i].date == d[1] && schedules[i].year == d[2]) {
                    return schedules[i];
                }
            }
            return null;
        }
        /*
        getEmpShiftI(emp){
        	var shiftz = [];
        	for (var s=0;s<this.shifts.length;s++){
        		var sh = this.shifts[s];
        		if (sh.assigned.indexOf(emp) >= 0){
        			shiftz.push(s);
        		}
        	}
        	return shiftz;
        }
        */
    findEmpShift(emp) {
            for (var i = 0; i < this.shifts.length; i++) {
                if (this.shifts[i].assigned.includes(emp)) {
                    return i;
                }
            }
            return -1;
        }
        //
    get MMDDYYY() {
            return ScheduleManager.monthsName[this.month] + " " + this.date + ", " + this.year + "<br>" + ScheduleManager.daysName[this.dayN];
        }
        //
    getTime() {
        return DateCalc.getTimeYMD(this.year, this.month, this.date);
    }
}
//
class Shift {
    constructor(dateWrap, shift) {
            this.id = dateWrap.shiftId;
            dateWrap.shiftId = dateWrap.shiftId + 1;
            this.dateWrap = dateWrap
            this.shift = shift;
            this.start = shift ? shift.start : null;
            this.end = shift ? shift.end : null;
            this.minAssign = shift ? shift.defaultMinAssign : null;
            this.maxAssign = shift ? shift.defaultMaxAssign : null;
            this.assigned = []
        }
        //
    get nameString() {
            return this.start + this.end;
        }
        // this.assignments = []; // [0,0] roleid0 shiftid0
    deleteAssign(a) {
            var emp = this.assigned[a];
            this.assigned.splice(a, 1);
            for (var i = 0; i < emp.assignments.length; i++) {
                var as = emp.assignments[i];
                if (as[0] == this.dateWrap.roleId && as[1] == this.dateWrap.id && as[2] == this.id) {
                    //console.log("removed emp.assign[i]");
                    emp.assignments.splice(i, 1);
                    break;
                }
            }
            //		this.assignments.push([shift.dateWrap.roleId,shift.dateWrap.id,shift.id]);
        }
        //
    get MMDDYYYShift() {
            return ScheduleManager.monthsName[this.dateWrap.month] + " " + this.dateWrap.date + ", " + this.dateWrap.year + "<br>" + this.start + " - " + this.end + "<br>" + ScheduleManager.daysName[this.dateWrap.dayN];
        }
        //
    get StartToEnd() {
            return this.start + " - " + this.end;
        }
        //
    get StartToEndAMPM() {
            return this.getStartToEndAMPM(this.start, this.end);
        }
        //
    getRangePercent() {
            var rn = { l: 0, r: 0, len: 0 };
            var s = ScheduleManager.toNum(this.start);
            var e = ScheduleManager.toNum(this.end);
            var m = 1440;
            if (s > e) {
                e = e + m; // ??
            }
            rn.l = s / m;
            rn.r = e / m;
            rn.len = (e - s) / m;
            return rn;
        }
        //
    get Hours() {
            var s = ScheduleManager.toNum(this.shift.start);
            var e = ScheduleManager.toNum(this.shift.end);
            var m = 1440;
            if (s > e) {
                e = e + m; // ??
            }
            return (e - s) / 60;
        }
        //
    getStartToEndAMPM(start, end) {
            var sth = Number(start.substring(0, 2));
            var stm = Number(start.substring(3, 5));
            var enh = Number(end.substring(0, 2));
            var enm = Number(end.substring(3, 5));
            var st1 = (sth < 13 ? sth : sth - 12);
            var en1 = (enh < 13 ? enh : enh - 12);
            var st = (st1 == 0 ? 12 : st1) + (stm == 0 ? "" : (":" + (stm < 10 ? "0" : "") + stm)) + "" + (sth < 12 ? "AM" : "PM");
            var en = (en1 == 0 ? 12 : en1) + (enm == 0 ? "" : (":" + (enm < 10 ? "0" : "") + enm)) + "" + (enh < 12 ? "AM" : "PM");
            return st + " - " + en;
        }
        //
    HoursBetweenShift(othershift) {
            var s = ScheduleManager.toNum(othershift.shift.start) / 60;
            var e = ScheduleManager.toNum(othershift.shift.end) / 60;
            var s2 = ScheduleManager.toNum(this.shift.start) / 60;
            var e2 = ScheduleManager.toNum(this.shift.end) / 60;
            var eR = e;
            if (s > e) {
                eR = e + 24; // ??
            }
            var dist = Math.abs(eR - (s2 + 24));
            return dist;
        }
        //
    hasVacant() {
            if (this.assigned.length < this.maxAssign) {
                return true;
            }
            return false;
        }
        //
    hasEnoughWorkers() {
            if (this.assigned.length >= this.minAssign) {
                return true;
            }
            return false;
        }
        //
    assignEmp(emp) {
            this.assigned.push(emp);
        }
        //
}
//