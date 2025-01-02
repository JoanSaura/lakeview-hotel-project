//Insert Error Customer
document.getElementById('registerForm').addEventListener('submit', function(event) {
    let errors = {};

    const firstName = document.getElementById('first-name').value.trim();
    const lastName = document.getElementById('last-name').value.trim();
    const identification = document.getElementById('identification').value.trim();
    const email = document.getElementById('email').value.trim();
    const phoneNumber = document.getElementById('phonenumber').value.trim();
    const password = document.getElementById('password').value.trim();

    if (!/^[A-ZÁÉÍÓÚÑ][a-záéíóúñ]*$/.test(firstName)) {
        errors['first-name'] = 'First Name must start with a capital letter and contain only letters.';
    }
    if (!/^[A-ZÁÉÍÓÚÑ][a-záéíóúñ]*$/.test(lastName)) {
        errors['last-name'] = 'Last Name must start with a capital letter and contain only letters.';
    }
    if (identification === '') {
        errors['identification'] = 'Identification cannot be empty.';
    }
    if (!/^\S+@\S+\.\S+$/.test(email)) {
        errors['email'] = 'Invalid email format.';
    }
    if (!/^[0-9]{7,}$/.test(phoneNumber)) {
        errors['phonenumber'] = 'Phone Number must contain at least 7 digits.';
    }
    if (password.length < 6) {
        errors['password'] = 'Password must be at least 6 characters long.';
    }

    ['first-name', 'last-name', 'identification', 'email', 'phonenumber', 'password'].forEach(function(field) {
        const errorDisplay = document.getElementById(`error-${field}`);
        if (errors[field]) {
            errorDisplay.textContent = errors[field];
        } else {
            errorDisplay.textContent = '';
        }
    });

    if (Object.keys(errors).length > 0) {
        event.preventDefault();
    }
});
//Update Customer Form
function populateCustomerDetails(customerId) {
    const selectedOption = document.querySelector(`#customer-select option[value="${customerId}"]`);
    if (selectedOption) {
        document.getElementById('first-name-input').value = selectedOption.getAttribute('data-first-name');
        document.getElementById('last-name-input').value = selectedOption.getAttribute('data-last-name');
        document.getElementById('identification-input').value = selectedOption.getAttribute('data-identification');
        document.getElementById('email-input').value = selectedOption.getAttribute('data-email');
        document.getElementById('phone-input').value = selectedOption.getAttribute('data-phone');
    }
}

document.getElementById('update-customer-form').addEventListener('submit', function(event) {
    let errors = {};

    const firstName = document.getElementById('first-name-input').value.trim();
    const lastName = document.getElementById('last-name-input').value.trim();
    const identification = document.getElementById('identification-input').value.trim();
    const email = document.getElementById('email-input').value.trim();
    const phoneNumber = document.getElementById('phone-input').value.trim();
    const password = document.getElementById('password').value.trim();

    if (!/^[A-ZÁÉÍÓÚÑ][a-záéíóúñ]*$/.test(firstName)) {
        errors['first-name'] = 'First Name must start with a capital letter and contain only letters.';
    }
    if (!/^[A-ZÁÉÍÓÚÑ][a-záéíóúñ]*$/.test(lastName)) {
        errors['last-name'] = 'Last Name must start with a capital letter and contain only letters.';
    }
    if (identification === '') {
        errors['identification'] = 'Identification cannot be empty.';
    }
    if (!/^\S+@\S+\.\S+$/.test(email)) {
        errors['email'] = 'Invalid email format.';
    }
    if (!/^[0-9]{7,}$/.test(phoneNumber)) {
        errors['phone'] = 'Phone Number must contain at least 7 digits.';
    }
    if (password.length < 6) {
        errors['password'] = 'Password must be at least 6 characters long.';
    }

    ['first-name', 'last-name', 'identification', 'email', 'phone', 'password'].forEach(function(field) {
        const errorDisplay = document.getElementById(`error-${field}`);
        if (errors[field]) {
            errorDisplay.textContent = errors[field];
        } else {
            errorDisplay.textContent = '';
        }
    });

    if (Object.keys(errors).length > 0) {
        event.preventDefault();
    }
});
//Update Reservation Info
    function populateReservationDetails(reservationId) {
        const selectedOption = document.querySelector(`#reservation-select option[value="${reservationId}"]`);
        if (selectedOption) {
            document.getElementById('client-select').value = selectedOption.getAttribute('data-client-id');
            const roomId = selectedOption.getAttribute('data-room-id');
            document.querySelector(`#room-details option[value="${roomId}"]`).selected = true;
            const dateIn = selectedOption.getAttribute('data-date-in');
            const dateOut = selectedOption.getAttribute('data-date-out');
            document.getElementById('date-in').value = dateIn;
            document.getElementById('date-out').value = dateOut;
            document.getElementById('reservation-price').value = selectedOption.getAttribute('data-room-price');
            const reservationState = selectedOption.getAttribute('data-state');
            document.getElementById('state').value = reservationState; 
            document.getElementById('reservation-id').value = reservationId;
        }
    }
//Update Rooms Info
    function populateRoomDetails(roomNumber) {
        const selectedOption = document.querySelector(`#room-select option[value="${roomNumber}"]`);
        if (selectedOption) {
            document.getElementById('room-number-input').value = roomNumber;
            document.getElementById('room-type').value = selectedOption.getAttribute('data-type-id');
            document.getElementById('room-description').value = selectedOption.getAttribute('data-description');
        }
    }
document.addEventListener('DOMContentLoaded', () => {
    document.querySelectorAll('form.delete-form').forEach((form) => {
        form.addEventListener('submit', (e) => {
            const confirmDelete = confirm("Are you sure you want to delete this record?");
            if (!confirmDelete) {
                e.preventDefault(); 
            }
        });
    });
});
