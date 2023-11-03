
function onSeatHover(seatIdx) {
    let element = document.getElementById(seatIdx.id);
    let text = element.getElementsByTagName("span")[0];
    text.style.display = 'unset';
}


function onSeatHoverEnd(seatIdx) {
    let element = document.getElementById(seatIdx.id);
    let text = element.getElementsByTagName("span")[0];
    text.style.display = 'none';
}

let selectionList = [];

function onSeatSelected(seatIdx) {
    let idx = seatIdx.id;
    let element = document.getElementById(idx);
    let input = element.getElementsByTagName("input")[0];
    let selected = input.value === idx;
    if (selected) {
        seatIdx.style.backgroundColor = 'white';
        input.value = "";
        selectionList.splice(selectionList.indexOf(idx));
    } else {
        seatIdx.style.backgroundColor = '#F5CB5C';
        input.value = `${idx}`;
        selectionList.push(idx);
    }
    let btn = document.getElementById("proceed-btn");
    if (selectionList.length == 0) {
        btn.disabled = true;
    } else {
        btn.disabled = false;
    }
    let totalTickets = document.getElementById('total-tickets');
    totalTickets.innerHTML = `${selectionList.length} Tickets`
}

window.onload = () => {
    let btn = document.getElementById("proceed-btn");
    btn.disabled = true;
}