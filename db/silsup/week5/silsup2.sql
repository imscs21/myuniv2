SET ECHO ON
select avg(speed) from PC;
select model,speed,hd from PC where price<1600;
select model,ram,screen from Laptop where price>2000;
select model,speed,hd from PC where (cd='6x' or cd='8x') and price<2000;
select speed,maker from Laptop,Product where Laptop.model = Product.model and hd>=1;
select count(*),max(speed) from Product natural join PC where  speed>170 and type='pc';
select model,screen,price from (Product natural join Laptop ) where model<2003 and maker='D';
select ram,speed,count(maker) from Laptop natural join Product where ram <=16 and speed>120 group by ram,speed;
select maker,avg(screen) from Laptop natural join Product group by maker;
select maker,avg(speed),min(price) from PC natural join Product group by maker;
select maker,model,max(price) as MaxP from Laptop natural join Product where hd>1 group by maker,model order by MaxP desc;
select speed,hd from PC where speed>=180 and price > 2000 order by speed;
select ram,avg(price) from PC group by ram having avg(price)<2500;
select model,avg(speed),hd from laptop group by model,hd having avg(speed)>130;