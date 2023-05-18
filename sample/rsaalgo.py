p = int(input("Enter p: "))
q = int(input("Enter q: "))
M = int(input("Enter M: "))
n = p*q
phiofn = (p-1)*(q-1)
for i in range(2,phiofn):
    if phiofn%i == 0:
        continue
    else:
        e = i
        break
j=0
while j>=0:
    if (j*e)%phiofn == 1:
        d = j
        break
    else:
        j+=1
print("Public key = (",e,",",n,")")
print("Private key = (",d,",",n,")")
c = (M**e)%n
print("Encrypted text = ",c)
m = (c**d)%n
print("Decrypted text = ",m)