def sumatoria(*lista):
	suma = 0
	for i in lista:
		suma += i 
	return suma

print sumatoria(1,4,2,5,9,5,7)

def mostar(**diccionario):
	suma = 0
	for i in diccionario.values():
		suma += i
	return suma 

print mostar(data1=3, dato2=4)

