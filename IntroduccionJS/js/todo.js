// variables
var product_var = 'gamer headphones';

product_var = true; // resignation

var product1_var = 'computer',
    available1_var = true,
    category_var = 'computers';

var available_var;

var name_product_var = 'screen hd';
var nameProduct_var = 'screen hd';
var NameProduct_var = 'screen hd';


// let 

let product_let = 'gamer headphones';
let available_let;

product_let = true; // resignation
let product1_let = 'computer',
    available1_let = true,
    category_let = 'computers';

let available_let_;
let name_product_let = 'screen hd';
let nameProduct_let = 'screen hd';
let NameProduct_let = 'screen hd';


// const

const product_const = 'gamer headphones';
const available_const = true;
// product = true; // resignation
const product1_const = 'computer',
      available1_const = true,
      category1_const = 'computers';

const available_const_ = true;
const name_product_const = 'screen hd';
const nameProduct_const = 'screen hd';
const NameProduct_const = 'screen hd';



// strings

let product_string = 'gamer headphones';
product_string_length = product_string.length; // 17
product_string_upper = product_string.toUpperCase(); // 'GAMER HEADPHONES'
product_string_lower = product_string.toLowerCase(); // 'gamer headphones'
product_string_index = product_string.indexOf('headphones'); // 6
product_string_char = product_string.charAt(0); // 'h'
product_string_char_last = product_string.charAt(product_string.length - 1); // 's'
product_string_split = product_string.split(' '); // ['gamer', 'headphones']
product_string_split_first = product_string.split(' ')[0]; // 'gamer'
let list = product_string.split(' ');
product_string = list[0]; // 'gamer'

// numbers

const number1 = 100;
const number2 = 200;
let result_math = number1 + number2; // 300
result_math = number1 - number2; // -100
result_math = number1 * number2; // 20000
result_math = number1 / number2; // 0.5
result_math = number1 % number2; // 100
result_math = number1 ** 2; // 10000
result_math = Math.PI; // 3.141592653589793
result_math = Math.round(3.14); // 3
result_math = Math.ceil(3.14); // 4
result_math = Math.floor(3.14); // 3
result_math = Math.random(); // random number between 0 and 1
result_math = Math.floor(Math.random() * 100); // entre 0 y 99

// operation orders

let result;

result = 10 + 5 * 2; // 20
result = (10 + 5) * 2; // 30
result = (10 + 5) * 2 - 5; // 25
result = (10 + 5) * (2 - 5); // -45
result = (10 + 5) * (2 - 5) / 2; // -22.5
result = (10 + 5) * (2 - 5) / 2 + 10; // -12.5

// increments

let counter = 10;

counter++; // 11
counter++; // 12
counter += 5; // 17
counter--; // 16
counter -= 5; // 11
counter *= 2; // 22
counter /= 2; // 11

let obj_product = {
    name_product: 'gamer headphones',
    price : 100,
    available: true,
}

// console.log(obj_product);

// console.log(obj_product.price);
// console.log(obj_product['price']);

// destructuring
const {price} = obj_product; // variable price = 100
const {name_product, available} = obj_product; // variable name = 'gamer headphones', available = true
console.log(price);
console.log(name_product);
console.log(available);

// objects methods

Object.freeze(obj_product); // prevents changes to the object
obj_product.price = 200; // does not change the price
console.log(obj_product.price); // still 100

obj_product = {...obj_product}; // rewrites the object but without the freeze
Object.seal(obj_product); // prevents adding or removing properties, but allows changing values
obj_product.price = 200; // changes the price
console.log(obj_product.price); // now 200
Object.assign(obj_product, {price: 300}); // changes the price to 300
console.log(obj_product.price); // now 300

// arrays
const months = ['January', 'February', 'March', 'April', 'May'];
months.push('June'); // add to the end
months.unshift('December'); // add to the beginning
months.pop(); // remove the last element
months.shift(); // remove the first element
months.splice(2, 1); // start at index 2 and delete 1 element
months.reverse(); // reverse the array
months.sort(); // sort alphabetically


const newArray = [...months, 'June'];
console.table(newArray);

//forEach

months.forEach(function(month) {
    console.log(month);
})

// includes

console.log(months.includes('May'));

// some

const array_of_objects = [
    {id: 1, name: 'gamer headphones', price: 100},
    {id: 2, name: 'mechanical keyboard', price: 200},
];
console.log(array_of_objects.some(p => p.name === 'gamer headphones'));

//reduce and filter

console.log(array_of_objects.reduce((total, producto) => total + producto.price, 0));
array_of_objects.filter(p => p.price > 100).forEach(p => console.log(p.name)); // print the names of the products with a price greater than 100

// property methods

const audio_player = {
    play: function() {
        console.log('playing');
    },
    pause: function() {
        console.log('paused');
    }
}

audio_player.play();
audio_player.pause();

// arrow functions

const sumar = (a, b) => a + b;
const sumar2 = (a, b) => {
    return a + b;
}

// control estructures

let color;
random_number = Math.floor(Math.random() * 10);
if (random_number % 2 === 0 && random_number !== 0) {
    console.log(random_number)
    console.log('true');
    color = 'red';
} else if (random_number % 2 !== 0 && random_number !== 0) {
    console.log(random_number)
    console.log('false');
    color = 'blue';
} else {
    console.log(random_number);
    color = '';
}

// switch

switch (color) {
    case 'red':
        console.log('color is red');
        break;
    case 'blue':
        console.log('color is blue');
        break;
    default:
        console.log('color is not red or blue');
        break;
}

// this 

const user = {
    name: 'Stifh',
    age: 20,
    sayHello: function() {
        console.log(`Hello ${this.name}`);
    }
}

user.sayHello();


// objet literal and constructor

function Product(name, price) {
    this.name = name;
    this.price = price;
}

const product_constructor1 = new Product('gamer headphones', 100);
const product_constructor2 = new Product('mechanical keyboard', 200);

console.log(product_constructor1);
console.log(product_constructor2);

// class heritage and polymorphism
class Product2 {
    constructor(name, price) {
        this.name = name;
        this.price = price;
    }
    sayHello() {
        console.log(`Hello ${this.name} and the cost is ${this.price}`);
    }


}

const product_class1 = new Product2('gamer headphones', 100);
const product_class2 = new Product2('mechanical keyboard', 200);

product_class1.sayHello();
product_class2.sayHello();

class Product3 extends Product2 {
    constructor(name, price, discount) {
        super(name, price);
        this.discount = discount;
    }
    sayHello() {
        console.log(`Hello ${this.name} and the cost is ${this.price} and the discount is ${this.discount}`);
    }
}

const product_class3 = new Product3('gamer headphones', 100, 50);
product_class3.sayHello();

// try catch

try {
    console.log(numero2);
} catch (error) {
    console.log(error.name, ':', error.message);
}

product_class1.sayHello();


// promises

const userAuthenticated = () => new Promise( (resolve, reject) => {
    const auth = false;

    if(auth){
        resolve('Usuario Autenticado');

    } else {
        reject('No se pudo iniciar sesión');
    }
});

userAuthenticated()
    .then( resultado => console.log(resultado))
    .catch( error => console.log(error))



const descargarArchivo = (nombre) => new Promise((resolve, reject) => {
    console.log(`Iniciando descarga de ${nombre}...`);

    setTimeout(() => {
      const success = true; // simula si todo salió bien

      if (success) {
        resolve(`✅ Descarga completa: ${nombre}`);
      } else {
        reject(`❌ Error al descargar ${nombre}`);
      }
    }, 2000); // simula 2 segundos de espera
  });

// Usando la Promise:
descargarArchivo("reporte.pdf")
  .then(mensaje => {
    console.log(mensaje); // Se muestra si todo salió bien
  })
  .catch(error => {
    console.error(error); // Se muestra si hubo un error
  });

// Async / await

function download_clients() {
    return new Promise((resolve, reject) => {
        console.log('Downloading clients...');
        setTimeout(() => {
            resolve('Clients downloaded');
        }, 5000);
    });
}


function download_orders() {
    return new Promise((resolve, reject) => {
        console.log('Downloading orders...');
        setTimeout(() => {
            resolve('Orders downloaded');
        }, 3000);
    });
}

async function app() {
    try {
        // const clients = await download_clients();
        // const orders = await download_orders();
        // console.log(clients);

        const result = await Promise.all([download_clients(), download_orders()]);
        console.log(result[0]);
        console.log(result[1]);
    } catch (error) {
        console.log(error);
    }
}

app();