P = int(input("Enter public number P: "))
Q = int(input("Enter public number Q: "))
a = int(input("Enter private key for Alice a: "))
b = int(input("Enter private key for Bob b: "))
x = (Q**a) % P
y = (Q**b) % P
ka = y**a % P
kb = x**b % P
print(ka,kb)