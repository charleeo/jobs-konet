
let checkIfcheckboxIsChecked  = document.querySelector('#check-if-checked');
let currentWorkingStatus = document.querySelectorAll('.chech-current-working-status');
let endPeriod = document.querySelectorAll('.end-period');
let submitButton = document.querySelectorAll('.submit-data');
let checkForNewResume = document.querySelector('#check');
let newResume = document.querySelector('#new_resume');
let newResumeDiv = document.querySelector('#new_resume_div');
let faPlus = document.querySelector('.fa-plus');
let coverLetterInput =  document.querySelector('#letter_input');
let letterToBeUpLoaded = document.querySelector('#letter_to_upload');
let saveLetter = document.querySelector('#save_letter');
let userResume = document.querySelector('#user_resume');
let newResumeLabel = document.querySelector('#new_resume_label');
let checkDiv = document.querySelector('#check-div');
let alertTypeInputFeld = document.querySelector('#alert-type');

// This function removes white spaces from a string
function removeSpaces(string) {
    return string.split(' ').join('');
}


window.addEventListener('load', ()=>{

try {
    
    if(userResume.value == '')
    {
        newResumeDiv.classList.remove('letter_input');
        checkDiv.classList.add('letter_input');
        newResumeLabel.textContent = 'Upload Your Resume'
    }
} catch (error) {
    
}
});

try {

    
    if(document.body.contains(faPlus) || document.body.contains(checkForNewResume))
    {
    
        checkForNewResume.addEventListener('click',function(){
    
            if(checkForNewResume.checked  )
            {
                newResumeDiv.classList.remove('letter_input')
            }
            else{         newResumeDiv.classList.add('letter_input');      }
        });
    
        faPlus.addEventListener('click', ()=>{
    
            coverLetterInput.classList.toggle('letter_input');
            saveLetter.classList.toggle('letter_input');
        });
    
        coverLetterInput.addEventListener('input', ()=>{
            if(removeSpaces(coverLetterInput.value) !== '')
            {
                letterToBeUpLoaded.value = '';
    
    
            }
        });
    
        if(removeSpaces(coverLetterInput.value) !== '')
        {
            saveLetter.classList.remove('letter_input');
            coverLetterInput.classList.remove('letter_input')
    
        }
    }
} catch (error) {
    
}

try {
    
    if(document.body.contains(checkIfcheckboxIsChecked)){
    
        checkIfcheckboxIsChecked.addEventListener('click', ()=>
        {
            if(checkIfcheckboxIsChecked.checked)
            {
                currentWorkingStatus.forEach((item)=>{
                    item.style.display = 'none';
                });
            }
            else{ currentWorkingStatus.forEach((item)=>{
                item.style.display = 'block';
            });
        }
            endPeriod.forEach(p =>{
    
                if(checkIfcheckboxIsChecked.checked)
                {
                    p.value = '';
                }
            });
        });
    
        if(checkIfcheckboxIsChecked.checked )
        {
            currentWorkingStatus.forEach((item)=>{
                item.style.display = 'none';
            });
        }
    
    }
} catch (error) {
    
}

endPeriod.forEach(period => {
    period.addEventListener('change', ()=>{

        if(period.value != '')
        {

            checkIfcheckboxIsChecked.disabled = true;
        }
       else if(period.value == '')
       {
           checkIfcheckboxIsChecked.disabled = false;
       }
    });

});

let menu = document.querySelector("#menu-toggle");
let bootstrapNavbarToggler = $(".navbar-toggler-icon");

try {
    
    bootstrapNavbarToggler.click(function(){
        $("#wrapper").toggleClass("toggled");
    });
     
    if(window.location.href === "http://127.0.0.1:8000/"){
        menu.style.display = 'none';
    }
    $("#menu-toggle").click(function(e) {
        
      e.preventDefault();
      $("#wrapper").toggleClass("toggled");
    });
} catch (error) {
    
}

try {
    
    if(document.body.contains(alertTypeInputFeld))
    {
        alertTypeInputFeld.addEventListener('keyup', ()=>{
           alertTypeInputFeld.value = (alertTypeInputFeld.value).replace(/,/g, '')
        });
    }
} catch (error) {
    
}


function  performAjaxAction(type,url,data,messageTag,formFieldToreset){
    messageTag.html("<span class='text-info'>switching ... Please wait</span>")
      $.ajax({
        type: type,
        url: url,
        data: data.serialize(),
        success:function(re){
          ajaxIsSuccessFull(re,messageTag,formFieldToreset);
      },
      error:function(err){
        ajaxFailed(err, 'There was an error connecting to backend')
      }
      });
  }

  function ajaxFailed(error, messageString){
    alert(messageString + " " + error.responseText);
  }

  function ajaxIsSuccessFull(re,messageTag,formFieldToreset){

    let jsonObj = JSON.parse(re);
    let objectKey = Object.keys(jsonObj);

    if(objectKey[0] == 'error'){
      messageTag.removeClass("text-success");
      messageTag.addClass("text-danger");
      setTimeout(function(){
        messageTag.html('')
      },5000)
    }else if(objectKey[0] == 'success'){
      messageTag.removeClass("text-danger");
      messageTag.addClass('text-success');
      formFieldToreset.trigger('reset');
      messageTag.fadeIn('fast');
      setTimeout(function(){
        messageTag.fadeOut('slow');
      },4000);
      setTimeout(function(){
        window.location.reload(true);
      },6000);
    }
  messageTag.html(Object.values(jsonObj)[0]);
  }

  let messageHtml= $("#switch_user_message_tage");
  let switchUsageForm = $("#switch_user_form");

  $("#switch_user").change(function(e){

    performAjaxAction("POST",'/users/switch-user-type',switchUsageForm,messageHtml,switchUsageForm);
  });



    
