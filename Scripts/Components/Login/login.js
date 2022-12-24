function toggleUserAndAdminLogin(object) {
    const user=document.getElementById('userLogin');
    const admin=document.getElementById('adminLogin');
    defaultLoginOptions=document.getElementById('defaultLoginOptions');
    if (object==1) {
        user.style.display='flex';
        admin.style.display='none'
    } else {
        user.style.display='none';
        admin.style.display='flex';
    }
    defaultLoginOptions.style.display='none';
}

function toggleUserLoginAndRegister(object) {
    const user_form_1=document.getElementById('user_form_1');
    const user_form_2=document.getElementById('user_form_2');
    if (object==1) {
        user_form_1.style.display='flex';
        user_form_2.style.display='none';
    } else {
        user_form_2.style.display='flex';
        user_form_1.style.display='none';
    }
}
function toggleAdminLoginAndRegister(object) {
    const admin_form_1=document.getElementById('admin_form_1');
    const admin_form_2=document.getElementById('admin_form_2');
    if (object==1) {
        admin_form_1.style.display='flex';
        admin_form_2.style.display='none';
    } else {
        admin_form_2.style.display='flex';
        admin_form_1.style.display='none';
    }
}