<link href='http://fonts.googleapis.com/css?family=Julee' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Orbitron:400,700' rel='stylesheet' type='text/css'>
<script>

var xToDo = {
	listenToKeys: function(el,e) {
		if(e.keyCode === 13){
			ask = el.value;
			if(ask != '' && ask != null && ask != 'null'){
				el.value = '';
				//due_date	= Ext.get('new-todo-date');
				assign_to 	=  Ext.get('new-todo-assign_to');
				  
				ume.msg('Adding ToDo:',assign_to.getValue(),ask);
				$.post('/{$toBackDoor}/{$Xtra}/create/?json',{
					to_do	: ask,
					//date_due: due_date.getValue(),
					assigned_to: assign_to.getValue()
				},function(data){
					var $json 	= $.parseJSON(data);
					var $todo 	= $('#menu-todo-list-items');
					var $td ;
					var $html;
					var $tmp; 
					$todo.load('/{$toBackDoor}/{$Xtra}/todos?html',{},function(){
						 
					});
				});	
				due_date.setValue();
				assign_to.setValue()
			}	
		}
	},
	EDITING		: false,
	DELETING	: false,
	LOADED_LIST : null,
	NEW_LIST	: null, 
	deleteTask	: function(id){
		this.DELETING = true;
		// var yes = confirm('Are You Sure You Want to Erase this Task?');
		Ext.get('task-'+id).fadeOut('fast');
		
		$.post('/{$toBackDoor}/{$Xtra}/deleteTask/?json',{
			id	: id
		},function(json){
			xToDo.DELETING = false;
		});

		$('#todo-postit').fadeOut();
	},		
	loadToDos	: function(fn){
    	/*
		if(!this.EDITING){
    	var stop_loading = false;
		$('#menu-todo-list-items li input:checkbox').each(function(i,el){
			if(el.checked){
				stop_loading = true;
			}
		});
		if(!stop_loading){
			$('#todo-jar').load('/{$toBackDoor}/toDo?html',{},fn);
			var count = $('#menu-todo-list-items li').length;
			$('#menu-todo-count').html(count);	
		}
	}
    	*/
	},
	taskDetails	: function(id,save){
		this.EDITING = true;

		$('#todo-postit').fadeIn();
		
		if(save == true){
			this.saveDetails($('#todo-details-form-'+id),id);

			$('#todo-postit').fadeOut();
		}else{
			$('#todo-postit').load('/{$toBackDoor}/{$Xtra}/details/'+id+'/?html');
		}
		
	},
	saveDetails	: function(form,id){
		// Save this form!
		$.post('/{$toBackDoor}/{$Xtra}/saveDetails/?json',$(form).serialize(),function(data){
			var $json = $.parseJSON(data);
			var $json = $json.data;

			if(xToDo.EDITING){	
				xToDo.EDITING = false;
				xToDo.loadToDos();	
			}else{
				alert('To-Do Saved: "'+$json.new_to_do+'"');
			}

			if($json.assigned_to_id != -1 && !xToDo.DELETING){
				if($json.assigned_to_id == $json.old_assigned_to_id){
					var yes = confirm('Task "'+$json.new_to_do+'" has already been assigned to this person, Click OK to Send a reminder.');
					if(yes){
						$.post('/{$toBackDoor}/{$Xtra}/sendReminder/?json',{
							id		: $json.to_do_id,
							user	: $json.assigned_to_id
						});
					}
				}else{
					$.post('/{$toBackDoor}/{$Xtra}/sendReminder/?json',{
						id		: $json.to_do_id,
						user	: $json.assigned_to_id
					});
				}
			}
		});
		return false;
		// Remove the details from the task menu.
		// Alert Success
	},
	newTask		: function(success){
		success = (success) ? 'Success! Add Another, ' : success;
		var ask = prompt('What To-Do?');
		// Save Task!
		if(ask != '' && ask != null && ask != 'null'){
			$.post('/{$toBackDoor}/{$Xtra}/create/?json',{
				to_do	: ask
			},function(data){
				var $json 	= $.parseJSON(data);
				var $todo 	= $('#menu-todo-list-items');
				var $td ;
				var $html;
				var $tmp;
				

				//$('#menu-todo-count').html($json.to_dos.length);
				$todo.load('/{$toBackDoor}/{$toSideDoor}/{$Xtra}/todos',{},function(){
					xToDo.newTask(true);
				});
			});	
		}		
	},

	bulkDone	: function (){
		var yes = confirm('Are you sure you want to mark all checked as done?');
		if(yes){
			$('#menu-todo-list-items li input:checkbox').each(function(i,el){
				if(el.checked){
					xToDo.markDone(el.id.replace('todo-',''));
				}
			});
		}
	},
	bulkDelete	: function (){
		var yes = confirm('Are you sure you want to DELETE ALL checked?');
		if(yes){
			$('#menu-todo-list-items li input:checkbox').each(function(i,el){
				if(el.checked){
					xToDo.deleteTask(el.id.replace('todo-',''));
				}
			});
		}
	},
	
	confirmDone	: function(id){
		var yes = confirm('Mark this task as Done?');
		if(yes){
			xToDo.markDone(id);
		}
	},

	selectAll	: function (){
		$('#menu-todo-list-items li input:checkbox').each(function(i,el){
			el.checked = (el.checked) ? false : true ; 
		});
	},
	
	markDone	: function(id){
		$.post('/{$toBackDoor}/{$Xtra}/markDone/?json',{
			id	: id
		},function(data){
			var $json 	= $.parseJSON(data);
			$('#task-'+$json.markedDone).fadeOut('fast');

			var count = Math.floor($('#menu-todo-count').html());
			count = Math.floor(count - 1);
			$('#menu-todo-count').html(count);
		});

		$('#todo-postit').fadeOut();
	},

	assign	: function (){
		var win = Ext.getCmp('assign-task-win');
		if(!win){
			win = new Ext.Window({
				id		: 'assign-task-win',
				width	: 300,
				autoHeight: true,
				modal	: true,
				title	: 'Who would you like to assign the task to?',
				items	: [new Ext.form.FormPanel({
					layout	: 'form',
					frame	: true,
					buttonAlign	: 'center',
					buttons	: [{
						text	: 'Assign Task',
						iconCls	: 'x-icon-16x16-user_go',
						handler	: function(){
							Ext.Msg.wait('Assigning Tasks','Please Wait...');
							var time = Ext.getCmp('new_task_due_date').getRawValue();
							
							$('#menu-todo-list-items li input:checkbox').each(function(i,el){
								if(el.checked){
									var id = el.id.replace('todo-','');
									var user = Ext.getCmp('assign-to-user').getValue();
									
									$.post('/{$toBackDoor}/{$Xtra}/assignTask/?json',{
										id			: id,
										user		: user,
										date_due	: time 
									},function(data){
										var $json 	= $.parseJSON(data);
										if($json.data.assigned){
											var task = $json.data.assigned[0].to_do;
											var yes = confirm('Task "'+task+'" has already been assigned to this person, Click OK to Send a reminder.');
											if(yes){
												$.post('/{$toBackDoor}/{$Xtra}/sendReminder/?json',{
													id	: id,
													user	: user
												});
											}
										}else{
											$.post('/{$toBackDoor}/{$Xtra}/sendReminder/?json',{
												id		: id,
												user	: user
											});
										}										
									});
								}
							});				

							Ext.Msg.alert('Success','Task(s) have been assigned');
							win.close();
						},
					}],
					items	: [new Ext.form.ComboBox({  
					    fieldLabel: 'Assign To',
					    id	: 'assign-to-user',  
					    store: new Ext.data.JsonStore({  
					    	url: '/{$toBackDoor}/{$Xtra}/getAdmins/?json',
					    	root: 'admins', 
					        fields : [{
						        name: 'id'
							},{
								name: 'username'
							}]  
					    }),  
					    valueField: 'id',  
					    displayField: 'username',
					    //emptyText: 'Leave Blank for None',  
					    //hiddenName: 'active_id',  
					    mode	: 'remote',  
					    minChars : 0,
					    anchor	: '95%'  
					}),{
						xtype	: 'datefield',
						name	: 'due_date',
						minValue: new Date(),
						anchor	: '95%',
						format	: 'Y/m/d',
						id		: 'new_task_due_date',
						fieldLabel: 'Goal Date (*Optional)'
						
					}]
				})]
			});
		}

		var checks = $('#menu-todo-list-items li input:checkbox');

		var is_checked = 0;
		checks.each(function(i,el){
			if(el.checked){
				is_checked++;
			}
		});
		
		if(is_checked){
			win.show();
		}else{
			alert('Please select a task to assign first.');	
		}
	}
};


$(function(){
	var updateOrder = function(area){
		var serial = $('#menu-todo-list-items').sortable('serialize');
		 $.post('/{$toBackDoor}/{$Xtra}/updateOrder/?'+serial);
	};
			
	$("#menu-todo-list-items").sortable({
		update: function(event, ui) {
			 updateOrder('urgent');
		} 
	});
});

</script>

<div class="day-calendar">
	Today
	<div class="current-date"> 		
		<span class="month">{date('F')}</span>
		<span class="day">{date('j')}</span><br/>
		{date('l')}
	</div>
</div>

<div class="pencil">
	<label class="" >
		<span style="padding: 15px 25px 0 0 "/>Erase Been-Dones</span>
		
		<button class="eraser">
		</button>
		<div class="eraser-grip"></div>
		<div class="eraser-grip"></div>
	</label> 
	<label class="" style="float: left;" >
		<button class="coal">
		</button>   
		<span style="padding: 15px 25px 0 0 "/>Write Task</span>
	</label> 
	
	
	<div class="coal"></div>
</div>

<div id="digitalClock"></div>
<section class="notepad">
    <div class="notepad-heading">
      <h1>Notepad</h1>
    </div>


	<div class="todos"> 
		<form id="new-todo">
			<input type="date" class="todo" onkeyup="xToDo.listenToKeys(this,event)" style="float: left; margin: 0; padding: 0 width: 9%"/> 
			<input type="textfield"  id="new-todo-assign_to" class="assign" name="assign_to">  
			<input type="textfield" class="todo" onkeyup="xToDo.listenToKeys(this,event)" style="padding-left: 10px;"/>
		</form>
		<ul  id="menu-todo-list-items"  >

			{include file="{$Door}/{$Xtra}/todos.html"} 
		</ul>	
	</div>
  </section>


 
	
<script>
var element = document.getElementById('menu-todo-list-items');
element.onselectstart = function () { return false; } // ie
element.onmousedown = function () { return false; } // mozilla
</script>
<style type="text/css">
	

html, body, div, span, applet, object, iframe,
h1, h2, h3, h4, h5, h6, p, blockquote, pre,
a, abbr, acronym, address, big, cite, code,
del, dfn, em, img, ins, kbd, q, s, samp,
small, strike, strong, sub, sup, tt, var,
b, u, i, center,
dl, dt, dd, ol, ul, li,
fieldset, form, label, legend,
table, caption, tbody, tfoot, thead, tr, th, td,
article, aside, canvas, details, embed,
figure, figcaption, footer, header, hgroup,
menu, nav, output, ruby, section, summary,
time, mark, audio, video {
  margin: 0;
  padding: 0;
  border: 0;
  font-size: 100%;
  font: inherit;
  vertical-align: baseline;
}

article, aside, details, figcaption, figure,
footer, header, hgroup, menu, nav, section {
  display: block;
}

body {
  line-height: 1;
}

ol, ul {
  list-style: none;
}

blockquote, q {
  quotes: none;
}

blockquote:before, blockquote:after,
q:before, q:after {
  content: '';
  content: none;
}

table {
  border-collapse: collapse;
  border-spacing: 0;
}

.about {
  margin: 70px auto 40px;
  padding: 8px;
  width: 260px;
  font: 10px/18px 'Lucida Grande', Arial, sans-serif;
  color: #666;
  text-align: center;
  text-shadow: 0 1px rgba(255, 255, 255, 0.25);
  background: #eee;
  background: rgba(250, 250, 250, 0.8);
  border-radius: 4px;
  background-image: -webkit-linear-gradient(top, rgba(0, 0, 0, 0), rgba(0, 0, 0, 0.1));
  background-image: -moz-linear-gradient(top, rgba(0, 0, 0, 0), rgba(0, 0, 0, 0.1));
  background-image: -o-linear-gradient(top, rgba(0, 0, 0, 0), rgba(0, 0, 0, 0.1));
  background-image: linear-gradient(to bottom, rgba(0, 0, 0, 0), rgba(0, 0, 0, 0.1));
  -webkit-box-shadow: inset 0 1px rgba(255, 255, 255, 0.3), inset 0 0 0 1px rgba(255, 255, 255, 0.1), 0 0 6px rgba(0, 0, 0, 0.2);
  box-shadow: inset 0 1px rgba(255, 255, 255, 0.3), inset 0 0 0 1px rgba(255, 255, 255, 0.1), 0 0 6px rgba(0, 0, 0, 0.2);
}
.about a {
  color: #333;
  text-decoration: none;
  border-radius: 2px;
  -webkit-transition: background 0.1s;
  -moz-transition: background 0.1s;
  -o-transition: background 0.1s;
  transition: background 0.1s;
}
.about a:hover {
  text-decoration: none;
  background: #fafafa;
  background: rgba(255, 255, 255, 0.7);
}

.about-links {
  height: 30px;
}
.about-links > a {
  float: left;
  width: 50%;
  line-height: 30px;
  font-size: 12px;
}

.about-author {
  margin-top: 5px;
}
.about-author > a {
  padding: 1px 3px;
  margin: 0 -1px;
}

/*
 * Copyright (c) 2012-2013 Thibaut Courouble
 * http://www.cssflow.com
 *
 * Licensed under the MIT License:
 * http://www.opensource.org/licenses/mit-license.php
 */
/*
 * Note: I didn't use borders because WebKit extends shadows underneath them, creating
 * inconsistencies with other browsers. When the border is semi-transparent, as this
 * snippet requires, it appears darker because of the shadow underneath it.
 */
body {
  font: 12px/20px 'Lucida Grande', Verdana, sans-serif;
  color: #404040;
  background: #3782b0;
}

.notepad, .notepad:before, .notepad:after {
	background-color    : white;
	background-image    : -webkit-linear-gradient(#f6abca 1px, transparent 1px), -webkit-linear-gradient(#f6abca 1px, transparent 1px), -webkit-linear-gradient(#e8e8e8 1px, transparent 1px), webkit-linear-gradient(#f6abca 1px, transparent 1px), -webkit-linear-gradient(#f6abca 1px, transparent 1px),;
	background-image    : -moz-linear-gradient(#f6abca 1px, transparent 1px), -moz-linear-gradient(#f6abca 1px, transparent 1px), -moz-linear-gradient(#e8e8e8 1px, transparent 1px);
	background-image    : -o-linear-gradient(#f6abca 1px, transparent 1px), -o-linear-gradient(#f6abca 1px, transparent 1px), -o-linear-gradient(#e8e8e8 1px, transparent 1px);
	background-image    : linear-gradient(#f6abca 1px, transparent 1px), linear-gradient(#f6abca 1px, transparent 1px), linear-gradient(#e8e8e8 1px, transparent 1px), linear-gradient(#f6abca 1px, transparent 1px), linear-gradient(#f6abca 1px, transparent 1px);
	background-size     : 1px 1px, 1px 1px, 23px 23px, 1px 1px, 1px 1px;
	background-repeat   : repeat-y, repeat-y, repeat, repeat-y, repeat-y;
	background-position : 1.25in 0, 1.3in 0, 0 50px, calc(100% - 1.25in) 0, calc(100% - 1.29in) 0;
	border-radius       : 2px;
	-webkit-box-shadow  : 0 0 0 1px rgba(0, 0, 0, 0.15), 0 0 4px rgba(0, 0, 0, 0.5);
	box-shadow          : 0 0 0 1px rgba(0, 0, 0, 0.15), 0 0 4px rgba(0, 0, 0, 0.5);
}

.notepad {
	position    : relative;
	margin      : 60px auto;
	padding     : 0 23px 14px 35px;
	width       : 80%;
	height      : 60%;
	line-height : 23px;
	font-size   : 11px;
	color       : #666;
}
.notepad p, .notepad blockquote {
  margin-bottom: 23px;
}
.notepad :last-child {
  margin-bottom: 0;
}
.notepad:before, .notepad:after {
	content         : '';
	position        : absolute;
	z-index         : -1;
	top             : 100%;
	left            : 3px;
	right           : 3px;
	margin-top      : -2px;
	height          : 4px;
	background-size : 1px 1px, 1px 1px, 0 0;
}
.notepad:before {
	z-index          : -2;
	left             : 6px;
	right            : 6px;
	height           : 6px;
	background-color : #eee;
}

.notepad-heading {
  position: relative;
  margin: 0 -23px 14px -35px;
  height: 38px;
  background: #14466a;
  border-radius: 2px 2px 0 0;
  background-image: -webkit-linear-gradient(top, #226797, #0c3452);
  background-image: -moz-linear-gradient(top, #226797, #0c3452);
  background-image: -o-linear-gradient(top, #226797, #0c3452);
  background-image: linear-gradient(to bottom, #226797, #0c3452);
  -webkit-box-shadow: inset 0 1px #2f81ad, 0 2px 1px rgba(0, 0, 0, 0.4), 0 0 0 1px rgba(0, 0, 0, 0.5), 0 1px black;
  box-shadow: inset 0 1px #2f81ad, 0 2px 1px rgba(0, 0, 0, 0.4), 0 0 0 1px rgba(0, 0, 0, 0.5), 0 1px black;
}
.notepad-heading > h1 {
  line-height: 36px;
  font-size: 14px;
  color: white;
  text-align: center;
  text-shadow: 0 -1px rgba(0, 0, 0, 0.7);
}
.notepad-heading:before, .notepad-heading:after {
  content: '';
  position: absolute;
  bottom: 2px;
  left: 1px;
  right: 1px;
  height: 0;
  border-top: 1px dashed #617c90;
  border-color: rgba(255, 255, 255, 0.35);
}
.notepad-heading:after {
  bottom: 3px;
  border-color: #071c2c;
  border-color: rgba(0, 0, 0, 0.5);
}

	.clipboard{
		margin-top            : 60px;
		border                : 2px outset brown;
		width                 : 75%;
		max-width             : 600px;
		height                : 90%; 
		-moz-border-radius    : 10px;
		-webkit-border-radius : 10px;
		background            : rgb(137,92,5); /* Old browsers */
		background            : -moz-linear-gradient(left, rgba(137,92,5,1) 0%, rgba(229,157,1,1) 48%, rgba(137,92,5,1) 100%); /* FF3.6+ */
		background            : -webkit-gradient(linear, left top, right top, color-stop(0%,rgba(137,92,5,1)), color-stop(48%,rgba(229,157,1,1)), color-stop(100%,rgba(137,92,5,1))); /* Chrome,Safari4+ */
		background            : -webkit-linear-gradient(left, rgba(137,92,5,1) 0%,rgba(229,157,1,1) 48%,rgba(137,92,5,1) 100%); /* Chrome10+,Safari5.1+ */
		background            : -o-linear-gradient(left, rgba(137,92,5,1) 0%,rgba(229,157,1,1) 48%,rgba(137,92,5,1) 100%); /* Opera11.10+ */
		background            : -ms-linear-gradient(left, rgba(137,92,5,1) 0%,rgba(229,157,1,1) 48%,rgba(137,92,5,1) 100%); /* IE10+ */
		filter                : progid:DXImageTransform.Microsoft.gradient( startColorstr='#4b8021', endColorstr='#4b8021',GradientType=1 ); /* IE6-9 */
		background            : linear-gradient(left, rgba(137,92,5,1) 0%,red 48%,rgba(137,92,5,1) 100%); /* W3C */
		position              : realtive;
		padding               : 25px;
		-webkit-box-shadow    : 5px 5px 30px rgba(0,0,0,0.5)
	}

	.clip{
		background: rgb(200,200,200); /* Old browsers */
		background: -moz-linear-gradient(bottom, rgba(200,200,200,1) 0%, rgba(150,150,150,1) 48%, rgba(255,255,255,1) 100%); /* FF3.6+ */
		background: -webkit-gradient(linear, left top, right top, color-stop(0%,rgba(200,200,200,1)), color-stop(48%,rgba(150,150,150,1)), color-stop(100%,rgba(200,200,200,1))); /* Chrome,Safari4+ */
		background: -webkit-linear-gradient(bottom, rgba(200,200,200,1) 0%,rgba(150,150,150,1) 48%,rgba(255,255,255,1) 100%); /* Chrome10+,Safari5.1+ */
		background: -o-linear-gradient(bottom, rgba(200,200,200,1) 0%,rgba(150,150,150,1) 48%,rgba(255,255,255,1) 100%); /* Opera11.10+ */
		background: -ms-linear-gradient(bottom, rgba(200,200,200,1) 0%,rgba(150,150,150,1) 48%,rgba(255,255,255,1) 100%); /* IE10+ */
		filter	: progid:DXImageTransform.Microsoft.gradient( startColorstr='#4b8021', endColorstr='#4b8021',GradientType=1 ); /* IE6-9 */
		background: linear-gradient(bottom, rgba(200,200,200,1) 0%,rgba(150,150,150,1) 48%,rgba(255,255,255,1) 100%); /* W3C */
		width	: 40%;
		height	: 120px;	
		
		-moz-border-radius: 10px;
		-webkit-border-radius: 10px;
		-webkit-box-shadow: 0 0  1px rgba(0,0,0,0.5);
		position: absolute; 
		margin-top: -110px;
		margin-left	: 30%;
		z-index: 100;
		font-size: 20px;
		text-align: center;
		display: table-cell;
		vertical-align: middle;
		font-size: 25px;
		color: white; 
	}
	
	.pencil{
		background-color: yellow;
		width: 80%;
		height: 25px;
		display: block;
		text-align: right;
		color	: #583b03;
		font-family: impact;
		font-size: 10px;
		z-index	: 100;
		box-shadow		: 0px 2px 4px rgba(0,0,0,0.5); 
		margin-top: -30px;  
		 padding	: 0 15px 0 0;
		 text-align: center;
		 vertical-align: center;
		background: rgb(241,218,54); /* Old browsers */
background: -moz-linear-gradient(top,  rgba(241,218,54,1) 0%, rgba(241,218,54,1) 16%, rgba(252,246,191,1) 25%, rgba(241,218,54,1) 36%, rgba(241,218,54,1) 64%, rgba(252,246,191,1) 75%, rgba(239,222,110,1) 84%, rgba(241,218,54,1) 96%, rgba(241,218,54,1) 100%); /* FF3.6+ */
background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,rgba(241,218,54,1)), color-stop(16%,rgba(241,218,54,1)), color-stop(25%,rgba(252,246,191,1)), color-stop(36%,rgba(241,218,54,1)), color-stop(64%,rgba(241,218,54,1)), color-stop(75%,rgba(252,246,191,1)), color-stop(84%,rgba(239,222,110,1)), color-stop(96%,rgba(241,218,54,1)), color-stop(100%,rgba(241,218,54,1))); /* Chrome,Safari4+ */
background: -webkit-linear-gradient(top,  rgba(241,218,54,1) 0%,rgba(241,218,54,1) 16%,rgba(252,246,191,1) 25%,rgba(241,218,54,1) 36%,rgba(241,218,54,1) 64%,rgba(252,246,191,1) 75%,rgba(239,222,110,1) 84%,rgba(241,218,54,1) 96%,rgba(241,218,54,1) 100%); /* Chrome10+,Safari5.1+ */
background: -o-linear-gradient(top,  rgba(241,218,54,1) 0%,rgba(241,218,54,1) 16%,rgba(252,246,191,1) 25%,rgba(241,218,54,1) 36%,rgba(241,218,54,1) 64%,rgba(252,246,191,1) 75%,rgba(239,222,110,1) 84%,rgba(241,218,54,1) 96%,rgba(241,218,54,1) 100%); /* Opera 11.10+ */
background: -ms-linear-gradient(top,  rgba(241,218,54,1) 0%,rgba(241,218,54,1) 16%,rgba(252,246,191,1) 25%,rgba(241,218,54,1) 36%,rgba(241,218,54,1) 64%,rgba(252,246,191,1) 75%,rgba(239,222,110,1) 84%,rgba(241,218,54,1) 96%,rgba(241,218,54,1) 100%); /* IE10+ */
background: linear-gradient(top,  rgba(241,218,54,1) 0%,rgba(241,218,54,1) 16%,rgba(252,246,191,1) 25%,rgba(241,218,54,1) 36%,rgba(241,218,54,1) 64%,rgba(252,246,191,1) 75%,rgba(239,222,110,1) 84%,rgba(241,218,54,1) 96%,rgba(241,218,54,1) 100%); /* W3C */
filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#f1da36', endColorstr='#f1da36',GradientType=0 ); /* IE6-9 */
border: 1px outset yellow;
		-moz-border-radius: 10px;
		-webkit-border-radius: 10px;
		 
	}
	
	.coal{ 
		width: 0px;
		height: 0px; 
		margin-left: -20px;
		border: 2px solid black 2px solid yellow 2px solid blue 2px solid white;
		-webkit-border-radius: 100px;
		 background-color: black;
		 border-color: gray;
	}
	
	.eraser:hover{
		border-color: pink;
	}
	
	.eraser{
		background-color: pink;
		width: 15px;
		height: 25px;
		display: block;
		float: right;
		border-color: pink; 
		border-size: 0;
		-webkit-border-radius: 0 5px 5px 0;
		-webkit-box-shadow: 3px 0  4px rgba(0,0,0,0.25);
		margin-right: -25px;
		 
		
	} 
	
	.eraser-grip{
		background: rgb(200,200,200); /* Old browsers */
		background: -moz-linear-gradient(
			bottom, rgba(200,200,200,1) 0%, rgba(150,150,150,1) 48%, rgba(255,255,255,1) 100%
		); /* FF3.6+ */
		background: -webkit-gradient(
			linear, left top, right top, color-stop(0%,rgba(200,200,200,1)), color-stop(48%,rgba(150,150,150,1)), color-stop(100%,rgba(200,200,200,1))); /* Chrome,Safari4+ */
		background: -webkit-linear-gradient(bottom, rgba(200,200,200,1) 0%,rgba(150,150,150,1) 48%,rgba(255,255,255,1) 100%); /* Chrome10+,Safari5.1+ */
		background: -o-linear-gradient(bottom, rgba(200,200,200,1) 0%,rgba(150,150,150,1) 48%,rgba(255,255,255,1) 100%); /* Opera11.10+ */
		background: -ms-linear-gradient(bottom, rgba(200,200,200,1) 0%,rgba(150,150,150,1) 48%,rgba(255,255,255,1) 100%); /* IE10+ */
		filter	: progid:DXImageTransform.Microsoft.gradient( startColorstr='#4b8021', endColorstr='#4b8021',GradientType=1 ); /* IE6-9 */
		
		background: linear-gradient(bottom, rgba(200,200,200,1) 0%,rgba(150,150,150,1) 48%,rgba(255,255,255,1) 100%); /* W3C */
		float: right;
		width: 3px;
		border: 1px solid gray;
		height: 25px;
		
		-webkit-box-shadow: 0px 0  1px rgba(0,0,0,0.25);
	}
	
	.paper{
		
		-webkit-border-radius	: 5 5 1px rgba(0,0,0,0.5);
		z-index					: 50; 
		position				: relative;  
		-moz-border-radius		: 1px;
		-webkit-border-radius	: 1px;
		background-color		: #f9fffe;
		width					: 95%;
		height					: 90%;
		margin-top	: 50px;
		-webkit-box-shadow		: 3px 1px 1px rgba(0,0,0,0.5);
		display					: block; 
		border-left	: 15px dotted rgba(137,92,5,1) ;
		color	: #2C2C58;
		border-right : 4px solid #ccc;
		
		border-bottom: 4px solid #ccc ;
		
		border-top	: 1px solid white ;
		 
		border-right	: 2px solid #ccc;
	}
	.content{
	
	
		margin: 0;
		margin-top: 100px;
		width: 100%;
		border-top: 1px solid rgba(0,0,250,0.25)
	
	}
	
	.v-line{
		left: 14%;
		position: absolute;
		width: 1px;
		height: 100%;
		background-color: transparent;
		background-color	: rgba(255,0,0,0.5);
		z-index: 0;
		}
	.v-line-right{
		margin-left: 85%;
		position: absolute;
		width: 1px;
		height: 100%;
		background-color: rgba(255,0,0,0.1);
		z-index: 0;
		
	
	}
	
	#digitalClock{
		border		:2px outset #efefef;
		padding		: 5px;
		text-align	: center;
		width		: 120px;
		margin		: 10px;
		font-size	: 30px;
		border-radius: 5px; 
		box-shadow	: 0px 0px 20px rgba(155,155,155,.15);
		 
		color		: rgba(105,135,42,.65);
		text-shadow	: 3px 4px 0px rgba(55,85,0,.25);
		font-family	: Orbitron;
		font-weight: 700;
		background: rgb(205,235,142); /* Old browsers */
background: -moz-radial-gradient(center, ellipse cover,  rgba(205,235,142,1) 0%, rgba(165,201,86,1) 100%); /* FF3.6+ */
background: -webkit-gradient(radial, center center, 0px, center center, 100%, color-stop(0%,rgba(205,235,142,1)), color-stop(100%,rgba(165,201,86,1))); /* Chrome,Safari4+ */
background: -webkit-radial-gradient(center, ellipse cover,  rgba(205,235,142,1) 0%,rgba(165,201,86,1) 100%); /* Chrome10+,Safari5.1+ */
background: -o-radial-gradient(center, ellipse cover,  rgba(205,235,142,1) 0%,rgba(165,201,86,1) 100%); /* Opera 12+ */
background: -ms-radial-gradient(center, ellipse cover,  rgba(205,235,142,1) 0%,rgba(165,201,86,1) 100%); /* IE10+ */
background: radial-gradient(center, ellipse cover,  rgba(205,235,142,1) 0%,rgba(165,201,86,1) 100%); /* W3C */
filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#cdeb8e', endColorstr='#a5c956',GradientType=1 ); /* IE6-9 fallback on horizontal gradient */

	}
	
	.point{
		position:relative;
		-moz-animation: mymove 1s ease infinite;
		-webkit-animation:mymove 1s ease infinite;
	}
	
	/* Simple Animation */
		@-webkit-keyframes mymove 
		{
			0% {
				opacity:1.0;
			}
			50% {
				opacity:0; 
			}
			100% {
				opacity:1.0; 
			}	
		}
		
		@-moz-keyframes mymove 
		{
			0% { opacity:1.0;}
			50% { opacity:0; }
			100% { opacity:1.0;}	
		}
	
	.day-calendar{
		font-size     :18px;
		font-weight   : bold;
		color         : white;
		background    : darkred;
		text-align    : center;
		width         : 200px;
		padding       : 10px 2px 2px 2px;
		border        : 1px outset #8ea6a2;
		border-right  : 3px outset #8ea6a2;
		border-bottom : 4px outset #8ea6a2;
		border-radius : 3px;
		position      : absolute;
		left          : 10px;
		bottom        : 15px;
		z-index       : 100;
		box-shadow    : 0px 2px 5px rgba(150,150,150,.5);
		background    : rgb(216,224,222); /* Old browsers */
		background    : -moz-linear-gradient(-45deg,  rgba(216,224,222,1) 0%, rgba(174,191,188,1) 22%, rgba(153,175,171,1) 33%, rgba(142,166,162,1) 50%, rgba(130,157,152,1) 67%, rgba(78,92,90,1) 82%, rgba(14,14,14,1) 100%); /* FF3.6+ */
		background    : -webkit-gradient(linear, left top, right bottom, color-stop(0%,rgba(216,224,222,1)), color-stop(22%,rgba(174,191,188,1)), color-stop(33%,rgba(153,175,171,1)), color-stop(50%,rgba(142,166,162,1)), color-stop(67%,rgba(130,157,152,1)), color-stop(82%,rgba(78,92,90,1)), color-stop(100%,rgba(14,14,14,1))); /* Chrome,Safari4+ */
		background    : -webkit-linear-gradient(-45deg,  rgba(216,224,222,1) 0%,rgba(174,191,188,1) 22%,rgba(153,175,171,1) 33%,rgba(142,166,162,1) 50%,rgba(130,157,152,1) 67%,rgba(78,92,90,1) 82%,rgba(14,14,14,1) 100%); /* Chrome10+,Safari5.1+ */
		background    : -o-linear-gradient(-45deg,  rgba(216,224,222,1) 0%,rgba(174,191,188,1) 22%,rgba(153,175,171,1) 33%,rgba(142,166,162,1) 50%,rgba(130,157,152,1) 67%,rgba(78,92,90,1) 82%,rgba(14,14,14,1) 100%); /* Opera 11.10+ */
		background    : -ms-linear-gradient(-45deg,  rgba(216,224,222,1) 0%,rgba(174,191,188,1) 22%,rgba(153,175,171,1) 33%,rgba(142,166,162,1) 50%,rgba(130,157,152,1) 67%,rgba(78,92,90,1) 82%,rgba(14,14,14,1) 100%); /* IE10+ */
		background    : linear-gradient(-45deg,  rgba(216,224,222,1) 0%,rgba(174,191,188,1) 22%,rgba(153,175,171,1) 33%,rgba(142,166,162,1) 50%,rgba(130,157,152,1) 67%,rgba(78,92,90,1) 82%,rgba(14,14,14,1) 100%); /* W3C */
		filter        : progid:DXImageTransform.Microsoft.gradient( startColorstr='#d8e0de', endColorstr='#0e0e0e',GradientType=1 ); /* IE6-9 fallback on horizontal gradient */
	
	}
	
	.current-date{
		text-align: center;
		COLOR: #444;
		font-size: 17px;
		margin	: 10px;
		border	: 1px outset #888;
		box-shadow: 0px 2px 10px rgba(150,150,150,.5); 
		background: white;	 
		
		border-radius	: 2px;
		border-bottom: 3px outset #888;
	} 
	
	.current-date .day{
		font-size: 100px;
	
	}
	
	.current-date .month{
		font-size: 25px;
		color	: white;
		background	: #778899;
		margin	: 5px 5px 0px 5px; 
		padding	: 5px;
		width	: auto;
		display	: block;
	}
	
	
	.paperline {
		text-align: left;
		width	: auto;
		height	: 25px;
		border-bottom: 1px solid rgba(0,0,250,0.25); 
		font-family: 'Julee', cursive;
		 font-size	: 15pt;
	}

	.paperline input{
		margin: 0;
		padding: 0
	}
	
	.assign{
		display: inline-block;
		width: 9%; 
		text-align: center; 
		border: 0px;
		margin: 0; 
		background-color: transparent;
		font-weight	: bold; 
		font-family: 'Julee', cursive;
		font-size	: 15pt;
		float: right;
		
		 overflow: hidden;
	}
	
	.when{
		width: 11%;
		float: right;
		text-align: center;
	}
	
	.todo{
		display: inline-block;
		width	: 9%;
		margin: 0; 
		padding: 0;
		height	: 25px;
		border	: 0;
		border: 1px solid transparent;
		background-color: transparent;  
		font-family: 'Julee', cursive;
		 font-size	: 15pt;
		 text-align: left;
		 float: left;
		 overflow: hidden;
	}
	
	.tododue{
		float: right;
		padding-right: 10px;
	}
	 
	
	#todo-postit{
		color	: #2C2C58;
		position: absolute;
		width: 450px;
		height: 300px;
		background-color: #f1ff79;
		z-index: 1000;
		box-shadow: 0px 5px 25px rgba(0,0,0,0.25);
		
		border-radius	: 3px 3px 30px 3px;
		border-bottom	: 2px solid orange;
		padding	: 10px;
		border-color: orange;
		font-weight: bold;
		margin: 15%;
		display: none; 
		 font-size: 15px;
		font-family: 'Julee', cursive;
		background: rgb(254,252,234); /* Old browsers */
background: -moz-radial-gradient(center, ellipse cover,  rgba(254,252,234,1) 0%, rgba(241,218,54,1) 100%); /* FF3.6+ */
background: -webkit-gradient(radial, center center, 0px, center center, 100%, color-stop(0%,rgba(254,252,234,1)), color-stop(100%,rgba(241,218,54,1))); /* Chrome,Safari4+ */
background: -webkit-radial-gradient(center, ellipse cover,  rgba(254,252,234,1) 0%,rgba(241,218,54,1) 100%); /* Chrome10+,Safari5.1+ */
background: -o-radial-gradient(center, ellipse cover,  rgba(254,252,234,1) 0%,rgba(241,218,54,1) 100%); /* Opera 12+ */
background: -ms-radial-gradient(center, ellipse cover,  rgba(254,252,234,1) 0%,rgba(241,218,54,1) 100%); /* IE10+ */
background: radial-gradient(center, ellipse cover,  rgba(254,252,234,1) 0%,rgba(241,218,54,1) 100%); /* W3C */
filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#fefcea', endColorstr='#f1da36',GradientType=1 ); /* IE6-9 fallback on horizontal gradient */
		
	}
	
	
	
	#todo-postit input, #todo-postit textarea, #todo-postit button, #todo-postit select{
		width: auto;
		margin	: 5px;
		padding	: 5px;
		border: 0;
		border-bottom: 1px outset #f1da36;
		background-color: transparent;
		
		 font-size: 15px;
		font-family: 'Julee', cursive;
		
		
   overflow: hidden;
	}
	
	#todo-postit button{ 
		border: 1px outset #efefef;
		
	}

</style>