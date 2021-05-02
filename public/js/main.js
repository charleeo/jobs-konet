const menuIcon = document.querySelector("#menu-icon");
const slideoutMenu = document.querySelector('#slideout-menu');
// const searchIcon = document.querySelector("#search-icon");
// const searchBox = document.querySelector('#searchbox');

// searchIcon.addEventListener('click', function(){
//     if(searchBox.style.top=="72px"){
//       searchBox.style.top="24px";
//       searchBox.style.pointerEvents = 'none'
//     }else{
//       searchBox.style.top = '72px';
//       searchBox.style.pointerEvents='auto';
//     }
// });

menuIcon.addEventListener('click',function(){
  if(slideoutMenu.style.opacity==1){
    slideoutMenu.style.opacity=0;
    slideoutMenu.style.pointerEvents="none";
  }else{
    slideoutMenu.style.opacity=1;
    slideoutMenu.style.pointerEvents="auto";
  }
})


const menuBtn = document.querySelector('.menu-btn');
const hamburger = document.querySelector('.menu-btn_burger');
const nav = document.querySelector('#slideout-menu');
const menuNav = document.querySelector('.menu-nav');
const navItem = document.querySelectorAll('.menu-nav_item');
let showMenu = false;
// menuBtn.addEventListener('click', toggleMenu);
// function toggleMenu()
// {
//   if(!showMenu)
//   {
//     hamburger.classList.add('open');

//     nav.style.opacity=1;
//     showMenu = true;
//   }
//   else{
//     hamburger.classList.remove('open');
//     nav.style.opacity=0;

//     showMenu = false;
//   }
// }


jQuery('#control-side-menu').click(function(){
    slideoutMenu.style.opacity=0;
    slideoutMenu.style.pointerEvents="none";
  $('#sidebar-wrapper').show('slow');
});

jQuery("#close-side-bar").click(function(){
    $('#sidebar-wrapper').hide('fast');
})


try {

    ClassicEditor
        .create( document.querySelector( '.editor ' ) )
        .catch( error => {

        } );

        ClassicEditor
        .create( document.querySelector( '.editor2 ' ) )
        .catch( error => {

        } );

        ClassicEditor
        .create( document.querySelector( '.editor3' ) )
        .catch( error => {

        } );

        ClassicEditor
        .create( document.querySelector( '.editor4' ) )
        .catch( error => {

        } );

        ClassicEditor
        .create( document.querySelector( '.editor5' ) )
        .catch( error => {

        } );
    AOS.init();
} catch (error) {
  console.log(error)
}
