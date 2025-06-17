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
function adminEditTravel(travel_id) {

    formSubmit(travel_id, "travel_id", "/admin/add-travel/");
}

// Admin check gets performed in the php file, required to submit via single button
function deleteAccount(user_id) {

    formSubmit(user_id, "user_id", "/php/process/deregister.php");
}

// Send user to account editing page in a valid way
function editAccount(user_id) {

    formSubmit(user_id, "user_id", "/edit-account/");
}

// Send user to the booking page
function bookTravel(travel_id) {

    formSubmit(travel_id, "travel_id", "/booking/");
}

// Allow users and admins to delete bookings
function removeBooking(booking_id) {

    formSubmit(booking_id, "booking_id", "/php/process/remove_booking.php/");
}

function approveBooking(booking_id) {
    formSubmit(booking_id, "booking_id", "/php/process/approve_booking.php");
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
