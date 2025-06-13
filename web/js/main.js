// Short named redirect function so that it is easy to type
function rd(href) {
    window.location.href = href;
}

// Travel submitting to enter the /item/ page
function enterItemPage(travelId) {

    formSubmit(travelId, "travel_id", "/item/");
}

// Review submitting to enter the /review/ page
function enterReviewPage(travelId) {

    formSubmit(travelId, "travel_id", "/review/");
}

// Mark a contact request as answered
function adminAnswerContact(contactId) {

    formSubmit(contactId, "contact_id", "/php/process/answer_contact.php");
}

// Admin check gets performed in the php file, required to submit via single button
function adminRemoveTravel(travelId) {

    formSubmit(travelId, "travel_id", "/php/process/remove_travel.php");
}

// Admin check gets performed in the php file, required to submit via single button
function adminRemoveLocation(locationId) {

    formSubmit(locationId, "location_id", "/php/process/remove_location.php");
}

// Admin check gets performed in the php file, required to submit via single button
function adminEditLocation(locationId) {

    formSubmit(locationId, "location_id", "/admin/add-location/");
}

// Admin check gets performed in the php file, required to submit via single button
function adminEditTravel(travelId) {

    formSubmit(travelId, "travel_id", "/admin/add-travel/");
}

// Created to avoid repeating code
function formSubmit(id, name, action) {

    document.body.innerHTML += `<form id='form' method="POST" action='${action}'><input type='hidden' name="${name}" value="${id}"></form>`;
    setTimeout(() => {
        console.log("Waiting for dom to update...");
    }, 50)

    const form = document.getElementById('form');

    form.submit();
}
