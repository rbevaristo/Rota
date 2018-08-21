//
class ScheduleManager {
	constructor() {
		//constants
		this.daysName = ['Sunday','Monday','Tuesday','Wednesday','Thursday','Friday','Saturday'];
		this.monthsName = ['January','February','March','April','May','June','July','August','September','October','November','December'];
		this.dateFormat = "MM/DD/YYYY";
		ScheduleManager.daysName = this.daysName;
		ScheduleManager.monthsName = this.monthsName;
		ScheduleManager.dateFormat = this.dateFormat;
		ScheduleManager.Instance = this;
		//data
		this.roles = []; // Role class
		this.employeeId = 0;
		this.roleId = 0;
		this.employees = []; // Employee class
		this.currentDate = new DateCalc(Date.now());
		this.currentDate.setStartOfDay();
		this.ui = null;
		this.dbsettings = null;
		this.dbcriteria = null;
		this.dbemploys = null;
		this.dbshifts = null;
		this.dbrequiredshifts = null;
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
	static toNum(ss){
		return Number(ss.substring(0,2))*60+Number(ss.substring(3,5));
	}
	//
	t(){
		console.log(this.toJSON());
	}
	//
	toJSON(){
		var tab = {
			employeeId:this.employeeId,
			roleId:this.roleId,
			employees:[],
			roles:[]
		};
		for (var i=0;i<this.employees.length;i++){
			var emp = this.employees[i];
			tab.employees.push({
				id : emp.id,
				trueId : emp.trueId,
				fname : emp.fname,
				lname : emp.lname,
				active : emp.active,
				role : emp.role,
				preferredDayoff : emp.preferredDayoff,
				assignments : emp.assignments,
				Age : emp.Age,
				Gender : emp.Gender
			});
		}
		for (var i=0;i<this.roles.length;i++){
			var role = this.roles[i];
			var gens = [];
			for (var ii=0;ii<role.generations.length;ii++){
				var g = role.generations[ii];
				var sd = [];
				for (var iii=0;iii<g.scheduledDays.length;iii++){
					sd.push(g.scheduledDays[iii].id);
				}
				var em = [];
				for (var iii=0;iii<g.employees.length;iii++){
					em.push(g.employees[iii].id);
				}
				gens.push({
					days:g.days,
					employees:em,
					id:g.id,
					locked:g.locked,
					scheduledDays:sd,
					startDate:g.startDate
				});
			}
			//
			var scheduledDays = [];
			for (var ii=0;ii<role.scheduledDays.length;ii++){
				var d = role.scheduledDays[ii];
				var shifts = [];
				for (var i2=0;i2<d.shifts.length;i2++){
					var s = d.shifts[i2];
					var assigned = [];
					for (var ie=0;ie<s.assigned.length;ie++){
						assigned.push(s.assigned[ie].id);
					}
					shifts.push({
						assigned:assigned,
						dateWrap:s.dateWrap.id,
						start:s.start,
						end:s.end,
						id:s.id,
						minAssign:s.minAssign,
						maxAssign:s.maxAssign,
						shift:s.shift.id
					});
				}
				scheduledDays.push({
					date:d.date,
					dayN:d.dayN,
					id:d.id,
					month:d.month,
					roleId:d.roleId,
					shiftId:d.shiftId,
					year:d.year,
					shifts:shifts
				});
			}
			//
			var shs = [];
			for (var ix=0;ix<role.shifts.length;ix++){
				var shd = role.shifts[ix];
				shs.push({
					id:shd.id,
					start:shd.start,
					end:shd.end,
					defaultMinAssign:shd.defaultMinAssign,
					defaultMaxAssign:shd.defaultMaxAssign
				});
			}
			tab.roles.push({
				id : role.id,
				dayId : role.dayId,
				generationId : role.generationId,
				shiftDataId : role.shiftDataId,
				name : role.name,
				shifts : shs,
				scheduledDays : scheduledDays,
				disabledDays : role.disabledDays,
				generations : gens,
				shiftType : role.shiftType, 
				shiftDistHrs : role.shiftDistHrs
			});
		}
		var jsonstring = JSON.stringify(tab);
		var compressed = lzjs.compress(jsonstring);
		return compressed;
	}
	//==========================================================================================================================================================================
	//==========================================================================================================================================================================
	//==========================================================================================================================================================================
	//==========================================================================================================================================================================
	loadJSON(str){
		var tab = JSON.parse(lzjs.decompress(str));
		this.employeeId = 0;
		this.roleId = 0;

		this.employees = [];
		for (var i=0;i<tab.employees.length;i++){
			var emp2 = tab.employees[i];
			var emp = this.addEmployee(emp2.fname,emp2.lname,emp2.role);
			emp.id = emp2.id;
			emp.trueId = emp2.trueId;
			emp.active = emp2.active;
			emp.preferredDayoff = emp2.preferredDayoff;
			emp.assignments = emp2.assignments;
			emp.Age = emp2.Age;
			emp.Gender = emp2.Gender;
		}

		this.roles = [];
		for (var i=0;i<tab.roles.length;i++){
			var role2 = tab.roles[i];
			var role = this.addRole(role2.name);
			role.shifts = []; //role2.shifts; // 
			for (var ii in role2.shifts) {
				//role.addShift(role2.shifts[ii].start,role2.shifts[ii].end,role2.shifts[ii].defaultMinAssign,role2.shifts[ii].defaultMaxAssign);
				var sa2 = role2.shifts[ii];
				var sa = new ShiftData(sa2.start,sa2.end); 
				sa.id = sa2.id;
				sa.defaultMaxAssign = sa2.defaultMaxAssign;
				sa.defaultMinAssign = sa2.defaultMinAssign;
				role.shifts.push(sa);
			}

			role.scheduledDays = []; //
			for (var i2=0;i2<role2.scheduledDays.length;i2++){
				var sd2 = role2.scheduledDays[i2];
				var sd = new ScheduledDay(role,sd2.month,sd2.date,sd2.year,sd2.dayN);
				sd.id = sd2.id;
				sd.roleId = sd2.roleId;
				sd.shiftId = sd2.shiftId;
				var ss = [];
				for (var ii2=0;ii2<sd2.shifts.length;ii2++){
					var sh2 = sd2.shifts[ii2];
					console.log("x-x",sh2.shift,role.getShiftDataById(sh2.shift));
					var sh = new Shift(sd,role.getShiftDataById(sh2.shift));
					sh.start = sh2.start;
					sh.end = sh2.end;
					sh.id = sh2.id;
					sh.minAssign = sh2.minAssign;
					sh.maxAssign = sh2.maxAssign;
					sh.assigned = [];
					for (var i3=0;i3<sh2.assigned.length;i3++){
						sh.assigned.push(this.getEmpById(sh2.assigned[i3]));
					}
					ss.push(sh);
				}
				sd.shifts = ss;
				role.scheduledDays.push(sd);
			}

			role.generations = []; // 
			for (var i2=0;i2<role2.generations.length;i2++){
				var g = role2.generations[i2];
				var gen = new SchedGeneration(g.startDate,g.days,role);
				gen.id = g.id;
				gen.locked = g.locked;
				//
				gen.scheduledDays = [];
				for (var i3=0;i3<g.scheduledDays.length;i3++){
					gen.scheduledDays.push(role.getScheduledDayById(g.scheduledDays[i3]));
				}
				gen.employees = [];
				for (var i3=0;i3<g.employees.length;i3++){
					gen.employees.push(this.getEmpById(g.employees[i3]));
					console.log(g.employees[i3],"w");
				}
				role.generations.push(gen);
				//
				role.id = role2.id;
				role.dayId = role2.dayId;
				role.generationId = role2.generationId;
			}

			role.disabledDays = role2.disabledDays;
			role.shiftType = role2.shiftType;
			role.shiftDistHrs = role2.shiftDistHrs;
		}

		this.employeeId = tab.employeeId;
		this.roleId = tab.employeeId;
		this.shiftDataId = tab.shiftDataId;
		if (this.roles.length>0){
			this.ui.changeRoleView(this.roles[0].name);
		}
		console.log("loaded");
	}
	//
	//
	//
	//
	injectDB(dbemploys,dbshifts,dbrequiredshifts,dbsettings,dbcriteria){
		this.dbemploys = dbemploys;
		this.dbshifts = dbshifts;
		this.dbrequiredshifts = dbrequiredshifts;
		this.dbsettings = dbsettings;
		this.dbcriteria = dbcriteria;
		console.log("nice",dbsettings);
		for (var i=0;i<this.roles.length;i++){
			var role = this.roles[i];
			role.dayoffSetting = dbsettings.dayoff;
			console.log("asd",role.dayoffSetting);
		}
	}
	//
	updateScheduleHistory(){
		for (var i=0;i<this.roles.length;i++){
			this.roles[i].updateScheduleHistory(this.currentDate.Year,this.currentDate.Month,this.currentDate.Date);
		}
	}
	//
	addEmployee(fname,lname,rool) {
		var emp = new Employee(this.employeeId);
		emp.fname = fname;
		emp.lname = lname;
		emp.role = rool;
		if (this.getRole(rool) == null){
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
		for (var i=0;i<this.roles.length;i++) {
			if (this.roles[i].name.toLowerCase() == name.toLowerCase()) {
				ScheduleManager.info("There is already a role named '"+name+"'.");
				return this.roles[i];
			}
		}
		var role = new Role();
		role.name = name;
		role.id = this.roleId;
		this.roleId = this.roleId+1;
		this.roles.push(role);
		return role;
	}
	//
	getRole(name){
		for (var i=0;i<this.roles.length;i++){
			if (this.roles[i].name.toLowerCase() == name.toLowerCase()){
				return this.roles[i];
			}
		}
		return null;
	}
	//
	loadScheduledDayFrame(from,times){
		var times = times!=null?times:1;
		for (var i = 0;i<this.roles.length;i++){
			this.roles[i].loadScheduledDayFrame(from,times);
		}
	}
	//
	getEmpById(id){
		for (var i=0;i<this.employees.length;i++){
			if (this.employees[i].id==id){
				return this.employees[i];
			}
		}
		return null;
	}
	//
	//
}
//
class Employee{
	constructor(id){
		this.id = id
		this.trueId = null;
		this.fname = null;
		this.lname = null;
		this.active = 1; //1 true 0 false
		this.role = null;
		this.timeAvoidance = [];
		this.preferredDayoff = -1; // 0-6
		this.assignments = []; // [0,0] roleid0 shiftid0
		this.Age = 0;
		this.Gender = "";
	}
	//
	assignShift(shift){
		this.assignments.push([shift.dateWrap.roleId,shift.dateWrap.id,shift.id]);
	}
	//
	getTotalHoursWorked(){
		var hrs = 0;
		for (var i=this.assignments.length-1;i>=0;i--){
			hrs = hrs + this.getShiftById(this.assignments[i][0],this.assignments[i][1],this.assignments[i][2]).Hours;
		}
		return hrs;
	}
	//
	get LNcFN(){
		return this.lname+", "+this.fname;
	}
	//
	getShiftById(rId,dayId,shiftId){
		var role = null;
		var sc = ScheduleManager.Instance;
		for (var i=0;i<sc.roles.length;i++){
			if (sc.roles[i].id == rId){
				role = sc.roles[i];
				break;
			}
		}
		if (role == null){
			console.log("role null error.");
			return null;
		}
		var day = null;
		for (var i=role.scheduledDays.length-1;i>=0;i--){
			if (role.scheduledDays[i].id == dayId){
				day = role.scheduledDays[i];
				break;
			}
		}
		if (day == null){
			console.log("day null error.");
			return null;
		}
		var shift = null;
		for (var i=day.shifts.length-1;i>=0;i--){
			if (day.shifts[i].id == shiftId){
				shift = day.shifts[i];
				break;
			}
		}
		if (shift == null){
			console.log("day null error.");
			return null;
		}
		return shift;
	}
	//
}
//
class TimeAvoidance{
	constructor(){
		this.start = null;
		this.end = null;
		this.day = 0;
		this.from = null;
		this.until = null;
	}
}
//
class DateCalc{
	constructor(d){
		this.t = d!=null?d:0;
	}
	static resetDay(t){
		//return (new Date(t)).getTime();
		return (t-(t%86400000));
	}
	static getTimeYMD(y,m,d){
		return this.resetDay((new Date(y,m,d,0,0,0,0)).getTime());
	}
	static getDaysInMonth(y,m){
		var isLeap = (y%4==0)?true:false;
		var ds = [31,28,31,30,31,30,31,31,30,31,30,31];
		var dd = ((isLeap && m==1)?29:ds[m]);
		return dd;
	}
	static isEndOfMonthYMD(y,m,d){
		var days = DateCalc.getDaysInMonth(y,m);
		return (days==d)?true:false;
	}
	setStartOfDay(){
		this.t = DateCalc.resetDay(this.t);
	}
	nextDay(){
		this.t = this.t + 86400000;
	}
	skipDays(i){
		this.t = this.t + 86400000*i;
	}
	nextWeek(){
		this.t = this.t + 86400000*7;
	}
	setToDate(){
		this.t = 0;
	}
	get FullDate() {
		var d = ((this.t != 0)? (new Date(this.t)) : (new Date()));
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
	setDateMMDDYYYY(m,d,y){
		this.t = DateCalc.getTimeYMD(y,m,d);
	}
	toArrayMMDDYYY(){
		return [this.Month,this.Date,this.Year,this.Day];
	}
	daysBetween(date){
		var t2 = date.t;
		return (Math.abs(t2-this.t)/86400000);
	}
	getDateAfterDays(d){
		return new DateCalc(this.t+d*86400000);
	}
	get MMDDYYY(){
		return ScheduleManager.monthsName[this.Month] + " " + this.Date + ", "+this.Year+"<br>"+ScheduleManager.daysName[this.Day];
	}
}
//
class SchedGeneration{
	constructor(startDate,days,role){
		this.id = 0;
		this.startDate = startDate
		this.days = days;
		this.role = role;
		this.locked = false;
		this.scheduledDays=null;
		this.employees = [];
	}
	init(fixrest){
		var data = this.role.assignShifts(this.startDate,this.days,null,null,fixrest);
		this.scheduledDays = data.scheduledDays;
		this.employees = data.employees;
	}
	//
	getEmpShiftByDay(emp,d){
		var sd = this.scheduledDays[d];
		var day = [];
		for (var s=0;s<sd.shifts.length;s++){
			var sh = sd.shifts[s];
			if (sh.assigned.indexOf(emp)>=0){
				day.push(sh.nameString);
			}
		}
		return day;
	}
	//
	getEmpShifts(emp){
		var days = [];
		for (var d=0;d<this.scheduledDays.length;d++){
			days.push(this.getEmpShiftByDay(emp,d));
		}
		return days;
	}
	//
	swapShift(emp1,emp2,d,ss1,ss2){
		var shifts1 = ss1?ss1:this.getEmpShifts(emp1);
		var shifts2 = ss2?ss2:this.getEmpShifts(emp2);
		var sd = this.scheduledDays[d];
		var sh1 = shifts1;
		var sh2 = shifts2;
		var e1 = emp1;
		var e2 = emp2;
		for (var x=0;x<2;x++){
			if (x==1){
				sh1 = shifts2;
				sh2 = shifts1;
				e1 = emp2;
				e2 = emp1;
			}
			for (var s=0;s<sh1[d].length;s++){
				var sh = sd.getShiftByString(sh1[d][s]);
				sh.deleteAssign(sh.assigned.indexOf(e1));
			}
			for (var s=0;s<sh2[d].length;s++){
				var sh = sd.getShiftByString(sh2[d][s]);
				sh.assignEmp(e1);
				e1.assignShift(sh);
			}
		}
	}
	//
	swapSchedGeneration(emp1,emp2){
		var shifts1 = this.getEmpShifts(emp1);
		var shifts2 = this.getEmpShifts(emp2);
		for (var d=0;d<this.scheduledDays.length;d++){
			this.swapShift(emp1,emp2,d,shifts1,shifts2);
		}
	}
	//
	findScheduleYMD(yy,mm,dd,schedules){
		var schedules = this.scheduledDays;
		//var d = (new DateCalc(DateCalc.getTimeYMD(yy,mm,dd)+86400000)).toArrayMMDDYYY();
		for (var i=0;i<schedules.length;i++){
			if (schedules[i].month == mm && schedules[i].date == dd && schedules[i].year == yy){
				return schedules[i];
			}
		}
		return null;
	}
}
//
class Role{
	constructor(){
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
		this.shiftDistHrs = 8;
		this.shuffleGenerate = 0;             // untouched
		this.dayoffSetting = 1; // 0 off 1 on    DB
		this.maxdayoff = 1; // DB
	}
	//
	generate(startDate,days,daybefore){ // y,m,d
		var gen = new SchedGeneration(startDate,days,this);
		gen.id = this.generationId;
		this.generationId = this.generationId + 1;
		this.generations.push(gen);
		gen.init(daybefore);
	}
	//
	getGenerationGroupYMD(yy,mm,dd){
		for (var g=0;g<this.generations.length;g++){
			var found = this.generations[g].findScheduleYMD(yy,mm,dd);
			if (found){
				return this.generations[g];
			}
		}
		return null;
	}
	//
	setScheduleRefresh(typ,date){
		this.scheduleRefresh = typ;
		this.dayOfRefresh = date;
	}
	//
	CloneSchedule(y,m,d,nd,ogen){
		var scheduledDays = ogen.scheduledDays;
		var days = scheduledDays.length;
		/*
		this.scheduledDays=null;
		*/
		var startDateT = DateCalc.getTimeYMD(y,m,d)+86400000;
		var dist = startDateT - DateCalc.getTimeYMD(scheduledDays[0].year,scheduledDays[0].month,scheduledDays[0].date);
		var gen = new SchedGeneration([m,d,y,nd],days,this);
		gen.scheduledDays = [];
		gen.id = this.generationId;
		this.generationId = this.generationId + 1;
		this.generations.push(gen);
		for (var e=0;e<ogen.employees.length;e++){
			gen.employees.push(ogen.employees[e]);
		}
		for (var ii=0;ii<scheduledDays.length;ii++){
			var osD = scheduledDays[ii];
			var newdate = new DateCalc(DateCalc.getTimeYMD(osD.year,osD.month,osD.date)+dist);
			var sD = new ScheduledDay(this,newdate.Month,newdate.Date,newdate.Year,newdate.Day);
			for (var s=0;s<osD.shifts.length;s++){
				var osh = osD.shifts[s];
				var sh = new Shift(sD,osh.shift);
				sD.shifts.push(sh);
				for (var i=0;i<osh.assigned.length;i++){
					this.assignEmp(osh.assigned[i],sh);
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
	DeleteGeneration(gen){
		//console.log("gl",this.generations.length);
		//console.log("sdl",this.scheduledDays.length);
		for (var i=0;i<gen.scheduledDays.length;i++){
			var sD = gen.scheduledDays[i];
			for (var i2=0;i2<sD.shifts.length;i2++){
				var sh = sD.shifts[i2];
				while (sh.assigned.length>0){
					sh.deleteAssign(0);
				}
			}
			this.scheduledDays.splice(this.scheduledDays.indexOf(sD),1);
		}
		this.generations.splice(this.generations.indexOf(gen),1);
		//console.log("gl2",this.generations.length);
		//console.log("sdl2",this.scheduledDays.length);
	}
	//
	getShiftDataById(id){
		for (var i=0;i<this.shifts.length;i++){
			if (this.shifts[i].id==id){
				return this.shifts[i];
			}
		}
	}
	//
	getTable(from,to){
		var emps = this.findEmployees();
		var date = new DateCalc();
		date.setDateMMDDYYYY(from[0],from[1],from[2]);
		var date2 = new DateCalc();
		date2.setDateMMDDYYYY(to[0],to[1],to[2]);
		var ds = date.daysBetween(date2);
		var days = [];
		for (var d=0;d<ds;d++){
			var exist = false;
			for (var s=this.scheduledDays.length-1;s>=0;s--){
				if (this.scheduledDays[s].getTime() == date.t){
					exist = true;
					days.push(this.scheduledDays[s]);
					break;
				}
			}
			date.nextDay();
			if (!exist){
				days.push({notexist:true,month:date.Month,date:date.Date,year:date.Year,day:date.Day,mmddyyy:date.MMDDYYY});
			}
		}
		var tab = [];
		for (var e=0;e<emps.length;e++){
			var emp = emps[e];
			var empSched = [];
			for (var d=0;d<ds;d++){
				empSched.push(this.isEmpAssignedInThisDay(emp,days[d])); //days[d]);
			}
			tab.push(empSched);
		}
		return {rows:emps,columns:days,data:tab};
	}
	//
	isEmpAssignedInThisDay(emp,dateWrap){
		var assigns = [];
		if (dateWrap == 0){
			return assigns;
		}
		//this.assignments.push([shift.dateWrap.roleId,shift.dateWrap.id,shift.id]);
		for (var i=emp.assignments.length-1;i>=0;i--){
			var as = emp.assignments[i];
			if (as[0] == dateWrap.roleId && as[1] == dateWrap.id)
			{
				assigns.push([as[0],as[1],as[2]]);
			}
		}
		return assigns;
	}
	//
	getScheduledDayById(dayId){
		for (var i=this.scheduledDays.length-1;i>=0;i--){
			var day = this.scheduledDays[i];
			if (day.id == dayId){
				return day;
			}
		}
	}
	//
	getShiftById(dayId,shiftId){
		for (var i=this.scheduledDays.length-1;i>=0;i--){
			var day = this.scheduledDays[i];
			if (day.id == dayId){
				for (var s=0;s<day.shifts.length;s++){
					if (day.shifts[s].id == shiftId){
						return day.shifts[s];
					}
				}
			}
		}
		return null;
	}
	//
	findEmployees(){
		var emps = ScheduleManager.Instance.employees;
		var picks = [];
		for (var i=0;i<emps.length;i++){
			var e = emps[i];
			if (e.active == 1 && e.role && e.role.toLowerCase()==this.name.toLowerCase()){
				picks.push(e);
			}
		}
		//picks.sort(function(a,b) {return (a.pxreferenceLevel < b.pxreferenceLevel) ? 1 : ((b.pxreferenceLevel < a.pxreferenceLevel) ? -1 : 0);} ); 
		return picks;
	}
	//
	findScheduleYMD(yy,mm,dd,schedules,ex){
		var schedules = this.scheduledDays;
		var d = (new DateCalc(DateCalc.getTimeYMD(yy,mm,dd)+86400000+86400000*(ex!=null?ex:0))).toArrayMMDDYYY();
		for (var i=0;i<schedules.length;i++){
			if (schedules[i].month == d[0] && schedules[i].date == d[1] && schedules[i].year == d[2]){
				return schedules[i];
			}
		}
		return null;
	}
	//
	isScheduleClear(yy,mm,dd,days){
		var schedules = this.scheduledDays;
		for (var da=0;da<days;da++){
			var sc = this.findScheduleYMD(yy,mm,dd,schedules,da);
			if (sc){return sc;}
		}
		return null;
	}
	//
	getMinDayArray(arr){
		var n = arr[0];
		var ii = 0;
		var iis = [0];
		for (var i=1;i<arr.length;i++){
			if (n>arr[i]){
				iis = [i];
				n = arr[i];
				ii = i;
			}
			else if(n==arr[i]){
				iis.push(i);
			}
		}
		var ix = Math.floor(Math.random() * iis.length)
		ii = iis[ix];
		return ii;
	}
	//
	getMinDayoff(arr){
		var n = null;
		var ii = -1;
		var iis = null;
		for (var i=0;i<arr.length;i++){
			if (!this.disabledDays.includes(i)){
				if (ii == -1){
					n = arr[i];
					ii = i;
					iis = [i];
				}
				else{
					if (n>arr[i]){
						iis = [i];
						n = arr[i];
						ii = i;
					}
					else if(n==arr[i]){
						iis.push(i);
					}
				}
			}
		}
		if (iis.length>0){
			var ix = Math.floor(Math.random() * iis.length)
			ii = iis[ix];
			return ii;
		}
		else{
			console.log("cant find min day off, expect error nibba");
			return -1;
		}
	}
	//
	assignShifts(mdy,ds,dos,empz,fixrest){
		var yy = mdy[2];
		var mm = mdy[0];
		var dd = mdy[1];
		var days = 0;
		if (this.scheduleRefresh == "1W"){days = 7;}
		else if (this.scheduleRefresh == "2W"){days = 14;}
		else if (this.scheduleRefresh == "1M"){days = 30;}
		if (ds){days = ds;}
		var dt = DateCalc.getTimeYMD(yy,mm,dd); 
		var dateStart = new DateCalc(dt);
		var emps = empz==null?this.findEmployees():empz;
		var schedules = [];
		//Get Scheduled Days
		var sdays = this.scheduledDays.length-1
		for (var ii=0;ii<days;ii++){
			var found = false;
			for (var d=sdays;d>=0;d--){
				var day = this.scheduledDays[d];
				if (day.getTime() == dateStart.t){
					schedules.push(day); 
					found = true;
					break;
				}
			}
			dateStart.nextDay();
			if (!found){
				schedules.push(this.loadScheduledDayFrame(dateStart.t,1,1));
			}
		}
		//
		if (this.shiftType == "Normal"){
			this.fillShiftsNormal(emps,days,schedules,fixrest);
		}
		return {scheduledDays:schedules,employees:emps};
	}
	//
	fillShiftsNormal(emps,days,schedules,fixrest){
		//assign employees to shifts
		if (this.shuffleGenerate == 1){
			emps = this.shuffleArray(emps);
		}
		var dayoffs = [0,0,0,0,0,0,0];
		var maxdayoff = this.maxdayoff; //Math.floor((emps.length+6)/7);
		for (var i=0;i<emps.length;i++){
			var emp = emps[i];
			var dayoff = null;
			//set dayoff
			if (emp.preferredDayoff!=null && emp.preferredDayoff>=0 && dayoffs[emp.preferredDayoff]<maxdayoff && !this.disabledDays.includes(emp.preferredDayoff) && this.dayoffSetting==1){
				dayoff = emp.preferredDayoff;
				dayoffs[dayoff]++;
			}
			else{
				dayoff = this.getMinDayoff(dayoffs);
				console.log("failed to satisfy "+emp.fname+" "+emp.lname+"'s "+emp.preferredDayoff+" dayoff. changed to "+dayoff)
				dayoffs[dayoff]++;
			}
			//set sched
			for (var d=0;d<days;d++){
				var scheduledDay = schedules[d];
				var theDay = scheduledDay.dayN;
				var scheduleYesterday = scheduledDay.nextDays(-1,this.scheduledDays);
				var shiftY = null;
				if (scheduleYesterday){
					var shiftIY = scheduleYesterday.findEmpShift(emp);
					shiftY = shiftIY>=0?scheduleYesterday.shifts[shiftIY]:null;
				}
				if (!this.disabledDays.includes(theDay) && dayoff!=theDay){
					var shiftI = this.getBestShiftSlot(scheduledDay.shifts,fixrest!=null?shiftY:null,d,emp);
					var shift = scheduledDay.shifts[shiftI];
					this.assignEmp(emp,shift);
				}
			}
		}
	}
	//
	getBestShiftSlot(shifts,shiftY,d,emp){
		var ss = [];
		var minAssign = 999999999;
		for (var i=0;i<shifts.length;i++){
			if (shifts[i].assigned.length<minAssign){
				minAssign = shifts[i].assigned.length;
			}
		}
		for (var i=0;i<shifts.length;i++){
			if (shifts[i].assigned.length <= minAssign){
				ss.push({i:i,shift:shifts[i]})
			}
		}
		ss.sort(function(a,b) {return (a.shift.assigned.length > b.shift.assigned.length) ? 1 : ((b.shift.assigned.length > a.shift.assigned.length) ? -1 : 0);} ); 
		var choose = 0;
		var chosens = [];
		if (shiftY){
			for (var i=0;i<ss.length;i++){
				var sh = ss[i].shift;
				var dist = sh.HoursBetweenShift(shiftY);
				if (sh.assigned.length<sh.maxAssign && dist >= this.shiftDistHrs){
					chosens.push({i:i,dist:dist});
				}
			}
			chosens.sort(function(a,b) {return (a.dist > b.dist) ? 1 : ((b.dist > a.dist) ? -1 : 0);} ); 
			var ii = 0; //Math.floor((chosens.length)/2);
			if (d==0){
				//console.log(emp.fname,ii,chosens);
				console.log(emp.fname,chosens[ii]?chosens[ii].dist:"??");
			}
			if (!chosens[ii]){
				console.log(emp.fname,"AAAAAAAAAA");
			}
			choose = chosens[ii]?chosens[ii].i:0;
		}
		return ss[choose].i;
	}
	//
	getAvailableShift(shifts){
		for (var i=0;i<shifts.length;i++){
			if (shifts[i].hasVacant()){
				return i;
			}
		}
		return -1;
	}
	//
	shuffleArray(array) {
	  var currentIndex = array.length, temporaryValue, randomIndex;

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
	assignEmp(emp,shift){
		//this.assignments = []; // [0,0] roleid0 shiftid0
		shift.assignEmp(emp);
		emp.assignShift(shift);
	}
	//
	loadScheduledDayFrame(fromT,times,oneday){ // load empty shift sched
		var times = times!=null?times:1;
		//test 1 week worth
		var days = 0;
		if (this.scheduleRefresh == "1W"){
			days = 7*times;
		}
		else if (this.scheduleRefresh == "2W"){
			days = 14*times;
		}
		if (oneday){
			days = 1;
		}
		var singleDay = null;
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
	}
	//
	deleteScheduledDay(t){
		for (var d=this.scheduledDays.length-1;d>=0;d--){
			if (this.scheduledDays[d].getTime()+86400000 == t){
				this.scheduledDays.splice(d,1);
				break;
			}
		}
	}
	//
	getDailySchedule(d){
		var d = d!=null?d:0;
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
		for (var i = this.scheduledDays.length-1;i>=0;i--){
			var day = this.scheduledDays[i];
			if (day.year==yyyy && day.month==mm && day.date==dd){
				return day;
			}
		}
	}
	//
	findDailyScheduleYMD(y,m,d){
		for (var i = this.scheduledDays.length-1;i>=0;i--){
			var day = this.scheduledDays[i];
			if (day.year==y && day.month==m && day.date==d){
				return day;
			}
		}
		return null;
	}
	//
	disableDay(d){
		if (!this.disabledDays.includes(d)){
			this.disabledDays.push(d);
			ScheduleManager.info("Disabled "+ScheduleManager.daysName[d]+" on "+this.name+".");
		}
	}
	//
	addShift(start,end,min,max) {
		if (start.length != 5 || end.length != 5){
			ScheduleManager.info("Format mismatch.");
			return;
		}
		var s1 = Number(start.substring(0,2));
		var s2 = Number(start.substring(3,5));
		var e1 = Number(end.substring(0,2));
		var e2 = Number(end.substring(3,5));
		if (s1 > 24 || e1 > 24 || s2 > 60 || e2 > 60){
			ScheduleManager.info("Format mismatch.");
			return;
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
		var theShift = new ShiftData(start,end); //{start:start,end:end};
		theShift.id = this.shiftDataId;
		this.shiftDataId = this.shiftDataId + 1;
		if (min && max){
			theShift.defaultMinAssign = min;
			theShift.defaultMaxAssign = max;
		}
		this.shifts.push(theShift)
		//sort shift (morning shift first etc)
		var sortedSched = [];
		while (this.shifts.length>0){
			var ii = -1;
			var n = 24*60+1;
			for (var i=0;i<this.shifts.length;i++){
				var nu = ScheduleManager.toNum(this.shifts[i].start);
				if (nu < n){
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
class ShiftData{
	constructor(start,end){
		this.id = 0;
		this.start = start;
		this.end = end;
		this.defaultMinAssign = 0;
		this.defaultMaxAssign = 0;
	}
	//
	getRangePercent(){
		var rn = {l:0,r:0,len:0};
		var s = ScheduleManager.toNum(this.start);
		var e = ScheduleManager.toNum(this.end);
		var m = 1440;
		if (s>e){
			e = e+m; // ??
		}
		rn.l = s/m;
		rn.r = e/m;
		rn.len = (e-s)/m;
		return rn;
	}
}
//
class ScheduledDay{
	constructor(role,m,d,y,dn){
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
	getShiftByString(str){
		for (var i=0;i<this.shifts.length;i++){
			if (this.shifts[i].nameString == str){
				return this.shifts[i];
			}
		}
		return null;
	}
	//
	nextDays(ds,schedules){
		var asd = "";
		var d = (new DateCalc(DateCalc.getTimeYMD(this.year,this.month,this.date)+86400000+86400000*ds)).toArrayMMDDYYY();
		asd = d[0]+"/"+d[1]+"/"+d[2];
		var aa = this.month+"/"+this.date+"/"+this.year+" <- before : "+asd;
		for (var i=0;i<schedules.length;i++){
			if (schedules[i].month == d[0] && schedules[i].date == d[1] && schedules[i].year == d[2]){
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
	findEmpShift(emp){
		for (var i=0;i<this.shifts.length;i++){
			if (this.shifts[i].assigned.includes(emp)){
				return i;
			}
		}
		return -1;
	}
	//
	get MMDDYYY(){
		return ScheduleManager.monthsName[this.month] + " " + this.date + ", "+this.year+"<br>"+ScheduleManager.daysName[this.dayN];
	}
	//
	getTime(){
		return DateCalc.getTimeYMD(this.year,this.month,this.date);
	}
}
//
class Shift{
	constructor(dateWrap,shift){
		this.id = dateWrap.shiftId;
		dateWrap.shiftId = dateWrap.shiftId + 1;
		this.dateWrap = dateWrap
		this.shift = shift;
		this.start = shift.start;
		this.end = shift.end;
		this.minAssign = shift.defaultMinAssign;
		this.maxAssign = shift.defaultMaxAssign;
		this.assigned = []
	}
	//
	get nameString(){
		return this.start+this.end;
	}
	//
	deleteAssign(a){
		var emp = this.assigned[a];
		this.assigned.splice(a,1);
		for (var i=0;i<emp.assignments.length;i++){
			var as = emp.assignments[i];
			if (as[0]==this.dateWrap.roleId && as[1]==this.dateWrap.id && as[2]==this.id){
				console.log("removed emp.assign[i]");
				emp.assignments.splice(i,1);
				break;
			}
		}
		//		this.assignments.push([shift.dateWrap.roleId,shift.dateWrap.id,shift.id]);
	}
	//
	get MMDDYYYShift(){
		return ScheduleManager.monthsName[this.dateWrap.month] + " " + this.dateWrap.date + ", "+this.dateWrap.year+"<br>"+this.start+" - "+this.end+"<br>"+ScheduleManager.daysName[this.dateWrap.dayN];
	}
	//
	get StartToEnd(){
		return this.start+" - "+this.end;
	}
	//
	get StartToEndAMPM(){
		var sth = Number(this.start.substring(0,2));
		var stm = Number(this.start.substring(3,5));
		var enh = Number(this.end.substring(0,2));
		var enm = Number(this.end.substring(3,5));
		var st = (sth<13?sth:sth-12)+(stm==0?"":(":"+stm))+""+(sth<12?"AM":"PM"); 
		var en = (enh<13?enh:enh-12)+(enm==0?"":(":"+enm))+""+(enh<12?"AM":"PM");
		return st+" - "+en;
	}
	//
	get Hours(){
		var s = ScheduleManager.toNum(this.shift.start);
		var e = ScheduleManager.toNum(this.shift.end);
		var m = 1440;
		if (s>e){
			e = e+m; // ??
		}
		return (e-s)/60;
	}
	//
	HoursBetweenShift(othershift){
		var s = ScheduleManager.toNum(othershift.shift.start)/60;
		var e = ScheduleManager.toNum(othershift.shift.end)/60;
		var s2 = ScheduleManager.toNum(this.shift.start)/60;
		var e2 = ScheduleManager.toNum(this.shift.end)/60;
		var eR = e;
		if (s>e){
			eR = e+24; // ??
		}
		var dist = Math.abs(eR-(s2+24));
		return dist;
	}
	//
	hasVacant(){
		if (this.assigned.length < this.maxAssign){
			return true;
		}
		return false;
	}
	//
	hasEnoughWorkers(){
		if (this.assigned.length >= this.minAssign){
			return true;
		}
		return false;
	}
	//
	assignEmp(emp){
		this.assigned.push(emp);
	}
	//
}
//
