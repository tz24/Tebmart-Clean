function tch_delete(id,confirm_code) {

	if(confirm("Do you want to verify this account?")) {

		document.frm_tch_display.action="users.php?page=wa_wev-admin.php&ac=verify&did="+id+"&confirm_code="+confirm_code;

		document.frm_tch_display.submit();
	}
}	


$wa_wev=jQuery.noConflict();
$wa_wev(document).ready(function () {
    $wa_wev('#test').click(function(event) {  //on click 
        if(this.checked) { // check select status
            $wa_wev('.checkbox1').each(function() { //loop through each checkbox
                this.checked = true;  //select all checkboxes with class "checkbox1"               
            });
        }else{
            $wa_wev('.checkbox1').each(function() { //loop through each checkbox
                this.checked = false; //deselect all checkboxes with class "checkbox1"                       
            });         
        }
    });
});