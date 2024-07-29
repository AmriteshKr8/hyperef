i = input()
i = i.replace(" ","")
for j in i:
    j=str(bin(ord(j)))
    j = j.replace("b","")
    print(j,end=" ")