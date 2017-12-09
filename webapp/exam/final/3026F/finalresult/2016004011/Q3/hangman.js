/*
name : Hwang se hyeon, ID: 2016004011, year: 2
*/
// The array of words to be used in the hangman game

var POSSIBLE_WORDS = ["obdurate", "verisimilitude", "defenestrate", "obsequious", "dissonant", "toady", "idempotent"];
var MAX_GUESSES = 6;           // number of total guesses per game

// Global Variables
var word = "?";                // variable to store random word user is trying to guess  
var guesses = "";              // variable to store letters the player has  
var guessCount = MAX_GUESSES;  // variable to store number of guesses player has left  

// Chooses a new random word and displays its clue on the page.
function newGame() {
  // Choose a random word from the 'POSSIBLE_WORDS' variable and store it in 'word' variable
  var randomIndex = parseInt(Math.floor(Math.random()*(10*POSSIBLE_WORDS.length+POSSIBLE_WORDS.length))%POSSIBLE_WORDS.length);
  word = POSSIBLE_WORDS[randomIndex];
  console.log("ans word is "+word);
  // update necessary global variables  
  guessCount = MAX_GUESSES;
  guesses = "";
  // show initial word clue - all underscores
  updatePage();   
}

// Guesses a letter.  Called when the user presses the Guess button.

function guessLetter() {
  // Store what user has typed in 'guess' textbox into 'letter' variable
  var letter = $F("guess");
  /* If user has used up all the number of guesses, or
   * if user guessed the complete word (if `clue' element does not contain '_'), or 
   * if user has already guessed this letter
   */


  if (guessCount==0 || $("clue").innerHTML.search("\_")<0 || guesses.search(letter)>=0) {
    return;   
  }
  // otherwise add guessed letter to the 'guesses' variable   
  guesses += letter;
  // If user has guessed incorrectlty decrement user's number of guesses (guessCount) by 1
  if (word.search(letter)<0) {
      guessCount-=1;      
  }
  updatePage();
}

// Updates the hangman image, word clue, etc. to the current game state.
function updatePage() {
  var clueString = "";
  // Update clue string such as "h _ l l _ "
  for (var i = 0; i < word.length; i++) {
  	/* If the letter has been guessed correctly append letter and a single white space to 'clueString' variable
  	 * otherwise append '_' and a single white space to 'clueString' variable
  	 */

    var letter = word[i];

    if (guesses.search(letter)>=0) {   // letter has been guessed
      clueString += letter+" ";
    } else {                              // not guessed
      clueString += "_ ";
    }
  }

  $("clue").innerHTML = clueString;
  
  /* If user used up the entire number of guesses, display "You lose." text in 'div' element with id "gueses". 
   * If user guessed the correct words, display "you win!!!." text in 'div' element with id "gueses".
   * Otherwise append the user guess to existing text in 'div' element with id "gueses". 
   */
  if (guessCount==0) {
    $("guesses").update("You lose.");    // game over (loss)
  } else if (clueString.split(" ").join("")==word) {
    $("guesses").update("you win !!!");     // game over (win)
  } else {
    $("guesses").innerHTML = "Guesses: " + guesses;
  }

  // Update hangman image (use the 'guessCount' variable to make up an image file name)
  $("hangmanpic").src = "images/hangman" + guessCount+ ".gif";
  
  // empty out the textbox for next input

  $("guess").value = "";
}
