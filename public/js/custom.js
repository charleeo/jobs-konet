
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


    if(userResume.value == '')
    {
        newResumeDiv.classList.remove('letter_input');
        checkDiv.classList.add('letter_input');
        newResumeLabel.textContent = 'Upload Your Resume'
    }
});

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

let menu = document.querySelector("#menu-toggle")
$("#menu-toggle").click(function(e) {
  e.preventDefault();
  if(menu.textContent== 'open side menu'){
    menu.textContent = 'close side menu';
  }
  else{ menu.textContent = 'open side menu'}
  $("#wrapper").toggleClass("toggled");

});

if(document.body.contains(alertTypeInputFeld))
{
    alertTypeInputFeld.addEventListener('keyup', ()=>{
       alertTypeInputFeld.value = (alertTypeInputFeld.value).replace(/,/g, '')
    });
}
