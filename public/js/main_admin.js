//show menu bar
const btnShowmenuEL = document.querySelector('.showmenu-link')
const navBarEl = document.querySelector('#nav-container')
const overFollowEl=document.querySelector('.overfolow')
// const formCreateCategoryEL = document.querySelector('.form-modal-category')
// const titleFormModalCateEl = document.querySelector('.form-category-modal-title')
// const btnUpdateCateEl = document.querySelectorAll('.action-categories-update')
// const inputCateNameEl = document.querySelector('#CategoryName')
// const selectCateParentEl = document.querySelector('#selectCategory')
// const optionParentEl = document.querySelectorAll('.option-parentid')
// const btnCateEl = document.querySelector('.btn-action-category-submit ')

//show menu bar
btnShowmenuEL.addEventListener('click',()=>{
    navBarEl.classList.add('active')
    overFollowEl.classList.remove('hidden')
})
overFollowEl.addEventListener('click',()=>{
    if(navBarEl.classList.contains('active')){
        navBarEl.classList.remove('active')
        overFollowEl.classList.add('hidden')
    }
})

window.addEventListener('resize',()=>{
    if(window.innerWidth< 600){
        if(navBarEl.classList.contains('active')){
            navBarEl.classList.remove('active')
            overFollowEl.classList.add('hidden')
        }
    }
})
//end show menu bar

//show modal category
// const closeModalCategoryIconEl = document.querySelector('.form-category-close-form__icon')
// const addCategoriesEl = document.querySelector('.add-categories-link')
// addCategoriesEl.addEventListener('click',(e)=>{
//     e.preventDefault()
//     titleFormModalCateEl.textContent='Create Category'
//     selectCateParentEl.value=0
//     inputCateNameEl.value=''
//     formCreateCategoryEL.classList.toggle('active')
// })
// closeModalCategoryIconEl.addEventListener('click',()=>{
//     formCreateCategoryEL.classList.remove('active')
// })
//
// //kiem tra khi request form bi loi thi van phai show modal len
// const errorModalCategoryEl=document.querySelector('.error')
// window.addEventListener('load',()=>{
//     if (errorModalCategoryEl){
//         formCreateCategoryEL.classList.add('active')
//     }else{
//         formCreateCategoryEL.classList.remove('active')
//     }
// })
//
// // khi edt form cung phai show modal len
//
// btnUpdateCateEl.forEach(btn=>{
//     btn.addEventListener('click',(e)=>{
//         e.preventDefault()
//         fetchDataEdit(e.target.dataset.cateid)
//     })
// })
//
// async function fetchDataEdit(id){
//     const res = await fetch(`http://127.0.0.1:8000/admin/categories/${id}/edit`)
//     const data = await res.json()
//     formCreateCategoryEL.classList.add('active')
//     titleFormModalCateEl.textContent="Update Category"
//     btnCateEl.textContent='Update Category'
//     const modaleFormEl =document.querySelector('#modalCategory')
//     modaleFormEl.method='Post'
//     modaleFormEl.action=`http://127.0.0.1:8083/admin/categories/${id}/edit`
//     const categoryName=data.category_name
//     const categoryParentId = data.parent_id
//     inputCateNameEl.value=categoryName
//     optionParentEl.forEach(option=>{
//         if(option.dataset.parentid == categoryParentId){
//             console.log(5)
//             selectCateParentEl.value=option.dataset.parentid
//         }else if(!categoryParentId){
//             selectCateParentEl.value=0
//         }
//     })
// }


