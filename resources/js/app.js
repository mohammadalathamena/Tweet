require('./bootstrap');

require('alpinejs');


let letterCounter = document.getElementById('letterCounter') ;
let tweetTextarea = document.getElementById('tweetTextarea') ;
document.getElementById('tweetTextarea').onkeyup = function(){
    letterCounter.innerHTML = 280 - this.value.length ;
}
