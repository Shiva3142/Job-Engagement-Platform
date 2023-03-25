let job_type = "";

function addJobType(object) {
	if (object == "jobOption1") {
		document.getElementById("jobOption1").style.background = "aqua";
		document.getElementById("jobOption2").style.background = "white";
		job_type = "internship";
	} else if (object == "jobOption2") {
		document.getElementById("jobOption1").style.background = "white";
		document.getElementById("jobOption2").style.background = "aqua";
		job_type = "job";
	} else if (job_type == object) {
		document.getElementById("jobOption1").style.background = "white";
		document.getElementById("jobOption2").style.background = "white";
		job_type = "";
	}
}

let min_salary = 0;
function addMinSalary(object, salary) {
	if (min_salary != salary) {
		min_salary = salary;
		document.getElementById("minSalary1").style.background = "white";
		document.getElementById("minSalary2").style.background = "white";
		document.getElementById("minSalary3").style.background = "white";
		document.getElementById("minSalary4").style.background = "white";
		document.getElementById("minSalary5").style.background = "white";
		document.getElementById(object).style.background = "aqua";
	} else {
		min_salary = 0;
		document.getElementById("minSalary1").style.background = "white";
		document.getElementById("minSalary2").style.background = "white";
		document.getElementById("minSalary3").style.background = "white";
		document.getElementById("minSalary4").style.background = "white";
		document.getElementById("minSalary5").style.background = "white";
	}
}

function applyTheFilters() {
	let query = "";
	let isAndNeeded = false;
	if (job_type != "") {
		query = query + `?job_type=${job_type}`;
		isAndNeeded = true;
	}
	if (min_salary != 0) {
		if (isAndNeeded) {
			query = query + `&min_salary=${min_salary}`;
		} else {
			query = query + `?min_salary=${min_salary}`;
		}
		isAndNeeded = true;
	}
	let location = document.getElementById("location").value;
	if (location != "") {
		if (isAndNeeded) {
			query = query + `&location=${location}`;
		} else {
			query = query + `?location=${location}`;
		}
	}
	console.log(query);
	if (query!="") {
		window.location = `http://localhost/Components/Jobs${query}`;
	} else {
		window.location = "http://localhost/Components/Jobs";
	}
}







function updateFileLabel(event) {
    let fileLabel=document.getElementById('fileLabel');
    let file=document.getElementById('file');
    let list_of_file = file.files;
    console.log(list_of_file.length);
    if (list_of_file.length>0) {
        console.log(list_of_file);
        let string=``
        let counter=0;
        for (let index = 0; index < list_of_file.length; index++) {
            console.log(list_of_file[index].name);
            string=string+`
            <div>
                ${++counter}] ${list_of_file[index].name}
            </div>
            <br/>
            `;
        }
        fileLabel.innerHTML=string;
    } else {
        fileLabel.innerHTML="Upload File Here";
    }
}