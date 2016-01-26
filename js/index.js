
var app = function(isAdmin) {	

		this._isAdmin = isAdmin;
		this.init = function() {
			$.nmObj({});
			jQuery(".search").click(function () {
				$.ajax({
				  dataType: "json",
				  url: './studentsInfo.php',
				  data: {"top": jQuery("#topResult :selected").val() , "classStudent": jQuery("#class_student :selected").val(),"major" : jQuery("#major :selected").val(),"groupNumber" : jQuery("#groupNumber :selected").val()},
				  success: function (result){
					buildTable(result, true);
				}
				});
				return false;
			});
			
			jQuery(".searchByFN").click(function (){
				$.ajax({
				  dataType: "json",
				  url: './searchbyfn.php',
				  data: {"fn" : jQuery(".fn").val()},
				  success: function (result){
					console.log(result.length);

					buildTable(result, false);
					}
				});
				return false;
			});
			
			jQuery('.niroModal').live("click",function(){
				var fn = jQuery(this).attr("fn");
				$.nmManual("studentInfo.php?fn="+fn,
					{ 
						closeOnEscape: true,
						header: "Student Info",
						closeOnClick: true,sizes: {
							w: 180,
							h: 180
						}
					}
				);
				return false;
			});
		}
	
		function fillBase(result) {
		console.log(result);
		var StudentList = [];
		for (var i = 0;i < result.length; i++) {
			StudentList[i] = ["" + result[i].fn + " " + result[i].name, parseInt(result[i].grade)];
		}
		if (result.length == 0) {
			$('#container').css("display", "none");
			return;
		}
		else $('#container').css("display", "block");
			$('#container').highcharts({
			chart: {
				type: 'column'
			},
			title: {
				text: 'Students result'
			},
			subtitle: {
				text: 'Best Student'
			},
			xAxis: {
				type: 'category',
				labels: {
					rotation: -75,
					style: {
						fontSize: '13px',
						fontFamily: 'Verdana, sans-serif'
					}
				}
			},
			yAxis: {
				min: 0,
				title: {
					text: 'Points'
				}
			},
			legend: {
				enabled: false
			},
			series: [{
				name: 'Scrot',
				data: StudentList, 
				dataLabels: {
					enabled: true,
					rotation: -90,
					color: '#FFFFFF',
					align: 'right',
					x: 4,
					y: 10,
					style: {
						fontSize: '13px',
						fontFamily: 'Verdana, sans-serif',
						textShadow: '0 0 3px black'
					}
				}
			}]
			});
		}
		
		function buildTable(result, isFillBase) {
			var isAdmin = c._isAdmin;
			var newtable = '<table id="students"><thead><th>First Name</th><th>Last Name<th>FN</th><th>Major</th><th>Group</th><th>Points</th>' +  (isAdmin ? "<th>EDIT</th>" :  "") +  ' </thead><tbody>';
				for (var i =0; i<result.length;i++) {
					newtable += '<tr><td><a href="" class="niroModal" fn='+result[i].fn+'>'+result[i].name+"</a></td><td>" + result[i].lastName + "</td><td>" + result[i].fn + "</td><td>"+ result[i].major+"</td><td>"+ result[i].groupNumber+"</td><td>"+ result[i].grade+"</td>"+ (isAdmin ? "<td><a href='update.php?fn="+result[i].fn+"'"+ '> Update </a>' : "") + "</tr>";
				}
				newtable += "</tbody></table>"
				console.log(jQuery("#topResult :selected").val());
				jQuery(".test").html(newtable);
				if (isFillBase) {fillBase(result); } else $('#container').css("display", "none");
		}
	};