 $(document).ready(function(){
	showLoggedInDetails();
	
	
	
	$('#myCarousel').carousel({interval: 3000});
	
	$('.btnToHomePage').click(function(){
		window.location="index.html";
	});
	$(".btnVoterLoginModal").click(function(){
		//alert("voter login form");
		
			
		$(".voterLoginMsg").html("");
		$("#voterUsername").val("");
		if(checkIfLogin() != 1){
			showThisModal("voterLoginModal");
			
		}else{
			location.href = "voting_page.html";
		}
	});
	$(".btnAdminLoginModal").click(function(){
		//alert("admin login");
		$(".adminLoginMsg").html("");
		$("#username").val("");
		$("#password").val("");
		showThisModal("adminLoginModal");
		
		
	});
	
	$(".btnShowMainMenu").click(function(){
		showMainMenu();
	});
	

});

	function showMainMenu(){
		$(".modal-container").transition({display:"none",delay:0});//show
		$(".modal").transition({display:"none",delay:0});
	}
	function showThisModal(idOfModal){
		//$(".modal-container").velocity('transition.fadeIn',1);
		$(".modal-container").transition({display:"block",delay:0});//show
		
		
		//hide other modal
		//$(".modal").velocity('transition.fadeOut',1);
		$(".modal").transition({display:"none",delay:0});
		//$("#"+idOfModal).velocity('transition.bounceIn');
		$("#"+idOfModal).show();
		if(idOfModal == "voterLoginModal"){
			$("#voterUsername").focus();
		}else if(idOfModal == "adminLoginModal"){
			$("#username").focus();
		}
		
	}
	function showLoggedInDetails(){
		if (checkIfLogin() == 1){		
			//hide login nav
			$(".loginNav").hide();
			//show logout nav
			$(".logoutNav").show();
			
			//show login details
			var loggedInId = window.localStorage.getItem("loggedInId");
			var loggedInLname = window.localStorage.getItem("loggedInLname");
			var loggedInFname = window.localStorage.getItem("loggedInFname");
			var loggedInMname = window.localStorage.getItem("loggedInMname");
			var loggedInCourse = window.localStorage.getItem("loggedInCourse");
			var loggedInAdminStatus = window.localStorage.getItem("loggedInAdminStatus");	
			
			if(loggedInAdminStatus != 1){
				$(".loggedInDetails").html("Welcome: ("+ loggedInId +"-"+ loggedInCourse +") "+ loggedInLname + "," + loggedInFname + ',' + loggedInMname);
			
			}else{
				$(".loggedInDetails").html("Welcome:(Admin) "+ loggedInLname + "," + loggedInFname + ',' + loggedInMname+ " <a href='admin_panel_page.html'  class='btn btn-primary btnLogout inlineBlock verticalAlignMiddle'>Admin Panel</a>");
			}
			
		}else{
			//not logged in
			//hide logout Nav
			
			$(".logoutNav").hide();
		}
	}
	
	
	
	
	
	var checkIfLogin = function(){
		var a = window.localStorage.getItem("loggedInStatus");
		if(a != 1){
			//alert("Not already logged in");
			return 0;
		}else{
			//alert("already logged in");
			return 1;
		}
	}
	
	$(".btnLogout").click(function(){	
		logOut();
	});
	
	function logOut(){
		window.localStorage.setItem("loggedInAdminStatus",0),
		window.localStorage.setItem("loggedInId",""),
		window.localStorage.setItem("loggedInLname",""),
		window.localStorage.setItem("loggedInFname",""),
		window.localStorage.setItem("loggedInMname",""),
		window.localStorage.setItem("loggedInCourse",""),
		window.localStorage.setItem("loggedInStatus",""),
		location.href = "index.html";
	}
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	function adminLogin(){
		var user = $("#username").val();
		var pass = $("#password").val();
		$.ajax({
			url: "phpfile/login_admin.php",
			type: "POST",
			data:	{"user":user,"pass":pass},
			dataType: "json",
			success: function(data){
				if(data[0].allow =="yes"){
					//alert("Success Log in!"+data[0].admin_id+", "+data[0].admin_lname);
					window.localStorage.setItem("loggedInId",data[0].stud_id),
					window.localStorage.setItem("loggedInLname",data[0].admin_lname),
					window.localStorage.setItem("loggedInFname",data[0].admin_fname),
					window.localStorage.setItem("loggedInMname",data[0].admin_mname),
					window.localStorage.setItem("loggedInAdminStatus",1),
					window.localStorage.setItem("loggedInStatus",1),
					showLoggedInDetails();
					location.href = "admin_panel_page.html";
				}
				else if(data[0].allow=="maybe")
				{
					//alert("Incorrect password. Please Try Again");
					$(".adminLoginMsg").html("Incorrect password. Please Try Again");
			
				}
				else
				{
					$(".adminLoginMsg").html("The account you've entered is not registered.");
				}
			},
			error: function(data){
					//do something if error
					//alert("error");
					$(".adminLoginMsg").html("Admin Login Error");
				
				}
			
		});
	}
	function voterLogin(){
		var user = $("#voterUsername").val();
		
		$.ajax({
			url: "phpfile/login_stud.php",
			type: "POST",
			data:	{"user":user},
			dataType: "json",
			success: function(data){
				if(data[0].allow =="yes"){
				//alert("Success Log in!"+data[0].stud_id+", "+data[0].stud_lname);
				voteStatus = data[0].stud_vote_status;
					
					if(voteStatus == "1"){
						//alert('YOU ALREADY VOTED');
						$(".voterLoginMsg").html('('+data[0].stud_id+') '+data[0].stud_lname+','+data[0].stud_fname+','+data[0].stud_mname+' <br />YOU ALREADY VOTED');
						//save on the local storage
						
					}else{
						window.localStorage.setItem("loggedInId",data[0].stud_id),
						window.localStorage.setItem("loggedInLname",data[0].stud_lname),
						window.localStorage.setItem("loggedInFname",data[0].stud_fname),
						window.localStorage.setItem("loggedInMname",data[0].stud_mname),
						window.localStorage.setItem("loggedInCourse",data[0].stud_course_name),
						window.localStorage.setItem("loggedInStatus",1),
						showLoggedInDetails();
						location.href = "voting_page.html";
						//loginStatus = 1;
					}
				
				
				}else{
					//alert("The account you've entered is not registered.");
					$(".voterLoginMsg").html("The account you've entered is not registered.");
				}
			},
			error: function(data){
				//do something if error
				//alert("error");
				$(".voterLoginMsg").html("error");
				}
			
		});
	}