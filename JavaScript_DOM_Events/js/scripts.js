// Select elements...

// querySelector

const headingText = document.querySelector('.header__text h2');
console.log(headingText);

headingText.textContent = 'New Heading'; // You can also use .text

// querySelectorAll
const links = document.querySelectorAll('.navigation a');
console.log(links);

// Some operations...

// Change the text
links[0].textContent = 'New Link Text';

// Change the first link's href
links[0].href = 'google.com';

// Add a class...
links[0].classList.add('new-class');

// Remove a class...
// links[0].classList.remove('navigation__link');


// Generate HTML from JavaScript...
const newLink = document.createElement('A');

console.log(newLink);

// A link has a class...
newLink.classList.add('navigation__link');

// Has an href
newLink.href = 'new-link.html';

// Has text...
newLink.textContent = 'A New Link';

// console.log(newLink);

// Finally add it where we want to place it...

// You have to select the parent element

const navigation = document.querySelector('.navigation');
navigation.appendChild(newLink);






// Events in JavaScript...

// There are many events happening in your sites and web applications, when a user clicks, when they scroll, when pressing a button, submitting a form, but one of the most common is waiting for the document to be ready...



console.log('1');
window.addEventListener('load', function() { // When the JS file and dependent files have loaded like HTML and images...
    console.log('2');
});

window.onload = function() {
    console.log('3')
};

document.addEventListener('DOMContentLoaded', function() { // This executes when HTML has been downloaded but doesn't wait for CSS or images...
    console.log('4');
});

console.log('5');

// These closures can also be with a separate function...



// // Scroll Events...
// window.onscroll = function(e) {
//     console.log('scrolling...');

//     console.log(this.scrollY);
// }



// Click and submit events...

// const submitBtn = document.querySelector('.form input[type=submit]');
// console.log(submitBtn);

// submitBtn.addEventListener('click', function() { // callback or closure 
//     console.log('click');
// });

const data = {
    name: '',
    email: '',
    message: ''
}

// submit
const form = document.querySelector('.form');

form.addEventListener('submit', function(e) {
    e.preventDefault();

    console.log(e);

    console.log('Clicked and the page no longer reloads');

    console.log(data);

    // Validate the Form...

    const { name, email, message } = data;

    if(name === '' || email === '' || message === '' ) {
        console.log('At least one field is empty');
        showError('All fields are required');
        return; // Stops the execution of this function
    }

    console.log('Everything is fine...')

    showMessage('Message sent successfully');
});


function showError(message) {
    const alert = document.createElement('p');
    alert.textContent = message;
    alert.classList.add('error');

    form.appendChild(alert);

    setTimeout(() => {
        alert.remove();
    }, 3000);
}

function showMessage(message) {
    const alert = document.createElement('p');
    alert.textContent = message;
    alert.classList.add('success');
    form.appendChild(alert);

    setTimeout(() => {
        alert.remove();
    }, 3000);
}


// Input Events...
const name = document.querySelector('#name');
const email = document.querySelector('#email');
const message = document.querySelector('#message');


name.addEventListener('input', readText);
email.addEventListener('input', readText);
message.addEventListener('input', readText);

function readText(e) {
    // console.log(e);
    // console.log(e.target.value);

    data[e.target.id] = e.target.value;

    console.log(data);
}