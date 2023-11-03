
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
let totalSelected = 0;

function onSeatSelected(seatIdx, selectedSeats) {
    let idx = seatIdx.id;
    let element = document.getElementById(idx);
    let input = element.getElementsByTagName("input")[0];
    let selected = input.value === idx;
    if (selectionList.length < totalSelected && !selectionList.includes(idx)) {
        if (selected) {
            seatIdx.style.backgroundColor = 'white';
            input.value = "";
            selectionList.splice(selectionList.indexOf(idx));
        } else {
            seatIdx.style.backgroundColor = '#F5CB5C';
            input.value = `${idx}`;
            selectionList.push(idx);
        }
    } else if (selectionList.includes(idx)) {
        seatIdx.style.backgroundColor = 'white';
        input.value = "";
        console.log(selectionList.indexOf(idx), selectionList)
        selectionList = selectionList.filter(a => a !== idx);
        console.log(selectionList)
    } else {
        alert("You've reached your selected seats limit!")
    }
    let totalTickets = document.getElementById('total-tickets');
    totalTickets.innerHTML = `${selectionList.length} Tickets`
}

function resetSelectedSeats(seatArray) {
    console.log("test")
    console.log(seatArray);

    selectionList = seatArray;
    totalSelected = seatArray.length;

    let totalTickets = document.getElementById('total-tickets');
    totalTickets.innerHTML = `${selectionList.length} Tickets`

    for (let i = 0; i < seatArray.length; i++) {
        let seat = document.getElementById(seatArray[i]);
        seat.className = "seat-box available";
        seat.style.backgroundColor = "gray";
    }
}