const showMenuEl = document.querySelector('.showmenu-btn')
const menuContentEl = document.querySelector('#menu-bar')
const bodyEl = document.querySelector('body')
const showmenuPcEl = document.querySelector('.show-menu-pc')
const showmenuPcBtnEl = document.querySelector('.show-menu')
const box2InfoEl = document.querySelectorAll('.box-2-info')
const userNameEl = document.querySelector('.user_name');
const menuUserEl = document.querySelector('.user-menu');
//form search
const formSeachEl = document.querySelector('.form-search-box')
const btnSearchNavEl = document.querySelector('.menu-search')
const inputSearchEl = document.querySelector('.form-search-input')
const btnSearchEl = document.querySelector('.search-btn')
//show menu mobile
const btnShowMenuMobileEl = document.querySelector('.menu-mobile-icon')
const menuMobileWrapEl = document.querySelector('.menu-mobile-wrap')
const subMenuMobileEl = document.querySelectorAll('.sub-menu-mobile')
const btnDropDownSubMenuEl = document.querySelectorAll('.icon-dropdown-menu-mb')
const btnCloseMenuMbEl = document.querySelector('.close-nav-mb-icon')
var showMenu=true;
var showMenuPc=false;

    //show menu mobile
btnShowMenuMobileEl.addEventListener('click',()=>{
    menuMobileWrapEl.classList.add('active')
})
    //close menu mobile
btnCloseMenuMbEl.addEventListener('click',()=>{
    if (menuMobileWrapEl.classList.contains('active')){
        menuMobileWrapEl.classList.remove('active')
    }
})
    // show sub menu
btnDropDownSubMenuEl.forEach((icon,key)=>{
    icon.addEventListener('click',()=>{
        subMenuMobileEl[key].classList.toggle('active')
    })
})

    showMenuEl.addEventListener('click', () =>{
        if(window.innerWidth <1000){
            if(showMenu){
                menuContentEl.style.display='none'
                showMenu=false
            }else{
                menuContentEl.style.display='block'
                showMenu=true
            }
        }
    })
// form search
btnSearchNavEl.addEventListener('click',()=>{
    formSeachEl.classList.toggle('active')
})

// responsive pc
    showmenuPcBtnEl.addEventListener('click',()=>{
        if(window.innerWidth>750){
            if (menuUserEl && menuUserEl.classList.contains('active')){
                menuUserEl.classList.remove('active')
            }
            if (formSeachEl.classList.contains('active')){
                formSeachEl.classList.remove('active')
            }
            if(showMenuPc){
                showmenuPcEl.style.display='none'
                showMenuPc=false
            }else{
                showmenuPcEl.style.display='block'
                showMenuPc=true
            }
        }
    })

// chinh style tren pc va mobile cho box-2-info
box2InfoEl.forEach(box=>{
    if (window.innerWidth>1000){
        box.style.marginLeft= '-3'+'rem'
    }else{
        box.style.marginLeft= '-25'+'px'
    }
})

// menu user đăng nhập đăng xuất
if (userNameEl){
    userNameEl.addEventListener('click',()=>{
        menuUserEl.classList.toggle('active')
        if (showmenuPcEl.style.display='block'){
            showmenuPcEl.style.display='none'
        }
    })
}
//seach box nav
btnSearchEl.disabled=true
btnSearchEl.style.opacity=0.5
inputSearchEl.addEventListener('keyup',()=>{
    if (inputSearchEl.value){
        btnSearchEl.disabled=false
        btnSearchEl.style.opacity=1
    }else{
        btnSearchEl.disabled=true
        btnSearchEl.style.opacity=0.5
    }
})

//responsive meunu mobile
