/************************ var */
let now = new Date();
let age = document.getElementById('age');
let phone = document.getElementById('mob');
let inv_date = document.getElementById('inv-date');
let inv_time = document.getElementById('inv-time');
let treat = document.getElementById('treat-doc');
let pat = document.getElementById('patient');

// date
inv_date.value = `${now.getFullYear()}-${now.getMonth()+1}-${now.getDate()}`;

// time
inv_time.value = `${now.getHours()}:${now.getMinutes()}:${now.getSeconds()}`;

// get age patient
function getAge(){
    // pat id from select
    let patID = pat.value;
    if(patID == 'start'){
        age.innerHTML = '';
    }
    else{
        let dataRequest = new XMLHttpRequest;
        dataRequest.onreadystatechange = function(){
            if(this.readyState == 4 && this.status == 200){
                age.innerHTML = this.responseText;
            }
        }
        dataRequest.open("GET", "get_age.php?q=" + patID,true);
        dataRequest.send()
    }
    


}

// get mob patient
function getMob(){
    let patID = pat.value;
    if(patID == 'start'){
        phone.innerHTML = '';
    }
    else{
        let dataRequest = new XMLHttpRequest;
        dataRequest.onreadystatechange = function(){
            if(this.readyState == 4 && this.status == 200){
                phone.innerHTML = this.responseText;
            }
        }
        dataRequest.open("GET", "get_mob.php?q=" + patID,true);
        dataRequest.send()
    }
}

// get treat doctor
function getTreat(){
    let patID = pat.value;
    if(patID == 'start'){
        treat.innerHTML = '';
    }
    else{
        let dataRequest = new XMLHttpRequest;
        dataRequest.onreadystatechange = function(){
            if(this.readyState == 4 && this.status == 200){
                treat.innerHTML = this.responseText;
            }
        }
        dataRequest.open("GET", "get_treat.php?q=" + patID,true);
        dataRequest.send()
    }
    


}

pat.addEventListener("change", getAge);
pat.addEventListener("change", getMob);
pat.addEventListener("change", getTreat);

/********************************************************************/

let all_exams = document.querySelectorAll('tbody select');
let all_prices = document.querySelectorAll('.p');
let all_disconts = document.querySelectorAll('.d');
let all_amount = document.querySelectorAll('.a');
let total = document.getElementById('total');


for(let i = 0; i < all_exams.length; i++){
    all_exams[i].onchange = function(){
        let examID = all_exams[i].value;
        if( examID == 'start' ){
            all_prices[i].value = 0;
            all_disconts[i].value = 0;
            all_amount[i].value = 0;

            let total_amounts = 0;
            for(let a = 0; a < all_amount.length; a++){
                total_amounts += parseFloat(all_amount[a].value);
            }
            total.value = total_amounts;
        }
        else{
            let examRequest = new XMLHttpRequest;
            examRequest.onreadystatechange = function(){
                if(this.readyState == 4 && this.status == 200){
                    all_prices[i].value = this.responseText;
                    all_disconts[i].value = 0;
                    all_amount[i].value =  parseFloat(all_prices[i].value);

                    let total_amounts = 0;
                    for(let a = 0; a < all_amount.length; a++){
                        total_amounts += parseFloat(all_amount[a].value);
                    }
                    total.value = total_amounts;
                }

            }
            examRequest.open("GET", "get_price.php?q=" + examID, true);
            examRequest.send();
        }
    }
}


for(let i = 0; i < all_disconts.length; i++){
    all_disconts[i].onchange = function(){
        all_amount[i].value = parseFloat(all_prices[i].value) - parseFloat(all_disconts[i].value);

        let total_amounts = 0;
        for(let a = 0; a < all_amount.length; a++){
            total_amounts += parseFloat(all_amount[a].value);
        }
        total.value = total_amounts;
    }   
}

