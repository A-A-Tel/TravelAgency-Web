// Short named redirect function so that it is easy to type
function rd(href) {
    window.location.href = href;
}

// Travel submitting to enter the /item/ page
function travelSubmit(travel_id) {

    document.body.innerHTML += `<form id='form' action='/item/'><input type='hidden' name="travel_id" value="${travel_id}"></form>`;
    setTimeout(() => {}, 50)

    const form = document.getElementById('form');

    form.submit();
}