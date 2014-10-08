

function createDropdownHTML(l, v, d, tableideditable, indexOfDropdown, numbered){
	var ans = '<select onchange="changeOption(this.value, '+"'"+tableideditable+"', '"+indexOfDropdown+"', "+numbered+')" class="form-control">';
	for(var i = 0; i < l.length; i++){
		if(v[i]){
			if(i == d) ans += '<option selected="true" value="'+ l[i]+'">'+l[i]+'</option>';
			else ans += '<option value="'+ l[i]+'">'+l[i]+'</option>';
		}
	}
	ans += '</select>';
	return ans;
}

var dropdown = [];
var dropdownValid = [];

function editTable(tableid, editbtn, editable, tableideditable, array, numbered,colEdit){
	setConfirmUnload(true);
	if(typeof(colEdit)==='undefined') colEdit = 0;
	if(typeof(numbered)==='undefined') numbered = 1;
	var indexOfDropdown = tableid;
	dropdown[indexOfDropdown] = array;
	var temp = [];
	for(var i = 0; i < array.length; i++){
		temp.push(true);
	}
	dropdownValid[tableid] = temp;
	
	$('#'+editbtn).css('display','none');
	$('#'+tableid).css('display','none');
	$('#'+editable).css('display','block');
	var original = document.getElementById(tableid).innerHTML;
	var columns = document.getElementById(tableid).rows[0].cells.length;
	var rows = document.getElementById(tableid).rows.length;
	document.getElementById(tableideditable).innerHTML = original;

	for(var i = numbered; i < columns; i++){
		var option = document.getElementById(tableideditable).rows[0].cells[i].innerHTML;
		for(var j = 0; j < dropdown[indexOfDropdown].length; j++){
			if(dropdown[indexOfDropdown][j].trim() == option.trim()){
				dropdownValid[indexOfDropdown][j] = false;
				break;
			}
		}
	}

	for(var i = 1; i < rows; ++i){
		//document.getElementById(tableideditable).rows[i].cells[0].style.width = "20px";
		for(var j = numbered; j < columns;j++){
			var value = document.getElementById(tableid).rows[i].cells[j].innerHTML;
			document.getElementById(tableideditable).rows[i].cells[j].innerHTML =
			'<input class="form-control" type="text" value="'+value+'">'
		}
	}
	var columnInsertBtn = '';
	if(numbered == 1) columnInsertBtn = '<td></th>';

	for(var i = numbered; i < columns; i++){
		columnInsertBtn += '<td><button id="0" class="btn btn-xs" onclick="removeCol('+i+', '+"'"+tableideditable+"', '"+indexOfDropdown+"', "+numbered+')"><icon class="fa fa-times"></button><button id="1" class="btn btn-xs" onclick="addCol('+i+', '+"'"+tableideditable+"', '"+indexOfDropdown+"', "+numbered+')"><icon class="fa fa-plus"></button></th>';
	}
	document.getElementById(tableideditable).insertRow(0);
	document.getElementById(tableideditable).rows[0].innerHTML = columnInsertBtn;
	
	document.getElementById(tableideditable).rows[1].innerHTML += '<td style="width:10px;"><button id="1" class="btn btn-xs" onclick="addRow('+1+', '+"'"+tableideditable+"', "+numbered+')"><icon class="fa fa-plus"></button></th>';

	for(var i = 2; i < rows+1; i++){
		temp = document.getElementById(tableideditable).rows[i].innerHTML;
		temp = temp + '<td style="width:10px;"><button class="btn btn-xs" onclick="removeRow('+i+', '+"'"+tableideditable+"', "+numbered+')"><icon class="fa fa-times"></button><button id="1" class="btn btn-xs" onclick="addRow('+i+', '+"'"+tableideditable+"', "+numbered+')"><icon class="fa fa-plus"></button></th>';
		document.getElementById(tableideditable).rows[i].innerHTML = temp;
	}

	

	var columns = document.getElementById(tableideditable).rows[0].cells.length;
	for(var i = numbered; i < columns; i++){
		var value = document.getElementById(tableideditable).rows[1].cells[i].innerHTML;
		var index = dropdown[indexOfDropdown].indexOf(value.trim());
		dropdownValid[indexOfDropdown][index] = true;
		$('#'+tableideditable+' tr:eq(1) td:eq('+i+')').html(createDropdownHTML(dropdown[indexOfDropdown], dropdownValid[indexOfDropdown], index, tableideditable, indexOfDropdown, numbered));
		dropdownValid[indexOfDropdown][index] = false;
	}
	if(colEdit==0)
		$('#'+tableideditable+' tr:first').hide();

}

function removeRow(rowno, tableideditable, numbered){
	document.getElementById(tableideditable).deleteRow(rowno);
	
	var columns = document.getElementById(tableideditable).rows[0].cells.length;
	var rows = document.getElementById(tableideditable).rows.length;
	for(var i = rowno; i < rows;i++){
		var tempcol = document.getElementById(tableideditable).rows[i].cells.length;
		if(numbered == 1) document.getElementById(tableideditable).rows[i].cells[0].innerHTML = (i-1).toString();
		//document.getElementById(tableideditable).rows[i].deleteCell(tempcol-1);
		document.getElementById(tableideditable).rows[i].cells[tempcol-1].innerHTML = '<td style="width:10px;"><button class="btn btn-xs" onclick="removeRow('+i+', '+"'"+tableideditable+"', "+numbered+')"><icon class="fa fa-times"></button><button id="1" class="btn btn-xs" onclick="addRow('+i+', '+"'"+tableideditable+"', "+numbered+')"><icon class="fa fa-plus"></button></th>';
	}

}

function changeOption(t, tableideditable, indexOfDropdown, numbered){
	var columns = document.getElementById(tableideditable).rows[0].cells.length;
	for(var i = 0; i < dropdown[indexOfDropdown].length; i++){
		dropdownValid[indexOfDropdown][i] = true;
	}
	$('#'+tableideditable+' tr:eq(1) select').each(function(ind){
		var index = dropdown[indexOfDropdown].indexOf($(this).val());
		dropdownValid[indexOfDropdown][index] = false;
	});
	for(var i = numbered; i < columns; i++){
		$('#'+tableideditable+' tr:eq(1) td:eq('+i+') select').each(function(ind){
			var index = dropdown[indexOfDropdown].indexOf($(this).val());
			dropdownValid[indexOfDropdown][index] = true;
			$('#'+tableideditable+' tr:eq(1) td:eq('+i+')').html(createDropdownHTML(dropdown[indexOfDropdown], dropdownValid[indexOfDropdown], index, tableideditable, indexOfDropdown, numbered));
			dropdownValid[indexOfDropdown][index] = false;
		});
	}
}

function refreshDropdowns(tableideditable, indexOfDropdown, numbered){
	var columns = document.getElementById(tableideditable).rows[0].cells.length;
	for(var i = numbered; i < columns; i++){
		$('#'+tableideditable+' tr:eq(1) td:eq('+i+') select').each(function(ind){
			var index = dropdown[indexOfDropdown].indexOf($(this).val());
			dropdownValid[indexOfDropdown][index] = true;
			$('#'+tableideditable+' tr:eq(1) td:eq('+i+')').html(createDropdownHTML(dropdown[indexOfDropdown], dropdownValid[indexOfDropdown], index, tableideditable, indexOfDropdown, numbered));
			dropdownValid[indexOfDropdown][index] = false;
		});
	}
}

function addRow(rowno, tableideditable, numbered){
	document.getElementById(tableideditable).insertRow(rowno+1);
	document.getElementById(tableideditable).rows[rowno+1].innerHTML = document.getElementById(tableideditable).rows[rowno].innerHTML;
	var rows = document.getElementById(tableideditable).rows.length;
	var columns = document.getElementById(tableideditable).rows[rowno].cells.length;
	for(var j = numbered; j < columns-1;j++){
			document.getElementById(tableideditable).rows[rowno+1].cells[j].innerHTML =
			'<input class="form-control" type="text" id="input-'+j+'-1">'
		}
	for(var i = rowno+1; i < rows;i++){
		var tempcol = document.getElementById(tableideditable).rows[i].cells.length;
		if(numbered == 1) document.getElementById(tableideditable).rows[i].cells[0].innerHTML = (i-1).toString();
		//document.getElementById(tableideditable).rows[i].deleteCell(tempcol-1);
		//document.getElementById(tableideditable).rows[i].insertCell(tempcol-1).
		document.getElementById(tableideditable).rows[i].cells[tempcol-1].innerHTML = '<td style="width:10px;"><button class="btn btn-xs" onclick="removeRow('+i+', '+"'"+tableideditable+"', "+numbered+')"><icon class="fa fa-times"></button><button id="1" class="btn btn-xs" onclick="addRow('+i+', '+"'"+tableideditable+"', "+numbered+')"><icon class="fa fa-plus"></button></th>';
	}
}

function removeCol(colno, tableideditable, indexOfDropdown, numbered){
	var columns = document.getElementById(tableideditable).rows[0].cells.length;
	if(columns == (dropdown[indexOfDropdown].length+1)) $('#'+tableideditable+' tr:first #1').show();
	var rows = document.getElementById(tableideditable).rows.length;
	var val = $('#'+tableideditable+' tr:eq(1) td:eq('+colno+') select:first').val();
	for(var i = 0; i < dropdown[indexOfDropdown].length; i++){
		if(dropdown[indexOfDropdown][i].trim() == val.trim()) dropdownValid[indexOfDropdown][i] = true;
	}
	for(var i = 0; i < rows; i++){
		document.getElementById(tableideditable).rows[i].deleteCell(colno);
	}
	var columns = document.getElementById(tableideditable).rows[1].cells.length;
	for(var i = numbered; i < columns; i++){
		document.getElementById(tableideditable).rows[0].cells[i].innerHTML=
		'<button id="0" class="btn btn-xs" onclick="removeCol('+i+', '+"'"+tableideditable+"', '"+indexOfDropdown+"', "+numbered+')"><icon class="fa fa-times"></button><button id="1" class="btn btn-xs" onclick="addCol('+i+', '+"'"+tableideditable+"', '"+indexOfDropdown+"', "+numbered+')"><icon class="fa fa-plus"></button>';
	}
	refreshDropdowns(tableideditable, indexOfDropdown, numbered);

}





function addCol(colno, tableideditable, indexOfDropdown, numbered){
	colno++;
	var rows = document.getElementById(tableideditable).rows.length;

	for(var i = 0; i < rows; i++){
		document.getElementById(tableideditable).rows[i].insertCell(colno);
		if(i==0){
			document.getElementById(tableideditable).rows[i].cells[colno].innerHTML=
			'<button id="0" class="btn btn-xs" onclick="removeCol('+colno+', '+"'"+tableideditable+"', '"+indexOfDropdown+"', "+numbered+')"><icon class="fa fa-times"></button><button id="1" class="btn btn-xs" onclick="addCol('+colno+', '+"'"+tableideditable+"', '"+indexOfDropdown+"', "+numbered+')"><icon class="fa fa-plus"></button>';
		}
		else if(i==1){
			document.getElementById(tableideditable).rows[i].cells[colno].innerHTML=
			createDropdownHTML(dropdown[indexOfDropdown], dropdownValid[indexOfDropdown], -1, tableideditable, indexOfDropdown, numbered);
		}
		else document.getElementById(tableideditable).rows[i].cells[colno].innerHTML= '<input class="form-control" type="text" value="">';
	}

	var val = $('#'+tableideditable+' tr:eq(1) td:eq('+colno+') select:first').val();
	for(var i = 0; i < dropdown[indexOfDropdown].length; i++){
		if(dropdown[indexOfDropdown][i].trim() == val.trim()) dropdownValid[indexOfDropdown][i] = false;
	}

	var columns = document.getElementById(tableideditable).rows[0].cells.length;
	for(var i = numbered; i < columns; i++){
		document.getElementById(tableideditable).rows[0].cells[i].innerHTML=
		'<button id="0" class="btn btn-xs" onclick="removeCol('+i+', '+"'"+tableideditable+"', '"+indexOfDropdown+"', "+numbered+')"><icon class="fa fa-times"></button><button id="1" class="btn btn-xs" onclick="addCol('+i+', '+"'"+tableideditable+"', '"+indexOfDropdown+"', "+numbered+')"><icon class="fa fa-plus"></button>';
	}
	if(columns == (dropdown[indexOfDropdown].length+1)) $('#'+tableideditable+' tr:first #1').hide();
	refreshDropdowns(tableideditable, indexOfDropdown, numbered);
}

function saveTable(tableid, editbtn, editable, tableideditable, numbered){
	if(typeof(numbered)==='undefined') numbered = 1;
	$('#'+editbtn).css('display','table');
	$('#'+tableid).css('display','table');
	$('#'+editable).css('display','none');
	var newhtml = document.getElementById(tableideditable).innerHTML;
	document.getElementById(tableid).innerHTML = document.getElementById(tableideditable).innerHTML;
	document.getElementById(tableid).deleteRow(0);
	var columns = document.getElementById(tableideditable).rows[0].cells.length;
	var rows = document.getElementById(tableideditable).rows.length;
	for(var i = numbered; i < columns; i++){
		var value = $('#'+tableideditable+' tr:eq(1) td:eq('+i+') select:first').val();
		document.getElementById(tableid).rows[0].cells[i].innerHTML = value;
	}
	for(var i = 0; i < rows-1; i++){
		document.getElementById(tableid).rows[i].deleteCell(columns);
		if(i==0);
		else for(var j = numbered; j < columns; j++){
			var value = document.getElementById(tableideditable).rows[i+1].cells[j].getElementsByTagName('input')[0].value;
			document.getElementById(tableid).rows[i].cells[j].innerHTML = value;
		}
	}
	$('#'+tableid+' tr:first').css('font-weight', 'bold');
	delete dropdown[tableid];
	delete dropdownValid[tableid];
}

function cancelTable(tableid, editbtn, editable, tableideditable){
	if(typeof(numbered)==='undefined') numbered = 1;
	delete dropdown[tableid];
	delete dropdownValid[tableid];
	$('#'+editbtn).css('display','table');
	$('#'+tableid).css('display','table');
	$('#'+editable).css('display','none');
}