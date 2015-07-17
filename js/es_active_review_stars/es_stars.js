// Ma       
    function updateTextInput(val) {
        var ch;
        switch(val)
        {
            case '1' :
                ch = ' Too Short';
                break;
            case '2' :
                ch = ' Short';
                break;
            case '3' : 
                ch = ' Fits';
                break;
            case '4' :
                ch = ' Long';
                break;
            case '5' : 
                ch = ' Too Long';
                break;
        }
      document.getElementById('textInput').innerHTML=ch; 
    }
	
	
	window.pressed = function(){
    var a = document.getElementById('revfile');
    if(a.value == "")
    {
        fileLabel.innerHTML = "No Files Chosen";
    }
    else
    {
        var theSplit = a.value.split('\\');
        fileLabel.innerHTML = theSplit[theSplit.length-1];
    }
};

var check1 = document.getElementById("check1");
var check2 = document.getElementById("check2");

function doThis(){
	if( document.getElementById("check1").checked||document.getElementById("check2").checked)
	
	{
		document.getElementById("email-block").style.display = "block";
		}
		
	else	
		{
			document.getElementById("email-block").style.display = "none";
			}
}
