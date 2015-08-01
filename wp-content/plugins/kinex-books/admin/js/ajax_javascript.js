// JavaScript Document

$(function () { 
    $(".datepicker").datetimepicker(); 
});


function form_validation()
				{
					var x1=document.forms["getquote"]["first_name"];
					
					var x2=document.forms["getquote"]["last_name"];
					
					var x3=document.forms["getquote"]["phone"];
					
					var x4=document.forms["getquote"]["email"];
					
					var x5=document.forms["getquote"]["comments"];
					
					var x8=document.forms["getquote"]["unit_size"];
					
					var x6=document.forms["getquote"]["facility"];
					
					var x7=document.forms["getquote"]["hear_about"];
					
					var x9=document.forms["getquote"]["fp_date"];
					
					if (x9.value==null || x9.value=="")
					{
					  alert("Date must be Select");
					  x9.focus(); // set the focus to this input
					  return false;
					}
					
					if (x8.value==null || x8.value=="")
					{
					  alert("Unit Size must be filled out");
					  x8.focus(); // set the focus to this input
					  return false;
					}
										
					if (x6.value==null || x6.value=="")
					{
					  alert("Facility must be filled out");
					  x6.focus(); // set the focus to this input
					  return false;
					}
					
					if (x3.value==null || x3.value=="")
					{
					  alert("Phone must be filled out");
					  x3.focus(); // set the focus to this input
					  return false;
					}
					
					if (x4.value==null || x4.value=="")
					{
					  alert("Email must be filled out");
					  x4.focus(); // set the focus to this input
					  return false;
					}
					
					if (x1.value==null || x1.value=="")
					{
					  alert("First name must be filled out");
					  x1.focus(); // set the focus to this input
					  return false;
					}
					
					if (x2.value==null || x2.value=="")
					{
					  alert("Last name must be filled out");
					  x2.focus(); // set the focus to this input
					  return false;
					}
										
					if (x7.value==null || x7.value=="")
					{
					  alert("Hear About must be filled out");
					  x7.focus(); // set the focus to this input
					  return false;
					}
					
					if (x5.value==null || x5.value=="")
					{
					  alert("Comments must be filled out");
					  x5.focus(); // set the focus to this input
					  return false;
					}
					
					alert('Thank you for Submit Details!');
					
				}



				function form_validation2()
				{
					var x1=document.forms["createuser"]["first_name"];
					var x2=document.forms["createuser"]["hear_about"];
					var x3=document.forms["createuser"]["phone"];
					var x4=document.forms["createuser"]["email"];
					var x5=document.forms["createuser"]["address"];
					var x6=document.forms["createuser"]["facility"];
					var x7=document.forms["createuser"]["unit_number"];
					
					var y1=document.forms["createuser"]["cc_amount"];
					var y2=document.forms["createuser"]["cc_fname"];
					var y3=document.forms["createuser"]["cc_lname"];
					var y4=document.forms["createuser"]["cc_payment_type"];
					var y5=document.forms["createuser"]["cc_card_number"];
					var y6=document.forms["createuser"]["cc_cvv_number"];
					var y7=document.forms["createuser"]["cc_month"];
					var y8=document.forms["createuser"]["cc_year"];
					
					if (x1.value==null || x1.value=="")
					{
					  alert("Name must be filled out");
					  x1.focus(); // set the focus to this input
					  return false;
					}
					
					if (x2.value==null || x2.value=="")
					{
					  alert("Hear about must be selected");
					  x2.focus(); // set the focus to this input
					  return false;
					}
					
					if (x3.value==null || x3.value=="")
					{
					  alert("Phone must be filled out");
					  x3.focus(); // set the focus to this input
					  return false;
					}
					
					if (x4.value==null || x4.value=="")
					{
					  alert("Email must be filled out");
					  x4.focus(); // set the focus to this input
					  return false;
					}
					
					if (x5.value==null || x5.value=="")
					{
					  alert("Address must be filled out");
					  x5.focus(); // set the focus to this input
					  return false;
					}
					
					if (x6.value==null || x6.value=="")
					{
					  alert("Facility must be filled out");
					  x6.focus(); // set the focus to this input
					  return false;
					}
					
					if (x7.value==null || x7.value=="")
					{
					  alert("Unit Size must be selected");
					  x7.focus(); // set the focus to this input
					  return false;
					}
					
					
					
					
					if (y1.value==null || y1.value=="")
					{
					  alert("Amount must be filled out");
					  y1.focus(); // set the focus to this input
					  return false;
					}
					
					if (y2.value==null || y2.value=="")
					{
					  alert("Card First Name must be filled out");
					  y2.focus(); // set the focus to this input
					  return false;
					}
					
					if (y3.value==null || y3.value=="")
					{
					  alert("Card Last Name must be filled out");
					  y3.focus(); // set the focus to this input
					  return false;
					}
					
					if (y4.value==null || y4.value=="")
					{
					  alert("Payment Type must be filled out");
					  y4.focus(); // set the focus to this input
					  return false;
					}
					
					if (y5.value==null || y5.value=="")
					{
					  alert("Card Number must be filled out");
					  y5.focus(); // set the focus to this input
					  return false;
					}
					
					if (y6.value==null || y6.value=="")
					{
					  alert("CVV Number must be filled out");
					  y6.focus(); // set the focus to this input
					  return false;
					}
					
					if (y7.value==null || y7.value=="")
					{
					  alert("Expiry Month must be filled out");
					  y7.focus(); // set the focus to this input
					  return false;
					}
					
					if (y8.value==null || y8.value=="")
					{
					  alert("Expiry Year must be filled out");
					  y8.focus(); // set the focus to this input
					  return false;
					}
					
					
					
					alert('Thank you for Submit Details!');
					
				}

				function reserve_validation()
				{
					var x1=document.forms["createuser"]["isn"];
					var x2=document.forms["createuser"]["book_title"];
					var x3=document.forms["createuser"]["edition"];
					var x4=document.forms["createuser"]["author"];
					var x5=document.forms["createuser"]["course_code"];
					var x6=document.forms["createuser"]["contact_phone"];
					//var x7=document.forms["createuser"]["meeting_location"];
					var x8=document.forms["createuser"]["delivery_time"];
					//alert(x6);
					
					/*if (x1.value==null || x1.value=="")
					{
					  alert("ISN must be filled out");
					  x1.focus(); // set the focus to this input
					  return false;
					}*/
					
					if (x2.value==null || x2.value=="")
					{
					  alert("Book Title must be filled out");
					  x2.focus(); // set the focus to this input
					  return false;
					}
					
					if (x3.value==null || x3.value=="")
					{
					  alert("Edition must be filled out");
					  x3.focus(); // set the focus to this input
					  return false;
					}
					
					if (x4.value==null || x4.value=="")
					{
					  alert("Author must be filled out");
					  x4.focus(); // set the focus to this input
					  return false;
					}
					
					if (x5.value==null || x5.value=="")
					{
					  alert("Course Code must be filled out");
					  x5.focus(); // set the focus to this input
					  return false;
					}
					
					var bookgrade = document.getElementsByName("book_condition");
					if (bookgrade[0].checked == true) {
						//alert("Grade 1");
					} else if (bookgrade[1].checked == true) {
						//alert("Grade 2");
					}	else if (bookgrade[2].checked == true) {
						//alert("Grade 3");
					}	else if (bookgrade[3].checked == true) {
						//alert("Grade 4");
					} else {
						// no checked
						var msg = 'You must select Book Condition!';
						alert(msg);
						return false;
					}
					
					var mlocation = document.getElementsByName("meeting_location");
					if (mlocation[0].checked == true) {
						//alert("IC Atrium / Hall");
					} else if (mlocation[1].checked == true) {
						//alert("Library");
					}	else if (mlocation[2].checked == true) {
						//alert("Student Centre");
					} else {
						// no checked
						var msg = 'You must select Meeting Location!';
						alert(msg);
						return false;
					}
					
					if (x8.value==null || x8.value=="")
					{
					  alert("Meeting Date must be selected");
					  x8.focus(); // set the focus to this input
					  return false;
					}
					
					if (x6.value==null || x6.value=="")
					{
					  alert("Contact Phone number must be filled out");
					  x6.focus(); // set the focus to this input
					  return false;
					}
					
					alert('Your order has been received, please check your email for an offer.');
					
					return true;
					
				}

/*

function payment_ajax(q)
{
	  
	  alert('Hello Ajax Payment Status');
	  
	  var a;
                try{a = new XMLHttpRequest;
                    }
               catch(e){ try{ a=new ActiveXObject("Microsoft.XMLHTTP");
		}
	catch(e){ alert("your browser doesnot support ajax");
		}
	}
                a.onreadystatechange= function()
	{if(a.readyState==4)
		{
                    document.getElementById('show2').innerHTML=a.responseText;
                    document.getElementById('d1').focus();
                    //window.scrollTo(0,1000);
                }
	}
                var q;
                var qs="?q="+q;
                a.open("GET","get-payment.php"+qs,true);
                a.send(null);
	  alert('Hello Ajax Payment End'); 
	  
}// end of function


 function Pdetail(q)
            {    
                var a;
                try{a = new XMLHttpRequest;
                    }
               catch(e){ try{ a=new ActiveXObject("Microsoft.XMLHTTP");
		}
	catch(e){ alert("your browser doesnot support ajax");
		}
	}
                a.onreadystatechange= function()
	{if(a.readyState==4)
		{
                    document.getElementById('show2').innerHTML=a.responseText;
                    document.getElementById('d1').focus();
                    //window.scrollTo(0,1000);
                }
	}
                var q;
                var qs="?q="+q;
                a.open("GET","include/get-picture.php"+qs,true);
                a.send(null);
            }








/*

jQuery(document).ready(function(){
	
	//LOADING POPUP
	//Click the button event!
	jQuery("#payment_status").change(function(){
		
	  var cust_val = document.getElementById("payment_status").value;	
	
		//alert(cust_val);
		
		var str = "";
	  $("select option:selected").each(function () {
				str += $(this).text() + " ";
	  });
	  $(".demo").text(str);
	  alert($(this).val());
	  //alert('Testing');
	  
	  
	  var data = {
		action: 'create_cust_ajaxs',
		first_name: first_name,
		last_name: last_name,
		address: address,
		phone: phone,
		email: email,
		notes: notes
		
	};

	// since 2.8 ajaxurl is always defined in the admin header and points to admin-ajax.php
	jQuery.post(ajaxurl, data, function(response) {
		
		disablePopup();
		
		document.getElementById("customer_id_td").innerHTML=response.trim();
		
		
		
	});
	  
		
	});

});

*/