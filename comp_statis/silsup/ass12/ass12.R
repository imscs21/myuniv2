#! /usr/bin/env Rscript
x <- sample(100,1000,replace=TRUE);

xt <- matrix(x,25,40);
#print(xt);
write.csv(xt,file="./sample.csv");
y <- dnorm(x,mean(x),sd(x));
pdf("./rst.pdf");
plot(x,y);
