input()
a = input()
a = a.split(" ")
for i in range(len(a)):
    a[i] = int(a[i])
sum=0
for i in range(2,len(a)-2):
    sum1=a[i-2]+a[i]+a[i+2]
    if sum1 > sum:
        sum = sum1
print(sum)