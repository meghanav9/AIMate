<!DOCTYPE html>

<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
	<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>AI-Mate &mdash; A guide to help patients suffering from Lupus </title>
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<!-- Place favicon.ico and apple-touch-icon.png in the root directory -->
	<link rel="shortcut icon" href="favicon.ico">

	<link href='https://fonts.googleapis.com/css?family=Roboto:400,100,300,700,900' rel='stylesheet' type='text/css'>
	<link href="https://fonts.googleapis.com/css?family=Roboto+Slab:300,400,700" rel="stylesheet">
	
	<!-- Animate.css -->
	<link rel="stylesheet" href="css/animate.css">
	<!-- Icomoon Icon Fonts-->
	<link rel="stylesheet" href="css/icomoon.css">
	<!-- Bootstrap  -->
	<link rel="stylesheet" href="css/bootstrap.css">
	<!-- Superfish -->
	<link rel="stylesheet" href="css/superfish.css">
	<!-- Flexslider -->
	<link rel="stylesheet" href="css/flexslider.css">

	<link rel="stylesheet" href="css/style.css">



	<!-- Modernizr JS -->
	<script src="js/modernizr-2.6.2.min.js"></script>


	<!-- FOR IE9 below -->
	<!--[if lt IE 9]>
	<script src="js/respond.min.js"></script>
	<![endif]-->
	</head>
	<body>
		<div id="fh5co-wrapper">
		<div id="fh5co-page">
		<div id="fh5co-header">
		<header id="fh5co-header-section">
				<div class="container">
					<div class="nav-header">
						<a href="#" class="js-fh5co-nav-toggle fh5co-nav-toggle"><i></i></a>
						<h1 id="fh5co-logo" ><a href="index.html" style = "font-size:45px;"><img src="./images/a.png"  style="width:40px;height:40px;margin-bottom: 10px;"><img src="./images/i.png"  style="width:10px;height:40px;margin-bottom: 10px;">-Mate</a></h1>
						<!-- START #fh5co-menu-wrap -->
						<nav id="fh5co-menu-wrap" role="navigation">
							<ul class="sf-menu" id="fh5co-primary-menu">
								<li>
									<a href="index.html">Home</a>
								</li>
								<li><a href="reminder.html">Reminder</a></li>
								<li><a href="analysis.html">Protein Analysis</a></li>
								<li><a href="selfie.html">Selfie</a></li>
								<li><a class="active" href="handdrift.html">Hand-Drift</a></li>
							</ul>
						</nav>
					</div>
				</div>
			</header>		
		</div>
		<!-- end:fh5co-header -->
		
		<br>
		<br>
		<div id="fh5co-team-section">
			<div class="container">
				<div class="row">
					<div class="col-md-6 col-md-offset-3 text-center fh5co-heading">
						<form  action = "phpForHanddrift.php" name="myForm" method="post" enctype="multipart/form-data" onsubmit="return validateForm()">
						<h1><?php if(isset($_GET['m'])){
                                
                                echo "The result is : ".$_GET['m'];
                                //die();
                            }
                            ?></h1>
						<h2>Enter details as below:</h2>
						
						<div class="form-group">
						<h3 class="text-left">Name 
						<span class="glyphicon glyphicon-user input-place"></span>
						</h3>
									<label for="name" name ="name" class="sr-only">Name</label>
									<input type="name" name ="name" class="form-control form-input" id="name" placeholder="Name" maxlength="32" onKeyUp="chText()" onKeyDown="chText()"  >
									<span id="nameErr" style = "color:red;"></span>
									 
						</div>
						
      					
      					<div class="form-group">
      					<h3 class="text-left">Date of Birth 
      					<span class="glyphicon glyphicon-calendar input-place"></span>
      					</h3>
      					<label for="date" class="sr-only">Date Of Birth</label>
      					<input type="date" name ="date" class="form-control" id="date" placeholder="Date of Birth" onclick="date123()" >
      					<span id="dateErr" style = "color:red;"></span>
    					</div>
						
						<div class="form-group">
							<h3 class="text-left">Take a pic! 
      					</h3>
      					    <label for="uploaded_file">
        					<span class="glyphicon glyphicon-camera"></span>
    						</label>
									<input type="file"  accept="image/*;capture=camera" name="uploaded_file" id="uploaded_file" class="form-control form-input form-style-base" style = "display: none;">
									<span id="fileErr" style = "color:red;"></span>

						</div>
						<div class="form-group">
						<h3 class="text-left">Authorization ID 
						<span class="glyphicon glyphicon-user input-place"></span>
						</h3>
									<label for="aid" name ="aid" class="sr-only">Authorization ID </label>
									<input type="password" name ="abc" class="form-control form-input" id="abc" placeholder="0" >
									<span id="aidErr" style = "color:red;"></span>
									 
						</div>
						<div class="form-group">
							<h3 class="text-left">Select Doctor
      					<span class="glyphicon glyphicon-user input-place"></span>
      					</h3>
									<select id="dropdown" name="email" class="form-control">
										<option selected="selected" value="pavanjhaveri@gmail.com"> Pavan </option>
										<option value="meghana.vish@gmail.com"> Meghana </option>
									</select>
						</div>
						<div id="divEmail" style="display:none">  						
						 <input type="submit" class="btn btn-warning" value="Send Email" name="submit" id = "aButton" />
						</div>
						<script type="text/javascript">
					
							document.querySelector('#uploaded_file').addEventListener('change', function() {
									   var fr=new FileReader();
									 fr.onload=function(e){
									console.log("fr");
									  var img=new Image();
									  img.onload=function(){
									    console.log("img");
									     var MAXWidthHeight=256;
									   var r=MAXWidthHeight/Math.max(this.width,this.height),
									   w=Math.round(this.width*r),
									   h=Math.round(this.height*r),
									   c=document.createElement("canvas");
									   c.width=w;c.height=h;
									   c.getContext("2d").drawImage(this,0,0,w,h);
									   this.src=c.toDataURL();
									  var file = c.toDataURL();
									  var fd = new FormData();
									  fd.append("afile", file);
									  fd.append("username", document.getElementById('name').value);
									  fd.append("date", document.getElementById('date').value);
									  fd.append("email", document.getElementById('dropdown').value);
									    var xhr = new XMLHttpRequest();
									  xhr.open('POST', 'imageUpload.php', true);
									    xhr.upload.onprogress = function(e) {
									    if (e.lengthComputable) {
									      var percentComplete = (e.loaded / e.total) * 100;
									      if(percentComplete == 100){
									       //window.open("https://www.google.com");
									       //img.removeEventListener("onload","false");
									       img.onload = null;
									      document.getElementById("divEmail").style.display="block"; 
									      }
									      console.log(percentComplete + '% uploaded');
									    }
									  };
									   xhr.onload = function() {
									    if (this.status == 200) {
									      //var resp = JSON.parse(this.response);

									      console.log('Server got:', this.response);
									      //resp.username
									    };
									  };
									    xhr.send(fd);
									  // document.body.appendChild(this);
									  }
									  img.src=e.target.result;
									 }
									 console.log(document.getElementById('uploaded_file'));
									 fr.readAsDataURL( document.getElementById('uploaded_file').files[0]);
									}, false);
						
						</script>
						</form>
				</div>
		</div>
	</div>
			<footer>
			<div id="footer">
				<div class="container">
					<div class="row copy-center">
						<div class="col-md-6 col-md-offset-3 text-center">
							<h1  style="color: white">Contact:</h1>
							<h3 class="section-title">Ramon GB Bonegio, MD</h3>
							<ul class="contact-info">
								<li><i class="icon-map2"></i>650 Albany St Evans Biomed Research Ctr, Boston MA 02118</li>
								<li><i class="icon-phone2"></i>(617) 638-7331</li>
								<li><i class="icon-envelope2"></i><a href="#">bonegio@bu.edu</a></li>
							</ul>
						</div>
					</div>
					<div class="row copy-right">
						<div class="col-md-6 col-md-offset-3 text-center">
							<h3 class="section-title" style="text-align: center;">AI-Mate - A guide to help patients</h3>
						</div>
					</div>
				</div>
			</div>
		</footer>
	

	</div>
	<!-- END fh5co-page -->

	</div>
	<!-- END fh5co-wrapper -->

	<!-- jQuery -->
	<script>
		function date123(){
			var today = new Date().toISOString().split('T')[0];
		    //alert(today);
		    document.getElementsByName("date")[0].setAttribute('max', today);
		}
		    
		    
		function validateForm() {
		    var name = document.forms["myForm"]["name"].value;
		    var b = document.getElementById("nameErr");
		    if (name == "") {
		        //alert("Name must be filled out");
		        b.innerHTML = "Name Must Be Filled Out";
		        return false;
		    }else{
		    	b.style.display = "none";
		    }
		    var date = document.forms["myForm"]["date"].value;
		    var c = document.getElementById("dateErr");
		    if (date == "") {
		        //alert("Date must be filled out");
		        c.innerHTML = "Date of Birth Must Be Filled Out";
		        return false;
		    } else{
		    	c.style.display = "none";
		    }
		    var file = document.forms["myForm"]["uploaded_file"].value;
		    var d = document.getElementById("fileErr");
		    if (file == "") {
		        //alert("File must be attched");
		        d.innerHTML = "File Must Be Attached";
		        return false;
		     }else{
		    	d.style.display = "none";
		    }
		    var aid = document.forms["myForm"]["abc"].value;
		    var k = document.getElementById("aidErr");
		    if (aid != "0000" || aid == "") {
		        //alert("Name must be filled out");
		        k.innerHTML = "Authorization Failed! Please enter the correct credentials";
		        return false;
		    }else{
		    	k.style.display = "none";
		    }
		}

		function chText()
		{
		    	var str=document.getElementById("name");
		    	var regex=/[^a-z\s]/gi;
		    	str.value=str.value.replace(regex ,"");
		}

		</script>

	<script src="js/jquery.min.js"></script>
	<!-- jQuery Easing -->
	<script src="js/jquery.easing.1.3.js"></script>
	<!-- Bootstrap -->
	<script src="js/bootstrap.min.js"></script>
	<!-- Waypoints -->
	<script src="js/jquery.waypoints.min.js"></script>
	<!-- Superfish -->
	<script src="js/hoverIntent.js"></script>
	<script src="js/superfish.js"></script>
	<!-- Flexslider -->
	<script src="js/jquery.flexslider-min.js"></script>

	<!-- Main JS (Do not remove) -->
	<script src="js/main.js"></script>

	</body>
</html>

