function getData(){
    let result = document.getElementById('search-result');
    let search_data = document.getElementById('search').value;
    let dataRequest = new XMLHttpRequest;
    dataRequest.onreadystatechange = function(){
        if(this.readyState == 4 && this.status == 200){
            result.innerHTML = this.responseText;
        }
    }
    dataRequest.open("GET", "search_exam.php?q=" + search_data, true);
    dataRequest.send();
}


document.getElementById('search').addEventListener("keyup", getData);
