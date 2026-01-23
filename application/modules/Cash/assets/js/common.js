function submitcashDepositForm_OLD() {
    
     let varience = $("#varience").val();
     let error = 0;
    if((varience > 0 || varience < 0) && localStorage.getItem("confirmed") == ''){
        $("#flipConfirmModal").modal('show');
        localStorage.setItem("confirmed", 'yes');
         return false;
    }else if((varience > 0 || varience < 0) && localStorage.getItem("confirmed") == 'yes'){
         $("#flipConfirmFinalModal").modal('show');
         return false;
         
    }else {
        let error=0;
       if( ($('#staff_name').length && $('#staff_name').val() =='') ){
         error = 1;
         $(".staffNameError").show();
       }
       if( ($('#datetime').length && $('#datetime').val() =='') ){
         error = 1;
        }
        if( ($('#end_staff_name').length && $('#end_staff_name').val() =='') ){
          $(".end_staff_name").show();
         error = 1;
        }
        
    if(error == 0){
     document.getElementById("cashDepositForm").submit();    
    }else{
        alert("Please select mandatory fields");
    }
     
    }
  
}
function submitcashDepositForm() {

     let error=0;
       if( ($('#staff_name').length && $('#staff_name').val() =='') ){
         error = 1;
         $(".staffNameError").show();
       }
       if( ($('#datetime').length && $('#datetime').val() =='') ){
         error = 1;
        }
        if( ($('#end_staff_name').length && $('#end_staff_name').val() =='') ){
          $(".end_staff_name").show();
         error = 1;
        }
      console.log("error",error)  
    if(error == 0){
     document.getElementById("cashDepositForm").submit();    
    }else{
        alert("Please select mandatory fields");
    }
  
}
function todaysDate(){
    let today = new Date();
let dd = String(today.getDate()).padStart(2, '0');
let mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
let yy = today.getFullYear();

return today = yy + '-' + mm + '-' +dd ;
}



function submitFormAfterConfirmation() {
    if($("#staff_name").val()  && $("#datetime").val()){
        document.getElementById("cashDepositForm").submit(); 
    }else{
        alert("Please enter mandatory fields");
    }
  
}

function updatecashDepositForm(){
    
    if(localStorage.getItem("confirmed") == 'yes'){
     $("#updateDepositForm").submit();   
    }else{
    $("#confirmEmployeeName").html($("#manager_name").val());
    $("#confrimCoinBagAmont").html($("#regtotal1").val());
    $("#EOSConfirmFinalModal").modal('show');    
    }
}
function finalSubmitEndShift(){
    if ($('#manager_name').is(':visible') && $('#manager_name').val().trim() === '' && !$('#manager_name').prop('readonly')) {
     alert('Manager Name cannot be blank'); 
     return false;
    }
    if ($('#end_staff_name').is(':visible') && $('#end_staff_name').val().trim() === '' && !$('#end_staff_name').prop('readonly')) {
     alert('Staff Name cannot be blank'); 
     return false;
    }
    if ($('#staff_name').is(':visible') && $('#staff_name').val().trim() === '' && !$('#staff_name').prop('readonly')) {
     alert('Staff Name cannot be blank'); 
     return false;
    }

  $("#EOSFINALSUBMITConfirmFinalModal").modal('show');
  highlighEmptyRequiredFields();    
  
 
    
}

function highlighEmptyRequiredFields(){
    $('.required:not([disabled])').each(function() {
        if ($(this).val() === '') {
            $(this).addClass('is-invalid');
        }
    });
}
function finalSubmitEndShiftAfterConfirmation(){
    let validationRule = true;
    let roleNameOfLoggedInUser = $('#roleNameOfLoggedInUser').val();
    let requiredRegisterAmount = $('#requiredRegisterAmount').val();
    let depositM1 = $('#depositM1').val();
    let requiredRegisterAmount1 = $('#requiredRegisterAmount1').val();
    let depositM2 = $('#depositM2').val();
    
    if(roleNameOfLoggedInUser == 'Staff' && (requiredRegisterAmount == '' || depositM1 == '' )){
        console.log("rln",roleNameOfLoggedInUser);
        validationRule = false;
    }else if(roleNameOfLoggedInUser != 'Staff' && requiredRegisterAmount1 == '' || depositM2 == '' ){
        validationRule = false;
         console.log("r22",roleNameOfLoggedInUser)
    }
    
    if(validationRule == false){
        alert("Please enter the required fields below before submitting the form");
        return false;
    }
    if($('#updateDepositForm').length){
      $(".IsfinalSubmissionDone").val("yes");
      $("#updateDepositForm").submit();   
   }
  if($('#cashDepositForm').length){
  $(".IsfinalSubmissionDoneForStartShift").val("yes");
  $("#cashDepositForm").submit();    
  }  
    
}
function recordStaffConfirmationForEndOfShift(){
    localStorage.setItem("confirmed", 'yes');
    $("#updateDepositForm").submit();
}
function submitBankDepositForm(){
    
    let fieldID = 'managerBagCounted_'+todaysDate();
    let error = 0;
    if($('input[name="'+fieldID+'"]').val() == ''){
          error = 1; 
        }
        if(error){
         alert("Please enter mandatory fields");
          return false;   
        }else{
       document.getElementById("bankDepositForm").submit(); 
        }
        
}
// function confirmFloat(){
// $("#commentsEntered").val($("#floatcomments").val())    
// }
function submitfloatForm(isFinalSubmit=''){
    if(isFinalSubmit !=''){
    $(".IsfinalSubmissionDoneForFloat").val("yes");    
    }
    
    document.getElementById("floatForm").submit();
  }
  
  function FinalsubmitfloatForm(){
   $("#EOSFINALSUBMITConfirmFinalModal").modal('show');
    $("#existingButton").attr("onclick", "submitfloatForm('FS')");
   highlighEmptyRequiredFields();
  }
 
function totalcashcal(){
			
			var t = t1 = '';
			for (let i = 1; i < 12; i++) {
                if($('#t'+i).val())
                {	
                   t = Number(t)+Number($('#t'+i).val()); 
                }
            }
            console.log("TTTT=",t);
             t = parseFloat(t).toFixed(2);
            //  console.log("entry total",t)
            $('#entrytotal').val(Number(t).toFixed(2));
            let registerFloat = Number($('#registerFloat').val())
            let pettyCash = Number($('#pettyCash').val())
            let requiredRegisterAmount = Number($('#requiredRegisterAmount').val())
            
            // let cashForCoinBagStaff = Number(t) - registerFloat - pettyCash;
            let depositM1 = $("#depositM1").val();
            let staffVariance = Number(depositM1) - requiredRegisterAmount;
            
            // $('#regtotal').val(cashForCoinBagStaff.toFixed(2));
            $('#staffVariance').val(staffVariance.toFixed(2));
            let stdcashfloat = Number($('#stdcashfloat').val())
            
            let weeklyMonthlyfloat = Number($('#floatTotal').val())
            let floatVariance = Number(t) - Number(weeklyMonthlyfloat);
            $('#floatvarience').val(floatVariance.toFixed(2));
            let variance = Number(t)-Number(stdcashfloat);
            $('#varience').val(parseFloat(Number(variance)).toFixed(2));
            
            
            var fl1 = Number($('#t31').val())+Number($('#t112').val())+Number($('#t21').val())+Number($('#t41').val())+Number($('#t51').val())+Number($('#t61').val())+Number($('#t71').val())+Number($('#t81').val())+Number($('#t91').val())+Number($('#t101').val())+Number($('#t13').val());
            fl1 = parseFloat(fl1).toFixed(2);
            
            $('#entrytotal1').val(Number(fl1).toFixed(2));
            let registerFloat1 = Number($('#registerFloat1').val())
            // let pettyCash1 = Number($('#pettyCash1').val())
            let depositM2 = Number($('#depositM2').val())
            let requiredRegisterAmount1 = Number($('#requiredRegisterAmount1').val())
            // let cashForCoinBagManager = Number(fl1) - registerFloat1 - pettyCash1;
            let managerVariance = Number(depositM2) - requiredRegisterAmount1;
            
            $('#managerVariance').val(managerVariance.toFixed(2));
            // $('#regtotal1').val(cashForCoinBagManager.toFixed(2));
            
            // float add,view,edit page manager section varince
            let weeklyMonthlyfloatTotalManager = Number($('#managerFloatTotal').val())
            let floatVarianceManager = Number(fl1) - Number(weeklyMonthlyfloatTotalManager);
            $('#floatvarience1').val(floatVarianceManager.toFixed(2));
             commonTotal();
               
	    }
function totalcashcalFrontCounter()	{
			
			var t = t1 = '';
			for (let i = 1; i < 12; i++) {
                if($('#m1_t'+i).val())
                {	
                   t = Number(t)+Number($('#m1_t'+i).val()); 
                }
                
                if($('#t'+i).val())
                {	
                   t1 = Number(t1)+Number($('#t'+i).val()); 
                }
            }
             console.log("t1",t1)
             t = parseFloat(t).toFixed(2);
             t1 = parseFloat(t1).toFixed(2);
            //  console.log("entry total",t)
            $('#m1_entrytotal').val(Number(t).toFixed(2));
             $('#entrytotal').val(Number(t1).toFixed(2));
            let registerFloat = Number($('#m1_registerFloat').val())
            let pettyCash = Number($('#m1_pettyCash').val())
            let requiredRegisterAmount = Number($('#m1_requiredRegisterAmount').val())
            
            let cashForCoinBagStaff = Number(t) - registerFloat - pettyCash;
            let staffVariance = Number(cashForCoinBagStaff) - requiredRegisterAmount;
            
            $('#m1_regtotal').val(cashForCoinBagStaff.toFixed(2));
            $('#m1_staffVariance').val(staffVariance.toFixed(2));
            let stdcashfloat = Number($('#m1_stdcashfloat').val())
            
            let weeklyMonthlyfloat = Number($('#m1_floatTotal').val())
            let floatVariance = Number(t) - Number(weeklyMonthlyfloat);
            $('#m1_floatvarience').val(floatVariance.toFixed(2));
            let variance = Number(t)-Number(stdcashfloat);
            $('#m1_varience').val(parseFloat(Number(variance)).toFixed(2));
            
            
            
            var fl1 = Number($('#m2_t31').val())+Number($('#m2_t112').val())+Number($('#m2_t21').val())+Number($('#m2_t41').val())+Number($('#m2_t51').val())+Number($('#m2_t61').val())+Number($('#m2_t71').val())+Number($('#m2_t81').val())+Number($('#m2_t91').val())+Number($('#m2_t101').val())+Number($('#m2_t13').val());
            fl1 = parseFloat(fl1).toFixed(2);
            
            $('#m2_entrytotal1').val(Number(fl1).toFixed(2));
            let registerFloat1 = Number($('#m2_registerFloat1').val())
            let pettyCash1 = Number($('#m2_pettyCash1').val())
            let requiredRegisterAmount1 = Number($('#m2_requiredRegisterAmount1').val())
            let cashForCoinBagManager = Number(fl1) - registerFloat1 - pettyCash1;
            let managerVariance = Number(cashForCoinBagManager) - requiredRegisterAmount1;
            
            $('#m2_managerVariance').val(managerVariance.toFixed(2));
            $('#m2_regtotal1').val(cashForCoinBagManager.toFixed(2));
            
            // float add,view,edit page manager section varince
            let weeklyMonthlyfloatTotalManager = Number($('#m2_managerFloatTotal').val())
            let floatVarianceManager = Number(fl1) - Number(weeklyMonthlyfloatTotalManager);
            $('#m2_floatvarience1').val(floatVarianceManager.toFixed(2));
            commonTotal()
               
	    }	    
	    
function commonTotal(){
		    // Sum of Cash counted (for office float and front office Manager 1)====
		    
           let m1_entrytotal =  $("#m1_entrytotal").val();
           let entrytotal =  $("#entrytotal").val();
            let totalM1 = Number(m1_entrytotal) + Number(entrytotal);
            $("#of_fc_Total").val(totalM1.toFixed(2));
            
            // ==== Sum of Cash Counted Manager 2 
            
           let m2_entrytotal1 =  $("#m2_entrytotal1").val();
           let entrytotal1 =  $("#entrytotal1").val();
            let totalM2 = Number(m2_entrytotal1) + Number(entrytotal1);
             $("#m2_of_fc_Total").val(totalM2.toFixed(2));
            
           //===== Sum of Floats (for office float and front office Manager 1)
           let m1_floatTotal =  $("#m1_floatTotal").val();
            let floatTotal =  $("#floatTotal").val();
           let of_fc_floatTotal = Number(m1_floatTotal) + Number(floatTotal);
           $("#of_fc_floatTotal").val(of_fc_floatTotal.toFixed(2))
           //==================
           
           
            //===== Sum of Floats (for office float and front office Manager 2)
           let m2_managerFloatTotal =  $("#m2_managerFloatTotal").val();
            let managerFloatTotal =  $("#managerFloatTotal").val();
           let m2_of_fc_floatTotal = Number(m2_managerFloatTotal) + Number(managerFloatTotal);
           $("#m2_of_fc_floatTotal").val(m2_of_fc_floatTotal.toFixed(2))
           
           //================== Sum of Variance (for office float and front office Manager 1)
          let of_fc_floatvarience = totalM1 - Number(of_fc_floatTotal);
            $("#of_fc_floatvarience").val(of_fc_floatvarience.toFixed(2));
            
            //================== Sum of Variance (for office float and front office Manager 2)
           let m2_of_fc_floatvarience =  totalM2 - Number(m2_of_fc_floatTotal)
             $("#m2_of_fc_floatvarience").val(m2_of_fc_floatvarience.toFixed(2));
            
		}
		
$(document).ready(function(){
   
        localStorage.setItem("confirmed", '');
         
		
	 // to calculate the total on page load while view and edit
	    $('#t1').val((2*$('#2d').val()).toFixed(2));
		$('#t2').val((1*$('#1d').val()).toFixed(2));
		$('#t3').val((50*$('#050c').val()/100).toFixed(2));
		$('#t4').val(((20*$('#20c').val())/100).toFixed(2));
		$('#t5').val(((10*$('#10c').val())/100).toFixed(2));
		$('#t6').val(((5*$('#5c').val())/100).toFixed(2));
		$('#t7').val((100*$('#100d').val()).toFixed(2));
		$('#t8').val((50*$('#50d').val()).toFixed(2));
		$('#t9').val((20*$('#20d').val()).toFixed(2));
		$('#t10').val((10*$('#10d').val()).toFixed(2));
// 		$('#t10').val(10*$('#22d').val());
		$('#t11').val((5*$('#5d').val()).toFixed(2));
		
		$('#t112').val((2*$('#2d1').val()).toFixed(2));
		$('#t21').val((1*$('#1d1').val()).toFixed(2));
		$('#t31').val(((50*$('#050c1').val())/100).toFixed(2));
		$('#t41').val(((20*$('#20c1').val())/100).toFixed(2));
		$('#t51').val(((10*$('#10c1').val())/100).toFixed(2));
		$('#t61').val(((5*$('#5c1').val())/100).toFixed(2));
		$('#t71').val((100*$('#100d1').val()).toFixed(2));
		$('#t81').val((50*$('#50d1').val()).toFixed(2));
		$('#t91').val((20*$('#20d1').val()).toFixed(2));
		$('#t101').val((10*$('#10d1').val()).toFixed(2));
		$('#t13').val((5*$('#5d1').val()).toFixed(2));
		
	
	
		
		$('#5c').on('mouseenter mouseleave change click keyup blur focus reload onload', function() {	
        $('#t6').val(((5*$('#5c').val())/100).toFixed(2));
       
		totalcashcal()
		});
		$('#10c').on('mouseenter mouseleave change click keyup blur focus reload onload', function() {			
        $('#t5').val(((10*$('#10c').val())/100).toFixed(2));
		totalcashcal()
		});
		$('#20c').on('mouseenter mouseleave change click keyup blur focus reload onload ready', function() {	
        $('#t4').val(((20*$('#20c').val())/100).toFixed(2));
		totalcashcal()
		});
		$('#050c').on('mouseenter mouseleave change click keyup blur focus reload onload ready', function() {	
        $('#t3').val(((50*$('#050c').val())/100).toFixed(2));
		totalcashcal()
		});
		$('#1d').on('mouseenter mouseleave change click keyup blur focus reload onload ready', function() {
        $('#t2').val((1*$('#1d').val()).toFixed(2));
		totalcashcal()
		});
		 $('#2d').on('mouseenter mouseleave change click keyup blur focus reload onload', function() {
        $('#t1').val((2*$('#2d').val()).toFixed(2));
		totalcashcal();
		});
		
		
		$('#100d').on('mouseenter mouseleave change click keyup blur focus reload onload', function() {			
        $('#t7').val((100*$('#100d').val()).toFixed(2));
		totalcashcal()
		});
		$('#50d').on('mouseenter mouseleave change click keyup blur focus reload onload', function() {	
        $('#t8').val((50*$('#50d').val()).toFixed(2));
		totalcashcal()
		});
		$('#20d').on('mouseenter mouseleave change click keyup blur focus reload onload', function() {	
        $('#t9').val((20*$('#20d').val()).toFixed(2));
		totalcashcal()
		});
		$('#10d').on('mouseenter mouseleave change click keyup blur focus reload onload', function() {		
        $('#t10').val((10*$('#10d').val()).toFixed(2));
		totalcashcal()
		});
// 		$('#22d').on('mouseenter mouseleave change click keyup blur focus reload onload', function() {		
//         $('#t22').val(10*$('#22d').val());
// 		totalcashcal()
// 		});
		$('#5d').on('mouseenter mouseleave change click keyup blur focus reload onload', function() {	
        $('#t11').val((5*$('#5d').val()).toFixed(2));
		totalcashcal()
		});
		
		//  front counter float js ==========================================================================
			
		$('#m1_5c').on('mouseenter mouseleave change click keyup blur focus reload load', function() {	
        $('#m1_t6').val(((5*$('#m1_5c').val())/100).toFixed(2));
        
		totalcashcalFrontCounter()
		});
		$('#m1_10c').on('mouseenter mouseleave change click keyup blur focus reload onload', function() {			
        $('#m1_t5').val(((10*$('#m1_10c').val())/100).toFixed(2));
		totalcashcalFrontCounter()
		});
		$('#m1_20c').on('mouseenter mouseleave change click keyup blur focus reload onload ready', function() {	
        $('#m1_t4').val(((20*$('#m1_20c').val())/100).toFixed(2));
		totalcashcalFrontCounter()
		});
		$('#m1_050c').on('mouseenter mouseleave change click keyup blur focus reload onload ready', function() {	
        $('#m1_t3').val(((50*$('#m1_050c').val())/100).toFixed(2));
		totalcashcalFrontCounter()
		});
		$('#m1_1d').on('mouseenter mouseleave change click keyup blur focus reload onload ready', function() {
        $('#m1_t2').val((1*$('#m1_1d').val()).toFixed(2));
		totalcashcalFrontCounter()
		});
		 $('#m1_2d').on('mouseenter mouseleave change click keyup blur focus reload onload', function() {
        $('#m1_t1').val((2*$('#m1_2d').val()).toFixed(2));
		totalcashcalFrontCounter();
		});
		
		
		$('#m1_100d').on('mouseenter mouseleave change click keyup blur focus reload onload', function() {			
        $('#m1_t7').val((100*$('#m1_100d').val()).toFixed(2));
		totalcashcalFrontCounter()
		});
		$('#m1_50d').on('mouseenter mouseleave change click keyup blur focus reload onload', function() {	
        $('#m1_t8').val((50*$('#m1_50d').val()).toFixed(2));
		totalcashcalFrontCounter()
		});
		$('#m1_20d').on('mouseenter mouseleave change click keyup blur focus reload onload', function() {	
        $('#m1_t9').val((20*$('#m1_20d').val()).toFixed(2));
		totalcashcalFrontCounter()
		});
		$('#m1_10d').on('mouseenter mouseleave change click keyup blur focus reload onload', function() {		
        $('#m1_t10').val((10*$('#m1_10d').val()).toFixed(2));
		totalcashcalFrontCounter()
		});
		$('#m1_5d').on('mouseenter mouseleave change click keyup blur focus reload onload', function() {	
        $('#m1_t11').val((5*$('#m1_5d').val()).toFixed(2));
		totalcashcalFrontCounter()
		});
		
	  // for second part of form on page load Manager one FLOAT PAGE ==============================================================================

	   $('#m1_t6').val(((5*$('#m1_5c').val())/100).toFixed(2));
	   $('#m1_t5').val(((10*$('#m1_10c').val())/100).toFixed(2));	
	   $('#m1_t4').val(((20*$('#m1_20c').val())/100).toFixed(2));	
	   $('#m1_t3').val(((50*$('#m1_050c').val())/100).toFixed(2));	
	   $('#m1_t2').val((1*$('#m1_1d').val()).toFixed(2));	
	   $('#m1_t1').val((2*$('#m1_2d').val()).toFixed(2));
	   $('#m1_t7').val((100*$('#m1_100d').val()).toFixed(2));
	   $('#m1_t8').val((50*$('#m1_50d').val()).toFixed(2));
	   $('#m1_t9').val((20*$('#m1_20d').val()).toFixed(2));
	   $('#m1_t10').val((10*$('#m1_10d').val()).toFixed(2));
	   $('#m1_t11').val((5*$('#m1_5d').val()).toFixed(2));
		
		//======= END
		
		//========= Manager 2 =============================================================================================================
		
		 // for second part of form on page load   FLOAT PAGE

		$('#m2_t112').val(((2*$('#m2_2d1').val())).toFixed(2));
		$('#m2_t21').val(((1*$('#m2_1d1').val())).toFixed(2));
		$('#m2_t31').val(((50*$('#m2_050c1').val())/100).toFixed(2));
		$('#m2_t41').val(((20*$('#m2_20c1').val())/100).toFixed(2));
		$('#m2_t51').val(((10*$('#m2_10c1').val())/100).toFixed(2));
		$('#m2_t61').val(((5*$('#m2_5c1').val())/100).toFixed(2));
		$('#m2_t71').val(((100*$('#m2_100d1').val())).toFixed(2));
		$('#m2_t81').val(((50*$('#m2_50d1').val())).toFixed(2));
		$('#m2_t91').val(((20*$('#m2_20d1').val())).toFixed(2));
		$('#m2_t101').val(((10*$('#m2_10d1').val())).toFixed(2));
		$('#m2_t13').val(((5*$('#m2_5d1').val())).toFixed(2));
		
		//======= END   ========================== ==============================================================================
		
		
		
		
		
		
		$('#m2_2d1').on('mouseenter mouseleave change click keyup blur focus reload onload', function() {
		let totalManager = (2*$('#m2_2d1').val());
		 let totalStaff = (2*$('#m1_2d').val());
		 let variance = totalStaff - totalManager; 
		$('#m2_variance_t112').val(variance.toFixed(2));    
        $('#m2_t112').val(totalManager.toFixed(2));
		totalcashcalFrontCounter();
		});
		$('#m2_1d1').on('mouseenter mouseleave change click keyup blur focus reload onload ready', function() {
		 let totalManager = (1*$('#m2_1d1').val());
		 let totalStaff = (1*$('#m1_1d').val());
		 let variance = totalStaff - totalManager; 
		$('#m2_variance_t21').val(variance.toFixed(2));    
        $('#m2_t21').val(totalManager.toFixed(2));
		totalcashcalFrontCounter()
		});
		$('#m2_050c1').on('mouseenter mouseleave change click keyup blur focus reload onload ready', function() {
		let totalManager = (50*$('#m2_050c1').val())/100;
		 let totalStaff = (50*$('#m1_050c').val())/100;
		 let variance = totalStaff - totalManager; 
		$('#m2_variance_t31').val(variance.toFixed(2));    
        $('#m2_t31').val(totalManager.toFixed(2));
		totalcashcalFrontCounter()
		});
		$('#m2_20c1').on('mouseenter mouseleave change click keyup blur focus reload onload ready', function() {	
		 let totalManager = (20*$('#m2_20c1').val())/100;
		 let totalStaff = (20*$('#m1_20c').val())/100;
		 let variance = totalStaff - totalManager; 
		$('#m2_variance_t41').val(variance.toFixed(2));    
        $('#m2_t41').val(totalManager.toFixed(2));
		totalcashcalFrontCounter()
		});
		$('#m2_10c1').on('mouseenter mouseleave change click keyup blur focus reload onload', function() {	
		 let totalManager = (10*$('#m2_10c1').val())/100;
		 let totalStaff = (10*$('#m1_10c').val())/100;
		 let variance = totalStaff - totalManager; 
		$('#m2_variance_t51').val(variance.toFixed(2));    
        $('#m2_t51').val(totalManager.toFixed(2));
		totalcashcalFrontCounter()
		});
		$('#m2_5c1').on('mouseenter mouseleave change click keyup blur focus reload onload', function() {
		 let totalManager = (5*$('#m2_5c1').val())/100;
		 let totalStaff = (5*$('#m1_5c').val())/100;
		 let variance = totalStaff - totalManager; 
		$('#m2_variance_t61').val(variance.toFixed(2));
        $('#m2_t61').val(totalManager.toFixed(2));
        
		totalcashcalFrontCounter()
		});
		
		$('#m2_100d1').on('mouseenter mouseleave change click keyup blur focus reload onload', function() {
		 let totalManager = (100*$('#m2_100d1').val());
		 let totalStaff = (100*$('#m1_100d').val());
		 let variance = totalStaff - totalManager; 
		$('#m2_variance_t71').val(variance.toFixed(2));    
        $('#m2_t71').val(totalManager.toFixed(2));
		totalcashcalFrontCounter()
		});
		$('#m2_50d1').on('mouseenter mouseleave change click keyup blur focus reload onload', function() {	
		let totalManager = (50*$('#m2_50d1').val());
		 let totalStaff = (50*$('#m1_50d').val());
		 let variance = totalStaff - totalManager; 
		$('#m2_variance_t81').val(variance.toFixed(2));    
        $('#m2_t81').val(totalManager.toFixed(2));
		totalcashcalFrontCounter()
		});
		$('#m2_20d1').on('mouseenter mouseleave change click keyup blur focus reload onload', function() {	
		  let totalManager = (20*$('#m2_20d1').val());
		 let totalStaff = (20*$('#m1_20d').val());
		 let variance = totalStaff - totalManager; 
		$('#m2_variance_t91').val(variance.toFixed(2));     
        $('#m2_t91').val(totalManager.toFixed(2));
		totalcashcalFrontCounter()
		});
		$('#m2_10d1').on('mouseenter mouseleave change click keyup blur focus reload onload', function() {	
		 let totalManager = (10*$('#m2_10d1').val());
		 let totalStaff = (10*$('#m1_10d').val());
		 let variance = totalStaff - totalManager; 
		$('#m2_variance_t101').val(variance.toFixed(2));
        $('#m2_t101').val(totalManager.toFixed(2));
		totalcashcalFrontCounter()
		});
		$('#m2_5d1').on('mouseenter mouseleave change click keyup blur focus reload onload', function() {
		 let totalManager = (5*$('#m2_5d1').val());
		 let totalStaff = (5*$('#m1_5d').val());
		 let variance = totalStaff - totalManager; 
		$('#m2_variance_t13').val(variance.toFixed(2));    
        $('#m2_t13').val(totalManager.toFixed(2));
		totalcashcalFrontCounter()
		});
		
		
		//====================================================== Js for float,variance and total change
		$('#stdcashfloat').on('mouseenter mouseleave change click keyup blur focus reload onload', function() {
			totalcashcal()
		   });
		$('#floatTotal').on('mouseenter mouseleave change click keyup blur focus reload onload', function() {
			totalcashcal()
		   });
	    $('#registerFloat,#depositM1,#requiredRegisterAmount,#registerFloat1,#depositM2,#requiredRegisterAmount1,#managerFloatTotal').on('change click keyup blur focus reload onload', function() {
			totalcashcal()
		   }); 
	    $('#m1_floatTotal,#m2_managerFloatTotal,#floatTotal,#managerFloatTotal').on('change click keyup blur focus reload onload', function() {
			totalcashcalFrontCounter()
		   });
		
		 
		// FLOAt For Manager2 part  ====================================================================================
		
		
		$('#2d1').on('mouseenter mouseleave change click keyup blur focus reload onload', function() {
		let totalManager = (2*$('#2d1').val());
		 let totalStaff = (2*$('#2d').val());
		 let variance = totalStaff - totalManager; 
		$('#variance_t112').val(variance.toFixed(2));    
        $('#t112').val(totalManager.toFixed(2));
		totalcashcal();
		});
		$('#1d1').on('mouseenter mouseleave change click keyup blur focus reload onload ready', function() {
		 let totalManager = (1*$('#1d1').val());
		 let totalStaff = (1*$('#1d').val());
		 let variance = totalStaff - totalManager; 
		$('#variance_t21').val(variance.toFixed(2));    
        $('#t21').val(totalManager.toFixed(2));
		totalcashcal()
		});
		$('#050c1').on('mouseenter mouseleave change click keyup blur focus reload onload ready', function() {
		let totalManager = (50*$('#050c1').val())/100;
		 let totalStaff = (50*$('#050c').val())/100;
		 let variance = totalStaff - totalManager; 
		$('#variance_t31').val(variance.toFixed(2));    
        $('#t31').val(totalManager.toFixed(2));
		totalcashcal()
		});
		$('#20c1').on('mouseenter mouseleave change click keyup blur focus reload onload ready', function() {	
		 let totalManager = (20*$('#20c1').val())/100;
		 let totalStaff = (20*$('#20c').val())/100;
		 let variance = totalStaff - totalManager; 
		$('#variance_t41').val(variance.toFixed(2));    
        $('#t41').val(totalManager.toFixed(2));
		totalcashcal()
		});
		$('#10c1').on('mouseenter mouseleave change click keyup blur focus reload onload', function() {	
		 let totalManager = (10*$('#10c1').val())/100;
		 let totalStaff = (10*$('#10c').val())/100;
		 let variance = totalStaff - totalManager; 
		$('#variance_t51').val(variance.toFixed(2));    
        $('#t51').val(totalManager.toFixed(2));
		totalcashcal()
		});
		$('#5c1').on('mouseenter mouseleave change click keyup blur focus reload onload', function() {
		 let totalManager = (5*$('#5c1').val())/100;
		 let totalStaff = (5*$('#5c').val())/100;
		 let variance = totalStaff - totalManager; 
		$('#variance_t61').val(variance.toFixed(2));
        $('#t61').val(totalManager.toFixed(2));
        
		totalcashcal()
		});
		
		$('#100d1').on('mouseenter mouseleave change click keyup blur focus reload onload', function() {
		 let totalManager = (100*$('#100d1').val());
		 let totalStaff = (100*$('#100d').val());
		 let variance = totalStaff - totalManager; 
		$('#variance_t71').val(variance.toFixed(2));    
        $('#t71').val(totalManager.toFixed(2));
		totalcashcal()
		});
		$('#50d1').on('mouseenter mouseleave change click keyup blur focus reload onload', function() {	
		let totalManager = (50*$('#50d1').val());
		 let totalStaff = (50*$('#50d').val());
		 let variance = totalStaff - totalManager; 
		$('#variance_t81').val(variance.toFixed(2));    
        $('#t81').val(totalManager.toFixed(2));
		totalcashcal()
		});
		$('#20d1').on('mouseenter mouseleave change click keyup blur focus reload onload', function() {	
		  let totalManager = (20*$('#20d1').val());
		 let totalStaff = (20*$('#20d').val());
		 let variance = totalStaff - totalManager; 
		$('#variance_t91').val(variance.toFixed(2));     
        $('#t91').val(totalManager.toFixed(2));
		totalcashcal()
		});
		$('#10d1').on('mouseenter mouseleave change click keyup blur focus reload onload', function() {	
		 let totalManager = (10*$('#10d1').val());
		 let totalStaff = (10*$('#10d').val());
		 let variance = totalStaff - totalManager; 
		$('#variance_t101').val(variance.toFixed(2));
        $('#t101').val(totalManager.toFixed(2));
		totalcashcal()
		});
		$('#5d1').on('mouseenter mouseleave change click keyup blur focus reload onload', function() {
		 let totalManager = (5*$('#5d1').val());
		 let totalStaff = (5*$('#5d').val());
		 let variance = totalStaff - totalManager; 
		$('#variance_t13').val(variance.toFixed(2));    
        $('#t13').val(totalManager.toFixed(2));
		totalcashcal()
		});
		
		commonTotal();

   
	 // BANK Deposit Page JS CODE ============================================================================================================    
	    
	 $('.managerBagCounted').on('change  keyup blur', function() {	
	    let coinBagValue = $(this).parents('.coinsCalculationRow').find('.coin_bag').val();
	    let managerBagCounted = $(this).parents('.coinsCalculationRow').find('.managerBagCounted').val();
	    let variance = Number(coinBagValue) - Number($(this).val());
	   
	     $(this).parents('.coinsCalculationRow').find('.varianceValue').val(variance.toFixed(2));
	     $(this).parents('.coinsCalculationRow').find('.actualAmount').val(Number(managerBagCounted).toFixed(2));
		});   
		
 $('#5d1,#10d1,#20d1,#50d1,#100d1,#5c1,#10c1,#20c1,#050c1,#1d1,#2d1,#m2_5d1,#m2_10d1,#m2_20d1,#m2_50d1,#m2_100d1,#m2_5c1,#m2_10c1,#m2_20c1,#m2_050c1,#m2_1d1,#m2_2d1').trigger('mouseenter');
   
    });
    
    // BANK RECONCILE Page JS CODE ============================================================================================================
    
    $('.amountReconcile').on('change  keyup blur', function() {	
	    let amountBanked = $(this).parents('.calculationRow').find('.amountBanked').val();
	    let amountReconcile = $(this).val();
	   
	    if(amountReconcile !='' && amountReconcile > 0){
	       let variance = Number(amountBanked) - Number(amountReconcile);
	   $(this).parents('.calculationRow').find('.reconcileVarianceAmount').val(variance.toFixed(2));     
	    }else{
	     $(this).parents('.calculationRow').find('.reconcileVarianceAmount').val('');   
	    }
	     
	   
		});
		
	//============================================== Float Build JS
	$(document).ready(function(){
	    
	
$(".numberInsafe").on("change keyup reload onload", function() {
   
    let BuildTo = $(this).parents(".menurow").find(".buildTo").val();
    let amountPerItem = $(this).parents(".menurow").find(".amountPerItem").val();
    let numberInsafe = $(this).val(); 
    let totalAmountOfCash = 0;

    
    let  orderFromBankAmount = Number(BuildTo) - Number(numberInsafe);
    let amountOfCash =  orderFromBankAmount * amountPerItem;
    
    $(this).parents(".menurow").find(".OrderFromBank").val(amountOfCash.toFixed(2));
    $(this).parents(".menurow").find(".amountOfCash").val(amountOfCash.toFixed(2));
    $('.OrderFromBank').each(function() {
    var value = parseFloat($(this).val());
    if (!isNaN(value)) {
        totalAmountOfCash += value;
    }
});

$(".amountInCashTotalInput").val(totalAmountOfCash.toFixed(2));
// $(".amountInCashTotal").html("$ "+totalAmountOfCash.toFixed(2))


});
})