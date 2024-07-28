document.querySelector("#invest_amount").addEventListener("keypress", function (evt) {
    if (evt.which != 8 && evt.which != 0 && evt.which < 48 || evt.which > 57)
    {
        evt.preventDefault();
    }
});



let choose_plan = document.getElementById('choose_plan')
let invest_amount = document.getElementById('invest_amount')
let profit_amount = document.getElementById('profit_amount')
let calculate_btn = document.getElementById('calculate-btn')
let message = document.getElementById('message')




choose_plan.onclick = () =>{
    calculate_btn.innerHTML = 'Calculate'
    invest_amount.style.border = '1px solid #fff'
    choose_plan.style.border = '1px solid #fff'
}

invest_amount.onkeyup = () =>{
    calculate_btn.innerHTML = 'Calculate'
    choose_plan.style.border = '1px solid #fff'
    invest_amount.style.border = '1px solid #fff'
}

calculate_btn.onclick = () =>{
    calcluateProfit()
}

function calcluateProfit(){
    if(choose_plan.value == 'Starter'){
        if(invest_amount.value >= 1000 && invest_amount.value <= 5999){
            calculate_btn.innerHTML = `Profit: $${(invest_amount.value * 0.3).toFixed(2)} weekly`
        }else{
            invest_amount.style.border = '1px solid #dc3545'
            choose_plan.style.border = '1px solid #dc3545'
            calculate_btn.innerHTML = "Capital Limit: $1,000.00 - $5,999.00"
        }
    }else if(choose_plan.value == 'Deluxe'){
        if(invest_amount.value >= 6000 && invest_amount.value <= 20999){
            calculate_btn.innerHTML = `Profit: $${(invest_amount.value * 0.4).toFixed(2)} weekly`
        }else{
            invest_amount.style.border = '1px solid #dc3545'
            choose_plan.style.border = '1px solid #dc3545'
            calculate_btn.innerHTML = "Capital Limit: $6,000.00 - $20,999.00"
        }
    }else if(choose_plan.value == 'Exclusive'){
        if(invest_amount.value >= 21000 && invest_amount.value <= 49999){
            calculate_btn.innerHTML = `Profit: $${(invest_amount.value * 0.45).toFixed(2)} weekly`
        }else{
            invest_amount.style.border = '1px solid #dc3545'
            choose_plan.style.border = '1px solid #dc3545'
            calculate_btn.innerHTML = "Capital Limit: $21,000.00 - $49,999.00"
        }
    }else if(choose_plan.value == 'IRA'){
        if(invest_amount.value >= 50000){
            calculate_btn.innerHTML = `Profit: $${(invest_amount.value * 0.5).toFixed(2)} monthly`
        }else{
            invest_amount.style.border = '1px solid #dc3545'
            choose_plan.style.border = '1px solid #dc3545'
            calculate_btn.innerHTML = "Capital Limit: $50,000.00 - Unlimited"
        }
    }
}