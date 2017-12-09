#! /usr/bin/env Rscript
library(MASS);
summary(Cars93);
car.data = table(Cars93$Price, Cars93$Length);
chisq.test(car.data);
