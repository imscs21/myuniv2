#! /usr/bin/env Rscript
print(qchisq(0.99,30-1));
x <- c(79, 48, 35, 55, 36, 42, 63, 31, 54, 54, 47, 53, 53, 62, 50, 54, 48, 57, 43, 42, 63, 44, 52, 53, 52, 65, 56, 57, 47, 67);
y <- dnorm(x,mean(x),sd(x));
#X11();
pdf(file="myplot.pdf")
plot(x,y);

cc <- rt(100,10);
c2 <- dt(cc,10);
plot(cc,c2);
cc <- matrix(c(5,4,3,8),nrow=2,ncol=2,byrow=TRUE);
chisq.test(cc);
