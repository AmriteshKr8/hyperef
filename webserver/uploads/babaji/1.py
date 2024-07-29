n=int(input())
l=input();s=0;b=[];m=0;c=[]
a=l.split(' ')
for i in range(0,n):
    a[i]=int(a[i])
for i in range(0,n,2):
    b.append(a[i])
for i in range(1,n,2):
    c.append(a[i])
for i in range(3):
    x=max(b)
    
    y=b.pop(b.index(x))
    s=s+x
for i in range(3):
    x=max(c)
    y=c.pop(c.index(x))
    m=m+x
if m>s:
    print(m)
else:
    print(s)
