/* CSE326 : Web Application Development
 * Lab 10 - Maze Assignment
 * Student Number: 2016004011
 * Name: Hwang se hyeon(황세현)
 *
 */
 "use strict";
var loser = null;  // whether the user has hit a wall

window.onload = function() {
  $$("body")[0].addEventListener("mouseover",overBody);
  $("maze").addEventListener("mouseover",overBody);
  $("start").addEventListener("mouseover",overBody);
  $("end").addEventListener("mouseover",overBody);
  var bnd1 = $("boundary1");
  bnd1.addEventListener("mouseover",overBoundary);
  var walls = $$("#boundary1 ~ .boundary");
  for(var i =0;i<walls.length;i++){
    var wall = walls[i];
    console.log(wall);
    wall.addEventListener("mouseover",overBoundary);
  }
  $("end").addEventListener("mouseover",overEnd);
  $("start").addEventListener("click",startClick);
  loser={lose:true,start:false};
};

// called when mouse enters the walls;
// signals the end of the game with a loss
function overBoundary(event) {
  console.log("overBoundary");
  if(loser.start&&loser.lose){
    var ele = event.toElement;
    var eles = $$("#maze .boundary");
    for(var i=0;i<eles.length;i++){
      ele = eles[i];
      ele.addClassName("youlose");
    }
    /*if(ele.id=="boundary1"){
      ele.addClassName("youlose");
    }
    else{
      var eles = $$("#maze .boundary");
      for(var i=0;i<eles.length;i++){
        ele = eles[i];
        ele.addClassName("youlose");
      }
    }*/
    //alert("You lose! :(");
    var msg = "You lose! :(";
    $("status").update(new Element("div").update(msg));
    loser.lose=true;
    loser.start = false;
  }
}

// called when mouse is clicked on Start div;
// sets the maze back to its startial playable state
function startClick() {
  var eles = $$("#maze .boundary");
  for(var i=0;i<eles.length;i++){
    var ele = eles[i];
    ele.removeClassName("youlose");
  }
  $("status").update('Find the end');
  loser={lose:true,start:true};

}

// called when mouse is on top of the End div.
// signals the end of the game with a win
function overEnd() {
  if(loser.start){
    var msg = "You win! :)";
  //  alert("You win! :)");
    $("status").update(new Element("div").update(msg));
    loser.lose = false;

  }

}

// test for mouse being over document.body so that the player
// can't cheat by going outside the maze
function overBody(event) {
  var ele = event.toElement || event.target || event.currentTarget;
  if(!ele.id&&loser.start&&loser.lose){
      var eles = $$("#maze .boundary");
      for(var i=0;i<eles.length;i++){
          eles[i].addClassName("youlose");
      }
      var msg = "You lose! :(";
      $("status").update(new Element("div").update(msg));
  }
}
