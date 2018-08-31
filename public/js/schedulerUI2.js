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
	static isPastMDY(m,d,y,tt){
		var t = DateCalc.resetDay(tt?tt:(new Date()).getTime());
		var day = DateCalc.getTimeYMD(y,m,d);
		return t>day?-1:(t<day?1:0);
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












// = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = 




// = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = 




// = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = 




// = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = 




// = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = 




// = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = 




// = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = 




// = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = 




// = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = 




// = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = 






//
class ScheduleManagerHTML2{
	constructor(doc){
		this.doc = doc;
		this.tableMonthView = {year:2018,month:6};
		this.pattern1 = /^.*[0-9a-zA-Z]+.*$/;
		this.daysName = ['Sunday','Monday','Tuesday','Wednesday','Thursday','Friday','Saturday'];
		this.monthsName = ['January','February','March','April','May','June','July','August','September','October','November','December'];
		//
		this.headerWindowI = -1;
		this.headerWindowSL = 0;
		this.schedule = [];
		this.scheds = {};
		this.currentDate = new DateCalc(Date.now());
	}
	//
	Initialize(){
		var doc = this.doc;
		var diz = this;
		//
		this.tableMonthView = {year:this.currentDate.Year,month:this.currentDate.Month}
		//buttons
		var monthLeft = doc.getElementById("monthLeft");
		var monthRight = doc.getElementById("monthRight");
		

		monthLeft.onclick  = function(){diz.adjustMonthView(-1);};
		monthRight.onclick = function(){diz.adjustMonthView( 1);};
		console.log(this.schedule);
		for (var i=0;i<this.schedule.length;i++){
			var s = this.schedule[i];
			var y = Number(s.substring(0,4));
			var m = Number(s.substring(5,7))-1
			var d = Number(s.substring(8,10));
			var st = s.substring(11,16);
			var ed = s.substring(17,22);
			if (this.scheds[y]==null){this.scheds[y]={};}
			if (this.scheds[y][m]==null){this.scheds[y][m]={};}
			if (this.scheds[y][m][d]==null){this.scheds[y][m][d]={};}
			this.scheds[y][m][d].start = st;
			this.scheds[y][m][d].end = ed;
		}
		this.loadRoleMonthly();
	}
	//
	adjustMonthView(adj){
		if (adj==-1){
			if (this.tableMonthView.month==0){
				this.tableMonthView.month = 11;
				if (this.tableMonthView.year==1970){
					this.tableMonthView.month = 0;
				}
				else{
					this.tableMonthView.year = this.tableMonthView.year - 1;
				}
			}
			else
			{
				this.tableMonthView.month = this.tableMonthView.month - 1;
			}
			this.loadRoleMonthly();
		}
		else if (adj==1){
			this.tableMonthView.month = this.tableMonthView.month + 1;
			if (this.tableMonthView.month == 12){
				this.tableMonthView.month = 0;
				this.tableMonthView.year = this.tableMonthView.year + 1;
			}
			this.loadRoleMonthly();
		}
	}
	//
	loadRoleMonthly(){
		var monthViewLabel = this.doc.getElementById("monthViewLabel");
		var startT = DateCalc.getTimeYMD(this.tableMonthView.year,this.tableMonthView.month,2);
		var startDate = new DateCalc(startT);
		var d8 = new DateCalc(startT);
		var days = DateCalc.getDaysInMonth(startDate.Year,startDate.Month);
		var datefrom = startDate.toArrayMMDDYYY();
		var dateto = startDate.getDateAfterDays(days).toArrayMMDDYYY();
		monthViewLabel.innerHTML = startDate.Year+"<br>"+this.monthsName[this.tableMonthView.month];
		var tab = this.doc.getElementById("empSchedTable");
		//
		while (tab.firstChild) {
    		tab.removeChild(tab.firstChild);
		}
		//
		var headerTR = this.doc.createElement("tr");
		var empTR = this.doc.createElement("tr");
		tab.appendChild(headerTR);
		tab.appendChild(empTR);
		for (var d=1;d<=days;d++){
			var cell = this.doc.createElement("th");
			cell.innerHTML = this.monthsName[d8.Month].substring(0,3) + " " + d + " " + d8.Year + "<br>" + this.daysName[d8.Day];
			headerTR.appendChild(cell);
			//
			//this.scheds[y][m][d].start = st;
			//this.scheds[y][m][d].end = st;
			cell = this.doc.createElement("th");
			cell.innerHTML = "-";
			if (this.scheds[d8.Year]!=null && this.scheds[d8.Year][d8.Month]!=null &&  this.scheds[d8.Year][d8.Month][d]!=null){
				cell.innerHTML = this.getStartToEndAMPM(this.scheds[d8.Year][d8.Month][d].start,this.scheds[d8.Year][d8.Month][d].end);
			}
			empTR.appendChild(cell)
			//
			d8.nextDay();
		}
		//
	}
	//
	getStartToEndAMPM(start,end){
		var sth = Number(start.substring(0,2));
		var stm = Number(start.substring(3,5));
		var enh = Number(end.substring(0,2));
		var enm = Number(end.substring(3,5));
		var st1 = (sth<13?sth:sth-12);
		var en1 = (enh<13?enh:enh-12);
		var st = (st1==0?12:st1)+(stm==0?"":(":"+(stm<10?"0":"")+stm))+""+(sth<12?"AM":"PM"); 
		var en = (en1==0?12:en1)+(enm==0?"":(":"+(enm<10?"0":"")+enm))+""+(enh<12?"AM":"PM");
		return st+" - "+en;
	}
	//
}

