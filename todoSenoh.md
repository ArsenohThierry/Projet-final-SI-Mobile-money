# Taches :

## V1 :
CRUD = CRUD + Liste flitrable

- [ok]Login (cote client et operateur):
    - [ok]Si operateur : email et mdp
    - [ok]Si client : par numero 
        - [ok]SI existe : login direct
        - [ok]SI pas encore : Page d'insertion Nom 
- CRUD DES PREFIXES ( 033 , 037)
- CRUD de types d'operations ( Depot , Retrait , Transfert)
- CRUD DES FRAIS  : ajouter des frais pour chaque type d'operation
- Dashboard avec un card qui affiche le gain : (total des frais)
- CRUD des cleints:
    - Detail d'un client quand on clique dessus : (Nom, numero , solde , date creation)


## V2 :

- Configuration des prefixes , on ne peut pas s'inscrire si le prefixe du numero n'est pas celui de l'operateur

- Modifier CRUD des prefixes : 
    - Modifier table prefixe : 
        - ajouter nom_operateur , % comission ,
    - Dans la page CRUD :
        - Bouton ajouter d'autres operateurs :
            - prefixe , comission