//Variables que usemos en todas las funciones
x="0";
function presionaDigito(digito) {
    var display     = document.getElementById("display");
    if (display.value==0) {	// inicializar un número, 
        display.innerHTML=digito; //mostrar en pantalla
        display.value = null;
    }
    display.value   = display.value + digito;
}

function limpiaDisplay(){
    var display = document.getElementById("display");
    display.value="0";
}

function presionaOperador(operador) {
    var display = document.getElementById("display");
    display.value = display.value + operador;
}

function presionaIgual() {
    var display = document.getElementById("display");
    var resultado = eval(display.value);
    //Mostrar el resultado
    display.value = resultado;
}

function calcularRaiz() {
    var display = document.getElementById("display");
    display.value = Math.sqrt(eval(display.value));
}

function calcularFactorial() {
    var display = document.getElementById("display");
    if (display.value == 0) {
        display.value = 1;
    } else {
       let s = 1;
        while (display.value > 1) {
            s *= display.value;
        display.value--;
         }
        display.value = s;
    }
}

function calcularPorcentaje() {
    var display = document.getElementById("display");
    display.value = eval(display.value)/100;
}

function calcularLn() {
    var display = document.getElementById("display");
    display.value = Math.log(eval(display.value));
}

function calcularLog() {
    var display = document.getElementById("display");
    display.value = Math.log10(eval(display.value));
}

function CalcularXalaY() {
    var exponente = parseInt(prompt("Introduzca el valor del exponente"));
    var display = document.getElementById("display");
    display.value = Math.pow(eval(display.value), exponente);
}