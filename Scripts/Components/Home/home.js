function showJobAdditionForm() {
    document.getElementById('jobFormContainer').style.display='flex';
}

function toggleBetweenJobAndInternshipInputs(object) {
    package_field=document.getElementsByClassName('package');
    month_field=document.getElementsByClassName('month');
    salary_field=document.getElementsByClassName('salary');
    if (object==1) {
        package_field[0].style.display='block';
        package_field[1].style.display='block';
        package_field.required=true;
        month_field.required=false;
        salary_field.required=false;
        month_field[0].style.display='none';
        month_field[1].style.display='none';
        salary_field[0].style.display='none';
        salary_field[1].style.display='none';
    } else {
        package_field.required=false;
        month_field.required=true;
        salary_field.required=true;
        package_field[0].style.display='none';
        package_field[1].style.display='none';
        month_field[0].style.display='block';
        month_field[1].style.display='block';
        salary_field[0].style.display='block';
        salary_field[1].style.display='block';
    }
}