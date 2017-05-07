function search(str)
{
	if(str.length === 0){
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("modal-footer").innerHTML = " " ;
            }
        };
        xmlhttp.open("GET", "/profile/", true);
        xmlhttp.send();

	}else if(str.length > 0){
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("modal-footer").innerHTML = this.responseText;
            }
        };
        xmlhttp.open("GET", "/profile/" + str, true);
        xmlhttp.send();
	}
	
}