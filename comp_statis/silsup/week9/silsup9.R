#! /usr/bin/env Rscript
functionName <- function(a,b){
    num <- a+b;
    if(num>5){
        print("Bigger than 5");
    }
    else{
        print("Smaller than 5");
    }
}
functionName(4,7);
functionName(1,3);

escape <- function(){
    ans <- sample(1:10,1);
    ipt <- "unknown";
    while(ans!=ipt){
    if((ipt <- readline(prompt="Choose random number (1~10) :"))==ans){
        print("Correct");
    }
    else{
        print("Incorrect");
    }
    }
}
#escape();
Jack <<- c();
Alice <<- c();
print(Alice);
give <- function(){

    rst <- 0;
    Alice <<- c();
    for(i in 1:100){
    random <- sample(1:10,1);
    if(random %% 2 ==0){
        Jack <<- c(Jack,1);
      Alice <<- c(Alice,0);
    }
    else{
        Jack <<- c(Jack,0);
      Alice <<- c(Alice,1);
    }
    }
    for(k in Alice){
        rst <- rst + k;
    }
    return(rst);
}
average <- function(){
    rst <- 0;
    for(i in 1:10){
        rst <- rst + give();
    }
    return(rst/10);

}
avgr <- 0;
print(average());