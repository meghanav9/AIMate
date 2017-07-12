var expanded = false;

//Click on X to delete medicine
$("ul").on("click", "span", function(event){
	$(this).parent().fadeOut(500,function(){
		//$(this).remove();
		$(this).closest('li').remove();
	});
	event.stopPropagation();
	expanded = false;
	showCheckboxes();
});


$("input[type='text']").keypress(function(event){
	if(event.which === 13){
		//grabbing new medicine text from input
		var medText = $(this).val();
		$(this).val("");

		//create a new li and add to ul
		$("ul").append("<li><label><span id=\"trash\"><i class='fa fa-trash'></i></span> "+
			"<input type=\"checkbox\" name=\"medicinename\" id =\"new\" value=" + " \""
			+ medText +"\" /> " + medText + "</label></li>");
			expanded = false;
			showCheckboxes();
	}
			expanded = false;
			showCheckboxes();
});

$(".fa-chevron-down").click(function(){
	$("input[type='text'").fadeToggle(500);
	$("ul").fadeToggle(500);
});




function showCheckboxes() {
  var checkboxes = document.getElementById("checkboxes");
  var text = document.getElementById("text");
  if (!expanded) {
  	checkboxes.style.display = "block";
    checkboxes.style.display = "-webkit-block";
    text.style.display = "block";
    text.style.display = "-webkit-block";
    expanded = true;
  } else {
    checkboxes.style.display = "none";
    text.style.display = "none";
    expanded = false;
  }
 } 


 document.getElementById("checklist").addEventListener("change", function(){
    checkboxes = document.getElementsByName("medicinename");
    for( var i=0; i<checkboxes.length; i++){
       checkboxes[i].checked = this.checked;
    }      
}, false);

// function displayChecked(){
//     var display = "";
//     checkboxes = document.getElementsByName("medicinename");
//     for( var i=0; i<checkboxes.length; i++){
//         if( checkboxes[i].checked ){
//             display += " " + checkboxes[i].value;
//         }
//     }
//     document.getElementById("display").innerHTML = display;
// }
