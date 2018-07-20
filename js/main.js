import { testPls } from './functions/testFunction';

console.log("HEY THIS IS WORKING");

testPls();



import { updateIndex } from './functions/indexUpdate'

//This is for updating the index page
$(document).ready(function(){

   //for one test
   updateIndex();

   console.log("hey");

   //updates the index page every 5 seconds
   setInterval(function(){
       

   //updateIndex();

   }, 5000)

});