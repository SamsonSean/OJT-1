function search(){
  var input, filter, table, tr, td, i;
  var value = document.getElementById("value").value;
  input = document.getElementById("filter");
  filter = input.value.toUpperCase();
  table = document.getElementById("table");
  tr = table.getElementsByTagName("tr");
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[value];
    if (td) {
      if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {  
        tr[i].style.display = "";   
      } else {
        tr[i].style.display = "none";    
      }
    }       
  }
}