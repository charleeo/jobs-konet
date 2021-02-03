const menuIcon = document.querySelector("#menu-icon");
const slideoutMenu = document.querySelector('#slideout-menu');
const searchIcon = document.querySelector("#search-icon");
const searchBox = document.querySelector('#searchbox');

searchIcon.addEventListener('click', function(){
    if(searchBox.style.top=="72px"){
      searchBox.style.top="24px";
      searchBox.style.pointerEvents = 'none'
    }else{
      searchBox.style.top = '72px';
      searchBox.style.pointerEvents='auto';
    }
});

menuIcon.addEventListener('click',function(){
  if(slideoutMenu.style.opacity==1){
    slideoutMenu.style.opacity=0;
    slideoutMenu.style.pointerEvents="none";
  }else{
    slideoutMenu.style.opacity=1;
    slideoutMenu.style.pointerEvents="auto";
  }
})

jQuery('#control-side-menu').click(function(){
    slideoutMenu.style.opacity=0;
    slideoutMenu.style.pointerEvents="none";
  $('#sidebar-wrapper').show('slow');
});

jQuery("#close-side-bar").click(function(){
    $('#sidebar-wrapper').hide('fast');
})