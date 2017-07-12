function log_student(r){
  var status = r.getAttribute("id");
  console.log(status);
  

  
 

	 var ajaxRequest;  // The variable that makes Ajax possible!
                  try{
                    // Opera 8.0+, Firefox, Safari
                    ajaxRequest = new XMLHttpRequest();
                  } catch (e){
                    // Internet Explorer Browsers
                    try{
                      ajaxRequest = new ActiveXObject("Msxml2.XMLHTTP");
                    } catch (e) {
                      try{
                        ajaxRequest = new ActiveXObject("Microsoft.XMLHTTP");
                      } catch (e){
                        // Something went wrong
                        alert("Your browser broke!");
                        return false;
                      }
                    }
                  }


                    ajaxRequest.open("POST", "log.php",false);
                    ajaxRequest.setRequestHeader("Content-Type", "application/json;charset=UTF-8");
                    ajaxRequest.setRequestHeader('Content-Type', 'application/json');

                    var temp = [{status:status}];
                    ajaxRequest.send(JSON.stringify(temp));
                     location.reload();

}


