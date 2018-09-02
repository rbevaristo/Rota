//
class ScheduleManagerHTML{
	constructor(doc,scheduler){
		this.doc = doc;
		this.scheduler = scheduler;
		this.empTable = doc.getElementById('LeftTable'); 
		this.schedTable = doc.getElementById('RightTable'); 
		this.headerTable = doc.getElementById('TopTable'); 
		this.tableMonthView = {year:2018,month:6};
		this.currentRoleView = null;
		this.pattern1 = /^.*[0-9a-zA-Z]+.*$/;
		this.empLastTab = 0;
		this.roleLastTab = 0;
		this.shiftDeletePar = null;
		this.shiftDelete = null;
		this.shiftSelect = null;
		this.shiftsList = [];
		//
		this.empSelectedTab = null;
		this.empList = [];
		this.roleList = [];
		this.tableMouseX = 0;
		this.tableMouseY = 0;
		//
		this.headerWindowI = -1;
		this.headerWindowSL = 0;
		this.generationcopy = null;
		this.headerCurrent = null;
		this.headerCurrentDayBefore = null;
		this.headerType = 1;
		this.empCurrent = null;
	}
	//
	Initialize(){
		var doc = this.doc;
		var diz = this;
		var scheduler = this.scheduler;
		//hide
		var managerInfo = doc.getElementById("managerInfo");
		this.changeClass(managerInfo,"ishidden",true);
		this.changeClass(this.doc.getElementById("headerWindow"),"ishidden",true);
		//managerInfo.style["display"] = 'none';
		//
		this.tableMonthView = {year:scheduler.currentDate.Year,month:scheduler.currentDate.Month}
		//buttons
		var monthLeft = doc.getElementById("monthLeft");
		var monthRight = doc.getElementById("monthRight");
		var roleLeft = doc.getElementById("roleLeft");
		var roleRight = doc.getElementById("roleRight");
		var empManagerBtn = doc.getElementById("empManagerBtn");
		var roleManagerBtn = doc.getElementById("roleManagerBtn");
		(['rmClose','emClose']).forEach(function(item,index){
			doc.getElementById(item).onclick = function(){diz.showManager('');diz.loadRoleMonthly(diz.doc.getElementById("BottomTableWrap").scrollLeft);};
		});
		//
		var b = doc.createElement("BUTTON");
		b.className = "deleteBtn1";
		b.innerHTML = "&times;"
		this.shiftDelete = b;
		//
		var empManagerBtns = this.idify(['empListBtn','empInfoBtn','empAddBtn']);
		var empManagerDivs = this.idify(['empList','empInfo','empAdd']);
		var empManagerLoads = ["loadempList","loadempInfo","loadaddEmp"];
		empManagerBtns.forEach(function(ob,index){
			ob.onclick = function(){
				if (index==1 && !diz.empSelectedTab){return;}
				diz.showManagerTab(ob,empManagerDivs[index],empManagerBtns,empManagerDivs,empManagerLoads[index]);};
		});
		empManagerBtns[0].click();
		var roleManagerBtns = this.idify(['roleListBtn','roleInfoBtn','roleAddBtn']);
		var roleManagerDivs = this.idify(['roleList','roleInfo','roleAdd']);
		var roleManagerLoads = ["loadroleList","loadroleInfo","loadaddRole"];
		roleManagerBtns.forEach(function(ob,index){
			ob.onclick = function(){
				if (index==1 && !diz.roleSelectedTab){return;}
				diz.showManagerTab(ob,roleManagerDivs[index],roleManagerBtns,roleManagerDivs,roleManagerLoads[index]);};
		});
		roleManagerBtns[0].click();
		this.blockedTab(empManagerBtns[1],true);
		this.blockedTab(roleManagerBtns[1],true);
		//cliks
		doc.getElementById("empAdd_add").onclick = function(){diz.addEmpBtnClick();};
		doc.getElementById("empInfo_updatename").onclick = function(){diz.empupdateName()};
		doc.getElementById("roleAdd_add").onclick = function(){diz.addRoleBtnClick();};
		doc.getElementById("roleInfo_addShiftButton").onclick = function(){diz.addShiftBtnClick()};
		doc.getElementById("roleInfo_updateShiftButton").onclick = function(){diz.updateShiftBtnClick()};
		doc.getElementById("roleInfo_generateScheduleButton").onclick = function(){diz.generateScheduleBtnClick()};
		this.shiftDelete.onclick = function(){diz.deleteShiftBtnClick()};
		//events
		this.tableEventAttachments();
		this.empInfoEventAttachments();
		this.roleInfoEventAttachments();
		this.managerTableEventAttachments();
		this.searchempList(doc.getElementById("empList_search"));
		//object.addEventListener("click", myScript);
		monthLeft.onclick  = function(){diz.adjustMonthView(-1);};
		monthRight.onclick = function(){diz.adjustMonthView( 1);};
		roleLeft.onclick  = function(){diz.viewPrevRole();};
		roleRight.onclick = function(){diz.viewNextRole();};
		empManagerBtn.onclick = function(){diz.showManager("EmployeeManagerTab");
		diz.showManagerTab( empManagerBtns[ diz.empLastTab], empManagerDivs[ diz.empLastTab], empManagerBtns, empManagerDivs, empManagerLoads[ diz.empLastTab]);};
		roleManagerBtn.onclick = function(){diz.showManager("RoleManagerTab");   
		diz.showManagerTab(roleManagerBtns[diz.roleLastTab],roleManagerDivs[diz.roleLastTab],roleManagerBtns,roleManagerDivs,roleManagerLoads[diz.roleLastTab]);};
		//animations :/
		this.inputAnims();
	}
	//
	viewPrevRole(){
		var sc = this.scheduler;
		var rul = sc.getRole(this.currentRoleView);
		var i = sc.roles.indexOf(rul)-1;
		if (i==-1){
			i = sc.roles.length-1;
		}
		this.changeRoleView(sc.roles[i].name);
	}
	viewNextRole(){
		var sc = this.scheduler;
		var rul = sc.getRole(this.currentRoleView);
		var i = sc.roles.indexOf(rul)+1;
		if (i==sc.roles.length){
			i = 0;
		}
		this.changeRoleView(sc.roles[i].name);
	}
	//
	loadempList(){
		this.empLastTab = 0;
		var doc = this.doc;
		var list = doc.getElementById("empList_emps");
		var searchBtn = this.doc.getElementById("empList_search");
		while (list.firstChild) {
    		list.removeChild(list.firstChild);
		}
		searchBtn.value = "";
		this.triggerInput(searchBtn);
		this.empList = [];
		var emps = this.scheduler.employees.slice();
		emps.sort(function(a,b) {return (a.lname.toLowerCase() > b.lname.toLowerCase()) ? 1 : ((b.lname.toLowerCase() > a.lname.toLowerCase()) ? -1 :    
			(a.fname.toLowerCase() > b.fname.toLowerCase()) ? 1 : ((b.fname.toLowerCase() > a.fname.toLowerCase()) ? -1 : 0)     );} ); 
		for (var i=0;i<emps.length;i++){
			this.setEmpBtn(emps,i,list);
		}
	}
	//
	setEmpBtn(emps,i,list){
		var diz = this;
		var doc = this.doc;
		var emp = emps[i];
		var ebtn = doc.createElement("button");  
		ebtn.innerHTML = emp.LNcFN;
		list.appendChild(ebtn)
		ebtn.onclick = function(){
			diz.selectEmpTab(emp);
		}
		this.empList.push({"emp":emp,"btn":ebtn,shown:true,i:i});		
	}
	//
	selectEmpTab(emp){
		this.empSelectedTab = emp;
		var btn = this.doc.getElementById("empInfoBtn");
		this.changeClass(btn,"tabBtnBlocked",false);
		btn.click();
	}
	//
	searchempList(ele){
		var diz = this;
		var list = this.doc.getElementById("empList_emps");
		ele.addEventListener("input",function(){
			var filter = ele.value.toLowerCase();
			var el = diz.empList;
			for (var i=0;i<el.length;i++){
				if (el[i].shown && !(el[i].emp.LNcFN.toLowerCase()).includes(filter)){
					el[i].shown = false;
					list.removeChild(el[i].btn);
				}
				else if (!el[i].shown && (el[i].emp.LNcFN.toLowerCase()).includes(filter)){
					el[i].shown = true;
					if (i==el.length-1){
						list.appendChild(el[i].btn);
					}
					else
					{
						var bt = null;
						for (var x=i+1;x<el.length;x++){
							if (el[x].shown){
								bt = el[x].btn;
								break;
							}
						}
						list.insertBefore(el[i].btn,bt);
					}
				}
			}
		});
	}
	//
	loadempInfo(){
		this.empLastTab = 1;
		var doc = this.doc;
		var emp = this.empSelectedTab;
		var lname = doc.getElementById("empInfo_lname");
		var fname = doc.getElementById("empInfo_fname");
		var rolen = doc.getElementById("empInfo_role");
		lname.value = emp.lname?emp.lname:"";
		fname.value = emp.fname?emp.fname:"";
		rolen.value = emp.role?emp.role:"";
		this.triggerInput(lname);
		this.triggerInput(fname);
		this.triggerInput(rolen);
		doc.getElementById("empInfo_activeButton").checked = emp.active;
		doc.getElementById("empInfo_preferredDayoff").value = ""+emp.preferredDayoff;

	}
	//
	empupdateName(){
		var emp = this.empSelectedTab;
		if (!emp)
		{
			this.msg("error");
			return;
		}
		var doc = this.doc;
		var lname = doc.getElementById("empInfo_lname").value;
		var fname = doc.getElementById("empInfo_fname").value;
		if (lname.length>0 && lname.match(this.pattern1) && fname.length>0 && fname.match(this.pattern1)){
			emp.lname = lname;
			emp.fname = fname;
			this.msg("Name Updated");
		}
		else
		{
			this.msg("name error");
			// ??
		}
	}
	//
	empInfoEventAttachments(){
		var doc = this.doc;
		var diz = this;
		var activeBtn = doc.getElementById("empInfo_activeButton");
		var dayoffBtn  = doc.getElementById("empInfo_preferredDayoff");
		activeBtn.onclick = function(){
			if (diz.empSelectedTab){
				diz.empSelectedTab.active = activeBtn.checked;
			}
		}
		dayoffBtn.onchange = function(){
			if (diz.empSelectedTab){
				diz.empSelectedTab.preferredDayoff = Number(dayoffBtn.value);
				console.log(diz.empSelectedTab.preferredDayoff);
			}
		}
	}
	//
	loadaddEmp(){
		this.empLastTab = 2;
	}
	//
	addEmpBtnClick(){
		var doc = this.doc;
		var lname = doc.getElementById("empAdd_lname");
		var fname = doc.getElementById("empAdd_fname");
		var rolen = doc.getElementById("empAdd_role");
		if (lname.value.length==0 || !lname.value.match(this.pattern1)
		|| fname.value.length==0 || !fname.value.match(this.pattern1)
		|| rolen.value.length==0 || !rolen.value.match(this.pattern1)){
			this.msg("input error");
			return;
		}
		var emp = scheduler.addEmployee(fname.value?fname.value:"",lname.value?lname.value:"",rolen.value);
		lname.value="";
		fname.value="";
		rolen.value="";
		this.triggerInput(lname);
		this.triggerInput(fname);
		this.triggerInput(rolen);
		this.selectEmpTab(emp);
	}
	//
	loadroleList(){
		this.roleLastTab = 0;
		var doc = this.doc;
		var list = doc.getElementById("roleList_roles");
		while (list.firstChild) {
    		list.removeChild(list.firstChild);
		}
		var roles = this.scheduler.roles.slice();
		roles.sort(function(a,b) {return (a.name.toLowerCase() > b.name.toLowerCase()) ? 1 : ((b.name.toLowerCase() > a.name.toLowerCase()) ? -1 :0   );} ); 
		for (var i=0;i<roles.length;i++){
			this.setRoleBtn(roles,i,list);
		}
	}
	//
	setRoleBtn(roles,i,list){
		var diz = this;
		var doc = this.doc;
		var role = roles[i];
		var ebtn = doc.createElement("button");  
		ebtn.innerHTML = role.name;
		list.appendChild(ebtn)
		ebtn.onclick = function(){
			diz.selectRoleTab(role);
		}
	}
	//
	selectRoleTab(role){
		this.roleSelectedTab = role;
		var btn = this.doc.getElementById("roleInfoBtn");
		this.changeClass(btn,"tabBtnBlocked",false);
		btn.click();
	}
	//
	loadroleInfo(){
		this.roleLastTab = 1;
		var doc = this.doc;
		var role = this.roleSelectedTab;
		doc.getElementById("roleInfo_roletitle").innerHTML = "" + role.name;
		for (var i=0;i<6;i++){
			this.changeClass(doc.getElementById("roleInfo_toggle"+i),"active",role.disabledDays.includes(i));
		}
		doc.getElementById("roleInfo_addShiftMin").value = 1;
		doc.getElementById("roleInfo_addShiftMax").value = 1;
		this.loadShiftList(role);
	}
	//
	loadShiftList(role){
		var doc = this.doc;
		var diz = this;
		var shiftcontainer = doc.getElementById("roleInfo_shiftscontainer");
		while (shiftcontainer.childNodes.length > 2) {
    		shiftcontainer.removeChild(shiftcontainer.lastChild);
		}
		this.shiftList = [];
		for (var i=0;i<role.shifts.length;i++){
			var shift = role.shifts[i];
			this.shiftList.push(this.loadshiftRow(i,role,shift));
		}
		shiftcontainer.onmouseleave = function(){
			if (diz.shiftDeletePar){
				diz.shiftDeletePar.removeChild(diz.shiftDelete);
				diz.shiftDeletePar = null;
			}
		}
	}
	//
	loadshiftRow(i,role,shift){
		if (!role){return;}
		var doc = this.doc;
		var diz = this;
		var div = doc.createElement("DIV");  
		div.className = "shiftlistcontainer";
		var shiftcontainer = doc.getElementById("roleInfo_shiftscontainer");
		var from = doc.createElement("INPUT");
		from.className = "shiftlistheader";
		from.type = "time";
		from.style.width = "100px";
		var to = doc.createElement("INPUT");
		to.className = "shiftlistheader";
		to.type = "time";
		to.style.width = "100px";
		var min = doc.createElement("INPUT");
		min.className = "shiftlistheader";
		min.type = "number";
		min.style.width = "40px";
		var max = doc.createElement("INPUT");
		max.className = "shiftlistheader";
		max.type = "number";
		max.style.width = "40px";

		from.value = shift.start;
		to.value = shift.end;
		min.value = shift.defaultMinAssign;
		min.min = "0";
		max.value = shift.defaultMaxAssign;
		max.min = "0";

		div.appendChild(from);
		div.appendChild(to);
		div.appendChild(min);
		div.appendChild(max);
		shiftcontainer.appendChild(div);

		div.onmouseenter = function(){
			if (diz.shiftDeletePar){
				diz.shiftDeletePar.removeChild(diz.shiftDelete);
			}
			diz.shiftDeletePar = div;
			div.appendChild(diz.shiftDelete);
			diz.shiftSelect = i;
		}

		return {"from":from,"to":to,"min":min,"max":max,"i":i};
	}
	//
	addShiftBtnClick(){
		var role = this.roleSelectedTab;
		if (role == null){return;}
		var doc = this.doc;
		var from = doc.getElementById("roleInfo_addShiftFrom");
		var to = doc.getElementById("roleInfo_addShiftTo");
		var min = doc.getElementById("roleInfo_addShiftMin");
		var max = doc.getElementById("roleInfo_addShiftMax");
		if (from.value.length == 0 || to.value.length == 0 || from.value==to.value){
			this.msg("input error");
			return;
		}
		for (var i=0;i<role.shifts.length;i++){
			if (from.value == role.shifts[i].start && to.value == role.shifts[i].end){
				this.msg("duplicate shift");
				return;
			}
		}
		role.addShift(from.value,to.value,Number(min.value),Number(max.value));
		min.value = "1";
		max.value = "1";
		from.value = "";
		to.value = "";
		this.loadShiftList(role);
		this.msg("shift added");
	}
	//
	updateShiftBtnClick(){
		var role = this.roleSelectedTab;
		if (role == null){return;}
		var shifts = role.shifts;
		if (shifts.length != this.shiftList.length){
			this.msg("error");
			return;
		}
		var updated = 0;
		var errors = 0;
		for (var i=0;i<shifts.length;i++){
			var shift = shifts[i];
			var sdata = this.shiftList[i];
			if (sdata.from.value.length == 0 || sdata.to.value.length == 0 || sdata.from.value == sdata.to.value){
				errors = errors + 1;
			}
			else
			{
				if (sdata.from.value != shift.start || sdata.to.value != shift.end || 
					Number(sdata.min.value) != shift.defaultMinAssign || Number(sdata.max.value) != shift.defaultMaxAssign){
					updated = updated + 1;
					shift.start = sdata.from.value;
					shift.end = sdata.to.value;
					shift.defaultMinAssign = Number(sdata.min.value);
					shift.defaultMaxAssign = Number(sdata.max.value);
				}
			}
		}
		this.msg("shifts updated : "+updated+" \ninput errors : "+errors);
	}
	//
	deleteShiftBtnClick(){
		if (this.shiftSelect == null || this.roleSelectedTab == null){return;}
		var role = this.roleSelectedTab;
		role.shifts.splice(this.shiftSelect,1);
		if (this.shiftDeletePar){
			this.shiftDeletePar.removeChild(this.shiftDelete);
			this.shiftDeletePar = null;
		}
		this.shiftSelect = null;
		this.loadShiftList(role);
		this.msg("deleted shift");
	}
	//
	generateScheduleBtnClick(){
		if (this.roleSelectedTab==null){return;}
		var role = this.roleSelectedTab;
		var da = this.doc.getElementById("roleInfo_generateDate");
		var ds = this.doc.getElementById("roleInfo_generateDays").value;
		if (da.value.length == 0){return;}
		var yy = Number(da.value.substring(0,4));
		var mm = Number(da.value.substring(5,7));
		var dd = Number(da.value.substring(8,10));
		var interrupt = role.isScheduleClear(yy,mm-1,dd,ds);
		//console.log(interrupt)
		if (this.scheduler.lockedPast && DateCalc.isPastMDY(mm-1,dd,yy) == -1){
			toastr.error("Pasts schedules are locked.");
			return;
		}
		if (interrupt){
			this.msg("Schedule slots not clear.");
			return;
		}
		this.msg("generating...");
		var results = role.generate([mm-1,dd,yy],ds);
		if (results.msg){
			toastr[results.success?"success":"error"](results.msg);
		}
		this.loadRoleMonthly();
	}
	//
	roleInfoEventAttachments(){
		var doc = this.doc;
		//var fixedBtn = doc.getElementById("roleInfo_fixedButton");
		var diz = this;
		/*fixedBtn.onclick = function(){
			if (diz.roleSelectedTab){
				diz.roleSelectedTab.active = fixedBtn.checked?"Fixed":"Flexible";
				doc.getElementById("roleInfo_dayofftoggle").style["display"] = fixedBtn.checked?'':'none';
			}
		}*/
		for (var i=0;i<7;i++){
			this.roleInfo_toggleBtn(i,doc.getElementById("roleInfo_toggle"+i));
		}
	}
	//
	roleInfo_toggleBtn(i,btn){
		var diz = this;
		btn.onclick = function(){
			var role = diz.roleSelectedTab;
			if (role){
				if (btn.className.includes("active")){
					diz.changeClass(btn,"active",false);
					if (role.disabledDays.includes(i)){
						role.disabledDays.splice(role.disabledDays.indexOf(i),1);
					}
				}
				else{
					diz.changeClass(btn,"active",true);
					role.disabledDays.push(i);
				}
			}
		}
	}
	//
	loadaddRole(){
		this.roleLastTab = 2;
	}
	//
	addRoleBtnClick(){
		var doc = this.doc;
		var name = doc.getElementById("roleAdd_name");
		if (name.value.length==0 || !name.value.match(this.pattern1)){
			this.msg("name error");
			return;
		}
		var role = scheduler.addRole(name.value);
		name.value="";
		this.triggerInput(name);
		this.selectRoleTab(role);
	}
	//
	msg(msg){
		alert(msg);
	}
	//
	blockedTab(ele,iz){
		if (iz){
			this.changeClass(ele,"tabBtnBlocked",true);
		}
		else{
			this.changeClass(ele,"tabBtnBlocked",false);
		}
	}
	//
	inputAnims(){
		var doc = this.doc;
		var inpDivs = doc.getElementsByClassName("labelinput");
		for (var ii=0;ii<inpDivs.length;ii++){
			var inpDiv = inpDivs[ii];
			var pp = null;
			var inp = null;
			for(var i=0;i<inpDiv.childNodes.length;i++) {
				var node = inpDiv.childNodes[i];
				if (node.nodeType == Node.ELEMENT_NODE){
					if (node.tagName == "P"){
						pp = node;
					}
					else if(node.tagName == "INPUT"){
						inp = node;
					}
					if (pp && inp){
						break;
					}
				}
			}
			if (pp && inp){
				this.inputAnim(inpDiv,pp,inp);
			}
		}
	}
	//
	inputAnim(div,pp,inp){
		var diz = this;
		var filling = false;
		inp.addEventListener("input",function(){
			if (inp.value.length > 0 && !filling){
				filling = true;
				diz.changeClass(pp,"active",true);
			}
			else if (inp.value.length == 0 && filling){
				filling = false;
				diz.changeClass(pp,"active",false);
			}
		});
	}
	//
	triggerInput(ele){
		var event = new Event('input', {
		    'bubbles': true,
		    'cancelable': true
		});
		ele.dispatchEvent(event);
	}
	//
	changeClass(ele,clas,tru){
		if (tru && !ele.className.includes(" "+clas)){
			ele.className += (" "+clas);
		}
		else if (!tru){
			ele.className = ele.className.replace(" "+clas,"");
		}
	}
	//
	idify(tab){
		for (var i=0;i<tab.length;i++){
			tab[i] = this.doc.getElementById(tab[i]);
		}
		return tab;
	}
	//
	tableEventAttachments(){
		var doc = this.doc;
		var diz = this;
		var rt = doc.getElementById("BottomTableWrap");
		var tt = doc.getElementById("TopTableWrap");
		var lt = doc.getElementById("LeftTableWrap");
		rt.addEventListener("scroll", function(eve){
			tt.scrollLeft = this.scrollLeft;
			lt.scrollTop = this.scrollTop;
			diz.moveHeaderWindow(diz.headerWindowSL - this.scrollLeft,true);
		});
		var table = doc.getElementById("ManagerTable");
		var diz = this;
		table.addEventListener("mousemove", function(eve){
			diz.tableMouseX = eve.pageX - table.offsetLeft;
			diz.tableMouseY = eve.pageY - table.offsetTop;
			//console.log(diz.tableMouseX,diz.tableMouseY);
		});			
	}
	//
	showManagerTab(btn,tab,otherbtns,othertabs,func){
		for (var i=0;i<othertabs.length;i++){
			othertabs[i].style["display"] = (othertabs[i]==tab)?'':'none';
		}
		for (var i=0;i<otherbtns.length;i++){
			this.changeClass(otherbtns[i],"active",false);
		}
		this.changeClass(btn,"active",true);
		if (func){
			this[func]();
		}
	}
	//
	showManager(tab){
		var doc = this.doc;
		var managerInfo = doc.getElementById("managerInfo");
		if (tab == ""){
			this.changeClass(managerInfo,"ishidden",true);
		}
		else{
			this.changeClass(managerInfo,"ishidden",false);
			for(var i=0;i<managerInfo.childNodes.length;i++) {
				var node = managerInfo.childNodes[i];
				if (node.nodeType == Node.ELEMENT_NODE){
					if (node.id != "shadowBG"){
						if (node.id == tab){
							node.style["display"] = '';
						}
						else
						{
							node.style["display"] = 'none';
						}
					}
				}
			}
		}
	}
	//
	addTR(dom,arr){
		var doc = this.doc;
		var tr = doc.createElement("TR");  
		var tds = [];
	    for (var i = 0; i < arr.length; i++) {
	    	var td = doc.createElement("TD");  
	    	td.innerHTML = arr[i].txt;
	    	if (arr[i].objs){
	    		for (var o=0;o<arr[i].objs.length;o++){
	    			td.appendChild(arr[i].objs[o]);
	    		}
	    	}
	    	if (arr[i].addclass){
	    		td.className += (" " + arr[i].addclass);
	    	}
	    	if (arr[i].onclick){
	    		this.addTRevent(td,arr,i)
	    	}
	    	tds.push(td);
	    	tr.appendChild(td);
	    }
	    dom.appendChild(tr);
	    return tds;
	}
	//
	addTRevent(td,arr,i){
		arr[i].clickParam.td = td;
		td.onclick = function(){arr[i].onclick(arr[i].clickParam)};
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
	loadRoleMonthly(i){
		this.closeHeaderWindow();
		var scheduler = this.scheduler;
		var monthViewLabel = this.doc.getElementById("monthViewLabel");
		var startT = DateCalc.getTimeYMD(this.tableMonthView.year,this.tableMonthView.month,2);
		var startDate = new DateCalc(startT);
		var days = DateCalc.getDaysInMonth(startDate.Year,startDate.Month);
		var datefrom = startDate.toArrayMMDDYYY();
		var dateto = startDate.getDateAfterDays(days).toArrayMMDDYYY();
		monthViewLabel.innerHTML = startDate.Year+"<br>"+ScheduleManager.monthsName[this.tableMonthView.month];
		this.loadRoleTable(this.currentRoleView,datefrom,dateto); // <---------------------
		var bt = this.doc.getElementById("BottomTableWrap");
		if (i){
			bt.scrollLeft = i;
		}
		else if (this.tableMonthView.month == scheduler.currentDate.Month){
			var dateToday = scheduler.currentDate.Date;// 1-31 etc
			bt.scrollLeft = (dateToday-1)*127;
		}
		else{
			bt.scrollLeft = 0;

		}
	}
	//
	changeRoleView(rolename){
		this.currentRoleView = rolename;
		this.generationcopy = null;
		this.doc.getElementById("roleViewLabel").innerHTML = rolename;
		this.loadRoleMonthly(this.doc.getElementById("BottomTableWrap").scrollLeft);
	}
	//
	loadRoleTable(rolename,datefrom,dateto){
		var doc = this.doc;
		var empTable = this.empTable;
		var schedTable = this.schedTable;
		var headerTable = this.headerTable;
		var scheduler = this.scheduler;
		this.currentRoleView = rolename;
		while (empTable.firstChild) {
    		empTable.removeChild(empTable.firstChild);
		}
		while (schedTable.firstChild) {
    		schedTable.removeChild(schedTable.firstChild);
		}
		while (headerTable.firstChild) {
    		headerTable.removeChild(headerTable.firstChild);
		}
		var role = scheduler.getRole(rolename);
		var data = role.getTable(datefrom,dateto); // <-----------------------------------
		//consolle.log(data.data);

		//employee list
		var xy = [];
		for (var i=0;i<data.rows.length;i++){
			var emp = data.rows[i];
			var empName = emp.fname+" "+emp.lname;
			if (!emp.active){
				empName = "<strike>" +empName + "</strike>";
			}
			var row = [{txt:empName}];
			xy.push(row);
		}
		for (var i=0;i<xy.length;i++){
			var eles = this.addTR(empTable,xy[i]);
			eles[0].oncontextmenu=function(){return false;};
		}

		xy = [];
		//time header
		var row = [];
		for (var i=0;i<data.columns.length;i++){
			var exists = !data.columns[i].notexist?true:false;
			var theDay = exists?data.columns[i].MMDDYYY:data.columns[i].mmddyyy;
			var objs = [];
			var scheduledDay = null;
			var generation = null;
			var ig = null;
			if (exists){ // ui bar
				scheduledDay = data.columns[i];
				generation = role.getGenerationGroupYMD(scheduledDay.year,scheduledDay.month,scheduledDay.date);
				ig = generation?generation.scheduledDays.indexOf(scheduledDay):-1;
				var bar = document.createElement("DIV");
				bar.className = "schedheaderbar";
				var ww = "calc(100% - 8px)";
				var ll = "4px";
				objs.push(bar)
				if (generation && generation.scheduledDays.length==1){

				}
				else if (ig == 0){
					ww = "calc(100% - 4px)";
					var bar2 = document.createElement("DIV");
					bar2.className = "schedheaderbar2";
					bar2.style.left = "4px";
					objs.push(bar2);
				}
				else if (generation && ig == generation.scheduledDays.length-1){
					ww = "calc(100% - 4px)";
					ll = "0px";
					var bar2 = document.createElement("DIV");
					bar2.className = "schedheaderbar2";
					bar2.style.right = "4px";
					objs.push(bar2);
				}
				else{
					ww = "calc(100%)";
					ll = "0px";
				}
				bar.style.width = ww;
				bar.style.left = ll;
			}
			var diz = this;
			var headeronclick = function(p){
				//console.log(p.i,p.scheduledDay);
				diz.schedheaderBtnClick(p);
			}
			row.push({txt:theDay,objs:objs,addclass:"schedheaderbutton",onclick:headeronclick,
				clickParam:{i:i,data:data,scheduledDay:scheduledDay,generation:generation,ig:ig}});
		}
		xy.push(row); 
		for (var i=0;i<xy.length;i++){
			this.addTR(headerTable,xy[i]);
		}
		//
		xy = [];
		//data
		for (var e=0;e<data.rows.length;e++){ //y emp
			//name
			var emp = data.rows[e];
			var row = [];
			//data
			for (var d=0;d<data.data[e].length;d++){ //x shifts/days
				var scheduledDay = (typeof data.columns[d] === 'object')?data.columns[d]:null;
				var shifts = data.data[e][d];
				var objs = [];
				var txt = "";
				//add shifts(usually one only)
				for (var s=0;s<shifts.length;s++){
					var shift = role.getShiftById(shifts[s][1],shifts[s][2]);
					txt = txt + shift.StartToEndAMPM;
					if (s<shifts.length){
						txt = txt + "<br>";
					}
				}
				if (shifts.length == 0){
					txt = "-";
				}
				//bar
				if (shifts.length>0){
					var shift = role.getShiftById(shifts[0][1],shifts[0][2]);
					var rr = shift.getRangePercent();
					var bar = document.createElement("DIV");
					var rgb1 = 180-180*rr.l;
					var rgb2 = 255-210*rr.l;
					var rgb3 = 0;
					bar.className = "schedbar";
					bar.style.width = (rr.len*100)+"%";
					bar.style.left = (rr.l*100)+"%";
					bar.style["background-color"] = "rgba("+rgb1+","+rgb2+","+rgb3+",0.6)";
					//fix bar bug at last column
					if (rr.len+rr.l>1 && DateCalc.isEndOfMonthYMD(scheduledDay.year,scheduledDay.month,scheduledDay.date)){
						bar.style.width = ((1-rr.l)*100)+"%";
					}
					objs.push(bar);
				}
				//
				var diz = this;
				var cellonclick = function(p){
					diz.schedcellclick(p);
				}
				row.push({txt:txt,objs:objs,onclick:cellonclick,clickParam:{i:d,e:e,d:d,emp:data.rows[e],scheduledDay:scheduledDay}});
			}
			xy.push(row);
		}

		for (var i=0;i<xy.length;i++){
			this.addTR(schedTable,xy[i]);
		}
	}
	//==============================================================================================================================================================================
	schedcellclick(p){
		//d day
		//e emp[e]
		var diz = this;
		var doc = this.doc;
		var scheduler = this.scheduler;
		var emp = p.emp; 
		var role = scheduler.getRole(diz.currentRoleView);
		var scheduledDay = p.scheduledDay;
		var generation = scheduledDay.notexist?null:(role.getGenerationGroupYMD(p.scheduledDay.year,p.scheduledDay.month,p.scheduledDay.date));
		var ig = generation?generation.scheduledDays.indexOf(scheduledDay):null;
		var shiftsSel = generation?(generation.getEmpShifts(emp)):null;
		//scheduler.employees[p.e].fname
		this.headerWindowSL = p.i*p.td.offsetWidth;
		this.headerWindowI = p.i;
		this.moveHeaderWindow(this.headerWindowSL - this.doc.getElementById("BottomTableWrap").scrollLeft,null,true);
		var shiftExists = null;
		var shift = null;
		if (!scheduledDay.notexist){
			for (var i=0;i<scheduledDay.shifts.length;i++){
				if (scheduledDay.shifts[i].assigned.indexOf(emp) != -1){
					shiftExists = i;
					shift = scheduledDay.shifts[i];
					break;
				}
			}
		}
		doc.getElementById("headerWindow2Info").innerHTML = emp.fname + "<br>" + ScheduleManager.daysName[scheduledDay.dayN]+", "+ScheduleManager.monthsName[scheduledDay.month]+
		" " + scheduledDay.date + ", "+scheduledDay.year + "<br>"+ (shift?shift.StartToEndAMPM:"");

		//
		//console.log(shiftExists);
		this.changeClass(doc.getElementById("headerWindow2DeleteShift"),"ishidden",shiftExists==null);
		this.changeClass(doc.getElementById("headerWindow2EditShift"),"ishidden",shiftExists==null);
		this.changeClass(doc.getElementById("headerWindow2Time1"),"ishidden",shiftExists==null && (shiftExists!=null || scheduledDay.notexist));
		this.changeClass(doc.getElementById("headerWindow2Time2"),"ishidden",shiftExists==null && (shiftExists!=null || scheduledDay.notexist));
		this.changeClass(doc.getElementById("headerWindow2TimeTo"),"ishidden",shiftExists==null && (shiftExists!=null || scheduledDay.notexist));
		this.changeClass(doc.getElementById("headerWindow2SwapShift"),"ishidden",shiftExists==null);
		var dd1 = doc.getElementById("headerWindow2SwapShiftDD");
		var dd2 = doc.getElementById("headerWindow2SwapScheduleDD");
		dd1.style.visibility = shiftExists==null?'hidden':'visible';
		dd2.style.visibility = shiftExists==null?'hidden':'visible';
		this.changeClass(doc.getElementById("headerWindow2SwapSchedule"),"ishidden",shiftExists==null);
		this.changeClass(doc.getElementById("headerWindow2AddShift"),"ishidden",shiftExists!=null || scheduledDay.notexist);
		//
		//load dropdowns
		dd1.innerHTML = "";
		dd2.innerHTML = "";
		if (shiftExists!=null && generation){
			var emz = [];
			for (var i=0;i<scheduler.employees.length;i++){
				if (generation.employees.indexOf(scheduler.employees[i])>=0){
					emz.push(scheduler.employees[i]);
				}
			}
			for (var i=0;i<emz.length;i++){
				var em = emz[i];
				if (em != emp){
					var opt1 = doc.createElement("option");
					opt1.value = ""+em.id;
					opt1.innerHTML = (em.fname?em.fname:"") + " "+(em.lname?em.lname:"");
					dd1.appendChild(opt1);
					var opt2 = doc.createElement("option");
					opt2.value = opt1.value;
					opt2.innerHTML = opt1.innerHTML;
					dd2.appendChild(opt2);
				}
			}
		}
		//
		this.empCurrent = {
			emp:emp,
			role:role,
			scheduledDay:scheduledDay,
			shiftsSel:shiftsSel,
			shift:shift,
			shiftI:shiftExists,
			generation:generation,
			ig:ig
		};


	}
	//
	assignEmpShift(newShift2,oldShift,emp,role,start,end,day){
		var newShift = newShift2;
		if (newShift == null)
		{
			//create
			var min = null;
			var max = null;
			while (!min){
				min = prompt("New Shift: "+role.getStartToEndAMPM(start,end)+"\nEnter minimum required employees.");
				if (min==null){break;}
				if (min==""){min=null;continue;}
				if (isNaN(min) || !Number.isInteger(Number(min))){
					this.msg("Invalid value");
					min = null;
					continue;
				}
				else{
					min = Math.floor(Number(min));
					if (min<1){
						this.msg("minimum must be 1 or above.");
						min = null;
						continue;
					}
				}
			}
			if (min==null){
				this.msg("Canceled.");
				return;
			}
			//
			while (!max){
				max = prompt("New Shift: "+role.getStartToEndAMPM(start,end)+"\nEnter maximum required employees.");
				if (max==null){break;}
				if (max==""){max=null;continue;}
				if (isNaN(max) || !Number.isInteger(Number(max))){
					this.msg("Invalid value");
					min = null;
					continue;
				}
				else{
					max = Math.floor(Number(max));
					if (max<min){
						this.msg("maximum must be "+min+" or above.");
						max = null;
						continue;
					}
				}
			}
			if (max==null){
				this.msg("Canceled.");
				return;
			}
			newShift = day.insertShift(start,end,min,max);
		}
		if (oldShift){
			oldShift.deleteAssign(oldShift.assigned.indexOf(emp));
		}
		role.assignEmp(emp,newShift);
		toastr.success("Assigned to Shift "+newShift.StartToEndAMPM+"<br>"+"Assigned Current : "+newShift.assigned.length+" (min:"+newShift.minAssign+" max:"+newShift.maxAssign+")"+
		(newShift.maxAssign<newShift.assigned.length?("<br>Warning, assigned employees exceeded max slots."):""));
	}
	//
	managerTableEventAttachments(){
		var diz = this;
		var doc = this.doc;
		//
		doc.getElementById("headerWindow2DeleteShift").onclick = function(){
			var e = diz.empCurrent;
			if (diz.scheduler.lockedPast && DateCalc.isPastMDY(e.scheduledDay.month,e.scheduledDay.date,e.scheduledDay.year) == -1){
				toastr.error("Pasts schedules are locked.");
				return;
			}
			if (confirm("Delete this shift?")){
				e.shift.deleteAssign(e.shift.assigned.indexOf(e.emp));
				toastr.success("Deleted shift.");
			}
			diz.loadRoleMonthly(diz.doc.getElementById("BottomTableWrap").scrollLeft);
		}
		//
		doc.getElementById("headerWindow2EditShift").onclick = function(){
			var e = diz.empCurrent;
			if (diz.scheduler.lockedPast && DateCalc.isPastMDY(e.scheduledDay.month,e.scheduledDay.date,e.scheduledDay.year) == -1){
				toastr.error("Pasts schedules are locked.");
				return;
			}
			var inp1 = doc.getElementById("headerWindow2Time1");
			var inp2 = doc.getElementById("headerWindow2Time2");
			if (inp1.value.length==0 || inp2.value.length==0){
				toastr.error("Input not filled.");
				return;
			}
			if (inp1.value==e.shift.start && inp2.value ==e.shift.end){
				toastr.error("Attempted to edit to same shift.");
				return;
			}
			var start = inp1.value;
			var end = inp2.value;
			if (confirm("Change shift from "+e.shift.StartToEndAMPM+" to "+e.shift.getStartToEndAMPM(start,end)+"?")){
				var newShift = e.scheduledDay.shiftExists2(start,end);
				diz.assignEmpShift(newShift,e.shift,e.emp,e.role,start,end,e.scheduledDay);
			}
			diz.loadRoleMonthly(diz.doc.getElementById("BottomTableWrap").scrollLeft);
		}
		//
		doc.getElementById("headerWindow2AddShift").onclick = function(){
			var e = diz.empCurrent;
			if (diz.scheduler.lockedPast && DateCalc.isPastMDY(e.scheduledDay.month,e.scheduledDay.date,e.scheduledDay.year) == -1){
				toastr.error("Pasts schedules are locked.");
				return;
			}
			var inp1 = doc.getElementById("headerWindow2Time1");
			var inp2 = doc.getElementById("headerWindow2Time2");
			if (inp1.value.length==0 || inp2.value.length==0){
				toastr.error("Input not filled.");
				return;
			}
			var start = inp1.value;
			var end = inp2.value;
			if (confirm("Assign shift "+e.role.getStartToEndAMPM(start,end)+"?")){
				var newShift = e.scheduledDay.shiftExists2(start,end);
				diz.assignEmpShift(newShift,null,e.emp,e.role,start,end,e.scheduledDay);
			}
			diz.loadRoleMonthly(diz.doc.getElementById("BottomTableWrap").scrollLeft);
		}
		//
		doc.getElementById("headerWindow2SwapShift").onclick = function(){
			var e = diz.empCurrent;
			if (diz.scheduler.lockedPast && DateCalc.isPastMDY(e.scheduledDay.month,e.scheduledDay.date,e.scheduledDay.year) == -1){
				toastr.error("Pasts schedules are locked.");
				return;
			}
			var dd = doc.getElementById("headerWindow2SwapShiftDD");
			var empS = scheduler.getEmpById(dd.options[dd.selectedIndex].value)
			if (!empS){
				return;
			}
			if (confirm("Swap Shift With "+(empS.fname?empS.fname:"") + " "+(empS.lname?empS.lname:"")+"?")){
				e.generation.swapShift(e.emp,empS,e.ig);
				toastr.success("Swapped shift.");
			}
			diz.loadRoleMonthly(diz.doc.getElementById("BottomTableWrap").scrollLeft);
		}
		//
		doc.getElementById("headerWindow2SwapSchedule").onclick = function(){
			var e = diz.empCurrent;
			var sdf = e.role.getGenerationGroupYMD(e.scheduledDay.year,e.scheduledDay.month,e.scheduledDay.date);
			sdf = sdf?sdf.scheduledDays[0]:null;
			if (sdf && diz.scheduler.lockedPast && DateCalc.isPastMDY(sdf.month,sdf.date,sdf.year) == -1){
				toastr.error("Pasts schedules are locked.");
				return;
			}
			var dd = doc.getElementById("headerWindow2SwapScheduleDD");
			var empS = scheduler.getEmpById(dd.options[dd.selectedIndex].value)
			if (!empS){
				return;
			}
			if (confirm("Swap Schedule With "+(empS.fname?empS.fname:"") + " "+(empS.lname?empS.lname:"")+"?")){
				e.generation.swapSchedGeneration(e.emp,empS,e);
				toastr.success("Swapped schedule.");
			}
			diz.loadRoleMonthly(diz.doc.getElementById("BottomTableWrap").scrollLeft);
		}
		//=================================================================================================================================================================
		//=================================================================================================================================================================
		//=================================================================================================================================================================
		//=================================================================================================================================================================
		doc.getElementById("headerWindowClose").onclick = function(){diz.closeHeaderWindow(); };
		doc.getElementById("headerWindowDeleteDaily").onclick = function(){
			var p = diz.headerCurrent;
			if (diz.scheduler.lockedPast && DateCalc.isPastMDY(p.scheduledDay.month,p.scheduledDay.date,p.scheduledDay.year) == -1){
				toastr.error("Pasts schedules are locked. :(");
				return;
			}
			//console.log(p.scheduledDay,p.generation,p.ig);
			if (confirm('Clear all shifts on '+ScheduleManager.monthsName[p.scheduledDay.month]+" "+p.scheduledDay.date+", "+p.scheduledDay.year+'?\nThis action cannot be undone.')) {
				for (var i=0;i<p.scheduledDay.shifts.length;i++){
					while(p.scheduledDay.shifts[i].assigned.length>0){
						p.scheduledDay.shifts[i].deleteAssign(0);
					}
				}
				toastr.success("Deleted daily schedule.");
			}
			diz.loadRoleMonthly(diz.doc.getElementById("BottomTableWrap").scrollLeft);
		};
		doc.getElementById("headerWindowDeleteGenerated").onclick = function(){
			var p = diz.headerCurrent;
			var gen = p.generation;
			var sdf = gen.scheduledDays[0];
			if (sdf && diz.scheduler.lockedPast && DateCalc.isPastMDY(sdf.month,sdf.date,sdf.year) == -1){
				toastr.error("Pasts schedules are locked.");
				return;
			}
			var il = gen.scheduledDays.length-1
			if (confirm('Delete Schedule?\n'+ScheduleManager.monthsName[gen.scheduledDays[0].month].substring(0,3) + " " + gen.scheduledDays[0].date +" to "+
				ScheduleManager.monthsName[gen.scheduledDays[il].month].substring(0,3) + " " + gen.scheduledDays[il].date+" ("+(il+1)+' day(s))\nThis action cannot be undone.')) {
				diz.closeHeaderWindow();
				var role = diz.scheduler.getRole(diz.currentRoleView);
				if (gen == this.generationcopy){
					this.generationcopy = null;
				}
				role.DeleteGeneration(gen);
				toastr.success("Deleted schedule.");
				diz.loadRoleMonthly(diz.doc.getElementById("BottomTableWrap").scrollLeft);
			}
		};
		doc.getElementById("headerWindowCopyGenerated").onclick = function(){
			var p = diz.headerCurrent;
			diz.generationcopy = p.generation;
			toastr.info("Copied schedule.");
			diz.closeHeaderWindow();
		};
		doc.getElementById("headerWindowPasteGenerated").onclick = function(){
			if (!diz.headerCurrent || !diz.currentRoleView){return;}
			var p = diz.headerCurrent;
			var gen = diz.generationcopy;
			if (diz.scheduler.lockedPast && DateCalc.isPastMDY(p.data.columns[p.i].month,p.data.columns[p.i].date,p.data.columns[p.i].year) == -1){
				toastr.error("Pasts schedules are locked.");
				return;
			}
			var role = diz.scheduler.getRole(diz.currentRoleView);
			var isClear = role.isScheduleClear(p.data.columns[p.i].year,p.data.columns[p.i].month,p.data.columns[p.i].date,gen.scheduledDays.length);
			console.log("wa",isClear);
			var il = gen.scheduledDays.length-1
			var t = new DateCalc( DateCalc.getTimeYMD(p.data.columns[p.i].year,p.data.columns[p.i].month,p.data.columns[p.i].date) + 86400000*(il+1) );
			var mt = t.Month;
			var dt = t.Date;
			var origclonemsg = "Original Generation : "+ScheduleManager.monthsName[gen.scheduledDays[0].month].substring(0,3) + " " + gen.scheduledDays[0].date +" to "+
				ScheduleManager.monthsName[gen.scheduledDays[il].month].substring(0,3) + " " + gen.scheduledDays[il].date+" ("+(il+1)+" day(s))\nClone Generation : "+
				ScheduleManager.monthsName[p.data.columns[p.i].month].substring(0,3)+" "+p.data.columns[p.i].date+" to "+ScheduleManager.monthsName[mt].substring(0,3)+ " "+dt;
			if (isClear==null){
				diz.closeHeaderWindow();
				if (confirm("Clone Schedule?\n"+origclonemsg)){
					role.CloneSchedule(p.data.columns[p.i].year,p.data.columns[p.i].month,p.data.columns[p.i].date,p.data.columns[p.i].day,gen);
					diz.loadRoleMonthly(diz.doc.getElementById("BottomTableWrap").scrollLeft);
				}
			}
			else
			{
				toastr.error("Cannot clone schedule here.<br>"+origclonemsg+"<br>Occupied : "+
				ScheduleManager.monthsName[isClear.month].substring(0,3) + " "+isClear.date);
			}
		};
		doc.getElementById("headerWindowGenerate7").onclick = function(){
			diz.generateSchedule(7,false);
		};
		doc.getElementById("headerWindowGenerate7S").onclick = function(){
			diz.generateSchedule(7,true);
		};
		doc.getElementById("headerWindowGenerate7C").onclick = function(){
			diz.generateSchedule(7,true,true);
		};
	}
	//
	generateSchedule(days,isShuffle,isCriteria){
		var diz = this;
		var p = diz.headerCurrent;			
		var role = diz.scheduler.getRole(diz.currentRoleView);
		var isClear = role.isScheduleClear(p.data.columns[p.i].year,p.data.columns[p.i].month,p.data.columns[p.i].date,days);
		var dateStartT = DateCalc.getTimeYMD(p.data.columns[p.i].year,p.data.columns[p.i].month,p.data.columns[p.i].date);
		var t = new DateCalc( dateStartT + 86400000*days );
		var MDY = (new DateCalc(dateStartT+86400000)).toArrayMMDDYYY();
		var mt = t.Month;
		var dt = t.Date;
		var origclonemsg = "Generate Schedule Date : <br>"+ScheduleManager.monthsName[p.data.columns[p.i].month].substring(0,3)+" "+p.data.columns[p.i].date+" to "+
		ScheduleManager.monthsName[mt].substring(0,3)+ " "+dt+" ("+days+" day(s))";
		if (diz.scheduler.lockedPast && DateCalc.isPastMDY(MDY[0],MDY[1],MDY[2]) == -1){
			toastr.error("Pasts schedules are locked.");
			return;
		}
		if (isClear==null){
			diz.closeHeaderWindow();
			toastr.info("Creating Schedule...<br>"+origclonemsg);
			var oldVal = role.shuffleGenerate;
			if (isShuffle){
				role.shuffleGenerate = 1;
			}
			if (isCriteria){
				role.criteriaGenerate = 1;
			}
			var results = role.generate(MDY,days);
			role.criteriaGenerate = 0;

			if (results.msg){
				toastr[results.success?"success":"error"](results.msg);
			}
			role.shuffleGenerate = oldVal;
			diz.loadRoleMonthly(diz.doc.getElementById("BottomTableWrap").scrollLeft);
		}
		else{
			toastr.error("Cannot generate schedule here.<br>"+origclonemsg+"<br>Occupied : "+
			ScheduleManager.monthsName[isClear.month].substring(0,3) + " "+isClear.date);
		}
		diz.closeHeaderWindow();
	}
	//====================================================================================================================================================================================
	schedheaderBtnClick(p){
		var hwindow = this.doc.getElementById("headerWindow");
		var hwidth = hwindow.offsetWidth;
		var mtable = this.doc.getElementById("ManagerTable");
		var mwidth = mtable.offsetWidth;
		//
		var role = this.scheduler.getRole(this.currentRoleView);
		var daybefore = new DateCalc(DateCalc.getTimeYMD(p.data.columns[p.i].year,p.data.columns[p.i].month,p.data.columns[p.i].date));
		daybefore = role.findDailyScheduleYMD(daybefore.Year,daybefore.Month,daybefore.Date);
		this.headerCurrentDayBefore = daybefore;
		//
		var dbz = this.scheduler.dbcriteria;
		var cbtn = p.scheduledDay!=null || (!(dbz.age == 1 || dbz.gender == 1 || dbz.name == 1))
		//
		this.changeClass(this.doc.getElementById("headerWindowDeleteDaily"),"ishidden",p.scheduledDay==null);
		this.changeClass(this.doc.getElementById("headerWindowDeleteGenerated"),"ishidden",p.scheduledDay==null);
		this.changeClass(this.doc.getElementById("headerWindowCopyGenerated"),"ishidden",p.scheduledDay==null);
		//this.changeClass(this.doc.getElementById("headerWindowSavePDF"),"ishidden",p.scheduledDay==null);
		this.changeClass(this.doc.getElementById("headerWindowGenerate7"),"ishidden",p.scheduledDay!=null);
		this.changeClass(this.doc.getElementById("headerWindowGenerate7S"),"ishidden",p.scheduledDay!=null);
		this.changeClass(this.doc.getElementById("headerWindowGenerate7C"),"ishidden",cbtn);
		this.changeClass(this.doc.getElementById("headerWindowPasteGenerated"),"ishidden",!this.generationcopy || p.scheduledDay!=null);
		this.headerCurrent = p;
		//
		this.headerWindowSL = p.i*p.td.offsetWidth;
		this.headerWindowI = p.i;
		this.moveHeaderWindow(this.headerWindowSL - this.doc.getElementById("BottomTableWrap").scrollLeft,null,false);
		var info = this.doc.getElementById("headerWindowInfo");
		if (p.scheduledDay){
			//hwindow.style.top  = this.tableMouseY+"px";
			info.innerHTML = "Day : "+ScheduleManager.monthsName[p.scheduledDay.month]+" "+p.scheduledDay.date+", "+p.scheduledDay.year+"<br>"+"Generation : ";
			var il = p.generation.scheduledDays.length-1
			info.innerHTML += ScheduleManager.monthsName[p.generation.scheduledDays[0].month].substring(0,3) + " " + p.generation.scheduledDays[0].date +" to "+
			ScheduleManager.monthsName[p.generation.scheduledDays[il].month].substring(0,3) + " " + p.generation.scheduledDays[il].date;
		}
		else{
			var datacol = p.data.columns[p.i];
			info.innerHTML = "Day : "+ScheduleManager.monthsName[datacol.month]+" "+datacol.date+", "+datacol.year+"<br>"+"Generation : -";
		}
	}
	//
	moveHeaderWindow(xp,scrolin,is2){
		if (this.headerWindowI == -1){return;}
		if (is2==false){
			this.headerType = 1;
		}
		else if (is2==true){
			this.headerType = 2;
		}
		var xpos = xp+117; //leftcolumnwid
		var hwindow = this.doc.getElementById("headerWindow");
		this.changeClass(hwindow,"ishidden",false);
		this.changeClass(this.doc.getElementById("headerWindow1"),"ishidden",this.headerType==2);
		this.changeClass(this.doc.getElementById("headerWindow2"),"ishidden",this.headerType==1);
		var hwidth = hwindow.offsetWidth;
		var mtable = this.doc.getElementById("ManagerTable");
		var mwidth = mtable.offsetWidth;
		if (xpos > mwidth-hwidth){
			xpos = mwidth-hwidth;
			if (scrolin){	
				this.closeHeaderWindow();
				return;
			}
		}
		if (xpos < 114 && scrolin){		

			this.closeHeaderWindow();
			return;
		}
		else if (xpos < 114){
			xpos = 117;
		}
		hwindow.style.left = xpos+"px";
	}
	//
	closeHeaderWindow(){
		this.headerWindowI = -1;
		this.headerCurrent = null;
		this.empCurrent = null;
		var hwindow = this.doc.getElementById("headerWindow");
		this.changeClass(hwindow,"ishidden",true);
	}
}