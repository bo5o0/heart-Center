let bars = document.getElementById("go");
let linksBox = document.getElementById("links-box");
let pageBox = document.getElementById("page-box");

bars.onclick = function(){
    linksBox.classList.toggle("w-0");
    pageBox.classList.toggle("w-100");
}

let li_elem = document.getElementById("set");
let sub_list = document.getElementById("sub-list");
let icon_arrow = document.getElementById("icon-arrow");

li_elem.onclick = function(){
    sub_list.classList.toggle("h-s");
    icon_arrow.classList.toggle("ro");
}

let links_title = [
    "Dashboard",
    "section",
    "Treatment Doctor",
    "Patient",
    "Job",
    "Department",
    "Employee",
    "Examination",
    "Invoice",
    "Reports"
];


let page_title = document.querySelector(".page-title");
let all_links = document.querySelectorAll("nav a");

for( let i = 0; i < links_title.length; i++ ){
    if( page_title.innerHTML.includes(links_title[i]) ){
        for( let a = 0; a < all_links.length; a++ ){
            all_links[a].classList.remove("act");
            all_links[i].classList.add("act");
        }
    }
}

