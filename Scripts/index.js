console.log("scripts are working");

function hideNotificationBar() {
	document.getElementById("notifications").style.display = "none";
}

function toggleHeaderLoginOptions() {
    let headerLoginOptions=document.getElementById("headerLoginOptions");
	if (headerLoginOptions.style.display === "none") {
		headerLoginOptions.style.display = "block";
	} else {
		headerLoginOptions.style.display = "none";
	}
}

let landingPageImages=[
	"https://images.unsplash.com/photo-1562516155-e0c1ee44059b?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1632&q=80",
	"https://cdn.shopify.com/app-store/listing_images/7cd2f69048a97092d60b5f6b3be10699/banner/CMX6mubr0PgCEAE=.png",
	"https://images.unsplash.com/photo-1586941962765-d3896cc85ac8?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=2070&q=80"
];

let current_index=0;

function changeBackgroundOfLandingpage() {
	try {
		document.getElementById('introSection').style.background=`
		url('${landingPageImages[current_index]}')
		`;
		current_index=(current_index+1)%landingPageImages.length;
	} catch (error) {
		// console.log(error);
	}
}
setInterval(() => {
	changeBackgroundOfLandingpage()
}, 2000);