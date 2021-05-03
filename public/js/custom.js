
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

const textArray =['to help you get your dream job without stress', 'to help companies have access to the best talent at the snap of a finger', 'to ensure that all job seekers have access to varified jobs with ease for free'];

const typedTextSpan = document.querySelector('.type-text');
const cusorSpan= document.querySelector('.cursor');
const typingDelay = 200;
const erasingDelay =100;
const nextTextDelay =2000;
let textArrayIndex = 0;
let charIndex =0;

 function  typeFunction() {
     try {
     if(!cusorSpan.classList.contains('typing')){
         cusorSpan.classList.add('typing')
     }
     if(charIndex < textArray[textArrayIndex].length){

         typedTextSpan.textContent +=  textArray[textArrayIndex].charAt(charIndex);
         charIndex++;
         setTimeout(typeFunction, typingDelay );
        }
        else{
            cusorSpan.classList.remove('typing');
            setTimeout(eraseFunction,nextTextDelay)
        }

    } catch (error) {

    }
 }
 function eraseFunction(){
  if(charIndex >0){
    if(!cusorSpan.classList.contains('typing')){
        cusorSpan.classList.add('typing')
    }
      typedTextSpan.textContent = textArray[textArrayIndex].substring(0,charIndex-1);
      charIndex--;
      setTimeout(eraseFunction,erasingDelay)
  }
  else{
    cusorSpan.classList.remove('typing');
      textArrayIndex++;
      if(textArrayIndex >= textArray.length) textArrayIndex=0;
      setTimeout(typeFunction, typingDelay + 1100 )
  }
 }
document.addEventListener('DOMContentLoaded',function(){
    setTimeout(typeFunction,nextTextDelay + 200)
});


var buttons = document.querySelectorAll('.details');
function getID(){
    try {
        buttons.forEach(button => {
            button.addEventListener('click', (event) => {
                performSimpleAjax(event.target.id);
            })
        })
    } catch (error) {

    }
}

getID()
var width = Math.max(window.screen.width, window.innerWidth);
function performSimpleAjax(id){

    $.ajax({
        type: "GET",
        data: {id:id},
        url: "/get-job-details/"+id,
        success:function(res){
            // if(width < 721 ){

                jQuery('#cssloader').addClass('loader')
                $("#modal-body").html('')
                $('#vacancyModalLong').modal('show');
                setTimeout(() => {
                 $("#modal-body").html(res)
                 jQuery('#cssloader').removeClass('loader')
             }, 3000);
        },
        error:function(err){
           console.log('error ' + err.responseText );
        }
    })
}


var buttons2 = document.querySelectorAll('.skills-details');
function getSkillDdetails(){
    try {
        buttons2.forEach(button => {
            button.addEventListener('click', (event) => {
               performSimpleAjax2(event.target.id);
            })
        })
    } catch (error) {

    }
}

getSkillDdetails()

var width = Math.max(window.screen.width, window.innerWidth);
function performSimpleAjax2(id){

    $.ajax({
        type: "GET",
        data: {id:id},
        url: "/applicants/applicant-details/"+id,
        success:function(res){

                jQuery('#cssloader-applicant').addClass('loader')
                $("#applicant-details-modal-body").html('')
                $('#applicantDetailsModal').modal('show');
                setTimeout(() => {
                 $("#applicant-details-modal-body").html(res)
                 jQuery('#cssloader-applicant').removeClass('loader')
             }, 3000);
        },
        error:function(err){
           console.log('error ' + err.responseText );
        }
    })
}
$('#browse-talents').click(function(){
    $('.skills-lists').css('display','flex');
    $('.jobs-lists').css('display','none');
    $('#more-skills').css('opacity', 1)
    $('#more-jobs').css('opacity', 0)
    if($('.jobs-lists').html()==''){
        $('#heading').html('No Applicant Available At The Moment')
    }else{$('#heading').html('Skills Available')}
});

$('#browse-jobs').click(function(){
    $('.jobs-lists').css('display','flex');
    $('.skills-lists').css('display','none');
    $('#more-jobs').css('opacity', 1);
    $('#more-skills').css('opacity', 0);
    if($('.jobs-lists').html()==''){
        $('#heading').html('No Job Available At The Moment')
    }else{$('#heading').html('Jobs Available')}
})




