#! /usr/bin/env Rscript
library(MASS);
str(Cars93);
pdf("./a.pdf");
cov(Cars93$Weight,Cars93$Horsepower,use="everything",method=c("pearson"));
plot(Horsepower ~ Weight, data=Cars93,xlab="Weight",ylab="Horspeower");
abline(lm(Horsepower ~ Weight,data=Cars93),col='blue');
cor(Cars93$Weight,Cars93$Horsepower,use="everything",method=c("pearson"));
cor.test(Cars93$Weight,Cars93$Horsepower);

pdf("./b.pdf");

plot(Price ~ RPM, data=Cars93,xlab="Price",ylab="RPM");
abline(lm(Price ~ RPM,data=Cars93),col='blue');

cov(Cars93$Price,Cars93$RPM,use="everything",method=c("pearson"));
cor(Cars93$Price,Cars93$RPM,use="everything",method=c("pearson"));
cor.test(Cars93$Price,Cars93$RPM);

