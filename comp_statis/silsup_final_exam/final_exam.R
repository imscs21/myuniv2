ex1 <- function(){
  # 문제 1 답안 코드 작성
  library(MASS)
  mat <- matrix(drivers,nrow=12);
  print(max(mat[,3]));
}
ex1()
ex2 <- function(){
  #문제 2 답안 작성
  library(MASS)
  dt <- Cars93$Price
  plot(x=dt,y=dnorm(dt,mean(dt),sd(dt)),xlab="Prices of Cars93",ylab="Density")

}
ex2()
ex3 <- function(){
  #문제 3 답안 작성
  library(MASS)
  print(cor.test(x=Cars93$Weight , y=Cars93$Horsepower,use="everything",method=c("pearson")))
}
ex3()
ex4 <- function(){
  library(MASS)
  # 문제 4-1 답안 작성 (print)
  print(dbinom(7,10,4/5))
  # 문제 4-2 답안 작성 (print)
  print(qchisq(0.9,9,lower.tail = TRUE));
  # 문제 4-3 답안 작성  (print)
  print(dpois(3,25/10))
}
ex4()
ex5 <- function(n){
    count <- 0 # 원 내부에 존재하는 좌표의 개수를 세기를 위한 카운트 값
    # 문제 5 답안작성
    x <- runif(n,-1,1)
    y <- runif(n,-1,1)
    count <- (sum((sqrt(x^2+y^2)<1)==TRUE))
    return (4*count/n) # 원주율값 리턴
}
ex5(10000)
ex5(100000)
ex5(1000000)
