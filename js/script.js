$(document).ready(onLoad);

function onLoad(){
	$("#registerDialog").dialog({autoOpen: false, position: ["right","top"]});
	$("#loginDialog").dialog({autoOpen: false, position: ["right","top"]});
}

function rdialog(){
	if($("#registerDialog").is(":visible")){
		$("#registerDialog").dialog('close');
	}else{
		$("#registerDialog").dialog('open');
	}
}

function ldialog(){
	if($("#loginDialog").is(":visible")){
		$("#loginDialog").dialog('close');
	}else{
		$("#loginDialog").dialog('open');
	}
}

function logout(){
	document.cookie = encodeURIComponent("username") + "=deleted; expires=" + new Date(0).toUTCString();
	document.cookie = encodeURIComponent("password") + "=deleted; expires=" + new Date(0).toUTCString();
	location.reload();
}