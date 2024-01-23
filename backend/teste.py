import random

def generate_score():    
    placar_casa = random.randint(0, 7)
    placar_visitante = random.randint(0, 7)
    
    tentativas = 0
    while placar_casa == placar_visitante and tentativas < 3:
        placar_visitante = random.randint(0, 7)
        tentativas += 1

    return placar_casa, placar_visitante

placar_casa, placar_visitante = generate_score()
print(placar_casa)
print(';')
print(placar_visitante)
